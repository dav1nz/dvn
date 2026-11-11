<?php

class Produk{

    private $apk_kasir;

    public function __construct($koneksi) {
        $this->apk_kasir = $koneksi;
    }

    public function semua() {
        return $this->apk_kasir->query(
            "SELECT * FROM produk ORDER BY produkId DESC"
        );
    }

    public function tambah($produkId, $namaProduk, $harga, $stok) {

        $sql = $this->apk_kasir->prepare(
            "INSERT INTO produk
            (produkId, namaProduk, harga, stok)
            VALUES (?, ?, ?, ?)"
        );

        $sql->bind_param(
            "ssdi",
            $produkId,
            $namaProduk,
            $harga,
            $stok
        );

        return $sql->execute();
    }

    public function edit($produkId, $namaProduk, $harga, $stok) {

        $sql = $this->apk_kasir->prepare(
            "UPDATE produk
             SET namaProduk=?, harga=?, stok=?
             WHERE produkId=?"
        );

        $sql->bind_param(
            "sdii",
            $namaProduk,
            $harga,
            $stok,
            $produkId
        );

        return $sql->execute();
    }

    public function hapus($produkId) {

        $sql = $this->apk_kasir->prepare(
            "DELETE FROM produk WHERE produkId=?"
        );

        $sql->bind_param("i", $produkId);

        return $sql->execute();
    }
}
?>