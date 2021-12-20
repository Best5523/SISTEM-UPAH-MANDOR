<?php
session_start();
$id_session = $_GET['id'];
/*
$pc_id_brg = explode("-", $id_brg;
$id1 = $pc_id_brg[0];
$id2 = $pc_id_brg[1];
$id3 = $pc_id_brg[2];
$id4 = $pc_id_brg[3];*/


if ($_GET['mod'] == "add") {
	
	$nik 			= ""; 
	$nama 			= ""; 
	$jabatan 		= ""; 
	$tlp  			= "";
	$kode_proyek	= ""; 
	$username 		= ""; 
	$password 		= ""; 
	$level 			= "";  
	$tombol 		= "Tambah"; 

} else if ($_GET['mod'] == "edit") {
	$q_getId = mysql_query("SELECT * FROM user WHERE id = '$id_session' LIMIT 1 ");
	$a_getId = mysql_fetch_array($q_getId);
	
	$id 			= $a_getId[0];
	$nik 			= $a_getId[1]; 
	$nama 			= $a_getId[2]; 
	$jabatan 		= $a_getId[3]; 
	$tlp 			= $a_getId[4]; 
	$kode_proyek 	= $a_getId[5];
	$username 		= $a_getId[6]; 
	$password 		= $a_getId[7]; 
	$level 			= $a_getId[8]; 
	$tombol 		= "Edit";
}else if ($_GET['mod'] == "del") {
	mysql_query("DELETE FROM user WHERE id = '$id_session' LIMIT 1 " );
	$tombol         = "Tambah";
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

	
	if ($p_tombol == "Tambah") {
	$kode_proyek1 	= endData('proyek', 'nama_proyek', "WHERE kode_proyek = '$p_kode_proyek' AND nama_proyek = '$p_kode_proyek'");
	$kode_akses 	= endData('akses', 'id_level', "WHERE id_level = '$id_level' AND level = '$level'");
	
	if ($p_tombol == "Tambah") {
		$cek_username = mysql_num_rows(mysql_query("SELECT * FROM user WHERE username = '$p_username'"));
		if ($cek_username > 0){ echo "<h4 class='alert_success'>Maaf Username Sudah Terpakai<span id='close'>[<a href='?p=data_user&mod=add'>X</a>]</span></h4>";}else{
		$sql_add = "INSERT INTO user VALUES('', '$p_nik', '$p_nama', '$p_jabatan', '$p_tlp', '$p_kode_proyek', '$p_username', '$p_password','$p_level')";
		$q_add_user = mysql_query($sql_add);
}

if ($q_add_user) {
		echo "<h4 class='alert_success'>Data berhasil ditambah<span id='close'>[<a href='?p=data_user&mod=add'>X</a>]</span></h4>";
	} else {
		echo "<h4 class='alert_error'>".mysql_error()."<span id='close'>[<a href='#'>X</a>]</span></h4>";
	}
}

} else if ($p_tombol == "Edit") {
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
	
	/*$q_update_brg = mysql_query() or die (mysql_error());*/
	if ($q_update_user) {
		echo "<h4 class='alert_success'>Data berhasil diupdate<span id='close'>[<a href='?p=data_user&mod=add'>X</a>]</span></h4>";
	} else {
		echo "<h4 class='alert_error'>".mysql_error()."<span id='close'>[<a href='#'>X</a>]</span></h4>";
	}
}

?>	
<article class="module width_full">
	<header><h3>Data User</h3></header>
	<div class="module_content">
	<form action = "" method="post" id= "">
		<table class="tbl_form">
		<?php		
		echo "<input type='hidden' name='id' value='$id_session'>";
		
		if ($_GET['mod'] == "edit") {
			echo cInput1("NIK", "nik", "25", $nik);
		} else {
			echo cInput1("NIK", "nik", "25", $nik);
		 }
		echo cInput1("Nama User", "nama", "25", $nama);
		echo cInput1("Jabatan", "jabatan", "25", $jabatan);
		

		echo "<tr><td>Proyek</td><td>";
		cmbDB("kode_proyek", "proyek", "kode_proyek", "nama_proyek", $kode_proyek);
		echo "</tr>";

		echo cInput1("No Telphone", "tlp", "25", $tlp);
		echo cInput1("User Name", "username", "25", $username);
		echo cInput1("Password", "password", "25", $password);

		echo "<tr><td>Level</td><td>";
		cmbDB("id_level", "akses", "id_level", "level", $level);
		echo "</tr>";
		echo cSubmit("submit", $tombol)
		
		?>
		</table>
	</form>
	</div>
	
<div class="module_content">
		
		<?php		
		// ================ TAMPILKAN DATANYA =====================//
		echo "<table border='1' class='data'>
		<tr><th width='2%'>NO</th>
		<th width='10%'>NIK</th>
		<th width='10%'>Nama User</th>
		<th width='10%'>Jabatan</th>
		<th width='10%'>No Telphone</th>
		<th width='10%'>User Name</th>
		<th width='10%'>Password</th>
		<th width='10%'>Level</th>
		<th width='10%'>Option</th>

		</tr>";
		$q_user	= mysql_query("SELECT proyek.kode_proyek, nama_proyek, COUNT(nama_proyek) AS 'jumlah' FROM proyek INNER JOIN user ON proyek.kode_proyek = user.kode_proyek GROUP BY nama_proyek ASC") or die (mysql_error());

		$j_user	= mysql_num_rows($q_user);
		
		while ($a_user = mysql_fetch_array($q_user)) {
			$data_proyek = $a_user[0].$a_user[1].$a_user[2];
			$kode_ 	= $a_user[1];
			
			echo "<tr><td colspan='10' height='15px'><b>$kode_ [$a_user[2] user]</b></td><tr>";
			
			$q_user1 = mysql_query("SELECT user.id, nik, name, jabatan, tlp, nama_proyek, username, pass, level FROM user INNER JOIN proyek ON user.kode_proyek = proyek.kode_proyek INNER JOIN akses ON user.id_level = akses.id_level WHERE proyek.nama_proyek = '$kode_'");
			
			while ($data_user = mysql_fetch_array($q_user1)) {		
				$no++;
				echo "<tr>
				<td>$no</td>
				<td id='tengah'>$data_user[1]</td>
				<td>$data_user[2]</td>
				<td>$data_user[3]</td>
				<td>$data_user[4]</td>				
				<td>$data_user[6]</td>
				<td>$data_user[7]</td>
				<td>$data_user[8]</td>




				<td id='tengah'><a href='?p=data_user&mod=edit&id=$data_user[0]'>Edit</a> |
				<a href='?p=data_user&mod=del&id=$data_user[0]' onclick=\"return konfirmasi('Menghapus data $a_user[1]')\">Delete</a>
				</tr>";
				
				
			}
		}
		
		?>

		</div>

</article>
