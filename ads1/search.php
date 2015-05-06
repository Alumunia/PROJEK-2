<?php
session_start();
include 'fungsi/config.php';
$var=$_POST["search"];
$query = mysql_query("select * from jalan where nama='$var'");
$data = mysql_fetch_array($query);
$_SESSION['lat']=$data['lat'];
$_SESSION['lng']=$data['lng'];

if($data AND $_SESSION['level']){echo"<script>window.location='beranda.php';</script>";exit;} 
else if ($data)
{echo"<script>window.location='index.php';</script>";exit;} 
else
{echo"<script>alert('lokasi jalan tidak ditemukan');window.location='index.php';</script>";exit;}
?>