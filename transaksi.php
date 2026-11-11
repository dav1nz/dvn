<?php

class Transaksi {

    private $apk_kasir;

    public function __construct($koneksi) {
        $this->apk_kasir = $koneksi;
    }

    public function hitungTotal($subtotal, $jumlahProduk) {
        return $subtotal * $jumlahProduk;
    }
    public function simpan(
        $user_id,
        $barang_id,
        $jumlah,
        $bayar
    ) {

        try {

            $this->apk_kasir->begin_transaction();

            $sql = $this->apk_kasir->prepare(
                "SELECT harga, stok FROM barang
                 WHERE id=? FOR UPDATE"
            );

            $sql->bind_param("i", $barang_id);
            $sql->execute();

            $barang = $sql->get_result()->fetch_assoc();

            if (!$barang) {
                throw new Exception("Barang tidak ditemukan!");
            }

            if ($jumlah < 1 || $jumlah > $barang['stok']) {
                throw new Exception("Stok tidak mencukupi!");
            }

            $total = $this->hitungTotal(
                $barang['harga'],
                $jumlah
            );

            if ($bayar < $total) {
                throw new Exception("Uang pembayaran kurang!");
            }

            $kembalian = $bayar - $total;

            $sql = $this->apk_kasir->prepare(
                "INSERT INTO transaksi
                (user_id, total, bayar, kembalian)
                VALUES (?, ?, ?, ?)"
            );

            $sql->bind_param(
                "iddd",
                $user_id,
                $total,
                $bayar,
                $kembalian
            );

            $sql->execute();

            $transaksi_id = $this->apk_kasir->insert_id;

            $sql = $this->apk_kasir->prepare(
                "INSERT INTO detail_transaksi
                (transaksi_id, barang_id, jumlah, subtotal)
                VALUES (?, ?, ?, ?)"
            );

            $sql->bind_param(
                "iiid",
                $transaksi_id,
                $barang_id,
                $jumlah,
                $total
            );

            $sql->execute();

            $sql = $this->apk_kasir->prepare(
                "UPDATE barang SET stok = stok - ?
                 WHERE id=?"
            );

            $sql->bind_param(
                "ii",
                $jumlah,
                $barang_id
            );

            $sql->execute();

            $this->apk_kasir->commit();

            return [
                "berhasil" => true,
                "total" => $total,
                "kembalian" => $kembalian
            ];

        } catch (Throwable $e) {

            $this->apk_kasir->rollback();

            return [
                "berhasil" => false,
                "pesan" => $e->getMessage()
            ];
        }
    }
}
?>
