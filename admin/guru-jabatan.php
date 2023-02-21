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
$query_jabgur = "SELECT
jabatan_guru.id,
jabatan_guru.guru_id,
guru.nama_lengkap,
jabatan.nama_jabatan,
jabatan_guru.tanggal_mulai
FROM
jabatan_guru, guru, jabatan
WHERE
guru.id = jabatan_guru.guru_id AND
jabatan.id = jabatan_guru.jabatan_id AND
jabatan_guru.guru_id $id";
$result_jabgur = mysqli_query($conn, $query_jabgur);

$query_guru = "SELECT *FROM guru WHERE id = $id";
$result_guru = mysqli_query($conn, $query_guru);
$row_guru = mysqli_fetch_assoc($result_guru);

if (isset($_POST["submit"])) {
    $guru_id = htmlspecialchars($_POST["guru_id"]);
    $jabatan_id = htmlspecialchars($_POST["jabatan_id"]);
    $tanggal_mulai = htmlspecialchars($_POST["tanggal_mulai"]);
    $query = "INSERT INTO jabatan_guru values ('', '$guru_id', '$jabatan_id') ";
    $simpan = mysqli_query($conn, $query);


    if ($simpan) {
        echo "<script type='text/javascript'>
                alert('Data berhasil disimpan...!');
                document.location.href = 'guru-jabatan.php?id=$id';
            </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Data GAGAL disimpan...!');
                document.location.href = 'guru-jabatan.php?id=$id';
            </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=dvice-width, initial-scale=1">
    <title>Data Jabatan Guru | SKRIPSI FTI UNISKA</title>
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
                            <h1>Data Jabatan Guru</h1>
                        </div>
                        <div class="col-sm-6">
                            <o1 class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="guru.php">Guru</a></li>
                                <li class="breadcrumb-item active">Bagian Guru</li>
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
                                            <label for="nik">Nomor Induk Keluarga</label>
                                            <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $row_guru["nik"]; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama</label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $row_guru["nama_lengkap"]; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="jabatan_id">Pilih Jabatan</label>
                                            <select class="form-control" id="jabatan_id" name="jabatan_id" required>
                                                <option value="">-- Pilih Jabatan --</option>
                                                <?php
                                                $query_jabatan = "SELECT * FROM jabatan";
                                                $result_jabatan = mysqli_query($conn, $query_jabatan);
                                                while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                                ?>
                                                    <option value="<?php echo $row_jabatan["id"]; ?>"><?php echo $row_jabatan["nama_jabatan"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_mulai">Tanggal Mulai</label>
                                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" placeholder="hh-bb-tttt" required>
                                        </div>
                                        <input type="hidden" name="karyawan_id" value="<?php echo $id; ?>">
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn_primary mr-1" name="submit">Simpan</button>
                                        <a href="guru.php" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Riwayat Jabatan</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">

                                        <head>
                                            <tr>
                                                <th>No</th>
                                                <th>Action</th>
                                                <th>Nama Jabatan</th>
                                                <th>Tanggal Mulai</th>
                                            </tr>
                                        </head>
                                        <tbody>
                                            <?php $no = 1;
                                            while ($row_jabgur = mysqli_fetch_assoc($result_jabgur)) { ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td>
                                                        <a href="guru-jabatan-hapus.php?id=<?php echo $row_jabgur['id']; ?>" class="btn btn-danger btn-xs text-light" onClick="javascript: return confirm('Apakah yakin ingin menghapus data ini...?');"><i class="fa fa-trash"></i> Hapus</a>
                                                    </td>
                                                    <td><?php echo $row_jabgur["nama_jabatan"]; ?></td>
                                                    <td><?php echo $row_jabgur["tanggal_mulai"]; ?></td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Action</th>
                                                <th>Nama Jabatan</th>
                                                <th>Tanggal Mulai</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.row -->
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
                "buttons": ["copy", "csv", "excel", "pdf", "print"],
                "order": [
                    [0, "asc"]
                ]
            }).buttons().container(), appendTo('#example1_wrapper .col-md-6:eq:(0)');
        });
    </script>
</body>

</html>