<?php 
	include ('../include/menu.php');
        if ($_SESSION['id']==1){
?>
<title>ArhiWeb: Izvještaji - evidencija korisnika</title>
<div class="container-fluid">
    <div class = "row">	
        <div class ="col-md-4"><h2>Izvještaji - evidencija korisnika</h2></div>
    </div>
    <div class="col-md-12">
        <div class = "col-md-10"></div>
        <div class="col-md-2">
            <p class="text-right">
                <a href="korisnik_report_print.php" target="_blank"><button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ispiši izvještaj">Ispiši</button></a></p>
        </div>
    </div>
    <div class="container-fluid table-margin-list">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                        $sql=  "SELECT k.id_kor, k.broj_kor, k.god_prijave, k.prezime, k.ime, k.oib, 
                                k.oib_ust, k.jmbg, k.vrsta_osd, k.broj_osd, k.datum_rod, k.adresa_stalna, 
                                k.adresa_stalna, k.adresa_priv, k.telefon, k.gsm, k.gsm, k.fax, k.email, 
                                k.zvanje, k.zanimanje, k.ustanova, k.addedby, k.id_grad, k.mjesto_izdavanja, 
                                k.mjesto_rodenja, k.mjesto_priv, g.grad AS mjesto_sta, 
                                i.grad AS mjesto_izd, r.grad AS mjesto_rod, p.grad AS mjesto_privremeno,
                                g.ptt AS ptt_sta,p.ptt AS ptt_priv, g.posta AS posta_sta, p.ptt AS ptt_priv,
                                p.posta AS posta_priv
                                FROM korisnik k
                                LEFT OUTER JOIN mjesto g ON k.id_grad=g.id_grad
                                LEFT OUTER JOIN mjesto i ON k.mjesto_izdavanja=i.id_grad
                                LEFT OUTER JOIN mjesto r ON k.mjesto_rodenja=r.id_grad
                                LEFT OUTER JOIN mjesto p ON k.mjesto_priv=p.id_grad
                                order by broj_kor, god_prijave";
                        $query=mysqli_query($link,$sql);
                        ?>
                        <table id="korisnik-report" class="table table-hover">
                            <script>
                            $(document).ready( function () {
                                $('#korisnik-report').bdt();
                            });
                            </script>
                            <thead> 
                                <tr>
                                    <th width="3%">ID</th>
                                    <th width="6%">Godina</th>
                                    <th width="11%">Prezime i ime</th>
                                    <th width="18%">Stalna adresa</th>
                                    <th width="18%">Privremena adresa</th>
                                    <th width="18%">Mjesto i datum rođenja</th>
                                    <th width="26%">Zvanje, zanimanje i ustanova zaposlenja</th>
                                </tr>
                            </thead>
                                <?php
                                while($records=mysqli_fetch_array($query))
                                        {
                                    ?>
                            <tbody class="searchable">
                                <tr>
                                    <td>
                                        <?php echo $records['broj_kor'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $records['god_prijave'] ?> 
                                    </td>
                                    <td>
                                        <?php echo $records['prezime']." ".$records['ime'] ?>
                                    </td>
                                    <td>
                                        <?php echo $records['adresa_stalna'] ?></br>
                                        <?php echo $records['mjesto_sta']."</br>".$records['ptt_sta']." ".$records['posta_sta'].""?>
                                    </td>
                                    <td>
                                        <?php
                                        if(!empty($records['adresa_priv'].$records['mjesto_privremeno'].$records['ptt_priv'].$records['posta_priv'])){
                                        echo $records['adresa_priv'].'</br>'.$records['mjesto_privremeno']."</br>".$records['ptt_priv']." ".$records['posta_priv']."";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $records['mjesto_rod'].'</br>'.$date = DATE("d.m.Y.",strtotime($records['datum_rod'])); ?>
                                    </td>
                                    <td>
                                        <?php
                                        if(!empty($records['zvanje'].$records['zanimanje'].$records['ustanova'])){
                                        echo $records['zvanje'].'</br>'.$records['zanimanje'].'</br>'.$records['ustanova']; 
                                        }
                                        ?>
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