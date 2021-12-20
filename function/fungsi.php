<?php

$h	= "182.23.34.148:83306";
$u	= "root";
$p	= "";
$d 	= "upah";

mysql_connect($h, $u, $p) or die (mysql_error());
mysql_select_db($d);

$conn = mysqli_connect('182.23.34.148:83306','root','','upah');

function input($var) {
	$ret = isset($var) ? $var : "";
	return $ret;
}

function cInput1($label, $name, $size, $value) {
	echo "<tr><td width=\"20%\">$label</td><td><input type=\"text\" name=\"$name\" size=\"$size\" value=\"$value\"></td></tr>";
}
function cInputRO($label, $name, $size, $value) {
	echo "<tr><td width=\"20%\">$label</td><td colspan=\"3\"><input type=\"text\" name=\"$name\" size=\"$size\" readonly value=\"$value\"></td></tr>";
}
function cmbText($name, $s_val, $s_view, $selected) {
	echo "<select name='$name'><option value=''>--</option>";
	$pc_val 	= explode("|", $s_val);
	$pc_view 	= explode("|", $s_view);
	$j_option 	= count($pc_val);
	
	for ($i = 0; $i < $j_option; $i++) {
		if ($pc_val[$i] == $selected) {
			echo "<option value='$pc_val[$i]' selected>$pc_view[$i]</option>";
		} else {
			echo "<option value='$pc_val[$i]'>$pc_view[$i]</option>";
		}
	}	
	echo "</select>";
}
function cmbDB($name, $tabel, $f_value, $f_view, $selected) {
	echo "<select name='$name'><option value=''>--</option>";
	$q = mysql_query("SELECT $f_value, $f_view FROM $tabel ORDER BY $f_view ASC");
	while ($a = mysql_fetch_array($q)) {
		if ($a[0] == $selected) {
			echo "<option value='$a[0]' selected>$a[1]</option>";
		} else {
			echo "<option value='$a[0]'>$a[1]</option>";
		}
	}
	echo "</select>";
}

function cmbDBop($proyek, $name, $tabel, $f_value, $f_view, $selected) {
	echo "<select name='$name'><option value=''>--</option>";
	$q = mysql_query("SELECT $f_value, $f_view FROM $tabel WHERE kode_proyek = $proyek ORDER BY $f_view ASC");
	while ($a = mysql_fetch_array($q)) {
		if ($a[0] == $selected) {
			echo "<option value='$a[0]' selected>$a[1]</option>";
		} else {
			echo "<option value='$a[0]'>$a[1]</option>";
		}
	}
	echo "</select>";
}

function edit_a($name, $tabel, $f_value, $f_view, $f_var, $selected) {
	echo "<select name='$name'><option value=''>--</option>";
	$q = mysql_query("SELECT $f_value, $f_view FROM $tabel WHERE  $f_value = '$f_var' GROUP BY $f_view ASC");
	while ($a = mysql_fetch_array($q)) {
		if ($a[1] == $selected) {
			echo "<option value='$a[0]' selected>$a[1]</option>";
		} else {
			echo "<option value='$a[0]'>$a[1]</option>";
		}
	}
	echo "</select>";
}

function cmbDBidclass($name, $tabel, $f_value, $f_view, $selected, $id, $class) {
	echo "<select name='$name' id='$id' class='$class'><option value=''>--</option>";
	$q = mysql_query("SELECT $f_value, $f_view FROM $tabel ORDER BY $f_view ASC");
	while ($a = mysql_fetch_array($q)) {
		if ($a[0] == $selected) {
			echo "<option value='$a[0]' selected>$a[1]</option>";
		} else {
			echo "<option value='$a[0]'>$a[1]</option>";
		}
	}
	echo "</select>";
}


