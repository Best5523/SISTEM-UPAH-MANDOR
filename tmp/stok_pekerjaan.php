<?php
error_reporting(0);
$id = $_GET['id'];
$kode_a = $_GET['area'];
/*
$pc_id_brg = explode("-", $id_brg;
$id1 = $pc_id_brg[0];
$id2 = $pc_id_brg[1];
$id3 = $pc_id_brg[2];
$id4 = $pc_id_brg[3];*/


if ($_GET['mod'] == "add") {
	
	$kode_proyek 	= "";
	$area 			= "";
	$kode_upah 		= "";
	$harga			= ""; 
	$progres 		= "100";
	$tombol 		= "Tambah"; 

} else if ($_GET['mod'] == "edit") {
	$q_getId = mysql_query("SELECT * FROM stok_pekerjaan WHERE id = '$id' LIMIT 1 ");
	$a_getId = mysql_fetch_array($q_getId);
	
	$id 				= $a_getId[0];
	$kode_proyek 		= $a_getId[1];
	$area 				= $a_getId[2]; 
	$kode_upah  		= $a_getId[3];
	$harga				= $a_getId[4]; 
	$progres 			= $a_getId[5];
	$tombol 			= "Edit";
	$tombol1 			= "Delete";
} else if ($_GET['mod'] == "data") { 






}

$p_tombol		= $_POST['submit'];
$p_id_asli 		= $_POST['id'];
$p_kode_proyek	= $_POST['kode1'];
$p_area 		= $_POST['area'];
$p_kode_upah 	= $_POST['kode_upah'];
$p_harga        = $_POST['harga'];
$p_progres		= $_POST['progres'];

	

if ($p_tombol == "Tambah") {
	$sql_add = "INSERT INTO stok_pekerjaan VALUES('', '$p_kode_proyek', '$p_area', '$p_kode_upah', '$p_harga', '$p_progres')";
		$q_add_data = mysql_query($sql_add);
if ($q_add_data) {
		echo "<h4 class='alert_success'>Data berhasil di Tambah<span id='close'>[<a href='?p=stok_pekerjaan&mod=add'>X</a>]</span></h4>";
	}


} else if ($p_tombol == "Edit") {
	$sql_update = "UPDATE stok_pekerjaan SET 
							kode_proyek = '$p_kode_proyek',							
							area 		= '$p_area',
							kode_upah   = '$p_kode_upah',
							harga   	= '$p_harga',
							progres     = '$p_progres'
							WHERE id    = '$p_id_asli'";
	$q_update_data = mysql_query($sql_update);
if ($q_update_data) {
		echo "<h4 class='alert_success'>Data berhasil di Edit<span id='close'>[<a href='?p=stok_pekerjaan&mod=add'>X</a>]</span></h4>";
	}



} else if ($p_tombol == "Delete") {
	$sql_del = "DELETE FROM stok_pekerjaan WHERE id = '$id' LIMIT 1 ";
	$q_del = mysql_query($sql_del);

if ($q_del) {
		echo "<h4 class='alert_success'>Data berhasil Hapus<span id='close'>[<a href='?p=stok_pekerjaan&mod=add'>X</a>]</span></h4>";
	}


}



