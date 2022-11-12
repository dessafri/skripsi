<?php
session_start();
require './functions.php';
if ($_SESSION['id'] != '1') {
    header('location: login.php');
    exit();
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
    .rataKinerjaIndikator h2,
    .normalisasiMatrix h2,
    .nilaiPreferensi h2,
    .totalNilaiPreferensi h2 {
        font-size: 18px;
        margin-bottom: 10px;
    }
    </style>
    <title>PERANGKINGAN</title>
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
                                    PERHITUNGAN PERANGKINGAN
                                </h1>
                            </nav>
                            <span>SISTEM PENGUKURAN KUALITAS BLENDED LEARNING</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="grafik-indikator mt-4">
                    <div class="row">
                        <div class="col col-12">
                            <canvas id="myChart" style="width: 100%; height: 50vh"></canvas>
                        </div>
                    </div>
                </div>
                <div class="rataKinerjaIndikator mt-5">
                    <h2>Rata-rata kinerja indikator</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Sekolah</th>
                                <?php $totalIndikator = query(
                                    'SELECT indikator.NAMA_INDIKATOR FROM indikator INNER JOIN (SELECT DISTINCT ID_INDIKATOR FROM nilai_rata_indikator) as a ON indikator.ID_INDIKATOR = A.ID_INDIKATOR'
                                ); ?>
                                <?php
                                $index = 1;
                                foreach ($totalIndikator as $data): ?>
                                <th scope="col">C <?= $index ?></th>
                                <?php $index++;endforeach;
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $dataSekolah = query(
                                'SELECT DISTINCT sekolah.NAMA_SEKOLAH, sekolah.ID_SEKOLAH FROM sekolah INNER JOIN nilai_rata_indikator ON sekolah.ID_SEKOLAH = nilai_rata_indikator.ID_SEKOLAH'
                            ); ?>
                            <?php
                            $index = 1;
                            foreach ($dataSekolah as $data): ?>
                            <tr>
                                <td><?= $index++ ?></td>
                                <td><?= $data['NAMA_SEKOLAH'] ?></td>
                                <?php
                                $idSekolah = $data['ID_SEKOLAH'];
                                $dataIndikator = query(
                                    "SELECT indikator.NAMA_INDIKATOR, nilai_rata_indikator.NILAI_RATA_RATA FROM nilai_rata_indikator INNER JOIN indikator ON indikator.ID_INDIKATOR = nilai_rata_indikator.ID_INDIKATOR WHERE nilai_rata_indikator.ID_SEKOLAH = $idSekolah AND KATEGORI = 'KUALITAS'"
                                );
                                foreach ($dataIndikator as $indikator) {
                                    echo '<td>' .
                                        $indikator['NILAI_RATA_RATA'] .
                                        '</td>';
                                }
                                ?>
                            </tr>
                            <?php endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="normalisasiMatrix mt-5">
                    <h2>Normalisasi Matrix</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Sekolah</th>
                                <?php $totalIndikator = query(
                                    'SELECT indikator.NAMA_INDIKATOR FROM indikator INNER JOIN (SELECT DISTINCT ID_INDIKATOR FROM nilai_rata_indikator) as a ON indikator.ID_INDIKATOR = A.ID_INDIKATOR'
                                ); ?>
                                <?php
                                $index = 1;
                                foreach ($totalIndikator as $data): ?>
                                <th scope="col">C <?= $index ?></th>
                                <?php $index++;endforeach;
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $dataSekolah = query(
                                'SELECT DISTINCT sekolah.NAMA_SEKOLAH, sekolah.ID_SEKOLAH FROM sekolah INNER JOIN nilai_rata_indikator ON sekolah.ID_SEKOLAH = nilai_rata_indikator.ID_SEKOLAH'
                            ); ?>
                            <?php
                            $index = 1;
                            foreach ($dataSekolah as $data): ?>
                            <tr>
                                <td><?= $index++ ?></td>
                                <td><?= $data['NAMA_SEKOLAH'] ?></td>
                                <?php
                                $idSekolah = $data['ID_SEKOLAH'];
                                $dataIndikator = query(
                                    "SELECT indikator.NAMA_INDIKATOR, normalisasi_matrix.NILAI FROM normalisasi_matrix INNER JOIN indikator ON indikator.ID_INDIKATOR = normalisasi_matrix.ID_INDIKATOR WHERE normalisasi_matrix.ID_SEKOLAH = $idSekolah"
                                );
                                foreach ($dataIndikator as $indikator) {
                                    echo '<td>' .
                                        round($indikator['NILAI'], 2) .
                                        '</td>';
                                }
                                ?>
                            </tr>
                            <?php endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="nilaiPreferensi mt-5" style="width:100%;">
                    <h2>Nilai Preferensi V</h2>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Sekolah</th>
                                <?php $totalIndikator = query(
                                    'SELECT indikator.NAMA_INDIKATOR FROM indikator INNER JOIN (SELECT DISTINCT ID_INDIKATOR FROM nilai_rata_indikator) as a ON indikator.ID_INDIKATOR = A.ID_INDIKATOR'
                                ); ?>
                                <?php
                                $index = 1;
                                foreach ($totalIndikator as $data): ?>
                                <th scope="col">C <?= $index ?></th>
                                <?php $index++;endforeach;
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $dataSekolah = query(
                                'SELECT DISTINCT sekolah.NAMA_SEKOLAH, sekolah.ID_SEKOLAH FROM sekolah INNER JOIN nilai_rata_indikator ON sekolah.ID_SEKOLAH = nilai_rata_indikator.ID_SEKOLAH'
                            ); ?>
                            <?php
                            $index = 1;
                            foreach ($dataSekolah as $data): ?>
                            <tr>
                                <td><?= $index++ ?></td>
                                <td><?= $data['NAMA_SEKOLAH'] ?></td>
                                <?php
                                $idSekolah = $data['ID_SEKOLAH'];
                                $dataIndikator = query(
                                    "SELECT indikator.NAMA_INDIKATOR, nilai_preferensi.NILAI FROM nilai_preferensi INNER JOIN indikator ON indikator.ID_INDIKATOR = nilai_preferensi.ID_INDIKATOR WHERE nilai_preferensi.ID_SEKOLAH = $idSekolah"
                                );
                                foreach ($dataIndikator as $indikator) {
                                    echo '<td>' . $indikator['NILAI'],
                                        2 . '</td>';
                                }
                                ?>
                            </tr>
                            <?php endforeach;
                            ?>
                        </tbody>
                    </table>

                </div>
                <div class="totalNilaiPreferensi mt-5">
                    <h2 class="text-center mb-3">Total Nilai Prefensi tiap Sekolah</h2>
                    <div class="tabel row d-flex justify-content-center">
                        <table class="table table-bordered col col-4">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Nama Sekolah</th>
                                    <th scope="col" class="text-center">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataperangkingan = query(
                                    'SELECT sekolah.ID_SEKOLAH,sekolah.NAMA_SEKOLAH,tingkat_kesesuaian_total.NILAI,perangkingan_sekolah.NILAI as NILAI_RANGKING FROM perangkingan_sekolah LEFT JOIN tingkat_kesesuaian_total ON perangkingan_sekolah.ID_SEKOLAH = tingkat_kesesuaian_total.ID_SEKOLAH LEFT JOIN sekolah ON perangkingan_sekolah.ID_SEKOLAH = sekolah.ID_SEKOLAH'
                                );
                                $index = 1;
                                foreach ($dataperangkingan as $data): ?>
                                <tr>
                                    <td class="text-center"><?= $index++ ?></td>
                                    <td class="text-center"><?= $data[
                                        'NAMA_SEKOLAH'
                                    ] ?></td>
                                    <td class="text-center"><?= $data[
                                        'NILAI_RANGKING'
                                    ] ?></td>
                                </tr>
                                <?php endforeach;
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
    fetch("dataRangking.php", {
        method: "POST",
        body: formData
    }).then(response => {
        return response.json()
    }).then(responseJson => {
        console.log(responseJson)
        let labels = [];
        let nilai = [];
        let rgbaBackground = [];
        let rgbBorder = [];
        const randomBetween = (min, max) => min + Math.floor(Math.random() * (max - min + 1));
        responseJson.map(data => {
            labels.push(data.NAMA_SEKOLAH);
            nilai.push(data.NILAI_RANGKING);
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
                    label: 'Perangkingan Sekolah',
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