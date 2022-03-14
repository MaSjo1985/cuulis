<?php
session_start();
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title> Käyttäjien vahvistus</title>';


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
        }

        foreach ($lista as $tuote) {
            if ($_SESSION[Rooli] != 'admin') {
                $db->query("update kayttajankoulut set odottaa=1 where kayttaja_id = '" . $tuote . "' AND koulu_id='" . $kouluid . "'");
            } else {
                $db->query("update kayttajankoulut set odottaa=1 where kayttaja_id = '" . $tuote . "'");
            }


            if (!$result = $db->query("select distinct sposti from kayttajat where id='" . $tuote . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row = $result->fetch_assoc()) {
                $sposti = $row[sposti];
            }
            $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

            $otsikko = "Oppilaitokseen liittyminen on hyväksytty Cuulis-oppimisympäristössä";
            $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

            if ($_SESSION[Rooli] != 'admin') {
                $viesti = 'Ylläpitäjä on hyväksynyt liittymisesi oppilaitokseen ' . $koulunimi . ' Cuulis-oppimisympäristössä.<br><br>Pääset Cuulis-oppimisympäristöön suoraan <a href="https://cuulis.cm8solutions.fi/"> tästä. </a><br><br><em>Tähän viestiin ei voi vastata.</em>';
            } else {
                $viesti = 'Ylläpitäjä on hyväksynyt liittymisesi uuteen oppilaitokseen ' . $koulunimi . ' Cuulis-oppimisympäristössä.<br><br>Pääset Cuulis-oppimisympäristöön suoraan <a href="https://cuulis.cm8solutions.fi/"> tästä. </a><br><br><em>Tähän viestiin ei voi vastata.</em>';
            }


            $viesti = str_replace("\n.", "\n..", $viesti);
            $body = '<html><body>';


            $body .= '<p>' . $viesti . '</p>';
            $body .= "</body></html>";


            $varmistus = mail($sposti, $otsikko, $body, $headers);
        }
        header("location: vahvistaliittyminen2.php");
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