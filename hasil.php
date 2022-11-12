<?php
session_start();
require './functions.php';
if ($_SESSION['id'] != '1') {
    header('location: login.php');
    exit();
} else {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/style/main.css" />
    <title>KELOLA HASIL</title>
</head>

<body>
    <div id="wrapper">
        <div class="sidebar">
            <?php require './sidebar.php'; ?>

        </div>
        <div class="main" id="kelola_pertanyaan">
            <!-- As a heading -->
            <?php require './nav.php'; ?>

            <div class="container">
                <div style="
              display: flex;
              margin-top: 30px;
              margin-bottom: 20px;
              flex-wrap: warp;
            ">
                    <div class="row">
                        <div class="col col-12">
                            <h2 class="brand-title" style="width: 100%;">
                                DAFTAR PERANGKINGAN SEKOLAH
                            </h2>
                        </div>
                    </div>

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
                    <tbody id="tabelRangking">
                        <?php
                        $dataRangking = query(
                            'SELECT sekolah.ID_SEKOLAH,sekolah.NAMA_SEKOLAH,tingkat_kesesuaian_total.NILAI,perangkingan_sekolah.NILAI as NILAI_RANGKING FROM perangkingan_sekolah LEFT JOIN tingkat_kesesuaian_total ON perangkingan_sekolah.ID_SEKOLAH = tingkat_kesesuaian_total.ID_SEKOLAH LEFT JOIN sekolah ON perangkingan_sekolah.ID_SEKOLAH = sekolah.ID_SEKOLAH ORDER BY NILAI_RANGKING DESC'
                        );
                        $index = 1;
                        if (count($dataRangking) == 0) {
                            echo '<tr>
                            <td class="text-center" colspan=5>Data Kosong</td>
                        </tr>';
                        }
                        foreach ($dataRangking as $ranking):

                            $nilai = (float) $ranking['NILAI'];
                            $kategori;
                            if ($nilai > 85) {
                                $kategori = 'SANGAT BAIK';
                            } elseif ($nilai >= 69 && $nilai <= 84) {
                                $kategori = 'BAIK';
                            } elseif ($nilai >= 53 && $nilai <= 68) {
                                $kategori = 'CUKUP BAIK';
                            } elseif ($nilai >= 37 && $nilai <= 52) {
                                $kategori = 'TIDAK BAIK';
                            } else {
                                $kategori = 'SANGAT TIDAK BAIK';
                            }
                            ?>
                        <tr>
                            <td class="text-center"><?= $index++ ?></td>
                            <td class="text-center">
                                <a style=" text-decoration:none;" href="detailhasil.php?id=<?= $ranking[
                                    'ID_SEKOLAH'
                                ] ?>"><?= $ranking['NAMA_SEKOLAH'] ?></a>
                            </td>
                            </td>
                            <td class="text-center">
                                <?= $kategori ?>
                            </td>
                            <td class="text-center">
                                <?= $ranking['NILAI_RANGKING'] ?>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <div class="row d-flex justify-content-center">
                    <?php
                    $datajawaban = mysqli_fetch_assoc(
                        mysqli_query(
                            $conn,
                            'SELECT COUNT(ID_JAWABAN) AS TOTAL FROM jawaban'
                        )
                    );
                    if ($datajawaban['TOTAL'] == 0) {
                        echo '
                    <div class="text-center">
                    <button type="button" disabled class="btn btn-primary" id="generateHasil">Lihat Hasil</button>
                </div>
                    ';
                    } else {
                        echo ' <div class="text-center">
                    <button type="button" class="btn btn-primary" id="generateHasil">Lihat Hasil</button>
                </div>
                <div class="text-center">
                    <a href="detailPerangkingan.php" target=""><button type="button" class="btn btn-info ml-2">Lihat Perhitungan Perangkingan</button></a>
                </div>
                ';
                    }
                    ?>
                    <div class="text-center">
                        <a target="_blank" href="tabelJawaban.php"><button type="button" class="btn btn-success ml-2"
                                id="generateExcel">Export
                                Excel</button></a>
                    </div>
                </div>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $("#generateHasil").on("click", function() {
        fetch("buatHasil.php", {
            method: "POST"
        }).then(response => {
            return response.json()
        }).then(responseJson => {
            let tabelHtml = $("#tabelRangking")
            tabelHtml.html(`
            <tr>
                <td class="text-center" colspan=5>
                    <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>
                </td>
            </tr>
            `)
            setTimeout(() => {
                Swal.fire({
                    title: 'Sukses',
                    text: 'Data Berhasil Di Proses',
                    icon: 'success',
                    position: "top",
                    showConfirmButton: false
                })
                setTimeout(() => {
                    window.location.reload(true);
                }, 1000);
            }, 1500);
        })
    })
    </script>
</body>

</html>