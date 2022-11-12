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
                                    RIWAYAT HASIL SEKOLAH
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
                    <?php $dataKesesuaianTotal = query(
                        "SELECT sekolah.NAMA_SEKOLAH,tingkat_kesesuaian_total.NILAI,tingkat_kesesuaian_total.ID_SEKOLAH FROM tingkat_kesesuaian_total LEFT JOIN sekolah ON tingkat_kesesuaian_total.ID_SEKOLAH = sekolah.ID_SEKOLAH WHERE sekolah.ID_SEKOLAH = $idSekolah"
                    ); ?>
                    <h2 class="brand-title">
                        <?= $dataKesesuaianTotal[0]['NAMA_SEKOLAH'] ?>
                    </h2>
                </div>
                <div class="kesesuaian-indikator mt-3">
                    <div class="row">
                        <div class="col col-12">
                            <p style="font-weight: bold;">RIWAYAT TINGKAT KESESUAIAN INDIKATOR</p>
                            <div class="row">
                                <div class="col col-6">
                                    <span>HASIL TERBARU</span>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">NO</th>
                                                <th scope="col" class="text-center">NILAI</th>
                                                <th scope="col" class="text-center">KUADRAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $index = 1;
                                            foreach (
                                                $dataKesesuaianTotal
                                                as $data
                                            ):

                                                $nilai = $data['NILAI'];
                                                $idSekolah =
                                                    $data['ID_SEKOLAH'];
                                                $kategori;
                                                if ($nilai > 85) {
                                                    $kategori = 'SANGAT BAIK';
                                                } elseif (
                                                    $nilai >= 69 &&
                                                    $nilai <= 84
                                                ) {
                                                    $kategori = 'BAIK';
                                                } elseif (
                                                    $nili >= 53 &&
                                                    $nilai <= 68
                                                ) {
                                                    $kategori = 'CUKUP BAIK';
                                                } elseif (
                                                    $nilai >= 37 &&
                                                    $nilai <= 52
                                                ) {
                                                    $kategori = 'TIDAK BAIK';
                                                } else {
                                                    $kategori =
                                                        'SANGAT TIDAK BAIK';
                                                }
                                                ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?= $index++ ?></td>
                                                <td class="text-center"><?= $nilai ?></td>
                                                <td class="text-center"><?= $kategori ?></td>
                                            </tr>
                                            <?php
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12">
                            <div class="row">
                                <div class="col col-6">
                                    <span>HASIL SEBELUMNYA</span>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">NO</th>
                                                <th scope="col" class="text-center">NILAI</th>
                                                <th scope="col" class="text-center">KUADRAN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $dataRiwayatKesesuaianTotal = query(
                                                "SELECT sekolah.NAMA_SEKOLAH,log_tingkat_kesesuaian_total.NILAI,log_tingkat_kesesuaian_total.ID_SEKOLAH FROM log_tingkat_kesesuaian_total LEFT JOIN sekolah ON log_tingkat_kesesuaian_total.ID_SEKOLAH = sekolah.ID_SEKOLAH WHERE sekolah.ID_SEKOLAH = $idSekolah ORDER BY log_tingkat_kesesuaian_total.ID_LOG_KESESUAIAN_TOTAL DESC"
                                            );
                                            $index = 1;
                                            foreach (
                                                $dataRiwayatKesesuaianTotal
                                                as $data
                                            ):

                                                $nilai = $data['NILAI'];
                                                $idSekolah =
                                                    $data['ID_SEKOLAH'];
                                                $kategori;
                                                if ($nilai > 85) {
                                                    $kategori = 'SANGAT BAIK';
                                                } elseif (
                                                    $nilai >= 69 &&
                                                    $nilai <= 84
                                                ) {
                                                    $kategori = 'BAIK';
                                                } elseif (
                                                    $nili >= 53 &&
                                                    $nilai <= 68
                                                ) {
                                                    $kategori = 'CUKUP BAIK';
                                                } elseif (
                                                    $nilai >= 37 &&
                                                    $nilai <= 52
                                                ) {
                                                    $kategori = 'TIDAK BAIK';
                                                } else {
                                                    $kategori =
                                                        'SANGAT TIDAK BAIK';
                                                }
                                                ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?= $index++ ?></td>
                                                <td class="text-center"><?= $nilai ?></td>
                                                <td class="text-center"><?= $kategori ?></td>
                                            </tr>
                                            <?php
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                    <span class="d-inline-block" style="font-size: 12px;">* Data diurutkan dari Terbaru
                                        - Terlama</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kesesuaian-indikator mt-3">
                    <div class="row">
                        <div class="col col-12">
                            <p style="font-weight: bold;">RIWAYAT TINGKAT KESESUAIAN INDIKATOR</p>
                            <div class="row">
                                <div class="col col-6">
                                    <span>HASIL TERBARU</span>
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
                                            $dataKesesuaian = query(
                                                "SELECT tingkat_kesesuaian_indikator.ID_INDIKATOR,indikator.NAMA_INDIKATOR,tingkat_kesesuaian_indikator.NILAI FROM tingkat_kesesuaian_indikator LEFT JOIN indikator ON tingkat_kesesuaian_indikator.ID_INDIKATOR = indikator.ID_INDIKATOR WHERE tingkat_kesesuaian_indikator.ID_SEKOLAH = $idSekolah"
                                            );
                                            $index = 1;
                                            foreach (
                                                $dataKesesuaian
                                                as $data
                                            ): ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?= $index++ ?></td>
                                                <td class="text-center"><?= $data[
                                                    'NAMA_INDIKATOR'
                                                ] ?></td>
                                                <td class="text-center"><?= $data[
                                                    'NILAI'
                                                ] ?></td>
                                            </tr>
                                            <?php endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col col-6">
                                    <span>HASIL SEBELUMNYA</span>
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
                                            $dataKesesuaian = query(
                                                "SELECT log_tingkat_kesesuaian_indikator.ID_INDIKATOR,indikator.NAMA_INDIKATOR,log_tingkat_kesesuaian_indikator.NILAI FROM log_tingkat_kesesuaian_indikator LEFT JOIN indikator ON log_tingkat_kesesuaian_indikator.ID_INDIKATOR = indikator.ID_INDIKATOR WHERE log_tingkat_kesesuaian_indikator.ID_SEKOLAH = $idSekolah"
                                            );
                                            $index = 1;
                                            foreach (
                                                $dataKesesuaian
                                                as $data
                                            ): ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?= $index++ ?></td>
                                                <td class="text-center"><?= $data[
                                                    'NAMA_INDIKATOR'
                                                ] ?></td>
                                                <td class="text-center"><?= $data[
                                                    'NILAI'
                                                ] ?></td>
                                            </tr>
                                            <?php endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kesesuaian-indikator mt-3">
                    <div class="row">
                        <div class="col col-12">
                            <p style="font-weight: bold;">RIWAYAT KUADRAN PRIORITAS INDIKATOR</p>
                            <div class="row">
                                <div class="col col-6">
                                    <span>HASIL TERBARU</span>
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
                                                $color;
                                                if (
                                                    $kuadran ==
                                                    'PRIORITAS TINGGI'
                                                ) {
                                                    $color = 'red';
                                                } elseif (
                                                    $kuadran ==
                                                    'PERTAHANKAN PRESTASI'
                                                ) {
                                                    $color = 'green';
                                                } elseif (
                                                    $kuadran ==
                                                    'PRIORITAS RENDAH'
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
                                <div class="col col-6">
                                    <span>HASIL SEBELUMNYA</span>
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
                                            $dataRiwayatKuadran = query(
                                                "SELECT log_kuadran_indikator.ID_INDIKATOR,log_kuadran_indikator.KUADRAN,indikator.NAMA_INDIKATOR FROM log_kuadran_indikator LEFT JOIN indikator ON log_kuadran_indikator.ID_INDIKATOR = indikator.ID_INDIKATOR WHERE log_kuadran_indikator.ID_SEKOLAH = $idSekolah"
                                            );
                                            $index = 1;
                                            foreach (
                                                $dataRiwayatKuadran
                                                as $data
                                            ):

                                                $kuadran = $data['KUADRAN'];
                                                $color = '';
                                                if (
                                                    $kuadran ==
                                                    'PRIORITAS TINGGI'
                                                ) {
                                                    $color = 'red';
                                                } elseif (
                                                    $kuadran ==
                                                    'PERTAHANKAN PRESTASI'
                                                ) {
                                                    $color = 'green';
                                                } elseif (
                                                    $kuadran ==
                                                    'PRIORITAS RENDAH'
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
                    </div>
                </div>
                <footer class="mt-auto footer text-center">
                    SIPEKU Sistem Pengukuran Kualitas &copy; 2022
                </footer>
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