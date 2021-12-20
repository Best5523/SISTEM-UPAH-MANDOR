<?php
$id_session = $_GET['id'];
/*
$pc_id_brg = explode("-", $id_brg;
$id1 = $pc_id_brg[0];
$id2 = $pc_id_brg[1];
$id3 = $pc_id_brg[2];
$id4 = $pc_id_brg[3];*/


if ($_GET['mod'] == "add") {
	
	$kode_mandor	= ""; 
	$nama_mandor	= ""; 
	$alamat 		= "";
 	$tlp	 		= "";  
	$bidang	 		= "";
	$tombol 		= "Tambah"; 

} else if ($_GET['mod'] == "edit") {
	$q_getId = mysql_query("SELECT * FROM mandor WHERE id = '$id_session' LIMIT 1 ");
	$a_getId = mysql_fetch_array($q_getId);
	
	$id 			    = $a_getId[0];
	$kode_mandor		= $a_getId[1]; 
	$nama_mandor		= $a_getId[2];
	$alamat 			= $a_getId[3]; 
	$tlp		 		= $a_getId[4];
	$bidang				= $a_getId[5]; 
	$tombol 			= "Edit";

}else if ($_GET['mod'] == "del") {
	mysql_query("DELETE FROM mandor WHERE id = '$id_session' LIMIT 1 " );
	$tombol         = "Tambah";
}




$p_tombol		= $_POST['submit'];
$p_id_asli 		= $_POST['id'];
$p_kode_mandor	= $_POST['kode_mandor'];
$p_nama_mandor	= $_POST['nama_mandor'];
$p_alamat		= $_POST['alamat'];
$p_tlp       	= $_POST['tlp'];
$p_bidang 		= $_POST['bidang'];

	

if ($p_tombol == "Tambah") {
		$sql_master_proyek = "INSERT INTO mandor VALUES('', '$p_kode_mandor', '$p_nama_mandor','$p_alamat','$p_tlp','$p_bidang')";
		$q_add_master = mysql_query($sql_master_proyek);

	} else if ($p_tombol == "Edit") {
	$sql_update = "UPDATE mandor SET 
							kode_mandor  = '$p_kode_mandor',
							nama 		 = '$p_nama_mandor', 
							alamat 		 = '$p_alamat',
							tlp    		 = '$p_tlp',
							bidang       = '$p_bidang'
							WHERE id = '$p_id_asli'";
	$q_update_data = mysql_query($sql_update);
	
	
	if ($q_update_data) {
		echo "<h4 class='alert_success'>Data berhasil diupdate<span id='close'>[<a href='?p=data_mandor&mod=add'>X</a>]</span></h4>";
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
		echo cInput1("Kode Mandor", "kode_mandor", "25", $kode_mandor);
		echo cInput1("Nama Mandor", "nama_mandor", "25", $nama_mandor);
		echo cInput1("Alamat", "alamat", "40", $alamat);
		echo cInput1("No Telphone", "tlp", "25", $tlp);
		echo cInput1("Bidang", "bidang", "25", $bidang);
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
		<th width='10%'>Kode Mandor</th>
		<th width='15%'>Nama Mandor</th>
		<th width='30%'>Alamat</th>
		<th width='10%'>No Telphone</th>
		<th width='10%'>Bidang</th>
		<th width='10%'>Option</th>

		</tr>";
		
			
		
$sql_master = mysql_query("SELECT * FROM mandor WHERE 1");
			
			while ($data_master = mysql_fetch_array($sql_master)) {		
				$no++;
				echo "<tr>
				<td>$no</td>
				<td id='tengah'>$data_master[1]</td>
				<td>$data_master[2]</td>
				<td>$data_master[3]</td>
				<td>$data_master[4]</td>
				<td>$data_master[5]</td>
						
				



				<td id='tengah'><a href='?p=data_mandor&mod=edit&id=$data_master[0]'>Edit</a> |
				<a href='?p=data_mandor&mod=del&id=$data_master[0]' onclick=\"return konfirmasi('Menghapus data $a_user[1]')\">Delete</a>
				</tr>";
				
				
			}
		
		
		?>

		</div>

</article>
