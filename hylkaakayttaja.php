<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Liittymisen hylkäys</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7">';

    if ($_SESSION["Rooli"] == 'admin')
        include("adminnavi.php");
    else if ($_SESSION["Rooli"] == 'admink')
        include("adminknavi.php");
    else if ($_SESSION["Rooli"] == 'opeadmin')
        include("opeadminnavi.php");


    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
    echo'<div class="cm8-margin-top"></div>';
    if ($_POST["valinta"] == "ei")
        header("location: kayttajatvahvistus.php");

    else {

        $lista = $_POST["mita"];

        if ($_SESSION[Rooli] != 'admin') {
            if (!$haekoulu = $db->query("select distinct * from koulut where id = '" . $_SESSION[kouluId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($row2 = $haekoulu->fetch_assoc()) {
                $kouluid = $row2[id];
                $koulunimi = $row2[Nimi];
            }

            if (!$haeadmin = $db->query("select distinct kayttajat.etunimi as etunimi, kayttajat.sukunimi as sukunimi, kayttajat.sposti as sposti from koulunadminit, kayttajat where koulunadminit.kayttaja_id=kayttajat.id AND  koulunadminit.koulu_id = '" . $_SESSION[kouluId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowa = $haeadmin->fetch_assoc()) {
                $etunimi = $rowa[etunimi];
                $sukunimi = $rowa[sukunimi];
                $spostia = $rowa[sposti];
            }
        } else {
            if (!$haeadmin = $db->query("select distinct * from kayttajat where rooli='admin'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowa = $haeadmin->fetch_assoc()) {
                $etunimi = $rowa[etunimi];
                $sukunimi = $rowa[sukunimi];
                $spostia = $rowa[sposti];
            }
        }





        foreach ($lista as $tuote) {

            if (!$tulos4 = $db->query("select distinct * from kayttajat where id='" . $tuote . "'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }

            while ($rivi2 = $tulos4->fetch_assoc()) {
                $sposti = $rivi2[sposti];
            }

            $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

            $otsikko = "Liittymisesi oppilaitokseen on hylätty Cuulis-oppimisympäristössä";
            $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";
            if ($_SESSION[Rooli] != 'admin') {
                $viesti = 'Liittymisesi oppilaitokseen ' . $koulunimi . ' on hylätty Cuulis-oppimisympäristössä.<br><br>Tämän syystä voit olla yhteydessä oppilaitoksen ylläpitäjään ' . $etunimi . ' ' . $sukunimi . ', ' . $spostia . '<br><br><em>Tähän viestiin ei voi vastata.</em>';
            } else {
                $viesti = 'Liittymisesi uuteen oppilaitokseen on hylätty Cuulis-oppimisympäristössä.<br><br>Tämän syystä voit olla yhteydessä Cuulis-oppimisympäristön ylläpitäjään ' . $etunimi . ' ' . $sukunimi . ', ' . $spostia . '<br><br><em>Tähän viestiin ei voi vastata.</em>';
            }

            $viesti = str_replace("\n.", "\n..", $viesti);

            $viesti = nl2br($viesti);
            $body = '<html><body>';


            $body .= '<p>' . $viesti . '</p>';
            $body .= "</body></html>";
            $varmistus = mail($sposti, $otsikko, $body, $headers);

            if ($_SESSION[Rooli] != 'admin') {
                $db->query("delete from kayttajankoulut where kayttaja_id = '" . $tuote . "' AND koulu_id='" . $kouluid . "' AND odottaa=0");
            } else {
                $db->query("delete from kayttajankoulut where kayttaja_id = '" . $tuote . "' AND odottaa=0");
            }
        }
        header("location: hylkaakayttaja2.php");
    }

    echo'</div>';
    echo'</div>';

    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>

</body>
</html>	