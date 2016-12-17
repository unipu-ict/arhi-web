<?php 
	include ('../include/menu.php');
        if ($_SESSION['id']==1){
?>
    <title>ArhiWeb: Korisnici</title>
    <link href="../jquery-ui/jquery-ui.css" rel="stylesheet">
    <script src="../jquery-ui/jquery-1.10.2.js"></script>
    <script src="../jquery-ui/jquery-ui.js"></script>
    <script src="../jquery-ui/datepicker-hr.js"></script>

<div class="container-fluid">

<?php

if (isset($_POST['submit'])){
    $BrojKor = $_POST['broj_kor'];
    $GodPrijave = $_POST['god_prijave'];
    $Prezime = $_POST['prezime'];
    $Ime = $_POST['ime'];
    $Oib = $_POST['oib'];
    $OibUst = $_POST['oib_ust'];
    $Jmbg = $_POST['jmbg'];
    $VrstaOsd = $_POST['vrsta_osd'];
    $BrojOsd = $_POST['broj_osd'];
    $DatumRod = $_POST['datum_rod'];
    $AdresaStalna = $_POST['adresa_stalna'];
    $AdresaPriv = $_POST['adresa_priv'];
    $Telefon = $_POST['telefon'];
    $Gsm = $_POST['gsm'];
    $Fax = $_POST['fax'];	
    $Email = $_POST['email'];
    $Zvanje = $_POST['zvanje'];
    $Zanimanje = $_POST['zanimanje'];
    $Ustanova = $_POST['ustanova'];
    $AddedBy = $_POST['addedby'];
    $IdGrad = $_POST['id_grad'];
    $MjestoIzdavanja = $_POST['mjesto_izdavanja'];
    $MjestoRodenja = $_POST['mjesto_rodenja'];
    $MjestoPriv = $_POST['mjesto_priv'];
    
    //Unos NULL ako nije upisano mjesto izdavanja i/ili mjesto privremeno 
    $MjestoIzdavanja = !empty($MjestoIzdavanja) ? "'$MjestoIzdavanja'" : "NULL";
    $MjestoPriv = !empty($MjestoPriv) ? "'$MjestoPriv'" : "NULL";
    
    //JQuery datepicker format za unos u mySQL bazu
    $DatumRod  = date("Y-m-d",strtotime($DatumRod));
    
    //unos u bazu
    $sql = "insert into korisnik
        (broj_kor,god_prijave,prezime,ime,oib,oib_ust,jmbg,vrsta_osd,broj_osd,datum_rod,
        adresa_stalna,adresa_priv,telefon,gsm,fax,email,zvanje,zanimanje,ustanova,addedby,
        id_grad,mjesto_izdavanja,mjesto_rodenja,mjesto_priv)
        values ($BrojKor,$GodPrijave,'$Prezime','$Ime','$Oib','$OibUst','$Jmbg','$VrstaOsd','$BrojOsd','$DatumRod',"
            . "'$AdresaStalna','$AdresaPriv','$Telefon','$Gsm','$Fax','$Email','$Zvanje','$Zanimanje','$Ustanova',"
            . "'$AddedBy',$IdGrad,$MjestoIzdavanja,$MjestoRodenja,$MjestoPriv)";
    
    $query = mysqli_query($link,$sql);
    
    if ($query){
        echo '<div>
            <div class="alert message-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-ok"></span> 
            <strong>Radnja je bila uspješna!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/korisnik_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        
    }else if (mysqli_errno($link) == 1062){
        echo '<div>
            <div class="alert message-not-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-remove"></span> 
            <strong>Greška! Korisnik s ID-jem '.$BrojKor.' je već unesen!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/korisnik_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/korisnik_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        }
    }
    ?>  
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Korisnici: dodaj novi zapis</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-default-add">
                <div class="panel-body">
                    <form enctype="multipart/form-data" method="post" class="form-horizontal">
                        <fieldset>
                            <div class = "col-md-10 col-md-offset-2">
                                <h4>Podaci o prijavi</h4>
                            </div>
                            <!-- ID korisnika -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="broj_kor">ID korisnika:</label>
                                <div class="col-md-2">
                                    <?php
                                    //Vučem iz baze broj_kor, povećavam ga za jedan i dodajem u input kao readonly
                                    $sql="select max(broj_kor) as mx from korisnik order by mx";
                                    $query = mysqli_query($link,$sql);
                                    while($records=mysqli_fetch_array($query)){
                                    $str=($records['mx']+1);}
                                    echo "<input id='broj_kor' name='broj_kor' class='form-control' value='$str' readonly><span class='asterisc'>*</span>";
                                    ?>
                                </div>
                            </div>
                            <!-- Godina prijave -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="god_prijave">Godina prijave:</label>  
                                <div class="col-md-2">
                                    <?php
                                    //Prikaz trenutne godine u inputu, mogućnost izmjene/nije readonly
                                    $god_prijave = date("Y");
                                    echo "<input id='god_prijave' name='god_prijave' class='form-control' value='$god_prijave' required> <span class='asterisc'>*</span>";
                                    ?>
                                </div>    
                            </div>
                            <div class = "col-md-10 col-md-offset-2">
                                <h4>Osobni podaci</h4>
                            </div>
                            <!-- Prezime i ime -->
                            <div class="form-group" >
                                <label class="col-md-2 control-label" for="prezime">Prezime i ime:</label>  
                                <div class="col-md-3">
                                    <input id="prezime" name="prezime" type="text" placeholder="Prezime korisnika" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                                <label class="col-md- control-label" for="ime"></label>
                                <div class="col-md-3">
                                    <input id="ime" name="ime" type="text" placeholder="Ime korisnika" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- OIB i JMBG-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="oib">OIB:</label>
                                <div class="col-md-2">
                                    <input id="oib" name="oib" type="text" placeholder="OIB" class="form-control input-md">
                                </div>
                                <label class="col-md-2 control-label" for="oib_ust">OIB ustanove:</label>
                                <div class="col-md-2">
                                    <input id="oib_ust" name="oib_ust" type="text" placeholder="OIB ustanove" class="form-control input-md">
                                </div>
                                <label class="col-md-2 control-label" for="jmbg">/ili/ JMBG:</label>
                                <div class="col-md-2">                     
                                    <input id="jmbg" name="jmbg" type="text" placeholder="JMBG" class="form-control input-md">
                                </div>
                            </div>
                            <!-- Osobni dokument -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="vrsta_osd">Osobni dokument:</label>
                                <div class="col-md-2">
                                    <select id="vrsta_osd" name="vrsta_osd" class="form-control">
                                        <option selected value=""></option>
                                        <option>Osobna iskaznica</option>
                                        <option>Putovnica</option>
                                        <option>Vozačka dozvola</option>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="broj_osd">Broj:</label>
                                <div class="col-md-2">
                                    <input id="broj_osd" name="broj_osd" type="text" placeholder="Broj osobnog dokumenta" class="form-control input-md">
                                </div>
                                <label class="col-md-2 control-label" for="mjesto_izdavanja">Mjesto izdavanja:</label>
                                <div class="col-md-2">
                                <?php
                                $select = "SELECT * FROM mjesto order by grad ASC";
                                $query = mysqli_query($link,$select);
                                echo "<select id='mjesto_izdavanja' name='mjesto_izdavanja' class='form-control'>";
                                echo '<option selected value=""></option>';
                                while($records = mysqli_fetch_array($query)){
                                    echo"<option value = '$records[id_grad]'>$records[grad]</option>";
                                    }
                                    echo"</select>";
                                    ?>
                                </div>
                            </div>
                            <!-- Mjesto i datum rođenja -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="mjesto_rodenja">Mjesto rođenja:</label>
                                <div class="col-md-2">
                                <?php
                                $select = "SELECT * FROM mjesto order by grad ASC";
                                $query = mysqli_query($link,$select);
                                echo "<select id='mjesto_rodenja' name='mjesto_rodenja' class='form-control' reguired>";
                                echo '<option selected value=""></option>';
                                while($records = mysqli_fetch_array($query)){
                                    echo"<option value = '$records[id_grad]'>$records[grad]</option>";
                                    }
                                    echo"</select><span class='asterisc'>*</span>";
                                    ?>
                                </div>
                                <label class="col-md-2 control-label" for="datum_rod">Datum rođenja:</label>  
                                <div class="col-md-2">
                                    <input type=text id="datepicker" name="datum_rod" placeholder="Datum rođenja" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                    <script>
                                          $( function() {
                                              $("#datepicker").datepicker($.datepicker.regional["hr"]);
                                              $("#datepicker").datepicker( "option", "changeMonth", true );
                                              $("#datepicker").datepicker( "option", "changeYear", true );
                                              $("#datepicker").datepicker( "option", "showAnim", "drop" );
                                              $("#datepicker").datepicker( "option", "showButtonPanel", true );
                                              $("#datepicker").datepicker();
                                          } );
                                    </script>
                                </div>
                            </div>
                            <!-- Kontakt -->
                            <div class = "col-md-10 col-md-offset-2">
                                <h4>Podaci o stanovanju</h4>
                            </div>
                            <!-- Adresa i mjesto stalnog boravišta -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="adresa_stalna">Adresa (stalna):</label>  
                                <div class="col-md-3">
                                    <input id="adresa_stalna" name="adresa_stalna" type="text" placeholder="Adresa stalnog boravišta" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                                <label class="col-md-2 control-label" for="mjesto_stalno">Mjesto (stalno):</label>
                                <div class="col-md-2">
                                <?php
                                $select = "SELECT * FROM mjesto order by grad ASC";
                                $query = mysqli_query($link,$select);
                                echo "<select id='id_grad' name='id_grad' class='form-control' required=''>";
                                
                                while($records = mysqli_fetch_array($query)){
                                    echo"<option value = '$records[id_grad]'>$records[grad]</option>";
                                    }
                                    echo"</select><span class='asterisc'>*</span>";
                                    ?>
                                </div>
                            </div>
                             <!-- Adresa i mjesto privremenog boravišta -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="adresa_priv">/ili/ Adresa (privremena):</label>
                                <div class="col-md-3">
                                    <input id="adresa_priv" name="adresa_priv" type="text" placeholder="Adresa privremenog boravišta" class="form-control input-md">
                                </div>
                                <label class="col-md-2 control-label" for="mjesto_priv">Mjesto (privremeno):</label>
                                <div class="col-md-2">
                                <?php
                                $select = "SELECT * FROM mjesto order by grad ASC";
                                $query = mysqli_query($link,$select);
                                echo "<select id='mjesto_priv' name='mjesto_priv' class='form-control'>";
                                echo '<option selected value=""></option>';
                                while($records = mysqli_fetch_array($query)){
                                    echo"<option value = '$records[id_grad]'>$records[grad]</option>";
                                    }
                                    echo"</select>";
                                    ?>
                                </div>
                            </div>
                            <!-- Kontakt podaci --> 
                            <div class = "col-md-10 col-md-offset-2">
                                <h4>Kontakt podaci</h4>
                            </div>
                            <!-- Telefon i mobitel -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="telefon">Broj telefona:</label>
                                <div class="col-md-3">
                                    <input id="telefon" name="telefon" type="text" placeholder="Broj telefona (format xxx/xxx-xxx)" class="form-control input-md">
                                </div>
                                <label class="col-md-2 control-label" for="gsm">Broj mobitela:</label>
                                <div class="col-md-3">
                                    <input id="gsm" name="gsm" type="text" placeholder="Broj mobitela (format xxx/xxxx-xxx)" class="form-control input-md">
                                </div>
                            </div>
                            <!-- Faks i e-mail-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="fax">Broj faksa:</label>
                                <div class="col-md-3">                     
                                    <input id="fax" name="fax" type="text" placeholder="Broj faksa (format xxx/xxx-xxx)" class="form-control input-md">
                                </div>
                                <label class="col-md-2 control-label" for="email">E-mail adresa:</label>
                                <div class="col-md-3">                     
                                    <input id="email" name="email" type="text" placeholder="E-mail adresa" class="form-control input-md">
                                </div>
                            </div>
                            <!-- Podaci o zaposlenju -->
                            <div class = "col-md-10 col-md-offset-2">
                                <h4>Podaci o školovanju i zaposlenju</h4>
                            </div>
                            <!-- Zvanje -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="zvanje">Zvanje:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="zvanje" name="zvanje" placeholder="Zvanje"></textarea>
                                </div>
                            </div>
                            <!-- Zanimanje -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="zanimanje">Zanimanje:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="zanimanje" name="zanimanje" placeholder="Zanimanje"></textarea>
                                </div>
                            </div>
                            <!-- Ustanova -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="ustanova">Ustanova:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="ustanova" name="ustanova" placeholder="Ustanova zaposlenja"></textarea>
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
                                    <button id="submit" name="submit" class="btn btn-primary" title="Spremi zapis">Spremi</button>
                                    <a href = "../public_html/korisnik_list.php"><input type = "button" value = "Poništi" class="btn btn-default" title="Natrag na listu"></a>
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