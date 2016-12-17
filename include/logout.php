<!--connection with database-->
<?php include('../include/dbconnection.php'); ?>
<!--end of connection-->
<?php
	include('../include/session.php');
	session_start();
	session_destroy();
	header('location:../public_html/index.php');
?>
