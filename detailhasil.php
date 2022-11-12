<?php
session_start();
require './functions.php';
if ($_SESSION['id'] != '1') {
    header('location: login.php');
    exit();
} else {
    $idSekolah = $_GET['id'];
}
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
    <style>
    .rata-rata-indikator h2,
    .kesesuaian-indikator h2 {
        font-size: 18px;
        margin-bottom: 10px;
    }
    </style>
    <title>DETAIL HASIL SEKOLAH</title>
</head>

<body>
    <div id="wrapper">
        <div class="sidebar">
            <?php require './sidebar.php'; ?>

        </div>
        <div class="main" id="kelola_pertanyaan">
            <!-- As a heading -->
            <div class="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col col-10">
                            <nav class="navbar navbar-light bg-light">
                                <h1 class="navbar-brand mb-0">
                                    DETAIL HASIL SEKOLAH
                                </h1>
                            </nav>
                            <span>SISTEM PENGUKURAN KUALITAS BLENDED LEARNING</span>
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
                    <?php
                    $dataKesesuaianTotal = query(
                        "SELECT sekolah.NAMA_SEKOLAH,tingkat_kesesuaian_total.NILAI,tingkat_kesesuaian_total.ID_SEKOLAH FROM tingkat_kesesuaian_total LEFT JOIN sekolah ON tingkat_kesesuaian_total.ID_SEKOLAH = sekolah.ID_SEKOLAH WHERE sekolah.ID_SEKOLAH = $idSekolah"
                    );
                    foreach ($dataKesesuaianTotal as $data):

                        $nilai = $data['NILAI'];
                        $idSekolah = $data['ID_SEKOLAH'];
                        $kategori;
                        if ($nilai > 84) {
                            $kategori = 'SANGAT BAIK';
                        } elseif ($nilai >= 69 && $nilai <= 83) {
                            $kategori = 'BAIK';
                        } elseif ($nilai >= 53 && $nilai <= 68) {
                            $kategori = 'CUKUP BAIK';
                        } elseif ($nilai >= 37 && $nilai <= 52) {
                            $kategori = 'TIDAK BAIK';
                        } else {
                            $kategori = 'SANGAT TIDAK BAIK';
                        }
                        ?>
                    <h2 class="brand-title">
                        <?= $data['NAMA_SEKOLAH'] ?>
                    </h2>
                    <h2 class="brand-title">
                        <div class="text-success"><?= $kategori ?></div>
                    </h2>
                    <?php
                    $riwayat = mysqli_fetch_assoc(
                        mysqli_query(
                            $conn,
                            "SELECT * FROM log_tingkat_kesesuaian_total WHERE ID_SEKOLAH = $idSekolah "
                        )
                    );
                    if ($riwayat == null) {
                        echo '
                        <h2 class="brand-title">Belum Ada Riwayat</h2>
                        ';
                    } else {
                        echo '
                        <a href="riwayatSekolah.php?id=' .
                            $idSekolah .
                            '" style="text-decoration: none;">
                    <h2 class="brand-title">Riwayat</h2>
                    </a>
                    ';
                    }

                    endforeach;
                    ?>
                </div>
                <div class="grafik-indikator">
                    <div class="row">
                        <div class="col col-12">
                            <canvas id="myChart" style="width: 100%; height: 70vh"></canvas>
                        </div>
                    </div>
                </div>
                <div class="rata-rata-indikator mt-5">
                    <div class="row">
                        <div class="col col-6">
                            <h2>KUALITAS</h2>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">NO</th>
                                        <th scope="col" class="text-center">INDIKATOR</th>
                                        <th scope="col" class="text-center">NILAI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dataKualitas = query(
                                        "SELECT nilai_rata_indikator.ID_INDIKATOR,indikator.NAMA_INDIKATOR,nilai_rata_indikator.NILAI_RATA_RATA FROM nilai_rata_indikator LEFT JOIN indikator ON nilai_rata_indikator.ID_INDIKATOR = indikator.ID_INDIKATOR WHERE nilai_rata_indikator.ID_SEKOLAH = '$idSekolah' AND nilai_rata_indikator.KATEGORI = 'KUALITAS'"
                                    );
                                    $index = 1;
                                    foreach ($dataKualitas as $data): ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $index++ ?></td>
                                        <td class="text-center"><?= $data[
                                            'NAMA_INDIKATOR'
                                        ] ?></td>
                                        <td class="text-center"><?= $data[
                                            'NILAI_RATA_RATA'
                                        ] ?></td>
                                    </tr>
                                    <?php endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col col-6">
                            <h2>KEPENTINGAN</h2>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">NO</th>
                                        <th scope="col" class="text-center">INDIKATOR</th>
                                        <th scope="col" class="text-center">NILAI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dataKepentingan = query(
                                        "SELECT nilai_rata_indikator.ID_INDIKATOR,indikator.NAMA_INDIKATOR,nilai_rata_indikator.NILAI_RATA_RATA FROM nilai_rata_indikator LEFT JOIN indikator ON nilai_rata_indikator.ID_INDIKATOR = indikator.ID_INDIKATOR WHERE nilai_rata_indikator.ID_SEKOLAH = '$idSekolah' AND nilai_rata_indikator.KATEGORI = 'KEPENTINGAN'"
                                    );
                                    $index = 1;
                                    foreach ($dataKepentingan as $data): ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $index++ ?></td>
                                        <td class="text-center"><?= $data[
                                            'NAMA_INDIKATOR'
                                        ] ?></td>
                                        <td class="text-center"><?= $data[
                                            'NILAI_RATA_RATA'
                                        ] ?></td>
                                    </tr>
                                    <?php endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="kesesuaian-indikator mt-3">
                    <div class="row">
                        <div class="col col-12">
                            <h2>KUADRAN PRIORITAS INDIKATOR</h2>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">NO</th>
                                        <th scope="col" class="text-center">INDIKATOR</th>
                                        <th scope="col" class="text-center">KUADRAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dataKuadran = query(
                                        "SELECT kuadran_indikator.ID_INDIKATOR,kuadran_indikator.KUADRAN,indikator.NAMA_INDIKATOR FROM kuadran_indikator LEFT JOIN indikator ON kuadran_indikator.ID_INDIKATOR = indikator.ID_INDIKATOR WHERE kuadran_indikator.ID_SEKOLAH = $idSekolah"
                                    );
                                    $index = 1;
                                    foreach ($dataKuadran as $data):

                                        $kuadran = $data['KUADRAN'];
                                        $color = '';
                                        if ($kuadran == 'PRIORITAS TINGGI') {
                                            $color = 'red';
                                        } elseif (
                                            $kuadran == 'PERTAHANKAN PRESTASI'
                                        ) {
                                            $color = 'green';
                                        } elseif (
                                            $kuadran == 'PRIORITAS RENDAH'
                                        ) {
                                            $color = 'orange';
                                        } else {
                                            $color = 'blue';
                                        }
                                        ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $index++ ?></td>
                                        <td class="text-center"><?= $data[
                                            'NAMA_INDIKATOR'
                                        ] ?></td>
                                        <td class="text-center" style="color: <?= $color ?>; font-weight:bold;"><?= $data[
    'KUADRAN'
] ?></td>
                                    </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <footer class="mt-auto footer text-center">
                    SIPEKU Sistem Pengukuran Kualitas &copy; 2022
                </footer>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
    let urlString = window.location.href;
    let url = new URL(urlString);
    let dataid = url.searchParams.get("id");
    let formData = new FormData();
    formData.append("id", dataid);
    fetch("dataKesesuaianIndikator.php", {
        method: "POST",
        body: formData
    }).then(response => {
        return response.json()
    }).then(responseJson => {
        let labels = [];
        let nilai = [];
        let rgbaBackground = [];
        let rgbBorder = [];
        const randomBetween = (min, max) => min + Math.floor(Math.random() * (max - min + 1));
        responseJson.map(data => {
            labels.push(data.NAMA_INDIKATOR);
            nilai.push(data.NILAI);
            let r = randomBetween(0, 255);
            let g = randomBetween(0, 255);
            let b = randomBetween(0, 255);
            let a = '0.4'
            let rgbaValue = `rgba(${r},${g},${b},${a})`
            let rgbValue = `rgba(${r},${g},${b})`
            rgbaBackground.push(rgbaValue);
            rgbBorder.push(rgbValue);
        })
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tingkat Kesesuaian Indikator',
                    data: nilai,
                    backgroundColor: rgbaBackground,
                    borderColor: rgbBorder,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    </script>
</body>

</html>