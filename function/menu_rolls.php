<?php
$p = $_GET['p'];
if ($p == "") {
	$nav 	= "Home";
	$ambil 	= "./tmp/home.php";
} elseif ($p == "edit_profil") {
	$nav 	= "Edit Profil";
	$ambil 	= "./tmp/edit_profil.php";
} elseif ($p == "data_user") {
	$nav 	= "Data User";
	$ambil 	= "./tmp/data_user.php";
} elseif ($p == "master_upah") {
	$nav 	= "Master Upah";
	$ambil 	= "./tmp/master_upah.php";
} elseif ($p == "daftar_proyek") {
	$nav 	= "Daftar Proyek";
	$ambil 	= "./tmp/daftar_proyek.php";
} elseif ($p == "zona_proyek") {
	$nav 	= "Area Proyek";
	$ambil 	= "./tmp/zona_proyek.php";
} elseif ($p == "edit_zona_proyek") {
	$nav 	= "Zona Proyek";
	$ambil 	= "./tmp/edit_zona_proyek.php";
} elseif ($p == "data_mandor") {
	$nav 	= "Data Mandor";
	$ambil 	= "./tmp/data_mandor.php";
} elseif ($p == "stok_pekerjaan") {
	$nav 	= "Stok Pekerjaan";
	$ambil 	= "./tmp/stok_pekerjaan.php";
} elseif ($p == "pekerjaan") {
	$nav 	= "Pekerjaan";
	$ambil 	= "./tmp/pekerjaan.php";
} elseif ($p == "opname_mandor") {
	$nav 	= "Opname Mandor";
	$ambil 	= "./tmp/opname_mandor.php";
} elseif ($p == "laporan_opname_mandor") {
	$nav 	= "Laporan Opname Mandor";
	$ambil 	= "./tmp/lpom.php";
} elseif ($p == "laporan_upah_bulanan") {
	$nav 	= "Laporan Upah Bulanan";
	$ambil 	= "./tmp/lpub.php";
} else {
	$nav 	= "Home";
	$ambil 	= "./tmp/home.php";
}