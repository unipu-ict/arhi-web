<?php 
	include ('../include/menu.php');
?>
    <title>ArhiWeb: Zahtjevnice</title>
    <link href="../jquery-ui/jquery-ui.css" rel="stylesheet">
    <script src="../jquery-ui/jquery-1.10.2.js"></script>
    <script src="../jquery-ui/jquery-ui.js"></script>
    <script src="../jquery-ui/datepicker-hr.js"></script>

<div class="container-fluid">

<?php
    $select =  "SELECT z.id_zahtjeva,z.rb_zahtjeva,z.datum_zahtjeva,z.preslici,z.addedby,k.id_kor,k.prezime,k.ime
                    FROM zahtjevnica z
                    LEFT OUTER JOIN korisnik k ON z.id_kor=k.id_kor
                    WHERE id_zahtjeva='".$_GET['id']."'";

        $query=mysqli_query($link,$select);

    if($query)
        {
        while($records = mysqli_fetch_array($query)){
            $IdZahtjeva = "$records[id_zahtjeva]";
            $RbZahtjeva = "$records[rb_zahtjeva]";
            $DatumZahtjeva = "$records[datum_zahtjeva]";
            $Preslici = "$records[preslici]";
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
                <h2>Zahtjevnice za korištenje gradiva: pregledaj zapis</h2>
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
                                    <input id="rb_zahtjeva" name="rb_zahtjeva" type="text" value = "<?php echo $RbZahtjeva;?>" class="form-control input-md" readonly="">
                                </div>
                            <!-- Datum zahtjeva -->
                            <label class="col-md-2 control-label" for="datum_zahtjeva">Datum:</label>
                                <div class="col-md-2">
                                    <input type=text id="datepicker" name="datum_zahtjeva" value="<?php echo DATE("d.m.Y.",strtotime($DatumZahtjeva));?>" class="form-control input-md" readonly="">
                                </div>
                            </div>
                            <!-- Korisnik -->
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
                            <!-- prikaz gradiva iz tablice zahtjevnica_arhjed -->
                            <?php
                            $sql = "SELECT * FROM zahtjevnica_arhjed WHERE zahtjevnica_arhjed.id_zahtjeva='".$_GET['id']."' order by signatura, id_zaharh, id_zahtjeva ASC";
                            $query=mysqli_query($link,$sql);
                            echo
                            '<div class="form-group">
                                <label class="col-md-2 control-label" for="gradivo">Predmet i način korištenja:</label>
                                <div class="panel panel-view2">
                                <table class="table grey"><tbody>
                                <tr>
                                    <th>Fond/zbirka</th>
                                    <th>Arhivska jedinica</th>
                                    <th>Tehnička jedinica</th>
                                    <th>Oblik korištenja</th>
                                </tr>';
                            while($records=mysqli_fetch_array($query)){
                            echo '<tr>
                                    <td>'.$records['signatura'].'</td>
                                    <td>'.$records['oznaka'].'. '.$records['naziv'].'</td>
                                    <td>'.$records['tehjed'].'</td> 
                                    <td>'.$records['oblik_kor'].'</td>    
                                    </tr>';
                            }
                            ?>       
                            <?php
                            echo '</tbody></table></div></div>';    
                            ?>
                            
                            <!-- Preslici -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="preslici">Izrađeno preslika:</label>
                                <div class="col-md-3">
                                    <input id="preslici" name="preslici" type="text" value="<?php echo $Preslici;?>" class="form-control input-md" readonly="">
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
                                    <a href = 'zahtjevnica_print.php?id=<?php echo $IdZahtjeva?>' target="_blank"><input type = "button" value = "Ispiši" class="btn btn-primary" title="Ispiši"></a>
                                    <a href = "../public_html/zahtjevnica_list_.php"><input type = "button" value = "Poništi" class="btn btn-default" title="Natrag na listu"></a>
                                </div>
                            </div>
                            </div>
            </div>
        </div>
    </div>
</div>