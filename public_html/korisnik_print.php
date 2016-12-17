<!--autor: Sebastijan Legović-->
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ArhiWeb: Korisnici</title>
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
                        $sql=  "SELECT k.id_kor, k.broj_kor, k.god_prijave, k.prezime, k.ime, k.oib, 
                                k.oib_ust, k.jmbg, k.vrsta_osd, k.broj_osd, k.datum_rod, k.adresa_stalna, 
                                k.adresa_stalna, k.adresa_priv, k.telefon, k.gsm, k.gsm, k.fax, k.email, 
                                k.zvanje, k.zanimanje, k.ustanova, k.addedby, k.id_grad, k.mjesto_izdavanja, 
                                k.mjesto_rodenja, k.mjesto_priv, g.grad AS mjesto_sta, 
                                i.grad AS mjesto_izd, r.grad AS mjesto_rod, p.grad AS mjesto_privremeno,
                                g.ptt AS ptt_sta,p.ptt AS ptt_priv
                                FROM korisnik k
                                LEFT OUTER JOIN mjesto g ON k.id_grad=g.id_grad
                                LEFT OUTER JOIN mjesto i ON k.mjesto_izdavanja=i.id_grad
                                LEFT OUTER JOIN mjesto r ON k.mjesto_rodenja=r.id_grad
                                LEFT OUTER JOIN mjesto p ON k.mjesto_priv=p.id_grad
                                WHERE k.id_kor='".$_GET['id']."'";
                        
			$query=mysqli_query($link,$sql);
			$records=mysqli_fetch_array($query);
                        ?>
                    <table>
                        <tr>
                            <td rowspan="5" width='51%'>
                                <img src="../img/logo-dapa.png" alt="logo">
                            </td>
                            <td class="bold" colspan="2">
                                <p class="p-title">EVIDENCIJA KORISNIKA ARHIVSKOG GRADIVA</p>
                                <p class="p-title-italic">L'EVIDENZA DEGLI UTENTI DEL MATERIALE ARCHIVISTICO</p>
                                <p class="p-title-italic">REGISTER OF THE USERS OF ARCHIVAL MATERIAL</p></br>
                            </td>
                        </tr>
                        <tr>
                            <td width='30%'>
                                IDENTIFIKACIJSKI BROJ KORISNIKA:
                                <p class="p-italic">Numero d'identificazione:</p>
                                <p class="p-italic">ID number:</p>
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
                                GODINA PRIJAVE:
                                <p class="p-italic">L'anno dell' applicazione:</p>
                                <p class="p-italic">Year of application:</p>
                            </td>
                            <td class="border_right">
                                <?php echo $records['god_prijave']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="print-name" colspan="3">OBRAZAC ZA PRIJAVU KORISNIKA</TD>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                PREZIME I IME:</br>
                                <p class="p-italic">Cognome e nome:</p>
                                <p class="p-italic">Surname and name:</p>
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
                                OSOBNI IDENTIFIKACIJSKI BROJ - OIB, OIB USTANOVE: /ili/
                                <p class="p-italic">Codice fiscale, codice fiscale dell instituzione:</p>
                                <p class="p-italic">Personal identification number, identification number of institution:</p>
                            </td>
                            <td class='border_right' colspan="2">
                                <?php
                                //provjeravam dali su upisane, ako nisu ne ispisujem ništa (bitno da ne ispiše zareze ako nema zapisa)
                                if(!empty($records['oib'].$records['oib_ust'])){
                                echo $records['oib'].', '.$records['oib_ust']; 
                                }
                                ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                VRSTA, BROJ i MJESTO IZDAVANJA OSOBNOG DOKUMENTA:
                                <p class="p-italic">Tipo, numero ed il luogo del documento presonale:</p>
                                <p class="p-italic">Type, number and issuance of personal document:</p>
                            </td>
                            <td class="border_right" colspan="2">
                                <?php
                                if(!empty($records['vrsta_osd'].$records['broj_osd'].$records['mjesto_izd'])){
                                echo $records['vrsta_osd'].', '.$records['broj_osd'].', '.$records['mjesto_izd'];
                                }
                                ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                MJESTO I DATUM ROĐENJA:
                                <p class="p-italic">Luogo e data di nascita:</p>
                                <p class="p-italic">Place and date of birth:</p>
                            </td>
                            <td class="border_right" colspan="2">
                                <?php echo $records['mjesto_rod'].', '.$date = DATE("d.m.Y.",strtotime($records['datum_rod'])); ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                PTT, MJESTO I ADRESA STALNOG BORAVIŠTA: /ili/
                                <p class="p-italic">Codice postale, luogo e l'indirizzo permanente:</p>
                                <p class="p-italic">ZIP code, place and address of personal residence:</p>
                            </td>
                            <td class='border_right' colspan="2">
                                <?php echo $records['ptt_sta'].' '.$records['mjesto_sta'].', '.$records['adresa_stalna']; ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                PTT, MJESTO I ADRESA PRIVREMENOG BORAVIŠTA:
                                <p class="p-italic">Codice postale, luogo e l'indirizzo temporaneo:</p>
                                <p class="p-italic">ZIP code, place and address of temporary residence:</p>
                            </td>
                            <td class='border_right' colspan="2">
                                <?php
                                if(!empty($records['ptt_priv'].$records['mjesto_privremeno'].$records['adresa_priv'])){
                                echo $records['ptt_priv'].' '.$records['mjesto_privremeno'].', '.$records['adresa_priv']; 
                                }
                                ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                BROJ TELEFONA:
                                <p class="p-italic">Numero di telefono:</p>
                                <p class="p-italic">Phone number:</p>
                            </td>
                            <td class='border_right' colspan="2">
                                <?php echo $records['telefon'];?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                BROJ MOBITELA (GSM):
                                <p class="p-italic">Numero del cellulare:</p>
                                <p class="p-italic">Mobile number:</p>
                            </td>
                            <td class='border_right' colspan="2">
                                <?php echo $records['gsm'];?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                BROJ FAX-a:
                                <p class="p-italic">Fax:</p>
                                <p class="p-italic">Fax:</p>
                            </td>
                            <td class='border_right' colspan="2">
                                <?php echo $records['telefon'];?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                E-MAIL ADRESA:
                                <p class="p-italic">L'indirizzo email:</p>
                                <p class="p-italic">E-mail address:</p>
                            </td>
                            <td class='border_right' colspan="2">
                                <?php echo $records['email'];?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                ZVANJE (STRUČNA SPREMA) I ZANIMANJE:
                                <p class="p-italic">Professione e occupazione:</p>
                                <p class="p-italic">Profession and occupation:</p>
                            </td>
                            <td class='border_right' colspan="2">
                                <?php
                                if(!empty($records['zvanje'].$records['zanimanje'])){
                                echo $records['zvanje'].', '.$records['zanimanje']; 
                                }
                                ?>
                            </td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td class="noborder">
                                USTANOVA ZAPOSLENJA:
                                <p class="p-italic">Istituzione:</p>
                                <p class="p-italic">Institution:</p>
                            </td>
                            <td class='border_right' colspan="2">
                                <?php echo $records['ustanova'];?>
                            </td>
                        </tr>
                        <tr class="signature">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="signature">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="signature">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr class="noborder">
                            <td class="noborder_empty"></td>
                            <td class="noborder" colspan="2">
                                Vlastoručni potpis / firma / signature:
                            </td>
                        </tr>
                        <tr class="signature">
                            <td class="noborder_empty"></td>
                        </tr>
                        <tr>
                            <td>
                                U Pazinu, <?php echo date("d.m.Y.");?>
                            </td>
                            <td class='signature' colspan="1">
                            </td>
                        </tr>
                    </table>
                </div>
        </body>
</div>
<script>
window.print();
</script>