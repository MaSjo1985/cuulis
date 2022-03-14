<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Viesti opettajalle </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {




    echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 30px">';

    if ($_SESSION["Rooli"] == "opiskelija") {
        echo'<nav class="topnav" id="myTopnav">
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
		
		  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
			
		 ';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {

            $kysakt = $rowa[kysakt];
        }
        if ($kysakt == 1) {
            
        } else {
            // echo'<a  href="kysymyksetkommentit.php">Kysy/kommentoi</a>';
        }


        echo'
	  <a href="keskustelut.php" >Keskustele</a> 
	  <a href="osallistujat.php"   >Osallistujat</a>  	  
	   <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>

      </nav>';



        echo'

<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>';
    }


    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";





    $otsikko = "Opiskelija on lähettänyt viestin Cuulis-oppimisympäristöstä";
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

    function poista_rivinvaihdot($teksti) {
        return str_replace(array("\r", "\n"), "", $teksti);
    }

    $nimi = poista_rivinvaihdot($_POST[nimi]);
    $email = poista_rivinvaihdot($_POST[sposti]);

    $headers .= "From: " . $nimi . " <" . $email . ">\r\n";


    //vastuuope

    if (!$result = $db->query("select distinct sposti, muutopet from kurssit, kayttajat where kayttajat.id=kurssit.opettaja_id AND kurssit.id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row = $result->fetch_assoc()) {
        $sposti = $row[sposti];
        $muutopet = $row[muutopet];
        if ($sposti != null) {
            $viesti2 = $_POST[viesti];
            $viesti2 = str_replace("\n.", "\n..", $viesti2);

            $viesti2 = nl2br($viesti2);

            $viesti = mail($sposti, $otsikko, $viesti2, $headers);
        }
    }


    //muutopet
    if ($muutopet == 1) {

        if (!$resultmuut = $db->query("select distinct sposti from kayttajat, opiskelijankurssit where kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttajat.rooli='opettaja' AND opiskelijankurssit.ope=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowm = $resultmuut->fetch_assoc()) {
            $sposti = $rowm[sposti];

            if ($sposti != null) {
                $viesti2 = $_POST[viesti];
                $viesti2 = str_replace("\n.", "\n..", $viesti2);

                $viesti2 = nl2br($viesti2);

                $viesti = mail($sposti, $otsikko, $viesti2, $headers);
            }
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
    $kyselya = 'Cuulis-oppimisympäristön sisällä lähetetyn viestin tiedot:  Nimi:  ' . $nimi . ',  sähköpostiosoite:  ' . $email . ', viesti: ' . $viesti2 . '.';

    $viestia = mail($spostia, $otsikkoa, $kyselya, $headers);






    echo '<div class="cm8-margin-top"></div>';
    if ($viesti) {
        header("location: lahetaviestiopettajalle2.php");
    } else {
        echo "Viestin lähettäminen ei onnistunut. Yritä uudelleen!";
        echo '<br><br><a href="viestiopettajalle.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin viestin lähettämiseen</a>';
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";

include("footer.php");
?>

</body>
</html>	