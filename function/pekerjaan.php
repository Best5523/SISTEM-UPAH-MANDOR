<?php

include "fungsi.php";


$id_kode = $_GET['id'];

session_start();
$name = $_SESSION['name'];
$sql = mysql_query("SELECT * FROM user WHERE name = '$name' LIMIT 1");
if (mysql_num_rows($sql) == 0){}
else{$data = mysql_fetch_array($sql); 
	$kodep 			= $data[5];}

echo "<select name='item' id='pekerjaan'>";
$q = mysql_query("SELECT  stok_pekerjaan.kode_upah, master_upah.nama_upah FROM stok_pekerjaan JOIN master_upah ON stok_pekerjaan.kode_upah = master_upah.kode_upah JOIN area_proyek ON stok_pekerjaan.area = area_proyek.area WHERE stok_pekerjaan.kode_proyek = '$kodep' &&  stok_pekerjaan.area = '$id_kode'");
while ($a = mysql_fetch_array($q)) {
	if ($a[0] == $item) {
		echo "<option value='$a[0]' selected>$a[1]</option>";
	} else {
		echo "<option value='$a[0]'>$a[1]</option>";
	}
}
echo "</select>";

?>