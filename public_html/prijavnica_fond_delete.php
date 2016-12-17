<?php

    include ('../include/menu.php');

if (isset($_GET['id']) && is_numeric($_GET['id']))
    {
// get id value
$id = $_GET['id'];

// za id_prijave da se vratim na tocnu prijavnicu
$select =  "SELECT id_prifon,signatura,naziv_fonda,id_prijave
                FROM prijavnica_fond
                WHERE id_prifon='".$_GET['id']."'";

$query=mysqli_query($link,$select);

if($query)
        {
        while($records = mysqli_fetch_array($query)){
            $IdPrijave = "$records[id_prijave]";
            }
        }

// delete the entry
$sql="delete from prijavnica_fond where id_prifon='$_GET[id]'";
$query2 = mysqli_query($link,$sql);

if ($query2){
        echo '<div>
            <div class="alert message-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-ok"></span> 
            <strong>Radnja je bila uspješna!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/prijavnica_fond_list.php?id='.$IdPrijave.'""><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/prijavnica_fond_list.php?id='.$IdPrijave.'""><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/prijavnica_fond_list.php?id='.$IdPrijave.'""><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        }
    }
?>

