<?php

include "koneksi.php";

function getAll()
{
    global $conn;
    $query  = "SELECT * FROM silsilah_keluarga";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $id_orangtua = $row["id_orangtua"];
        if ($id_orangtua == null || $id_orangtua == 0) {
            $row["nama_orangtua"] = "Tidak ada";
        } else {
            $query2 = "SELECT nama FROM silsilah_keluarga WHERE id = $id_orangtua";
            $result2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($result2);
            $row["nama_orangtua"] = $row2["nama"];
        }
        $rows[] = $row;
    }

    return $rows;
}

function createParent($data)
{
    global $conn;
    $nama          = htmlspecialchars($data["nama"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $query         = "INSERT INTO silsilah_keluarga VALUES ('', '$nama', 1)";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function createChild($data)
{
    global $conn;
    $nama          = htmlspecialchars($data["nama"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $id_orangtua     = htmlspecialchars($data["id_orangtua"]);
    $query = "INSERT INTO silsilah_keluarga (nama, jenis_kelamin, id_orangtua) VALUES ('$nama', '$jenis_kelamin', '$id_orangtua')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function getByID($id)
{
    global $conn;
    $query  = "SELECT * FROM silsilah_keluarga WHERE id = $id";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function updateData($data)
{
    global $conn;
    $id            = $data["id"];
    $nama          = htmlspecialchars($data["nama"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $id_orangtua     = htmlspecialchars($data["id_orangtua"]);
    $query = "UPDATE silsilah_keluarga SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', id_orangtua = '$id_orangtua' WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function deleteData($id)
{
    global $conn;
    $query = "DELETE FROM silsilah_keluarga WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function getChildFrom($id_orangtua)
{
    global $conn;
    $query = "SELECT * FROM silsilah_keluarga WHERE id_orangtua = $id_orangtua";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $id_orangtua = $row["id_orangtua"];
        if ($id_orangtua == null || $id_orangtua == 0) {
            $row["nama_orangtua"] = "Tidak ada";
        } else {
            $query2 = "SELECT nama FROM silsilah_keluarga WHERE id = $id_orangtua";
            $result2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($result2);
            $row["nama_orangtua"] = $row2["nama"];
        }
        $rows[] = $row;
    }

    return $rows;
}

function getGrandChildFrom($id)
{
    global $conn;
    $query = "SELECT * FROM silsilah_keluarga WHERE id_orangtua IN (SELECT id FROM silsilah_keluarga WHERE id_orangtua = $id)";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $id_orangtua = $row["id_orangtua"];
        if ($id_orangtua == null || $id_orangtua == 0) {
            $row["nama_orangtua"] = "Tidak ada";
        } else {
            $query2 = "SELECT nama FROM silsilah_keluarga WHERE id = $id_orangtua";
            $result2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($result2);
            $row["nama_orangtua"] = $row2["nama"];
        }
        $rows[] = $row;
    }

    return $rows;
}

function getGrandDaughterFrom($id)
{
    global $conn;
    $query = "SELECT * FROM silsilah_keluarga WHERE id_orangtua IN (SELECT id FROM silsilah_keluarga WHERE id_orangtua = $id) AND jenis_kelamin = 'P'";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $id_orangtua = $row["id_orangtua"];
        if ($id_orangtua == null || $id_orangtua == 0) {
            $row["nama_orangtua"] = "Tidak ada";
        } else {
            $query2 = "SELECT nama FROM silsilah_keluarga WHERE id = $id_orangtua";
            $result2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($result2);
            $row["nama_orangtua"] = $row2["nama"];
        }
        $rows[] = $row;
    }

    return $rows;
}

function getAuntFrom($id)
{
    global $conn;
    // get less id_orangtua and jenis_kelamin = P
    $current_id_orangtua = getByID($id)["id_orangtua"];
    $query = "SELECT * FROM silsilah_keluarga WHERE id_orangtua < $current_id_orangtua AND jenis_kelamin = 'P'";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $id_orangtua = $row["id_orangtua"];
        if ($id_orangtua == null || $id_orangtua == 0) {
            $row["nama_orangtua"] = "Tidak ada";
        } else {
            $query2 = "SELECT nama FROM silsilah_keluarga WHERE id = $id_orangtua";
            $result2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($result2);
            $row["nama_orangtua"] = $row2["nama"];
        }
        $rows[] = $row;
    }

    return $rows;
}

function getMaleCousinFrom($id)
{
    global $conn; // Pastikan koneksi $conn sudah didefinisikan di luar fungsi

    $data = getByID($id);
    $query = "SELECT *
FROM silsilah_keluarga
WHERE id_orangtua IN (
    SELECT id
    FROM silsilah_keluarga
    WHERE id_orangtua IN (
        SELECT id_orangtua
        FROM silsilah_keluarga
        WHERE id IN (
            SELECT id_orangtua
            FROM silsilah_keluarga
            WHERE nama = ?
        )
    )
)
AND jenis_kelamin = 'L'
AND nama != ? ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $data["nama"], $data["nama"]);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows;
}