function periode($name, $tabel, $f_value, $f_view, $v, $id, $class) {
	echo "<select name='$name' id='$id' class='$class'><option value=''>Pilih Periode</option>";
	$q = mysql_query("SELECT $f_value, month($f_value), monthname($f_value), YEAR($f_value) FROM $tabel WHERE $v = '$f_view' GROUP BY monthname($f_value)");
	while ($a = mysql_fetch_array($q)) {
		if ($a[0] == $selected) {
			echo "<option value='$a[3]-0$a[1]-00' selected>$a[3] $a[2]</option>";
		} else {
			echo "<option value='$a[3]-0$a[1]-00' >$a[3] $a[2]</option>";
		}
	}
	echo "</select>";
}
function mandor($name, $tabel, $f_value, $f_view, $selected, $id, $class) {
	echo "<select name='$name' id='$id' class='$class'><option value=''>Pilih Nama Mandor</option>";
	$q = mysql_query("SELECT $f_value, $f_view FROM $tabel ORDER BY $f_view ASC");
	while ($a = mysql_fetch_array($q)) {
		if ($a[0] == $selected) {
			echo "<option value='$a[0]' selected>$a[1]</option>";
		} else {
			echo "<option value='$a[0]'>$a[1]</option>";
		}
	}
	echo "</select>";
}
function Submit($name, $value) {
	echo "<input type=\"submit\" name=\"$name\" value=\"$value\">";
}

function cSubmit($name, $value) {
	echo "<tr><td></td><td><input type=\"submit\" name=\"$name\" value=\"$value\"></td></tr>";
}

function cSubmit_doble($name, $value,$value1) {
	echo "<tr><td></td><td><input type=\"submit\" name=\"$name\" value=\"$value\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"$name\" value=\"$value1\"></td></tr>";
}


function getNama($tabel, $field, $fk, $id) {
	$pc_fk 		= explode("|", $fk);
	$pc_id 		= explode("|", $id);
	$j_syarat 	= count($pc_fk);
	
	if ($j_syarat > 1) {
		$where = "WHERE $pc_fk[0] = '$pc_id[0]' AND $pc_fk[1] = '$pc_id[1]' LIMIT 1";
	} else {
		$where = "WHERE $fk = '$id' LIMIT 1";
	}	
	$q = mysql_query("SELECT $field FROM $tabel $where");
	$a = mysql_fetch_array($q);
	return $a[0];
}
function endData($tabel, $field, $w) {
	$q = mysql_query("SELECT MAX($field) FROM $tabel $w");
	$a = mysql_fetch_array($q);
	if ($a[0] == NULL) {
		return "1";
	} else {
		return $a[0]+1;
	}
}

function getData($tabel, $data, $fk, $kv) {
	$q = mysql_query("SELECT $data FROM $tabel WHERE $fk = '$kv' LIMIT 1");
	$a = mysql_fetch_array($q);
	return $a[0];
}

/* UNTUK PSB thok */
function cInput($label, $name, $size, $value) {
	echo "<tr><td width=\"20%\">$label</td><td colspan=\"3\"><input type=\"text\" name=\"$name\" size=\"$size\" value=\"$value\"></td></tr>";
}

function cInput2($label, $name, $size, $value) {
	$pc_label = explode("|", $label);
	$pc_name  = explode("|", $name);
	$pc_size  = explode("|", $size);
	$pc_value = explode("|", $value);
	
	$label1 = $pc_label[0]; $label2 = $pc_label[1];
	$name1 = $pc_name[0]; $name2 = $pc_name[1];
	$size1 = $pc_size[0]; $size2 = $pc_size[1];
	$value1 = $pc_value[0]; $value2 = $pc_value[1];
	
	echo "
	<tr>
	<td width=\"20%\">$label1</td><td width=\"30%\"><input type=\"text\" name=\"$name1\" size=\"$size1\" value=\"$value1\"></td>
	<td width=\"20%\">$label2</td><td width=\"30%\"><input type=\"text\" name=\"$name2\" size=\"$size2\" value=\"$value2\"></td>
	</tr>";
}



function cRadio($label1, $name, $label, $value) {
	$pc_label = explode("|", $label);
	$pc_value = explode("|", $value);
	$j_radio = count($pc_label);
	
	echo "<tr><td width=\"20%\">$label1</td><td colspan=\"3\">";
	for ($i = 0; $i < $j_radio; $i++) {
		echo "<input type='radio' name='$name' value='$pc_value[$i]'>&nbsp;<label>$pc_label[$i]</label>&nbsp;";
	}
	echo "</td></tr>";
}
