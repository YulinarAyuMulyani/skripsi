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
$query_bagian = "SELECT * FROM bagian WHERE id = $id";
$result_bagian = mysqli_query($conn, $query_bagian);
$row_bagian = mysqli_fetch_assoc($result_bagian);

if (isset($_POST["submit"])) {

    $nama_bagian = htmlspecialchars($_POST["nama_bagian"]);
    $karyawan_id = htmlspecialchars($_POST["karyawan_id"]);
    $lokasi_id = htmlspecialchars($_POST["lokasi_id"]);

    $query = "UPDATE bagian SET
                nama_bagian = '$nama_bagian', 
                karyawan_id = '$karyawan_id', 
                lokasi_id = '$lokasi_id' 
                WHERE id = $id
            ";
    $edit = mysqli_query($conn, $query);

    if ($edit) {
        echo "<script type='text/javascript'>
                alert('Data berhasil disimpan...!');
                document.location.href = 'bagian.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Data GAGAL disimpan...!');
                document.location.href = 'bagian-edit.php?id=$id';
            </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=dvice-width, initial-scale=1">
    <title>Tambah Data Bagian | PRAKTIKUM FTI UNISKA 2022</title>
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
                <div class="container-fuild">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Bagian</h1>
                        </div>
                        <div class="col-sm-6">
                            <o1 class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="bagian.php">Bagian</a></li>
                                <li class="breadcrumb-item active">Tambah Bagian</li>
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
                                    <h3 class="card-title">Tambah Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama_bagian">Nama Bagian</label>
                                            <input type="text" class="form-control" id="nama_bagian" name="nama_bagian" value="<?php echo $row_bagian["nama_bagian"]; ?>" placeholder="Nama Bagian" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="karyawan_id">Karyawan ID</label>
                                            <input type="text" class="form-control" id="karyawan_id" name="karyawan_id" value="<?php echo $row_bagian["karyawan_id"]; ?>" placeholder="Karyawan ID" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi_id">Lokasi ID</label>
                                            <input type="text" class="form-control" id="lokasi_id" name="lokasi_id" value="<?php echo $row_bagian["lokasi_id"]; ?>" placeholder="Lokasi ID" required>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn_primary mr-1" name="submit">Simpan</button>
                                        <a href="bagian.php" class="btn btn-secondary">Cancel</a>
                                    </div>
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