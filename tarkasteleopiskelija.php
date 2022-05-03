<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Tarkastele opiskelijan kurssitehtäviä</title>
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
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

        include("kurssisivustonheader.php");
        include("diagrammit.php");
        include("diagrammit3.php");
        include("pie.php");



        echo '<div class="cm8-container7" id="paluu" style="margin-top: 0px; padding-top:0px; padding-bottom: 30px; margin-bottom: 0px; ">';

        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
            echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress3()" class="currentLink">Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';


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
        } else if ($_SESSION["Rooli"] == "opiskelija") {
            echo'<nav class="topnav" id="myTopnav">
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a> 
		
		  <a href="itsetyot.php" onclick="loadProgress3()" class="currentLink" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
			
		 ';

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

        echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 0px; border: none">';

        if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; 
  color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka->num_rows != 0) {
            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }
        }


        echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px; "> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Tehtävälista</h2>';
        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; padding-left: 0px">
        
';



        if (!$haeprojekti = $db->query("select id, kuvaus from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeprojekti->num_rows != 0) {
            echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px;  padding-left: 0px">';
            while ($rowP = $haeprojekti->fetch_assoc()) {
                $kuvaus = $rowP[kuvaus];
                $id = $rowP[id];

                if ($_GET[id] == $id) {

                    echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3-valittu"  style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
                } else {

                    echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3"  style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
                }
            }

            echo'<div class="cm8-margin-top"></div>';
            if ($_SESSION["Rooli"] <> 'opiskelija') {
                echo'<form action="uusiitseprojektieka.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää sTehtävälista-osio" class="myButton8"  role="button"  style="padding:2px 4px"></form><br><br>';
            }

            echo'</div>';
        }
        if (!$hae_eka2 = $db->query("select MIN(id) as id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka2->num_rows == 1) {
            while ($rivieka2 = $hae_eka2->fetch_assoc()) {
                $eka_id2 = $rivieka2[id];
            }
            echo'';
        } else {
            echo'';
        }



        echo'</nav>';






        echo'</div>';


        echo'<div class="cm8-threequarter" style="padding-top: 20px; margin-left: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px; ">';



        if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $onkoprojekti->fetch_assoc()) {

            $ipid = $rowP[id];
            $kuvaus = $rowP[kuvaus];
        }



        $opid = $_GET[kaid];
        if (!$haeopiskelija = $db->query("select distinct * from kayttajat where id='" . $_GET[kaid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        while ($rowO = $haeopiskelija->fetch_assoc()) {
            $kaid = $rowO[id];
            $etunimi = $rowO[etunimi];
            $sukunimi = $rowO[sukunimi];
        }


        echo'<h6tiedosto>' . $etunimi . ' ' . $sukunimi . '</h6tiedosto><br><br>';
        if ($_GET[url] == "ykskohdat.php") {
            echo'<a href="ykskohdat.php?id=' . $ipid . '&tid=' . $_GET[tid] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';
        } else if ($_GET[url] == "ykskohdat2.php") {
            echo'<a href="ykskohdat2.php?id=' . $ipid . '&tid=' . $_GET[tid] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';
        } else {
            echo'<a href="tarkastele.php?id=' . $ipid . '&monesko=' . $_GET[monesko] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';
        }
    echo'<div class="cm8-margin-top"></div>';
                //ONKO EKA 

        $onkoeka = 0;

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $kaytylapi = 0;
        while ($row = $result->fetch_assoc()) {
            $kaytylapi++;
            if ($row[kaid] == $_GET[kaid] && $kaytylapi == 1) {
                $onkoeka = 1;
            }
        }

        //ONKO VIKA
        $onkovika = 0;
        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $yhteensa = $result->num_rows;
        $kaytylapi = 0;
        while ($row = $result->fetch_assoc()) {
            $kaytylapi++;
            if ($row[kaid] == $_GET[kaid] && $kaytylapi == $yhteensa) {
                $onkovika = 1;
            }
        }



        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $seuraavaloyty = 0;

        while ($row = $result->fetch_assoc()) {



            if ($seuraavaloyty == 1) {
                echo'<a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id='.$_GET[id].'"  class="cm8-navigointilinkki">Katso seuraava -> </a>';

                break;
            } else {
                $haettuid = $row[kaid];

                if ($haettuid == $_GET[kaid]) {

                    $seuraavaloyty = 1;
                }
            }
        }


        if ($onkovika == 1) {


            if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $kaytylapi = 0;
            while ($row = $result->fetch_assoc()) {
                $kaytylapi++;
                if ($kaytylapi == 1) {
                    echo'<a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id='.$_GET[id].'"   class="cm8-navigointilinkki">Katso seuraava -> </a>';
                }
            }
        }

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $maara = 0;

        while ($row = $result->fetch_assoc()) {

            $maara++;

            $haettuid = $row[kaid];

            if ($haettuid == $_GET[kaid]) {

                break;
            }
        }

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        $oikeamaara = $maara - 1;

        $maara = 0;

        while ($row = $result->fetch_assoc()) {
            $maara++;

            if ($maara == $oikeamaara) {
                echo'<br><br><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id='.$_GET[id].'"  class="cm8-navigointilinkki"><- Katso edellinen</a>';

                break;
            }
        }

        if ($onkoeka == 1) {

            if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $yhteensa = $result->num_rows;
            $kaytylapi = 0;
            while ($row = $result->fetch_assoc()) {
                $kaytylapi++;

                if ($kaytylapi == $yhteensa) {
                    echo'<br><br><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id='.$_GET[id].'"  class="cm8-navigointilinkki"><- Katso edellinen</a>';
                }
            }
        }
        
        
        echo'<div class="cm8-margin-top"></div>';

        if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$haetehtavat2 = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $yht = $haetehtavat2->num_rows;

        if (!$haetehdyt = $db->query("select distinct itsetehtavat.id as s from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kaid . "' AND itsetehtavatkp.tehty=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haeosatut = $db->query("select distinct itsetehtavat.id from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kaid . "' AND itsetehtavatkp.osattu=1 AND itsetehtavatkp.tehty=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haeeiosatut = $db->query("select distinct itsetehtavat.id from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kaid . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($onkopisteet->num_rows != 0) {
            $pisteet = true;
        }

        if ($pisteet) {
            echo'<input type="hidden" id="pisteytys" value="1">';
        } else {
            echo'<input type="hidden" id="pisteytys" value="0">';
        }

        if (!$onkopisteytys = $db->query("select distinct itsepisteytys from itseprojektit where id = '" . $ipid . "' AND itsepisteytys = 1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($onkopisteytys->num_rows != 0) {
            $itsepisteytys = true;
            echo'<input type="hidden" id="itsepisteytys" value="1">';
        } else {
            echo'<input type="hidden" id="itsepisteytys" value="0">';
        }


        tuoDiagrammi($_GET[kaid], $ipid);

        //       
        $esta = false;
        if (!$RTsuljettu = $db->query("select distinct palautus_suljettu, palautus_sulkeutuu from itseprojektit where id='" . $ipid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($RTs = $RTsuljettu->fetch_assoc()) {
            $suljettu = $RTs[palautus_suljettu];
            $sulkeutuu = $RTs[palautus_sulkeutuu];
        }

        $nyt = date("Y-m-d H:i");
        if (!empty($sulkeutuu) && $sulkeutuu != ' ') {


            $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
            $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
            $sulkeutumiskello = substr($sulkeutuu, 11, 5);

            $takaraja = $sulkeutuu;


            $takarajaon = 1;
        }

        if (($suljettu == 0 && $takarajaon == 0) || ($takarajaon == 1 && $nyt < $takaraja && $suljettu == 0)) {



            if ($takarajaon == 1) {
                echo'<p style="font-size: 1.1em">Taulukon muokkausmahdollisuus sulkeutuu <b>' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b></p>';
            }
        } else if ($suljettu == 1 || ($takarajaon == 1 && ($nyt >= $takaraja))) {
            if ($suljettu == 1) {
                echo'<p style="color: #e608b8; font-size: 1.1em" ><b>Taulukon muokkausmahdollisuus on suljettu.</b></p>';
                $esta = true;
            } else if (($takarajaon == 1 && ($nyt >= $takaraja))) {

                echo'<p style="color: #e608b8; font-size: 1.1em" ><b>Taulukon muokkausmahdollisuus on sulkeutunut <b>' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b></b></p>';
                $esta = true;
            }
        }




        echo'<br><form action="tallennakommentit_ope.php" id="formi" method="post">';
        echo'<div id="scrollbar"><div id="spacer"></div></div>';
        echo'<div class="cm8-responsive" id="container2" >';
        echo '<table id="mytable2" class="cm8-uusitable2" style="table-layout:fixed;  max-width: 100%">  ';
        echo'<thead>';
        echo '<tr style="border: 2px solid #2b6777; background-color: #73b9cc;  font-size: 1em" id="palaatanne">';


        if ($pisteet) {
            if ($itsepisteytys) {
                echo'<th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Oma pisteytys<br>tehtävästä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti <br><br><input type="submit" name="painiket" value="&#10003 Tallenna kommentit" class="myButtonKom"  role="button"  style="background-color: yellow; color: black;padding:4px 6px;"></th><th style="border: none"></th></tr></thead><tbody>';
            } else {
                echo'<th>Tehtävä<th>Tehtävän<br>pistemäärä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti <br><br><input type="submit" name="painiket" value="&#10003 Tallenna kommentit" class="myButtonKom"  role="button"  style="background-color: yellow; color: black;padding:4px 6px;"></th><th style="border: none"></th></tr></thead><tbody>';
            }
        } else {

            if ($itsepisteytys) {

                echo'<th>Tehtävä</th><th>Oma pisteytys<br>tehtävästä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti <br><br> <input type="submit" name="painiket" value="&#10003 Tallenna kommentit" class="myButtonKom"  role="button"  style="background-color: yellow; color: black;padding:4px 6px"></th><th style="border: none"></th></tr></thead><tbody>';
            } else {

                echo'<th>Tehtävä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti <br><br> <input type="submit" name="painiket" value="&#10003 Tallenna kommentit"   role="button" class="myButtonKom" style="background-color: yellow; color: black;padding:4px 6px"></th><th style="border: none"></th></tr></thead><tbody>';
            }
        }


        while ($rowt = $haetehtavat->fetch_assoc()) {
            if ($rowt[aihe] == 1) {

                $sulkeutumispaiva2 = '';
                $automaattinen = 0;
                $sulkeutumiskello2 = '';

                $sulkeutuu2 = $rowt[sulkeutuu];
                $takaraja2 = '';
                if (!empty($sulkeutuu2) && $sulkeutuu2 != ' ') {
                    $sulkeutumispaiva2 = substr($sulkeutuu2, 0, 10);
                    $sulkeutumispaiva2 = date("d.m.Y", strtotime($sulkeutumispaiva2));
                    $automaattinen = 1;
                    $sulkeutumiskello2 = substr($sulkeutuu2, 11, 5);
                    $takaraja2 = $sulkeutuu2;
                }
            }
            if (!$haekp = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND id IN (
   SELECT MIN(id) FROM itsetehtavatkp
   WHERE itsetehtavat_id='" . $rowt[id] . "' AND kayttaja_id='" . $kaid . "'
) AND kayttaja_id='" . $kaid . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($itsepisteytys) {


                if ($rowt[aihe] == 1 && $pisteet == 1) {
                    if ($rowt[aihekiinni] == 1) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0" class="stripe-2"><td style="border: 2px solid #2b6777; border-right: none" class="stripe-2"></td><td colspan="5" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none" class="stripe-2"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on suljettu!</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777" class="stripe-2"></td></tr>';
                    } else if (($rowt[aihekiinni] == 0 && ($takaraja2 != '' && $nyt > $takaraja2))) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0" class="stripe-2"><td style="border: 2px solid #2b6777; border-right: none" class="stripe-2"></td><td colspan="5" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none" class="stripe-2"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td class="stripe-2" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                    } else if (($rowt[aihekiinni] == 0 && ($takaraja2 != '' && $nyt <= $takaraja2))) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="5" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                    } else {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="5" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                    }
                } else {

                    while ($rowkp = $haekp->fetch_assoc()) {



                        if ($pisteet) {
                            if ($rowkp[tallennettu] == 1) {


                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                }
                            } else {

                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                }
                            }
                            echo'<input type="hidden" name="ipid" value=' . $ipid . '>';
                            echo'<input type="hidden" name="opid" value=' . $_GET[kaid] . '>';




                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            }
                        }





                        //tä
                    }
                }
            } else {


                if ($rowt[aihe] == 1 && $pisteet == 1) {
                    if ($rowt[aihekiinni] == 1) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0" class="stripe-2"><td style="border: 2px solid #2b6777; border-right: none" class="stripe-2"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none" class="stripe-2"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on suljettu!</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777" class="stripe-2"></td></tr>';
                    } else if (($rowt[aihekiinni] == 0 && ($takaraja2 != '' && $nyt > $takaraja2))) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0" class="stripe-2"><td style="border: 2px solid #2b6777; border-right: none" class="stripe-2"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none" class="stripe-2"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td class="stripe-2" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                    } else if (($rowt[aihekiinni] == 0 && ($takaraja2 != '' && $nyt <= $takaraja2))) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                    } else {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                    }
                } else if ($rowt[aihe] == 1 && $pisteet == 0) {
                    if ($rowt[aihekiinni] == 1) {
                        echo '<tr style=" font-size: 1em;" class="stripe-2"><td style="border: 2px solid #2b6777; border-right: none" class="stripe-2"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none" class="stripe-2"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on suljettu!</em></td><td class="stripe-2" style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                    } else if (($rowt[aihekiinni] == 0 && ($takaraja2 != '' && $nyt > $takaraja2))) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0" class="stripe-2"><td style="border: 2px solid #2b6777; border-right: none" class="stripe-2"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none" class="stripe-2"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 " class="stripe-2"></td></tr>';
                    } else if (($rowt[aihekiinni] == 0 && ($takaraja2 != '' && $nyt <= $takaraja2))) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                    } else {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                    }
                } else {

                    while ($rowkp = $haekp->fetch_assoc()) {



                        if ($pisteet) {
                            if ($rowkp[tallennettu] == 1) {


                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                }
                            } else {

                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                }
                            }
                            echo'<input type="hidden" name="ipid" value=' . $ipid . '>';
                            echo'<input type="hidden" name="opid" value=' . $_GET[kaid] . '>';




                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            }
                        } else {

                            if ($rowkp[tallennettu] == 1) {



                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Korjaa"   role="button"  style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                }
                            } else {

                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                }
                                echo'<input type="hidden" name="ipid" value=' . $ipid . '>';
                                echo'<input type="hidden" name="opid" value=' . $_GET[kaid] . '>';
                            }



                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea  name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            }
                            echo'<input type="hidden" name="ipid" value=' . $ipid . '>';
                            echo'<input type="hidden" name="opid" value=' . $_GET[kaid] . '>';
                        }





                        //tä
                    }
                }
            }
        }

        echo "</tbody></table>";

        echo"</div>";
            echo'<div class="cm8-margin-top"></div>';
                //ONKO EKA 

        $onkoeka = 0;

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $kaytylapi = 0;
        while ($row = $result->fetch_assoc()) {
            $kaytylapi++;
            if ($row[kaid] == $_GET[kaid] && $kaytylapi == 1) {
                $onkoeka = 1;
            }
        }

        //ONKO VIKA
        $onkovika = 0;
        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $yhteensa = $result->num_rows;
        $kaytylapi = 0;
        while ($row = $result->fetch_assoc()) {
            $kaytylapi++;
            if ($row[kaid] == $_GET[kaid] && $kaytylapi == $yhteensa) {
                $onkovika = 1;
            }
        }



        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $seuraavaloyty = 0;

        while ($row = $result->fetch_assoc()) {



            if ($seuraavaloyty == 1) {
                echo'<a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id='.$_GET[id].'"  class="cm8-navigointilinkki">Katso seuraava -> </a>';

                break;
            } else {
                $haettuid = $row[kaid];

                if ($haettuid == $_GET[kaid]) {

                    $seuraavaloyty = 1;
                }
            }
        }


        if ($onkovika == 1) {


            if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $kaytylapi = 0;
            while ($row = $result->fetch_assoc()) {
                $kaytylapi++;
                if ($kaytylapi == 1) {
                    echo'<a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id='.$_GET[id].'"   class="cm8-navigointilinkki">Katso seuraava -> </a>';
                }
            }
        }

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $maara = 0;

        while ($row = $result->fetch_assoc()) {

            $maara++;

            $haettuid = $row[kaid];

            if ($haettuid == $_GET[kaid]) {

                break;
            }
        }

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        $oikeamaara = $maara - 1;

        $maara = 0;

        while ($row = $result->fetch_assoc()) {
            $maara++;

            if ($maara == $oikeamaara) {
                echo'<br><br><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id='.$_GET[id].'"   class="cm8-navigointilinkki"><- Katso edellinen</a>';

                break;
            }
        }

        if ($onkoeka == 1) {

            if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $yhteensa = $result->num_rows;
            $kaytylapi = 0;
            while ($row = $result->fetch_assoc()) {
                $kaytylapi++;

                if ($kaytylapi == $yhteensa) {
                    echo'<br><br><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id='.$_GET[id].'"  class="cm8-navigointilinkki"><- Katso edellinen</a>';
                }
            }
        }

        echo"</div>";


        echo'</div></div>





