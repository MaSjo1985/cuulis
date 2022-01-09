<?php
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Viestin lähetys </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    if (isset($_POST[url])) {
        $mihin = $_POST[url];
    } else if (isset($_GET[url])) {
        $mihin = $_GET[url];
    }

    include("header.php");
    echo'<div class="cm8-container7">';



    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"></div>';

    if (empty($_POST[viesti])) {
        echo '<b style="color: #c7ef00">Et voi lähettää tyhjää viestiä!</b>';
        echo '<br><br><a href="' . $mihin . '"><p>&#8630 &nbsp&nbsp&nbspPalaa takaisin </p></a>';
    } else {

        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";


        $otsikko = "Olen lähettänyt sinulle viestin Cuulis-oppimisympäristöstä";
        $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

        function poista_rivinvaihdot($teksti) {
            return str_replace(array("\r", "\n"), "", $teksti);
        }

        $nimi = poista_rivinvaihdot($_POST[nimi]);
        $email = poista_rivinvaihdot($_POST[sposti]);

        $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";




        if (!$result = $db->query("select distinct sposti, etunimi, sukunimi from kayttajat where id='" . $_POST["id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row = $result->fetch_assoc()) {
            $sposti = $row[sposti];
            $etunimi = $row[etunimi];
            $sukunimi = $row[sukunimi];

            if ($sposti != null) {

                $viesti2 = $_POST[viesti];
                $viesti2 = str_replace("\n.", "\n..", $viesti2);
//            $viesti2 = wordwrap($viesti2, 70, "\r\n");
                $viesti2 = nl2br($viesti2);
                $body = '<html><body>';


                $body .= '<p>' . $viesti2 . '</p><br><br><p>Viestin lähettäjän käyttäjätunnus on '.$_POST[sposti].'</p>';
                $body .= "</body></html>";
                $viesti = mail($sposti, $otsikko, $body, $headers);

                if (!$tulosa = $db->query("select distinct sposti from kayttajat where rooli='admin'")) {
                    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                }

                while ($rowa = $tulosa->fetch_assoc()) {
                    $spostia = $rowa["sposti"];
                }
                $otsikkoa = "Cuulis-oppimisympäristön sisällä on lähetetty viesti";
                $otsikkoa = "=?UTF-8?B?" . base64_encode($otsikkoa) . "?=";
                $kyselya = 'Cuulis-oppimisympäristön käyttäjä ' . $nimi . ' on lähettänyt yksilöllisen viestin. <br><br>Lähettäjän käyttäjätunnus: ' . $email . ' <br>Viesti: ' . $viesti2 . '.<br><br>Vastaanottajan nimi ' . $etunimi . ' ' . $sukunimi . '<br>Vastaanottajan sähköposti: ' . $sposti;

                $headers2 .= "MIME-Version: 1.0" . "\r\n";
                $headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                $headers2 .= "X-Priority: 3\r\n";
                $headers2 .= "X-Mailer: PHP" . phpversion() . "\r\n";
                $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
                $body = '<html><body>';


                $body .= '<p>' . $kyselya . '</p>';
                $body .= "</body></html>";
                $viestia = mail($spostia, $otsikkoa, $body, $headers2);

                if ($viesti) {
                    if ($_GET[url] == "osallistujat.php" || strpos($_POST[url], "osallistujat.php") !== false) {
                        $mihin = "osallistujat.php";
                    } else if ($_GET[url] == "lisaaopiskelijaeka.php" || strpos($_POST[url], "lisaaopiskelijaeka.php") !== false) {
                        $mihin = "lisaaopiskelijaeka.php";
                    } else if ($_GET[url] == "lisaaopettajaeka.php" || strpos($_POST[url], "lisaaopettajaeka.php") !== false) {
                        $mihin = "lisaaopettajaeka.php";
                    } else if ($_GET[url] == "ryhmatyot.php" || strpos($_POST[url], "ryhmatyot.php") !== false) {
                        $koko = strlen($mihin);
                        $arvo = strpos($mihin, "r=");
                        $uusi = substr($mihin, $arvo, $koko);

                        $mihin = "ryhmatyot.php?" . $uusi;
                    }
                    if (strpos($_POST[url], "kayttajatvahvistus.php") !== false) {
                        $mihin = "kayttajatvahvistus.php";
                    } else if (strpos($_POST[url], "kayttajatkaikki.php") !== false) {
                        $mihin = "kayttajatkaikki.php";
                    } else if (strpos($_POST[url], "kayttajatopettajat.php") !== false) {
                        $mihin = "kayttajatopettajat.php";
                    } else if (strpos($_POST[url], "kayttajatopiskelijat.php") !== false) {
                        $mihin = "kayttajatopiskelijat.php";
                    } else if (strpos($_POST[url], "kayttajatmuut.php") !== false) {
                        $mihin = "kayttajatmuut.php";
                    }

                    header("location: lahetaviestiyksilollinen2.php?url=" . $mihin);
                } else {
                    echo '<b style="color: #c7ef00">Viestin lähettäminen ei onnistunut!</b>';
                    echo '<br><br><a href="' . $mihin . '"><p>&#8630 &nbsp&nbsp&nbspPalaa takaisin </p></a>';
                }
            }
        }
    }

    echo'</div>';
    echo'</div>';

    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}
?>
</body>
</html>		
</html>	