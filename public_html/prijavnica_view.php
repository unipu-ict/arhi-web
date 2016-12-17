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
            $IdPrijave = "$records[id_prijave]";
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
    ?>  
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Prijavnice za korištenje gradiva: pregledaj zapis</h2>
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
                                <input id="rb_prijave" name="rb_prijave" type="text" value = "<?php echo $RbPrijave;?>" class="form-control input-md" readonly="">
                                </div>
                            <!-- Datum prijave -->
                            <label class="col-md-2 control-label" for="datum_prijave">Datum:</label>
                                <div class="col-md-2">
                                    <input type=text id="datepicker" name="datum_prijave" value="<?php echo DATE("d.m.Y.",strtotime($DatumPrijave));?>" class="form-control input-md" readonly="">
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
                            <!-- Tema i područje istraživanja -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="tema_pod">Tema ili područje istraživanja:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="tema_pod" name="tema_pod" readonly=""><?php echo $TemaPod;?></textarea>
                                </div>
                            </div>
                            
                            <!-- prikaz gradiva iz tablice prijavnica_fond -->
                            <?php
                            $sql = "SELECT * FROM prijavnica_fond WHERE prijavnica_fond.id_prijave='".$_GET['id']."' order by signatura, id_prifon, id_prijave ASC";
                            $query=mysqli_query($link,$sql);
                            echo
                            '<div class="form-group">
                                <label class="col-md-2 control-label" for="gradivo">Fondovi/zbirke:</label>
                                <div class="panel panel-view">
                                <table class="table grey"><tbody>'; 
                            while($records=mysqli_fetch_array($query)){
                            echo '<tr><td>'.$records['signatura'].', '.$records['naziv_fonda'].'</td></tr>';
                            }
                            ?>       
                            <?php
                            echo '</tbody></table></div></div>';    
                            ?>
                            
                            <!-- Svrha istraživanja -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="sif_svrhe">Svrha istraživanja:</label>
                                <div class="col-md-2">
                                <?php
                                echo "<select id='sif_svrhe' name='sif_svrhe' class='form-control' readonly>";
                                echo '<option selected value='.$SifSvrhe.'>'.$Naziv.'</option>';
                                    echo"</select>";
                                    ?>
                                </div>
                            </div>
                            <!-- Napomena -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="napomena">Napomena:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="napomena" name="napomena" readonly=""><?php echo $Napomena;?></textarea>
                                </div>
                            </div>
                            <!-- Odobrenje prijavnice -->
                            <div class = "col-md-10 col-md-offset-2">
                                <h4>Odobrenje prijavnice</h4>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="odobrenje">Odgovorna osoba:</label>
                                <div class="col-md-3">
                                    <input id="odobrenje" name="odobrenje" type="text" value = "<?php echo $Odobrenje;?>" class="form-control input-md" readonly="">
                                </div>
                                <label class="col-md-2 control-label" for="datum_od">Datum odobrenja:</label>
                                <div class="col-md-2">
                                    <input type=text id="datepicker2" name="datum_odb" value="<?php echo DATE("d.m.Y.",strtotime($DatumOdb));?>" class="form-control input-md" readonly="">
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
                                    <input id="addedby" name="addedby" type="text" class="form-control input-md" value="<?php echo $AddedBy?>" readonly>
                                </div>
                            </div>
                            <!-- Spremanje -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="submit"></label>
                                <div class="col-md-8">
                                    <a href = 'prijavnica_print.php?id=<?php echo $IdPrijave?>' target="_blank"><input type = "button" value = "Ispiši" class="btn btn-primary" title="Ispiši"></a>
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