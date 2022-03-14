<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Viestin lähetys </title>';


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


    if (empty($_POST[viesti])) {
        echo '<b style="color: #e608b8">Viesti-kenttä on tyhjä!</b>';
        echo '<br><br><a href="kayttajatviesti.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
    } else {
        $nimi = strip_tags($_POST[nimi]);
        $email = strip_tags($_POST[sposti]);


        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

        $headers .= "From: " . $nimi . " <" . $email . ">\r\n";

        $otsikko = "Olen lähettänyt sinulle viestin Cuulis-oppimisympäristössä";
        $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

        if ($_SESSION["Rooli"] == 'admin') {
            if (!$result = $db->query("select distinct sposti from kayttajat where rooli<>'" . $_SESSION["Rooli"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row = $result->fetch_assoc()) {
                $sposti = $row[sposti];

                if ($sposti != null) {
                    $viesti = $_POST[viesti];
                    $viesti = str_replace("\n.", "\n..", $viesti);

                    $viesti = nl2br($viesti);
                    $body = '<html><body>';


                    $body .= '<p>' . $viesti . '</p>';
                    $body .= "</body></html>";
                    $viesti = mail($sposti, $otsikko, $body, $headers);
                }
            }

            if (!$tulosa = $db->query("select distinct sposti from kayttajat where rooli='admin'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }

            while ($rowa = $tulosa->fetch_assoc()) {
                $spostia = $rowa["sposti"];
            }
            $otsikkoa = "Cuulis-oppimisympäristön sisällä on lähetetty viesti.";
            $otsikkoa = "=?UTF-8?B?" . base64_encode($otsikkoa) . "?=";
            $kyselya = 'Cuulis-oppimisympäristön sisällä admin on lähettänyt massaviestin.';

//        $viestia = mail($spostia, $otsikkoa, $kyselya, $headers);

            if ($viesti) {
                header("location: lahetaviesti2.php");
            } else {
                echo "<br>Viestin lähettäminen ei onnistunut. Yritä uudelleen!";
                echo '<br><br><a href="kayttajatviesti.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
            }
        } else if ($_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {
            if (!$haekoulu = $db->query("select distinct Nimi from koulut where id='" . $_SESSION["kouluId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowkoulu = $haekoulu->fetch_assoc()) {
                $koulunimi = $rowkoulu[Nimi];
            }

            if (!$result = $db->query("select distinct sposti from kayttajat, kayttajankoulut where kayttajankoulut.odottaa=1 AND kayttajat.tarkistettu=1 AND kayttajat.vahvistettu=1 AND kayttajat.id=kayttajankoulut.kayttaja_id AND kayttajankoulut.koulu_id='" . $_SESSION["kouluId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $maara = 0;
            while ($row = $result->fetch_assoc()) {
                $sposti = $row[sposti];

                if ($sposti != null) {
                    $viesti = $_POST[viesti];
                    $viesti = str_replace("\n.", "\n..", $viesti);

                    $viesti = nl2br($viesti);
                    $body = '<html><body>';


                    $body .= '<p>' . $viesti . '</p>';
                    $body .= "</body></html>";
                    $maara++;
                    $viesti = mail($sposti, $otsikko, $viesti, $headers);
                }
            }
            echo'määrä: ' . $maara;
            if (!$tulosa = $db->query("select distinct sposti from kayttajat where rooli='admin'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }

            while ($rowa = $tulosa->fetch_assoc()) {
                $spostia = $rowa["sposti"];
            }
            $otsikkoa = "Oppilaitoksen ylläpitäjä on lähettänyt viestin kaikille käyttäjille.";
            $otsikkoa = "=?UTF-8?B?" . base64_encode($otsikkoa) . "?=";
            $kyselya = 'Cuulis-oppimisympäristön oppilaitoksen ' . $koulunimi . ' ylläpitäjä ' . $nimi . ' on lähettänyt viestin kaikille käyttäjille.<br><br>Lähettäjän käyttäjätunnus: ' . $email . '<br>Viesti: ' . $viesti;
            $headers2 .= "MIME-Version: 1.0" . "\r\n";
            $headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers2 .= "X-Priority: 3\r\n";
            $headers2 .= "X-Mailer: PHP" . phpversion() . "\r\n";
            $headers2 .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . PHP_EOL;
            $body = '<html><body>';


            $body .= '<p>' . $kyselya . '</p>';
            $body .= "</body></html>";

            $viestia = mail($spostia, $otsikkoa, $body, $headers2);

            if ($viesti) {
//            header("location: lahetaviesti2.php");
            } else {
                echo '<br><b style="color: #e608b8">Viestin lähettäminen ei onnistunut!</b>';
                echo '<br><br><a href="kayttajatviesti.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
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
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>
</body>
</html>			