?>	
<article class="module width_full">
	<header><h3>Stok Pekerjaan</h3></header>
	<div class="module_content">
	<form action = "#" method="post">
		<table class="tbl_form">
		<?php		
		echo "<input type='hidden' name='id' value='$id'>";
		if ($_GET['mod'] == "data") {
			echo "";
		} else {
		echo "<tr><td>Proyek</td><td>";
		cmbDBidclass("kode1", "proyek", "kode_proyek", "nama_proyek", $kode_proyek, "kode_p", "");
		echo "</tr>";
		echo "<tr><td>Area</td><td><div id='area'><select><option value=''>--</option></div></td></tr>";
		echo "<tr><td>Item</td><td>";
		cmbDB("kode_upah", "master_upah", "kode_upah", "nama_upah", $kode_upah);
		echo "</tr>";
		echo cInput1("Harga", "harga", "20", $harga);
		echo "<input type='hidden' name='progres' value='$progres'>";
	    



		if ($_GET['mod'] == "edit") {
		echo cSubmit_doble("submit", $tombol, $tombol1 );
		}else{
		echo cSubmit("submit", $tombol);
		}
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
		<th width='5%'>Area</th>
		<th width='10%'>Pekerjaan</th>	
		<th width='2%'>Satuan</th>	
		<th width='3%'>Harga</th>
		<th width='2%'>Progres Belum Dikerjakan</th>
		<th width='5%'>Option</th>
		</tr>";


		if ($_GET['mod'] == "data") {
			$result = mysql_query("SELECT stok_pekerjaan.kode_proyek, stok_pekerjaan.area FROM stok_pekerjaan JOIN master_upah ON stok_pekerjaan.kode_upah = master_upah.kode_upah WHERE stok_pekerjaan.area = '$kode_a' GROUP BY area ORDER BY area ASC");


		while($data = mysql_fetch_array($result)){		
			$result2 = mysql_query("SELECT  stok_pekerjaan.id, master_upah.nama_upah, stok_pekerjaan.harga, master_upah.satuan, stok_pekerjaan.progres FROM stok_pekerjaan JOIN master_upah ON stok_pekerjaan.kode_upah = master_upah.kode_upah WHERE area='".$data['area']."'"); //get ukuran
 			$total = mysql_num_rows($result2);

$no++;
$jum = 1;
				echo "<tr>";
				if($jum <= 1) {
        echo '<td align="center" rowspan="'.$total.'">'.$no.'</td>';
        echo '<td rowspan="'.$total.'">'.$data['area'].'</td>';  
        $jum = $total;      
                           
    } else {
        $jum = $jum - 1;
    }
     while($data2 = mysql_fetch_array($result2)){
$tool = "<a href='?p=stok_pekerjaan&mod=edit&id=$data2[id]'>Edit</a>";
    echo '<td>'.$data2['nama_upah'].'</td>'; 
    echo '<td id="tengah">'.$data2['satuan'].'</td>'; 
    echo '<td id="tengah">Rp '.number_format($data2['harga'],0,',','.').'</td>';
    echo '<td id="tengah">'.$data2['progres'].'%</td>';
    echo '<td id="tengah">Valid</td>';
    echo "</tr>";
				
			}

 		}
		} else {
		$q_proyek	= mysql_query("SELECT proyek.kode_proyek, proyek.nama_proyek, COUNT(area) AS 'jumlah' FROM proyek INNER JOIN stok_pekerjaan ON proyek.kode_proyek = stok_pekerjaan.kode_proyek GROUP BY nama_proyek ASC") or die (mysql_error());

		 
		while ($a_data = mysql_fetch_array($q_proyek)) {
			$kode_      = $a_data[0];
			$nama_p 	= $a_data[1];
		
			
			
$result = mysql_query("SELECT stok_pekerjaan.kode_proyek, stok_pekerjaan.area, mandor.nama FROM area_proyek JOIN stok_pekerjaan ON area_proyek.area = stok_pekerjaan.area JOIN master_upah ON stok_pekerjaan.kode_upah = master_upah.kode_upah JOIN mandor ON area_proyek.kode_mandor = mandor.kode_mandor WHERE stok_pekerjaan.kode_proyek = '$kode_' GROUP BY area ORDER BY area ASC");
			
		
			
			echo "<tr><td colspan='7' height='15px'><b>$nama_p</b></td><tr>";

			
				
			while($data = mysql_fetch_array($result)){		
			$result2 = mysql_query("SELECT  stok_pekerjaan.id, master_upah.nama_upah, stok_pekerjaan.harga, master_upah.satuan, stok_pekerjaan.progres FROM stok_pekerjaan JOIN master_upah ON stok_pekerjaan.kode_upah = master_upah.kode_upah WHERE area='".$data['area']."'"); //get ukuran
 			$total = mysql_num_rows($result2);

$no++;
$jum = 1;
				echo "<tr>";
				if($jum <= 1) {
        echo '<td align="center" rowspan="'.$total.'">'.$no.'</td>';
        echo '<td rowspan="'.$total.'">'.$data['area'].'</td>';  
        $jum = $total;      
                           
    } else {
        $jum = $jum - 1;
    }
     while($data2 = mysql_fetch_array($result2)){
$tool = "<a href='?p=stok_pekerjaan&mod=edit&id=$data2[id]'>Edit</a>";
    echo '<td>'.$data2['nama_upah'].'</td>'; 
    echo '<td id="tengah">'.$data2['satuan'].'</td>'; 
    echo '<td>Rp '.number_format($data2['harga'],0,',','.').'</td>';
    echo '<td id="tengah" >'.$data2['progres'].'%</td>';
    echo '<td id="tengah">'.$tool.'</td>';
    
    echo "</tr>";
				
			}
		}
		}
	}
		?>

		</div>

</article>
<script type="text/javascript">
$('#kode_p').change(function() {
	var kode_p = $('#kode_p').val();
	$('#area').load('./zona.php?id='+kode_p);
});
</script>