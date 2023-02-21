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
$query_jabatan = "SELECT * FROM jabatan WHERE id = $id";
$result_jabatan = mysqli_query($conn, $query_jabatan);
$row_jabatan = mysqli_fetch_assoc($result_jabatan);

if (isset($POST["submit"])) {
	
	$nama_jabatan = htmlspecialchars($_POST["nama_jabatan"]);


	$query = " UPDATE jabatan SET nama_jabatan = '$nama_jabatan' WHERE id = $id ";
	$edit = mysqli_query($conn, $query);

	if ($edit) {
		
		echo "<script type='text/javasript'>
		alert('Data berhasil disimpan....!');
		document.location.herf = 'jabatan.php';
		</script>";
	} else {
		echo "<script type='text/javasript'>
		alert('Data Gagal Disimpan...!');
		document.location.herf = 'jabatan-edit.php';
		</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Jabatan | SKRIPSI FTI UNISKA 2023 </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include "theme-header.php"; ?>

        <?php include "theme-sidebar.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Jabatan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li> 
                                <li class="breadcrumb-item"><a href="jabatan.php"></a>Jabatan</li>
                                <li class="breadcrumb-item active">Edit Jabatan</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    	 <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                   <h3 class="card-title">Tambah Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <form action="" method="post">
                                <div class="card-body">
                                	<div class="form-group">
                                	<label for="nama_jabatan">Nama Jabatan :</label>
                                	<input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Nama Jabatan" required>	
                                	</div>
                                	
                                    </div>
                                    <div class="card-footer">
                                    	<button type="submit" class="btn btn-primary mr-1" name="submit">Simpan</button>
                                    	<a href="jabatan.php" class="btn btn-secondary">Cancel</a>
                                    	
                                    </div>                            
                                    </form>
                                   </div>
                                     </div>
                                   </div>
                                   </div>
                               </selection>
                           </div>

                           <?php include "theme-footer.php"; ?>
                       </div>
                       <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    
</body>

</html>