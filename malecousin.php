<?php

include "function.php";
$result = isset($_GET["id"]) ? getMaleCousinFrom($_GET["id"]) : getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepupu Laki Laki Dari</title>
</head>

<body>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="childfrom.php">Anak Dari</a></li>
        <li><a href="grandchild.php"> Cucu Dari</a></li>
        <li><a href="granddaughter.php"> Cucu Perempuan Dari</a></li>
        <li><a href="aunt.php">Bibi Dari</a></li>
        <li><a href="malecousin.php">Sepupu Laki-Laki Dari</a></li>
    </ul>

    <h1>Sepupu Laki Laki Dari</h1>
    <form action="" method="get">
        <select name="id">
            <option value="">Pilih Orang</option>
            <?php
            $all = getAll();
            foreach ($all as $row) :
            ?>
                <option value="<?= $row["id"]; ?>"><?= $row["nama"]; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Cari</button>
    </form>

    <table border="1">
        <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Jenis Kelamin</td>
        </tr>

        <?php
        $no = 1;
        foreach ($result as $row) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["jenis_kelamin"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>