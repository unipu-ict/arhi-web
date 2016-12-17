<?php

    include ('../include/menu.php');

if (isset($_GET['id']) && is_numeric($_GET['id']))
    {
// get id value
$id = $_GET['id'];
echo $id;

// za id_zahtjeva da se vratim na tocnu prijavnicu
$select =  "SELECT id_zaharh,signatura,oznaka,naziv,tehjed,oblik_kor,addedby,id_zahtjeva
                FROM zahtjevnica_arhjed
                WHERE id_zaharh='".$_GET['id']."'";

$query=mysqli_query($link,$select);

if($query)
        {
        while($records = mysqli_fetch_array($query)){
            $IdZahtjeva = "$records[id_zahtjeva]";
            }
        }

// delete the entry
$sql="delete from zahtjevnica_arhjed where id_zaharh='$_GET[id]'";
$query2 = mysqli_query($link,$sql);

if ($query2){
        echo '<div>
            <div class="alert message-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-ok"></span> 
            <strong>Radnja je bila uspješna!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/zahtjevnica_arhjed_list.php?id='.$IdZahtjeva.'""><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/zahtjevnica_arhjed_list.php?id='.$IdZahtjeva.'""><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/zahtjevnica_arhjed_list.php?id='.$IdZahtjeva.'""><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        }
    }
?>
