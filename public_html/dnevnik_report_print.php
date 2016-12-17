<!--autor: Sebastijan Legović-->
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArhiWeb: Izvještaji - dnevnik čitaonice</title>
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
                        $sql=  "SELECT d.id_dne,d.rb_godina,d.datum,d.vrijeme_ul,d.vrijeme_izl,
                                d.napomena,d.addedby,k.id_kor,k.broj_kor,k.ime,k.prezime
                                FROM dnevnik d
                                LEFT OUTER JOIN korisnik k
                                ON d.id_kor=k.id_kor";
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
                            <td class="print-name" colspan="7">DNEVNIK ČITAONICE DRŽAVNOG ARHIVA U PAZINU</TD>
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
                            <th class="border_right" width="10%">RB u godini</th>
                            <th class="border_right" width="10%">ID korisnika</th>
                            <th class="border_right" width="15%">Prezime i ime</th>
                            <th class="border_right" width="10%">Datum</th>
                            <th class="border_right" width="10%">Vrijeme ulaska</th>
                            <th class="border_right" width="10%">Vrijeme izlaska</th>
                            <th class="border_right" width="35%">Napomena</th>
                        </thead>
                        </tr>
                        <tbody>
                            <?php
                                while($records=mysqli_fetch_array($query))
                                        {
                                    ?>
                                <tr class="report">
                                    <td class="border_right_nobold">
                                        <?php echo $records['rb_godina'] ?> 
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $records['id_kor'] ?> 
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $records['prezime']." ".$records['ime'] ?>
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $date = DATE("d.m.Y.",strtotime($records['datum'])) ?>
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $records['vrijeme_ul']?>
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $records['vrijeme_izl']?>
                                    </td>
                                    <td class="border_right_nobold">
                                        <?php echo $records['napomena']?>
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