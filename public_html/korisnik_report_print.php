<!--autor: Sebastijan Legović-->
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArhiWeb: Izvještaji - evidencija korisnika</title>
    <link rel="shortcut icon" href="../img/favicon.ico">
    <link href="../css/style-print.css" rel="stylesheet">
    </head>
    <body>
	<div class="page">
            <div>
                        <?php
			require("../include/dbconnection.php");
                        $link = mysqli_connect("localhost", "root", "", "citaonica");
			mysqli_query($link,'SET CHARACTER SET utf8');//hrvatski znakovi
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
                        <table>
                            <tr>
                            <td width='51%' colspan="7">
                                <img src="../img/logo-dapa.png" alt="logo">
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="print-name" colspan="7">EVIDENCIJA KORISNIKA DRŽAVNOG ARHIVA U PAZINU</TD>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        </table>
                        <table>                      
                        <tr>
                            <thead>
                            <th class="border_right" width="3%">ID</th>
                            <th class="border_right" width="6%">Prijava</th>
                            <th class="border_right" width="10%">Prezime i ime</th>
                            <th class="border_right" width="20%">Stalna adresa</th>
                            <th class="border_right" width="20%">Privremena adresa</th>
                            <th class="border_right" width="10%">Mjesto i datum rođenja</th>
                            <th class="border_right" width="26%">Zvanje, zanimanje i ustanova zaposlenja</th>
                            </thead>
                        </tr>
                        
                            <?php
                                while($records=mysqli_fetch_array($query))
                                        {
                                    ?>
                                <tr class="report">
                                    <td class="border_right_nobold">
                                        <?php echo $records['broj_kor'] ?> 
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $records['god_prijave'] ?> 
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $records['prezime']."</br>".$records['ime'] ?>
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $records['adresa_stalna'] ?></br>
                                        <?php echo $records['mjesto_sta']."</br>".$records['ptt_sta']." ".$records['posta_sta'].""?>
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php
                                        if(!empty($records['adresa_priv'].$records['mjesto_privremeno'].$records['ptt_priv'].$records['posta_priv'])){
                                        echo $records['adresa_priv'].'</br>'.$records['mjesto_privremeno']."</br>".$records['ptt_priv']." ".$records['posta_priv']."";
                                        }
                                        ?>
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $records['mjesto_rod'].'</br>'.$date = DATE("d.m.Y.",strtotime($records['datum_rod'])); ?>
                                    </td>
                                    <td class="border_right_nobold">
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
        </body>
</div>    
<script>
window.print();
</script>



