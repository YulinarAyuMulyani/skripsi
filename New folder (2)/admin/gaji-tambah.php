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


if (isset($POST["submit"])) {
	
	$karyawan_id = htmlspecialchars($_POST["karyawan_id"]);
	$tahun = htmlspecialchars($_POST["tahun"]);
	$bulan = htmlspecialchars($_POST["bulan"]);
    $email = htmlspecialchars($_POST["email"]);
    $jabatan_id = htmlspecialchars($_POST["jabatan_id"]);

    $query_jabatan_pilih = "SELECT * FROM jabatan WHERE id = $jabatan_id";
    $result_jabatan_pilih = mysqli_query($conn, $query_jabatan_pilih);
    $row_jabatan_pilih = mysqli_fetch_assoc($result_jabatan_pilih);

    $gapok = $row_jabatan_pilih = ["gapok_jabatan"];
    $tunjangan = $row_jabatan_pilih =["tunjangan_jabatan"];
    $uang_makan = ($row_jabatan_pilih["uang_makan_perhari"] * 30);

	$query = "INSERT INTO penggajian values ('', '$karyawan_id', '$tahun', '$bulan', '$gapok', '$tunjangan', '$uang_makan') ";
	$simpan = mysqli_query($conn, $query);

	if ($simpan) {
		
		echo "<script type='text/javasript'>
		alert('Data berhasil disimpan....!');
		document.location.herf = 'gaji.php';
		</script>";
	} else {
		echo "<script type='text/javasript'>
		alert('Data Gagal Disimpan...!');
		document.location.herf = 'gaji-tambah.php';
		</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Gaji | PRAKTIKUM FTI UNISKA 2023 </title>
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
                            <h1>Data Gaji</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li> 
                                <li class="breadcrumb-item"><a href="karyawan.php"></a>Gaji</li>
                                <li class="breadcrumb-item active">Tambah Gaji</li>
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
                                	<label for="tahun">Tahun :</label>
                                	<input type="text" class="form-control" id="tahun" name="tahun" value="<?php echo date("Y");?>" 
                                    placeholder="Tahun" required>	
                                	</div>
                                	<div class="form-group">
                                	<label for="bulan">Bulan :</label>
                                	<select class="form-control" id="bulan" name="bulan" required>
                                        <option value="">--Pilih Bulan--</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                        
                                    </select>
                                	</div>
                                	<div class="form-group">
                                	<label for="karyawan_id">Karyawan :</label>
                                	<select class="form-control" id="karyawan_id" name="karyawan_id" required>	
                                    <option value="">--Pilih Karyawan--</option>
                                    <?php
                                    $query_karyawan="SELECT * FROM karyawan";
                                    $result_karyawan = mysqli_query($conn, $query_karyawan);
                                    while ($row_karyawan = mysqli_fetch_assoc($result_karyawan)){
                                        ?>
                                        <option value="<?php echo $row_karyawan["id"]; ?>"><?php echo $row_karyawan["nama_lengkap"];?></option>
                                    <?php } ?>
                                </select>


                                	</div>
                                
                                	<div class="form-group">
                                	<label for="jabatan_id">Jabatan Terakhir</label>
                                	<select class="form-control" id="jabatan_id" name="jabatan_id" required> 
                                    <option value="">--Pilih Jabatan--</option>
                                    <?php
                                    $query_jabatan="SELECT * FROM jabatan";
                                    $result_jabatan = mysqli_query($conn, $query_jabatan);
                                    while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)){
                                        ?>
                                        <option value="<?php echo $row_jabatan["id"]; ?>"><?php echo $row_jabatan["nama_jabatan"];?></option>
                                    <?php } ?>
                                </select>	
                                	</div>
                                  
                                    </div>
                                    <div class="card-footer">
                                    	<button type="submit" class="btn btn-primary mr-1" name="submit">Simpan</button>
                                    	<a href="gaji.php" class="btn btn-secondary">Cancel</a>
                                    	
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