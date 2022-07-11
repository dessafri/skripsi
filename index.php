<?php
require './functions.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/style/main.css" />
    <title>Admin</title>
</head>

<body>
    <div id="wrapper">
        <div class="sidebar">
            <?php require './sidebar.php'; ?>
        </div>
        <div class="main">
            <!-- As a heading -->
            <div class="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col col-10">
                            <nav class="navbar navbar-light bg-light">
                                <h1 class="navbar-brand mb-0">
                                    SELAMAT DATANG, ADMIN !
                                </h1>
                            </nav>
                            <span>SISTEM PENGUKURAN KUALITAS BLENDED LEARNING</span>
                        </div>
                        <div class="col col-2">
                            <button class="btn btn-danger float-right">Logout</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="laporan">
                    <h2>LAPORAN AKTIVITAS</h2>
                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            <h3 class="card-title">KUESIONER</h3>
                            <h4 class="card-subtitle mb-2 text-muted">3 KUESIONER</h4>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h3 class="card-title">INDIKATOR</h3>
                            <h4 class="card-subtitle mb-2 text-muted">8 INDIKATOR</h4>
                        </div>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h3 class="card-title">PERTANYAAN</h3>
                            <h4 class="card-subtitle mb-2 text-muted">10 PERTANYAAN</h4>
                        </div>
                    </div>
                </div>
                <div class="hasil">
                    <h2>HASIL PENGUKURAN KUALITAS</h2>
                    <div class="card" style="width: 19rem;">
                        <div class="card-body">
                            <span>PERINGKAT 1</span>
                            <h3 class="card-title">SMA NEGERI 1 LAMONGAN</h3>
                            <h4 class="pertahankan">
                                10 INDIKATOR PERLU DI
                                <span>PERTAHANKAN</span>
                            </h4>
                            <h4 class="pertimbangkan">
                                1 INDIKATOR PERLU DI
                                <span>PERTIMBANGKAN</span>
                            </h4>
                            <h4 class="perbaiki">
                                2 INDIKATOR PERLU DI
                                <span>PERBAIKI</span>
                            </h4>
                            <h4 class="berlebihan">
                                2 INDIKATOR
                                <span>BERLEBIHAN</span>
                            </h4>
                        </div>
                    </div>
                    <div class="card" style="width: 19rem;">
                        <div class="card-body">
                            <span>PERINGKAT 2</span>
                            <h3 class="card-title">SMA NEGERI 2 LAMONGAN</h3>
                            <h4 class="pertahankan">
                                10 INDIKATOR PERLU DI
                                <span>PERTAHANKAN</span>
                            </h4>
                            <h4 class="pertimbangkan">
                                1 INDIKATOR PERLU DI
                                <span>PERTIMBANGKAN</span>
                            </h4>
                            <h4 class="perbaiki">
                                2 INDIKATOR PERLU DI
                                <span>PERBAIKI</span>
                            </h4>
                            <h4 class="berlebihan">
                                2 INDIKATOR
                                <span>BERLEBIHAN</span>
                            </h4>
                        </div>
                    </div>
                    <div class="card" style="width: 19rem;">
                        <div class="card-body">
                            <span>PERINGKAT 3</span>
                            <h3 class="card-title">SMA NEGERI 3 LAMONGAN</h3>
                            <h4 class="pertahankan">
                                10 INDIKATOR PERLU DI
                                <span>PERTAHANKAN</span>
                            </h4>
                            <h4 class="pertimbangkan">
                                1 INDIKATOR PERLU DI
                                <span>PERTIMBANGKAN</span>
                            </h4>
                            <h4 class="perbaiki">
                                2 INDIKATOR PERLU DI
                                <span>PERBAIKI</span>
                            </h4>
                            <h4 class="berlebihan">
                                2 INDIKATOR
                                <span>BERLEBIHAN</span>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="indikator-sekolah">
                    <div class="card indikator">
                        <h2 class="text-center">5 INDIKATOR TERAKHIR</h2>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-center">FASILITAS INTERNET</td>
                                </tr>
                                <tr>
                                    <td class="text-center">AKSES INTERNET</td>
                                </tr>
                                <tr>
                                    <td class="text-center">LAB KOMPUTER</td>
                                </tr>
                                <tr>
                                    <td class="text-center">MOTIVASI SISWA</td>
                                </tr>
                                <tr>
                                    <td class="text-center">TANGGUNG JAWAB SISWA</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card sekolah">
                        <h2 class="text-center">SEKOLAH TERAKHIR DIBUAT</h2>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-center">SMA NEGERI 1 LAMONGAN</td>
                                </tr>
                                <tr>
                                    <td class="text-center">SMAN NEGERI 2 LAMONGAN</td>
                                </tr>
                                <tr>
                                    <td class="text-center">SMA NEGERI 3 LAMONGAN</td>
                                </tr>
                                <tr>
                                    <td class="text-center">SMA NEGERI 1 SUKODADI</td>
                                </tr>
                                <tr>
                                    <td class="text-center">SMA NEGERI 1 KARANGBINANGUN</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="kuesioner">
                    <h2>KUESIONER TERAKHIR</h2>
                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            <h3 class="card-title">PENGUKURAN KUALITAS BLENDED LEARNING</h3>
                            <h4 class="card-subtitle mb-2 text-muted">
                                SMA NEGERI 1 LAMONGAN
                            </h4>
                        </div>
                    </div>
                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            <h3 class="card-title">PENGUKURAN KUALITAS BLENDED LEARNING</h3>
                            <h4 class="card-subtitle mb-2 text-muted">
                                SMA NEGERI 2 LAMONGAN
                            </h4>
                        </div>
                    </div>
                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            <h3 class="card-title">PENGUKURAN KUALITAS BLENDED LEARNING</h3>
                            <h4 class="card-subtitle mb-2 text-muted">
                                SMA NEGERI 3 LAMONGAN
                            </h4>
                        </div>
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
    <script src="https://your-site-or-cdn.com/fontawesome/v6.1.1/js/all.js" data-auto-replace-svg="nest"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>