<?php 
	include ('../include/menu.php');
        if ($_SESSION['id']==1){ 
?>
<title>ArhiWeb: Izvještaji - evidencija korištenoga gradiva</title>
<div class="container-fluid">
    <div class = "row">	
        <div class ="col-md-6"><h2>Izvještaji - evidencija korištenoga gradiva</h2></div>
    </div>
    <div class="col-md-12">
        <div class = "col-md-10"></div>
        <div class="col-md-2">
            <p class="text-right">
                <a href="zahtjevnica_report_print.php" target="_blank"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ispiši izvještaj">Ispiši</button></a></p>
        </div>
    </div>
    <div class="container-fluid table-margin-list">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql="  SELECT z.id_zahtjeva,z.rb_zahtjeva,z.datum_zahtjeva,z.preslici,k.broj_kor,k.prezime,
                                k.ime,d.datum,d.vrijeme_ul,d.vrijeme_izl
                                FROM zahtjevnica z
                                LEFT OUTER JOIN korisnik k ON k.id_kor = z.id_kor
                                LEFT OUTER JOIN dnevnik d ON z.id_kor = d.id_kor AND z.datum_zahtjeva = d.datum
                                order by z.id_zahtjeva, rb_zahtjeva";
                        $query=mysqli_query($link,$sql);
                        ?>
                        <table id="zahtjevnica-list" class="table table-hover">
                            <script>
                            $(document).ready( function () {
                                $('#zahtjevnica-list').bdt();
                            });
                            </script>
                            <thead>
                                <tr>
                                    <th width="15%">Prezime i ime</th>
                                    <th width="8%">RB zahtjeva</th>
                                    <th width="10%">Datum zahtjeva</th>
                                    <th width="20%">Datum/vrijeme korištenja</th>
                                    <th width="37%">Signatura i naziv korištenoga gradiva</th>
                                    <th width="10%">Ukupno preslika</th>
                                </tr>
                            </thead>
                                <?php
                                while($records=mysqli_fetch_array($query))
                                        {
                                    ?>
                            <tbody>
                                <tr>
                                     <td>
                                        <?php echo $records['prezime']." ".$records['ime']." (ID:".$records['broj_kor'].")"?>
                                    </td>
                                    <td>
                                        <?php echo $records['rb_zahtjeva'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $date = DATE("d.m.Y.",strtotime($records['datum_zahtjeva'])) ?>
                                    </td>
                                    <td>
                                        <?php echo $date = DATE("d.m.Y.",strtotime($records['datum'])).' od '.$records['vrijeme_ul'].' do '.$records['vrijeme_izl'] ?> 
                                    </td>
                                    <td>
                                        <?php
                                        $sql2=  "SELECT * FROM zahtjevnica_arhjed WHERE zahtjevnica_arhjed.id_zahtjeva='".$records['id_zahtjeva']."' order by signatura, oznaka, id_zahtjeva ASC";
                                        $query2=mysqli_query($link,$sql2);
                                        while($records2=mysqli_fetch_array($query2))
                                        {
                                        ?>
                                        <?php echo $records2['signatura'].', '.$records2['oznaka'].'. '.$records2['naziv'];?><br/>
                                        <?php
                                        }
                                        ?> 
                                    </td>
                                    <td>
                                        <?php echo $records['preslici'] ?>
                                    </td>
                                   
                                        <?php
                                        
                                        }
                                        ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
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