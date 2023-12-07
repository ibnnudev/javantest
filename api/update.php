<?php

include '../function.php';

// update data
if (isset($_POST["id"]) && isset($_POST["nama"]) && isset($_POST["jenis_kelamin"]) && isset($_POST["id_orangtua"])) {
    $id            = $_POST["id"];
    $nama          = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $id_orangtua   = $_POST["id_orangtua"];
    $query         = "UPDATE silsilah_keluarga SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', id_orangtua = '$id_orangtua' WHERE id = $id";
    mysqli_query($conn, $query);
    $response = [
        "status"  => "success",
        "message" => "Data berhasil diupdate"
    ];
    echo json_encode($response);
}
