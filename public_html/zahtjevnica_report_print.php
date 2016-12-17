<!--autor: Sebastijan Legović-->
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArhiWeb: Izvještaji - evidencija korištenoga gradiva</title>
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
                        $sql="  SELECT z.id_zahtjeva,z.rb_zahtjeva,z.datum_zahtjeva,z.preslici,k.broj_kor,k.prezime,
                                k.ime,d.datum,d.vrijeme_ul,d.vrijeme_izl
                                FROM zahtjevnica z
                                LEFT OUTER JOIN korisnik k ON k.id_kor = z.id_kor
                                LEFT OUTER JOIN dnevnik d ON z.id_kor = d.id_kor AND z.datum_zahtjeva = d.datum
                                order by z.id_zahtjeva, rb_zahtjeva";
			$query=mysqli_query($link,$sql);
                        ?>
                        <table>
                        <tr>
                            <td width='51%' colspan="8">
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
                            <td class="print-name" colspan="8">EVIDENCIJA KORIŠTENOGA GRADIVA DRŽAVNOG ARHIVA U PAZINU</TD>
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
                            <th class="border_right" width="15%">Prezime i ime</th>
                            <th class="border_right" width="10%">RB zahtjeva</th>
                            <th class="border_right" width="10%">Datum zahtjeva</th>
                            <th class="border_right" width="15%">Datum/vrijeme korištenja</th>
                            <th class="border_right" width="40%">Signatura i naziv korištenoga gradiva</th>
                            <th class="border_right" width="10%">Ukupno preslika</th>
                        </thead>
                        </tr>
                        <tbody>
                            <?php
                                while($records=mysqli_fetch_array($query))
                                        {
                                    ?>
                                <tr class="report">
                                    <td class="border_right_nobold">
                                         <?php echo $records['prezime']." ".$records['ime']." (ID:".$records['broj_kor'].")"?>
                                    </td>
                                    <td class="border_right_nobold">
                                         <?php echo $records['rb_zahtjeva'] ?>
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $date = DATE("d.m.Y.",strtotime($records['datum_zahtjeva'])) ?>
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $date = DATE("d.m.Y.",strtotime($records['datum'])).' od '.$records['vrijeme_ul'].' do '.$records['vrijeme_izl'] ?> 
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php
                                        $sql2=  "SELECT * FROM zahtjevnica_arhjed WHERE zahtjevnica_arhjed.id_zahtjeva='".$records['id_zahtjeva']."' order by signatura, oznaka, id_zahtjeva ASC";
                                        $query2=mysqli_query($link,$sql2);
                                        while($records2=mysqli_fetch_array($query2))
                                        {
                                        ?>
                                        <?php echo $records2['signatura'].', '.$records2['oznaka'].'. '.$records2['naziv'];?><br/>
                                        <?php
                                        }
                                        ?> 
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $records['preslici'] ?>
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