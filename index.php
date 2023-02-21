<?php

session_start();
date_default_timezone_set('Asia/Singapore');

if (isset($_SESSION["LOGIN"])) {
    header("Location: admin/index.php");
    exit;
}

require 'koneksi.php';

if (isset($_POST["LOGIN"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $login_terakhir = date('Y-m-d H:i:s');

    $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {

            $_SESSION["login"] = true;
            $_SESSION["peran"] = $row["peran"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["id"] = $row["id"];

            if ($row["peran"] == "ADMIN") {
                // mengupdate data ke database
                $update = mysqli_query($conn, "UPDATE pengguna SET login_terakhir = '$login_terakhir' WHERE username= '$username'");
                header("Location: admin/index.php");
            } else if ($row["peran"] == "user") {
                $update = mysqli_query($conn, "UPDATE pengguna SET login_terakhir = '$login_terakhir' WHERE username = '$username'");
                header("Location: user/index.php");
            }

            exit;
        }
    }

    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login | SKRIPSI FTI UNISKA</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylsheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login.logo -->
        <div classs="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>SKRIPSI</b><br>FTI UNISKA</h1>
            </div>
            <div class="card-body">
                <p class="login-box-mg">Masukkan username dan password anda</p>
                <?php if (isset($login)) { ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="buuton" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        Username atau Password salah...!
                    </div>
                <?php } ?>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col">
                            <button type="submit" class="btn btn-block btn-primary" name="LOGIN">Masuk</button>
                            <a href="#" class="btn btn-block btn-danger">Buat Akun</a>
                        </div>
                    </div>
                </form>

                <!-- /.social-auth-links -->

                <p class="mt-3">
                    <a href="#">Lupa Password?</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login.box -->

    <!-- jQuery -->
    <script src="plugins/jQuery/jQuery.min.js"></script>
    <!-- bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>