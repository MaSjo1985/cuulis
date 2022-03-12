<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title>Ota yhteyttä</title>';
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour
// ready to go!

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

    echo'<div class="cm8-container7" style="border: none">';
    echo'<div class="cm8-margin-bottom" style="margin-top: 40px; padding-left: 20px;">';

    if (!strlen(trim($_POST['viesti']))) {
        echo'<p style="color: #e608b8; font-weight: bold">Et voi lähettää tyhjää viestiä!</p>';

        echo'<a href="yhteydenotto.php"><p style="font-size: 1em; display: inline-block;">&#8630 &nbsp&nbsp&nbsp</p> Palaa takaisin</a>';
    } else {
        
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

            $otsikko = "Yhtedenotto Cuulis-oppimisympäristöstä";
            $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

            function poista_rivinvaihdot($teksti) {
                return str_replace(array("\r", "\n"), "", $teksti);
            }

            $nimi = poista_rivinvaihdot($_POST[nimi]);
            $email = poista_rivinvaihdot($_POST[sposti]);

            $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";

            

            $palaute = $_POST[viesti];
            $palaute = str_replace("\n.", "\n..", $palaute);

            $palaute = nl2br($palaute);

            $palaute = '<b>Viesti: </b><br><br>' . $palaute;

            $body = '<html><body>';


           $body .= '<p>' . $palaute . '</p><br>---------------------------------<br><p>Viestin lähettäjän nimi: <b>'.$_POST[nimi].'</b><p>Viestin lähettäjän käyttäjätunnus: <b>'.$_POST[sposti].'</b></p>';
            
           $body .= "</body></html>";
            $sposti = "marianne.sjoberg@cm8solutions.fi";
            $viesti = mail($sposti, $otsikko, $body, $headers);

            if ($viesti) {
                header("location: bugi2.php");
            } else {
                echo '<br><b style="#e608b8">Viestin lähettäminen ei onnistunut. Yritä uudelleen!</b>';
                echo '<br><br><a href="yhteydenotto.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
            }
      
    }
  echo "</div>";
    echo "</div>";
    echo "</div>";

    include("footer.php");
}
?>
</body>
</html>	
