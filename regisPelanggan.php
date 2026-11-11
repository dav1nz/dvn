<!DOCTYPE html>
<html> 
    <header>
        <h1>
            Registrasi Pelanggan
        </h1>
    </header>
    <body>
        <div>
            <ul> 
                
                <form action="regis.php" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required><br><br>
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" required><br><br>
                    <label for="nomorTelepon">Nomor Telepon:</label>
                    <input type="text" id="nomorTelepon" name="nomorTelepon" required><br><br>
                        <label .radio for="kelamin">Jenis kelamin:</label>
                        <input type="radio" id="laki_laki" name="kelamin" value="laki_laki" required>
                        <label for="laki_laki">Laki-laki</label>
                        <input type="radio" id="perempuan" name="kelamin" value="perempuan" required>
                        <label for="perempuan">Perempuan</label><br><br>
                        <input type="submit" value="Daftar">
                    </form>
            </ul>
        </div>
    </body>
</html>