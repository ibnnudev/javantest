<?php

include '../function.php';

// add data
if (isset($_POST["nama"]) && isset($_POST["jenis_kelamin"]) && isset($_POST["id_orangtua"])) {
    $nama          = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $id_orangtua   = $_POST["id_orangtua"];
    $query         = "INSERT INTO silsilah_keluarga (nama, jenis_kelamin, id_orangtua) VALUES ('$nama', '$jenis_kelamin', '$id_orangtua')";
    mysqli_query($conn, $query);
    $response = [
        "status"  => "success",
        "message" => "Data berhasil ditambahkan"
    ];
    echo json_encode($response);
}
