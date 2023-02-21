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
$query_guru = "SELECT * FROM guru WHERE id = $id";
$result_guru = mysqli_query($conn, $query_guru);
$row_guru = mysqli_fetch_assoc($result_guru);

if (isset($POST["submit"])) {
	
	$nik = htmlspecialchars($_POST["nik"]);
	$nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
	$handphone = htmlspecialchars($_POST["handphone"]);
    $email = htmlspecialchars($_POST["email"]);
	$tanggal_masuk = htmlspecialchars($_POST["tanggal_masuk"]);
    $pengguna_id = htmlspecialchars($_POST["pengguna_id"]);

	$query = " UPDATE guru SET nik = '$nik', nama_lengkap = '$nama_lengkap', handphone = '$handphone', email = '$email', pengguna_id = '$pengguna_id' WHERE id = $id ";
	$edit = mysqli_query($conn, $query);

	if ($edit) {
		
		echo "<script type='text/javasript'>
		alert('Data berhasil disimpan....!');
		document.location.herf = 'guru.php';
		</script>";
	} else {
		echo "<script type='text/javasript'>
		alert('Data Gagal Disimpan...!');
		document.location.herf = 'guru-edit.php?id=$id';
		</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Guru | SKRIPSI FTI UNISKA 2023 </title>
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
                            <h1>Data Guru</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li> 
                                <li class="breadcrumb-item"><a href="guru.php"></a>Guru</li>
                                <li class="breadcrumb-item active">Edit Guru</li>
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
                                   <h3 class="card-title">Edit Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <form action="" method="post">
                                <div class="card-body">
                                	<div class="form-group">
                                	<label for="nik">NIK :</label>
                                	<input type="number" class="form-control" id="nik" name="nik" placeholder="Nomor Induk Kepedudukan" required>	
                                	</div>
                                	<div class="form-group">
                                	<label for="nama_lengkap">Nama Lengkap :</label>
                                	<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap Tanpa Title" required>	
                                	</div>
                                	<div class="form-group">
                                	<label for="handphone">Handphone :</label>
                                	<input type="text" class="form-control" id="handphone" name="handphone" placeholder="Nomor Hp Aktif" required>	
                                	</div>
                                	<div class="form-group">
                                	<label for="email">Email</label>
                                	<input type="email" class="form-control" id="email" name="email" placeholder="Email Aktif" required>	
                                	</div>
                                    
                                    <input type="hidden" name="pengguna_id" value="<?php echo $_SESSION["id"]; ?>">               
                                    
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