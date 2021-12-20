<?php 
session_start();
$n = $_SESSION ['name'];
$sql = mysql_query("SELECT * FROM user WHERE name = '$n' LIMIT 1");
$v = mysql_fetch_array($sql);
$kode_p = $v[5];


	


		
		$q_proyek	= mysql_query("SELECT proyek.kode_proyek, proyek.nama_proyek, COUNT(area) AS 'jumlah' FROM proyek INNER JOIN stok_pekerjaan ON proyek.kode_proyek = stok_pekerjaan.kode_proyek WHERE proyek.kode_proyek = '$kode_p' GROUP BY nama_proyek ASC") or die (mysql_error());

		 
		while ($a_data = mysql_fetch_array($q_proyek)) {
			$kode_      = $a_data[0];
			$nama_p 	= $a_data[1];
		
			
			
$result = mysql_query("SELECT stok_pekerjaan.kode_proyek, stok_pekerjaan.area, mandor.nama FROM area_proyek JOIN stok_pekerjaan ON area_proyek.area = stok_pekerjaan.area JOIN master_upah ON stok_pekerjaan.kode_upah = master_upah.kode_upah JOIN mandor ON area_proyek.kode_mandor = mandor.kode_mandor WHERE stok_pekerjaan.kode_proyek = '$kode_' GROUP BY area ORDER BY area ASC");
			
		
			
			echo "<tr><td colspan='8' height='15px'><b>$nama_p</b></td><tr>";

			
				
			while($data = mysql_fetch_array($result)){		
			$result2 = mysql_query("SELECT  stok_pekerjaan.id, master_upah.nama_upah, stok_pekerjaan.harga, master_upah.satuan, stok_pekerjaan.progres FROM stok_pekerjaan JOIN master_upah ON stok_pekerjaan.kode_upah = master_upah.kode_upah WHERE area='".$data['area']."'"); //get ukuran
 			$total = mysql_num_rows($result2);


$no++;
$jum = 1;
				echo "<tr>";
				if($jum <= 1) {
        echo '<td align="center" rowspan="'.$total.'">'.$no.'</td>';
        echo '<td rowspan="'.$total.'">'.$data['area'].'</td>';  
        echo '<td rowspan="'.$total.'">'.$data['nama'].'</td>';
        $jum = $total;      
                           
    } else {
        $jum = $jum - 1;
    }
     while($data2 = mysql_fetch_array($result2)){
$tool = "<a href='?p=stok_pekerjaan&mod=edit&id=$data2[id]'>Edit</a>";
    echo '<td>'.$data2['nama_upah'].'</td>'; 
    echo '<td id="tengah">'.$data2['satuan'].'</td>'; 
    echo '<td>Rp '.number_format($data2['harga'],0,',','.').'</td>';
    echo '<td id="tengah">'.$data2['progres'].'%</td>';

    echo '<td id="tengah">Disable</td>';
    
    echo "</tr>";
				
			}
		}
		}
		?>

		</div>

</article>