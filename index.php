<?php
session_start();
include 'function/fungsi.php';
?>
<!--halaman login-->
<!DOCTYPE html>
<html class="background">
<head>
	<title>SISLU PROYEK</title>
	<link rel="stylesheet" href="lib/css/layout.css" type="text/css"  />
</head>
<body class="background">
	<div class="kotak_login">
		<p class="tulisan_login"><b>Silahkan login</b></p>
 
		<form method="post" action="" >
		
			<input type="text" name="username" class="form_login" placeholder="Username .." required="required">
 			<input type="password" name="password" class="form_login" placeholder="Password .." required="required">
 
			<input type="submit" class="tombol_login" name="login" value="login">
 
			<br/>
			<br/>
		</form>
		<?php
        if (isset($_POST['login']))
        {
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $data_user = mysqli_query($conn, "SELECT * FROM user where username = '$user' AND pass = '$pass'");
            $d = mysqli_fetch_array($data_user);

            
            $username = $d['username'];
            $password = $d['pass'];
            $nama = $d['name'];
            $level = $d['id_level'];
            if($user == $username && $pass == $password)
            {
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $nama;
                $_SESSION['level'] = $level;
                $_SESSION['timestamp']=time();
               
            }else{
                    echo 'username atau password yang anda masukan salah';
                 }                  
        }
        ?>
	</div>
 
 
</body>
</html>
