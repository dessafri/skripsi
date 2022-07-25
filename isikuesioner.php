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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/style/main.css">
    <style>
    .swal2-popup {
        font-size: 12px !important;
        font-family: Georgia, serif;
    }

    .main {
        width: 100%;
        min-height: 100vh;
        background-color: #b5b5b5;
    }

    .isiKuesioner {
        width: 70%;
        min-height: max-content;
        margin: auto;
        background-color: white;
        margin-top: 30px;
        border-radius: 20px;
        margin-bottom: 75px;
        padding-bottom: 30px;
    }

    .clickStyle {
        cursor: pointer;
        border: 2px solid red;
        box-shadow: 1px 5px 5px -2px rgba(0, 0, 0, 0.33);
        background-color: #f5f752;
        transform: scale(1.1);
    }

    #namaInput {
        border: none;
        border-bottom: 1px solid black;
        border-radius: 0;
        margin-top: -10px;
    }

    .icon {
        width: 50px;
        height: 50px;
        margin-top: 20px;
    }

    .card {
        width: 100%;
        min-height: 50px;
        border: 2px solid black;
        border-radius: 20px;
        margin-top: 10px;
        transform: scale(.9);
    }

    .card span {
        font-size: 18px;
        font-weight: bold;
    }

    .card:hover {
        cursor: pointer;
        border: 2px solid blue;
        box-shadow: 1px 5px 5px -2px rgba(0, 0, 0, 0.33);
        background-color: #f5f752;
        transform: scale(1.1);
    }

    .custom-select {
        width: 30%;
    }

    .pertanyaan {
        margin-top: 30px;
        border-left: 4px solid #5693f5;
        border-radius: 10px;
        padding-left: 10px;
        box-shadow: 3px 3px 10px -2px rgba(0, 0, 0, 0.39);
        padding-bottom: 10px;
    }

    .pertanyaan p {
        font-weight: bold;
        font-size: 16px;
    }

    .pertanyaan span {
        display: inline-block;
        font-size: 18px;
        font-weight: 600;
    }
    </style>
    <title>Kuesioner</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <div id="wrapper">
        <div class="main">
            <div class="isiKuesioner">
                <div class="navigation">
                    <div class="container">
                        <div class="row">
                            <div class="col col-12" style="display:flex;">
                                <div class="icon">
                                    <i class="fa-solid fa-2xl fa-list-check" style="margin: auto;"></i>
                                </div>
                                <div class="text">
                                    <nav class="navbar navbar-light bg-light">
                                        <h1 class="navbar-brand mb-0">
                                            KUESIONER
                                        </h1>
                                    </nav>
                                    <span>SISTEM PENGUKURAN KUALITAS BLENDED LEARNING</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container" style="margin-top: 30px;">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="namaInput">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilih Sekolah</label><br>
                            <select class="custom-select" id="selectSekolah">
                                <option selected value="0">----- Silahkan Memilih Sekolah -----</option>
                                <?php
                                $sekolah = query('SELECT * FROM sekolah');
                                foreach ($sekolah as $data): ?>
                                <option value=<?= $data[
                                    'ID_SEKOLAH'
                                ] ?>><?= $data['NAMA_SEKOLAH'] ?></option>
                                <?php endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="peran">
                            <label for="exampleInputEmail1">Pilih Peran</label><br>
                            <select class="custom-select" id="peranSelect">
                                <option selected value="0">----- Silahkan Memilih Peran -----</option>
                                <?php
                                $peran = query('SELECT * FROM peran');
                                foreach ($peran as $data): ?>
                                <option value=<?= $data[
                                    'ID_PERAN'
                                ] ?>><?= $data['NAMA_PERAN'] ?></option>
                                <?php endforeach;
                                ?>
                            </select>
                        </div>
                        <div id="data-pertanyaan"></div>
                        <div class="text-center">
                            <button class="btn btn-primary mt-3" style="display:none; width: 50%; min-height:35px;"
                                id="submitData" type="button">SUBMIT</button>
                        </div>
                    </form>
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
    <script src="assets/idb/lib/idb.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    let panjangDataPertanyaan = 0;
    $("#peranSelect").on("change", function() {
        $("#data-pertanyaan").html('')
        let valueSelect = $("#peranSelect").find(":selected").val();
        if (valueSelect > 0) {
            let formData = new FormData()
            formData.append("id", valueSelect)
            fetch('dataperisikuesioner.php', {
                method: "POST",
                body: formData
            }).then(response => {
                return response.json()
            }).then(responseJson => {
                let data = responseJson
                let index = 1;
                let pertanyaan = 1;
                let idPertanyaan = 1;
                let idKetentuanJawaban = 1;
                let idRadio = 1;
                let arrayId = data.map(data => `
                <div class="pertanyaan">
                            <span>Pertanyaan ${ pertanyaan++}</span>
                            <div class="text-center loading">
                            <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col col-6 kualitas" id="pertanyaanKualitas" style="display:none;">
                                    <p id="${idPertanyaan++}" class="pertanyaanKualitas"></p>
                                    <div class="form-check">
                                        <input class="form-check-input" idper="${data.ID_PERTANYAAN}" type="radio" name="jawabanKualitas${index}"
                                            id="radio${idRadio++}">
                                        <label class="form-check-label" id="label${idKetentuanJawaban++}">
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" idper="${data.ID_PERTANYAAN}" type="radio" name="jawabanKualitas${index}"
                                            id="radio${idRadio++}">
                                        <label class="form-check-label"id="label${idKetentuanJawaban++}">
                                            
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" idper="${data.ID_PERTANYAAN}" type="radio" name="jawabanKualitas${index}"
                                            id="radio${idRadio++}">
                                        <label class="form-check-label" id="label${idKetentuanJawaban++}">
                                            
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" idper="${data.ID_PERTANYAAN}" type="radio" name="jawabanKualitas${index}"
                                            id="radio${idRadio++}">
                                        <label class="form-check-label" id="label${idKetentuanJawaban++}">
                                            
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" idper="${data.ID_PERTANYAAN}" type="radio" name="jawabanKualitas${index}"
                                            id="radio${idRadio++}">
                                        <label class="form-check-label" id="label${idKetentuanJawaban++}">
                                            
                                        </label>
                                    </div>
                                </div>
                                <div class="col col-6 kepentingan" style="display:none;">
                                    <p id="${idPertanyaan++}" class="pertanyaanKepentingan"></p>
                                    <div class="form-check">
                                        <input class="form-check-input" idper="${data.ID_PERTANYAAN}" type="radio" name="jawabanKepentingan${index}"
                                            id="radio${idRadio++}">
                                        <label class="form-check-label" id="label${idKetentuanJawaban++}">
                                            
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" idper="${data.ID_PERTANYAAN}" type="radio" name="jawabanKepentingan${index}"
                                            id="radio${idRadio++}">
                                        <label class="form-check-label" id="label${idKetentuanJawaban++}">
                                            
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" idper="${data.ID_PERTANYAAN}" type="radio" name="jawabanKepentingan${index}"
                                            id="radio${idRadio++}">
                                        <label class="form-check-label" id="label${idKetentuanJawaban++}">
                                            
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" idper="${data.ID_PERTANYAAN}" type="radio" name="jawabanKepentingan${index}"
                                            id="radio${idRadio++}">
                                        <label class="form-check-label" id="label${idKetentuanJawaban++}">
                                            
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" idper="${data.ID_PERTANYAAN}" type="radio" name="jawabanKepentingan${index}"
                                            id="radio${idRadio++}">
                                        <label class="form-check-label" id="label${idKetentuanJawaban++}">
                                            
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="${index++}" style="display:none;"></div>
                `)
                $("#data-pertanyaan").html(arrayId);
                panjangDataPertanyaan = idPertanyaan - 1;
            })
            setTimeout(() => {
                $(".loading").remove()
                $(".kualitas,.kepentingan").css({
                    display: "block"
                })
                $("#submitData").css({
                    display: "inline-block"
                })
                fetch("datapertanyaan.php", {
                    method: "POST",
                    body: formData
                }).then(response => {
                    return response.json()
                }).then(responseJson => {
                    let i = 1;
                    let formData1 = new FormData()
                    let data = responseJson.map(data => {
                        let pertanyaan = $(`#${i++}`)
                        pertanyaan.html(data.NAMA_PERTANYAAN)
                        pertanyaan.attr("data-id", data.ID_PERTANYAAN)
                    })
                    formData1.append("id", valueSelect);
                    fetch("dataketentuanjawaban.php", {
                        method: "POST",
                        body: formData1
                    }).then(response => {
                        return response.json()
                    }).then(responseJson => {
                        let i = 1;
                        let val = 1;
                        let data = responseJson.map(data => {
                            let ketentuanJawaban = $(`#label${i++}`)
                            ketentuanJawaban.html(data.KETENTUAN_JAWABAN)
                            let jawabanValue = $(`#radio${val++}`)
                            jawabanValue.attr("value", data.NILAI_JAWABAN)
                        })
                    })
                })
            }, 1000);
        }
    })
    $("#submitData").on("click", function() {
        let nama = $("#namaInput").val()
        let sekolah = $("#selectSekolah").val()
        let peran = $("#peranSelect").val()
        let arrayJawaban = []
        let arrayIdPertanyaan = []
        $(':radio:checked').each(function() {
            let data = $(this).val()
            arrayJawaban.push(data)
        });
        $(".pertanyaanKualitas,.pertanyaanKepentingan").each(function() {
            let data = $(this).attr("data-id")
            arrayIdPertanyaan.push(data)
        })
        let panjangJawaban = arrayJawaban.length
        if (nama.length == 0 || nama === " " || sekolah == 0 || panjangJawaban != panjangDataPertanyaan) {
            Swal.fire({
                title: 'Error!',
                text: 'Harap Mengisi Semua Form',
                icon: 'error',
                position: "top",
                showConfirmButton: true
            })
        } else {
            let formData = new FormData();
            formData.append("nama", nama)
            formData.append("idSekolah", sekolah)
            formData.append("idPeran", peran)
            formData.append("idPertanyaan", arrayIdPertanyaan)
            formData.append("Jawaban", arrayJawaban)
            fetch("buatjawaban.php", {
                method: "POST",
                body: formData
            }).then(response => {
                return response.json()
            }).then(responseJson => {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Terimakasih Sudah Mengisi Kuesioner',
                    icon: 'success',
                    position: "top",
                    showConfirmButton: false
                })
                setTimeout(() => {
                    window.location.reload(true);
                }, 1500);
            })
        }
    })
    </script>
</body>

</html>