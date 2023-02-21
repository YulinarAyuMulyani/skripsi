<?php

session_start();
if ($_SESSION["peran"] == "USER") {
    header("Location: logout.php");
    exit;
}
if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include '../koneksi.php';

$id = $_GET["id"];
$query_karyawan = "SELECT * FROM karyawan WHERE id = $id";
$result_karyawan = mysqli_query($conn, $query_karyawan);
$row_karyawan = mysqli_fetch_assoc($result_karyawan);

if (isset($_POST["submit"])) {

    $nik = htmlspecialchars($_POST["nik"]);
    $nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
    $handphone = htmlspecialchars($_POST["handphone"]);
    $email = htmlspecialchars($_POST["email"]);
    $pengguna_id = htmlspecialchars($_POST["pengguna_id"]);

    $query = "UPDATE karyawan SET
                nik = '$nik', 
                nama_lengkap = '$nama_lengkap', 
                handphone = '$handphone', 
                email ='$email',
                pengguna_id ='$pengguna_id'
                WHERE id = $id
            ";
    $edit = mysqli_query($conn, $query);

    if ($edit) {
        echo "<script type='text/javascript'>
                alert('Data berhasil disimpan...!');
                document.location.href = 'karyawan.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Data GAGAL disimpan...!');
                document.location.href = 'karyawan-edit.php?id=$id';
            </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=dvice-width, initial-scale=1">
    <title>Tambah Data Karyawan | PRAKTIKUM FTI UNISKA 2022</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include "theme-header.php"; ?>

        <?php include "theme-sidebar.php"; ?>

        <!-- Content Wrapper, Contains page content -->
        <div class="content-wrapper">
            <!-- Content Headder (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Karyawan</h1>
                        </div>
                        <div class="col-sm-6">
                            <o1 class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="karyawan.php">Karyawan</a></li>
                                <li class="breadcrumb-item active">Edit Karyawan</li>
                            </o1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nik">NIK :</label>
                                            <input type="number" class="form-control" id="nik" name="nik" value="<?php echo $row_karyawan["nik"]; ?>" placeholder="Nomor Induk Kependudukan" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap :</label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $row_karyawan["nama_lengkap"]; ?>" placeholder="Nama Lengkap Tanpa Titel" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="handphone">Handphone :</label>
                                            <input type="text" class="form-control" id="handphone" name="handphone" value="<?php echo $row_karyawan["handphone"]; ?>" placeholder="Nomor HP Aktif" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email :</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row_karyawan["email"]; ?>" placeholder="Email Aktif" required>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-1" name="submit">Simpan</button>
                                        <a href="karyawan.php" class="btn btn-secondary">Cancel</a>
                                    </div>
                                    <input type="hidden" name="pengguna_id" value="<?php echo $_SESSION["id"]; ?>">
                                </form>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include "theme-footer.php"; ?>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Boostrap 4 -->
    <script src="../plugins/boostrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
</body>

</html>