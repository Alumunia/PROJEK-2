<?php
session_start();
include 'config.php';

$id=$_GET['id'];
$nilai1=$_POST['koin'];
$nilai2=$nilai1*200;
$var=mysql_query("select * from koin where id_anggota='$id'");
$var1=mysql_fetch_array($var);
$total=$nilai2 + $var1['jumlah'];
$tgl=date("d-m-Y");
$var_t=mysql_query("select * from poin koin where id_anggota='$id'");
$var_t=mysql_fetch_array($var_t);
$nilaiskr=$var_t['jumlah']-$nilai1;
$queriku1 = mysql_query("UPDATE `poin` SET `jumlah` = '$nilaiskr' WHERE `id_anggota` ='$id';");
$queriku2 = mysql_query("UPDATE `koin` SET `jumlah` = '$total', tanggal='$tgl' WHERE `id_anggota` ='$id';");
if($queriku1 AND $queriku2){echo "<script language='javascript'>
				window.alert('Proses Berhasil!');
			  </script>";
			  echo "<meta http-equiv='refresh' content='0; url=../beranda.php'>";
			  
			  } 
			  
			  
			  else {echo "<script language='javascript'>
				window.alert('Proses Gagal!');
			  </script>";echo "<meta http-equiv='refresh' content='0; url=../beranda.php'>";}

?>