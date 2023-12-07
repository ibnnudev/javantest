<?php

include '../function.php';

// delete data
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $query = "DELETE FROM silsilah_keluarga WHERE id = $id";
    mysqli_query($conn, $query);
    $response = [
        "status"  => "success",
        "message" => "Data berhasil dihapus"
    ];
    echo json_encode($response);
}
