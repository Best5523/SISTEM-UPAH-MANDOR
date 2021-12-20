<?php
$id = $_GET['id'];
$kode_a = $_GET['area'];
session_start();
$name = $_SESSION['name'];
$sql = mysql_query("SELECT * FROM user WHERE name = '$name' LIMIT 1");
if (mysql_num_rows($sql) == 0){}
else{$data = mysql_fetch_array($sql); 
	$kodep 			= $data[5]; /* menentukan kode proyek*/


	$q = mysql_query("SELECT proyek.nama_proyek FROM user JOIN proyek ON user.kode_proyek = proyek.kode_proyek WHERE user.kode_proyek = '$kodep' LIMIT 1");
	$h = mysql_fetch_array($q);
	$namap = $h[0]; /* menentukan nama proyek*/
}



if ($_GET['mod'] == "add") {
	
	$kode_proyek 	= "";
	$periode		= "";
	$area 	 		= "";
	$kode_upah		= ""; 
	$kode_mandor	= "";
	$progres 		= "";
	$harga  		= "";
	$tombol 		= "Tambah"; 

} else if ($_GET['mod'] == "edit") {
	$q_getId = mysql_query("SELECT * FROM opname WHERE id = '$id' LIMIT 1 ");
	$a_getId = mysql_fetch_array($q_getId);
	
	$id 				= $a_getId[0];
	$kode_proyek 		= $a_getId[1];
	$periode 	 		= $a_getId[2];
	$area 				= $a_getId[3]; 
	$kode_upah  		= $a_getId[4];
	$kode_mandor 		= $a_getId[5];
	$progres 			= $a_getId[6];
	$harga				= $a_getId[7]; 
	
	$tombol 			= "Edit";
	$tombol1 			= "Delete";
} 

$p_tombol		= $_POST['submit'];
$p_spk			= $_POST['no_spk'];
$p_periode 		= $_POST['periode'];
$p_id_asli 		= $_POST['id'];
$p_area 		= $_POST['area'];
$p_upah 		= $_POST['item'];
$p_harga        = $_POST['harga'];
$p_kode_mandor 	= $_POST['mandor'];
$p_progres		= $_POST['progres'];

	

