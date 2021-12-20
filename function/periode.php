<?php
session_start();
include "fungsi.php";

$id_kode = $_GET['id'];


$name = $_SESSION['name'];
$sql = mysql_query("SELECT * FROM user WHERE name = '$name' LIMIT 1");
if (mysql_num_rows($sql) == 0){}
else{$data = mysql_fetch_array($sql); 
	$kodep 			= $data[5];}
	

echo "<select name='periode' id='periode'>";
$q = mysql_query("SELECT periode, monthname(periode), YEAR(periode) FROM opname WHERE kode_mandor = '$id_kode' && kode_proyek = '$kodep' GROUP BY periode");
while ($a = mysql_fetch_array($q)) {
	// if ($a[0] == $periode) {
		echo "<option value='$a[0]' selected>$a[0] </option>";
	// } else {
		// echo "<option value='$a[0]'>$a[0]</option>";
	// }
}



echo "</select>";

?>