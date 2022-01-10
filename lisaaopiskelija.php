<?php
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Lisää opiskelija kurssille/opintojaksolle </title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />


';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!
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
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
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
            header("location: lisaaopiskelijaeka.php");

        else {
            if (!empty($_POST["mita"])) {
                $lista = $_POST["mita"];

                foreach ($lista as $tuote) {
                    $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id) values('" . $tuote . "', '" . $_SESSION["KurssiId"] . "', '" . $_SESSION["kouluId"] . "')");


                    if (!$tulosP = $db->query("select distinct * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                        die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                    }
                    if ($tulosP->num_rows != 0) {
                        while ($rowP = $tulosP->fetch_assoc()) {
                            $id = $rowP[id];
                            $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id, projekti_id) values('" . $tuote . "', '" . $_SESSION["KurssiId"] . "', '" . $_SESSION["kouluId"] . "', '" . $id . "')");
                        }
                    }
                    if (!$tulosIP = $db->query("select distinct * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                        die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                    }
                    if ($tulosIP->num_rows != 0) {
                        while ($rowIP = $tulosIP->fetch_assoc()) {
                            $id = $rowIP[id];
                            $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id, itseprojekti_id) values('" . $tuote . "', '" . $_SESSION["KurssiId"] . "', '" . $_SESSION["kouluId"] . "', '" . $id . "')");

                            if (!$tulosIPtehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $id . "'")) {
                                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                            }

                            if ($tulosIPtehtavat->num_rows != 0) {
                                while ($rowIPt = $tulosIPtehtavat->fetch_assoc()) {

                                    $db->query("insert itsetehtavatkp (kayttaja_id, itsetehtavat_id) values('" . $tuote . "', '" . $rowIPt[id] . "')");
                                }
                            }
                        }
                    }


                    //itsearvioinnit, VANHA
                    if (!$tulosIA = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                        die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                    }

                    //itsearviointi on luotu
                    if ($tulosIA->num_rows != 0) {
                        while ($rowIA = $tulosIA->fetch_assoc()) {
                            $ida = $rowIA[id];
                            if ($rowIA[aihe] == 0)
                                $db->query("insert itsearvioinnitkp (kayttaja_id, itsearvioinnit_id) values('" . $tuote . "', '" . $ida . "')");
                        }
                    }

                    //itsearvioinnit, UUSI

                    if (!$tulosias = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                        die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                    }


                    while ($rowias = $tulosias->fetch_assoc()) {
                        $jarjestys = $rowias[jarjestys];

                        if (!$tulosia = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $jarjestys . "' AND onvastaus=1")) {
                            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                        }
                        while ($rowia = $tulosia->fetch_assoc()) {
                            $ida = $rowia[id];
                            $db->query("insert iakp (kayttaja_id, ia_id) values('" . $tuote . "', '" . $ida . "')");
                        }
                    }




                    //lähetään vielä viesti

                    if (!$result = $db->query("select sposti from kayttajat where id='" . $tuote . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($row = $result->fetch_assoc()) {
                        $sposti = $row[sposti];

                        if (!$result2 = $db->query("select koodi, nimi from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
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

                        $viesti = 'Opettaja on lisännyt sinut Cuulis-oppimisympäristössä kurssille/opintojaksolle ' . $koodi . '  ' . $nimi . '<br><br>Pääset oppimisympäristöön suoraan <a href="https://cuulis.cm8solutions.fi/">tästä.</a><br><br><em>Tähän viestiin ei voi vastata.</em>';
                        $viesti = str_replace("\n.", "\n..", $viesti);
                        $body = '<html><body>';


                        $body .= '<p>' . $viesti . '</p>';
                        $body .= "</body></html>";

//
//                        $varmistus = mail($sposti, $otsikko, $body, $headers);
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

                header("location: lisaaopiskelijatodennus.php");
            }
        }
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}
echo "</div>";
echo "</div>";
include("footer.php");
?>
</body>

</html>	