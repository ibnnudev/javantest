<?php
include "function.php";

$all = getAll();

if (isset($_POST["submit"])) {
    if (createChild($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>

<body>
    <h1>Tambah Data</h1>

    <form action="" method="post">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" required>
        <br>
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
        <br>
        <label for="id_orangtua">Orang Tua</label>
        <select name="id_orangtua" id="id_orangtua" required>
            <option value="">Pilih Orang Tua</option>
            <?php
            foreach ($all as $data) :
            ?>
                <option value="<?= $data["id"]; ?>"><?= $data["nama"]; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit" name="submit">Tambah Data</button>
    </form>

</body>

</html>