<?php
require './functions.php';

$pertanyaan = query(
    'SELECT pertanyaan.ID_PERTANYAAN,pertanyaan.NAMA_PERTANYAAN,indikator.NAMA_INDIKATOR,pertanyaan.KATEGORI FROM pertanyaan LEFT JOIN indikator ON pertanyaan.ID_INDIKATOR = indikator.ID_INDIKATOR'
);
$kategori = query('SELECT * FROM kategori');
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
    .swal2-popup {
        font-size: 12px !important;
        font-family: Georgia, serif;
    }
    </style>
    <title>Kelola Pertanyaan</title>
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
                                    KELOLA PERTANYAAN
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
                        DAFTAR PERTANYAAN
                    </h2>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#pertanyaanmodal">
                        <i class="fa-solid fa-plus"></i>
                        Buat Pertanyaan
                    </button>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">NO</th>
                            <th scope="col" class="text-center">PERTANYAAN</th>
                            <th scope="col" class="text-center">INDIKATOR</th>
                            <th scope="col" class="text-center">KATEGORI</th>
                            <th scope="col" class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomer = 1;
                        if (count($pertanyaan) > 0) {
                            foreach ($pertanyaan as $data): ?>
                        <tr>
                            <td class="text-center"><?= $nomer ?></td>
                            <td class="text-center">
                                <?= $data['NAMA_PERTANYAAN'] ?>
                            </td>
                            <td class="text-center"><?= $data[
                                'NAMA_INDIKATOR'
                            ] ?></td>
                            <td class="text-center"><?= $data[
                                'KATEGORI'
                            ] ?></td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-edit" data-value=<?= $data[
                                    'ID_PERTANYAAN'
                                ] ?>>
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger btn-hapus" data-value=<?= $data[
                                    'ID_PERTANYAAN'
                                ] ?>>
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php $nomer++;endforeach;
                        } else {
                            echo '
                            <tr>
                            <td class="text-center" colspan=5>Data Kosong</td>
                        </tr>
                        ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="footer fixed-bottom">
                <p class="text-center">
                    SIPEKU Sistem Pengukuran Kualitas &copy; 2022
                </p>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="pertanyaanmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        FORM PEMBUATAN PERTANYAAN
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group form1">
                        <label for="indikatorselect">
                            Pilih Indikator Untuk Pertanyaan
                        </label>
                        <select class="form-control" id="indikatorselect">
                            <option value="0">-- Silahkan Pilih Indikator Pertanyaan --</option>
                            <?php
                            $indikator = query('SELECT * FROM indikator');
                            foreach ($indikator as $data): ?>
                            <option value=<?= $data[
                                'ID_INDIKATOR'
                            ] ?>><?= $data['NAMA_INDIKATOR'] ?></option>
                            <?php endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group form2">
                        <label for="inputkualitas" class="labelKualitas">Silahkan Masukkan Pertanyaan Kualitas</label>
                        <input type="text" class="form-control" id="inputkualitas"
                            placeholder="Bagaimana Kualitas Indikator Tersebut" disabled>
                    </div>
                    <div class="ketentuanKualitas">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th width="30%">Kategori Jawaban</th>
                                    <th width="70%" class="text-center">Kriteria Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>SANGAT BAIK NILAI 5</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="inputSangatBaikKualitas"
                                            placeholder="Jika ....">
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                    <td>BAIK NILAI 4</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="inputBaikKualitas"
                                                placeholder="Jika ....">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CUKUP BAIK NILAI 3</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="inputCukupBaikKualitas"
                                                placeholder="Jika ....">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TIDAK BAIK NILAI 2</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="inputTidakBaikKualitas"
                                                placeholder="Jika ....">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SANGAT TIDAK BAIK NILAI 1</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="inputSangatTidakBaikKualitas"
                                                placeholder="Jika ....">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group form3">
                        <label for="inputkepentingan" class="labelKepentingan">Silahkan Masukkan Pertanyaan
                            Kepentingan</label>
                        <input type="text" class="form-control" id="inputkepentingan"
                            placeholder="Seberapa Penting Indikator Tersebut" disabled>
                    </div>
                    <div class="ketentuanKepentingan">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th width="30%">Kategori Jawaban</th>
                                    <th width="70%" class="text-center">Kriteria Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>SANGAT PENTING NILAI 5</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="inputSangatPentingKepentingan"
                                            placeholder="Jika ....">
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                    <td>PENTING NILAI 4</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="inputPentingKepentingan"
                                                placeholder="Jika ....">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CUKUP PENTING NILAI 3</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="inputCukupPentingKepentingan"
                                                placeholder="Jika ....">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TIDAK PENTING NILAI 2</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="inputTidakPentingKepentingan"
                                                placeholder="Jika ....">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>SANGAT TIDAK PENTING NILAI 1</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                id="inputSangatTidakPentingKepentingan" placeholder="Jika ....">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-tutup">
                            Tutup
                        </button>
                        <button type="button" class="btn btn-secondary" id="btn-prevKualitas">
                            Sebelumnya
                        </button>
                        <button type="button" class="btn btn-secondary" id="btn-prevKepentingan">
                            Sebelumnya
                        </button>
                        <button type="button" class="btn btn-primary" id="btn-kualitas">Next</button>
                        <button type="button" class="btn btn-primary" id="btn-kepentingan">Next</button>
                        <button type="button" class="btn btn-primary" id="btn-addPertanyaan">Buat Pertanyaan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalEdit"></div>
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
    let dataIndikator;
    $(".ketentuanKepentingan,.ketentuanKualitas").css({
        display: "none"
    })
    $("#btn-tutup,#btn-prevKualitas,#btn-kepentingan,#btn-kualitas,#btn-prevKepentingan,#btn-addPertanyaan")
        .css({
            display: "none"
        })
    $("#btn-tutup,#btn-kualitas")
        .css({
            display: "block"
        })
    $("#indikatorselect").on("change", function() {
        let valueSelect = $("#indikatorselect").find(":selected").val();
        if (valueSelect > 0) {
            $("#inputkualitas,#inputkepentingan").removeAttr("disabled")
        } else {
            $("#inputkualitas,#inputkepentingan").attr("disabled", "disabled")
        }
    })

    $("#btn-kualitas").on("click", function() {
        let pertanyaanKualitas = $("#inputkualitas").val();
        let pertanyaanKepentingan = $("#inputkepentingan").val();
        let indikator = $("#indikatorselect").val();
        if (pertanyaanKualitas === " " || pertanyaanKepentingan === " " || indikator == 0) {
            Swal.fire({
                title: 'Error!',
                text: 'Harap Mengisi Semua Form',
                icon: 'error',
                position: "top",
                showConfirmButton: true
            })
        } else if (pertanyaanKualitas.length == 0 || pertanyaanKepentingan.length == 0) {
            Swal.fire({
                title: 'Error!',
                text: 'Harap Mengisi Semua Form',
                icon: 'error',
                position: "top",
                showConfirmButton: true
            })
        } else {
            dataIndikator = indikator;
            // langkah pertama menghilangkan form indikator dan kepentingan dan mengganti tombol tutup
            $(".form1").css({
                display: "none",
            })
            $("#inputkualitas").attr("disabled", "disabled")
            $(".labelKualitas").html("Pertanyaan Kualitas")
            $("#inputkepentingan,.labelKepentingan").css({
                display: "none"
            })
            $(".btn-nav").addClass("btn-prevKualitas")
            // langkah kedua memunculkan form ketentuan untuk kualitas
            $(".ketentuanKualitas").css({
                display: "block"
            })
            $("#btn-tutup,#btn-prevKualitas,#btn-kepentingan,#btn-kualitas,#btn-prevKepentingan,#btn-addPertanyaan")
                .css({
                    display: "none"
                })
            $("#btn-prevKualitas,#btn-kepentingan")
                .css({
                    display: "block"
                })
        }
    })
    $("#btn-kepentingan").on("click", function(e) {
        let jawaban5 = $("#inputSangatBaikKualitas").val();
        let jawaban4 = $("#inputBaikKualitas").val();
        let jawaban3 = $("#inputCukupBaikKualitas").val();
        let jawaban2 = $("#inputTidakBaikKualitas").val();
        let jawaban1 = $("#inputSangatTidakBaikKualitas").val();

        if (jawaban1 === " " || jawaban2 === " " || jawaban3 === " " || jawaban4 === " " || jawaban5 ===
            " ") {
            Swal.fire({
                title: 'Error!',
                text: 'Harap Mengisi Semua Form',
                icon: 'error',
                position: "top",
                showConfirmButton: true
            })
        } else if (jawaban1.length == 0 || jawaban1.length == 0 || jawaban3.length == 0 || jawaban4
            .length == 0 || jawaban5.length == 0) {
            Swal.fire({
                title: 'Error!',
                text: 'Harap Mengisi Semua Form',
                icon: 'error',
                position: "top",
                showConfirmButton: true
            })
        } else {
            $(".ketentuanKepentingan").css({
                display: "block"
            })
            $(".ketentuanKualitas").css({
                display: "none"
            })
            $("#inputkualitas,.labelKualitas").css({
                display: "none"
            })
            $("#inputkepentingan,.labelKepentingan").css({
                display: "block"
            })
            $("#inputkepentingan").attr("disabled", "disabled")
            $(".labelKepentingan").html("Pertanyaan Kepentingan")
            $("#btn-tutup,#btn-prevKualitas,#btn-kepentingan,#btn-kualitas,#btn-prevKepentingan,#btn-addPertanyaan")
                .css({
                    display: "none"
                })
            $("#btn-prevKepentingan,#btn-addPertanyaan")
                .css({
                    display: "block"
                })
        }
    })
    $("#btn-prevKepentingan").on("click", function() {
        $(".ketentuanKepentingan").css({
            display: "none"
        })
        $(".ketentuanKualitas").css({
            display: "block"
        })
        $("#inputkualitas,.labelKualitas").css({
            display: "block"
        })
        $("#inputkepentingan,.labelKepentingan").css({
            display: "none"
        })
        $("#inputkualitas").attr("disabled", "disabled")
        $(".labelKualitas").html("Pertanyaan Kualitas")
        $("#btn-tutup,#btn-prevKualitas,#btn-kepentingan,#btn-kualitas,#btn-prevKepentingan,#btn-addPertanyaan")
            .css({
                display: "none"
            })
        $("#btn-prevKualitas,#btn-kepentingan")
            .css({
                display: "block"
            })
    })
    $("#btn-prevKualitas").on("click", function() {
        $(".form1").css({
            display: "block",
        })
        $("#inputkualitas").removeAttr("disabled")
        $("#inputkepentingan").removeAttr("disabled")
        $(".labelKualitas").html("Silahkan Masukkan Pertanyaan Kualitas")
        $("#inputkepentingan,.labelKepentingan").css({
            display: "block"
        })
        $(".ketentuanKepentingan,.ketentuanKualitas").css({
            display: "none"
        })
        $("#btn-tutup,#btn-prevKualitas,#btn-kepentingan,#btn-kualitas,#btn-prevKepentingan,#btn-addPertanyaan")
            .css({
                display: "none"
            })
        $("#btn-tutup,#btn-kualitas")
            .css({
                display: "block"
            })
    })
    $("#btn-addPertanyaan").on("click", function() {
        let jawaban5 = $("#inputSangatPentingKepentingan").val();
        let jawaban4 = $("#inputPentingKepentingan").val();
        let jawaban3 = $("#inputCukupPentingKepentingan").val();
        let jawaban2 = $("#inputTidakPentingKepentingan").val();
        let jawaban1 = $("#inputSangatTidakPentingKepentingan").val();

        if (jawaban1 === " " || jawaban2 === " " || jawaban3 === " " || jawaban4 === " " || jawaban5 ===
            " ") {
            Swal.fire({
                title: 'Error!',
                text: 'Harap Mengisi Semua Form',
                icon: 'error',
                position: "top",
                showConfirmButton: true
            })
        } else if (jawaban1.length == 0 || jawaban1.length == 0 || jawaban3.length == 0 || jawaban4
            .length == 0 || jawaban5.length == 0) {
            Swal.fire({
                title: 'Error!',
                text: 'Harap Mengisi Semua Form',
                icon: 'error',
                position: "top",
                showConfirmButton: true
            })
        } else {
            let pertanyaanKualitas = $("#inputkualitas").val();
            let pertanyaanKepentingan = $("#inputkepentingan").val();
            let idIndkator = dataIndikator;
            let jawaban5kualitas = $("#inputSangatBaikKualitas").val();
            let jawaban4kualitas = $("#inputBaikKualitas").val();
            let jawaban3kualitas = $("#inputCukupBaikKualitas").val();
            let jawaban2kualitas = $("#inputTidakBaikKualitas").val();
            let jawaban1kualitas = $("#inputSangatTidakBaikKualitas").val();
            let jawaban5kepentingan = $("#inputSangatPentingKepentingan").val();
            let jawaban4kepentingan = $("#inputPentingKepentingan").val();
            let jawaban3kepentingan = $("#inputCukupPentingKepentingan").val();
            let jawaban2kepentingan = $("#inputTidakPentingKepentingan").val();
            let jawaban1kepentingan = $("#inputSangatTidakPentingKepentingan").val();

            let formData = new FormData
            formData.append("id_indikator", idIndkator)
            formData.append("pKualitas", pertanyaanKualitas)
            formData.append("pKepentingan", pertanyaanKepentingan)
            formData.append("j5kualitas", jawaban5kualitas)
            formData.append("j4kualitas", jawaban4kualitas)
            formData.append("j3kualitas", jawaban3kualitas)
            formData.append("j2kualitas", jawaban2kualitas)
            formData.append("j1kualitas", jawaban1kualitas)
            formData.append("j5kepentingan", jawaban5kepentingan)
            formData.append("j4kepentingan", jawaban4kepentingan)
            formData.append("j3kepentingan", jawaban3kepentingan)
            formData.append("j2kepentingan", jawaban2kepentingan)
            formData.append("j1kepentingan", jawaban1kepentingan)

            fetch("buatPertanyaan.php", {
                method: "POST",
                body: formData
            }).then(response => {
                return response.json()
            }).then(responseJson => {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Pertanyaan Berhasil Dibuat',
                    icon: 'success',
                    position: "top",
                    showConfirmButton: false
                })
                setTimeout(() => {
                    window.location.reload(true);
                }, 1000);
            })
        }
    })
    $(".btn-hapus").on("click", function() {
        let dataid = $(this).attr("data-value")
        let dataid2;
        let cekdataid = dataid % 2 == 0;
        if (cekdataid == true) {
            dataid2 = parseInt(dataid) - 1
        } else {
            dataid2 = parseInt(dataid) + 1
        }
        Swal.fire({
            icon: "warning",
            position: "top",
            title: "Apakah anda yakin ?",
            text: "Data Pertanyaan Kualitas Dan Kepentingan Akan Terhapus",
            showConfirmButton: true,
            showCancelButton: true,
            reverseButtons: true
        }).then((result => {
            if (result.isConfirmed) {
                let formData = new FormData
                formData.append("id", dataid);
                formData.append("id2", dataid2);
                fetch("hapuspertanyaan.php", {
                    method: "POST",
                    body: formData
                }).then(response => {
                    return response.json()
                }).then(responseJson => {
                    Swal.fire({
                        title: 'Terhapus!',
                        text: 'Pertanyaan Berhasil Dihapus',
                        icon: 'success',
                        position: "top",
                        showConfirmButton: false
                    })
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 1000);
                })
            }
        }))
    })
    $(".btn-edit").on("click", function() {
        let dataid = $(this).attr("data-value")
        let formData = new FormData();
        formData.append("id", dataid);
        fetch('dataperpertanyaan.php', {
            method: "POST",
            body: formData
        }).then(response => {
            return response.json();
        }).then(responseJson => {
            let data = responseJson;
            console.log(data);
            let dataKualitas = data[0];
            let pertanyaan = dataKualitas.NAMA_PERTANYAAN;
            if (data[0].KATEGORI == "KUALITAS") {
                $("#modalEdit").html(`
                    <div class="modal fade" id="editpertanyaanmodalKualitas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        FORM UPDATE PERTANYAAN
                                    </h5>
                                    <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group form1">
                                        <label for="indikatorselect">
                                            Pilih Indikator Untuk Pertanyaan
                                        </label>
                                        <select class="form-control" id="indikatorselectEditKualitas">
                                            <option value="0">-- Silahkan Pilih Indikator Pertanyaan --</option>
                                            <?php
                                            $indikator = query(
                                                'SELECT * FROM indikator'
                                            );
                                            foreach ($indikator as $data): ?>
                                            <option value=<?= $data[
                                                'ID_INDIKATOR'
                                            ] ?>><?= $data[
    'NAMA_INDIKATOR'
] ?></option>
                                            <?php endforeach;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group form2">
                                        <label for="inputkualitas" class="labelKualitas">Silahkan Masukkan Pertanyaan Kualitas</label>
                                        <input type="text" class="form-control" id="inputkualitasEdit" value="${pertanyaan}">
                                    </div>
                                    <div class="ketentuanKualitas">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th width="30%">Kategori Jawaban</th>
                                                    <th width="70%" class="text-center">Kriteria Jawaban</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td>SANGAT BAIK NILAI 5</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" data-id="${data[0].ID_KETENTUAN_JAWABAN}" id="inputSangatBaikKualitasEdit"
                                                            value="${data[0].KETENTUAN_JAWABAN}">
                                                    </div>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>BAIK NILAI 4</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="inputBaikKualitasEdit" data-id="${data[1].ID_KETENTUAN_JAWABAN}" value="${data[1].KETENTUAN_JAWABAN}">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>CUKUP BAIK NILAI 3</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" data-id="${data[2].ID_KETENTUAN_JAWABAN}" id="inputCukupBaikKualitasEdit"
                                                                value="${data[2].KETENTUAN_JAWABAN}">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>TIDAK BAIK NILAI 2</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" data-id="${data[3].ID_KETENTUAN_JAWABAN}" id="inputTidakBaikKualitasEdit"
                                                                value="${data[3].KETENTUAN_JAWABAN}">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>SANGAT TIDAK BAIK NILAI 1</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" data-id="${data[4].ID_KETENTUAN_JAWABAN}" id="inputSangatTidakBaikKualitasEdit"
                                                                value="${data[4].KETENTUAN_JAWABAN}">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal" id="btn-tutup">
                                            Tutup
                                        </button>
                                        <button type="button" class="btn btn-primary" id="updateKualitas">Update Pertanyaan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `)
                $("#editpertanyaanmodalKualitas").modal("show");
                $("#indikatorselectEditKualitas").val(dataKualitas.ID_INDIKATOR);
                $("#updateKualitas").on("click", function() {
                    let indikator = $("#indikatorselectEditKualitas").val()
                    let pertanyaan = $("#inputkualitasEdit").val()
                    let ketentuan5 = $("#inputSangatBaikKualitasEdit").val();
                    let ketentuan4 = $("#inputBaikKualitasEdit").val();
                    let ketentuan3 = $("#inputCukupBaikKualitasEdit").val();
                    let ketentuan2 = $("#inputTidakBaikKualitasEdit").val();
                    let ketentuan1 = $("#inputSangatTidakBaikKualitasEdit").val();
                    let id5 = $("#inputSangatBaikKualitasEdit").attr("data-id");
                    let id4 = $("#inputBaikKualitasEdit").attr("data-id");
                    let id3 = $("#inputCukupBaikKualitasEdit").attr("data-id");
                    let id2 = $("#inputTidakBaikKualitasEdit").attr("data-id");
                    let id1 = $("#inputSangatTidakBaikKualitasEdit").attr("data-id");

                    console.log(id5);
                    console.log(id4);
                    console.log(id3);
                    console.log(id2);
                    console.log(id1);

                    if (indikator == 0 || pertanyaan.length == 0 || ketentuan1 == 0 ||
                        ketentuan2 == 0 || ketentuan3 == 0 || ketentuan4 == 0 || ketentuan5 == 0
                    ) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Silahkan Cek Kembali Isi Form',
                            icon: 'error',
                            position: "top",
                        })
                    } else if (pertanyaan === " " || ketentuan1 === " " ||
                        ketentuan2 === " " || ketentuan3 === " " || ketentuan4 === " " ||
                        ketentuan5 === " ") {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Silahkan Cek Kembali Isi Form',
                            icon: 'error',
                            position: "top",
                        })
                    } else {
                        let formData = new FormData
                        formData.append("idPertanyaan", dataid);
                        formData.append("pertanyaan", pertanyaan);
                        formData.append("indikator", indikator);
                        formData.append("j5ketentuan", ketentuan5)
                        formData.append("j4ketentuan", ketentuan4)
                        formData.append("j3ketentuan", ketentuan3)
                        formData.append("j2ketentuan", ketentuan2)
                        formData.append("j1ketentuan", ketentuan1)
                        formData.append("id5", id5)
                        formData.append("id4", id4)
                        formData.append("id3", id3)
                        formData.append("id2", id2)
                        formData.append("id1", id1)

                        fetch("editpertanyaan.php", {
                            method: "POST",
                            body: formData
                        }).then(response => {
                            return response.json()
                        }).then(responseJson => {
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Pertanyaan Berhasil Di Update',
                                icon: 'success',
                                position: "top",
                                showConfirmButton: false
                            })
                            setTimeout(() => {
                                window.location.reload(true);
                            }, 1000);
                        })
                    }
                })
            } else {
                $("#modalEdit").html(`
                    <div class="modal fade" id="editpertanyaanmodalKepentingan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        FORM UPDATE PERTANYAAN
                                    </h5>
                                    <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group form1">
                                        <label for="indikatorselect">
                                            Pilih Indikator Untuk Pertanyaan
                                        </label>
                                        <select class="form-control" id="indikatorselectEditKepentingan">
                                            <option value="0">-- Silahkan Pilih Indikator Pertanyaan --</option>
                                            <?php
                                            $indikator = query(
                                                'SELECT * FROM indikator'
                                            );
                                            foreach ($indikator as $data): ?>
                                            <option value=<?= $data[
                                                'ID_INDIKATOR'
                                            ] ?>><?= $data[
    'NAMA_INDIKATOR'
] ?></option>
                                            <?php endforeach;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group form3">
                                        <label for="inputkepentinganEdit" class="labelKepentingan">Silahkan Masukkan Pertanyaan
                                            Kepentingan</label>
                                        <input type="text" class="form-control" id="inputkepentinganEdit" value="${data[0].NAMA_PERTANYAAN}">
                                    </div>
                                    <div class="ketentuanKepentingan">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th width="30%">Kategori Jawaban</th>
                                                    <th width="70%" class="text-center">Kriteria Jawaban</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td>SANGAT PENTING NILAI 5</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" data-id="${data[0].ID_KETENTUAN_JAWABAN}" id="inputSangatPentingKepentinganEdit"
                                                            value="${data[0].KETENTUAN_JAWABAN}">
                                                    </div>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>PENTING NILAI 4</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" data-id="${data[1].ID_KETENTUAN_JAWABAN}" id="inputPentingKepentinganEdit"
                                                                value="${data[1].KETENTUAN_JAWABAN}">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>CUKUP PENTING NILAI 3</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" data-id="${data[2].ID_KETENTUAN_JAWABAN}" id="inputCukupPentingKepentinganEdit"
                                                                value="${data[2].KETENTUAN_JAWABAN}">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>TIDAK PENTING NILAI 2</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" data-id="${data[3].ID_KETENTUAN_JAWABAN}" id="inputTidakPentingKepentinganEdit"
                                                                value="${data[3].KETENTUAN_JAWABAN}">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>SANGAT TIDAK PENTING NILAI 1</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                id="inputSangatTidakPentingKepentinganEdit" data-id="${data[4].ID_KETENTUAN_JAWABAN}" value="${data[4].KETENTUAN_JAWABAN}">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary closeModal" data-dismiss="modal" id="btn-tutup">
                                            Tutup
                                        </button>
                                        <button type="button" class="btn btn-primary" id="btn-updateKepentingan">Update Pertanyaan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `)
                $("#editpertanyaanmodalKepentingan").modal("show");
                $("#indikatorselectEditKepentingan").val(dataKualitas.ID_INDIKATOR);
                $("#btn-updateKepentingan").on("click", function() {
                    let indikator = $("#indikatorselectEditKepentingan").val()
                    let pertanyaan = $("#inputkepentinganEdit").val()
                    let ketentuan5 = $("#inputSangatPentingKepentinganEdit").val();
                    let ketentuan4 = $("#inputPentingKepentinganEdit").val();
                    let ketentuan3 = $("#inputCukupPentingKepentinganEdit").val();
                    let ketentuan2 = $("#inputTidakPentingKepentinganEdit").val();
                    let ketentuan1 = $("#inputSangatTidakPentingKepentinganEdit").val();
                    let id5 = $("#inputSangatPentingKepentinganEdit").attr("data-id");
                    let id4 = $("#inputPentingKepentinganEdit").attr("data-id");
                    let id3 = $("#inputCukupPentingKepentinganEdit").attr("data-id");
                    let id2 = $("#inputTidakPentingKepentinganEdit").attr("data-id");
                    let id1 = $("#inputSangatTidakPentingKepentinganEdit").attr("data-id");

                    if (indikator == 0 || pertanyaan.length == 0 || ketentuan1 == 0 ||
                        ketentuan2 == 0 || ketentuan3 == 0 || ketentuan4 == 0 || ketentuan5 == 0
                    ) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Silahkan Cek Kembali Isi Form',
                            icon: 'error',
                            position: "top",
                        })
                    } else if (pertanyaan === " " || ketentuan1 === " " ||
                        ketentuan2 === " " || ketentuan3 === " " || ketentuan4 === " " ||
                        ketentuan5 === " ") {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Silahkan Cek Kembali Isi Form',
                            icon: 'error',
                            position: "top",
                        })
                    } else {
                        let formData = new FormData
                        formData.append("idPertanyaan", dataid);
                        formData.append("pertanyaan", pertanyaan);
                        formData.append("indikator", indikator);
                        formData.append("j5ketentuan", ketentuan5)
                        formData.append("j4ketentuan", ketentuan4)
                        formData.append("j3ketentuan", ketentuan3)
                        formData.append("j2ketentuan", ketentuan2)
                        formData.append("j1ketentuan", ketentuan1)
                        formData.append("id5", id5)
                        formData.append("id4", id4)
                        formData.append("id3", id3)
                        formData.append("id2", id2)
                        formData.append("id1", id1)

                        fetch("editpertanyaan.php", {
                            method: "POST",
                            body: formData
                        }).then(response => {
                            return response.json()
                        }).then(responseJson => {
                            Swal.fire({
                                title: 'Sukses!',
                                text: 'Pertanyaan Berhasil Di Update',
                                icon: 'success',
                                position: "top",
                                showConfirmButton: false
                            })
                            setTimeout(() => {
                                window.location.reload(true);
                            }, 1000);
                        })
                    }
                })
            }
        })
    })
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
</body>

</html>