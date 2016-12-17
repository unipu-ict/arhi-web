<?php 
	include ('../include/menu.php');
        if ($_SESSION['id']==1){
?>
<title>ArhiWeb: Šifarnik - države</title>
<div class="container-fluid">
    <div class = "row">
        <div class ="col-md-4"><h2>Šifarnik - države</h2></div>
    </div>
    <div class="col-md-12">
        <div class = "col-md-10"></div>
        <div class="col-md-2">
            <p class="text-right">
                <a href = "drzava_add.php"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Dodaj novi zapis">Dodaj novi</button></a></p>
        </div>
    </div>
    <div class="container-fluid table-margin-list">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql="SELECT * FROM drzave order by id_drz, naziv";
                        $query=mysqli_query($link,$sql);
                        ?>
                        <table id="drzava-list" class="table table-hover">
                            <script>
                            $(document).ready( function () {
                                $('#drzava-list').bdt();
                            });
                            </script>
                            <thead>
                                <tr>
                                    <th width="90%">Naziv</th>
                                    <th colspan=3 class="colspan-list"></th>
                                </tr>
                            </thead>
                                <?php
                                while($records=mysqli_fetch_array($query))
                                        {
                                    ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php echo $records['naziv']." (".$records['skr_oznaka'].")"?> 
                                    </td>
                                    <td>
                                        <a href='drzava_edit.php?id=<?php echo $records['id_drz']?>'data-toggle="tooltip" data-placement="top" title="Izmjeni zapis"><span class="glyphicon glyphicon-edit font-mine"</span></a>
                                    </td>
                                    <td>
                                        <a href='drzava_delete.php?id=<?php echo $records['id_drz']?>' onclick="javascript:return confirm('Želite li izbrisati zapis?')" data-toggle="tooltip" data-placement="top" title="Izbriši zapis"><span class="glyphicon glyphicon-trash font-mine red"></span></a>
                                    </td>
                                    <td>
                                        <a href='drzava_view.php?id=<?php echo $records['id_drz']?>' data-toggle="tooltip" data-placement="top" title="Pregledaj zapis"><span class="glyphicon glyphicon-list-alt font-mine"></span></a>
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