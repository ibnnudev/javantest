<?php
include "function.php";
$all = getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="childfrom.php">Anak Dari</a></li>
        <li><a href="grandchild.php">Cucu Dari</a></li>
        <li><a href="granddaughter.php">Cucu Perempuan Dari</a></li>
        <li><a href="aunt.php">Bibi Dari</a></li>
        <li><a href="malecousin.php">Sepupu Laki-Laki Dari</a></li>
    </ul>


    <h1>Daftar Keluarga</h1>
    <a href="add.php">
        <button>Tambah Data</button>
    </a>
    <table border="1">
        <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Jenis Kelamin</td>
            <td>Anak Dari</td>
            <td>Aksi</td>
        </tr>

        <?php
        $no = 1;
        foreach ($all as $row) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row["nama"]; ?></td>
                <td><?= $row["jenis_kelamin"]; ?></td>
                <td><?= $row["nama_orangtua"]; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row["id"]; ?>"><button>Edit</button></a>
                    <a href="delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><button>Hapus</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


</body>

</html>