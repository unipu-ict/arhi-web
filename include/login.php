<?php
	include('../include/dbconnection.php');
	
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            $link = mysqli_connect("localhost", "root", "", "citaonica");
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
                $str = stripslashes($str);
            }
            return mysqli_real_escape_string($link,$str);
            }

        if (isset($_POST['submit'])) {
            $UserName=clean($_POST['username']);
            $Password=clean(md5($_POST['password']));
            $link = mysqli_connect("localhost", "root", "", "citaonica");
            $result=mysqli_query($link,"select * from evidenticar where username='$UserName' and password='$Password'");
            $count=mysqli_num_rows($result);
            $row=mysqli_fetch_array($result);
            $privilege=$row['privilege'];
		
	if ($count>0){
            session_start();
            if ('admin'==$privilege) {
                $_SESSION['id']=$row['id'];
                header('location:../public_html/korisnik_list.php');
            }
            elseif ('user'==$privilege) {
                $_SESSION['id']=$row['id'];
                header('location:../public_html/korisnik_list_.php');
            }
            else{
                echo'<div class="container">
                    <div class="row">
                        <div class="message-login">
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <span class="glyphicon glyphicon-remove"></span><strong> Greška tijekom prijave!</strong>
                                        <hr class="message-inner-separator">
                                            <p>Uneseno korisničko ime ili zaporka nisu valjani! Pokušajte ih ponovo unijeti.</p>
                            </div>
                        </div>
                    </div>
                </div>';	
            }
        }
    }
?>

