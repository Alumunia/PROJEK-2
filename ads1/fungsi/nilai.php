<?php
session_start();
include 'config.php';

$id=$_GET['id'];
$nilai1=$_POST['Keutuhan'];
$nilai2=$_POST['Keterpilahan'];
$jum=$nilai1+$nilai2;

$var=mysql_query("select * from poin where id_anggota='$id'");
$var1=mysql_fetch_array($var);
$total=$jum + $var1['jumlah'];
$tgl=date("d-m-Y");
$queriku = mysql_query("UPDATE `poin` SET `jumlah` = '$total', tanggal='$tgl' WHERE `id_anggota` ='$id';");
if($queriku){echo "<script language='javascript'>
				window.alert('Proses Berhasil!');
			  </script>";
			  echo "<meta http-equiv='refresh' content='0; url=../member.php'>";
			  
			  } 
			  
			  
			  else {echo "<script language='javascript'>
				window.alert('Proses Gagal!');
			  </script>";echo "<meta http-equiv='refresh' content='0; url=../member.php'>";}

?>