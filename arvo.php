<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {




    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '" class="currentLink">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
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

    if ($_SESSION["Rooli"] == "opiskelija") {
        echo'<nav class="topnav" id="myTopnav">
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '" class="currentLink">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
		
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




    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Palautukset</h2>';
    echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">


	
</nav>
 <div class="cm8-margin-top"></div></div>';



    echo'<div class="cm8-half" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px">';
    $vapaatila = 0;

    if (!$maksimir = $db->query("select * from projektit where id='" . $_POST[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    //sallittu määrä
    while ($mr = $maksimir->fetch_assoc()) {
        $MR = $mr[opmaksimi];
        $alaraja = $mr[opminimi];
    }
    if (!$resultvailla = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND opiskelijankurssit.projekti_id='" . $_POST[pid] . "' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.ryhma_id=0 AND kayttajat.rooli='opiskelija' ORDER BY sukunimi, etunimi")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    $opiskelijatmaara2 = $resultvailla->num_rows;

    if ($opiskelijatmaara2 < $alaraja) {
        header("location: ryhmajakoepaonnistui.php?minimi=1&r=" . $_POST[pid]);
    } else {
        //selvitetään vapaaa tila aluksi

        if (!$resultmin = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$resultmax = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($minrow = $resultmin->fetch_assoc()) {
            $min = $minrow[pienin];
        }

        while ($maxrow = $resultmax->fetch_assoc()) {
            $max = $maxrow[suurin];
        }

        for ($j = $min; $j <= $max; $j++) {
            if (!$yht = $db->query("select distinct * from opiskelijankurssit where ryhma_id='" . $j . "' AND projekti_id='" . $_POST[pid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            //selvitetään kuinka paljon opiskelijoita/ryhmä


            $yhtop = $yht->num_rows;


            //vapaatila
            if ($yht->num_rows > 0)
                $vapaatila = $vapaatila + ($MR - $yhtop);
        }

        //selvitetään, onko nykyisissä ryhmissä riittävästi vapaata tilaa niille, joilla ei vielä ole ryhmää. Jos ei, täytyy luoda uusia ryhmiä.

        $ok2 = 0;

        while ($ok2 == 0) {
            if (!$resultuusi = $db->query("select distinct opiskelija_id from kayttajat, opiskelijankurssit where kayttajat.id=opiskelijankurssit.opiskelija_id AND ryhma_id=0 AND projekti_id='" . $_POST[pid] . "' AND kayttajat.rooli <> 'admin' AND kayttajat.rooli <> 'opettaja' ORDER BY kayttajat.sukunimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($resultuusi->num_rows > $vapaatila) {
                if (!$maara = $db->query("select distinct * from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                $ryhmanimi = (($maara->num_rows) + 1);

                $nimi = "Ryhmä " . $ryhmanimi . " ";

                $db->query("insert into ryhmat (projekti_id, nimi, suljettu) values('" . $_POST[pid] . "', '" . $nimi . "', 0)");

                $vapaatila = $vapaatila + $MR;
            }
            if ($resultuusi->num_rows <= $vapaatila)
                $ok2 = 1;
        }


        //asetetaan arvontaid:t

        $a = 1;
        if (!$resultmina = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$resultmaxa = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($minrowa = $resultmina->fetch_assoc()) {
            $mina = $minrowa[pienin];
        }

        while ($maxrowa = $resultmaxa->fetch_assoc()) {
            $maxa = $maxrowa[suurin];
        }

        for ($j = $mina; $j <= $maxa; $j++) {

            if (!$onko = $db->query("select * from ryhmat where projekti_id='" . $_POST[pid] . "' AND id='" . $j . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($onko->num_rows > 0) {
                $db->query("update ryhmat set arvontaid='" . $a . "' where projekti_id='" . $_POST[pid] . "' AND id='" . $j . "'");
                $a++;
            }
        }

        //nyt vapaata tilaa on riittävästi, joten arvonta voidaan aloittaa
        //haetaan opiskelijat, joilla ei ole vielä ryhmää
        //tehdään niin kauan, kunnes jokaisella ryhmä

        do {
            if (!$resultuusi2 = $db->query("select distinct opiskelija_id from kayttajat, opiskelijankurssit where kayttajat.id=opiskelijankurssit.opiskelija_id AND ryhma_id=0 AND projekti_id='" . $_POST[pid] . "' AND kayttajat.rooli <> 'admin' AND kayttajat.rooli <> 'opettaja' ORDER BY kayttajat.sukunimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $vaillaryhmaa = $resultuusi2->num_rows;

            while ($opiskelijarow = $resultuusi2->fetch_assoc()) {

                $opid = $opiskelijarow[opiskelija_id];

                if (!$resultmin2 = $db->query("select MIN(arvontaid) as pienin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                if (!$resultmax2 = $db->query("select MAX(arvontaid) as suurin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                //pienin arvontaid

                while ($minrow2 = $resultmin2->fetch_assoc()) {
                    $min2 = $minrow2[pienin];
                }

                //suurin arvontaid

                while ($maxrow2 = $resultmax2->fetch_assoc()) {
                    $max2 = $maxrow2[suurin];
                }

                $ryhmaid = mt_rand($min2, $max2);

                //haetaan opiskelijat, joilla arvottu id

                if (!$resultaid = $db->query("select distinct * from opiskelijankurssit, ryhmat where ryhmat.projekti_id='" . $_POST[pid] . "' AND opiskelijankurssit.ryhma_id=ryhmat.id AND ryhmat.arvontaid='" . $ryhmaid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                //haetaan oikea id

                if (!$resultoik = $db->query("select distinct * from ryhmat where arvontaid='" . $ryhmaid . "' AND projekti_id='" . $_POST[pid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowu = $resultoik->fetch_assoc()) {
                    $arvotturyhma = $rowu[id];
                }

                //laskuri- muuttuja kertoo niiden opiskelijoiden määrän, jotka arvotussa ryhmässä

                $laskuri = $resultaid->num_rows;

                //jos vapaata tilaa, lisätään opiskelija arvottuun ryhmään

                if ($laskuri < $MR)
                    $db->query("update opiskelijankurssit set ryhma_id='" . $arvotturyhma . "' where projekti_id='" . $_POST[pid] . "' AND opiskelija_id='" . $opid . "'");
            }
        }
        while ($vaillaryhmaa > 0);

        header("location: ryhmatyot.php?r=" . $_POST[pid]);
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