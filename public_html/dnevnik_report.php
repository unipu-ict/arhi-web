<?php 
	include ('../include/menu.php');
        if ($_SESSION['id']==1){
?>
<title>ArhiWeb: Izvještaji - dnevnik čitaonice</title>
<div class="container-fluid">
    <div class = "row">	
        <div class ="col-md-4"><h2>Izvještaji - dnevnik čitaonice</h2></div>
    </div>
    <div class="col-md-12">
        <div class = "col-md-10"></div>
        <div class="col-md-2">
            <p class="text-right">
                <a href="dnevnik_report_print.php" target="_blank"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ispiši izvještaj">Ispiši</button></a></p>
        </div>
    </div>
    <div class="container-fluid table-margin-list">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql="SELECT * FROM dnevnik, korisnik WHERE dnevnik.id_kor = korisnik.id_kor order by id_dne, rb_godina";
                        $query=mysqli_query($link,$sql);
                        ?>
                        <table id="dnevnik-report" class="table table-hover">
                            <script>
                            $(document).ready( function () {
                                $('#dnevnik-report').bdt();
                            });
                            </script>
                            <thead>
                                <tr>
                                    <th width="10%">RB u godini</th>
                                    <th width="10%">ID korisnika</th>
                                    <th width="15%">Prezime i ime</th>
                                    <th width="10%">Datum</th>
                                    <th width="10%">Ulazak</th>
                                    <th width="10%">Izlazak</th>
                                    <th width="35%">Napomena</th>
                                </tr>
                            </thead>
                                <?php
                                while($records=mysqli_fetch_array($query))
                                        {
                                    ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $records['rb_godina'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $records['id_kor'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $records['prezime']." ".$records['ime'] ?>
                                    </td>
                                    <td>
                                        <?php echo $date = DATE("d.m.Y.",strtotime($records['datum'])) ?>
                                    </td>
                                    <td>
                                        <?php echo $records['vrijeme_ul']?>
                                    </td>
                                    <td>
                                        <?php echo $records['vrijeme_izl']?>
                                    </td>
                                    <td>
                                        <?php echo $records['napomena']?>
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