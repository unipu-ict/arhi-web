<?php 
	include ('../include/menu.php');
        $id = $_GET['id'];
        if ($_SESSION['id']==1){
?>
<title>ArhiWeb: Prijavnice</title>
<div class="container-fluid">
    <div class="row">
        <div class ="col-md-6"><h2>Prijavnice za korištenje gradiva  - gradivo</h2></div>
    </div>
    <div class="row">
        <div class ="col-md-5"><h4>Prijavnica:</h4></div>
    </div>
    <div class="col-md-12">
        <div class = "col-md-10"></div>
        <div class="col-md-2">
            <p class="text-right">
                <a href="prijavnica_list.php"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Natrag na prijavnice">Natrag na prijavnice</button></a></p>
        </div>
    </div>
 <div class="container-fluid table-margin-list">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql="SELECT * FROM prijavnica, korisnik WHERE prijavnica.id_kor = korisnik.id_kor AND id_prijave='".$_GET['id']."'";
                        $query=mysqli_query($link,$sql);
                        ?>
                        <table id="prijavnica-list" class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="10%">RB prijave</th>
                                    <th width="10%">Datum prijave</th>
                                    <th width="10%">ID korisnika</th>
                                    <th width="20%">Prezime i ime</th>
                                    <th width="40%">Tema ili područje istraživanja</th>
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
                                        <?php echo $records['rb_prijave'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $date = DATE("d.m.Y.",strtotime($records['datum_prijave'])) ?>
                                    </td>
                                    <td>
                                        <?php echo $records['id_kor'] ?>
                                    </td>
                                    <td>
                                        <?php echo $records['prezime']." ".$records['ime'] ?>
                                    </td>
                                    <td>
                                        <?php echo $records['tema_pod']?>
                                    </td>
                                    <td>
                                        <a href='prijavnica_view.php?id=<?php echo $id?>' data-toggle="tooltip" data-placement="top" title="Pregledaj zapis"><span class="glyphicon glyphicon-list-alt font-mine"></span></a>
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
        <div class ="col-md-4"><h4>Korisnik će koristiti slijedeće gradivo:</h4></div>
    </div>
    <div class="col-md-12">
        <div class = "col-md-10"></div>
        <div class="col-md-2">
            <p class="text-right">
                <a href="prijavnica_fond_add.php?id=<?php echo $id?>"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Dodaj novi zapis">Dodaj novi</button></a></p>
        </div>
    </div>
    <div class="container-fluid table-margin-list">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql2="SELECT * FROM prijavnica p, prijavnica_fond pf WHERE p.id_prijave = pf.id_prijave AND pf.id_prijave='".$_GET['id']."' order by pf.signatura, pf.id_prifon, pf.id_prijave";
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
                                    <th width="70%">Naziv gradiva (fonda ili zbirke)</th>
                                    <th colspan=2 class="colspan-list"></th>
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
                                        <?php echo $records['naziv_fonda'] ?>
                                    </td>
                                    <td>
                                        <a href='prijavnica_fond_edit.php?id=<?php echo $records['id_prifon']?>' data-toggle="tooltip" data-placement="top" title="Izmjeni zapis"><span class="glyphicon glyphicon-edit font-mine"></span></a>
                                    </td>
                                    <td>
                                        <a href='prijavnica_fond_delete.php?id=<?php echo $records['id_prifon']?>' onclick="javascript:return confirm('Želite li izbrisati zapis?')" data-toggle="tooltip" data-placement="top" title="Izbriši zapis"><span class="glyphicon glyphicon-trash font-mine red"></span></a>
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