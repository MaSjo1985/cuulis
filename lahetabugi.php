<?php
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Kehitysidea?</title>';
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour
// ready to go!
session_start();
include("yhteys.php");
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
    else if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "opiskelija")
        include ("opnavi.php");

    echo'<div class="cm8-container7">';
    echo'<div class="cm8-margin-bottom" style="margin-top: 40px; padding-left: 20px">';

    if (empty($_POST[viesti])) {
        echo'<p style="color: #c7ef00">Et voi lähettää tyhjää viestiä!</p>';

        echo'<a href="bugi.php"><p style="font-size: 1em; display: inline-block;">&#8630 &nbsp&nbsp&nbsp</p> Palaa takaisin</a>';
    } else {
        if (filter_var($_POST[sposti], FILTER_VALIDATE_EMAIL)) {
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

            $otsikko = "Virheilmoitus/kehitysidea Cuulis-oppimisympäristöstä";
            $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

            function poista_rivinvaihdot($teksti) {
                return str_replace(array("\r", "\n"), "", $teksti);
            }

            $nimi = poista_rivinvaihdot($_POST[nimi]);
            $email = poista_rivinvaihdot($_POST[sposti]);

            $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";

            if (!$result = $db->query('select sposti from kayttajat where rooli="admin"')) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row = $result->fetch_assoc()) {
                $sposti = $row[sposti];
            }

            $palaute = $_POST[viesti];
            $palaute = str_replace("\n.", "\n..", $palaute);

            $palaute = nl2br($palaute);

            $palaute = '<b>Virheilmoitus/kehitysidea: </b><br><br>' . $palaute;

            $body = '<html><body>';


           $body .= '<p>' . $palaute . '</p><br><br><p>Viestin lähettäjän käyttäjätunnus on '.$_POST[sposti].'</p>';
            $body .= "</body></html>";

            $viesti = mail($sposti, $otsikko, $body, $headers);










            if ($viesti) {
                header("location: bugi2.php");
            } else {
                echo "<br>Viestin lähettäminen ei onnistunut. Yritä uudelleen!";
                echo '<br><br><a href="bugi.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
            }
        } else {
            echo'<p style="color: #c7ef00">Sähköpostiosoite ei ole kelvollinen!</p>';

            echo'<a href="bugi.php"><p style="font-size: 1em; display: inline-block;">&#8630 &nbsp&nbsp&nbsp</p> Palaa takaisin</a>';
        }
    }

    echo "</div>";
    echo "</div>";

    include("footer.php");
}
?>
</body>
</html>	
