 
<article class="module width_full">

<div class="module_content">

		<?php		

		// ================ TAMPILKAN DATANYA =====================//
		echo "<table border='1' class='data'>
		<tr><th width='2%'>NO</th>
		<th width='8%'>Area</th>
		<th width='5%'>Mandor</th>
		<th width='10%'>Pekerjaan</th>		
		<th width='3%'>Satuan</th>
		<th width='3%'>Harga</th>
		<th width='3%'>Progress Belum Dikerjakan</th>
		<th width='2%'>Option</th>
		

		</tr>";
session_start(); 
$level1 = $_SESSION['level'] == '1';
$level2 = $_SESSION['level'] == '2';
$level3 = $_SESSION['level'] == '3';
if($level1){
   include "./tmp/pekerjaan 01.php"; 
 } if ($level2) {
   include "./tmp/pekerjaan 01.php";
 } if ($level3) { 
   include "./tmp/pekerjaan 02.php"; 
 } 
 ?>	
<script type="text/javascript">
$('#kode_p').change(function() {
	var kode_p = $('#kode_p').val();
	$('#area').load('./zona.php?id='+kode_p);
});
</script>