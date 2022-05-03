<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Kadonnut kurssitehtävälomake</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

        include("kurssisivustonheader.php");

        include("diagrammit.php");
        include("pie.php");
        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';

        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" class="currentLink">Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id=211")) {
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







        echo'<div class="cm8-margin-top"></div>';

        if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id=211")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka->num_rows != 0) {
            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }
        }
        echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Tehtävälista</h2>';
        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';



        if (!$haeprojekti = $db->query("select * from itseprojektit where kurssi_id=211")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeprojekti->num_rows != 0) {
            echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
            while ($rowP = $haeprojekti->fetch_assoc()) {
                $kuvaus = $rowP[kuvaus];
                if ($_GET[id] == $id) {

                    echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
                } else {

                    echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
                }
            }

            echo'<div class="cm8-margin-top"></div>';


            echo'</div>';
        }






        echo'


 
	
</nav>

 </div> 

 
<div class="cm8-threequarter" style="padding-top: 0px; margin-top: 0px">';


        if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where id=222")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $onkoprojekti->fetch_assoc()) {

            $ipid = $rowP[id];
            $kuvaus = $rowP[kuvaus];
        }

        echo'<br><h6 style="padding-top: 0px; padding-bottom: 20px; font-size: 1.3em; color: #2b6777; display: inline-block">' . $kuvaus . '</h6>';

        echo'<br><a href="tarkastele.php?id=' . $ipid . '&monesko=' . $_GET[monesko] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';

        $opid = 598;
        if (!$haeopiskelija = $db->query("select distinct * from kayttajat where id=598")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        while ($rowO = $haeopiskelija->fetch_assoc()) {
            $kaid = $rowO[id];
            $etunimi = $rowO[etunimi];
            $sukunimi = $rowO[sukunimi];
        }


        echo'<p style="font-size: 1.1em"><b>Sandra Piippo?!</b></p>';
        echo'<br>';

        if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$haetehtavat2 = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $yht = $haetehtavat2->num_rows;

        if (!$haetehdyt = $db->query("select distinct itsetehtavat.id as s from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id=598 AND itsetehtavatkp.tehty=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haeosatut = $db->query("select distinct itsetehtavat.id from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id=598 AND itsetehtavatkp.osattu=1 AND itsetehtavatkp.tehty=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haeeiosatut = $db->query("select distinct itsetehtavat.id from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id=598 AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($onkopisteet->num_rows != 0) {
            $pisteet = true;
        }
        tuoDiagrammi(598, 222);


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
                echo'<p style="color: #e608b8; font-size: 1.1em" class="stripe-2"><b>Taulukon muokkausmahdollisuus on suljettu.</b></p>';
                $esta = true;
            } else if (($takarajaon == 1 && ($nyt >= $takaraja))) {

                echo'<p style="color: #e608b8; font-size: 1.1em" class="stripe-2"><b>Taulukon muokkausmahdollisuus on sulkeutunut <b>' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b></b></p>';
                $esta = true;
            }
        }




        echo'<div class="cm8-margin-top"></div>';
        echo'<br><form action="tallennakommentit_ope.php" id="formi" method="post">';
        echo'<div id="scrollbar"><div id="spacer"></div></div>';
        echo'<div class="cm8-responsive" id="container2">';
        echo '<table id="mytable2" class="cm8-uusitable2" style="table-layout:fixed; max-width: 100%">  ';
        echo'<thead>';
        echo '<tr style="border: 2px solid #2b6777; background-color: #48E5DA;  font-size: 1em">';

        if ($pisteet) {
            echo'<th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti  <br><input type="submit" name="painiket" value="&#10003 Tallenna kommentit" class="myButton11"  role="button"  style="padding:4px 6px; background-color: white"></th><th style="border: 2px solid #f7f9f7; background-color: white"></th></tr></thead><tbody>';
        } else {
            echo'<th>Tehtävä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti <br><input type="submit" name="painiket" value="&#10003 Tallenna kommentit" class="myButton11"  role="button"  style="padding:4px 6px; background-color: white"></th><th style="border: 3px solid #f7f9f7; background-color: white; border-right: 5px solid #f7f9f7"></th></tr></thead><tbody>';
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
   WHERE itsetehtavat_id='" . $rowt[id] . "' AND kayttaja_id=598
) AND kayttaja_id=598")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }







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

//                                    if (!$onkotallennettu = $db->query("select distinct * from itsetehtavatkp where id='" . $rowkp[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
//                                       die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//                                   }
//                            
//                                    while ($rowtal = $onkotallennettu->fetch_assoc()) {
//                                        if ($rowtal[tehty] == 0 || $rowtal[toive] == 0 || $rowtal[kommentti] == '') {
//                                           $db->query("update itsetehtavatkp set tallennettu=0 where id='" . $rowkp[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                                        }                                     
//                                     }
//                                   

                    if ($pisteet) {
                        if ($rowkp[tallennettu] == 1) {


                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Poista merkinnät" class="myButton9"  role="button"   style="padding:2px 4px; margin: 0px; color: #2b6777">X</a></td></tr>';
                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Poista merkinnät" class="myButton9"  role="button"   style="padding:2px 4px; margin: 0px; color: #2b6777">X</a></td></tr>';
                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Poista merkinnät" class="myButton9"  role="button"   style="padding:2px 4px; margin: 0px; color: #2b6777">X</a></td></tr>';
                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Poista merkinnät" class="myButton9"  role="button"   style="padding:2px 4px; margin: 0px; color: #2b6777">X</a></td></tr>';
                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] <> '') {

                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Poista merkinnät" class="myButton9"  role="button"   style="padding:2px 4px; margin: 0px; color: #2b6777">X</a></td></tr>';
                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Poista merkinnät" class="myButton9"  role="button"   style="padding:2px 4px; margin: 0px; color: #2b6777">X</a></td></tr>';
                            }
                        } else {

                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0) {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            }
                        }
                        echo'<input type="hidden" name="ipid" value=' . $ipid . '>';
                        echo'<input type="hidden" name="opid" value="598">';




                        if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                        }
                    } else {

                        if ($rowkp[tallennettu] == 1) {



                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Poista merkinnät" class="myButton9"  role="button"   style="padding:2px 4px; margin: 0px; color: #2b6777">X</a></td></tr>';
                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Poista merkinnät" class="myButton9"  role="button"   style="padding:2px 4px; margin: 0px; color: #2b6777">X</a></td></tr>';
                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Poista merkinnät" class="myButton9"  role="button"   style="padding:2px 4px; margin: 0px; color: #2b6777">X</a></td></tr>';
                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Poista merkinnät" class="myButton9"  role="button"   style="padding:2px 4px; margin: 0px; color: #2b6777">X</a></td></tr>';
                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Poista merkinnät" class="myButton9"  role="button"   style="padding:2px 4px; margin: 0px; color: #2b6777">X</a></td></tr>';
                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a onclick="korjaaope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" title="Poista merkinnät" class="myButton9"  role="button"   style="padding:2px 4px; margin: 0px; color: #2b6777">X</a></td></tr>';
                            }
                        } else {

                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0) {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            }
                            echo'<input type="hidden" name="ipid" value=' . $ipid . '>';
                            echo'<input type="hidden" name="opid" value="598">';
                        }



                        if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope2(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="checkope3(this, ' . $rowt[id] . ', ' . $opid . ', ' . $ipid . ')" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea  name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                        }
                        echo'<input type="hidden" name="ipid" value=' . $ipid . '>';
                        echo'<input type="hidden" name="opid" value="598">';
                    }





                    //tä
                }
            }
        }

        echo "</tbody></table>";

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
session_start(); 

 ob_start();
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
