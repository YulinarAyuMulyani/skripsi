https://payahtidur.com/project/ahp
<?php
session_start();
if ($_SESSION["peran"] == "USER") {
	header(" Location: logout.php");
	exit;
}
if (!isset($_SESSION["login"])) {
	header(" Location: ../index.php");
	exit;
}

include '../koneksi.php';

$query = "SELECT guru.id,guru.nama_lengkap,guru.nik,jabatan.nama_jabatan FROM guru INNER JOIN jabatan ON guru.jabatan_id=jabatan.id;";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data Guru | Skripsi FTI</title>
	<link rel="stylesheet" type="text/css" href="">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?php include "theme-header.php"; ?>
		<?php include "theme-sidebar.php"; ?>
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Data Guru</h1>							
						</div>
						<div class="col-sm-6">
							<ol class="col-sm-6">
								<li class="breadcrumb-item"><a href="index.php"> Home</a></li>
								<li class="breadcrumb-item active"><a href="">Guru</a></li>
							</ol>
							
						</div>
						
					</div>
					
				</div>
				
			</section>
			
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<a href="guru-tambah.php" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Data</a>
									
								</div>
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Action</th>
												<th>Nama Lengkap</th>
												<th>NIK</th>
												<th>Jabatan </th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											while ($row = mysqli_fetch_assoc($result)) { ?>
												<tr>
													<td> <?php echo $no; ?></td>
													<td>
			<a href="guru-jabatan.php?id=<?php echo $row["id"]; ?>" class="btn btn-info btn-xs mr-1"><i class="fa fa-user-tie"></i> Jabatan</a>		
			<a href="guru-edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-success btn-xs mr-1"><i class="fa fa-edit"></i>Ubah</a>
			<a href="guru-hapus.php?id=<?php echo $row["id"] ?>" class="btn btn-danger btn-xs text-light" onClick="javascript: return confirm('Apakah yakin ingin menghapus data ini...?');"><i class="fa fa-trash"></i>Hapus</a>
													</td>
													<td><?php echo $row["nama_lengkap"]; ?></td>
													<td><?php echo $row["nik"] ; ?></td>
													<td><?php echo $row["nama_jabatan"]; ?></td>
												</tr>
												<?php $no++;
											} ?>
										</tbody>
										<tfoot>
											<tr>
												<th>NO</th>
												<th>Action</th>
												<th>Nama Lengkap</th>
												<th>NIK</th>
												<th>Jabatan</th>
											</tr>
										</tfoot>
									</table>
									
								</div>
							</div>
							
						</div>
						
					</div>
					
				</div>
				
			</section>
		</div>
		<?php include "theme-footer.php"; ?>
		
	</div>
	 <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"],
                "order": [
                		[0, "asc"]
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          });
    </script>

</body>
</html>