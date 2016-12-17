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

    $select =   "SELECT k.broj_kor, k.god_prijave, k.prezime, k.ime, k.oib, 
                k.oib_ust, k.jmbg, k.vrsta_osd, k.broj_osd, k.datum_rod, k.adresa_stalna, 
                k.adresa_stalna, k.adresa_priv, k.telefon, k.gsm, k.gsm, k.fax, k.email, 
                k.zvanje, k.zanimanje, k.ustanova, k.addedby, k.id_grad, k.mjesto_izdavanja, 
                k.mjesto_rodenja, k.mjesto_priv, g.grad AS mjesto_sta, 
                i.grad AS mjesto_izd, r.grad AS mjesto_rod, p.grad AS mjesto_privremeno FROM korisnik k
                LEFT OUTER JOIN mjesto g ON k.id_grad=g.id_grad
                LEFT OUTER JOIN mjesto i ON k.mjesto_izdavanja=i.id_grad
                LEFT OUTER JOIN mjesto r ON k.mjesto_rodenja=r.id_grad
                LEFT OUTER JOIN mjesto p ON k.mjesto_priv=p.id_grad
                WHERE k.id_kor='".$_GET['id']."'";

    $query=mysqli_query($link,$select);
   
    if($query)
        {
        while($records = mysqli_fetch_array($query)){
            $BrojKor = "$records[broj_kor]";
            $GodPrijave = "$records[god_prijave]";
            $Prezime = "$records[prezime]";
            $Ime = "$records[ime]";
            $Oib = "$records[oib]";
            $OibUst = "$records[oib_ust]";
            $Jmbg = "$records[jmbg]";
            $VrstaOsd = "$records[vrsta_osd]";
            $BrojOsd = "$records[broj_osd]";
            $DatumRod = "$records[datum_rod]";
            $AdresaStalna = "$records[adresa_stalna]";
            $AdresaPriv = "$records[adresa_priv]";
            $Telefon = "$records[telefon]";
            $Gsm = "$records[gsm]";
            $Fax = "$records[fax]";	
            $Email = "$records[email]";
            $Zvanje = "$records[zvanje]";
            $Zanimanje = "$records[zanimanje]";
            $Ustanova = "$records[ustanova]";
            $AddedBy = "$records[addedby]";
            $IdGrad = "$records[id_grad]";
            $MjestoIzdavanja = "$records[mjesto_izdavanja]";
            $MjestoRodenja = "$records[mjesto_rodenja]";
            $MjestoPrivremeno = "$records[mjesto_priv]";
            $Grad="$records[mjesto_sta]";
            $GradIzd="$records[mjesto_izd]";
            $GradRod="$records[mjesto_rod]";
            $GradPriv="$records[mjesto_privremeno]";
            }
        }    

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
        $MjestoPrivremeno = $_POST['mjesto_priv'];
        
        //Unos NULL ako nije upisano mjesto izdavanja i/ili mjesto privremeno 
        $MjestoIzdav = !empty($MjestoIzdavanja) ? "'$MjestoIzdavanja'" : "NULL";
        $MjestoPrivr = !empty($MjestoPrivremeno) ? "'$MjestoPrivremeno'" : "NULL";
        //JQuery datepicker format za unos u mySQL bazu
        $DatumRodenja  = date("Y-m-d",strtotime($DatumRod));
    
    //izmjene u bazi
    $sql = "update korisnik set
        broj_kor=".$BrojKor.",
        god_prijave=".$GodPrijave.",
        prezime='".$Prezime."',
        ime='".$Ime."',
        oib='".$Oib."',
        oib_ust='".$OibUst."',
        jmbg='".$Jmbg."',
        vrsta_osd='".$VrstaOsd."',
        broj_osd='".$BrojOsd."',
        datum_rod='".$DatumRodenja."',
        adresa_stalna='".$AdresaStalna."',
        adresa_priv='".$AdresaPriv."',
        telefon='".$Telefon."',
        gsm='".$Gsm."',
        fax='".$Fax."',
        email='".$Email."',
        zvanje='".$Zvanje."',
        zanimanje='".$Zanimanje."',
        ustanova='".$Ustanova."',
        addedby='".$AddedBy."',
        id_grad=".$IdGrad.",
        mjesto_izdavanja=".$MjestoIzdav.",
        mjesto_rodenja=".$MjestoRodenja.",
        mjesto_priv=".$MjestoPrivr."
        where id_kor='".$_GET['id']."' LIMIT 1";
     
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
            <strong>Greška! Korisnik s ID-jem '.$BrojKor.' je već izmjenjen!</strong>
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
                <h2>Korisnici: izmjeni zapis</h2>
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
                                   <input id="broj_kor" name="broj_kor" type="text" value = "<?php echo $BrojKor;?>" placeholder="ID korisnika" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Godina prijave -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="god_prijave">Godina prijave:</label>  
                                <div class="col-md-2">
                                    <?php
                                    //Prikaz trenutne godine u inputu, mogućnost izmjene/nije readonly
                                    $god_prijave = date("Y");
                                    echo "<input id='god_prijave' name='god_prijave' class='form-control' value='$god_prijave' required><span class='asterisc'>*</span>";
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
                                    <input id="prezime" name="prezime" type="text" value="<?php echo $Prezime;?>" placeholder="Prezime korisnika" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                                <label class="col-md- control-label" for="ime"></label>
                                <div class="col-md-3">
                                    <input id="ime" name="ime" type="text" value="<?php echo $Ime;?>" placeholder="Ime korisnika" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- OIB i JMBG-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="oib">OIB:</label>
                                <div class="col-md-2">
                                    <input id="oib" name="oib" type="text" value="<?php echo $Oib;?>" placeholder="OIB" class="form-control input-md">
                                </div>
                                <label class="col-md-2 control-label" for="oib_ust">OIB ustanove:</label>
                                <div class="col-md-2">
                                    <input id="oib_ust" name="oib_ust" type="text" value="<?php echo $OibUst;?>" placeholder="OIB ustanove" class="form-control input-md">
                                </div>
                                <label class="col-md-2 control-label" for="jmbg">/ili/ JMBG:</label>
                                <div class="col-md-2">                     
                                    <input id="jmbg" name="jmbg" type="text" value="<?php echo $Jmbg;?>" placeholder="JMBG" class="form-control input-md">
                                </div>
                            </div>
                            <!-- Osobni dokument -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="vrsta_osd">Osobni dokument:</label>
                                <div class="col-md-2">
                                    <select id="vrsta_osd" name="vrsta_osd" class="form-control">
                                        <option selected value="<?php echo $VrstaOsd;?>"><?php echo $VrstaOsd;?></option>
                                        <option value="Osobna iskaznica">Osobna iskaznica</option>
                                        <option value="Putovnica">Putovnica</option>
                                        <option value="Vozačka dozvola">Vozačka dozvola</option>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="broj_osd">Broj:</label>
                                <div class="col-md-2">
                                    <input id="broj_osd" name="broj_osd" value="<?php echo $BrojOsd;?>" type="text" placeholder="Broj osobnog dokumenta" class="form-control input-md">
                                </div>
                                <label class="col-md-2 control-label" for="mjesto_izdavanja">Mjesto izdavanja:</label>
                                <div class="col-md-2">
                                <?php
                                $select = "SELECT * FROM mjesto order by grad ASC";
                                $query = mysqli_query($link,$select);
                                echo "<select id='mjesto_izdavanja' name='mjesto_izdavanja' class='form-control'>";
                                echo '<option selected value='.$MjestoIzdavanja.'>'.$GradIzd.'</option>';
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
                                echo "<select id='mjesto_rodenja' name='mjesto_rodenja' class='form-control' required>";
                                echo '<option selected value='.$MjestoRodenja.'>'.$GradRod.'</option>';
                                while($records = mysqli_fetch_array($query)){
                                    echo"<option value = '$records[id_grad]'>$records[grad]</option>";
                                    }
                                    echo"</select><span class='asterisc'>*</span>";
                                    ?>
                                </div>
                                <label class="col-md-2 control-label" for="datum_rod">Datum rođenja:</label>  
                                <div class="col-md-2">
                                    <input type=text id="datepicker" name="datum_rod" value="<?php echo DATE("d.m.Y.",strtotime($DatumRod));?>" placeholder="Datum rođenja" class="form-control input-md" required=""><span class='asterisc'>*</span>
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
                                    <input id="adresa_stalna" name="adresa_stalna" type="text" value="<?php echo $AdresaStalna;?>" placeholder="Adresa stalnog boravišta" class="form-control input-md" required=""><span class='asterisc'>*</span>
                                </div>
                                <label class="col-md-2 control-label" for="mjesto_stalno">Mjesto (stalno):</label>
                                <div class="col-md-2">   
                                <?php
                                $select = "SELECT * FROM mjesto order by grad ASC";
                                $query = mysqli_query($link,$select);
                                echo "<select id='id_grad' name='id_grad' class='form-control' required=''>";
                                echo '<option selected value='.$IdGrad.'>'.$Grad.'</option>';
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
                                    <input id="adresa_priv" name="adresa_priv" type="text" value="<?php echo $AdresaPriv;?>" placeholder="Adresa privremenog boravišta" class="form-control input-md">
                                </div>
                                <label class="col-md-2 control-label" for="mjesto_priv">Mjesto (privremeno):</label>
                                <div class="col-md-2">
                                <?php
                                $select = "SELECT * FROM mjesto order by grad ASC";
                                $query = mysqli_query($link,$select);
                                echo "<select id='mjesto_priv' name='mjesto_priv' class='form-control'>";
                                echo '<option selected value='.$MjestoPrivremeno.'>'.$GradPriv.'</option>';
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
                                    <input id="telefon" name="telefon" type="text" value="<?php echo $Telefon;?>" placeholder="Broj telefona (format xxx/xxx-xxx)" class="form-control input-md">
                                </div>
                                <label class="col-md-2 control-label" for="gsm">Broj mobitela:</label>
                                <div class="col-md-3">
                                    <input id="gsm" name="gsm" type="text" value="<?php echo $Gsm;?>" placeholder="Broj mobitela (format xxx/xxxx-xxx)" class="form-control input-md">
                                </div>
                            </div>
                            <!-- Faks i e-mail-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="fax">Broj faksa:</label>
                                <div class="col-md-3">                     
                                    <input id="fax" name="fax" type="text" value="<?php echo $Fax;?>" placeholder="Broj faksa (format xxx/xxx-xxx)" class="form-control input-md">
                                </div>
                                <label class="col-md-2 control-label" for="email">E-mail adresa:</label>
                                <div class="col-md-3">                     
                                    <input id="email" name="email" type="text" value="<?php echo $Email;?>" placeholder="E-mail adresa" class="form-control input-md">
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
                                    <textarea class="form-control" id="zvanje" name="zvanje" value="<?php echo $Zvanje;?>" placeholder="Zvanje"><?php echo $Zvanje;?></textarea>
                                </div>
                            </div>
                            <!-- Zanimanje -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="zanimanje">Zanimanje:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="zanimanje" name="zanimanje" value="<?php echo $Zanimanje;?>" placeholder="Zanimanje"><?php echo $Zanimanje;?></textarea>
                                </div>
                            </div>
                            <!-- Ustanova -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="ustanova">Ustanova:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="ustanova" name="ustanova" placeholder="Ustanova zaposlenja"><?php echo $Ustanova;?></textarea>
                                </div>
                            </div>
                            <!-- Kontrola zapisa -->
                            <div class = "col-md-10 col-md-offset-2">
                                <h4>Kontrola zapisa</h4>
                            </div>
                            <!-- Dodao zapis -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="addedby">Zapis izmjenjen:</label>  
                                <div class="col-md-3">
                                    <input id="addedby" name="addedby" type="text" class="form-control input-md" value="<?php echo "".$FirstName." ".$LastName.", ".date('d.m.Y.');?>" readonly>
                                </div>
                            </div>
                            <!-- Spremanje -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="submit"></label>
                                <div class="col-md-8">
                                    <button id="submit" name="submit" class="btn btn-primary" title="Izmjeni zapis">Izmjeni</button>
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