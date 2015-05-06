<?php
session_start();
include('config.php');
//tangkap data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

//untuk mencegah sql injection
//kita gunakan mysql_real_escape_string
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

//cek data yang dikirim, apakah kosong atau tidak
if (empty($username) && empty($password)) {
	//kalau username dan password kosong
	header('location:login.php?error=9');
	break;
} else if (empty($username)) {
	//kalau username saja yang kosong
	header('location:login.php?error=2');
	break;
} else if (empty($password)) {
	//kalau password saja yang kosong
	header('location:login.php?error=3');
	break;
}

$q = mysql_query("select * from login where username='$username' and Password='$password'");

if (mysql_num_rows($q) == 1) {
	//kalau username dan password sudah terdaftar di database
	//buat session dengan nama username dengan isi nama user yang login
	$_SESSION['username'] = $username;
	$sc1=mysql_query("select * from login where username='$username' and Password='$password'");
	$var1=mysql_fetch_array($sc1);
	$_SESSION['level']=$var1['level'];
	$login =$var1['id_login'];
	
	$sc=mysql_query("select * from anggota where id_login='$login'");
	$var=mysql_fetch_array($sc);
	$_SESSION['id_anggota']=$var['id_anggota'];
	$nama=$var['nama'];
	$_SESSION['nama']=$var['nama'];
	
	$sc2=mysql_query("select * from sampah where nama='$nama'");
	$var2=mysql_fetch_array($sc2);
	
	if(empty($var2['nama'])){$_SESSION['milik']="tdkpunya";}
	else if($var2['status']=="punya"){$_SESSION['milik']="punya";}
	else {$_SESSION['milik']="tdkpunya";}
	//redirect ke halaman index
	
	 echo "<meta http-equiv='refresh' content='0; url=../beranda.php'>";
} else {
	//kalau username ataupun password tidak terdaftar di database
	header('location:login.php?error=4');
}
?>