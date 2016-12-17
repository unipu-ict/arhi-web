<!--autor: Sebastijan Legović-->
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArhiWeb: prijava u aplikaciju</title>
    <link rel="shortcut icon" href="../img/favicon.ico">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
        <?php include '../include/login.php';?>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="page-header">
                                <center><img src="../img/logo.png" alt="logo"/></center>
                                <h1 style="text-align: center;">ArhiWeb <small> - prijava</small></h1>
                                <div>
                                    <p class="date-text">
                                    <?php
                                    $hrformat = "<B>%A - %d.%m.%Y.</B>";
                                    setlocale(LC_ALL,'croatian'); 
                                    $res = strftime($hrformat); 
                                    $vrijeme = iconv('ISO-8859-2', 'UTF-8', $res);
                                    echo $vrijeme;
                                    ?>
                                    </p>
                                </div>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="index.php" class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-1 control-label"></label>
                                        <div class="col-sm-10">
                                            <input type="text" id="username" name="username" class="form-control" placeholder="Korisničko ime" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-1 control-label"></label>
                                        <div class="col-sm-10">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Zaporka" required>
                                        </div>
                                    </div>
                                    <div class="form-group last">
                                        <div class="col-sm-offset-1 col-sm-9">
                                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Prijavi se</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--Copyright-->
                        <div class="footer-text">
                            <p class="text-center">Copyright © 2016 Sebastijan Legović - projektni zadatak iz kolegija Izrada inf. projekata</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
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
    </script>
