<?php

include "fungsi.php";

$id_kode = $_GET['id'];

session_start();
$name = $_SESSION['name'];
$sql = mysql_query("SELECT * FROM user WHERE name = '$name' LIMIT 1");
if (mysql_num_rows($sql) == 0){}
else{$data = mysql_fetch_array($sql); 
	$kodep 			= $data[5];}
	

echo "<select name='area' id='op_area' class='area'>";
$q = mysql_query("SELECT  area FROM area_proyek WHERE kode_mandor = '$id_kode' && kode_proyek = '$kodep' ");
while ($a = mysql_fetch_array($q)) {
	if ($a[0] == $area) {
		echo "<option value='$a[0]' selected>$a[0]</option>";
	} else {
		echo "<option value='$a[0]'>$a[0]</option>";
	}
}



echo "</select>";

?>