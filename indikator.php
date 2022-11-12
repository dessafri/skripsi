<?php
session_start();
require './functions.php';
if ($_SESSION['id'] != '1') {
    header('location: login.php');
    exit();
} else {
    $datas = query('SELECT * FROM indikator');
    $dataperan = query('SELECT * FROM peran');

    $peran = query(
        'SELECT ID_INDIKATOR,NAMA_INDIKATOR, GROUP_CONCAT(NAMA_PERAN) as NAMA_PERAN FROM ( SELECT indikator.ID_INDIKATOR, indikator.NAMA_INDIKATOR,peran.NAMA_PERAN FROM (indikator LEFT JOIN kriteria_peran ON indikator.ID_INDIKATOR = kriteria_peran.ID_INDIKATOR) LEFT JOIN peran ON kriteria_peran.ID_PERAN = peran.ID_PERAN ) AS A GROUP BY ID_INDIKATOR'
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
            <?php require './nav.php'; ?>

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
                        <?php if (count($peran) > 0) {
                            $nomer = 1;
                            foreach ($peran as $peran): ?>
                        <tr>
                            <td class="text-center"><?= $nomer ?></td>
                            <td class="text-center">
                                <?= $peran['NAMA_INDIKATOR'] ?>
                            </td>
                            <td class="text-center">
                                <?= $peran['NAMA_PERAN'] ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-edit" data-value=<?= $peran[
                                    'ID_INDIKATOR'
                                ] ?> data-toggle="modal" data-target="#editindikator" type="button">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger btn-delete" data-value="<?= $peran[
                                    'ID_INDIKATOR'
                                ] ?>">
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
                    <div class="form-group">
                        <select class="custom-select" id="selectAtribut">
                            <option selected value="0">Pilih Atribut Indikator</option>
                            <option value="BENEFIT">BENEFIT</option>
                            <option value="COST">COST</option>
                        </select>
                        <span style="font-size: 12px;">BENEFIT jika pengukuran indikator lebih banyak lebih
                            baik</span>
                        <span style="font-size: 12px;" class="d-inline-block mt-0">COST jika pengukuran
                            indikator lebih sedikit lebih baik</span>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="inputindikator">Masukkan Bobot Indikator</label>
                            <input type="text" class="form-control" name="bobot" id="inputbobot"
                                aria-describedby="texthelp" />
                            <span style="font-size: 12px;" class="d-inline-block mt-0">Nilai Bobot Antara 0 - 1</span>
                        </div>
                    </div>
                    <span>Pilih Peran Untuk Indikator</span>
                    <?php foreach ($dataperan as $data): ?>
                    <div class="form-check">
                        <input class="form-check-input" name="peran" type="checkbox" value=<?= $data[
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
    let arrayCheck = [];
    let idindikator;
    $(".btn-edit").on("click", function(e) {
        let dataid = $(this).attr("data-value");
        let arrayCheck = [];
        let formData = new FormData();
        formData.append("id", dataid);
        fetch('dataperindikator.php', {
            method: "POST",
            body: formData
        }).then(response => {
            return response.json();
        }).then(responseJson => {
            let data = responseJson;
            $("input:checkbox").prop('checked', false);
            let atribut = data[0].ATRIBUT
            let bobot = data[0].BOBOT

            function mapData() {
                let items = `
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
                                            <input type="text" name="nama" value="${data[0].NAMA_INDIKATOR}" class="form-control" id="nama_indikator"
                                                aria-describedby="texthelp" />
                                            <input type="hidden" name="id" value="${data[0].ID_INDIKATOR}" class="form-control" id="id_indikator"
                                                aria-describedby="texthelp" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <select class="custom-select" id="selectAtributedit">
                                            <option selected value="0">Pilih Atribut Indikator</option>
                                            <option value="BENEFIT">BENEFIT</option>
                                            <option value="COST">COST</option>
                                        </select>
                                        <span style="font-size: 12px;">BENEFIT jika pengukuran indikator lebih banyak lebih
                                            baik</span>
                                        <span style="font-size: 12px;" class="d-inline-block mt-0">COST jika pengukuran
                                            indikator lebih sedikit lebih baik</span>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="inputindikator">Masukkan Bobot Indikator</label>
                                            <input type="text" class="form-control" name="bobot" id="inputbobotedit"
                                                aria-describedby="texthelp" />
                                            <span style="font-size: 12px;" class="d-inline-block mt-0">Nilai Bobot Antara 0 - 1</span>

                                        </div>
                                    </div>
                                    <span>Pilih Peran Untuk Indikator</span>
                                    <?php foreach ($dataperan as $data): ?>
                                    <div class="form-check">
                                        <input class="form-check-input selectbox" name="peranedit" type="checkbox" value=<?= $data[
                                            'ID_PERAN'
                                        ] ?>>
                                        <label class="form-check-label">
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
                `
                data.map(data => {

                    arrayCheck.push(data.ID_PERAN);
                })
                $("#edit").html(items);
            }
            async function setSelect() {
                await mapData()
                $.each(arrayCheck, function(i, val) {
                    $("input[value='" + val + "']").prop('checked', true);
                })
            }
            setSelect();
            $("#inputbobotedit").val(bobot)
            $("#selectAtributedit").val(atribut)
            let namaold = $("#nama_indikator").val();
            $("#editindikator").modal("show");
            $(".closeModal").on("click", function() {
                $('.modal-backdrop').remove();
                $("#edit").html('');
            })
            $("#btn1").on("click", function() {
                let nama = $("#nama_indikator").val();
                let atribut = $("#selectAtributedit").val();
                let bobot = $("#inputbobotedit").val();
                let id = $("#id_indikator").val();
                let dataSelectBox = []
                $('.selectbox:checked').each(function(i) {
                    dataSelectBox[i] = $(this).val()
                })
                if (data.length == 0) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Peran Indikator Harus Dipilih!',
                        icon: 'error',
                        position: "top",
                        showConfirmButton: true
                    })
                } else if (nama.length == 0 || nama === " " || atribut == "0" || bobot ===
                    " " || bobot.length == 0) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Form Tidak Boleh Kosong!',
                        icon: 'error',
                        position: "top",
                        showConfirmButton: true
                    })
                } else {
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
                            formData1.append("atribut", atribut);
                            formData1.append("bobot", bobot);
                            formData1.append("idPeran", dataSelectBox);
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
                }
            })
        })
        e.preventDefault();
    });
    $(".btn-delete").on("click", function() {
        let dataid = $(this).attr("data-value")
        console.log(dataid);
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
        let atribut = $("#selectAtribut").val();
        let bobot = $("#inputbobot").val();
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
        } else if (nama.length == 0 || nama === " " || atribut == "0" || bobot === " " || bobot.length == 0) {
            Swal.fire({
                title: 'Error!',
                text: 'Form Tidak Boleh Kosong!',
                icon: 'error',
                position: "top",
                showConfirmButton: true
            })
        } else {
            let formData = new FormData;
            formData.append("idperan", data);
            formData.append("nama", nama);
            formData.append("atribut", atribut);
            formData.append("bobot", bobot);
            fetch("buatIndikator.php", {
                method: "POST",
                body: formData
            }).then(response => {
                return response.json()
            }).then(responseJson => {
                Swal.fire({
                    title: 'Tersimpan!',
                    text: 'Indikator Berhasil Dibuat',
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