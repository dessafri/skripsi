<?php
require './functions.php';
session_start();

if (isset($_SESSION['id'])) {
    header('location: index.php');
    exit();
}
if (isset($_POST['submitlogin'])) {
    login($_POST);
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
    <link rel="stylesheet" href="assets/style/main.css" />
    <title>Login</title>
</head>

<body>
    <!-- navbar -->
    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">SIPEKU</a>
        </nav>
    </div>
    <!-- akhir navbar -->
    <!-- main -->
    <div class="container">
        <div class="main">
            <div class="row">
                <div class="col col-md-5 jumbo">
                    <h1>
                        SISTEM PENGUKURAN KUALITAS
                        <span>BLENDED LEARNING</span>
                    </h1>
                    <img src="assets/img/ilustrator-login.png" alt="Ilustrator-Login" />
                </div>
                <div class="col col-md-5 offset-2 formLogin">
                    <h2 class="text-center">SELAMAT DATANG DI SIPEKU</h2>
                    <form method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username"
                                aria-describedby="username" />
                        </div>
                        <div class="form-group inputPassword">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" />
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submitlogin" class="btn text-center">LOGIN</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <span>
                            Belum punya akun ?
                            <a href="register.html">Daftar</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir main -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>