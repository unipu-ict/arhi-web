<?php 
	include ('../include/menu.php');
        if ($_SESSION['id']==1){
?>
    <title>ArhiWeb: Prijavnice</title>
    <link href="../jquery-ui/jquery-ui.css" rel="stylesheet">
    <script src="../jquery-ui/jquery-1.10.2.js"></script>
    <script src="../jquery-ui/jquery-ui.js"></script>
    <script src="../jquery-ui/datepicker-hr.js"></script>

<div class="container-fluid">

<?php    
    
    $select =  "SELECT id_prifon,signatura,naziv_fonda,addedby,id_prijave
                FROM prijavnica_fond
                WHERE id_prifon='".$_GET['id']."'";

    $query=mysqli_query($link,$select);
   
    if($query)
        {
        while($records = mysqli_fetch_array($query)){
            $IdPrifon = "$records[id_prifon]";
            $Signatura = "$records[signatura]";
            $NazivFonda = "$records[naziv_fonda]";
            $AddedBy = "$records[addedby]";
            $IdPrijave = "$records[id_prijave]";
            }
        }
        
    if (isset($_POST['submit'])){
        $Signatura = $_POST['signatura'];
        $NazivFonda = $_POST['naziv_fonda'];
        $AddedBy = $_POST['addedby'];
        $IdPrijave = $_POST['id_prijave'];

    //izmjene u bazi
    $sql = "update prijavnica_fond set
        signatura='".$Signatura."',
        naziv_fonda='".$NazivFonda."',
        addedby='".$AddedBy."',
        id_prijave=".$IdPrijave."
        where id_prifon='".$_GET['id']."' LIMIT 1";

    $query = mysqli_query($link,$sql);
    
    if ($query){
        echo '<div>
            <div class="alert message-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-ok"></span> 
            <strong>Radnja je bila uspješna!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/prijavnica_fond_list.php?id='.$IdPrijave.'"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        
    }else if (mysqli_errno($link) == 1062){
        echo '<div>
            <div class="alert message-not-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-remove"></span> 
            <strong>Greška! Zapis je već unesen!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/prijavnica_fond_list.php?id='.$IdPrijave.'"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/prijavnica_fond_list.php?id='.$IdPrijave.'"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        }
    }
    ?>  
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Prijavnice za korištenje gradiva - gradivo: izmjeni zapis</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-default-add">
                <div class="panel-body">
                    <form enctype="multipart/form-data" method="post" class="form-horizontal">
                        <fieldset>
                            <!-- Signatura -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="signatura">Signatura fonda/zbirke:</label>
                                <div class="col-md-2">
                                    <input id="signatura" name="signatura" type="text" value="<?php echo $Signatura;?>" placeholder="HR-DAPA-" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Naziv fonda/zbirke-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="naziv_fonda">Naziv fonda/zbirke:</label>
                                <div class="col-md-3">
                                    <input id="naziv_fonda" name="naziv_fonda" type="text" value="<?php echo $NazivFonda;?>" placeholder="Naziv fonda/zbirke" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Dodao zapis -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="addedby">Zapis izmjenjen:</label>  
                                <div class="col-md-3">
                                    <input id="addedby" name="addedby" type="text" class="form-control input-md" value="<?php echo "".$FirstName." ".$LastName.", ".date('d.m.Y.');?>" readonly>
                                </div>
                            </div>
                            <!-- ID prijavnice -->
                            <div class="form-group">
                                <label class="col-md-2 control-label hide" for="id_prijave">ID prijavnice:</label>
                                <div class="col-md-3">
                                    <input id="id_prijave" name="id_prijave" type="text" value="<?php echo $IdPrijave;?>" placeholder="ID prijavnice" class="form-control input-md hide">
                                </div>
                            </div>
                            <!-- Spremanje -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="submit"></label>
                                <div class="col-md-8">
                                    <button id="submit" name="submit" class="btn btn-primary" title="Izmjeni zapis">Izmjeni</button>
                                    <a href = "../public_html/prijavnica_fond_list.php?id=<?php echo $IdPrijave?>"><input type = "button" value = "Poništi" class="btn btn-default" title="Natrag na listu"></a>
                                </div>
                            </div>
                            </div>
            </div>
        </div>
    </div>
</div>
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