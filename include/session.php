<?php
    session_start(); 
    if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) { 
    header('location:../public_html/citaonica/index.php');
    }
    $session_id=$_SESSION['id'];
    $link = mysqli_connect("localhost", "root", "", "citaonica");
    $user_query = mysqli_query($link,"select * from evidenticar where id='$session_id'")or die(mysql_error());
    $user_row = mysqli_fetch_array($user_query);
    $user_username = $user_row['username'];
?>