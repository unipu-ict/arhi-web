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

        if (isset($_POST['submit'])){
        $Ptt = $_POST['ptt'];
        $Grad = $_POST['grad'];
        $Posta = $_POST['posta'];
        $AddedBy = $_POST['addedby'];
        $IdDrz = $_POST['id_drz'];

    //izmjene u bazi
    $sql = "update mjesto set
        ptt='".$Ptt."',
        grad='".$Grad."',
        posta='".$Posta."',
        addedby='".$AddedBy."',
        id_drz=".$IdDrz." 
        where id_grad='".$_GET['id']."' LIMIT 1";
     
    $query = mysqli_query($link,$sql);
    
    if ($query){
        echo '<div>
            <div class="alert message-successfull">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> ×</button>
            <span class="glyphicon glyphicon-ok"></span> 
            <strong>Radnja je bila uspješna!</strong>
            <hr class="message-inner-separator">
            <p><center><a href="../public_html/mjesto_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/mjesto_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
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
            <p><center><a href="../public_html/mjesto_list.php"><button type="button" class="btn btn-success">Natrag na listu</button></a></center></p>
            </div>
            </div>';
        exit();
        }
    }
    ?>
   <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Šifarnik - mjesta: izmjeni zapis</h2>
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
                                    <input id="grad" name="grad" type="text" value="<?php echo $Grad;?>" placeholder="Naziv mjesta" class="form-control input-md" required><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Poštanski broj -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="ptt">Poštanski broj:</label>
                                <div class="col-md-2">
                                    <input id="ptt" name="ptt" type="text" value="<?php echo $Ptt;?>" placeholder="Poštanski broj" class="form-control input-md" required><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Pošta -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="posta">Poštanski ured:</label>
                                <div class="col-md-3">
                                    <input id="posta" name="posta" type="text" value="<?php echo $Posta;?>" placeholder="Naziv poštanskog ureda" class="form-control input-md" required><span class='asterisc'>*</span>
                                </div>
                            </div>
                            <!-- Država -->
                            <div class="form-group">
                            <label class="col-md-2 control-label" for="id_drz">Država:</label>
                                <div class="col-md-2">
                                <?php
                                $select = "SELECT * FROM drzave order by naziv ASC";
                                $query = mysqli_query($link,$select);
                                echo "<select id='id_drz' name='id_drz' class='form-control' required>";
                                 echo '<option selected value='.$IdDrz.'>'.$Naziv.' ('.$SkrOznaka.')</option>';
                                while($records = mysqli_fetch_array($query)){
                                    echo"<option value = '$records[id_drz]'>$records[naziv] ($records[skr_oznaka])</option>";
                                    }
                                    echo"</select><span class='asterisc'>*</span>";
                                    ?>
                                </div>
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
                                    <a href = "../public_html/mjesto_list.php"><input type = "button" value = "Poništi" class="btn btn-default" title="Natrag na listu"></a>
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