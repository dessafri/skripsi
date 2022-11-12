<?php
session_start();
require './functions.php';
if ($_SESSION['id'] != '1') {
    header('location: login.php');
    exit();
} else {
    $banyakSekolah = mysqli_fetch_assoc(
        mysqli_query($conn, 'SELECT COUNT(ID_SEKOLAH) AS TOTAL FROM sekolah')
    );
    $banyakIndikator = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            'SELECT COUNT(ID_INDIKATOR) AS TOTAL FROM indikator'
        )
    );
    $banyakPertanyaan = mysqli_fetch_assoc(
        mysqli_query(
            $conn,
            'SELECT COUNT(DISTINCT ID_INDIKATOR) AS TOTAL FROM pertanyaan'
        )
    );
}

if (isset($_POST['logout'])) {
    logout();
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="assets/style/main.css" />
    <link rel="stylesheet" href="assets/owlcarousel/dist/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/owlcarousel/dist/assets/owl.theme.default.min.css" />
    <title>Admin</title>
</head>

<body>
    <div id="wrapper">
        <div class="sidebar">
            <?php require './sidebar.php'; ?>
        </div>
        <div class="main">
            <!-- As a heading -->
            <?php require './nav.php'; ?>
            <div class="container">
                <div class="laporan ">
                    <h2>LAPORAN AKTIVITAS</h2>
                    <div class="card mr-4" style="width: 22rem;">
                        <div class="card-body">
                            <h3 class="card-title">SEKOLAH</h3>
                            <h4 class="card-subtitle mb-2 text-muted"><?= $banyakSekolah[
                                'TOTAL'
                            ] ?> SEKOLAH</h4>
                        </div>
                    </div>
                    <div class="card mr-4" style="width: 18rem;">
                        <div class="card-body">
                            <h3 class="card-title">INDIKATOR</h3>
                            <h4 class="card-subtitle mb-2 text-muted"><?= $banyakIndikator[
                                'TOTAL'
                            ] ?> INDIKATOR</h4>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h3 class="card-title">PERTANYAAN</h3>
                            <h4 class="card-subtitle mb-2 text-muted"><?= $banyakPertanyaan[
                                'TOTAL'
                            ] ?> PERTANYAAN</h4>
                        </div>
                    </div>
                </div>
                <div class="hasil d-flex justify-content-center">
                    <h2>HASIL PENGUKURAN KUALITAS</h2>
                    <div class="owl-carousel">
                        <?php
                        $dataSekolahRangking = query(
                            'SELECT sekolah.ID_SEKOLAH,sekolah.NAMA_SEKOLAH,tingkat_kesesuaian_total.NILAI,perangkingan_sekolah.NILAI as NILAI_RANGKING FROM perangkingan_sekolah LEFT JOIN tingkat_kesesuaian_total ON perangkingan_sekolah.ID_SEKOLAH = tingkat_kesesuaian_total.ID_SEKOLAH LEFT JOIN sekolah ON perangkingan_sekolah.ID_SEKOLAH = sekolah.ID_SEKOLAH ORDER BY NILAI_RANGKING DESC'
                        );
                        $index = 1;
                        if (count($dataSekolahRangking) == 0) {
                            echo '<div class="row justify-content-center">
                            <div class="card mb-2" style="width: 19rem;">
                            <div class="card-body text-center">
                                Data Belum Tersedia
                            </div>
                            </div>
                        </div>';
                        }
                        foreach ($dataSekolahRangking as $data):

                            $idSekolah = $data['ID_SEKOLAH'];
                            $pertahankan = query(
                                "SELECT COUNT(ID_INDIKATOR) AS TOTAL from kuadran_indikator WHERE ID_SEKOLAH = $idSekolah AND KUADRAN = 'PERTAHANKAN PRESTASI'"
                            );
                            $pertimbangan = query(
                                "SELECT COUNT(ID_INDIKATOR) AS TOTAL from kuadran_indikator WHERE ID_SEKOLAH = $idSekolah AND KUADRAN = 'PRIORITAS RENDAH'"
                            );
                            $perbaiki = query(
                                "SELECT COUNT(ID_INDIKATOR) AS TOTAL from kuadran_indikator WHERE ID_SEKOLAH = $idSekolah AND KUADRAN = 'PRIORITAS TINGGI'"
                            );
                            $berlebihan = query(
                                "SELECT COUNT(ID_INDIKATOR) AS TOTAL from kuadran_indikator WHERE ID_SEKOLAH = $idSekolah AND KUADRAN = 'BERLEBIHAN'"
                            );
                            ?>
                        <div class="card mr-4" style="width: 19rem;">
                            <div class="card-body">
                                <span>PERINGKAT <?= $index++ ?></span>
                                <h3 class="card-title"><?= $data[
                                    'NAMA_SEKOLAH'
                                ] ?></h3>
                                <h4 class="pertahankan">
                                    <?= $pertahankan[0][
                                        'TOTAL'
                                    ] ?> INDIKATOR PERLU DI
                                    <span>PERTAHANKAN</span>
                                </h4>
                                <h4 class="pertimbangkan">
                                    <?= $pertimbangan[0][
                                        'TOTAL'
                                    ] ?> INDIKATOR PERLU DI
                                    <span style="color: orange;">PERTIMBANGKAN</span>
                                </h4>
                                <h4 class="perbaiki">
                                    <?= $perbaiki[0][
                                        'TOTAL'
                                    ] ?> INDIKATOR PERLU DI
                                    <span>PERBAIKI</span>
                                </h4>
                                <h4 class="berlebihan">
                                    <?= $berlebihan[0]['TOTAL'] ?> INDIKATOR
                                    <span>BERLEBIHAN</span>
                                </h4>
                            </div>
                        </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
                <div class="indikator-sekolah">
                    <div class="card indikator">
                        <h2 class="text-center">5 INDIKATOR TERAKHIR</h2>
                        <table class="table table-bordered">
                            <tbody>
                                <?php
                                $dataIndikator = query(
                                    'SELECT * FROM indikator ORDER BY ID_INDIKATOR DESC LIMIT 5'
                                );
                                foreach ($dataIndikator as $data): ?>
                                <tr>
                                    <td class="text-center"><?= $data[
                                        'NAMA_INDIKATOR'
                                    ] ?></td>
                                </tr>
                                <?php endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card sekolah">
                        <h2 class="text-center">SEKOLAH TERAKHIR DIBUAT</h2>
                        <table class="table table-bordered">
                            <tbody>
                                <?php
                                $dataIndikator = query(
                                    'SELECT * FROM sekolah ORDER BY ID_SEKOLAH DESC LIMIT 5'
                                );
                                foreach ($dataIndikator as $data): ?>
                                <tr>
                                    <td class="text-center"><?= $data[
                                        'NAMA_SEKOLAH'
                                    ] ?></td>
                                </tr>
                                <?php endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="footer">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/owlcarousel/dist/owl.carousel.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel();
    });
    </script>
</body>

</html>