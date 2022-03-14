<?php
session_start(); 


ob_start();

echo'<!DOCTYPE html><html> 
<head>
<title> Viesti opiskelijoille </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 60px">';

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
	  <a href="osallistujat.php"  class="currentLink" >Osallistujat</a>  	  
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





    echo'<div class="cm8-container7" style="border: none">';
    echo'<div class="cm8-margin-bottom" style="margin-top: 40px; padding-left: 20px">';

    if (empty($_POST[viesti])) {
        echo'<p style="color: #e608b8">Et voi lähettää tyhjää viestiä!</p>';

        echo'<a href="viestiopiskelijoille.php"><p style="font-size: 1em; display: inline-block;">&#8630 &nbsp&nbsp&nbsp</p> Palaa takaisin</a>';
    } else {
        if (!$haekurssi = $db->query("select distinct nimi from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowkurssi = $haekurssi->fetch_assoc()) {
            $kurssinimi = $rowkurssi[nimi];
        }

        echo' <h2>Viesti osallistujille</h2>';


        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";


        $otsikko = "Olen lähettänyt sinulle viestin liittyen kurssiin " . $kurssinimi . " Cuulis-oppimisympäristössä";
        $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

        function poista_rivinvaihdot($teksti) {
            return str_replace(array("\r", "\n"), "", $teksti);
        }

        $nimi = poista_rivinvaihdot($_POST[nimi]);
        $email = poista_rivinvaihdot($_POST[sposti]);

        $headers .= "From: " . $nimi . " <" . $email . ">\r\n";


        if (!$haevastuuope = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowvo = $haevastuuope->fetch_assoc()) {
            $opeid = $rowvo[opettaja_id];
        }


        //vastuuope lähettää
        if ($opeid == $_SESSION["Id"]) {

            if (!$result = $db->query("select distinct sposti from kayttajat, opiskelijankurssit where (kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttajat.rooli='opiskelija') OR (kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttajat.rooli='opettaja' AND opiskelijankurssit.ope=1) OR (kayttajat.id='" . $_SESSION["Id"] . "')")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row = $result->fetch_assoc()) {
                $sposti = $row[sposti];
                if ($sposti != $_SESSION["Sposti"]) {
                    if ($sposti != null) {

                        $viesti2 = $_POST[viesti];
                        $viesti2 = str_replace("\n.", "\n..", $viesti2);

                        $viesti2 = nl2br($viesti2);
                        $body = '<html><body>';


                        $body .= '<p>' . $viesti2 . '</p>';
                        $body .= "</body></html>";


                        $viesti = mail($sposti, $otsikko, $body, $headers);
                    }
                }
            }


            if (!$tulosa = $db->query("select distinct sposti from kayttajat where rooli='admin'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }

            while ($rowa = $tulosa->fetch_assoc()) {
                $spostia = $rowa["sposti"];
            }
            $otsikkoa = "Opettaja on lähettänyt viestin kurssin/opintojakson " . $kurssinimi . " opiskelijoille";
            $otsikkoa = "=?UTF-8?B?" . base64_encode($otsikkoa) . "?=";
            $kyselya = 'Cuulis-oppimisympäristön opettaja on lähettänyt viestin kurssin/opintojakson ' . $kurssinimi . ' opiskelijoille.<br><br>Lähettäjän nimi: ' . $nimi . '<br>Lähettäjän käyttäjätunnus: ' . $email . '<br>Viesti: ' . $viesti2 . '.';
            $headers2 .= "MIME-Version: 1.0" . "\r\n";
            $headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers2 .= "X-Priority: 3\r\n";
            $headers2 .= "X-Mailer: PHP" . phpversion() . "\r\n";
            $headers2 .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . PHP_EOL;
            $body = '<html><body>';


            $body .= '<p>' . $kyselya . '</p>';
            $body .= "</body></html>";

            $viestia = mail($spostia, $otsikkoa, $body, $headers2);

            echo '<div class="cm8-margin-top"></div>';
            if ($viesti) {
                header("location: lahetaviestiopiskelijoille2.php");
            } else {
                echo "Viestin lähettäminen ei onnistunut. Yritä uudelleen!";
                echo '<br><br><a href="viestiopettajalle.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin viestin lähettämiseen</a>';
            }
        }

        //muu lähettää, eli viesti pitää lähettää vastuuopelle ja tsekata ettei lähe itelle
        else {

            //haetaan vastuuopen sposti ja lähetetään sinne

            if (!$result2 = $db->query("select distinct sposti from kayttajat where id='" . $opeid . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($row2 = $result2->fetch_assoc()) {
                $opesposti = $row2[sposti];


                $viesti2 = $_POST[viesti];
                $viesti2 = str_replace("\n.", "\n..", $viesti2);

                $viesti2 = nl2br($viesti2);
                $body = '<html><body>';


                $body .= '<p>' . $viesti2 . '</p>';
                $body .= "</body></html>";
                $viesti = mail($opesposti, $otsikko, $body, $headers);
            }

            //haetaan muut osallistujat ja lähetetään viesti

            if (!$result = $db->query("select distinct sposti from kayttajat, opiskelijankurssit where (kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttajat.rooli='opiskelija') OR (kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttajat.rooli='opettaja' AND opiskelijankurssit.ope=1)")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row = $result->fetch_assoc()) {
                $maara++;
                $sposti = $row[sposti];
                //tsekkaus ettei oma

                if ($sposti != $_SESSION["Sposti"]) {

                    if ($sposti != null) {

                        $viesti2 = $_POST[viesti];
                        $viesti2 = str_replace("\n.", "\n..", $viesti2);

                        $viesti2 = nl2br($viesti2);
                        $body = '<html><body>';


                        $body .= '<p>' . $viesti2 . '</p>';
                        $body .= "</body></html>";
                        $viesti = mail($sposti, $otsikko, $body, $headers);
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
            $otsikkoa = "Opettaja on lähettänyt viestin kurssin/opintojakson " . $kurssinimi . " opiskelijoille";
            $otsikkoa = "=?UTF-8?B?" . base64_encode($otsikkoa) . "?=";
            $kyselya = 'Cuulis-oppimisympäristön opettaja on lähettänyt viestin kurssin/opintojakson ' . $kurssinimi . ' opiskelijoille.<br><br>Lähettäjän nimi: ' . $nimi . '<br>Lähettäjän käyttäjätunnus: ' . $email . '<br>Viesti: ' . $viesti2 . '.';
            $headers2 .= "MIME-Version: 1.0" . "\r\n";
            $headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            $headers2 .= "X-Priority: 3\r\n";
            $headers2 .= "X-Mailer: PHP" . phpversion() . "\r\n";
            $headers2 .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . PHP_EOL;
            $body = '<html><body>';


            $body .= '<p>' . $kyselya . '</p>';
            $body .= "</body></html>";

            $viestia = mail($spostia, $otsikkoa, $body, $headers2);

            echo '<div class="cm8-margin-top"></div>';
            if ($viesti) {
                header("location: lahetaviestiopiskelijoille2.php");
            } else {
                echo "Viestin lähettäminen ei onnistunut. Yritä uudelleen!";
                echo '<br><br><a href="viestiopiskelijoille.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin viestin lähettämiseen</a>';
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