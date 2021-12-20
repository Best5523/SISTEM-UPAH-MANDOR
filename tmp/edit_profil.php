<?php
session_start();
$name = $_SESSION['name'];
$sql = mysql_query("SELECT * FROM user WHERE name = '$name' LIMIT 1");
if (mysql_num_rows($sql) == 0){}
else{$data = mysql_fetch_array($sql); 
	$id 			= $data[0];
	$nik 			= $data[1]; 
	$nama 			= $data[2]; 
	$jabatan 		= $data[3]; 
	$tlp 			= $data[4]; 
	$kode_proyek 	= $data[5];
	$username 		= $data[6]; 
	$password 		= $data[7]; 
	$level 			= $data[8]; 
	$tombol 		= "Edit";
}

$p_tombol		= $_POST['submit'];
$p_id_asli 		= $_POST['id'];
$p_nik  		= $_POST['nik'];
$p_nama 		= $_POST['nama'];
$p_jabatan		= $_POST['jabatan'];
$p_tlp			= $_POST['tlp'];
$p_kode_proyek  = $_POST['kode_proyek'];
$p_username		= $_POST['username'];
$p_password		= $_POST['password'];
$p_level		= $_POST['id_level'];

if ($p_tombol == "Edit") {
	$cek_username = mysql_num_rows(mysql_query("SELECT * FROM user WHERE username = '$p_username'"));
		if ($cek_username > 0){  }else{
	$sql_update = "UPDATE user SET 
							nik = '$p_nik',
							name = '$p_nama', 
							jabatan = '$p_jabatan', 
							tlp = '$p_tlp', 
							kode_proyek = '$p_kode_proyek', 
							username = '$p_username', 
							pass = '$p_password' , 
							id_level = '$p_level' 
							WHERE id = '$p_id_asli'";
	$q_update_user = mysql_query($sql_update);
	}
	/*$q_update_brg = mysql_query() or die (mysql_error());*/
	if ($q_update_user) {
		echo "<h4 class='alert_success'>Data berhasil diupdate<span id='close'>[<a href='?p=data_user&mod=add'>X</a>]</span></h4>";
	} else {
		echo "<h4 class='alert_error'>Maaf Username Sudah Terpakai<span id='close'>[<a href='#'>X</a>]</span></h4>";
	}
}


?>
<article class="module width_full">
	<header><h3>Edit Profil</h3></header>
	<div class="module_content">
	<form method="post">
		<table class="tbl_form">
		<?php
		echo "<input type='hidden' name='id' value='$id'>";
		echo "<input type='hidden' name='nik' value='$nik'>";
		
		echo cInput1("Nama User", "nama", "25", $nama);
		echo "<input type='hidden' name='jabatan' value='$jabatan'>";
		echo "<input type='hidden' name='kode_proyek' value='$kode_proyek'>";

		echo cInput1("No Telphone", "tlp", "25", $tlp);
		echo cInput1("User Name", "username", "25", $username);
		echo cInput1("Password", "password", "25", $password);

		echo "<input type='hidden' name='id_level' value='$level'>";
		echo cSubmit("submit", $tombol)
		
		?>
		</table>
	</form>
	</div>
	</article>