</div>';
        ?>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
        <script>

            var $table2 = j('#mytable2');

            $table2.floatThead({zIndex: 1001});

            var $table = j('#mytable');
            $table.floatThead({zIndex: 1});

        </script>        
        <?php
session_start(); ob_start();
        ?>



        <?php
session_start();
        ob_start();
    } else {
        header("location: etusivu.php");
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



include("footer.php");
?>
<script>
    $("#tama").hide();
    $("#siirto").hide();
    $("#klik2").show();
    $("#klik").hide();
    $("#klik").click(function () {

        $("#tama").hide();
        $("#siirto").hide();
        $("#klik2").show();

    });
    $("#klik2").click(function () {
        $("#tama").show();
        $("#tama1").show();
        $("#tama2").show();
        $("#tama3").show();

        $("#siirto").show();
        $("#siirto2").show();
        $("#klik2").hide();
        $("#klik").show();

    });
</script>


<script>


    $("#siirto").draggable();

</script>

<script>

    $("#siirto2").resizable({
        alsoResize: "#kirja"
    });
    $("#kirja").resizable();
</script>
<script>


    $("#scrollbar").on("scroll", function () {

        var container = $("#container2");
        var scrollbar = $("#scrollbar");

        ScrollUpdate(container, scrollbar);
    });

    function ScrollUpdate(content, scrollbar) {
        $("#spacer").css({"width": "500px"}); // set the spacer width
        scrollbar.width = content.width() + "px";
        content.scrollLeft(scrollbar.scrollLeft());
    }

    ScrollUpdate($("#container2"), $("#scrollbar"));

</script>
<script>

    count();
</script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/tableHeadFixer.js"></script>
<script>


    //ilman tätä mikään muu ei toimi kuin scrolli

    $("#mytable").tableHeadFixer({"head": false, "left": 1});
    $("#mytable2").tableHeadFixer({"head": false, "left": 1});
</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
<script>


    var $table = $('#mytable');
    $table.floatThead({zIndex: 1});
    var $table2 = $('#mytable2');
    $table2.floatThead({zIndex: 1});

</script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script type="text/javascript" src="jscm/jquery.timepicker.js"></script>
<script src="jscm/jquery-ui.js"></script>
<script type="text/javascript" src="/js/fi.js"></script>
<script>

    (function () {
        $.datepicker.setDefaults($.datepicker.regional['fi']);
        var elem = document.createElement('input');
        elem.setAttribute('type', 'text');

        if (elem.type === 'text') {
            $('.kdate').datepicker({
                dateFormat: 'dd.mm.yy',
            });


        }
        $('.kello').timepicker({
            timeFormat: 'HH:mm',
            // year, month, day and seconds are not important
            minTime: new Date(0, 0, 0, 8, 0, 0),
            maxTime: new Date(0, 0, 0, 23, 55, 0),
            // time entries start being generated at 6AM but the plugin 
            // shows only those within the [minTime, maxTime] interval
            startHour: 6,
            // the value of the first item in the dropdown, when the input
            // field is empty. This overrides the startHour and startMinute 
            // options
            startTime: new Date(0, 0, 0, 8, 0, 0),
            maxTime: new Date(0, 0, 0, 23, 55, 0),
            // items in the dropdown are separated by at interval minutes
            interval: 15
        });


    })();


</script>




</body>
</html>		
