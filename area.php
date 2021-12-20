<?php
include "./function/fungsi.php";

$id_kode2 = $_GET['id_kode2'];
echo "<select name='kode2'>";
$q = mysql_query("SELECT * FROM area_proyek WHERE kode_proyek = '$id_kode2'");
while ($a = mysql_fetch_array($q)) {
	if ($a[1] == $kode3) {
		echo "<option value='$a[1]' selected>$a[2]</option>";
	} else {
		echo "<option value='$a[1]'>$a[2]</option>";
	}
}
echo "</select>";

?>