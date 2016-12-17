<!--autor: Sebastijan Legović-->
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArhiWeb: Zahtjevnice</title>
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
                        $sql=  "SELECT z.id_zahtjeva,z.rb_zahtjeva,z.datum_zahtjeva,z.preslici,z.addedby,k.id_kor,k.broj_kor,k.prezime,k.ime
                                FROM zahtjevnica z
                                LEFT OUTER JOIN korisnik k ON z.id_kor=k.id_kor
                                WHERE id_zahtjeva='".$_GET['id']."'";
                        
			$query=mysqli_query($link,$sql);
			$records=mysqli_fetch_array($query);
                        ?>
                    <table>
                        <tr>
                            <td rowspan="9" colspan="2" width='51%'>
                                <img src="../img/logo-dapa.png" alt="logo">
                            </td>
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
                                Broj zahtjeva u tekućoj godini:
                            </td>
                            <td class="border_right">
                                <?php echo $records['rb_zahtjeva']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td>
                                Datum korištenja:
                            </td>
                            <td class="border_right">
                                <?php echo $date = DATE("d.m.Y.",strtotime($records['datum_zahtjeva']));?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="print-name" colspan="4">ZAHTJEVNICA ZA KORIŠTENJE GRADIVA</td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2">
                                </br>Prezime i ime korisnika:</br></br>
                            </td>
                            <td class="border_right" colspan="2">
                                <?php echo $records['prezime'].' '.$records['ime']; ?>
                            </td>
                        </tr>
                        <tr class="noborder" colspan="2">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder" colspan="2">
                                </br>Ukupno izrađeno preslika (fotokopiranje/skeniranje):</br></br>
                            </td>
                            <td class="border_right" colspan="2">
                                <?php echo $records['preslici']; ?>
                            </td>
                        </tr>
                        <tr class="noborder" colspan="2">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="bold" colspan="4">
                                <p class="p-title-center">PREDMET I NAČIN KORIŠTENJA:</p>
                            </td>
                        </tr>
                        <tr class="noborder" colspan="2">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder" colspan="2">
                            <td class="noborder_empty"></td>
                        </tr>
                        
                        <?php
			require("../include/dbconnection.php");
                        $link = mysqli_connect("localhost", "root", "", "citaonica");
			mysqli_query($link,'SET CHARACTER SET utf8');//hrvatski znakovi
                        $sql2=  "SELECT * FROM zahtjevnica_arhjed WHERE zahtjevnica_arhjed.id_zahtjeva='".$_GET['id']."' order by signatura, oznaka, id_zahtjeva ASC";
			$query2=mysqli_query($link,$sql2);
                        echo'
                                <tr>
                                    <th class="border_right_nobold_grey">Fond/zbirka</th>
                                    <th class="border_right_nobold_grey">Oznaka, naziv i vrijeme arhivske jedinice</th>
                                    <th class="border_right_nobold_grey">Oznaka tehničke jedinice</th>
                                    <th class="border_right_nobold_grey">Oblik korištenja</th>
                                </tr>';
                        while($records2=mysqli_fetch_array($query2))
                        {
                        ?>
                        <tr class="report">
                            <td class="border_right_nobold_grey">
                               <?php echo $records2['signatura'];?>
                            </td>
                            <td class="border_right_nobold_grey">
                               <?php echo $records2['oznaka'].'. '.$records2['naziv'];?>
                            </td>
                            <td class="border_right_nobold_grey">
                               <?php echo $records2['tehjed'];?>
                            </td>
                            <td class="border_right_nobold_grey">
                               <?php echo $records2['oblik_kor'];?>
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
                        <tr>
                            <td colspan="4">
                                <p class="p-title-center"</p>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty" colspan="2"></td>
                            <td class="noborder" colspan="2">
                                Potpis korisnika arhivskog gradiva:
                            </td>
                        </tr>
                        <tr class="signature">
                            <td class="noborder_empty" colspan="2"></td>
                        </tr>
                        <tr class="signature">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
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