<?php

// koneksi

$conn = mysqli_connect('localhost', 'root', '', 'sipeku');

if (!$conn) {
    mysqli_error($koneksi);
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function putDataIndikator($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);

    $query = "INSERT INTO indikator VALUES ('','$nama')";
    mysqli_query($conn, $query);
    $data = query('SELECT * FROM indikator ORDER BY ID_INDIKATOR DESC LIMIT 1');
    $idindikator = $data[0]['ID_INDIKATOR'];

    $query = "INSERT INTO indikator VALUES ('','$nama')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function putDataPeran($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);

    $query = "INSERT INTO peran VALUES ('','$nama')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function putDataKategori($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);

    $query = "INSERT INTO kategori VALUES ('','$nama')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function putDataSekolah($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);

    $query = "INSERT INTO sekolah VALUES ('','$nama')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateDataSekolah($data)
{
    global $conn;
    $id = $data['id'];
    $nama = $data['nama'];
    $query = "UPDATE sekolah SET 
                        NAMA_SEKOLAH = '$nama'
                        WHERE ID_SEKOLAH='$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function updateDataKategori($data)
{
    global $conn;
    $id = $data['id'];
    $nama = $data['nama'];
    $query = "UPDATE kategori SET 
                        NAMA_KATEGORI = '$nama'
                        WHERE ID_KATEGORI='$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function updateDataPeran($data)
{
    global $conn;
    $id = $data['id'];
    $nama = $data['nama'];
    $query = "UPDATE peran SET 
                        NAMA_PERAN = '$nama'
                        WHERE ID_PERAN='$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
function updateDataIndikator($data)
{
    global $conn;
    $id = $data['id'];
    $nama = $data['nama'];
    $query = "UPDATE indikator SET 
                        NAMA_INDIKATOR = '$nama'
                        WHERE ID_INDIKATOR='$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
?>