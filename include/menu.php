<!--autor: Sebastijan Legović-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../img/favicon.ico">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style-inside.css" rel="stylesheet">
    <link href="../bootstrap/fonts/font-awesome.min.css" rel="stylesheet">

  </head>
  <body>
      <div class="container-fluid">
         <?php
	require("../include/dbconnection.php");
        session_start();
        if (!isset($_SESSION['id'])){
            header('location:../public_html/index.php');
        }
        ?>
            <?php
		$id=$_SESSION['id'];
		$link = mysqli_connect("localhost", "root", "", "citaonica");
                mysqli_query($link,'SET CHARACTER SET utf8');//hrvatski znakovi
		$result=mysqli_query($link,"select * from evidenticar where id=$id");
               	$row=mysqli_fetch_array($result);
		$FirstName=$row['ime'];
		$LastName=$row['prezime'];
                $Odjel=$row['odjel'];
            ?> 
        <!-- GLAVNI IZBORNIK -->
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="korisnik_list.php"><img src="../img/logo-inside.png" alt="logo"></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="dropdown-toggle">
                            <a href="korisnik_list.php?id=<?php echo $row['id'];?>" class="dropdown-toggle" data-toggle="dropdown"><strong>Korisnici</strong> </a>
                        </li>
                        <li class="dropdown-toggle">
                            <a href="prijavnica_list.php?id=<?php echo $row['id'];?>" class="dropdown-toggle" data-toggle="dropdown"><strong>Prijavnice</strong></a>
                        </li>
			<li class="dropdown-toggle">
                            <a href="zahtjevnica_list.php?id=<?php echo $row['id'];?>" class="dropdown-toggle" data-toggle="dropdown"><strong>Zahtjevnice</strong></a>
			</li>
			<li>
                            <a href="dnevnik_list.php?id=<?php echo $row['id'];?>" class="dropdown-toggle" data-toggle="dropdown"><strong>Dnevnik čitaonice</strong></a>
                        </li>
			<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Šifarnici</strong><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="drzava_list.php?id=<?php echo $row['id'];?>">Države</a></li>
                                <li><a href="mjesto_list.php?id=<?php echo $row['id'];?>">Mjesta</a></li>
                                <li><a href="svrha_ist_list.php?id=<?php echo $row['id'];?>">Svrha istraživanja</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Izvještaji</strong><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="../public_html/korisnik_report.php">Evidencija korisnika</a></li>
                                <li><a href="../public_html/dnevnik_report.php">Dnevnik čitaonice</a></li>
                                <li><a href="../public_html/zahtjevnica_report.php">Evidencija korištenja</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong>Statistika</strong><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="../public_html/korisnik_charts.php">Evidencija korisnika</a></li>
                                <li><a href="../public_html/zahtjevnica_charts.php">Evidencija korištenja</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <p class="navbar-text">Evidentičar: <strong><?php echo " ".$FirstName."&nbsp".$LastName.""; ?></strong></p>
                        <p class="navbar-text"><strong><?php echo (new \DateTime())->format('d.m.Y.'); ?></strong></p>
                        <li><p class="navbar-text"><a onclick="javascript:return confirm('Odjava iz aplikacije?')" href="../include/logout.php" class="navbar-link" title="Odjavi se"><strong>Odjava</strong></a></p></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</body>
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/jquery.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/jquery.sortelements.js" type="text/javascript"></script>
    <script src="../bootstrap/js/jquery.bdt.js" type="text/javascript"></script>

</html>
    <!-- Javi grešku ukoliko nije ispunjeno obavezno polje -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var elements = document.getElementsByTagName("INPUT");
            for (var i = 0; i < elements.length; i++) {
                elements[i].oninvalid = function(e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity("Obavezan unos!");
                    }
                };
                elements[i].oninput = function(e) {
                    e.target.setCustomValidity("");
                };
            }})
        document.addEventListener("DOMContentLoaded", function() {
            var elements = document.getElementsByTagName("SELECT");
            for (var i = 0; i < elements.length; i++) {
                elements[i].oninvalid = function(e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity("Obavezan unos!");
                    }
                };
                elements[i].oninput = function(e) {
                    e.target.setCustomValidity("");
                };
            }})
        document.addEventListener("DOMContentLoaded", function() {
            var elements = document.getElementsByTagName("TEXTAREA");
            for (var i = 0; i < elements.length; i++) {
                elements[i].oninvalid = function(e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity("Obavezan unos!");
                    }
                };
                elements[i].oninput = function(e) {
                    e.target.setCustomValidity("");
                };
            }})
    </script>