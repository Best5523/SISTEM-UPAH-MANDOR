<?php

include "fungsi.php";


session_start();
$name = $_SESSION['name'];
$sql = mysql_query("SELECT * FROM user WHERE name = '$name' LIMIT 1");
if (mysql_num_rows($sql) == 0){}
else{$data = mysql_fetch_array($sql); 
	$kodep 			= $data[5];}
	

$kode_mandor = $_GET["mandor"];
$periode = $_GET["periode"];


$q_proyek	= mysql_query("SELECT periode, nama FROM opname JOIN mandor ON opname.kode_mandor = mandor.kode_mandor WHERE kode_proyek = '$kodep' && periode = '$periode' GROUP BY periode ASC") or die (mysql_error());

		 
		while ($a_data = mysql_fetch_array($q_proyek)) {
			$kode_      = $a_data[0];
			$nama_m 	= $a_data[1];

?>
<div class="module_content" id="lap">

		<?php		
		echo "<div style='font-size: 15px; margin-bottom: 10px; font-weight:bold;'>Nama Mandor :$nama_m    <button><a href= './print/print_lpom.php?mandor=$kode_mandor&periode=$periode' target='_blank'><i>Print</i></a></button></div>";
		// ================ TAMPILKAN DATANYA =====================//
		echo "<table border='1' class='data'>
		<tr><th width='1%'>NO</th>
		
		<th width='5%'>Area</th>
		<th width='5%'>No SPK</th>
		<th width='10%'>Pekerjaan</th>		
		<th width='1%'>Satuan</th>
		<th width='1%'>Progress</th>
		<th width='3%'>Harga</th>
		
		
		

		</tr>";



			
		
			
			
$result = mysql_query("SELECT opname.periode, opname.area, mandor.nama FROM opname JOIN mandor ON opname.kode_mandor = mandor.kode_mandor WHERE periode = '$periode' && opname.kode_mandor = '$kode_mandor' GROUP BY area ORDER BY area ASC");
			
		
			
			echo "<tr><td colspan='8' height='15px'><b>Periode :</b> <b>$kode_</b></td><tr>";

			$no = 0;
				
			while($data = mysql_fetch_array($result)){		
			$result2 = mysql_query("SELECT  opname.id, opname.no_spk, master_upah.nama_upah, opname.harga, master_upah.satuan, opname.progres FROM opname JOIN master_upah ON opname.kode_upah = master_upah.kode_upah WHERE periode = '$periode' && area='".$data['area']."' "); //get ukuran
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
    echo '<td>'.$data2['no_spk'].'</td>'; 
    echo '<td>'.$data2['nama_upah'].'</td>'; 
    echo '<td id="tengah">'.$data2['satuan'].'</td>'; 
    echo '<td id="tengah">'.$data2['progres'].'%</td>';
    echo '<td>Rp '.number_format($data2['harga'],0,',','.').'</td>';
    echo "</tr>";
				
			}
		}
		}
?>