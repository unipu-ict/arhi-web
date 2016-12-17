<?php

    include ('../include/menu.php');
    if ($_SESSION['id']==1){

if (isset($_GET['id']) && is_numeric($_GET['id']))
    {
// get id value
$id = $_GET['id'];

// delete the entry
$sql="delete from mjesto where id_grad='$_GET[id]'";
$query = mysqli_query($link,$sql);

if ($query){
        echo '<div>
            <div class="alert message-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-ok"></span> 
            <strong>Radnja je bila uspješna!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/mjesto_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        
    }else if (mysqli_errno($link) == 1451){
        echo '<div>
            <div class="alert message-not-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-remove"></span> 
            <strong>Greška! Zapis nije moguće izbrisati.</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/mjesto_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
    }else {
        echo '<div>
            <div class="alert message-not-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-remove"></span> 
            <strong>Radnja nije bila uspješna!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/mjesto_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        }
    }
?>
<?php
    }else{
        echo '<div>
            <div class="alert message-not-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-remove"></span> 
            <strong>Nemate ovlasti za izvršenje tražene radnje!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/korisnik_list_.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
    }
?>
