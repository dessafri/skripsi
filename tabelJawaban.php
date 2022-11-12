<?php
session_start();
require './functions.php';
if ($_SESSION['id'] != '1') {
    header('location: login.php');
    exit();
} else {
}

// header('Content-type: application/vnd-ms-excel');
// header('Content-Disposition: attachment; filename=Data Jawaban.xls');
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
    <style>
    .swal2-popup {
        font-size: 12px !important;
        font-family: Georgia, serif;
    }
    </style>
    <title>tabelJawaban</title>
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">NAMA</th>
                <th scope="col">PERTANYAAN</th>
                <th scope="col">SEKOLAH</th>
                <th scope="col">PERAN</th>
                <th scope="col">JAWABAN</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $dataJawaban = query(
                'SELECT JAWABAN.NAMA , pertanyaan.NAMA_PERTANYAAN , sekolah.NAMA_SEKOLAH , peran.NAMA_PERAN , JAWABAN.JAWABAN FROM jawaban LEFT JOIN pertanyaan ON jawaban.ID_PERTANYAAN = pertanyaan.ID_PERTANYAAN LEFT JOIN sekolah ON jawaban.ID_SEKOLAH = sekolah.ID_SEKOLAH LEFT JOIN peran ON peran.ID_PERAN = jawaban.JENIS_PERAN'
            );
            $index = 1;
            foreach ($dataJawaban as $data): ?>
            <tr>
                <td scope="row"><?= $index++ ?></td>
                <td><?= $data['NAMA'] ?></td>
                <td><?= $data['NAMA_PERTANYAAN'] ?></td>
                <td><?= $data['NAMA_SEKOLAH'] ?></td>
                <td><?= $data['NAMA_PERAN'] ?></td>
                <td><?= $data['JAWABAN'] ?></td>
            </tr>
            <?php endforeach;
            ?>
        </tbody>
    </table>
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