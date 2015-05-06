<?php
include 'config.php';
session_start();
$username=$_POST['username'];
$password=$_POST['password'];

$nama=$_POST['nama'];
$email=$_POST['email'];
$alamat=$_POST['alamat'];
$nomorhp=$_POST['nomorhp'];
$npwp=$_POST['npwp'];
$debit=$_POST['debit'];

$query1 = mysql_query("INSERT INTO `login` (`username`, `password`, `level`) VALUES ('$username', '$password', 'member')") or die(mysql_error());
if($query1){$var=mysql_query("select * from login where username='$username'");
$var2 = mysql_fetch_array($var);
$var3=$var2['id_login'];
} else {echo 'error insert awal';}

//simpan data ke database
$query = mysql_query("INSERT INTO `anggota` (`id_login`, `nama`, `alamat`, `no_hp`, `email`, `no_kartu_debit`, `npwp`) VALUES ('$var3', '$nama', '$alamat', '$nomorhp', '$email', '$debit', '$npwp')") or die(mysql_error());

if($query){$var4=mysql_query("select * from anggota where nama='$nama'");
$var5 = mysql_fetch_array($var4);
$id_anggota=$var5['id_anggota'];
} else {echo 'error insert dua error';}
$query3 = mysql_query("INSERT INTO `poin` (`id_anggota`) VALUES ('$id_anggota')") or die(mysql_error());
$query4 = mysql_query("INSERT INTO `koin` (`id_anggota`) VALUES ('$id_anggota')") or die(mysql_error());


if ($query AND $query3 AND $query4) {
    header('location:../sukses.php?message=success');
}
?>