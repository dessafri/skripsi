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
    <title>Kelola Kuesioner</title>
</head>

<body>
    <div id="wrapper">
        <div class="sidebar">
            <?php require './sidebar.php'; ?>

        </div>
        <div class="main" id="kelola_kuesioner">
            <!-- As a heading -->
            <div class="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col col-10">
                            <nav class="navbar navbar-light bg-light">
                                <h1 class="navbar-brand mb-0">
                                    KELOLA KUESIONER
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
                        DAFTAR KUESIONER
                    </h2>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#kuesionermodal">
                        <i class="fa-solid fa-plus"></i>
                        Buat Kuesioner
                    </button>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">NO</th>
                            <th scope="col" class="text-center">JUDUL</th>
                            <th scope="col" class="text-center">SEKOLAH</th>
                            <th scope="col" class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">
                                Pengukuran Kualitas Blended Learning
                            </td>
                            <td class="text-center">SMA NEGERI 1 LAMONGAN</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
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
    <div class="modal fade" id="kuesionermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        FORM PEMBUATAN KUESIONER
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="inputjudul">Masukkan Judul Kuesioner</label>
                                <input type="text" class="form-control" id="inputjudul" aria-describedby="texthelp" />
                            </div>
                            <div class="form-group">
                                <label for="indikatorselect">
                                    Pilih Peran Untuk Kuesioner
                                </label>
                                <select class="form-control" id="indikatorselect">
                                    <option>-- Silahkan Pilih Indikator Pertanyaan --</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="indikatorselect">
                                    Pilih Indikator
                                </label>
                                <select class="form-control" id="indikatorselect">
                                    <option>-- Silahkan Pilih Indikator --</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputpertanyaan">Pertanyaan 1</label><br>
                                <label>KUALITAS</label>
                                <input type="text" class="form-control text-muted" id="inputpertanyaan"
                                    aria-describedby="emailHelp" />
                                <p style="font-size: 14px; margin-bottom: -2px; font-weight: bold;">
                                    Ketentuan Jawaban Kualitas
                                </p>
                                <span style="display: inline-block; font-size: 12px; opacity: 0.6; padding-top: -5px;">
                                    Tersedia wifi di setiap ruang kelas maka masuk dalam kategori sangat baik
                                </span>
                                <br />
                                <span style="display: inline-block; font-size: 12px; opacity: 0.6; padding-top: -5px;">
                                    Tersedia wifi di lebih dari 10 titik maka masuk kategori cukup baik
                                </span>
                                <br />
                                <span style="display: inline-block; font-size: 12px; opacity: 0.6; padding-top: -5px;">
                                    Tersedia wifi lebih dari 5-10 titik maka masuk kategori baik
                                </span>
                                <br />
                                <span style="display: inline-block; font-size: 12px; opacity: 0.6; padding-top: -5px;">
                                    Tersedia wifi kurang dari 5 titik maka masuk kategori kurang baik
                                </span>
                                <br />
                                <span style="display: inline-block; font-size: 12px; opacity: 0.6; padding-top: -5px;">
                                    Tidak tersedia wifi maka masuk kategori sangat kurang baik
                                </span>
                            </div>
                            <div class="form-group">
                                <label>KEPENTINGAN</label>
                                <input type="text" class="form-control text-muted" id="inputpertanyaan"
                                    aria-describedby="emailHelp" />
                            </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="button" class="btn btn-primary">Buat Kuesioner</button>
                </div>
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
</body>

</html>