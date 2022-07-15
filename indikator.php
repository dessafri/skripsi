<?php
require './functions.php';

$datas = query('SELECT * FROM indikator');
$dataperan = query('SELECT * FROM peran');

$peran = query(
    'SELECT DISTINCT ind.ID_INDIKATOR,p.NAMA_PERAN from (indikator ind left JOIN kriteria_peran kp on ind.ID_INDIKATOR = kp.ID_INDIKATOR) LEFT JOIN peran p on kp.ID_PERAN = p.ID_PERAN'
);
var_dump($peran);
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
    <title>Kelola Indikator</title>
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
                                    KELOLA INDIKATOR
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#indikatormodal">
                        <i class="fa-solid fa-plus"></i>
                        Buat Indikator
                    </button>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">NO</th>
                            <th scope="col" class="text-center">NAMA INDIKATOR</th>
                            <th scope="col" class="text-center">PERAN</th>
                            <th scope="col" class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($datas) > 0) {
                            $nomer = 1;
                            $namaperan = [];
                            foreach ($datas as $data): ?>
                        <?php array_push($namaperan, $data['ID_INDIKATOR']); ?>
                        <?php var_dump([$data['ID_INDIKATOR']]); ?>
                        <tr>
                            <td class="text-center"><?= $nomer ?></td>
                            <td class="text-center">
                                <?= $data['NAMA_INDIKATOR'] ?>
                            </td>
                            <td class="text-center">
                                <?= $data['ID_INDIKATOR'] ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-edit" data-value=<?= $data[
                                    'ID_INDIKATOR'
                                ] ?> data-toggle="modal" data-target="#editindikator" type="button">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger btn-delete" data-value=<?= $data[
                                    'ID_INDIKATOR'
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
                        } ?>
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
    <div class="modal fade" id="indikatormodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        FORM PEMBUATAN INDIKATOR
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="inputindikator">Masukkan Nama Indikator</label>
                            <input type="text" class="form-control" name="nama" id="inputindikator"
                                aria-describedby="texthelp" />
                        </div>
                    </div>
                    <span>Pilih Peran Untuk Indikator</span>
                    <?php foreach ($dataperan as $data): ?>
                    <div class="form-check">
                        <input class="form-check-input" name="peran[]" type="checkbox" value=<?= $data[
                            'ID_PERAN'
                        ] ?> id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            <?= $data['NAMA_PERAN'] ?>
                        </label>
                    </div>
                    <?php endforeach; ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn btn-primary btn-add">Buat Indikator</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="edit"></div>
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
    $(".btn-edit").on("click", function(e) {
        let dataid = $(this).attr("data-value");
        let formData = new FormData();
        formData.append("id", dataid);
        fetch('dataperindikator.php', {
            method: "POST",
            body: formData
        }).then(response => {
            return response.json();
        }).then(responseJson => {
            let data = responseJson;
            let items = data.map(data => `
            <div class="modal" id="editindikator" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    FORM EDIT SEKOLAH
                                </h5>
                                <button type="button" class="closeModal" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="nama_indikator">Nama Kategori</label>
                                            <input type="text" name="nama" value="${data.NAMA_INDIKATOR}" class="form-control" id="nama_indikator"
                                                aria-describedby="texthelp" />
                                            <input type="hidden" name="id" value="${data.ID_INDIKATOR}" class="form-control" id="id_indikator"
                                                aria-describedby="texthelp" />
                                        </div>
                                    </div>
                                    <span>Pilih Peran Untuk Indikator</span>
                                    <?php foreach ($dataperan as $data): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" name="peran[]" type="checkbox" value=<?= $data[
                                            'ID_PERAN'
                                        ] ?> id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            <?= $data['NAMA_PERAN'] ?>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="modal-footer">
                                        <button type="button" class="btn closeModal btn-secondary" data-dismiss="modal">
                                            Tutup
                                        </button>
                                        </button>
                                        <button type="submit" id="btn1" class="btn btn-primary">Update</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            $("#edit").html(items);
            let namaold = $("#nama_indikator").val();
            $("#editindikator").modal("show");
            $(".closeModal").on("click", function() {
                $('.modal-backdrop').remove();
                $("#edit").html('');
            })
            $("#btn1").on("click", function() {
                let nama = $("#nama_indikator").val();
                let id = $("#id_indikator").val();
                Swal.fire({
                    title: 'Update Indikator',
                    text: 'Apakah Yakin Mengganti ' + namaold + "\n Menjadi " +
                        nama,
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    icon: "info",
                    reverseButtons: true,
                    position: "top"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData1 = new FormData();
                        formData1.append("id", dataid);
                        formData1.append("nama", nama);
                        fetch('editindikator.php', {
                            method: "POST",
                            body: formData1
                        }).then(response => {
                            response.json();
                        }).then(responseJson => {
                            Swal.fire({
                                title: 'Tersimpan!',
                                text: 'Perubahan Nama Indikator Berhasil',
                                icon: 'success',
                                position: "top",
                                showConfirmButton: false
                            })
                            $("#editindikator").modal('dispose');
                            setTimeout(() => {
                                window.location.reload(true);
                            }, 1000);
                        })
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Tidak Berhasil Merubah Nama Indikator',
                            icon: 'error',
                            position: "top"
                        })
                        $("#editindikator").modal('dispose');

                    }
                })
            })
        })
        e.preventDefault();
    });
    $(".btn-delete").on("click", function() {
        let dataid = $(this).attr("data-value")
        Swal.fire({
            icon: "warning",
            position: "top",
            title: "Apakah anda yakin ?",
            text: "Data Indikator Akan Terhapus",
            showConfirmButton: true,
            showCancelButton: true,
            reverseButtons: true
        }).then((result => {
            if (result.isConfirmed) {
                let formData = new FormData;
                formData.append('id', dataid);
                fetch("hapusIndikator.php", {
                    method: "POST",
                    body: formData
                }).then(response => {
                    return response.json()
                    console.log(response)
                }).then(responseJson => {
                    Swal.fire({
                        title: 'Terhapus!',
                        text: 'Indikator Berhasil Dihapus',
                        icon: 'success',
                        position: "top",
                        showConfirmButton: false
                    })
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 1000);
                })
            } else {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Indikator Gagal Dihapus',
                    icon: 'error',
                    position: "top",
                    showConfirmButton: false
                })
                setTimeout(() => {
                    window.location.reload(true);
                }, 1000);
            }
        }))
    })
    $(".btn-add").on("click", function() {
        let nama = $("#inputindikator").val();
        let data = []
        $(':checkbox:checked').each(function(i) {
            data[i] = $(this).val();
        })
        if (data.length == 0) {
            Swal.fire({
                title: 'Error!',
                text: 'Peran Indikator Harus Dipilih!',
                icon: 'error',
                position: "top",
                showConfirmButton: true
            })
        } else if (nama.length == 0) {
            Swal.fire({
                title: 'Error!',
                text: 'Nama Indikator Tidak Boleh Kosong!',
                icon: 'error',
                position: "top",
                showConfirmButton: true
            })
        } else {
            let formData = new FormData;
            formData.append("idperan", data);
            formData.append("nama", nama);
            fetch("buatIndikator.php", {
                method: "POST",
                body: formData
            }).then(response => {
                return response.json()
            }).then(responseJson => {
                Swal.fire({
                    title: 'Terhapus!',
                    text: 'Indikator Berhasil Dihapus',
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
    </script>
</body>

</html>