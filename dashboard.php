<?php
error_reporting(0);
session_start(); 
include "./function/fungsi.php";  
if (isset($_SESSION['level'])){
include "./function/menu_rolls.php"

?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>SISTIM UPAH MANDOR</title>
	
	<link rel="stylesheet" href="./lib/css/layout.css" type="text/css" media="screen" />
	
	<link rel="stylesheet" href="./lib/css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	
	<script src="./lib/js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<link rel="stylesheet" href="/resources/demos/style.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="./lib/js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript">

    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>
<script>
  $( function() {
    $( "#date" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );
  </script>
</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="dashboard.php">SISTIM UPAH MANDOR</a></h1>			
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p> <a href = "?p=edit_profil"> <?php echo $_SESSION['name'];?></a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="logout.php">Logout</a></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="Dashboard.php">Dashboard</a> <div class="breadcrumb_divider"></div> <a class="current"><?php echo $nav; ?></a></article>
		</div>
</section>
	
	<aside id="sidebar" class="column">
		<hr/>
		<?php $level1 = $_SESSION['level'] == '1';
			  $level2 = $_SESSION['level'] == '2';
			  $level3 = $_SESSION['level'] == '3';
		if($level1){?>
		<h3>Manage</h3>
		<ul class ="toggle">
			<li class="icn_view_users"><a href="?p=data_user&mod=add">Data User</a></li>
		</ul>	


		<h3>Master Data</h3>
		<ul class ="toggle">
			<li class="icn_new_article"><a href="?p=master_upah&mod=add">Master Upah</a></li>
			<li class="icn_new_article"><a href="?p=daftar_proyek&mod=add">Daftar Proyek</a></li>
			<li class="icn_new_article"><a href="?p=data_mandor&mod=add">Data Mandor</a></li>
			<li class="icn_new_article"><a href="?p=stok_pekerjaan&mod=add">Stok Pekerjaan</a></li>
		</ul>	
		
		<h3>Transaksi</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="?p=pekerjaan">Pekerjaan</a></li>
			<li class="icn_categories"><a href="?p=opname_mandor&mod=add">Opname Mandor</a></li>
		</ul>
		<h3>Laporan</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="?p=laporan_opname_mandor&mod=cari">Lap. Opname Mandor</a></li>
			<li class="icn_categories"><a href="?p=laporan_upah_bulanan">Lap. Upah Bulanan</a></li>
		</ul>
		<?php } 
		if($level2){?>
		
		<h3>Master Data</h3>
				<ul class ="toggle">
			<li class="icn_new_article"><a href="?p=master_upah&mod=add">Master Upah</a></li>
			<li class="icn_new_article"><a href="?p=daftar_proyek&mod=add">Daftar Proyek</a></li>
			<li class="icn_new_article"><a href="?p=data_mandor&mod=add">Data Mandor</a></li>
			<li class="icn_new_article"><a href="?p=stok_pekerjaan&mod=add">Stok Pekerjaan</a></li>
		</ul>	
		
		<h3>Transaksi</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="?p=pekerjaan">Pekerjaan</a></li>
			<li class="icn_categories"><a href="?p=opname_mandor&mod=add">Opname Mandor</a></li>
		</ul>
		<h3>Laporan</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="?p=laporan_opname_mandor&mod=cari">Lap. Opname Mandor</a></li>
			<li class="icn_categories"><a href="?p=laporan_upah_bulanan">Lap. Upah Bulanan</a></li>
		</ul>
		
		<?php } 
		if($level3){?>
		
		<h3>Transaksi</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="?p=pekerjaan">Pekerjaan</a></li>
			<li class="icn_categories"><a href="?p=opname_mandor&mod=add">Opname Mandor</a></li>
		</ul>
		<h3>Laporan</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="?p=laporan_opname_mandor&mod=cari">Lap. Opname Mandor</a></li>
			<li class="icn_categories"><a href="?p=laporan_upah_bulanan">Lap. Upah Bulanan</a></li>
		</ul>

		
		<?php } ?>
			
		<footer>
			<hr />
			<p><strong> 2021 &copy; Pt. Multikon</strong></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		<?php include $ambil; ?>
		<div class="spacer"></div>
	</section>
	<script type="text/javascript">
	$('#close').click(function() {
		$('.alert_success').slideUp("fast");
		$('.alert_error').slideUp("fast");
	});
	</script>

</body>

</html>
<?php
    } else {
        header("location: index.php");
    }
?>