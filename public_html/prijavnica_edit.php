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
    
    $select =  "SELECT p.id_prijave,p.rb_prijave,p.datum_prijave,p.tema_pod,p.odobrenje,p.datum_odb, 
                s.sif_svrhe, s.naziv, k.id_kor, k.prezime,k.ime, p.napomena, p.addedby
                FROM prijavnica p
                LEFT OUTER JOIN korisnik k ON p.id_kor=k.id_kor
                LEFT OUTER JOIN svrha_ist s ON p.sif_svrhe=s.sif_svrhe
                WHERE id_prijave='".$_GET['id']."'";

    $query=mysqli_query($link,$select);
   
    if($query)
        {
        while($records = mysqli_fetch_array($query)){
            $RbPrijave = "$records[rb_prijave]";
            $DatumPrijave = "$records[datum_prijave]";
            $TemaPod = "$records[tema_pod]";
            $Odobrenje = "$records[odobrenje]";
            $DatumOdb = "$records[datum_odb]";
            $IdKor = "$records[id_kor]";
            $SifSvrhe = "$records[sif_svrhe]";
            $Napomena = "$records[napomena]";
            $AddedBy = "$records[addedby]";
            $Prezime = "$records[prezime]";
            $Ime = "$records[ime]";
            $Naziv = "$records[naziv]";
            }
        }
        
    if (isset($_POST['submit'])){
        $RbPrijave = $_POST['rb_prijave'];
        $DatumPrijave = $_POST['datum_prijave'];
        $TemaPod = $_POST['tema_pod'];
        $Odobrenje = $_POST['odobrenje'];
        $DatumOdb = $_POST['datum_odb'];
        $IdKor = $_POST['id_kor'];
        $SifSvrhe = $_POST['sif_svrhe'];
        $Napomena = $_POST['napomena'];
        $AddedBy = $_POST['addedby'];
    
    //JQuery datepicker format za unos u mySQL bazu
    $DatumP=date("Y-m-d",strtotime($DatumPrijave));
    $DatumO=date("Y-m-d",strtotime($DatumOdb));

    //izmjene u bazi
    $sql = "update prijavnica set
        rb_prijave='".$RbPrijave."',
        datum_prijave='".$DatumP."',    
        tema_pod='".$TemaPod."',
        odobrenje='".$Odobrenje."',
        datum_odb='".$DatumO."',
        id_kor=".$IdKor.",
        sif_svrhe=".$SifSvrhe.",
        napomena='".$Napomena."',
        addedby='".$AddedBy."'
        where id_prijave='".$_GET['id']."' LIMIT 1";

    $query = mysqli_query($link,$sql);
    
    if ($query){
        echo '<div>
            <div class="alert message-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-ok"></span> 
            <strong>Radnja je bila uspješna!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/prijavnica_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/prijavnica_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/prijavnica_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        }
    }
    ?>  
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Prijavnice za korištenje gradiva: izmjeni zapis</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-default-add">
                <div class="panel-body">
                    <form enctype="multipart/form-data" method="post" class="form-horizontal">
                        <fieldset>
                            <!-- RB prijave u godini -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="rb_prijave">RB prijave u godini:</label>
                                <div class="col-md-2">
                                <input id="rb_prijave" name="rb_prijave" type="text" value="<?php echo $RbPrijave;?>" placeholder="RB prijave u godini" class="form-control input-md" readonly=""><span class='asterisc'>*</span>
                                </div>
                            <!-- Datum prijave -->
                            <label class="col-md-2 control-label" for="datum_prijave">Datum:</label>
                                <div class="col-md-2">
                                    <input type=text id="datepicker" name="datum_prijave" value="<?php echo DATE("d.m.Y.",strtotime($DatumPrijave));?>" placeholder="Datum prijave" class="form-control input-md" required><span class="asterisc">*</span>
                                    <script>
                                          $( function() {
                                              $("#datepicker").datepicker($.datepicker.regional["hr"]);
                                              $("#datepicker").datepicker( "option", "changeMonth", true );
                                              $("#datepicker").datepicker( "option", "changeYear", true );
                                              $("#datepicker").datepicker( "option", "showAnim", "drop" );
                                              $("#datepicker").datepicker( "option", "showButtonPanel", true );
                                              $("#datepicker").datepicker();
                                          });
                                    </script>
                                </div>
                            </div>
                            <!-- Korisnik -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="id_kor">Prezime i ime korisnika:</label>
                                <div class="col-md-2">
                                <?php
                                $select = "SELECT * FROM korisnik order by prezime ASC";
                                $query = mysqli_query($link,$select);
                                echo "<select id='id_kor' name='id_kor' class='form-control' reguired>";
                                echo '<option selected value='.$IdKor.'>'.$Prezime.' '.$Ime.'</option>';
                                while($records = mysqli_fetch_array($query)){
                                    echo"<option value = '$records[id_kor]'>$records[prezime] $records[ime]</option>";
                                    }
                                    echo"</select><span class='asterisc'>*</span>";
                                    ?>
                                </div>
                            </div>
                            <!-- Tema i područje istraživanja -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="tema_pod">Tema ili područje istraživanja:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="tema_pod" name="tema_pod" placeholder="Tema ili područje istraživanja" required><?php echo $TemaPod;?></textarea><span class="asterisc">*</span>
                                </div>
                            </div>
                            <!-- Gradivo u prijavnici -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="gradivo">Fondovi/zbirke:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="gradivo" name="gradivo" readonly>NAPOMENA: Gradivo u prijavnici izmjenite klikom na "Gradivo - pregled detalja" na listi prijavnica!</textarea>
                                </div>
                            </div>
                            <!-- Svrha istraživanja -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="sif_svrhe">Svrha istraživanja:</label>
                                <div class="col-md-2">
                                <?php
                                $select = "SELECT * FROM svrha_ist order by naziv ASC";
                                $query = mysqli_query($link,$select);
                                echo "<select id='sif_svrhe' name='sif_svrhe' class='form-control' required>";
                                echo '<option selected value='.$SifSvrhe.'>'.$Naziv.'</option>';
                                while($records = mysqli_fetch_array($query)){
                                    echo"<option value = '$records[sif_svrhe]'>$records[naziv]</option>";
                                    }
                                    echo"</select><span class='asterisc'>*</span>";
                                    ?>
                                </div>
                            </div>
                            <!-- Napomena -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="napomena">Napomena:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="napomena" name="napomena" placeholder="Napomena"><?php echo $Napomena;?></textarea>
                                </div>
                            </div>
                            <!-- Odobrenje prijavnice -->
                            <div class = "col-md-10 col-md-offset-2">
                                <h4>Odobrenje prijavnice</h4>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="odobrenje">Odgovorna osoba:</label>
                                <div class="col-md-3">
                                    <input id="odobrenje" name="odobrenje" type="text" value="<?php echo $Odobrenje;?>" placeholder="Ime i prezime odgovorne osobe" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                                <label class="col-md-2 control-label" for="datum_od">Datum odobrenja:</label>
                                <div class="col-md-2">
                                    <input type=text id="datepicker2" name="datum_odb" value="<?php echo DATE("d.m.Y.",strtotime($DatumOdb));?>" placeholder="Datum odobrenja" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                    <script>
                                          $( function() {
                                              $("#datepicker2").datepicker($.datepicker.regional["hr"]);
                                              $("#datepicker2").datepicker( "option", "changeMonth", true );
                                              $("#datepicker2").datepicker( "option", "changeYear", true );
                                              $("#datepicker2").datepicker( "option", "showAnim", "drop" );
                                              $("#datepicker2").datepicker( "option", "showButtonPanel", true );
                                              $("#datepicker2").datepicker();
                                          });
                                    </script>
                                </div>
                            </div>
                            <!-- Kontrola zapisa -->
                            <div class = "col-md-10 col-md-offset-2">
                                <h4>Kontrola zapisa</h4>
                            </div>
                            <!-- Dodao zapis -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="addedby">Zapis kreiran:</label>  
                                <div class="col-md-3">
                                    <input id="addedby" name="addedby" type="text" class="form-control input-md" value="<?php echo "".$FirstName." ".$LastName.", ".date('d.m.Y.');?>" readonly>
                                </div>
                            </div>
                            <!-- Spremanje -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="submit"></label>
                                <div class="col-md-8">
                                    <button id="submit" name="submit" class="btn btn-primary" title="Izmjeni zapis">Izmjeni</button>
                                    <a href = "../public_html/prijavnica_list.php"><input type = "button" value = "Poništi" class="btn btn-default" title="Natrag na listu"></a>
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