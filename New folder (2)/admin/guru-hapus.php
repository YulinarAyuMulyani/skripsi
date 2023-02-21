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
$query = "DELETE FROM guru WHERE id = $id";
$delete =mysqli_query($conn, $query);
if ($delete) {
	echo "<script type='text/javascrib'> alert('Data berasil dihapus....!');
	document.location.herf = document.Location.herf = guru.php';
	</script>"
} ,
