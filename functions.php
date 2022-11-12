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
    $atribut = $data['atribut'];
    $bobot = (float) $data['bobot'];
    $query = "INSERT INTO indikator VALUES ('','$nama','$atribut','$bobot')";
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

    return mysqli_affected_rows($conn);
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

        mysqli_query($conn, $query) or die($conn);

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
    $atribut = $data['atribut'];
    $bobot = $data['bobot'];
    $query = "UPDATE indikator SET 
                        NAMA_INDIKATOR = '$nama',
                        ATRIBUT = '$atribut',
                        BOBOT = '$bobot'
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
function hitungJawaban()
{
    global $conn;
    buatRiwayat();
    $dataSekolah = query('SELECT DISTINCT ID_SEKOLAH FROM jawaban');
    $dataIndikator = query(
        'SELECT DISTINCT pertanyaan.ID_INDIKATOR FROM pertanyaan LEFT JOIN jawaban ON jawaban.ID_PERTANYAAN = pertanyaan.ID_PERTANYAAN'
    );
    $dataPeran = query('SELECT DISTINCT JENIS_PERAN FROM jawaban');
    // IPA
    // perhitungan awal mencari nilai rata - rata indikator per peran dari total jawaban baik indikator kualitas / kepentingan
    $sqlRataKualitas =
        'INSERT INTO rata_rata (ID_INDIKATOR,ID_SEKOLAH,ID_PERAN,RATA,KATEGORI) VALUES ';
    $sqlRataKepentingan =
        'INSERT INTO rata_rata (ID_INDIKATOR,ID_SEKOLAH,ID_PERAN,RATA,KATEGORI) VALUES ';
    $sqlTotalKualitas =
        'INSERT INTO nilai_total_indikator (ID_INDIKATOR,ID_SEKOLAH,NILAI_TOTAL,KATEGORI) VALUES';
    $sqlTotalKepentingan =
        'INSERT INTO nilai_total_indikator (ID_INDIKATOR,ID_SEKOLAH,NILAI_TOTAL,KATEGORI) VALUES';
    foreach ($dataSekolah as $data) {
        $idSekolah = $data['ID_SEKOLAH'];
        foreach ($dataIndikator as $indikators) {
            $idIndikator = $indikators['ID_INDIKATOR'];
            $totalKualitas = query(
                "SELECT SUM(JAWABAN) AS TOTAL FROM (SELECT JAWABAN FROM (SELECT jawaban.ID_JAWABAN,jawaban.ID_PERTANYAAN,jawaban.ID_SEKOLAH,jawaban.JENIS_PERAN,jawaban.JAWABAN,pertanyaan.ID_INDIKATOR,sekolah.NAMA_SEKOLAH,peran.NAMA_PERAN FROM jawaban LEFT JOIN pertanyaan ON jawaban.ID_PERTANYAAN = pertanyaan.ID_PERTANYAAN LEFT JOIN sekolah ON jawaban.ID_SEKOLAH = sekolah.ID_SEKOLAH LEFT JOIN peran ON jawaban.JENIS_PERAN = peran.ID_PERAN WHERE JAWABAN.ID_SEKOLAH = '$idSekolah' AND pertanyaan.KATEGORI = 'KUALITAS') AS A WHERE ID_INDIKATOR = '$idIndikator' ) AS A"
            );
            $totalKepentingan = query(
                "SELECT SUM(JAWABAN) AS TOTAL FROM (SELECT JAWABAN FROM (SELECT jawaban.ID_JAWABAN,jawaban.ID_PERTANYAAN,jawaban.ID_SEKOLAH,jawaban.JENIS_PERAN,jawaban.JAWABAN,pertanyaan.ID_INDIKATOR,sekolah.NAMA_SEKOLAH,peran.NAMA_PERAN FROM jawaban LEFT JOIN pertanyaan ON jawaban.ID_PERTANYAAN = pertanyaan.ID_PERTANYAAN LEFT JOIN sekolah ON jawaban.ID_SEKOLAH = sekolah.ID_SEKOLAH LEFT JOIN peran ON jawaban.JENIS_PERAN = peran.ID_PERAN WHERE JAWABAN.ID_SEKOLAH = '$idSekolah' AND pertanyaan.KATEGORI = 'KEPENTINGAN') AS A WHERE ID_INDIKATOR = '$idIndikator' ) AS A"
            );
            foreach ($totalKualitas as $hasil) {
                $total = $hasil['TOTAL'];
                $sqlTotalKualitas .=
                    "('" .
                    $idIndikator .
                    "','" .
                    $idSekolah .
                    "','" .
                    $total .
                    "','KUALITAS'),";
            }
            foreach ($totalKepentingan as $hasil) {
                $total = $hasil['TOTAL'];
                $sqlTotalKepentingan .=
                    "('" .
                    $idIndikator .
                    "','" .
                    $idSekolah .
                    "','" .
                    $total .
                    "','KEPENTINGAN'),";
            }
            foreach ($dataPeran as $peran) {
                $idperan = $peran['JENIS_PERAN'];
                $AverageKualitas = query(
                    "SELECT AVG(JAWABAN) AS AVERAGE FROM (SELECT JAWABAN FROM (SELECT JAWABAN,JENIS_PERAN FROM (SELECT jawaban.ID_JAWABAN,jawaban.ID_PERTANYAAN,jawaban.ID_SEKOLAH,jawaban.JENIS_PERAN,jawaban.JAWABAN,pertanyaan.ID_INDIKATOR,sekolah.NAMA_SEKOLAH,peran.NAMA_PERAN FROM jawaban LEFT JOIN pertanyaan ON jawaban.ID_PERTANYAAN = pertanyaan.ID_PERTANYAAN LEFT JOIN sekolah ON jawaban.ID_SEKOLAH = sekolah.ID_SEKOLAH LEFT JOIN peran ON jawaban.JENIS_PERAN = peran.ID_PERAN WHERE JAWABAN.ID_SEKOLAH = '$idSekolah' AND pertanyaan.KATEGORI = 'KUALITAS') AS A WHERE ID_INDIKATOR = '$idIndikator') AS A WHERE JENIS_PERAN = '$idperan') AS A"
                );
                $AverageKepentingan = query(
                    "SELECT AVG(JAWABAN) AS AVERAGE FROM (SELECT JAWABAN FROM (SELECT JAWABAN,JENIS_PERAN FROM (SELECT jawaban.ID_JAWABAN,jawaban.ID_PERTANYAAN,jawaban.ID_SEKOLAH,jawaban.JENIS_PERAN,jawaban.JAWABAN,pertanyaan.ID_INDIKATOR,sekolah.NAMA_SEKOLAH,peran.NAMA_PERAN FROM jawaban LEFT JOIN pertanyaan ON jawaban.ID_PERTANYAAN = pertanyaan.ID_PERTANYAAN LEFT JOIN sekolah ON jawaban.ID_SEKOLAH = sekolah.ID_SEKOLAH LEFT JOIN peran ON jawaban.JENIS_PERAN = peran.ID_PERAN WHERE JAWABAN.ID_SEKOLAH = '$idSekolah' AND pertanyaan.KATEGORI = 'KEPENTINGAN') AS A WHERE ID_INDIKATOR = '$idIndikator') AS A WHERE JENIS_PERAN = '$idperan') AS A"
                );
                foreach ($AverageKualitas as $hasil) {
                    $rata = $hasil['AVERAGE'];
                    $sqlRataKualitas .=
                        "('" .
                        $idIndikator .
                        "','" .
                        $idSekolah .
                        "','" .
                        $idperan .
                        "','" .
                        $rata .
                        "','KUALITAS'),";
                }
                foreach ($AverageKepentingan as $hasil) {
                    $rata = $hasil['AVERAGE'];
                    $sqlRataKepentingan .=
                        "('" .
                        $idIndikator .
                        "','" .
                        $idSekolah .
                        "','" .
                        $idperan .
                        "','" .
                        $rata .
                        "','KEPENTINGAN'),";
                }
            }
        }
    }
    $sqlTotalKualitas = rtrim($sqlTotalKualitas, ', ');
    $sqlTotalKepentingan = rtrim($sqlTotalKepentingan, ', ');
    $sqlRataKualitas = rtrim($sqlRataKualitas, ', ');
    $sqlRataKepentingan = rtrim($sqlRataKepentingan, ', ');
    mysqli_query($conn, $sqlRataKualitas);
    mysqli_query($conn, $sqlRataKepentingan);
    mysqli_query($conn, $sqlTotalKualitas);
    mysqli_query($conn, $sqlTotalKepentingan);

    // menggabungkan nilai rata-rata indikator baik kualitas / kepentingan
    // rumusnya rata-rata tiap peran di jumlah kemudian dibagi 2
    $sqlKualitas =
        'INSERT INTO nilai_rata_indikator (ID_INDIKATOR,NILAI_RATA_RATA,ID_SEKOLAH,KATEGORI) VALUES ';
    $sqlKepentingan =
        'INSERT INTO nilai_rata_indikator (ID_INDIKATOR,NILAI_RATA_RATA,ID_SEKOLAH,KATEGORI) VALUES ';
    $jmlPeran = count($dataPeran);
    foreach ($dataSekolah as $a) {
        $idSekolah = $a['ID_SEKOLAH'];
        foreach ($dataIndikator as $a) {
            $indikator = $a['ID_INDIKATOR'];
            $QUERYKUALITAS = query(
                "SELECT RATA AS RATA FROM rata_rata WHERE rata_rata.KATEGORI = 'KUALITAS' AND ID_INDIKATOR = '$indikator' AND ID_SEKOLAH = '$idSekolah'"
            );
            $QUERYKEPENTINGAN = query(
                "SELECT RATA AS RATA FROM rata_rata WHERE rata_rata.KATEGORI = 'KEPENTINGAN' AND ID_INDIKATOR = '$indikator' AND ID_SEKOLAH = '$idSekolah'"
            );

            $dataKualitas = [];
            $hasilKualitas = [];
            foreach ($QUERYKUALITAS as $data) {
                array_push($dataKualitas, (float) $data['RATA']);
            }
            if (in_array(0, $dataKualitas)) {
                $hasil;
                foreach ($dataKualitas as $a) {
                    $hasil += $a;
                    array_push($hasilKualitas, $hasil);
                }
                $hasil = 0;
            } else {
                $perhitunganKualitas = 0;
                foreach ($dataKualitas as $a) {
                    global $perhitunganKualitas;
                    $perhitunganKualitas = $perhitunganKualitas + $a;
                    array_push(
                        $hasilKualitas,
                        $perhitunganKualitas / $jmlPeran
                    );
                }
                $perhitunganKualitas = 0;
            }
            $dataKepentingan = [];
            $hasilKepentingan = [];
            foreach ($QUERYKEPENTINGAN as $data) {
                array_push($dataKepentingan, (float) $data['RATA']);
            }
            if (in_array(0, $dataKepentingan)) {
                $hasil;
                foreach ($dataKepentingan as $a) {
                    $hasil += $a;
                    array_push($hasilKepentingan, $hasil);
                }
                $hasil = 0;
            } else {
                $hasil = 0;
                foreach ($dataKepentingan as $a) {
                    global $hasil;
                    $hasil = $hasil + $a;
                    array_push($hasilKepentingan, $hasil / $jmlPeran);
                }
                $hasil = 0;
            }
            $sqlKualitas .=
                "('" .
                $indikator .
                "','" .
                round($hasilKualitas[1], 2) .
                "','" .
                $idSekolah .
                "','KUALITAS'),";
            $sqlKepentingan .=
                "('" .
                $indikator .
                "','" .
                round($hasilKepentingan[1], 2) .
                "','" .
                $idSekolah .
                "','KEPENTINGAN'),";
        }
    }
    $sqlKualitas = rtrim($sqlKualitas, ', ');
    $sqlKepentingan = rtrim($sqlKepentingan, ', ');

    mysqli_query($conn, $sqlKualitas);
    mysqli_query($conn, $sqlKepentingan);

    // menghitung kesesuaian per indikator
    // rumus = total kualitas / total kepentingan x 100
    $sqlKesesuaian =
        'INSERT INTO tingkat_kesesuaian_indikator (ID_INDIKATOR,ID_SEKOLAH,NILAI) VALUES ';
    foreach ($dataSekolah as $a) {
        $idSekolah = $a['ID_SEKOLAH'];
        foreach ($dataIndikator as $a) {
            $indikator = $a['ID_INDIKATOR'];
            $QUERY = query(
                "SELECT NILAI_TOTAL FROM nilai_total_indikator WHERE ID_INDIKATOR = '$indikator' AND ID_SEKOLAH = '$idSekolah'"
            );
            $dataNilaiIndikator = [];
            $dataKesesuianIndikator = [];
            foreach ($QUERY as $data) {
                array_push($dataNilaiIndikator, (float) $data['NILAI_TOTAL']);
            }

            $hasil = 0;
            $index = 1;
            foreach ($dataNilaiIndikator as $a) {
                // cek kalau nilai masih 0 maka di inisiasi oleh value index 1
                if ($hasil == 0) {
                    $hasil = $a;
                } else {
                    // jika variabel hasil sudah di inisiasi kemudian di operasikan dengan value index 2
                    if ($index > 1) {
                        $hasil = ($hasil / $a) * 100;
                    }
                }
                array_push($dataKesesuianIndikator, $hasil);
                $index++;
            }
            $sqlKesesuaian .=
                "('" .
                $indikator .
                "','" .
                $idSekolah .
                "','" .
                round($dataKesesuianIndikator[1], 2) .
                "'),";
        }
    }
    $sqlKesesuaian = rtrim($sqlKesesuaian, ', ');

    mysqli_query($conn, $sqlKesesuaian);

    // menghitung Kesesuaian total
    // rumus = total rata - rata indikator kualitas / total rata - rata indikator kepentingan x 100
    $sqlKesesuaianTotal =
        'INSERT INTO `tingkat_kesesuaian_total`(`ID_SEKOLAH`, `NILAI`) VALUES ';
    foreach ($dataSekolah as $a) {
        $idSekolah = $a['ID_SEKOLAH'];
        $QUERYKUALITAS = query(
            "SELECT SUM(NILAI_RATA_RATA) AS RATA FROM nilai_rata_indikator WHERE ID_SEKOLAH = '$idSekolah' AND KATEGORI = 'KUALITAS'"
        );
        $QUERYKEPENTINGAN = query(
            "SELECT SUM(NILAI_RATA_RATA) AS RATA FROM nilai_rata_indikator WHERE ID_SEKOLAH = '$idSekolah' AND KATEGORI = 'KEPENTINGAN'"
        );
        $dataMerge = [];
        $dataMerge = array_merge($QUERYKUALITAS, $QUERYKEPENTINGAN);

        $dataTotalRataIndikator = [];
        $hasil = 0;
        $index = 1;
        foreach ($dataMerge as $a) {
            // cek kalau nilai masih 0 maka di inisiasi oleh value index 1
            if ($hasil == 0) {
                $hasil = (float) $a['RATA'];
            } else {
                // jika variabel hasil sudah di inisiasi kemudian di operasikan dengan value index 2
                if ($index > 1) {
                    $hasil = ($hasil / (float) $a['RATA']) * 100;
                }
            }
            array_push($dataTotalRataIndikator, $hasil);
            $index++;
        }
        $Kesesuaian = number_format($dataTotalRataIndikator[1], 2);
        $sqlKesesuaianTotal .= "('" . $idSekolah . "','" . $Kesesuaian . "'),";
    }
    $sqlKesesuaianTotal = rtrim($sqlKesesuaianTotal, ', ');

    mysqli_query($conn, $sqlKesesuaianTotal);

    // penentuan kuadran tiap indikator
    //  1. menentukan titik potong X untuk kualitas dan Y untuk kepentingan dengan rumus total rata - rata masing masing kategori / banyak indikator
    // 2. Penentuan kuadran tiap indikator dengan membandingkan rata - rata kualitas dengan X dan rata - rata kepentingan dengan Y
    // ketentuan kuadran :
    // *. jika rata - rata kualitas lebih kecil dari X dan rata - rata kepentingan lebih besar dari Y maka masuk kuadran PRIORITAS TINGGI
    // *. jika rata - rata kualitas lebih kecil dari X dan rata - rata kepentingan lebih kecil dari Y maka masuk kuadran PRIORITAS RENDAH
    // *. jika rata - rata kualitas lebih besar dari X dan rata - rata kepentingan lebih besar dari Y maka masuk kuadran PERTAHANKAN PRESTASI
    // *. jika rata - rata kualitas lebih besar dari X dan rata - rata kepentingan lebih kecil dari Y maka masuk kuadran BERLEBIHAN

    $sqlPenentuanKuadran =
        'INSERT INTO kuadran_indikator (ID_SEKOLAH,ID_INDIKATOR,KUADRAN) VALUES ';
    foreach ($dataSekolah as $sekolah) {
        $idSekolah = $sekolah['ID_SEKOLAH'];
        $dataMerge = [];
        $totalIndikatorKualitas = query(
            "SELECT SUM(NILAI_RATA_RATA) AS RATA FROM nilai_rata_indikator WHERE ID_SEKOLAH = '$idSekolah' AND KATEGORI = 'KUALITAS'"
        );
        $totalIndikatorKepentingan = query(
            "SELECT SUM(NILAI_RATA_RATA) AS RATA FROM nilai_rata_indikator WHERE ID_SEKOLAH = '$idSekolah' AND KATEGORI = 'KEPENTINGAN'"
        );

        $dataMerge = array_merge(
            $totalIndikatorKualitas,
            $totalIndikatorKepentingan
        );
        $xKualitas = 0;
        $xKepentingan = 0;
        $index = 1;
        $jmlIndikator = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                'SELECT COUNT(DISTINCT ID_INDIKATOR) AS TOTAL FROM pertanyaan'
            )
        );
        foreach ($dataMerge as $a) {
            if ($index == 1) {
                $xKualitas =
                    (float) $a['RATA'] / (float) $jmlIndikator['TOTAL'];
            } else {
                $xKepentingan =
                    (float) $a['RATA'] / (float) $jmlIndikator['TOTAL'];
            }
            $index++;
        }
        foreach ($dataIndikator as $indikator) {
            $idIndikator = $indikator['ID_INDIKATOR'];
            $dataKuadran = '';
            $dataKualitas = mysqli_fetch_assoc(
                mysqli_query(
                    $conn,
                    "SELECT NILAI_RATA_RATA FROM nilai_rata_indikator WHERE ID_SEKOLAH = '$idSekolah' AND KATEGORI = 'KUALITAS' AND ID_INDIKATOR = $idIndikator"
                )
            );
            $dataKepentingan = mysqli_fetch_assoc(
                mysqli_query(
                    $conn,
                    "SELECT NILAI_RATA_RATA FROM nilai_rata_indikator WHERE ID_SEKOLAH = '$idSekolah' AND KATEGORI = 'KEPENTINGAN' AND ID_INDIKATOR = $idIndikator"
                )
            );
            $kualitas = (float) $dataKualitas['NILAI_RATA_RATA'];
            $kepentingan = (float) $dataKepentingan['NILAI_RATA_RATA'];
            if ($kualitas < $xKualitas && $kepentingan > $xKepentingan) {
                $dataKuadran = 'PRIORITAS TINGGI';
            } elseif ($kualitas < $xKualitas && $kepentingan < $xKepentingan) {
                $dataKuadran = 'PRIORITAS RENDAH';
            } elseif ($kualitas > $xKualitas && $kepentingan > $xKepentingan) {
                $dataKuadran = 'PERTAHANKAN PRESTASI';
            } elseif ($kualitas > $xKualitas && $kepentingan < $xKepentingan) {
                $dataKuadran = 'BERLEBIHAN';
            }
            $sqlPenentuanKuadran .=
                "('" .
                $idSekolah .
                "','" .
                $idIndikator .
                "','" .
                $dataKuadran .
                "'),";
        }
    }
    $sqlPenentuanKuadran = rtrim($sqlPenentuanKuadran, ', ');

    mysqli_query($conn, $sqlPenentuanKuadran);

    // SAW
    // normalisasi matrix
    $sqlNormalisasi =
        'INSERT INTO normalisasi_matrix (ID_INDIKATOR,ID_SEKOLAH,NILAI) VALUES ';
    foreach ($dataSekolah as $a) {
        $idSekolah = $a['ID_SEKOLAH'];
        foreach ($dataIndikator as $a) {
            $idIndikator = $a['ID_INDIKATOR'];
            $atributIndikator = '';
            $valueIndikator = 0;
            $normalisasi = 0;
            $resultAtribut = mysqli_fetch_assoc(
                mysqli_query(
                    $conn,
                    "SELECT indikator.ATRIBUT FROM indikator WHERE indikator.ID_INDIKATOR = $idIndikator "
                )
            );
            $atributIndikator = $resultAtribut['ATRIBUT'];
            if ($atributIndikator == 'BENEFIT') {
                $valueMax = mysqli_fetch_assoc(
                    mysqli_query(
                        $conn,
                        "SELECT MAX(NILAI_RATA_RATA) AS MAX FROM nilai_rata_indikator WHERE nilai_rata_indikator.ID_INDIKATOR = $idIndikator AND KATEGORI = 'KUALITAS' "
                    )
                );
                $valueIndikator = $valueMax['MAX'];
            } else {
                $valueMin = mysqli_fetch_assoc(
                    mysqli_query(
                        $conn,
                        "SELECT MIN(NILAI_RATA_RATA) AS MIN FROM nilai_rata_indikator WHERE nilai_rata_indikator.ID_INDIKATOR = $idIndikator AND KATEGORI = 'KUALITAS' "
                    )
                );
                $valueIndikator = $valueMin['MIN'];
            }
            $resultRataIndikator = mysqli_fetch_assoc(
                mysqli_query(
                    $conn,
                    "SELECT NILAI_RATA_RATA FROM nilai_rata_indikator WHERE ID_INDIKATOR = $idIndikator AND ID_SEKOLAH = '$idSekolah' AND KATEGORI = 'KUALITAS' "
                )
            );
            $normalisasi =
                (float) $resultRataIndikator['NILAI_RATA_RATA'] /
                $valueIndikator;
            $sqlNormalisasi .=
                "('" .
                $idIndikator .
                "','" .
                $idSekolah .
                "','" .
                $normalisasi .
                "'),";
        }
    }
    $sqlNormalisasi = rtrim($sqlNormalisasi, ', ');
    mysqli_query($conn, $sqlNormalisasi);

    // mencari nilai preferensi
    $sqlPreferensi =
        'INSERT INTO nilai_preferensi (ID_INDIKATOR,ID_SEKOLAH,NILAI) VALUES ';
    foreach ($dataSekolah as $a) {
        $idSekolah = $a['ID_SEKOLAH'];
        foreach ($dataIndikator as $a) {
            $idIndikator = $a['ID_INDIKATOR'];
            $bobotIndikator = 0;
            $nilaiPreferensi = 0;
            $resultAtribut = mysqli_fetch_assoc(
                mysqli_query(
                    $conn,
                    "SELECT indikator.BOBOT FROM indikator WHERE indikator.ID_INDIKATOR = $idIndikator "
                )
            );
            $bobotIndikator = (float) $resultAtribut['BOBOT'];
            $resultNormalisasi = mysqli_fetch_assoc(
                mysqli_query(
                    $conn,
                    "SELECT NILAI FROM normalisasi_matrix WHERE ID_INDIKATOR = $idIndikator AND ID_SEKOLAH = $idSekolah "
                )
            );
            $nilaiPreferensi =
                (float) $resultNormalisasi['NILAI'] * $bobotIndikator;
            $sqlPreferensi .=
                "('" .
                $idIndikator .
                "','" .
                $idSekolah .
                "','" .
                $nilaiPreferensi .
                "'),";
        }
    }
    $sqlPreferensi = rtrim($sqlPreferensi, ', ');

    mysqli_query($conn, $sqlPreferensi);

    // Perangkingan Sekolah
    $sqlPerangkingan =
        'INSERT INTO perangkingan_sekolah (ID_SEKOLAH,NILAI) VALUES ';
    $dataIdSekolah = [];
    foreach ($dataSekolah as $a) {
        $idSekolah = $a['ID_SEKOLAH'];
        $jmlTotalPreferensi = 0;
        $totalPreferensi = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT SUM(NILAI) AS TOTAL FROM nilai_preferensi WHERE ID_SEKOLAH = $idSekolah "
            )
        );
        $jmlTotalPreferensi = $totalPreferensi['TOTAL'];
        $sqlPerangkingan .=
            "('" . $idSekolah . "','" . round($jmlTotalPreferensi, 2) . "'),";
        array_push($dataIdSekolah, $idSekolah);
    }
    $sqlPerangkingan = rtrim($sqlPerangkingan, ', ');

    mysqli_query($conn, $sqlPerangkingan);
    // mysqli_query($conn, 'DELETE FROM jawaban');
}
function buatRiwayat()
{
    // global $conn;
    // mysqli_query($conn, 'DELETE FROM log_kuadran_indikator');
    // mysqli_query($conn, 'DELETE FROM log_tingkat_kesesuaian_indikator');
    // mysqli_query($conn, 'DELETE FROM log_jawaban');
    // mysqli_query($conn, 'INSERT INTO log_jawaban SELECT * FROM jawaban');
    // mysqli_query(
    //     $conn,
    //     'INSERT INTO log_kuadran_indikator SELECT * FROM kuadran_indikator'
    // );
    // mysqli_query(
    //     $conn,
    //     'INSERT INTO log_tingkat_kesesuaian_indikator SELECT * FROM tingkat_kesesuaian_indikator'
    // );
    // mysqli_query(
    //     $conn,
    //     'INSERT INTO log_tingkat_kesesuaian_total SELECT * FROM tingkat_kesesuaian_total'
    // );
    // mysqli_query($conn, 'DELETE FROM kuadran_indikator');
    // mysqli_query($conn, 'DELETE FROM tingkat_kesesuaian_indikator');
    // mysqli_query($conn, 'DELETE FROM tingkat_kesesuaian_total');
    // mysqli_query($conn, 'DELETE FROM rata_rata');
    // mysqli_query($conn, 'DELETE FROM perangkingan_sekolah');
    // mysqli_query($conn, 'DELETE FROM normalisasi_matrix');
    // mysqli_query($conn, 'DELETE FROM nilai_rata_indikator');
    // mysqli_query($conn, 'DELETE FROM nilai_preferensi');
}

function login($data)
{
    global $conn;
    $username = $data['username'];
    $password = $data['password'];

    $hasil = query(
        "SELECT * FROM admin WHERE USERNAME = '$username' AND PASSWORD = '$password' "
    );

    if ($hasil != null) {
        $_SESSION['id'] = '1';
        header('location: index.php');
        exit();
    } else {
        echo "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        
        alert('Username / Password Salah !!');
        </script>
        
        ";
    }
}
function putKunci()
{
    global $conn;
    $dataKunci = rand(1, 1000);
    mysqli_query(
        $conn,
        "INSERT INTO kunci (ID_KUNCI,VALUE) VALUES ('',$dataKunci)"
    );
}
function logout()
{
    $_SESSION['id'] = '0';
    header('location: login.php');
}
?>