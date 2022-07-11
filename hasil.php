<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="assets/style/main.css" />
    <title>Kelola HASIL</title>
  </head>
  <body>
    <div id="wrapper">
      <div class="sidebar">
        <ul class="navbar-nav" id="accordionSidebar">
          <a
            href="index.html"
            class="d-flex align-items-center justify-content-center"
          >
            <div class="container sidebar-title mt-2 mb-5 text-left">
              <span>SIPEKU</span>
            </div>
          </a>
          <li class="nav-item">
            <a class="nav-link sidebar-text" href="index.html">
              <span>Dashboard</span>
            </a>
          </li>
          <hr class="sidebar-bagi" />
          <li class="nav-item">
            <a class="nav-link sidebar-text" href="kuesioner.html">
              <span>Kelola Kuesioner</span>
            </a>
          </li>
          <hr class="sidebar-bagi" />
          <li class="nav-item">
            <a class="nav-link sidebar-text" href="pertanyaan.html">
              <span>Kelola Pertanyaan</span>
            </a>
          </li>
          <hr class="sidebar-bagi" />
          <li class="nav-item">
            <a class="nav-link sidebar-text" href="indikator.html">
              <span>Kelola Indikator</span>
            </a>
          </li>
          <hr class="sidebar-bagi" />
          <li class="nav-item active">
            <a class="nav-link sidebar-text" href="hasil.html">
              <span>Kelola Hasil</span>
            </a>
          </li>
          <hr class="sidebar-bagi" />
          <li class="nav-item">
            <a class="nav-link sidebar-text" href="kategori.html">
              <span>Kelola Kategori</span>
            </a>
          </li>
          <hr class="sidebar-bagi" />
          <li class="nav-item">
            <a class="nav-link sidebar-text" href="peran.html">
              <span>Kelola Peran</span>
            </a>
          </li>
          <hr class="sidebar-bagi" />
          <li class="nav-item">
            <a class="nav-link sidebar-text" href="sekolah.html">
              <span>Kelola Sekolah</span>
            </a>
          </li>
          <hr class="sidebar-bagi" />
        </ul>
      </div>
      <div class="main" id="kelola_pertanyaan">
        <!-- As a heading -->
        <div class="navigation">
          <div class="container">
            <div class="row">
              <div class="col col-10">
                <nav class="navbar navbar-light bg-light">
                  <h1 class="navbar-brand mb-0">
                    KELOLA HASIL
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
          <div
            style="
              display: flex;
              justify-content: space-between;
              margin-top: 30px;
              margin-bottom: 20px;
            "
          >
            <h2 class="brand-title">
              DAFTAR PERANGKINGAN SEKOLAH
            </h2>
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
            <tbody>
              <tr>
                <td class="text-center">1</td>
                <td class="text-center">
                  SMA NEGERI 1 LAMONGAN
                </td>
                <td class="text-center">SANGAT BAIK</td>
                <td class="text-center">98,5</td>
              </tr>
            </tbody>
          </table>
          <p style="font-size: 14px; opacity: 0.6; margin-bottom: -2px;">
            NILAI KATEGORI
          </p>
          <span style="display: inline-block; font-size: 12px; opacity: 0.6;">
            20 - 36 SANGAT TIDAK BAIK
          </span>
          <br />
          <span style="display: inline-block; font-size: 12px; opacity: 0.6;">
            37 - 52 TIDAK BAIK
          </span>
          <br />
          <span style="display: inline-block; font-size: 12px; opacity: 0.6;">
            53 - 68 CUKUP BAIK
          </span>
          <br />
          <span style="display: inline-block; font-size: 12px; opacity: 0.6;">
            69 - 84 BAIK
          </span>
          <br />
          <span style="display: inline-block; font-size: 12px; opacity: 0.6;">
            85 - 100 SANGAT BAIK
          </span>
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
    <script
      src="https://code.jquery.com/jquery-3.6.0.slim.js"
      integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
      integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
      crossorigin="anonymous"
    ></script>
  </body>
</html>