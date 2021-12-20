<?php

include "./function/fungsi.php";

$id_kode1 = $_GET['id'];
echo "<select name='area'>";
$q = mysql_query("SELECT id, kode_proyek, area FROM area_proyek WHERE kode_proyek = '$id_kode1' GROUP BY area");
while ($a = mysql_fetch_array($q)) {
	if ($a[2] == $area) {
		echo "<option value='$a[2]' selected>$a[2]</option>";
	} else {
		echo "<option value='$a[2]'>$a[2]</option>";
	}
}
echo "</select>";


?>