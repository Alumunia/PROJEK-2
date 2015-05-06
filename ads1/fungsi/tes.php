<?php 
//jika session username belum dibuat, atau session username kosong
if (empty($_SESSION['level'])) {
	//redirect ke halaman login
	 echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
?>