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

	

?>	
<article class="module width_full">
	
	<div class="module_content">
	
		<table >
		<?php		
		
		echo "<tr><td>";
		periode("opname", "opname", "periode", $kodep, "kode_proyek", "kode_p", "");
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

function cari(){
		var kode_p = $("#kode_p option:selected").val();
		$('#lap').load('./function/data_b.php?periode='+kode_p);
}
</script>
