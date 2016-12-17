<?php 
	include ('../include/menu.php');
        if ($_SESSION['id']==1){
?>
    <title>ArhiWeb: Dnevnik čitaonice</title>
    <link href="../jquery-ui/jquery-ui.css" rel="stylesheet">
    <script src="../jquery-ui/jquery-1.10.2.js"></script>
    <script src="../jquery-ui/jquery-ui.js"></script>
    <script src="../jquery-ui/datepicker-hr.js"></script>

<div class="container-fluid">

<?php
    $select =   "select d.rb_godina,d.datum,d.vrijeme_ul,d.vrijeme_izl,
                 d.napomena,d.addedby,k.id_kor,k.broj_kor,k.ime,k.prezime
                 from dnevnik d
                 left outer join korisnik k
                 on d.id_kor=k.id_kor
                 WHERE d.id_dne='".$_GET['id']."'";

    $query=mysqli_query($link,$select);
   
    if($query)
        {
        while($records = mysqli_fetch_array($query)){
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

    if (isset($_POST['submit'])){
        $RbGodina = $_POST['rb_godina'];
        $Datum = $_POST['datum'];
        $VrijemeUlaska = $_POST['vrijeme_ul'];
        $VrijemeIzlaska = $_POST['vrijeme_izl'];
        $Napomena = $_POST['napomena'];
        $AddedBy = $_POST['addedby'];
        $IdKor = $_POST['id_kor'];
        
        //JQuery datepicker format za unos u mySQL bazu
        $Datum  = date("Y-m-d",strtotime($Datum));
    
    //izmjene u bazi
    $sql = "update dnevnik set
        rb_godina='".$RbGodina."',
        datum='".$Datum."',
        vrijeme_ul='".$VrijemeUlaska."',
        vrijeme_izl='".$VrijemeIzlaska."',
        napomena='".$Napomena."',
        addedby='".$AddedBy."',
        id_kor=".$IdKor."
        where id_dne='".$_GET['id']."' LIMIT 1";
     
    $query = mysqli_query($link,$sql);
    
    if ($query){
        echo '<div>
            <div class="alert message-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-ok"></span> 
            <strong>Radnja je bila uspješna!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/dnevnik_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        
    }else if (mysqli_errno($link) == 1062){
        echo '<div>
            <div class="alert message-not-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-remove"></span> 
            <strong>Greška! Zapis je već izmjenjen!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/dnevnik_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/dnevnik_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        }
    }
    ?>
   <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Dnevnik čitaonice: dodaj novi zapis</h2>
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
                                <input id="rb_godina" name="rb_godina" type="text" value = "<?php echo $RbGodina;?>" placeholder="RB u godini" class="form-control input-md" readonly=""><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Datum -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="datum">Datum:</label>
                                <div class="col-md-2">
                                    <input type=text id="datepicker" name="datum" value="<?php echo DATE("d.m.Y.",strtotime($Datum));?>" placeholder="Datum" class="form-control input-md" required><span class='asterisc'>*</span>
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
                            <!-- Prezime i ime korisnika -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="id_kor">Prezime i ime korisnika:</label>
                                <div class="col-md-2">
                                <?php
                                $select = "SELECT * FROM korisnik order by prezime ASC";
                                $query = mysqli_query($link,$select);
                                echo "<select id='id_kor' name='id_kor' class='form-control' reguired>";
                                echo '<option selected value='.$IdKor.'>'.$Prezime.' '.$Ime.'</option>';
                                while($records = mysqli_fetch_array($query)){
                                    echo"<option value='$records[id_kor]'>$records[prezime] $records[ime]</option>";
                                    }
                                    echo"</select><span class='asterisc'>*</span>";
                                    ?>
                                </div>
                            </div>
                            <!-- vrijeme ulaska -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="vrijeme_ul">Vrijeme ulaska:</label>
                                <div class="col-md-3">
                                    <input id="vrijeme_ul" name="vrijeme_ul" type="text" value="<?php echo $VrijemeUlaska;?>" placeholder="Vrijeme ulaska (format hh:mm)" class="form-control input-md" required><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Vrijeme izlaska -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="vrijeme_izl">Vrijeme izlaska:</label>
                                <div class="col-md-3">
                                    <input id="vrijeme_ul" name="vrijeme_izl" type="text" value="<?php echo $VrijemeIzlaska;?>" placeholder="Vrijeme izlaska (format hh:mm)" class="form-control input-md" required><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Napomena -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="napomena">Napomena:</label>
                                <div class="col-md-4">                     
                                    <textarea class="form-control" id="napomena" name="napomena" placeholder="Napomena"><?php echo $Napomena;?></textarea>
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
                                    <a href = "../public_html/dnevnik_list.php"><input type = "button" value = "Poništi" class="btn btn-default" title="Natrag na listu"></a>
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