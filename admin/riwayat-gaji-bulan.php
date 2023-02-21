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
$query = "SELECT 
penggajian.karyawan_id AS id,
karyawan.nama_lengkap AS nama_lengkap,
penggajian.tahun, penggajian.bulan,
SUM(penggajian.gapok) AS gapok,
SUM(penggajian.tunjangan) AS tunjangan,
SUM(penggajian.uang_makan) AS uang_makan
FROM
penggajian, karyawan
WHERE
karyawan.id = penggajian.karyawan_id AND
penggajian.karyawan_id = 3
GROUP BY
penggajian.bulan";
$result = mysqli_query($conn, $query);

$query_karyawan = "SELECT nama_lengkap FROM karyawan WHERE id = $id";
$result_karyawan = mysqli_query($conn, $query_karyawan);
$row_karyawan = mysqli_fetch_assoc($result_karyawan);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=dvice-width, initial-scale=1">
    <title>Gaji Per Karyawan | PRAKTIKUM FTI UNISKA</title>
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

        <!-- Content Wrapper, Contains page content -->
        <div class="content-wrapper">
            <!-- Content Headder (Page header) -->
            <section class="content-header">
                <div class="container-fuild">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Gaji <b><?php echo $row_karyawan["nama_lengkap"] ?></b> Per Tahun</h1>
                        </div>
                        <div class="col-sm-6">
                            <o1 class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="riwayat-gaji.php">Gaji Per Karyawan</a></li>
                                <li class="breadcrumb-item active">Gaji Per Tahun</li>
                            </o1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary" onclick="window.location='riwayat-gaji.php'">Kembali</button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Bulan</th>
                                                <th>Gapok</th>
                                                <th>Tunjangan</th>
                                                <th>Uang Makan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            $jml_gapok = 0;
                                            $jml_tunjangan = 0;
                                            $jml_uang_makan = 0;
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row["bulan"]; ?></td>
                                                    <td class="text-right"><?php echo 'Rp. ' . number_format($row["gapok"], 0, ',', '.') . ',-'; ?></td>
                                                    <td class="text-right"><?php echo 'Rp. ' . number_format($row["tunjangan"], 0, ',', '.') . ',-'; ?></td>
                                                    <td class="text-right"><?php echo 'Rp. ' . number_format($row["uang_makan"], 0, ',', '.') . ',-'; ?></td>
                                                </tr>
                                            <?php
                                                $no++;
                                                $jml_gapok += $row["gapok"];
                                                $jml_tunjangan += $row["tunjangan"];
                                                $jml_uang_makan += $row["uang_makan"];
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-right" colspan="2">Total</th>
                                                <th class="text-right"><?php echo 'Rp. ' . number_format($jml_gapok, 0, ',', '.') . ',-'; ?></th>
                                                <th class="text-right"><?php echo 'Rp. ' . number_format($jml_tunjangan, 0, ',', '.') . ',-'; ?></th>
                                                <th class="text-right"><?php echo 'Rp. ' . number_format($jml_uang_makan, 0, ',', '.') . ',-'; ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
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
    <!-- DataTables & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.dataTables.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo puposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                dom: 'Bfrtip',
                "buttons": ["copy", "csv", "excel", "pdf", "print"],
                "order": [
                    [0, "asc"]
                ]
            }).buttons().container(), appendTo('#example1_wrapper .col-md-6:eq:(0)');
        });
    </script>
</body>

</html>