<?php 
	include ('../include/menu_.php');
?>
    <title>ArhiWeb: Dnevnik čitaonice</title>
    <link href="../jquery-ui/jquery-ui.css" rel="stylesheet">
    <script src="../jquery-ui/jquery-1.10.2.js"></script>
    <script src="../jquery-ui/jquery-ui.js"></script>
    <script src="../jquery-ui/datepicker-hr.js"></script>

<div class="container-fluid">

<?php    
    
    $select =   "SELECT d.id_dne,d.rb_godina,d.datum,d.vrijeme_ul,d.vrijeme_izl,
                 d.napomena,d.addedby,k.id_kor,k.broj_kor,k.ime,k.prezime
                 FROM dnevnik d
                 LEFT OUTER JOIN korisnik k
                 ON d.id_kor=k.id_kor
                 WHERE d.id_dne='".$_GET['id']."'";

    $query=mysqli_query($link,$select);
   
    if($query)
        {
        while($records = mysqli_fetch_array($query)){
            $IdDne = "$records[id_dne]";
            $RbGodina = "$records[rb_godina]";
            $Datum = "$records[datum]";
            $VrijemeUlaska = "$records[vrijeme_ul]";
            $VrijemeIzlaska = "$records[vrijeme_izl]";
            $Napomena = "$records[napomena]";
            $AddedBy = "$records[addedby]";
            $IdKor = "$records[id_kor]";
            $Prezime = "$records[prezime]";
            $Ime = "$records[ime]";
            }
        }    
    ?>
   
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Dnevnik čitaonice: pregledaj zapis</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-default-add">
                <div class="panel-body">
                    <form enctype="multipart/form-data" method="post" class="form-horizontal">
                        <fieldset>
                            <!-- RB u godini -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="rb_godina">RB u godini:</label>
                                <div class="col-md-2">
                                <input id="rb_godina" name="rb_godina" type="text" value = "<?php echo $RbGodina;?>" class="form-control input-md" readonly="">
                                </div>
                            </div>
                            <!-- Datum -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="datum">Datum:</label>
                                <div class="col-md-2">
                                    <input type=text id="datepicker" name="datum" value="<?php echo DATE("d.m.Y.",strtotime($Datum));?>" class="form-control input-md" readonly="">
                                </div>
                            </div>
                            <!-- Prezime i ime korisnika -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="id_kor">Prezime i ime korisnika:</label>
                                <div class="col-md-2">
                                <?php
                                echo "<select id='id_kor' name='id_kor' class='form-control' readonly=''>";
                                echo '<option selected value='.$IdKor.'>'.$Prezime.' '.$Ime.'</option>';
                                    echo"</select>";
                                    ?>
                                </div>
                            </div>
                            <!-- vrijeme ulaska -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="vrijeme_ul">Vrijeme ulaska:</label>
                                <div class="col-md-2">
                                    <input id="vrijeme_ul" name="vrijeme_ul" type="text" value="<?php echo $VrijemeUlaska;?>" class="form-control input-md" readonly="">
                                </div>
                            </div>
                            <!-- Vrijeme izlaska -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="vrijeme_izl">Vrijeme izlaska:</label>
                                <div class="col-md-2">
                                    <input id="vrijeme_ul" name="vrijeme_izl" type="text" value="<?php echo $VrijemeIzlaska;?>" class="form-control input-md" readonly="">
                                </div>
                            </div>
                            <!-- Napomena -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="napomena">Napomena:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="napomena" name="napomena" readonly=""><?php echo $Napomena;?></textarea>
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
                                    <input id="addedby" name="addedby" type="text" class="form-control input-md" value="<?php echo $AddedBy?>" readonly="">
                                </div>
                            </div>
                            <!-- Spremanje -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="submit"></label>
                                <div class="col-md-8">
                                    <a href = 'dnevnik_print.php?id=<?php echo $IdDne?>' target="_blank"><input type = "button" value = "Ispiši" class="btn btn-primary" title="Ispiši"></a>
                                    <a href = "../public_html/dnevnik_list_.php"><input type = "button" value = "Poništi" class="btn btn-default" title="Natrag na listu"></a>
                                </div>
                            </div>
                            </div>
            </div>
        </div>
    </div>
</div>
