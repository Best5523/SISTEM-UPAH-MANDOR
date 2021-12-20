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



if ($_GET['mod'] == "cari") {
	
	$periode		= "";
	$kode_mandor	= "";
	$tombol 		= "Cari"; 

} 

$p_tombol		= $_POST['submit'];
$p_periode 		= $_POST['periode'];
$p_kode_mandor 	= $_POST['mandor'];

	

if ($p_tombol == "Cari") {
	$cek_data = "SELECT * FROM opname WHERE kode_proyek = '$kodep' && kode_mandor = '$p_kode_mandor' && periode = '$p_periode'";
	$cek = mysql_num_rows(mysql_query($cek_data));
	if ($cek == 0 ) {
	}else{
		$data_ = mysql_fetch_row(mysql_query($cek_data));
		$kode_proyek = $data_[1];
		$periode     = $data_[3];
		$kode_mandor = $data_[6];
		
	}


}
	

?>	
<article class="module width_full">
	
	<div class="module_content">
	
		<table >
		<?php		
		
		echo "<tr><td>";
		mandor("mandor", "mandor", "kode_mandor", "nama", $mandor, "kode_p", "");
		
		echo "<td id='speriode'><select id='periode'><option value=''>Pilih Periode</option></td>";
		
		echo "<td><button  onclick='cari()'>Cari</button></td></tr>";
		


		?>
		</table>
	
	</div>
	</article>
	
	<article class="module width_full">
	<header></header>
	<div class="module_content" id="lap">

		
</div>
</article>

<script type="text/javascript">
$('#kode_p').change(function() {
	var kode_p = $('#kode_p').val();
	$('#speriode').load('./function/periode.php?id='+kode_p);
});

function cari(){
		var kode_p = $("#kode_p option:selected").val();
		var periode = $("#periode option:selected").val();
		$('#lap').load('./function/data.php?mandor='+kode_p+'&periode='+periode);
}
</script>
