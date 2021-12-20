<?php
$id_session = $_GET['id'];

$d_proyek = mysql_query("SELECT * FROM proyek where kode_proyek = '$id_session' LIMIT 1 ");
            $d = mysql_fetch_array($d_proyek);
            $kode_proyek_asli = $d[1];
          
                   

$id 		= $_GET['id_area'];
/*
$pc_id_brg = explode("-", $id_brg;
$id1 = $pc_id_brg[0];
$id2 = $pc_id_brg[1];
$id3 = $pc_id_brg[2];
$id4 = $pc_id_brg[3];*/


if ($_GET['mod'] == "add") {
		
	$area 			= "";
	$kode_mandor 	= "";
	$ket 			= "";  
	$tombol 		= "Tambah"; 

} else if ($_GET['mod'] == "edit") {
	$q_getId = mysql_query("SELECT * FROM area_proyek WHERE id = '$id' LIMIT 1 ");
	$a_getId = mysql_fetch_array($q_getId);
	
	$id 				= $a_getId[0];
	$kode_proyek 		= $a_getId[1];	
	$area 				= $a_getId[2]; 
	$kode_mandor  		= $a_getId[3];
	$ket 				= $a_getId[4]; 
	$tombol 			= "Edit";
	$tombol1 			= "Delete";

}

$p_tombol		= $_POST['submit'];
$p_id_asli 		= $_POST['id_area'];
$p_kode_proyek	= $_POST['kode_proyek'];
$p_area 		= $_POST['area'];
$p_kode_mandor	= $_POST['kode_mandor'];
$p_ket          = $_POST['ket'];

	

if ($p_tombol == "Tambah") {
	$sql_add = "INSERT INTO area_proyek VALUES('', '$p_kode_proyek', '$p_area', '$p_kode_mandor', '$p_ket')";
		$q_add_user = mysql_query($sql_add);

} else if ($p_tombol == "Edit") {
	$sql_update = "UPDATE area_proyek SET 
							kode_proyek = '$p_kode_proyek',							
							area 		= '$p_area',
							kode_mandor = '$p_kode_mandor',
							ket   		= '$p_ket'
							WHERE id    = '$p_id_asli'";
	$q_update_data = mysql_query($sql_update);
if ($q_update_data) {
		echo "<h4 class='alert_success'>Data berhasil di Edit<span id='close'>[<a href='?p=zona_proyek&mod=add&id=$kode_proyek_asli'>X</a>]</span></h4>";
	}



} else if ($p_tombol == "Delete") {
	$sql_del = "DELETE FROM area_proyek WHERE id = '$id' LIMIT 1 ";
	$q_del = mysql_query($sql_del);

if ($q_del) {
		echo "<h4 class='alert_success'>Data berhasil Hapus<span id='close'>[<a href='?p=zona_proyek&mod=add&id=$kode_proyek_asli'>X</a>]</span></h4>";
	}


}

$q_user	= mysql_query("SELECT area_proyek.id, area_proyek.kode_proyek, proyek.nama_proyek, COUNT(nama_proyek) AS 'jumlah' FROM area_proyek INNER JOIN proyek ON area_proyek.kode_proyek = proyek.kode_proyek WHERE area_proyek.kode_proyek = '$kode_proyek_asli'") or die (mysql_error());

		$j_user	= mysql_num_rows($q_user);
		
		while ($a_user = mysql_fetch_array($q_user)) {
			$data_proyek = $a_user[0].$a_user[1].$a_user[2].$a_user[3];
			$kode_ 	= $a_user[2];
			
$q_user1 = mysql_query("SELECT area_proyek.id, proyek.nama_proyek, area, mandor.nama, mandor.bidang, ket FROM area_proyek INNER JOIN proyek ON area_proyek.kode_proyek = proyek.kode_proyek INNER JOIN mandor ON area_proyek.kode_mandor = mandor.kode_mandor WHERE proyek.nama_proyek = '$kode_'");

?>	
<article class="module width_full">
	<header><h3>Area Proyek</h3></header>
	<div class="module_content">
	<form action = "" method="post">
		<table class="tbl_form">
		<?php		
		echo "<input type='hidden' name='id_area' value='$id'>";	
		echo "<input type='hidden' name='kode_proyek' value= '$kode_proyek_asli'>";
		echo "<tr><td>Nama Proyek</td><td><b>$kode_</td></tr>";		
		echo cInput1("Area", "area", "25", $area);
		echo "<tr><td>Mandor</td><td>";
		cmbDB("kode_mandor", "mandor", "kode_mandor", "nama", $kode_mandor);
		echo "</tr>";
		echo cInput1("Keterangan", "ket", "25", $ket);
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
		<th width='20%'>Area</th>
		<th width='15%'>Nama Mandor</th>
		<th width='10%'>Bidang</th>
		<th width='15%'>Keterangan</th>
		<th width='10%'>Option</th>

		</tr>";
		
		
			
			echo "<tr><td colspan='10' height='15px'><b>$kode_ [$a_user[3] Area]</b></td><tr>";
			
			
			
			while ($data_master = mysql_fetch_array($q_user1)) {			
				$no++;
				echo "<tr>
				<td>$no</td>
				<td>$data_master[2]</td>
				<td>$data_master[3]</td>
				<td>$data_master[4]</td>
				<td>$data_master[5]</td>
						
				



				<td id='tengah'><a href='?p=stok_pekerjaan&mod=data&area=$data_master[2]'>Pekerjaan</a> |
				<a href='?p=zona_proyek&mod=edit&id=$kode_proyek_asli&id_area=$data_master[0]')\">Edit</a>
				</tr>";
				
				
			}
		
		}
		?>

		</div>

</article>
