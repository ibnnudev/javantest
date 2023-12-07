<?php
include "function.php";

$data = getByID($_GET["id"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>

<body>
    <h1>Edit Data</h1>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $data["id"]; ?>">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?= $data["nama"]; ?>" required>
        <br>
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" required>
            <option value="">Pilih Jenis Kelamin</option>
            <option value="L" <?php if ($data["jenis_kelamin"] == "L") echo "selected"; ?>>Laki-laki</option>
            <option value="P" <?php if ($data["jenis_kelamin"] == "P") echo "selected"; ?>>Perempuan</option>
        </select>
        <br>
        <label for="id_orangtua">Orang Tua</label>
        <select name="id_orangtua" id="id_orangtua" required>
            <option value="">Pilih Orang Tua</option>
            <?php
            $all = getAll();
            foreach ($all as $row) :
            ?>
                <option value="<?= $row["id"]; ?>" <?php if ($data["id_orangtua"] == $row["id"]) echo "selected"; ?>><?= $row["nama"]; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit" name="submit">Edit Data</button>
    </form>

    <?php
    if (isset($_POST["submit"])) {
        if (updateData($_POST) > 0) {
            echo "
                <script>
                    alert('Data berhasil diedit!');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data gagal diedit!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }
    ?>
</body>

</html>