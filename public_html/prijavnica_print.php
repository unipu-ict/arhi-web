<!--autor: Sebastijan Legović-->
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArhiWeb: Prijavnice</title>
    <link rel="shortcut icon" href="../img/favicon.ico">
    <link href="../css/style-print.css" rel="stylesheet">
    </head>
    <body>
	<div class="printing">
            <div>
                    <?php
			require("../include/dbconnection.php");
                        $link = mysqli_connect("localhost", "root", "", "citaonica");
			mysqli_query($link,'SET CHARACTER SET utf8');//hrvatski znakovi
                        $sql=  "SELECT p.id_prijave,p.rb_prijave,p.datum_prijave,p.tema_pod,p.odobrenje,p.datum_odb, 
                                s.sif_svrhe,s.naziv,k.id_kor,k.broj_kor,k.prezime,k.ime,p.napomena,p.addedby
                                FROM prijavnica p
                                LEFT OUTER JOIN korisnik k ON p.id_kor=k.id_kor
                                LEFT OUTER JOIN svrha_ist s ON p.sif_svrhe=s.sif_svrhe
                                WHERE id_prijave='".$_GET['id']."'";
                        
			$query=mysqli_query($link,$sql);
			$records=mysqli_fetch_array($query);
                        ?>
                    <table>
                        <tr>
                            <td rowspan="9" width='51%'>
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
                            <td class="bold" colspan="2">
                                <p class="p-title">EVIDENCIJA KORIŠTENJA ARHIVSKOG GRADIVA</p>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td width='30%'>
                                Identifikacijski broj korisnika:
                            </td>
                            <td class="border_right" width='19%' >
                                <?php echo $records['broj_kor']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td>
                                Broj prijave u tekućoj godini:
                            </td>
                            <td class="border_right">
                                <?php echo $records['rb_prijave']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="print-name" colspan="3">PRIJAVNICA ZA KORIŠTENJE GRADIVA</td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                </br>Prezime i ime korisnika:</br></br>
                            </td>
                            <td class="border_right" colspan="2">
                                <?php echo $records['prezime'].' '.$records['ime']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                <br>Tema i područje istraživanja:</br></br>
                            </td>
                            <td class='border_right' colspan="2">
                                <?php echo $records['tema_pod']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                <br>Svrha istraživanja:</br></br>
                            </td>
                            <td class='border_right' colspan="2">
                                <?php echo $records['naziv']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="bold" colspan="3">
                                <p class="p-title-center">KORISTIO/LA BIH SLIJEDEĆE GRADIVO:</p>
                            </td>
                        </tr>
                        <?php
			require("../include/dbconnection.php");
                        $link = mysqli_connect("localhost", "root", "", "citaonica");
			mysqli_query($link,'SET CHARACTER SET utf8');//hrvatski znakovi
                        $sql2=  "SELECT * FROM prijavnica_fond WHERE prijavnica_fond.id_prijave='".$_GET['id']."' order by signatura, id_prifon, id_prijave ASC";
			$query2=mysqli_query($link,$sql2);
                        while($records2=mysqli_fetch_array($query2))
                        {
                        ?>
                        <tr class="report">
                            <td class="border_right_nobold_grey" colspan="3">
                               <?php echo $records2['signatura'].', '.$records2['naziv_fonda'];?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td colspan="3">
                                <p class="p-title-center">ODOBRENJE KORIŠTENJA:</p>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Dana <?php echo $date = DATE("d.m.Y.",strtotime($records['datum_odb']));?> <b>odobreno</b> je korištenje arhivskog gradiva. Prijavnicu odobrio/la <i><?php echo $records['odobrenje'].'</i>.'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <p class="p-title-center"</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                            <td class="noborder">
                                Potpis korisnika arhivskog gradiva:
                            </td>
                        </tr>
                        <tr class="signature">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="signature">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td>
                                U Pazinu, <?php echo date("d.m.Y.");?>
                            </td>
                            <td class='signature'>
                            </td>
                        </tr>
                    </table>
                </div>
        </body>
</div>
<script>
window.print();
</script>