<?php 
	include ('../include/menu_.php');
        $id = $_GET['id'];
?>
<title>ArhiWeb: Zahtjevnice</title>
<div class="container-fluid">
    <div class="row">
        <div class ="col-md-6"><h2>Zahtjevnice za korištenje gradiva  - gradivo</h2></div>
    </div>
    <div class="row">
        <div class ="col-md-5"><h4>Zahtjevnica:</h4></div>
    </div>
    <div class="col-md-12">
        <div class = "col-md-10"></div>
        <div class="col-md-2">
            <p class="text-right">
                <a href="zahtjevnica_list_.php"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Natrag na zahtjevnice">Natrag na zahtjevnice</button></a></p>
        </div>
    </div>
 <div class="container-fluid table-margin-list">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql="SELECT * FROM zahtjevnica, korisnik WHERE zahtjevnica.id_kor = korisnik.id_kor AND id_zahtjeva='".$_GET['id']."'";
                        $query=mysqli_query($link,$sql);
                        ?>
                        <table id="prijavnica-list" class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="10%">RB zahtjeva</th>
                                    <th width="10%">Datum zahtjeva</th>
                                    <th width="10%">ID korisnika</th>
                                    <th width="20%">Prezime i ime</th>
                                    <th width="40%">Izrađeno preslika</th>
                                    <th colspan=1 class="colspan-list"></th>
                                </tr>
                            </thead>
                                <?php
                                while($records=mysqli_fetch_array($query))
                                        {
                                    ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $records['rb_zahtjeva'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $date = DATE("d.m.Y.",strtotime($records['datum_zahtjeva'])) ?>
                                    </td>
                                    <td>
                                        <?php echo $records['id_kor'] ?>
                                    </td>
                                    <td>
                                        <?php echo $records['prezime']." ".$records['ime'] ?>
                                    </td>
                                    <td>
                                        <?php echo $records['preslici']?>
                                    </td>
                                    <td>
                                        <a href='zahtjevnica_view_.php?id=<?php echo $id?>' data-toggle="tooltip" data-placement="top" title="Pregledaj zapis"><span class="glyphicon glyphicon-list-alt font-mine"></span></a>
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
<div class="container-fluid">
    <div class = "row">
        <div class ="col-md-4"><h4>Korisnik je koristio slijedeće gradivo:</h4></div>
    </div>
    <div class="col-md-12">
        <div class = "col-md-10"></div>
        <div class="col-md-2"></div>
    </div>
    <div class="container-fluid table-margin-list">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql2="SELECT * FROM zahtjevnica z, zahtjevnica_arhjed za WHERE z.id_zahtjeva = za.id_zahtjeva AND z.id_zahtjeva='".$_GET['id']."' order by za.signatura, za.id_zaharh, z.id_zahtjeva";
                        $query2=mysqli_query($link,$sql2);
                        ?>
                        <table id="gradivo" class="table table-hover">
                            <script>
                            $(document).ready( function () {
                                $('#gradivo').bdt();
                            });
                            </script>
                            <thead>
                                <tr>
                                    <th width="20%">Signatura</th>
                                    <th width="30%">Arhivska jedinica</th>
                                    <th width="20%">Tehnička jedinica</th>
                                    <th width="30%">Oblik korištenja</th>
                                </tr>
                            </thead>
                                <?php
                                while($records=mysqli_fetch_array($query2))
                                        {
                                    ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $records['signatura'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $records['oznaka'].'. '.$records['naziv'] ?>
                                    </td>
                                    <td>
                                        <?php echo $records['tehjed'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $records['oblik_kor'] ?> 
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