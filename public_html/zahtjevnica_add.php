<?php 
	include ('../include/menu.php');
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
    $RbZahtjeva = $_POST['rb_zahtjeva'];
    $DatumZahtjeva = $_POST['datum_zahtjeva'];
    $Preslici = $_POST['preslici'];
    $AddedBy = $_POST['addedby'];
    $IdKor = $_POST['id_kor'];
    
    //JQuery datepicker format za unos u mySQL bazu
    $DatumZahtjeva=date("Y-m-d",strtotime($DatumZahtjeva));

//unos u bazu
    $sql = "insert into zahtjevnica (rb_zahtjeva,datum_zahtjeva,preslici,addedby,id_kor)
        values ('$RbZahtjeva','$DatumZahtjeva','$Preslici','$AddedBy',$IdKor)";
    
    $query = mysqli_query($link,$sql);
    
    if ($query){
        echo '<div>
            <div class="alert message-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-ok"></span> 
            <strong>Radnja je bila uspješna!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/zahtjevnica_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/zahtjevnica_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/zahtjevnica_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        }
    }
    ?>  
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Zahtjevnice za korištenje gradiva: dodaj novi zapis</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-default-add">
                <div class="panel-body">
                    <form enctype="multipart/form-data" method="post" class="form-horizontal">
                        <fieldset>
                            <!-- RB zahtjeva u godini -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="rb_zahtjeva">RB zahtjeva u godini:</label>
                                <div class="col-md-2">
                                    <?php
                                    //Vučem iz baze rb u godini, povećavam ga za jedan i dodajem u input kao readonly
                                    $sql="select max(substr(rb_zahtjeva,1,3)) as mx from zahtjevnica where substr(rb_zahtjeva,5,4)=year(now()) order by mx";
                                    $query=mysqli_query($link,$sql);
                                    while($records=mysqli_fetch_array($query)){
                                    $str=date("Y");
                                    $str2=($records["mx"]+1);
                                    $str3=str_pad($str2, 3, 0, STR_PAD_LEFT)."/$str";
                                    }
                                    echo "<input id='rb_zahtjeva' name='rb_zahtjeva' class='form-control' value='$str3' readonly=''><span class='asterisc'>*</span>";
                                    ?>
                                </div>
                            <!-- Datum zahtjeva -->
                            <label class="col-md-2 control-label" for="datum_zahtjeva">Datum:</label>
                                <div class="col-md-2">
                                    <input type=text id="datepicker" name="datum_zahtjeva" placeholder="Datum zahtjeva" class="form-control input-md" required><span class="asterisc">*</span>
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
                                echo "<select id='id_kor' name='id_kor' class='form-control' required>";
                                echo '<option selected value=""></option>';
                                while($records = mysqli_fetch_array($query)){
                                    echo"<option value = '$records[id_kor]'>$records[prezime] $records[ime]</option>";
                                    }
                                    echo"</select><span class='asterisc'>*</span>";
                                    ?>
                                </div>
                            </div>
                            <!-- Gradivo u zahtjevnici -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="gradivo">Predmet i način korištenja:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="gradivo" name="gradivo" readonly>NAPOMENA: Korišteno gradivo u zahtjevnici unosite nakon što spremite ovaj zapis!</textarea>
                                </div>
                            </div>
                            <!-- Preslici -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="preslici">Izrađeno preslika:</label>
                                <div class="col-md-3">
                                    <input id="preslici" name="preslici" type="text" placeholder="Ukupno skeniranje i fotokopiranje" class="form-control input-md" required=""><span class='asterisc'>*</span>
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
                                    <a href = "../public_html/zahtjevnica_list.php"><input type = "button" value = "Poništi" class="btn btn-default" title="Natrag na listu"></a>
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