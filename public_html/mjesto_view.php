<?php 
	include ('../include/menu.php');
        if ($_SESSION['id']==1){
?>
    <title>ArhiWeb: Šifarnik - mjesta</title>
    <link href="../jquery-ui/jquery-ui.css" rel="stylesheet">
    <script src="../jquery-ui/jquery-1.10.2.js"></script>
    <script src="../jquery-ui/jquery-ui.js"></script>

<div class="container-fluid">

<?php    
    
    $select = "select m.ptt,m.grad,m.posta,m.addedby,d.id_drz,d.naziv,d.skr_oznaka
               from mjesto m
               left outer join drzave d
               on m.id_drz=d.id_drz
               WHERE m.id_grad='".$_GET['id']."'";

    $query=mysqli_query($link,$select);
   
    if($query)
        {
        while($records = mysqli_fetch_array($query)){
            $Ptt = "$records[ptt]";
            $Grad = "$records[grad]";
            $Posta = "$records[posta]";
            $AddedBy = "$records[addedby]";
            $IdDrz = "$records[id_drz]";
            $Naziv = "$records[naziv]";
            $SkrOznaka = "$records[skr_oznaka]";
            }
        }
    ?>
   <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Šifarnik - mjesta: pregledaj zapis</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-default-add">
                <div class="panel-body">
                    <form enctype="multipart/form-data" method="post" class="form-horizontal">
                        <fieldset>
                            <!-- Mjesto -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="grad">Mjesto:</label>
                                <div class="col-md-3">
                                    <input id="grad" name="grad" type="text" value="<?php echo $Grad;?>" class="form-control input-md" readonly>
                                </div>
                            </div>
                            <!-- Poštanski broj -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="ptt">Poštanski broj:</label>
                                <div class="col-md-2">
                                    <input id="ptt" name="ptt" type="text" value="<?php echo $Ptt;?>" class="form-control input-md" readonly>
                                </div>
                            </div>
                            <!-- Pošta -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="posta">Poštanski ured:</label>
                                <div class="col-md-3">
                                    <input id="posta" name="posta" type="text" value="<?php echo $Posta;?>" class="form-control input-md" readonly>
                                </div>
                            </div>
                            <!-- Država -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="id_drz">Država:</label>
                                <div class="col-md-2">
                                <?php
                                echo "<select id='id_drz' name='id_drz' class='form-control' readonly>";
                                echo '<option selected value='.$IdDrz.'>'.$Naziv.' ('.$SkrOznaka.')</option>';
                                    echo"</select>";
                                    ?>
                                </div>
                            </div>
                            <!-- Dodao zapis -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="addedby">Zapis kreiran:</label>  
                                <div class="col-md-3">
                                    <input id="addedby" name="addedby" type="text" class="form-control input-md" value="<?php echo $AddedBy;?>" readonly>
                                </div>
                            </div>
                            <!-- Spremanje -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="submit"></label>
                                <div class="col-md-8">
                                     <a href="../public_html/mjesto_list.php"><input type = "button" class="btn btn-primary" value ="Natrag na listu" title="Natrag na listu"></a>
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