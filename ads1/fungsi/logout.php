<?php
session_start();
session_destroy();

//redirect ke halaman login
 echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
?>