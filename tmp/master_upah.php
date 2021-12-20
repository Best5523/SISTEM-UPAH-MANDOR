<?php
$id_session = $_GET['id'];
/*
$pc_id_brg = explode("-", $id_brg;
$id1 = $pc_id_brg[0];
$id2 = $pc_id_brg[1];
$id3 = $pc_id_brg[2];
$id4 = $pc_id_brg[3];*/


if ($_GET['mod'] == "add") {
	
	$kode_upah		= ""; 
	$nama_upah		= ""; 
	$Satuan 		= "";  
	$tombol 		= "Tambah"; 

} else if ($_GET['mod'] == "edit") {
	$q_getId = mysql_query("SELECT * FROM master_upah WHERE id = '$id_session' LIMIT 1 ");
	$a_getId = mysql_fetch_array($q_getId);
	
	$id 			= $a_getId[0];
	$kode_upah		= $a_getId[1]; 
	$nama_upah		= $a_getId[2]; 
	$satuan 		= $a_getId[3]; 
	$tombol 		= "Edit";
}else if ($_GET['mod'] == "del") {
	mysql_query("DELETE FROM master_upah WHERE id = '$id_session' LIMIT 1 " );
	$tombol         = "Tambah";
}




$p_tombol		= $_POST['submit'];
$p_id_asli 		= $_POST['id'];
$p_kode_upah	= $_POST['kode_upah'];
$p_nama_upah	= $_POST['nama_upah'];
$p_satuan       = $_POST['satuan'];

	

if ($p_tombol == "Tambah") {
		$cek_kode_upah = mysql_num_rows(mysql_query("SELECT * FROM master_upah WHERE kode_upah = '$p_kode_upah'"));
		if ($cek_kode_upah > 0){ }else{
		$sql_master_upah = "INSERT INTO master_upah VALUES('', '$p_kode_upah', '$p_nama_upah','$p_satuan')";
		$q_add_master = mysql_query($sql_master_upah);}

	if ($q_add_master) {
		echo "<h4 class='alert_success'>Data berhasil ditambah<span id='close'>[<a href='?p=master_upah&mod=add'>X</a>]</span></h4>";
	} else {
		echo "<h4 class='alert_error'>Kode Upah Sudah Terpakai<span id='close'>[<a href='#'>X</a>]</span></h4>";
	}


} else if ($p_tombol == "Edit") {
	$sql_update = "UPDATE master_upah SET 
							kode_upah = '$p_kode_upah',
							nama_upah = '$p_nama_upah', 
							satuan    = '$p_satuan'
							WHERE id = '$p_id_asli'";
	$q_update_data = mysql_query($sql_update);
	
	
	if ($q_update_data) {
		echo "<h4 class='alert_success'>Data berhasil diupdate<span id='close'>[<a href='?p=master_upah&mod=add'>X</a>]</span></h4>";
	} else {
		echo "<h4 class='alert_error'>".mysql_error()."<span id='close'>[<a href='#'>X</a>]</span></h4>";
	}
}

?>	
<article class="module width_full">
	<header><h3>Master Upah</h3></header>
	<div class="module_content">
	<form action = "" method="post" id= "">
		<table class="tbl_form">
		<?php		
		echo "<input type='hidden' name='id' value='$id_session'>";
		echo cInput1("Kode Upah", "kode_upah", "25", $kode_upah);
		echo cInput1("Nama Upah", "nama_upah", "25", $nama_upah);
		echo cInput1("Satuan", "satuan", "25", $satuan);
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
		<th width='10%'>Kode Upah</th>
		<th width='30%'>Nama Upah</th>
		<th width='5%'>Satuan</th>
		<th width='10%'>Option</th>

		</tr>";
		
			
		
$sql_master = mysql_query("SELECT * FROM master_upah WHERE 1");
			
			while ($data_master = mysql_fetch_array($sql_master)) {		
				$no++;
				echo "<tr>
				<td>$no</td>
				<td id='tengah'>$data_master[1]</td>
				<td>$data_master[2]</td>
				<td id='tengah'>$data_master[3]</td>
						
				



				<td id='tengah'><a href='?p=master_upah&mod=edit&id=$data_master[0]'>Edit</a> |
				<a href='?p=master_upah&mod=del&id=$data_master[0]' onclick=\"return konfirmasi('Menghapus data $a_user[1]')\">Delete</a>
				</tr>";
				
				
			}
		
		
		?>

		</div>

</article>
