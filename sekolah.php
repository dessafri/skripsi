<?php
require './functions.php';

$datas = query('SELECT * FROM sekolah');

if (isset($_POST['submit'])) {
    putDataSekolah($_POST);
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
    <title>Kelola Sekolah</title>
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
                                    KELOLA SEKOLAH
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
                        DAFTAR SEKOLAH
                    </h2>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#indikatorsekolah">
                        <i class="fa-solid fa-plus"></i>
                        Buat Sekolah
                    </button>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">NO</th>
                            <th scope="col" class="text-center">NAMA SEKOLAH</th>
                            <th scope="col" class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $nomer = 1;
                        foreach ($datas as $data): ?>
                        <tr>
                            <td class="text-center"><?= $nomer ?></td>
                            <td class="text-center">
                                <?= $data['NAMA_SEKOLAH'] ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-edit" data-value=<?= $data[
                                    'ID_SEKOLAH'
                                ] ?> data-toggle="modal" data-target="#editindikatorsekolah" type="button">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php $nomer++;endforeach;
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
    <div class="modal fade" id="indikatorsekolah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        FORM PEMBUATAN SEKOLAH
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="inputsekolah">Masukkan Nama Sekolah</label>
                                <input type="text" name="nama" class="form-control" id="inputsekolah"
                                    aria-describedby="texthelp" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Tutup
                            </button>
                            <button type="submit" name="submit" class="btn btn-primary">Buat Sekolah</button>
                        </div>
                    </form>
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
        let dataid = $(this).attr("data-value")
        let formData = new FormData();
        formData.append("id", dataid);
        fetch('datapersekolah.php', {
            method: "POST",
            body: formData
        }).then(response => {
            return response.json();
        }).then(responseJson => {

            let data = responseJson;

            let items = data.map(data => `
            <div class="modal" id="editindikatorsekolah" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <label for="nama_sekolah">Nama Sekolah</label>
                                            <input type="text" name="nama" value="${data.NAMA_SEKOLAH}" class="form-control" id="nama_sekolah"
                                                aria-describedby="texthelp" />
                                            <input type="hidden" name="id" value="${data.ID_SEKOLAH}" class="form-control" id="id_sekolah"
                                                aria-describedby="texthelp" />
                                        </div>
                                    </div>
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
            let namaold = $("#nama_sekolah").val();
            $("#editindikatorsekolah").modal("show");
            $(".closeModal").on("click", function() {
                $('.modal-backdrop').remove();
                $("#editform").html('');
                console.log("sukses")
            })
            $("#btn1").on("click", function() {
                let nama = $("#nama_sekolah").val();
                let id = $("#id_sekolah").val();
                Swal.fire({
                    title: 'Update Nama Sekolah',
                    text: 'Apakah Yakin Mengganti ' + namaold + "\n Menjadi " + nama,
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
                        fetch('editsekolah.php', {
                            method: "POST",
                            body: formData1
                        }).then(response => {
                            response.json();
                        }).then(responseJson => {
                            Swal.fire({
                                title: 'Tersimpan!',
                                text: 'Perubahan Nama Sekolah Berhasil',
                                icon: 'success',
                                position: "top",
                                showConfirmButton: false
                            })
                            $("#editindikatorsekolah").modal('dispose');
                            setTimeout(() => {
                                window.location.reload(true);
                            }, 1000);
                        })
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Tidak Berhasil Merubah Nama Sekolah',
                            icon: 'error',
                            position: "top"
                        })
                        $("#editindikatorsekolah").modal('dispose');

                    }
                })
            })
        })
        e.preventDefault();
    });
    </script>
</body>

</html>