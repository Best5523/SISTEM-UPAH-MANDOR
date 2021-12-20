<?php
$id_session = $_GET['id'];
/*
$pc_id_brg = explode("-", $id_brg;
$id1 = $pc_id_brg[0];
$id2 = $pc_id_brg[1];
$id3 = $pc_id_brg[2];
$id4 = $pc_id_brg[3];*/


if ($_GET['mod'] == "add") {
	
	$kode_proyek	= ""; 
	$nama_proyek	= ""; 
	$alamat 		= "";  
	$tombol 		= "Tambah"; 

} else if ($_GET['mod'] == "edit") {
	$q_getId = mysql_query("SELECT * FROM proyek WHERE id = '$id_session' LIMIT 1 ");
	$a_getId = mysql_fetch_array($q_getId);
	
	$id 			= $a_getId[0];
	$kode_proyek		= $a_getId[1]; 
	$nama_proyek		= $a_getId[2]; 
	$alamat		 		= $a_getId[3]; 
	$tombol 			= "Edit";
	$tombol1 			= "Delete";

}else if ($_GET['mod'] == "del") {
	mysql_query("DELETE FROM proyek WHERE id = '$id_session' LIMIT 1 " );
	$tombol         = "Tambah";
}




$p_tombol		= $_POST['submit'];
$p_id_asli 		= $_POST['id'];
$p_kode_proyek	= $_POST['kode_proyek'];
$p_nama_proyek	= $_POST['nama_proyek'];
$p_alamat       = $_POST['alamat'];

	

if ($p_tombol == "Tambah") {
		$cek_kode_proyek = mysql_num_rows(mysql_query("SELECT * FROM proyek WHERE kode_proyek = '$p_kode_proyek'"));
		if ($cek_kode_proyek > 0){ }else{
		$sql_master_proyek = "INSERT INTO proyek VALUES('', '$p_kode_proyek', '$p_nama_proyek','$p_alamat')";
		$q_add_master = mysql_query($sql_master_proyek);}

	if ($q_add_master) {
		echo "<h4 class='alert_success'>Data berhasil ditambah<span id='close'>[<a href='?p=daftar_proyek&mod=add'>X</a>]</span></h4>";
	} else {
		echo "<h4 class='alert_error'>Kode Proyek Sudah Terpakai<span id='close'>[<a href='#'>X</a>]</span></h4>";
	}


} else if ($p_tombol == "Edit") {
	$sql_update = "UPDATE proyek SET 
							kode_proyek = '$p_kode_proyek',
							nama_proyek = '$p_nama_proyek', 
							alamat    = '$p_alamat'
							WHERE id = '$p_id_asli'";
	$q_update_data = mysql_query($sql_update);
	
	
	if ($q_update_data) {
		echo "<h4 class='alert_success'>Data berhasil diupdate<span id='close'>[<a href='?p=daftar_proyek&mod=add'>X</a>]</span></h4>";
	} 
} else if ($p_tombol == "Delete") {
	$sql_del = "DELETE FROM proyek WHERE id = '$id_session' LIMIT 1 ";
	$q_del = mysql_query($sql_del);

if ($q_del) {
		echo "<h4 class='alert_success'>Data berhasil Hapus<span id='close'>[<a href='?p=daftar_proyek&mod=add'>X</a>]</span></h4>";
	} else {
		echo "<h4 class='alert_error'>".mysql_error()."<span id='close'>[<a href='#'>X</a>]</span></h4>";
	}


}

?>	
<article class="module width_full">
	<header><h3>Daftar Proyek</h3></header>
	<div class="module_content">
	<form action = "" method="post" id= "">
		<table class="tbl_form">
		<?php		
		echo "<input type='hidden' name='id' value='$id_session'>";
		echo cInput1("Kode Proyek", "kode_proyek", "25", $kode_proyek);
		echo cInput1("Nama Proyek", "nama_proyek", "25", $nama_proyek);
		echo cInput1("Alamat", "alamat", "40", $alamat);
		if ($_GET['mod'] == "edit") {
		echo cSubmit_doble("submit", $tombol, $tombol1 );
		}else{
		echo cSubmit("submit", $tombol);
		}
		
		?>
		</table>
	</form>
	</div>
	
<div class="module_content">

		<?php		

		// ================ TAMPILKAN DATANYA =====================//
		echo "<table border='1' class='data'>
		<tr><th width='2%'>NO</th>
		<th width='10%'>Kode Proyek</th>
		<th width='15%'>Nama Proyek</th>
		<th width='30%'>Alamat</th>
		<th width='10%'>Option</th>

		</tr>";
		
			
		
$sql_master = mysql_query("SELECT * FROM proyek WHERE 1");
			
			while ($data_master = mysql_fetch_array($sql_master)) {		
				$no++;
				echo "<tr>
				<td>$no</td>
				<td id='tengah'>$data_master[1]</td>
				<td>$data_master[2]</td>
				<td>$data_master[3]</td>
						
				



				<td id='tengah'><a href='?p=zona_proyek&mod=add&id=$data_master[1]'>Area</a> |
				<a href='?p=daftar_proyek&mod=edit&id=$data_master[0]'>Edit</a>
				</tr>";
				
				
			}
		
		
		?>

		</div>

</article>
