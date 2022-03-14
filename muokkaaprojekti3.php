<?php
session_start(); 


ob_start();

echo'<!DOCTYPE html><html> 
<head>
<title> Projektin muokkaus </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {




        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';
        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
            echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" class="currentLink" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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

        echo'<div class="cm8-margin-top"></div>';



        echo'<div class="cm8-threequarter" style="padding-top: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px">';

        if ($_POST["tarkka"] >= 1) {
            $stmt = $db->prepare("UPDATE projektit SET kurssi_id=?, kuvaus=?, ryhmienmaksimi=?, tarkkamaara=?, opmaksimi=?, opminimi=?, palautus=?  WHERE id=?");
            $stmt->bind_param("isiiiiii", $kurssi, $kuvaus, $maks, $tarkka, $opmaks, $opmin, $pal, $id);
            // prepare and bind
            $kurssi = $_POST["kurssiId"];
            $kuvaus = $_POST["kuvaus"];
            $maks = 0;
            $tarkka = $_POST["tarkka"];
            $opmaks = $_POST["maksimi"];
            $opmin = $_POST["minimi"];
            $pal = $_POST[palautus];
            $id = $_POST[pid];
            $stmt->execute();
            $stmt->close();
        } else if ($_POST["lkm"] >= 1) {

            $stmt = $db->prepare("UPDATE projektit SET kurssi_id=?, kuvaus=?, ryhmienmaksimi=?, tarkkamaara=?, opmaksimi=?, opminimi=?, palautus=?  WHERE id=?");
            $stmt->bind_param("isiiiiii", $kurssi, $kuvaus, $maks, $tarkka, $opmaks, $opmin, $pal, $id);
            // prepare and bind
            $kurssi = $_POST["kurssiId"];
            $kuvaus = $_POST["kuvaus"];
            $maks = $_POST["lkm"];
            $tarkka = 0;
            $opmaks = $_POST["maksimi"];
            $opmin = $_POST["minimi"];
            $pal = $_POST[palautus];
            $id = $_POST[pid];
            $stmt->execute();
            $stmt->close();
        }

// RYHMÄJAKO PITÄÄ TEHDÄ UUDELLEEN JA TÄSTÄ ON MYÖS VAROITETTAVA ETUKÄTEEN!!
        if ($_POST["tarkka"] >= 1) {

            // jos liikaa ryhmiä -> ryhmiä pitää poistaa

            if (!$haeryhmat = $db->query("select distinct id from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $ryhmienlkm = 0;

            $ryhmienlkm = $haeryhmat->num_rows;

            if ($ryhmienlkm > $_POST["tarkka"]) {
                if (!$haepoist = $db->query("select distinct id from ryhmat where projekti_id='" . $_POST[pid] . "' order by id desc")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowp = $haepoist->fetch_assoc()) {

                    if ($ryhmienlkm > $_POST["tarkka"]) {
                        $db->query("delete from ryhmat where id = '" . $rowp[id] . "'");

                        $db->query("update opiskelijankurssit set ryhma_id=0 where ryhma_id = '" . $rowp[id] . "' AND projekti_id='" . $_POST[pid] . "'");


                        $ryhmienlkm = $ryhmienlkm - 1;
                    }
                }
            }

            // tehdään ryhmät jotta tarkkamäärä voimassa

            if (!$haeryhmat = $db->query("select distinct id from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $ryhmienlkm = 0;

            $ryhmienlkm = $haeryhmat->num_rows;

            while ($ryhmienlkm < $_POST["tarkka"]) {

                $ryhmanimi = ($ryhmienlkm + 1);

                $nimi = "Ryhmä " . $ryhmanimi . " ";
                $db->query("insert into ryhmat (projekti_id, nimi, suljettu) values('" . $_POST[pid] . "', '" . $nimi . "', 0)");
                $ryhmienlkm = $ryhmienlkm + 1;
            }
        } else if ($_POST["lkm"] >= 1) {

            // jos liikaa ryhmiä -> ryhmiä pitää poistaa

            if (!$haeryhmat = $db->query("select distinct id from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $ryhmienlkm = 0;

            $ryhmienlkm = $haeryhmat->num_rows;

            if ($ryhmienlkm > $_POST["lkm"]) {
                if (!$haepoist = $db->query("select distinct id from ryhmat where projekti_id='" . $_POST[pid] . "' order by id desc")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowp = $haepoist->fetch_assoc()) {

                    if ($ryhmienlkm > $_POST["lkm"]) {
                        $db->query("delete from ryhmat where id = '" . $rowp[id] . "'");

                        $db->query("update opiskelijankurssit set ryhma_id=0 where ryhma_id = '" . $rowp[id] . "' AND projekti_id='" . $_POST[pid] . "'");


                        $ryhmienlkm = $ryhmienlkm - 1;
                    }
                }
            }

            // jos maksimimäärä on ylittynyt -> opiskelijoita pitää poistaa
            if (!$haeryhmat = $db->query("select distinct * from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowr = $haeryhmat->fetch_assoc()) {

                $oplkm = 0;
                if (!$yht = $db->query("select distinct opiskelija_id as oid from opiskelijankurssit where ryhma_id='" . $rowr[id] . "' AND projekti_id='" . $_POST[pid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $oplkm = $yht->num_rows;


                if ($oplkm > $_POST["maksimi"]) {

                    while ($rowo = $yht->fetch_assoc()) {

                        if ($oplkm > $_POST["maksimi"]) {
                            echo'<br>' . $rowr[nimi];
                            $db->query("update opiskelijankurssit set ryhma_id=0 where opiskelija_id = '" . $rowo["oid"] . "' AND projekti_id='" . $_POST[pid] . "'");

                            $oplkm = $oplkm - 1;
                        }
                    }
                }
            }
        }

        header("location: ryhmatyot.php?r=" . $_POST[pid]);

        echo'</div>
    
</div></div>';
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