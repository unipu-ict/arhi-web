<?php

//PHP built in function for connecting to MySQL database
$mysqli = @new mysqli('localhost', 'root','', 'citaonica');

if ($mysqli->connect_error) {
    die('Connect Error: ' . $mysqli->connect_error);
}

//mysqli_report(MYSQLI_REPORT_ERROR);

?>