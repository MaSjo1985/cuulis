<?php
session_start(); 


ob_start();

echo'<!DOCTYPE html>
<html>
 
<head>

<title> Ota yhteyttä</title>
<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script><script src="https://code.jquery.com/jquery-1.10.2.js"></script>';
echo'<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
<script type="text/javascript" src="js/TimeCircles.js"></script>

<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script>';
echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js">   </script>
<script src="js/jquery.barrating.min.js"></script>';
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
    else if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "opiskelija")
        include ("opnavi.php");
    echo'<div class="cm8-margin-top" style="padding-left: 20px; padding-right: 20px">';

    echo'<div class="cm8-half" style="padding-top: 0px; margin-left: 0px; margin-top: 0px">';

    if (empty($_POST[viesti])) {
        echo'<p style="color: #e608b8">Et voi lähettää tyhjää viestiä!</p>';

        if ($_POST[url] == "yhteydenotto.php") {
            echo'<a href="yhteydenotto.php"><p style="font-size: 1em; display: inline-block;">&#8630 &nbsp&nbsp&nbsp</p> Palaa takaisin</a>';
        } else if ($_POST[url] == "yhteydenotto2.php") {
            echo'<a href="yhteydenotto2.php"><p style="font-size: 1em; display: inline-block;">&#8630 &nbsp&nbsp&nbsp</p> Palaa takaisin</a>';
        }
    } else {
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

        function poista_rivinvaihdot($teksti) {
            return str_replace(array("\r", "\n"), "", $teksti);
        }

        $nimi = poista_rivinvaihdot($_POST[nimi]);
        $email = poista_rivinvaihdot($_POST[sposti]);

      $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";

        $otsikko = "Olen lähettänyt sinulle viestin Cuulis-oppimisympäristöstä";
        $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

        if ($_POST[id] != 0) {
            if (!$result = $db->query("select distinct sposti, etunimi, koulut.Nimi as nimi, sukunimi from koulut, kayttajat, koulunadminit where kayttajat.id=koulunadminit.kayttaja_id AND koulunadminit.koulu_id='" . $_POST[id] . "' AND koulut.id='" . $_POST[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row = $result->fetch_assoc()) {
                $sposti = $row[sposti];
                $etunimi = $row[etunimi];
                $sukunimi = $row[sukunimi];
                $koulunimi = $row[nimi];

                if ($sposti != null) {

                    $viesti2 = $_POST[viesti];
                    $viesti2 = str_replace("\n.", "\n..", $viesti2);

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
                    $otsikkoa = "Cuulis-oppimisympäristön sisällä on lähetetty viesti.";
                    $otsikkoa = "=?UTF-8?B?" . base64_encode($otsikkoa) . "?=";
                    $kyselya = 'Cuulis-oppimisympäristön käyttäjä on lähettänyt yhteydenottoviestin oppilaitoksen ' . $koulunimi . ' ylläpitäjälle ' . $etunimi . ' ' . $sukunimi . '<br><br>Lähettäjän nimi: ' . $nimi . '<br>Lähettäjän käyttäjätunnus: ' . $email . '<br>Viesti: ' . $viesti2 . '.<br><br> Vastaanottajan sähköposti: ' . $sposti;
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
                        header("location: lahetayhteydenotto2.php");
                    } else {
                        echo "<br>Viestin lähettäminen ei onnistunut. Yritä uudelleen!";
                        echo '<br><br><a href="yhteydenotto.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin viestin lähettämiseen</a>';
                    }
                }
            }
        } else {
            if (!$result = $db->query('select sposti from kayttajat where rooli="admin"')) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row = $result->fetch_assoc()) {
                $sposti = $row[sposti];
            }


            if ($sposti != null) {

                $viesti2 = $_POST[viesti];
                $viesti2 = str_replace("\n.", "\n..", $viesti2);

                $viesti2 = nl2br($viesti2);
                $body = '<html><body>';
            $body .= '<p>' . $viesti2 . '</p><br><br><p>Viestin lähettäjän käyttäjätunnus on '.$_POST[sposti].'</p>';
                $body .= "</body></html>";
                $viesti = mail($sposti, $otsikko, $body, $headers);





                if ($viesti) {
                    header("location: lahetayhteydenotto2.php");
                } else {
                    echo "<br>Viestin lähettäminen ei onnistunut. Yritä uudelleen!";
                    echo '<br><br><a href="yhteydenotto.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin viestin lähettämiseen</a>';
                }
            }
        }
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
echo "</div>";
echo "</div>";
echo "</div>";
include("footer.php");
?>

</body>
</html>	
