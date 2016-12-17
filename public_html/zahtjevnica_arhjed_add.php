<?php 
	include ('../include/menu.php');
        $id = $_GET['id'];
        if ($_SESSION['id']==1){
?>
    <title>ArhiWeb: Zahtjevnice</title>
    <link href="../jquery-ui/jquery-ui.css" rel="stylesheet">
    <script src="../jquery-ui/jquery-1.10.2.js"></script>
    <script src="../jquery-ui/jquery-ui.js"></script>
    <script src="../jquery-ui/datepicker-hr.js"></script>

<div class="container-fluid">

<?php
if (isset($_POST['submit'])){
    $Signatura = $_POST['signatura'];
    $Oznaka = $_POST['oznaka'];
    $Naziv = $_POST['naziv'];
    $Tehjed = $_POST['tehjed'];
    $OblikKor = $_POST['oblik_kor'];
    $AddedBy = $_POST['addedby'];
    $IdZahtjeva = $_POST['id_zahtjeva'];

//unos u bazu
    $sql = "insert into zahtjevnica_arhjed (signatura,oznaka,naziv,tehjed,oblik_kor,addedby,id_zahtjeva)
        values ('$Signatura','$Oznaka','$Naziv','$Tehjed','$OblikKor','$AddedBy',$IdZahtjeva)";
    
    $query = mysqli_query($link,$sql);
    
    if ($query){
        echo '<div>
            <div class="alert message-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-ok"></span> 
            <strong>Radnja je bila uspješna!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/zahtjevnica_arhjed_list.php?id='.$id.'"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/zahtjevnica_arhjed_list.php"?id='.$id.'"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/zahtjevnica_arhjed_list.php?id='.$id.'"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        }
    }
    ?>  
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Zahtjevnice za korištenje gradiva - gradivo: dodaj novi zapis</h2>
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
                                    <input id="signatura" name="signatura" type="text" placeholder="HR-DAPA-" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Oznaka arh. jedinice -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="oznaka">Oznaka arh. jedinice:</label>
                                <div class="col-md-2">
                                    <input id="oznaka" name="oznaka" type="text" placeholder="Oznaka arh. jedinice" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Naziv arh. jedinice -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="naziv">Naziv i vrijeme arh. jedinice:</label>
                                <div class="col-md-3">
                                    <input id="naziv" name="naziv" type="text" placeholder="Naziv i vrijeme arh. jedinice" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Teh. jedinica -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="tehjed">Oznaka teh. jedinice:</label>
                                <div class="col-md-2">
                                    <input id="tehjed" name="tehjed" type="text" placeholder="Oznaka teh. jedinice" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Oblik koristenja -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="oblik_kor">Oblik korištenja:</label>
                                <div class="col-md-2">
				<select id="oblik_kor" name="oblik_kor" class="form-control" required="">
                                    <option>1 - korištenje ObP</option>
                                    <option>2 - korištenje izvornika</option>
                                    <option>3 - korištenje preslika</option>
                                    <option>4 - narudžba preslika</option>
                                </select><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Dodao zapis -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="addedby">Zapis kreiran:</label>  
                                <div class="col-md-3">
                                    <input id="addedby" name="addedby" type="text" class="form-control input-md" value="<?php echo "".$FirstName." ".$LastName.", ".date('d.m.Y.');?>" readonly>
                                </div>
                            </div>
                            <!-- ID zahtjeva -->
                            <div class="form-group">
                                <label class="col-md-2 control-label hide" for="id_zahtjeva">ID zahtjeva:</label>
                                <div class="col-md-3">
                                    <input id="id_zahtjeva" name="id_zahtjeva" type="text" value="<?php echo $id;?>" placeholder="ID zahtjeva" class="form-control input-md hide" required="">
                                </div>
                            </div>
                            <!-- Spremanje -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="submit"></label>
                                <div class="col-md-8">
                                    <button id="submit" name="submit" class="btn btn-primary" title="Spremi zapis">Spremi</button>
                                    <a href = "../public_html/zahtjevnica_arhjed_list.php?id=<?php echo $id?>"><input type = "button" value = "Poništi" class="btn btn-default" title="Natrag na listu"></a>
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