if ($p_tombol == "Tambah") {
	$cek_prosentase = "SELECT progres, harga FROM stok_pekerjaan WHERE kode_proyek = '$kodep' && area = '$p_area' && kode_upah = '$p_upah' && progres >= $p_progres";
	$cek = mysql_num_rows(mysql_query($cek_prosentase));
	if ($cek == 0 ) {
		echo "<h4 class='alert_error'>Progres Melebihi Stok Pekerjaan<span id='close'>[<a href='#'>X</a>]</span></h4>";
	}else{
		$harga = mysql_fetch_row(mysql_query($cek_prosentase));
		$total = $harga[1] * ($p_progres / 100);
		
		
		$sql_add = "INSERT INTO opname VALUES('', '$kodep', '$p_spk', '$p_periode','$p_area', '$p_upah', '$p_kode_mandor', '$p_progres', '$total')";
		$q_add_data = mysql_query($sql_add);

		$sql_update = "UPDATE stok_pekerjaan SET progres = progres-'$p_progres' WHERE kode_proyek = '$kodep' && area = '$p_area' && kode_upah = '$p_upah'";
		$q_update_data = mysql_query($sql_update);
		
	}



	
if ($q_add_data) {
		echo "<h4 class='alert_success'>Data berhasil di Tambah<span id='close'>[<a href='?p=opname_mandor&mod=add'>X</a>]</span></h4>";
	}


} else if ($p_tombol == "Edit") {
	$sql_update = "UPDATE stok_pekerjaan SET 
							kode_proyek = '$p_kode_proyek',							
							area 		= '$p_area',
							kode_upah   = '$p_kode_upah',
							harga   	= '$p_harga',
							progres     = 'p_progres'
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
	
	<div class="module_content">
	<form action = "#" method="post">
		<table class="tbl_form">
		<?php		
		echo "<input type='hidden' name='id' value='$id'>";
		echo "<tr><td>Proyek</td><td><b>$namap</td></tr>";
		
		
		echo "<tr><td>Mandor</td><td>";
		cmbDBidclass("mandor", "mandor", "kode_mandor", "nama", $mandor, "kode_p", "");
		echo "</tr>";
		echo "<tr><td>Area</td><td id='area'><select id='op_area'><option value=''>--</option></td></tr>";
		echo "<tr><td>Pekerjaan</td><td><div id='item'><select id='op_item'><option value=''>--</option></div></td></tr>";
		echo "<tr><td>Periode</td><td><input type='text' name='periode' id='date' value=''</td></tr>";
		cInput1("No SPK", "no_spk", "20", $no_spk);
		cInput1("Progres", "progres", "20", $progres); 
		echo cSubmit("submit", $tombol);


		?>
		</table>
	</form>
	</div>
	<div class="module_content">

		<?php		

		// ================ TAMPILKAN DATANYA =====================//
		echo "<table border='1' class='data'>
		<tr><th width='1%'>NO</th>
		<th width='5%'>Mandor</th>
		<th width='5%'>Area</th>
		<th width='5%'>No SPK</th>
		<th width='10%'>Pekerjaan</th>		
		<th width='1%'>Satuan</th>
		<th width='1%'>Progress</th>
		<th width='5%'>Harga</th>
		
		
		

		</tr>";


$q_proyek	= mysql_query("SELECT periode, year(periode), month(periode), DAYOFMONTH(periode) FROM opname WHERE kode_proyek = '$kodep' GROUP BY periode ASC") or die (mysql_error());

		 
		while ($a_data = mysql_fetch_array($q_proyek)) {
			$kode_      = $a_data[0];
			$tahun  	= $a_data[1];
			$bulan 		= $a_data[2];
			$hari 		= $a_data[3];
		echo "<tr><td colspan='8' height='15px'><b>PERIODE</b> <b>$kode_</b></td><tr>";

$result = mysql_query("SELECT opname.periode, opname.area, mandor.nama, opname.kode_mandor FROM opname JOIN mandor ON opname.kode_mandor = mandor.kode_mandor WHERE periode = '$kode_' GROUP BY area ORDER BY area ASC");
			
			while($data = mysql_fetch_array($result)){		
			$result2 = mysql_query("SELECT  opname.id, opname.no_spk, master_upah.nama_upah, opname.harga, master_upah.satuan, opname.progres FROM opname JOIN master_upah ON opname.kode_upah = master_upah.kode_upah  WHERE area='".$data['area']."' && periode = '$kode_'"); //get ukuran
 			$total = mysql_num_rows($result2);


$no++;
$jum = 1;
				echo "<tr>";
				if($jum <= 1) {
        echo '<td align="center" rowspan="'.$total.'">'.$no.'</td>';
        echo '<td rowspan="'.$total.'">'.$data['nama'].'</td>';  
        echo '<td rowspan="'.$total.'">'.$data['area'].'</td>';
        $jum = $total;      
                           
    } else {
        $jum = $jum - 1;
    }
     while($data2 = mysql_fetch_array($result2)){
    echo '<td>'.$data2['no_spk'].'</td>'; 
    echo '<td>'.$data2['nama_upah'].'</td>'; 
    echo '<td id="tengah">'.$data2['satuan'].'</td>'; 
    echo '<td id="tengah">'.$data2['progres'].'%</td>';
    echo '<td>Rp '.number_format($data2['harga'],0,',','.').'</td>';
    

    
    $tool = "<a href='?p=stok_pekerjaan&mod=edit&id=$data2[id]'>Edit</a>";
    echo "</tr>";
				
			}
		}
		}
		?>
</div>
</article>
<script type="text/javascript">

	function loadPekerjaan (){
		var area1 = $('#op_area option:selected').val();
		$('#item').load('./function/pekerjaan.php?id='+encodeURI(area1));
	}

	$('#kode_p').change(function() {
		var kode_p = $('#kode_p').val();
		$('#area').load('./function/area_opname.php?id='+encodeURI(kode_p), function() {
		  loadPekerjaan();
		});
	});
</script>
<script type="text/javascript">
	$('#area').change(function() {
		loadPekerjaan();
	});
</script>
