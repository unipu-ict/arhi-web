<!--autor: Sebastijan Legović-->
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArhiWeb: Dnevnik čitaonice</title>
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
                                ON d.id_kor=k.id_kor
                                WHERE d.id_dne='".$_GET['id']."'";
                        
			$query=mysqli_query($link,$sql);
			$records=mysqli_fetch_array($query);
                        ?>
                    <table>
                        <tr>
                            <td width='51%' colspan="2">
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
                            <td class="print-name" colspan="2">DNEVNIK ČITAONICE DRŽAVNOG ARHIVA U PAZINU</TD>
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
                            <td class="noborder">
                                </br>RB U GODINI:</br></br>
                            </td>
                            <td class="border_right">
                                <?php echo $records['rb_godina']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                </br>IDENTIFIKACIJSKI BROJ KORISNIKA:</br></br>
                                
                            </td>
                            <td class="border_right">
                                <?php echo $records['broj_kor']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                </br>PREZIME I IME KORISNIKA:</br></br>
                                
                            </td>
                            <td class="border_right">
                                <?php echo $records['prezime'].' '.$records['ime']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                </br>DATUM POSJETA:</br></br>
                            </td>
                            <td class='border_right'>
                                <?php echo $date = DATE("d.m.Y.",strtotime($records['datum'])); ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                </br>VRIJEME ULASKA:</br></br>
                            </td>
                            <td class="border_right">
                                <?php echo $records['vrijeme_ul']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                </br>VRIJEME IZLASKA:</br></br> 
                            </td>
                            <td class="border_right">
                                <?php echo $records['vrijeme_izl']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                </br>NAPOMENA:</br></br> 
                            </td>
                            <td class="border_right">
                                <?php echo $records['napomena']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="signature">
                            <td class="noborder_empty"></td>
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
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                            <td class="noborder">
                                Vlastoručni potpis korisnika:
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