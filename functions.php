<?php

// koneksi

use LDAP\Result;

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
    $id = query('SELECT * FROM indikator ORDER BY ID_INDIKATOR DESC LIMIT 1');
    $idindikator = $id[0]['ID_INDIKATOR'];
    $idperan = explode(',', $data['idperan']);
    $index = 0;
    foreach ($idperan as $idperan) {
        $query = "INSERT INTO kriteria_peran VALUES ('','$idindikator','$idperan[$index]')";
        mysqli_query($conn, $query);
    }
    $index++;
    // foreach ($idperan as $idperan) {

    // }
    // $index++;

    // return mysqli_affected_rows($conn);
}
function putDataPeran($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $cekNama = strtolower($nama);
    $peranDb = query('SELECT NAMA_PERAN FROM peran');
    $rows = [];
    foreach ($peranDb as $peran) {
        $rows[] = strtolower($peran['NAMA_PERAN']);
    }
    if (in_array($cekNama, $rows)) {
        return 0;
    } else {
        $query = "INSERT INTO peran VALUES ('','$nama')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}
function putDataKategori($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);

    $query = "INSERT INTO kategori VALUES ('','$nama')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function putDataPertanyaan($data)
{
    global $conn;

    $pertanyaanKualitas = htmlspecialchars($data['pKualitas']);
    $pertanyaanKepentingan = htmlspecialchars($data['pKepentingan']);
    $idIndikator = $data['id_indikator'];
    $ketentuanKualitas5 = $data['j5kualitas'];
    $ketentuanKualitas4 = $data['j4kualitas'];
    $ketentuanKualitas3 = $data['j3kualitas'];
    $ketentuanKualitas2 = $data['j2kualitas'];
    $ketentuanKualitas1 = $data['j1kualitas'];
    $ketentuanKepentingan5 = $data['j5kepentingan'];
    $ketentuanKepentingan4 = $data['j4kepentingan'];
    $ketentuanKepentingan3 = $data['j3kepentingan'];
    $ketentuanKepentingan2 = $data['j2kepentingan'];
    $ketentuanKepentingan1 = $data['j1kepentingan'];

    $query = "INSERT INTO pertanyaan VALUES ('','$idIndikator','$pertanyaanKualitas','KUALITAS')";
    $query1 = "INSERT INTO pertanyaan VALUES ('','$idIndikator','$pertanyaanKepentingan','KEPENTINGAN')";
    mysqli_query($conn, $query);
    mysqli_query($conn, $query1);
    $idkualitas = query(
        'SELECT * FROM pertanyaan WHERE KATEGORI = "KUALITAS" ORDER BY ID_PERTANYAAN DESC LIMIT 1'
    );
    $idPertanyaanKualitas = $idkualitas[0]['ID_PERTANYAAN'];
    $idkepentingan = query(
        'SELECT * FROM pertanyaan WHERE KATEGORI = "KEPENTINGAN" ORDER BY ID_PERTANYAAN DESC LIMIT 1'
    );
    $idPertanyaanKepentingan = $idkepentingan[0]['ID_PERTANYAAN'];

    $query2 = "INSERT INTO ketentuan_jawaban VALUES ('','$idPertanyaanKualitas','$ketentuanKualitas5',5)";
    $query3 = "INSERT INTO ketentuan_jawaban VALUES ('','$idPertanyaanKualitas','$ketentuanKualitas4',4)";
    $query4 = "INSERT INTO ketentuan_jawaban VALUES ('','$idPertanyaanKualitas','$ketentuanKualitas3',3)";
    $query5 = "INSERT INTO ketentuan_jawaban VALUES ('','$idPertanyaanKualitas','$ketentuanKualitas2',2)";
    $query6 = "INSERT INTO ketentuan_jawaban VALUES ('','$idPertanyaanKualitas','$ketentuanKualitas1',1)";
    mysqli_query($conn, $query2);
    mysqli_query($conn, $query3);
    mysqli_query($conn, $query4);
    mysqli_query($conn, $query5);
    mysqli_query($conn, $query6);

    $query6 = "INSERT INTO ketentuan_jawaban VALUES ('','$idPertanyaanKepentingan','$ketentuanKepentingan5',5)";
    $query7 = "INSERT INTO ketentuan_jawaban VALUES ('','$idPertanyaanKepentingan','$ketentuanKepentingan4',4)";
    $query8 = "INSERT INTO ketentuan_jawaban VALUES ('','$idPertanyaanKepentingan','$ketentuanKepentingan3',3)";
    $query9 = "INSERT INTO ketentuan_jawaban VALUES ('','$idPertanyaanKepentingan','$ketentuanKepentingan2',2)";
    $query10 = "INSERT INTO ketentuan_jawaban VALUES ('','$idPertanyaanKepentingan','$ketentuanKepentingan1',1)";
    mysqli_query($conn, $query6);
    mysqli_query($conn, $query7);
    mysqli_query($conn, $query8);
    mysqli_query($conn, $query9);
    mysqli_query($conn, $query10);
    return mysqli_affected_rows($conn);
}
function putDataSekolah($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $cekNama = strtolower($nama);
    $sekolahDb = query('SELECT NAMA_SEKOLAH FROM sekolah');
    $rows = [];
    foreach ($sekolahDb as $sekolah) {
        $rows[] = strtolower($sekolah['NAMA_SEKOLAH']);
    }
    if (in_array($cekNama, $rows)) {
        return 0;
    } else {
        $query = "INSERT INTO sekolah VALUES ('','$nama')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}
function putDataJawaban($data)
{
    global $conn;

    $nama = htmlspecialchars($data['nama']);
    $idperan = $data['idPeran'];
    $idSekolah = $data['idSekolah'];
    $idPertanyaan = explode(',', $data['idPertanyaan']);
    $jawaban = explode(',', $data['Jawaban']);
    foreach ($idPertanyaan as $index => $pertanyaan) {
        $valueJawaban = $jawaban[$index];
        $query = "INSERT INTO jawaban VALUES ('','$nama','$pertanyaan','$idSekolah','$idperan','$valueJawaban')";
        mysqli_query($conn, $query);
    }
    // array_map(
    //     function ($idPertanyaan, $jawaban) {
    // $query = "INSERT INTO jawaban VALUES ('','$nama','$idPertanyaan','$idSekolah','$idperan','$jawaban')";
    // mysqli_query($conn, $query);
    //     },
    //     $idPertanyaan,
    //     $jawaban
    // );
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
function updateDataPertanyaan($data)
{
    global $conn;
    $idPertanyaan = $data['idPertanyaan'];
    $pertanyaan = $data['pertanyaan'];
    $idIndikator = $data['indikator'];
    $jawaban1 = $data['j1ketentuan'];
    $jawaban2 = $data['j2ketentuan'];
    $jawaban3 = $data['j3ketentuan'];
    $jawaban4 = $data['j4ketentuan'];
    $jawaban5 = $data['j5ketentuan'];
    $id1 = $data['id1'];
    $id2 = $data['id2'];
    $id3 = $data['id3'];
    $id4 = $data['id4'];
    $id5 = $data['id5'];
    $query = "UPDATE pertanyaan SET 
                        ID_INDIKATOR = '$idIndikator',
                        NAMA_PERTANYAAN = '$pertanyaan'
                        WHERE ID_PERTANYAAN='$idPertanyaan'";
    mysqli_query($conn, $query);

    $query1 = "UPDATE ketentuan_jawaban SET 
                         KETENTUAN_JAWABAN= '$jawaban1'
                        WHERE ID_KETENTUAN_JAWABAN='$id1'";
    mysqli_query($conn, $query1);
    $query2 = "UPDATE ketentuan_jawaban SET 
                         KETENTUAN_JAWABAN= '$jawaban2'
                        WHERE ID_KETENTUAN_JAWABAN='$id2'";
    mysqli_query($conn, $query2);
    $query3 = "UPDATE ketentuan_jawaban SET 
                         KETENTUAN_JAWABAN= '$jawaban3'
                        WHERE ID_KETENTUAN_JAWABAN='$id3'";
    mysqli_query($conn, $query3);
    $query4 = "UPDATE ketentuan_jawaban SET 
                         KETENTUAN_JAWABAN= '$jawaban4'
                        WHERE ID_KETENTUAN_JAWABAN='$id4'";
    mysqli_query($conn, $query4);
    $query5 = "UPDATE ketentuan_jawaban SET 
                         KETENTUAN_JAWABAN= '$jawaban5'
                        WHERE ID_KETENTUAN_JAWABAN='$id5'";
    mysqli_query($conn, $query5);
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
    mysqli_query(
        $conn,
        "DELETE FROM kriteria_peran WHERE kriteria_peran.ID_INDIKATOR = '$id'"
    );
    $idperan = explode(',', $data['idPeran']);
    foreach ($idperan as $idperan) {
        $query = "INSERT INTO kriteria_peran VALUES ('','$id','$idperan')";
        mysqli_query($conn, $query);
    }
    // return mysqli_affected_rows($conn);
}
function deleteSekolah($data)
{
    global $conn;

    $id = $data['id'];
    mysqli_query($conn, "DELETE FROM sekolah WHERE sekolah.ID_SEKOLAH='$id'");
}
function deletePeran($data)
{
    global $conn;

    $id = $data['id'];
    mysqli_query($conn, "DELETE FROM kriteria_peran WHERE ID_PERAN='$id'");
    mysqli_query($conn, "DELETE FROM peran WHERE peran.ID_PERAN='$id'");
}
function deleteKategori($data)
{
    global $conn;

    $id = $data['id'];
    $query1 = "DELETE FROM kategori WHERE kategori.ID_KATEGORI='$id'";
    mysqli_query($conn, $query1);
}
function deleteIndikator($data)
{
    global $conn;

    $id = $data['id'];
    mysqli_query($conn, "DELETE FROM kriteria_peran WHERE ID_INDIKATOR='$id'");
    mysqli_query($conn, "DELETE FROM indikator WHERE ID_INDIKATOR='$id'");
}
function deletePertanyaan($data)
{
    global $conn;

    $id = $data['id'];
    $id2 = $data['id2'];
    mysqli_query(
        $conn,
        "DELETE FROM pertanyaan WHERE pertanyaan.ID_PERTANYAAN='$id'"
    );
    mysqli_query(
        $conn,
        "DELETE FROM ketentuan_jawaban WHERE ketentuan_jawaban.ID_PERTANYAAN='$id'"
    );
    mysqli_query(
        $conn,
        "DELETE FROM pertanyaan WHERE pertanyaan.ID_PERTANYAAN='$id2'"
    );
    mysqli_query(
        $conn,
        "DELETE FROM ketentuan_jawaban WHERE ketentuan_jawaban.ID_PERTANYAAN='$id2'"
    );
}
?>