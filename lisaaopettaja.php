<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Lisää opiskelija kurssille/opintojaksolle </title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />


';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {
    include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 60px">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
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
	  <a href="osallistujat.php" class="currentLink"  >Osallistujat</a>  	  
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



        echo '<div class="cm8-container3">';
        if ($_POST["valinta"] == "ei")
            header("location: lisaaopettajaeka.php");

        else {
            if (!empty($_POST["mita"])) {
                $lista = $_POST["mita"];
                $maara = 0;
                foreach ($lista as $tuote) {
                    $maara++;

                    if (!$result = $db->query("select distinct * from opiskelijankurssit where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND opiskelija_id = '" . $tuote . "' ")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    if ($result->num_rows == 0) {
                        $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, ope) values ('" . $tuote . "','" . $_POST[id] . "', 1)");
                    } else {
                        $db->query("update opiskelijankurssit set ope=1 where opiskelija_id = '" . $tuote . "' AND kurssi_id = '" . $_SESSION["KurssiId"] . "'");
                    }
                    //lähetään vielä viesti

                    if (!$result = $db->query("select sposti from kayttajat where id='" . $tuote . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($row = $result->fetch_assoc()) {
                        $sposti = $row[sposti];

                        if (!$result2 = $db->query("select koodi, nimi from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        while ($row2 = $result2->fetch_assoc()) {
                            $nimi = $row2[nimi];
                            $koodi = $row2[koodi];
                        }

                        $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
                        $headers .= "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
                        $headers .= "X-Priority: 3\r\n";
                        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";



                        $otsikko = "Sinut on lisätty kurssille/opintojaksolle Cuulis-oppimisympäristössä";
                        $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

                        $viesti = 'Sinut on lisätty Cuulis-oppimisympäristössä kurssille/opintojaksolle <b>' . $koodi . '  ' . $nimi . '</b><br><br>Pääset Cuulis-oppimisympäristöön suoraan <a href="https://cuulis.cm8solutions.fi/">tästä.</a><br><br><em>Tähän viestiin ei voi vastata.</em>';
                        $viesti = str_replace("\n.", "\n..", $viesti);
                        $body = '<html><body>';


                        $body .= '<p>' . $viesti . '</p>';
                        $body .= "</body></html>";


                        $varmistus = mail($sposti, $otsikko, $body, $headers);
                        if (!$tulos2 = $db->query("select distinct sposti from kayttajat where rooli='admin'")) {
                            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                        }
                        while ($row2 = $tulos2->fetch_assoc()) {
                            $sposti2 = $row2["sposti"];
                        }
                        $otsikko2 = "Viesti lähetetty Cuulis-oppimisympäristössä";
                        $otsikko2 = "=?UTF-8?B?" . base64_encode($otsikko2) . "?=";
                        $kysely2 = 'Cuulis-oppimisympäristöstä on lähetetty viesti kurssille/opintojaksolle ' . $koodi . '  ' . $nimi . ' lisäämisen yhteydessä osoitteeseen: ' . $sposti . '.';
                        $kysely2 = str_replace("\n.", "\n..", $kysely2);
//                        $viesti2 = mail($sposti2, $otsikko2, $kysely2, $headers);
                    }
                }


                header("location: lisaaopettajatodennus.php");
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
include("footer.php");
?>
</body>

</html>	