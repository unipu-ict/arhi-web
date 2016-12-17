<?php 
	include ('../include/menu.php');
?>
    <title>ArhiWeb: Korisnici</title>
    <link href="../jquery-ui/jquery-ui.css" rel="stylesheet">
    <script src="../jquery-ui/jquery-1.10.2.js"></script>
    <script src="../jquery-ui/jquery-ui.js"></script>
    <script src="../jquery-ui/datepicker-hr.js"></script>

<div class="container-fluid">

<?php    
    
    $select =   "SELECT k.id_kor, k.broj_kor, k.god_prijave, k.prezime, k.ime, k.oib, 
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
            $IdKor = "$records[id_kor]";
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
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Korisnici: pregledaj zapis</h2>
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
                                    <input id="broj_kor" name="broj_kor" type="text" value = "<?php echo $BrojKor;?>" class="form-control input-md" readonly="">
                                </div>
                            </div>
                            <!-- Godina prijave -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="god_prijave">Godina prijave:</label>  
                                <div class="col-md-2">
                                    <?php
                                    $god_prijave = date("Y");
                                    echo "<input id='god_prijave' name='god_prijave' class='form-control' value='$god_prijave' readonly=''>";
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
                                    <input id="prezime" name="prezime" type="text" value="<?php echo $Prezime;?>" class="form-control input-md" readonly="">
                                </div>
                                <label class="col-md- control-label" for="ime"></label>
                                <div class="col-md-3">
                                    <input id="ime" name="ime" type="text" value="<?php echo $Ime;?>" class="form-control input-md" readonly="">
                                </div>
                            </div>
                            <!-- OIB i JMBG-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="oib">OIB:</label>
                                <div class="col-md-2">
                                    <input id="oib" name="oib" type="text" value="<?php echo $Oib;?>" class="form-control input-md" readonly="">
                                </div>
                                <label class="col-md-2 control-label" for="oib_ust">OIB ustanove:</label>
                                <div class="col-md-2">
                                    <input id="oib_ust" name="oib_ust" type="text" value="<?php echo $OibUst;?>" class="form-control input-md" readonly="">
                                </div>
                                <label class="col-md-2 control-label" for="jmbg">/ili/ JMBG:</label>
                                <div class="col-md-2">                     
                                    <input id="jmbg" name="jmbg" type="text" value="<?php echo $Jmbg;?>" class="form-control input-md" readonly="">
                                </div>
                            </div>
                            <!-- Osobni dokument -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="vrsta_osd">Osobni dokument:</label>
                                <div class="col-md-2">
                                    <select id="vrsta_osd" name="vrsta_osd" class="form-control" readonly="">
                                        <option selected value="<?php echo $VrstaOsd;?>"><?php echo $VrstaOsd;?></option>
                                    </select>
                                </div>
                                <label class="col-md-2 control-label" for="broj_osd">Broj:</label>
                                <div class="col-md-2">
                                    <input id="broj_osd" name="broj_osd" value="<?php echo $BrojOsd;?>" type="text" class="form-control input-md" readonly="">
                                </div>
                                <label class="col-md-2 control-label" for="mjesto_izdavanja">Mjesto izdavanja:</label>
                                <div class="col-md-2">
                                <?php
                                echo "<select id='mjesto_izdavanja' name='mjesto_izdavanja' class='form-control' readonly=''>";
                                echo '<option selected value='.$MjestoIzdavanja.'>'.$GradIzd.'</option>';
                                    echo"</select>";                                   
                                    ?>
                                </div>
                            </div>
                            <!-- Mjesto i datum rođenja -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="mjesto_rodenja">Mjesto rođenja:</label>
                                <div class="col-md-2">
                                <?php
                                echo "<select id='mjesto_rodenja' name='mjesto_rodenja' class='form-control' readonly=''>";
                                echo '<option selected value='.$MjestoRodenja.'>'.$GradRod.'</option>';
                                    echo"</select>";
                                    ?>
                                </div>
                                <label class="col-md-2 control-label" for="datum_rod">Datum rođenja:</label>  
                                <div class="col-md-2">
                                    <input type=text id="datepicker" name="datum_rod" value="<?php echo DATE("d.m.Y.",strtotime($DatumRod));?>" class="form-control input-md" readonly="">
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
                                    <input id="adresa_stalna" name="adresa_stalna" type="text" value="<?php echo $AdresaStalna;?>" class="form-control input-md" readonly="">
                                </div>
                                <label class="col-md-2 control-label" for="mjesto_stalno">Mjesto (stalno):</label>
                                <div class="col-md-2">   
                                <?php
                                echo "<select id='id_grad' name='id_grad' class='form-control' readonly=''>";
                                echo '<option selected value='.$IdGrad.'>'.$Grad.'</option>';
                                    echo"</select>";
                                    ?>
                                </div>
                            </div>
                             <!-- Adresa i mjesto privremenog boravišta -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="adresa_priv">/ili/ Adresa (privremena):</label>
                                <div class="col-md-3">
                                    <input id="adresa_priv" name="adresa_priv" type="text" value="<?php echo $AdresaPriv;?>" class="form-control input-md" readonly="">
                                </div>
                                <label class="col-md-2 control-label" for="mjesto_priv">Mjesto (privremeno):</label>
                                <div class="col-md-2">
                                <?php
                                echo "<select id='mjesto_priv' name='mjesto_priv' class='form-control' readonly=''>";
                                echo '<option selected value='.$MjestoPrivremeno.'>'.$GradPriv.'</option>';
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
                                    <input id="telefon" name="telefon" type="text" value="<?php echo $Telefon;?>" class="form-control input-md" readonly="">
                                </div>
                                <label class="col-md-2 control-label" for="gsm">Broj mobitela:</label>
                                <div class="col-md-3">
                                    <input id="gsm" name="gsm" type="text" value="<?php echo $Gsm;?>" class="form-control input-md" readonly="">
                                </div>
                            </div>
                            <!-- Faks i e-mail-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="fax">Broj faksa:</label>
                                <div class="col-md-3">                     
                                    <input id="fax" name="fax" type="text" value="<?php echo $Fax;?>" class="form-control input-md" readonly="">
                                </div>
                                <label class="col-md-2 control-label" for="email">E-mail adresa:</label>
                                <div class="col-md-3">                     
                                    <input id="email" name="email" type="text" value="<?php echo $Email;?>" class="form-control input-md" readonly="">
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
                                    <textarea class="form-control" id="zvanje" name="zvanje" value="<?php echo $Zvanje;?>" readonly=""><?php echo $Zvanje;?></textarea>
                                </div>
                            </div>
                            <!-- Zanimanje -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="zanimanje">Zanimanje:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="zanimanje" name="zanimanje" value="<?php echo $Zanimanje;?>" readonly=""><?php echo $Zanimanje;?></textarea>
                                </div>
                            </div>
                            <!-- Ustanova -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="ustanova">Ustanova:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="ustanova" name="ustanova" readonly=""><?php echo $Ustanova;?></textarea>
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
                                    <input id="addedby" name="addedby" type="text" class="form-control input-md" value="<?php echo $AddedBy?>" readonly>
                                </div>
                            </div>
                            <!-- Spremanje -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="submit"></label>
                                <div class="col-md-8">
                                    <a href='korisnik_print.php?id=<?php echo $IdKor?>' target="_blank"><input type = "button" value = "Ispiši" class="btn btn-primary" title="Ispiši"></a>
                                    <a href="korisnik_list_.php"><input type="button" value="Poništi" class="btn btn-default" title="Natrag na listu"></a>
                                </div>
                            </div>
                            </div>
            </div>
        </div>
    </div>
</div>
