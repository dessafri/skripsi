<?php
require './functions.php';

$dataSekolah = query('SELECT DISTINCT ID_SEKOLAH FROM jawaban');
$dataIndikator = query(
    'SELECT DISTINCT pertanyaan.ID_INDIKATOR FROM pertanyaan LEFT JOIN jawaban ON jawaban.ID_PERTANYAAN = pertanyaan.ID_PERTANYAAN'
);
$dataPeran = query('SELECT DISTINCT JENIS_PERAN FROM jawaban');
// perhitungan awal mencari nilai rata - rata indikator per peran
$sqlRataKualitas =
    'INSERT INTO rata_rata (ID_INDIKATOR,ID_SEKOLAH,ID_PERAN,RATA,KATEGORI) VALUES ';
$sqlRataKepentingan =
    'INSERT INTO rata_rata (ID_INDIKATOR,ID_SEKOLAH,ID_PERAN,RATA,KATEGORI) VALUES ';
foreach ($dataSekolah as $data) {
    $idSekolah = $data['ID_SEKOLAH'];
    foreach ($dataIndikator as $indikators) {
        $idIndikator = $indikators['ID_INDIKATOR'];
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
$sqlRataKualitas = rtrim($sqlRataKualitas, ', ');
$sqlRataKepentingan = rtrim($sqlRataKepentingan, ', ');
mysqli_query($conn, $sqlRataKualitas);
mysqli_query($conn, $sqlRataKepentingan);

// menggabungkan nilai rata-rata indikator
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
                array_push($hasilKualitas, $perhitunganKualitas / $jmlPeran);
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
            $hasilKualitas[1] .
            "','" .
            $idSekolah .
            "','KUALITAS'),";
        $sqlKepentingan .=
            "('" .
            $indikator .
            "','" .
            $hasilKepentingan[1] .
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
$sqlKesesuaian =
    'INSERT INTO tingkat_kesesuaian_indikator (ID_INDIKATOR,ID_SEKOLAH,NILAI) VALUES ';
foreach ($dataSekolah as $a) {
    $idSekolah = $a['ID_SEKOLAH'];
    foreach ($dataIndikator as $a) {
        $indikator = $a['ID_INDIKATOR'];
        $QUERY = query(
            "SELECT NILAI_RATA_RATA FROM nilai_rata_indikator WHERE ID_INDIKATOR = '$indikator' AND ID_SEKOLAH = '$idSekolah'"
        );
        $dataNilaiIndikator = [];
        $dataKesesuianIndikator = [];
        foreach ($QUERY as $data) {
            array_push($dataNilaiIndikator, (float) $data['NILAI_RATA_RATA']);
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
            $dataKesesuianIndikator[1] .
            "'),";
    }
}
$sqlKesesuaian = rtrim($sqlKesesuaian, ', ');

mysqli_query($conn, $sqlKesesuaian);

// menghitung Kesesuaian total
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
    $xKualitas;
    $yKepentingan;
    $index = 1;
    foreach ($dataMerge as $a) {
        if ($index == 1) {
            $xKualitas = (float) $a['RATA'] / 3;
        } else {
            $xKepentingan = (float) $a['RATA'] / 3;
        }
        $index++;
    }
    foreach ($dataIndikator as $indikator) {
        $idIndikator = $indikator['ID_INDIKATOR'];
        $dataKuadran;
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/style/main.css" />
    <title>Kelola HASIL</title>
</head>

<body>
    <div id="wrapper">
        <div class="sidebar">
            <ul class="navbar-nav" id="accordionSidebar">
                <a href="index.html" class="d-flex align-items-center justify-content-center">
                    <div class="container sidebar-title mt-2 mb-5 text-left">
                        <span>SIPEKU</span>
                    </div>
                </a>
                <li class="nav-item">
                    <a class="nav-link sidebar-text" href="index.html">
                        <span>Dashboard</span>
                    </a>
                </li>
                <hr class="sidebar-bagi" />
                <li class="nav-item">
                    <a class="nav-link sidebar-text" href="kuesioner.html">
                        <span>Kelola Kuesioner</span>
                    </a>
                </li>
                <hr class="sidebar-bagi" />
                <li class="nav-item">
                    <a class="nav-link sidebar-text" href="pertanyaan.html">
                        <span>Kelola Pertanyaan</span>
                    </a>
                </li>
                <hr class="sidebar-bagi" />
                <li class="nav-item">
                    <a class="nav-link sidebar-text" href="indikator.html">
                        <span>Kelola Indikator</span>
                    </a>
                </li>
                <hr class="sidebar-bagi" />
                <li class="nav-item active">
                    <a class="nav-link sidebar-text" href="hasil.html">
                        <span>Kelola Hasil</span>
                    </a>
                </li>
                <hr class="sidebar-bagi" />
                <li class="nav-item">
                    <a class="nav-link sidebar-text" href="kategori.html">
                        <span>Kelola Kategori</span>
                    </a>
                </li>
                <hr class="sidebar-bagi" />
                <li class="nav-item">
                    <a class="nav-link sidebar-text" href="peran.html">
                        <span>Kelola Peran</span>
                    </a>
                </li>
                <hr class="sidebar-bagi" />
                <li class="nav-item">
                    <a class="nav-link sidebar-text" href="sekolah.html">
                        <span>Kelola Sekolah</span>
                    </a>
                </li>
                <hr class="sidebar-bagi" />
            </ul>
        </div>
        <div class="main" id="kelola_pertanyaan">
            <!-- As a heading -->
            <div class="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col col-10">
                            <nav class="navbar navbar-light bg-light">
                                <h1 class="navbar-brand mb-0">
                                    KELOLA HASIL
                                </h1>
                            </nav>
                            <span>SISTEM PENGUKURAN KUALITAS BLENDED LEARNING</span>
                        </div>
                        <div class="col col-2">
                            <button class="btn btn-danger float-right">
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div style="
              display: flex;
              justify-content: space-between;
              margin-top: 30px;
              margin-bottom: 20px;
            ">
                    <h2 class="brand-title">
                        DAFTAR PERANGKINGAN SEKOLAH
                    </h2>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">NO</th>
                            <th scope="col" class="text-center">NAMA SEKOLAH</th>
                            <th scope="col" class="text-center">KATEGORI</th>
                            <th scope="col" class="text-center">NILAI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">
                                SMA NEGERI 1 LAMONGAN
                            </td>
                            <td class="text-center">SANGAT BAIK</td>
                            <td class="text-center">98,5</td>
                        </tr>
                    </tbody>
                </table>
                <p style="font-size: 14px; opacity: 0.6; margin-bottom: -2px;">
                    NILAI KATEGORI
                </p>
                <span style="display: inline-block; font-size: 12px; opacity: 0.6;">
                    20 - 36 SANGAT TIDAK BAIK
                </span>
                <br />
                <span style="display: inline-block; font-size: 12px; opacity: 0.6;">
                    37 - 52 TIDAK BAIK
                </span>
                <br />
                <span style="display: inline-block; font-size: 12px; opacity: 0.6;">
                    53 - 68 CUKUP BAIK
                </span>
                <br />
                <span style="display: inline-block; font-size: 12px; opacity: 0.6;">
                    69 - 84 BAIK
                </span>
                <br />
                <span style="display: inline-block; font-size: 12px; opacity: 0.6;">
                    85 - 100 SANGAT BAIK
                </span>
            </div>
            <div class="footer fixed-bottom">
                <p class="text-center">
                    SIPEKU Sistem Pengukuran Kualitas &copy; 2022
                </p>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
        integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>