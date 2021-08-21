<?php

ob_start();




echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>

';
$urlmihin = $_SERVER[REQUEST_URI];

if (strpos($urlmihin, "?")) {

    $urlmihin = substr($urlmihin, 1, strpos($urlmihin, "?") - 1);
}

include("yhteys.php");
include("tsekkaa_oikeus.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

session_start(); // ready to go!



if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
} else {
    tsekkaa_oikeus($_SESSION["KurssiId"]);
}
if (isset($_SESSION["Kayttajatunnus"])) {



    include("kurssisivustonheader.php");


    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px; font-size: 0.9em">';
    if (!$haeprojekti = $db->query("select * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($haeprojekti->num_rows == 1 && !isset($_GET[r])) {
        if (!$hae_eka = $db->query("select MIN(id) as id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
        header('location: ryhmatyot.php?r=' . $eka_id);
    }
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" class="currentLink" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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

    if ($_SESSION["Rooli"] == "opiskelija") {
        echo'<nav class="topnav" id="myTopnav">
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
		 
		  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" class="currentLink" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
			
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

    echo'<div class="cm8-margin-top"></div>';

    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Palautukset</h2>';
    echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';

    if (!$hae_eka = $db->query("select id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka->num_rows == 1) {
        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
    }




    if ($haeprojekti->num_rows != 0) {
        echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
        while ($rowP = $haeprojekti->fetch_assoc()) {
            $kuvaus = $rowP[kuvaus];
            $id = $rowP[id];
            if ($_GET[r] == $id) {

                echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3-valittu" style="font-size: 0.9em; margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
            } else {

                echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3" style="font-size: 0.9em; margin-right: 20px; margin-bottom: 5px;  padding: 6px 6px 6px 20px">' . $kuvaus . '</a>';
            }
        }
        echo'<div class="cm8-margin-top"></div>';

        if ($_SESSION["Rooli"] <> 'opiskelija') {
            echo'<form action="uusiprojekti.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää uusi" class="myButton8"  role="button"  style="padding: 2px 6px"></form><br><br>';
        }
    }
    echo'</nav>
</div>';

    echo'<div class="cm8-threequarter" style="padding-top: 0px; margin-left: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 30px">';


    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<div class="divi">
         <div class="message">This is a warning message.</div>
         <button class="yes">OK</button>
      </div>';

        if (!$onkoprojekti = $db->query("select * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($onkoprojekti->num_rows == 0) {


            echo'<br><p id="ohje">Tähän on mahdollista luoda osio, jossa opiskelijat voivat liittyä ryhmiin ja palauttaa tiedostoja.</p>';
            echo'<div class="cm8-margin-top"></div>';
            echo'<form action="uusiprojekti.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää palautus" class="myButton8"  role="button"  style="padding:4px 6px"></form>';


            echo'<div class="cm8-margin-top"></div>';
        } else if ($onkoprojekti->num_rows > 0 && !isset($_GET[r])) {

            echo'<br>Valitse oheisesta valikosta haluamasi Palautus-osio.<br><br>';
        } else {
            if (!$onkoprojekti = $db->query("select * from projektit where id='" . $_GET[r] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowP = $onkoprojekti->fetch_assoc()) {

                $kuvaus = $rowP[kuvaus];
                $pid = $rowP[id];
                $ryhmienmaksimi = $rowP[ryhmienmaksimi];
                $tarkkamaara = $rowP[tarkkamaara];
                $opmaksimi = $rowP[opmaksimi];
                $opminimi = $rowP[opminimi];
                $palautus = $rowP[palautus];
                $sulkeutuu = $rowP[palautus_sulkeutuu];
                $avautuu = $rowP[palautus_avautuu];

                echo'<h6tiedosto id="' . $pid . '"  style="margin-top: 10px;margin-right: 40px; padding: 6px 10px 6px 20px; ">&#9997 &nbsp&nbsp&nbsp ' . $kuvaus;

                echo'<form action="muokkaaprojektieka.php" method="post" style="margin-left: 60px;display: inline-block; "><input type="hidden" name="id" value=' . $pid . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa" class="muokkausN"  role="button"></form>';

                echo'<form action="varmistusprojekti.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $pid . '><button class="roskis" title="Poista" ><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button></form><br>';


                echo'</h6tiedosto>';

                if (!$haeinfo = $db->query("select * from projektit where id='" . $pid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowv = $haeinfo->fetch_assoc()) {
                    $viesti = $rowv[info];
                }

                if (!$haeoppilaat = $db->query("select distinct * from opiskelijankurssit where projekti_id='" . $pid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                echo'<div class="cm8-responsive" id="info_ope">';


                if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin")
                    echo'<div class="cm8-responsive cm8-ilmoitus" style="padding: 0px; margin: 0px">';

                echo '<form action="ilmoitus.php" method="post" id="infomuokkaus"><input type="hidden" name="id" value=' . $pid . '><input type="hidden" name="kuvaus" value=' . $kuvaus . '><input type="submit" name= "painiker" value="&#9998" title="Muokkaa sisältöä" class="muokkausinfo"  role="button" style="padding: 2px 6px; font-size: 0.8em; float: left"></form>';

                echo'</div>';

                echo'<div class="cm8-responsive cm8-ilmoitus" style="padding: 20px">';
                echo htmlspecialchars_decode($viesti);
                echo'</div>';

                echo'</div>';

                if (!$ryhmatiedot = $db->query("select distinct lopullinen from ryhmat where projekti_id='" . $pid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowRT = $ryhmatiedot->fetch_assoc()) {
                    $rlopullinen = $rowRT[lopullinen];
                }

                echo'<div class="cm8-responsive ohjeboxi" style="padding-top: 20px; padding-bottom: 0px">';
                if ($tarkkamaara != 0) {
                    echo '<p class="info" style="font-weight: normal; margin: 0px;color: #c7ef00;">Ryhmiä on yhteensä: <b>' . $tarkkamaara . '.</b></p><p class="info" style="font-weight: normal; color: #c7ef00;display: inline-block">Jokaisessa ryhmässä on oltava vähintään <b>' . $opminimi . '</b> ja saa olla korkeintaan <b>' . $opmaksimi . '</b> opiskelijaa.</p>';
                } else {
                    echo '<p class="info" style="font-weight: normal; margin: 0px;color: #c7ef00;">Ryhmien maksimimäärä on <b>' . $ryhmienmaksimi . '.</b></p><p class="info" style="font-weight: normal; color: #c7ef00;display:inline-block">Jokaisessa ryhmässä on oltava vähintään <b>' . $opminimi . '</b> ja saa olla korkeintaan <b>' . $opmaksimi . '</b> opiskelijaa.</p>';
                }
//TÄHÄN
                echo '<form action="muokkaaprojekti2.php" method="post" style="display:inline-block; margin-left: 40px; margin-top: 0px" ><input type="hidden" name="pid" value=' . $pid . '><input type="submit" name= "painiker" value="&#9998 Muokkaa tietoja" title="Muokkaa tietoja" class="myButton8"  role="button" style="padding: 2px 6px;"></form>';

                echo'</div>';
                echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding-top: 10px; padding-bottom: 10px">';
                if ($rlopullinen == 0) {


                    echo'<form action="lopullinenryhmajakoeka.php" method="get" style="margin-right: 6px; margin-top: 10px; display: inline-block"><input type="hidden" name="pid" value=' . $pid . '><input type="submit" name="painike" value="&#9763 Arvo opiskelijat ryhmiin" class="myButton9"  role="button"  style="padding:2px 4px; font-size: 0.9em"></form>';

                    echo'<form action="suljekasa2.php" method="get" style="margin-top: 10px; display: inline-block; margin-left: 30px"><input type="hidden" name="pid" value=' . $pid . '><input type="submit" name="painike" value="- Sulje ilmoittautuminen" class="myButton9"  role="button"  style="padding:4px 6px; font-size: 0.9em"></form><br>';
                } else {

                    echo'<p style="display: inline-block; margin-right: 20px; font-size: 0.9em; color: #c7ef00; font-weight: bold; margin-top: 10px">Ilmoittautuminen ryhmiin on suljettu.</p>';
                    echo'<form action="avaakasa.php" method="post" style="margin-top: 0px; display: inline-block"><input type="hidden" name="pid" value=' . $pid . '><input type="submit" name="painike" value="+ Avaa ilmoittautuminen" class="myButton9"  role="button"  style="padding:4px 6px; font-size: 0.8em"></form><br>';
                }
                echo'</div>';
                echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding-top: 10px; padding-bottom: 10px">';


                if ($palautus == 1) {

                    $nyt = date("Y-m-d H:i");
                    $avautumispaiva = substr($avautuu, 0, 10);
                    $avautumispaiva = date("d.m.Y", strtotime($avautumispaiva));
                    $avautumiskello = substr($avautuu, 11, 5);

                    $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
                    $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
                    $sulkeutumiskello = substr($sulkeutuu, 11, 5);


                    echo '<form id="takaraja" action="asetatakaraja2.php" style="padding-bottom: 10px; font-size: 0.9em" method="post" autocomplete="off">';
                    echo'<input type="hidden" name="pid" value=' . $pid . '>';
                    if (!empty($sulkeutuu) && $sulkeutuu != ' ' && $sulkeutuu != NULL) {

                        if ($nyt <= $sulkeutuu) {
                            echo'<p style="display: inline-block; margin-right: 20px; color: #c7ef00; font-weight: bold; font-size: 1.1em" >Palautusten takaraja on ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</p>';
                        } else {
                            echo'<p style="display: inline-block; margin-right: 20px; color: red; font-weight: bold; font-size: 1.1em" >Palautusten takaraja oli ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</p>';
                        }
                        echo'<input type="submit" style="margin-left: 10px; padding: 2px" value="Muokkaa" class="myButton8" name="muokkaa"  title="Muokkaa sulkeutumisaikaa">';
                    } else {

                        echo'<p style="margin-bottom: 10px; font-weight: bold; color: #c7ef00;">Aseta palautuksille sulkeutumisajankohta: </p>';
                        echo'<b style="font-size: 0.8em; margin-right: 5px; color:  ">Pvm:</b>
     
            <input type="text" class="kdate" style="margin-right: 10px; width: 20%; font-size: 0.8em; color: #080708"  name="paiva">';


                        echo'<b style="font-size: 0.8em; margin-right: 5px; color: ">Klo:</b>
    
               <input type="text" class="kello"  name="kello" style="width: 20%; font-size: 0.8em; color: #080708" >';


                        echo'<input type="submit" style=" margin-left:10px; padding: 2px;" value="Tallenna" class="myButton8" name="tallenna"  title="Tallenna">';
                    }
                    echo'</form>';
                    ?>


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
                                minTime: new Date(0, 0, 0, 0, 0, 0),
                                maxTime: new Date(0, 0, 0, 23, 59, 0),
                                // time entries start being generated at 6AM but the plugin 
                                // shows only those within the [minTime, maxTime] interval

                                // the value of the first item in the dropdown, when the input
                                // field is empty. This overrides the startHour and startMinute 
                                // options
                                startTime: new Date(0, 0, 0, 0, 0, 0),

                                // items in the dropdown are separated by at interval minutes
                                interval: 15
                            });


                        })();


                    </script>

                    <?php

                    ob_start();

                    //TÄNNE KAIKKI
                }
                echo'</div>';


                //ryhmässä maks. 1

                if ($opmaksimi == 1) {

                    $tyhjatryhmat = array();


                    if (!$haeryhmat = $db->query("select distinct * from ryhmat where projekti_id='" . $pid . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($hae = $haeryhmat->fetch_assoc()) {
                        $rid = $hae[id];
                        if (!$haeoppilaat = $db->query("select distinct * from ryhmat, opiskelijankurssit where ryhmat.id='" . $rid . "' AND ryhmat.id=opiskelijankurssit.ryhma_id")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        //tyhjät ryhmät talteen
                        if ($haeoppilaat->num_rows == 0) {
                            array_push($tyhjatryhmat, $rid);
                        }
                    }

                    $ryhmatkaikki = array();


                    if (!$kaikkiryhmat2 = $db->query("select distinct ryhmat.nimi as nimi, suljettu, ryhmat.id as id, lopullinen from ryhmat, opiskelijankurssit, kayttajat where ryhmat.id=opiskelijankurssit.ryhma_id AND opiskelijankurssit.opiskelija_id=kayttajat.id AND ryhmat.projekti_id='" . $pid . "' ORDER BY sukunimi, etunimi")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($haek = $kaikkiryhmat2->fetch_assoc()) {
                        array_push($ryhmatkaikki, $haek[id]);
                    }
                    //tyhjät mukaan
                    if (!empty($tyhjatryhmat)) {
                        foreach ($tyhjatryhmat as $onid2) {
                            array_push($ryhmatkaikki, $onid2);
                        }
                    }

                    if (!empty($ryhmatkaikki)) {
                        if (!$ryhmatiedot = $db->query("select distinct lopullinen from ryhmat where projekti_id='" . $pid . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        while ($rowRT = $ryhmatiedot->fetch_assoc()) {
                            $rlopullinen = $rowRT[lopullinen];
                        }
                        echo'<div class="cm8-margin-top"></div>';
                        if ($rlopullinen == 1) {


                            echo '<h2  style="color: #f7f9f7; text-decoration: underline;  font-size: 1.4em; padding-top: 30px; display:inline-block">Lopulliset ryhmät:</h2>';
                        } else {

                            echo '<h2  style="color: #f7f9f7; text-decoration: underline;  font-size: 1.4em; padding-top: 30px; display:inline-block; padding-bottom: 0px">Ryhmät:</h2>';
                        }
                        if ($palautus == 1) {


                            echo'<button onclick="tarkistaLinkki(' . $pid . ')" class="myButtonLataa" style="font-size: 1.2em; padding: 8px; margin-left: 60px" title="Lataa kaikki tiedostot (linkkejä ei voida ladata)"><i class="fa fa-download" style="font-size:18px; margin-right: 10px"></i> Lataa kaikki tiedostot (linkkejä ei voida ladata)</button>';
                        }

                        if ($opmaksimi == 1 && $haeryhmat->num_rows != 0) {
                            echo'<p style="color: #c7ef00; padding-top: 10px">Koska ryhmissä on vain 1 opiskelija, niin ryhmät listataan aakkosjärjestyksessä.</p>';
                        }$aika = microtime(true);
                        echo'<p id="ohje" style="margin-top: 20px; ">Klikkaamalla opiskelijan nimeä pääset käyttäjäprofiiliin.</p><br>';
                        foreach ($ryhmatkaikki as $onid) {

                            if (!$result = $db->query("select distinct * from ryhmat where id='" . $onid . "'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }
                            $ryhmienlkm = count($ryhmatkaikki);

                            if ($ryhmienlkm > 0) {

                                if (!$ryhmatiedot = $db->query("select distinct lopullinen from ryhmat where projekti_id='" . $pid . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                while ($rowRT = $ryhmatiedot->fetch_assoc()) {
                                    $rlopullinen = $rowRT[lopullinen];
                                }

                                // KÄYDÄÄN RYHMÄT LÄPI

                                while ($row = $result->fetch_assoc()) {


                                    //kun ei lopulliset ryhmät
                                    if ($row[lopullinen] == 0) {



                                        echo'<div class="cm8-responsive" style="width: 90%; background-color: #272227; color: #f7f9f7" >';
                                        echo '<table class="cm8-tabler" style="table-layout:fixed; width: 100%; overflow-y: hidden; overflow-x:auto;">';
                                        echo '<tr id=' . $row[id] . ' style="background-color:red"><th>' . $row[nimi] . "</th>";

                                        if (!$ryhmanopiskelijat2 = $db->query("select distinct * from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ryhma_id='" . $row[id] . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }

                                        if ($row[suljettu] == 0 && $ryhmanopiskelijat2->num_rows < $opmaksimi && $ryhmienlkm > 1)
                                            echo '<th><a href="liitaryhmaan.php?pid=' . $pid . '&id=' . $row[id] . '" style="margin-right: 30px; margin-bottom: 0px; padding: 2px 6px" title="Liitä opiskelija ryhmään" class="myButton8"  role="button" >+ Liitä</a> <a href="suljeryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-right: 30px; margin-bottom: 0px; padding: 2px 6px" title="Sulje ryhmä">&#9746 Sulje</a> <a href="poistaryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Poista ryhmä"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</a>' . "</th>";

                                        // TSEKKAA TÄSTÄ NAPPULAT
                                        if ($row[suljettu] == 0 && $ryhmanopiskelijat2->num_rows >= $opmaksimi && $ryhmienlkm > 1)
                                            echo'<th><a href="suljeryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-right: 30px; margin-bottom: 0px; padding: 2px 6px" title="Sulje ryhmä">&#9746 Sulje</a> <a href="poistaryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Poista ryhmä"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</a>' . "</th>";

                                        if ($row[suljettu] == 0 && $ryhmanopiskelijat2->num_rows < $opmaksimi && $ryhmienlkm == 1)
                                            echo '<th><a href="liitaryhmaan.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-right: 30px; margin-bottom: 0px;padding: 2px 6px" title="Liitä opiskelija ryhmään" ">+ Liitä</a> <a href="suljeryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Sulje ryhmä">&#9746 Sulje</a>' . "</th>";

                                        if ($row[suljettu] == 0 && $ryhmanopiskelijat2->num_rows >= $opmaksimi && $ryhmienlkm == 1)
                                            echo'<th><a href="suljeryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Sulje ryhmä">&#9746 Sulje</a>' . "</th>";

                                        else if ($row[suljettu] == 1 && $ryhmienlkm > 1)
                                            echo '<th><a href="avaa.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-right: 30px; margin-bottom: 0px; padding: 2px 6px" title="Avaa ryhmä">&#9745 Avaa</a> <a href="poistaryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Poista ryhmä"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</a>' . "</th>";
                                        else if ($row[suljettu] == 1 && $ryhmienlkm == 1)
                                            echo '<th><a href="avaa.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Avaa ryhmä">&#9745 Avaa</a>' . "</th>";


                                        echo'</tr>';

                                        $ryhmaid = $row[id];

                                        if (!$result2 = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from ryhmat, kayttajat, opiskelijankurssit where kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.ryhma_id='" . $ryhmaid . "' AND kayttajat.rooli <> 'admin' ORDER BY sukunimi, etunimi")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        //jos liittyneitä opiskelijoita
                                        if ($result2->num_rows != 0) {
                                            while ($row2 = $result2->fetch_assoc()) {
                                                echo '<tr style="border: 2px solid grey"><td ><a href="kayttaja.php?url=' . $urlmihin . '&ka=' . $row2[kaid] . '&r=' . $pid . '" style="padding: 2px 6px; margin-left: 60 px" title="Näytä käyttäjäprofiili">' . $row2[etunimi] . " " . $row2[sukunimi] . '</a><a href="poista.php?pid=' . $pid . '&oid=' . $row2[kaid] . '&ryid=' . $ryhmaid . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px; margin-left: 30px" title="Poista opiskelija ryhmästä">&#10007</a></td><td></td></tr>';
                                            }
                                        }


                                        echo "</table>";


                                        if ($row[suljettu] == 1)
                                            echo'<br><em style="font-size:0.8em; margin-left: 5px">Tämä ryhmä on suljettu</em><br>';



                                        if ($palautus == 1) {



                                            if (!$haetyotope2 = $db->query("select distinct ryhmat2.palaute_tallennettu as tall, ryhmat2.palaute as palaute, linkki, lisayspvm, omatallennusnimi, tallennettunimi, tyonimi, ryhmat2.id as tyoid from ryhmat2, opiskelijankurssit, opiskelijan_kurssityot where opiskelijan_kurssityot.projekti_id='" . $pid . "' AND opiskelijan_kurssityot.kayttaja_id=opiskelijankurssit.opiskelija_id AND opiskelijan_kurssityot.ryhmat2_id = ryhmat2.id  AND opiskelijankurssit.ryhma_id='" . $ryhmaid . "'")) {
                                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                            }
                                          
                                            if ($haetyotope2->num_rows != 0) {
                                                
                                                echo'<div class="cm8-margin-left"><br>';
                                                echo '<h2 style="color: #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 10px">Palautetut tiedostot:</h2>';



                                                $nyt = date("Y-m-d H:i");
                                              
                                                if ($haetyotope2->num_rows != 0) {
                                                    echo '<table class="cm8-table3" >';
                                                    echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th >Tiedosto</th><th>Palautettu</th><th >Opettajan kommentti</th><th>Poista</th></tr>';

                                                    while ($rowt22 = $haetyotope2->fetch_assoc()) {
                                                        $tallnimi2 = $rowt22[omatallennusnimi];
                                                        $tyoid2 = $rowt22[tyoid];

                                                        $linkki = $rowt22[linkki];
                                                        $tall = $rowt22[tall];
                                                        $palautettu = $rowt22[lisayspvm];
                                                        $palautuspaiva = substr($rowt22[lisayspvm], 0, 10);
                                                        $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                                        $palautuskello = substr($rowt22[lisayspvm], 11, 5);
                                                        $rowt22[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;

                                                        $rowt22[palaute] = str_replace('<br />', "", $rowt22[palaute]);
                                                        if ($tall == 1) {
                                                            if ($linkki == 1) {
                                                                echo'<tr id="' . $rowt22[tyoid] . '"><td ><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt22[tyonimi] . '</a></p></td><td><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki">' . $rowt22[omatallennusnimi] . '</a></td><td>' . $rowt22[lisayspvm];
                                                                if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                                    echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                                }

                                                                echo'</td><td><form action="muokkaapalaute.php" method="post" >' . $rowt22[palaute] . '<input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="&#9998 Muokkaa" class="myButton8" role="button" style="padding:2px 4px; margin-left: 10px"></form></td>';
                                                            } else {
                                                                echo '<tr id="' . $rowt22[tyoid] . '"><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt22[tyonimi] . '</a></td><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . ' target="_blank">' . $tallnimi2 . '</a></td><td>' . $rowt22[lisayspvm];
                                                                if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                                    echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                                }
                                                                echo'</td><td><form action="muokkaapalaute.php" method="post" >' . $rowt22[palaute] . '<input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="&#9998 Muokkaa" class="myButton8" role="button" style="padding:2px 4px; margin-left: 10px"></form></td>';
                                                            }
                                                        } else {
                                                            if ($linkki == 1) {
                                                                echo'<tr id="' . $rowt22[tyoid] . '"><td ><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt22[tyonimi] . '</a></p></td><td><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki">' . $rowt22[omatallennusnimi] . '</a></td><td>' . $rowt22[lisayspvm];

                                                                if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                                    echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                                }
                                                                //loppu alle
                                                                echo '</td><td><b  style="font-weight: normal; color: red">Kommenttien tallennus lähettää automaattisesti kommentin sisällön ryhmän opiskelijoiden sähköpostiin.</b><br><br><form action="tallennapalaute.php" method="post" ><textarea name="palaute" rows="2" style="display: inline-block">' . $rowt22[palaute] . '</textarea><input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="Tallenna" class="myButton8" role="button" style="padding:2px 4px; margin-top: 5px"></form></td>';
                                                            } else {
                                                                echo '<tr id="' . $rowt22[tyoid] . '"><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . '><b style="font-size: 0.9em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt22[tyonimi] . '</a></td><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . ' target="_blank">' . $tallnimi2 . '</a></td><td>' . $rowt22[lisayspvm];

                                                                if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                                    echo'<br><em style="color: red; font-weight: bold">Palautettu myöhässä!</em>';
                                                                }

                                                                //loppu alle
                                                                echo'</td><td><b  style="font-weight: normal; color: red">Kommentin tallennus lähettää kommentin sisällön ryhmän opiskelijoiden sähköpostiin.</b><br><br><form action="tallennapalaute.php" method="post" ><textarea name="palaute" rows="2" style="display: inline-block">' . $rowt22[palaute] . '</textarea><input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="Tallenna" class="myButton8" role="button" style="padding:2px 4px; margin-top: 5px"></form></td>';
                                                            }
                                                        }
                                                        echo'<td><form action="poistovarmistus.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="ryid" value=' . $ryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $rowt22[tyoid] . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                                    }
                                                    echo "</table>";
                                                }

                                                // tähän palautus


                                                echo "</div>";
                                            }
                                        }

                                        // tähän open tiedostot

                                        if (!$haetyot = $db->query("select distinct * from ryhmatope where ryhma_id='" . $ryhmaid . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        echo'<div class="cm8-margin-left"><br>';
                                        if ($haetyot->num_rows != 0) {

                                            echo '<h2 style="color:   #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 10px">Ryhmälle lisätyt tiedostot:</h2>';

                                            if ($haetyot->num_rows != 0) {



                                                echo '<table class="cm8-table3">';
                                                echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th>Tiedosto</th><th>Palautettu</th><th>Muokkaa / Poista</th></tr>';

                                                while ($rowt = $haetyot->fetch_assoc()) {
                                                    $tallnimi = $rowt[omatallennusnimi];
                                                    $tyoid = $rowt[id];
                                                    $linkki = $rowt[linkki];
                                                    $palautettu = $rowt[lisayspvm];
                                                    $palautuspaiva = substr($rowt[lisayspvm], 0, 10);
                                                    $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                                    $palautuskello = substr($rowt[lisayspvm], 11, 5);
                                                    $rowt[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;
                                                    $rowt[palaute] = str_replace('<br />', "", $rowt[palaute]);
                                                    if ($linkki == 1) {
                                                        echo'<tr><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt[tyonimi] . '</p></a></td><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki">' . $rowt[omatallennusnimi] . '</a></td><td>' . $rowt[lisayspvm] . '</td>';


                                                        echo'<td><form action="muokkaa_tiedosto_ope.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $ryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form> <form action="poistovarmistusope.php" method="post" style="display: inline-block"><input type="hidden" name="ryid" value=' . $ryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $tyoid . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                                    } else {
                                                        echo '<tr><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt[tyonimi] . '</a></td><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . ' target="_blank">' . $tallnimi . '</a></td><td>' . $rowt[lisayspvm] . '</td>';

                                                        echo'<td><form action="muokkaa_tiedosto_ope.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $ryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form><form action="poistovarmistusope.php" method="post" style="display: inline-block"><input type="hidden" name="ryid" value=' . $ryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $tyoid . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                                    }
                                                }
                                                echo "</table>";
                                            }
                                        }

                                        if ($result2->num_rows != 0) {
                                            echo'<br><form action="tiedosto_ope.php" method="post" style="margin-bottom: 10px"><input type="hidden" name="ryid" value=' . $ryhmaid . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" class="myButton8" name="painike" value="&#9763 Lisää ryhmään tiedosto" style="font-size: 0.7em; margin-right: 30px; padding: 2px"></form>';
                                        }

                                        echo'</div>';
                                        echo"</div>";

                                        echo'<div class="cm8-margin-top"><br></div>';
                                    } else {

                                        echo'<div class="cm8-responsive" style="width: 90%; background-color: #272227; color: #f7f9f7" >';
                                        echo '<table class="cm8-tabler" style="table-layout:fixed; width: 100%; overflow-y: hidden; overflow-x:auto;">';
                                        echo '<tr id=' . $row[id] . ' style="background-color:red"><th colspan="2">' . $row[nimi] . "</th></tr>";

                                        if (!$ryhmanopiskelijat2 = $db->query("select distinct * from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ryhma_id='" . $row[id] . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }


                                        $ryhmaid = $row[id];

                                        if (!$result2 = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from ryhmat, kayttajat, opiskelijankurssit where kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.ryhma_id='" . $ryhmaid . "' AND kayttajat.rooli <> 'admin' ORDER BY sukunimi, etunimi")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        //jos liittyneitä opiskelijoita
                                        if ($result2->num_rows != 0) {
                                            while ($row2 = $result2->fetch_assoc()) {
                                                echo '<tr style="border: 2px solid grey"><td ><a href="kayttaja.php?url=' . $urlmihin . '&ka=' . $row2[kaid] . '&r=' . $pid . '" style="padding: 2px 6px; margin-left: 60 px" title="Näytä käyttäjäprofiili">' . $row2[etunimi] . " " . $row2[sukunimi] . '</a><a href="poista.php?pid=' . $pid . '&oid=' . $row2[kaid] . '&ryid=' . $ryhmaid . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px; margin-left: 30px" title="Poista opiskelija ryhmästä">&#10007</a></td><td></td></tr>';
                                            }
                                        }




                                        echo "</table>";



                                        if ($palautus == 1) {




                                            if (!$haetyotope2 = $db->query("select distinct ryhmat2.palaute_tallennettu as tall, ryhmat2.palaute as palaute, linkki, lisayspvm, omatallennusnimi, tallennettunimi, tyonimi, ryhmat2.id as tyoid from ryhmat2, opiskelijankurssit, opiskelijan_kurssityot where opiskelijan_kurssityot.projekti_id='" . $pid . "' AND opiskelijan_kurssityot.kayttaja_id=opiskelijankurssit.opiskelija_id AND opiskelijan_kurssityot.ryhmat2_id = ryhmat2.id  AND opiskelijankurssit.ryhma_id='" . $ryhmaid . "'")) {
                                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                            }

                                            if ($haetyotope2->num_rows != 0) {
                                                echo'<div class="cm8-margin-left"><br>';
                                                echo '<h2 style="color: #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 10px">Palautetut tiedostot:</h2>';


                                                
                                                $nyt = date("Y-m-d H:i");
                                                if ($haetyotope2->num_rows != 0) {
                                                    echo '<table class="cm8-table3" >';
                                                    echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th >Tiedosto</th><th>Palautettu</th><th >Opettajan kommentti</th><th>Poista</th></tr>';

                                                    while ($rowt22 = $haetyotope2->fetch_assoc()) {
                                                        $tallnimi2 = $rowt22[omatallennusnimi];
                                                        $tyoid2 = $rowt22[tyoid];

                                                        $linkki = $rowt22[linkki];
                                                        $tall = $rowt22[tall];
                                                        $palautettu = $rowt22[lisayspvm];
                                                        $palautuspaiva = substr($rowt22[lisayspvm], 0, 10);
                                                        $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                                        $palautuskello = substr($rowt22[lisayspvm], 11, 5);
                                                        $rowt22[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;

                                                        $rowt22[palaute] = str_replace('<br />', "", $rowt22[palaute]);
                                                        if ($tall == 1) {
                                                            if ($linkki == 1) {
                                                                echo'<tr id="' . $rowt22[tyoid] . '"><td ><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt22[tyonimi] . '</a></p></td><td><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki">' . $rowt22[omatallennusnimi] . '</a></td><td>' . $rowt22[lisayspvm];
                                                                if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                                    echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                                }

                                                                echo'</td><td><form action="muokkaapalaute.php" method="post" >' . $rowt22[palaute] . '<input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="&#9998 Muokkaa" class="myButton8" role="button" style="padding:2px 4px; margin-left: 10px"></form></td>';
                                                            } else {
                                                                echo '<tr id="' . $rowt22[tyoid] . '"><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt22[tyonimi] . '</a></td><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . ' target="_blank">' . $tallnimi2 . '</a></td><td>' . $rowt22[lisayspvm];
                                                                if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                                    echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                                }
                                                                echo'</td><td><form action="muokkaapalaute.php" method="post" >' . $rowt22[palaute] . '<input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="&#9998 Muokkaa" class="myButton8" role="button" style="padding:2px 4px; margin-left: 10px"></form></td>';
                                                            }
                                                        } else {
                                                            if ($linkki == 1) {
                                                                echo'<tr id="' . $rowt22[tyoid] . '"><td ><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt22[tyonimi] . '</a></p></td><td><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki">' . $rowt22[omatallennusnimi] . '</a></td><td>' . $rowt22[lisayspvm];

                                                                if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                                    echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                                }
                                                                //loppu alle
                                                                echo '</td><td><b  style="font-weight: normal; color: red">Kommenttien tallennus lähettää automaattisesti kommentin sisällön ryhmän opiskelijoiden sähköpostiin.</b><br><br><form action="tallennapalaute.php" method="post" ><textarea name="palaute" rows="2" style="display: inline-block">' . $rowt22[palaute] . '</textarea><input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="Tallenna" class="myButton8" role="button" style="padding:2px 4px; margin-top: 5px"></form></td>';
                                                            } else {
                                                                echo '<tr id="' . $rowt22[tyoid] . '"><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt22[tyonimi] . '</a></td><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . ' target="_blank">' . $tallnimi2 . '</a></td><td>' . $rowt22[lisayspvm];

                                                                if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                                    echo'<br><em style="color: red; font-weight: bold">Palautettu myöhässä!</em>';
                                                                }

                                                                //loppu alle
                                                                echo'</td><td><b  style="font-weight: normal; color: red">Kommenttien tallennus lähettää automaattisesti kommentin sisällön ryhmän opiskelijoiden sähköpostiin.</b><br><br><form action="tallennapalaute.php" method="post" ><textarea name="palaute" rows="2" style="display: inline-block">' . $rowt22[palaute] . '</textarea><input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="Tallenna" class="myButton8" role="button" style="padding:2px 4px; margin-top: 5px"></form></td>';
                                                            }
                                                        }
                                                        echo'<td><form action="poistovarmistus.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="ryid" value=' . $ryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $rowt22[tyoid] . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                                    }
                                                    echo "</table>";
                                                }

                                                echo "</div>";
                                            }


                                            // tähän palautus
                                        }

                                        // tähän open tiedostot

                                        if (!$haetyot = $db->query("select distinct * from ryhmatope where ryhma_id='" . $ryhmaid . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        echo'<div class="cm8-margin-left"><br>';
                                        if ($haetyot->num_rows != 0) {
                                            echo '<h2 style="color:   #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 10px">Ryhmälle lisätyt tiedostot:</h2>';


                                            if ($haetyot->num_rows != 0) {


                                                echo '<table class="cm8-table3">';
                                                echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th>Tiedosto</th><th>Palautettu</th><th>Muokkaa / Poista</th></tr>';

                                                while ($rowt = $haetyot->fetch_assoc()) {
                                                    $tallnimi = $rowt[omatallennusnimi];
                                                    $tyoid = $rowt[id];
                                                    $linkki = $rowt[linkki];
                                                    $palautettu = $rowt[lisayspvm];
                                                    $palautuspaiva = substr($rowt[lisayspvm], 0, 10);
                                                    $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                                    $palautuskello = substr($rowt[lisayspvm], 11, 5);
                                                    $rowt[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;
                                                    $rowt[palaute] = str_replace('<br />', "", $rowt[palaute]);
                                                    if ($linkki == 1) {
                                                        echo'<tr><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt[tyonimi] . '</a></p></td><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki">' . $rowt[omatallennusnimi] . '</a></td><td>' . $rowt[lisayspvm] . '</td>';


                                                        echo'<td><form action="muokkaa_tiedosto_ope.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $ryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form> <form action="poistovarmistusope.php" method="post" style="display: inline-block"><input type="hidden" name="ryid" value=' . $ryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $tyoid . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                                    } else {
                                                        echo '<tr><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt[tyonimi] . '</a></td><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . ' target="_blank">' . $tallnimi . '</a></td><td>' . $rowt[lisayspvm] . '</td>';

                                                        echo'<td><form action="muokkaa_tiedosto_ope.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $ryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form><form action="poistovarmistusope.php" method="post" style="display: inline-block"><input type="hidden" name="ryid" value=' . $ryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $tyoid . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                                    }
                                                }
                                                echo "</table>";
                                            }
                                        }

                                        if ($result2->num_rows != 0) {
                                            echo'<br><form action="tiedosto_ope.php" method="post" style="margin-bottom: 10px"><input type="hidden" name="ryid" value=' . $ryhmaid . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" class="myButton8" name="painike" value="&#9763 Lisää ryhmään tiedosto" style="font-size: 0.7em; margin-right: 30px; padding: 2px"></form>';
                                        }


                                        echo'</div>';


                                        echo"</div>";

                                        echo'<div class="cm8-margin-top"><br></div>';
                                    }
                                }
                            }
                        }
                        $aika2 = microtime(true) - $aika;
                    }


                    if (!$lopulliset = $db->query("select * from ryhmat where projekti_id='" . $pid . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    if ($lopulliset->num_rows > 0) {

                        if (!$maara = $db->query("select * from ryhmat where projekti_id='" . $pid . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        if ($maara->num_rows < $ryhmienmaksimi && $rlopullinen == 0)
                            echo '<form action="lisaaryhmakasa2.php" method="post"><input type="hidden" name="id" value=' . $pid . '> <input type="submit" value="+ Lisää uusi ryhmä" id="lisaa" class="myButton8"  role="button"  style="padding: 4px 6px; font-size: 0.9em"></form><br><br>';


                        if (!$resultvailla = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND opiskelijankurssit.projekti_id='" . $pid . "' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.ryhma_id=0 AND kayttajat.rooli='opiskelija' ORDER BY sukunimi, etunimi")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        echo "<br>";

                        if ($resultvailla->num_rows != 0) {
                            echo'<div class="cm8-border-top" style="width: 70%; padding-bottom: 20px; "></div>';
                            echo'<br><b style="color: #f7f9f7">Seuraavat opiskelijat eivät ole missään ryhmässä: </b><br><br>';

                            echo '<table class="cm8-tablevailla" style="margin-left: 0px;"><thead>';
                            echo '<tr ><th>Etunimi</th><th>Sukunimi</th></tr></thead><tbody>';

                            while ($rowvailla = $resultvailla->fetch_assoc()) {
                                echo'<tr><td><a href="kayttaja.php?url=' . $urlmihin . '&ka=' . $rowvailla[kaid] . '&r=' . $pid . '" style="padding: 2px 6px; margin-left: 60 px" title="Näytä käyttäjäprofiili">' . $rowvailla[etunimi] . "</td><td>" . $rowvailla[sukunimi] . "</a></td></tr>";
                            }
                            echo "</tbody></table>";


                            if ($rlopullinen == 0) {
                                if ($tarkkamaara != 0) {


                                    echo'<form action="arvo2.php" method="post"><input type="hidden" name="pid" value=' . $pid . '><input type="submit" name="painike" value="&#9763 Arvo nämä opiskelijat ryhmiin" class="myButton9"  role="button"  style="padding:2px 4px; font-size: 0.8em"></form>';
                                } else {
                                    echo'<form action="arvo.php" method="post"><input type="hidden" name="pid" value=' . $pid . '><input type="submit" name="painike" value="&#9763 Arvo nämä opiskelijat ryhmiin" class="myButton9"  role="button"  style="padding:2px 4px; font-size: 0.8em"></form>';
                                }
                            }
                        } else {

                            if (!$opiskelijattaas = $db->query("select distinct * from kayttajat, opiskelijankurssit where opiskelijankurssit.projekti_id='" . $pid . "' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kayttajat.rooli='opiskelija' ORDER BY sukunimi, etunimi")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }

                            if ($opiskelijattaas->num_rows != 0) {
                                echo'<div class="cm8-border-top" style="width: 70%; padding-bottom: 30px; "></div>';
                                echo'<br><b><em>Kaikki kurssille/opintojaksolle liittyneet opiskelijat ovat jossain ryhmässä.</em></b><br><br>';
                            }
                        }
                        if ($palautus == 1) {
                            $onko = 0;

                            if (!$resulthae = $db->query("select distinct opiskelija_id as oid from opiskelijankurssit, kayttajat where opiskelijankurssit.projekti_id='" . $pid . "' AND opiskelijankurssit.opiskelija_id=kayttajat.id AND kayttajat.rooli='opiskelija'")) {

                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }

                            while ($rowhae = $resulthae->fetch_assoc()) {

                                $oid = $rowhae[oid];
                                if (!$resulttyot = $db->query("select distinct id from opiskelijan_kurssityot where kayttaja_id='" . $oid . "' AND projekti_id='" . $pid . "'")) {

                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                //ei ole palauttanut

                                if ($resulttyot->num_rows == 0) {

                                    $onko = 1;
                                }
                            }
                            if (!$onkoketaan = $db->query("select distinct opiskelija_id as oid from opiskelijankurssit, kayttajat where opiskelijankurssit.projekti_id='" . $pid . "' AND opiskelijankurssit.opiskelija_id=kayttajat.id AND kayttajat.rooli='opiskelija'")) {

                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }

                            if ($onkoketaan->num_rows == 0) {
                                $onkoketaan = 0;
                            } else {
                                $onkoketaan = 1;
                            }

                            if ($onko == 1) {
                                echo'<br><br><b style="color: #f7f9f7;">Seuraavat opiskelijat eivät ole palauttaneet tiedostoa: </b><br><br>';

                                echo '<table class="cm8-tablevailla" style="margin-left: 0px"><thead>';
                                echo '<tr><th>Etunimi</th><th>Sukunimi</th></tr></thead><tbody>';



                                if (!$resulthae = $db->query("select distinct opiskelija_id as oid from opiskelijankurssit where projekti_id='" . $pid . "'")) {

                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                while ($rowhae = $resulthae->fetch_assoc()) {

                                    $oid = $rowhae[oid];
                                    if (!$resulttyot = $db->query("select distinct id from opiskelijan_kurssityot where kayttaja_id='" . $oid . "' AND projekti_id='" . $pid . "'")) {

                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }
                                    //ei ole palauttanut

                                    if ($resulttyot->num_rows == 0) {
                                        if (!$resultei = $db->query("select distinct sukunimi, etunimi, id as kid from kayttajat where id = '" . $oid . "' AND rooli='opiskelija'")) {

                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }

                                        while ($rowhae2 = $resultei->fetch_assoc()) {

                                            echo '<tr><td><a href="kayttaja.php?url=' . $urlmihin . '&ka=' . $rowhae2[kid] . '&r=' . $pid . '" style="padding: 2px 6px; margin-left: 60 px" title="Näytä käyttäjäprofiili">' . $rowhae2[etunimi] . "</td><td>" . $rowhae2[sukunimi] . "</a></td></tr>";
                                        }
                                    }
                                }

                                echo "</tbody></table>";
                            } else {
                                if ($onkoketaan == 1)
                                    echo'<br><b style="color: #f7f9f7;"><em>Kaikki opiskelijat ovat tehneet palautuksen. </em></b><br><br>';
                            }
                        }
                        echo'</div>';
                    }




                    //neljäsosa kiinni
                    echo "</div>";
                } else {
                    if (!$result = $db->query("select distinct * from ryhmat where projekti_id='" . $pid . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }


                    $ryhmienlkm = $result->num_rows;

                    if ($ryhmienlkm > 0) {

                        if (!$ryhmatiedot = $db->query("select distinct lopullinen from ryhmat where projekti_id='" . $pid . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        while ($rowRT = $ryhmatiedot->fetch_assoc()) {
                            $rlopullinen = $rowRT[lopullinen];
                        }
                        echo'<div class="cm8-margin-top"></div>';
                        if ($rlopullinen == 1) {


                            echo '<h2  style="color: #f7f9f7; text-decoration: underline;  font-size: 1.4em; padding-top: 30px; display:inline-block">Lopulliset ryhmät:</h2>';
                        } else {

                            echo '<h2  style="color: #f7f9f7; text-decoration: underline;  font-size: 1.4em; padding-top: 30px; display:inline-block; padding-bottom: 0px">Ryhmät:</h2>';
                        }
                        if ($palautus == 1) {

                            echo'<button onclick="tarkistaLinkki(' . $pid . ')" class="myButtonLataa"  style="font-size: 1.2em; padding: 8px; margin-left: 60px" title="Lataa kaikki tiedostot (linkkejä ei voida ladata)"><i class="fa fa-download" style="font-size:18px; margin-right: 10px"></i> Lataa kaikki tiedostot (linkkejä ei voida ladata)</button>';
                        }
                        if ($opmaksimi == 1) {
                            echo'<p style="color: #c7ef00">Koska ryhmissä on vain 1 opiskelija, niin ryhmät listataan aakkosjärjestyksessä.</p>';
                        }
                        echo'<p id="ohje" style="">Klikkaamalla opiskelijan nimeä pääset käyttäjäprofiiliin.</p><br>';

                        // KÄYDÄÄN RYHMÄT LÄPI

                        while ($row = $result->fetch_assoc()) {


                            //kun ei lopulliset ryhmät
                            if ($row[lopullinen] == 0) {


                                echo'<div class="cm8-responsive" style="width: 90%; background-color: #272227; color: #f7f9f7" >';
                                echo '<table class="cm8-tabler" style="table-layout:fixed; width: 100%; overflow-y: hidden; overflow-x:auto;">';
                                echo '<tr id=' . $row[id] . '><th>' . $row[nimi] . "</th>";

                                if (!$ryhmanopiskelijat2 = $db->query("select distinct * from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ryhma_id='" . $row[id] . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                if ($row[suljettu] == 0 && $ryhmanopiskelijat2->num_rows < $opmaksimi && $ryhmienlkm > 1)
                                    echo '<th><a href="liitaryhmaan.php?pid=' . $pid . '&id=' . $row[id] . '" style="margin-right: 30px; margin-bottom: 0px; padding: 2px 6px" title="Liitä opiskelija ryhmään" class="myButton8"  role="button" >+ Liitä</a> <a href="suljeryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-right: 30px; margin-bottom: 0px; padding: 2px 6px" title="Sulje ryhmä">&#9746 Sulje</a> <a href="poistaryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Poista ryhmä"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</a>' . "</th>";

                                if ($row[suljettu] == 0 && $ryhmanopiskelijat2->num_rows >= $opmaksimi && $ryhmienlkm > 1)
                                    echo'<th><a href="suljeryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-right: 30px; margin-bottom: 0px; padding: 2px 6px" title="Sulje ryhmä">&#9746 Sulje</a> <a href="poistaryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Poista ryhmä"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</a>' . "</th>";

                                if ($row[suljettu] == 0 && $ryhmanopiskelijat2->num_rows < $opmaksimi && $ryhmienlkm == 1)
                                    echo '<th><a href="liitaryhmaan.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-right: 30px; margin-bottom: 0px;padding: 2px 6px" title="Liitä opiskelija ryhmään" ">+ Liitä</a> <a href="suljeryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Sulje ryhmä">&#9746 Sulje</a>' . "</th>";

                                if ($row[suljettu] == 0 && $ryhmanopiskelijat2->num_rows >= $opmaksimi && $ryhmienlkm == 1)
                                    echo'<th><a href="suljeryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Sulje ryhmä">&#9746 Sulje</a>' . "</th>";

                                else if ($row[suljettu] == 1 && $ryhmienlkm > 1)
                                    echo '<th><a href="avaa.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-right: 30px; margin-bottom: 0px; padding: 2px 6px" title="Avaa ryhmä">&#9745 Avaa</a> <a href="poistaryhma.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Poista ryhmä"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</a>' . "</th>";
                                else if ($row[suljettu] == 1 && $ryhmienlkm == 1)
                                    echo '<th><a href="avaa.php?pid=' . $pid . '&id=' . $row[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Avaa ryhmä">&#9745 Avaa</a>' . "</th>";


                                echo'</tr>';

                                $ryhmaid = $row[id];

                                if (!$result2 = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from ryhmat, kayttajat, opiskelijankurssit where kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.ryhma_id='" . $ryhmaid . "' AND kayttajat.rooli <> 'admin' ORDER BY sukunimi, etunimi")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                //jos liittyneitä opiskelijoita
                                if ($result2->num_rows != 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        echo '<tr style="border: 2px solid grey"><td ><a href="kayttaja.php?url=' . $urlmihin . '&ka=' . $row2[kaid] . '&r=' . $pid . '" style="padding: 2px 6px; margin-left: 60 px" title="Näytä käyttäjäprofiili">' . $row2[etunimi] . " " . $row2[sukunimi] . '</a><a href="poista.php?pid=' . $pid . '&oid=' . $row2[kaid] . '&ryid=' . $ryhmaid . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px; margin-left: 30px" title="Poista opiskelija ryhmästä">&#10007</a></td><td></td></tr>';
                                    }
                                }




                                echo "</table>";


                                if ($row[suljettu] == 1)
                                    echo'<br><em style="font-size:0.8em; margin-left: 5px">Tämä ryhmä on suljettu</em><br>';


                                if ($palautus == 1) {
                                    if (!$haetyotope2 = $db->query("select distinct ryhmat2.palaute_tallennettu as tall, ryhmat2.palaute as palaute, linkki, lisayspvm, omatallennusnimi, tallennettunimi, tyonimi, ryhmat2.id as tyoid from ryhmat2, opiskelijankurssit, opiskelijan_kurssityot where opiskelijan_kurssityot.projekti_id='" . $pid . "' AND opiskelijan_kurssityot.kayttaja_id=opiskelijankurssit.opiskelija_id AND opiskelijan_kurssityot.ryhmat2_id = ryhmat2.id  AND opiskelijankurssit.ryhma_id='" . $ryhmaid . "'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }

                                    if ($haetyotope2->num_rows != 0) {
                                        echo'<div class="cm8-margin-left"><br>';
                                        echo '<h2 style="color: #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 10px">Palautetut tiedostot:</h2>';


                                        $nyt = date("Y-m-d H:i");
                                        if ($haetyotope2->num_rows != 0) {
                                            echo '<table class="cm8-table3" >';
                                            echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th >Tiedosto</th><th>Palautettu</th><th >Opettajan kommentti</th><th>Poista</th></tr>';

                                            while ($rowt22 = $haetyotope2->fetch_assoc()) {
                                                $tallnimi2 = $rowt22[omatallennusnimi];
                                                $tyoid2 = $rowt22[tyoid];

                                                $linkki = $rowt22[linkki];
                                                $tall = $rowt22[tall];
                                                $palautettu = $rowt22[lisayspvm];
                                                $palautuspaiva = substr($rowt22[lisayspvm], 0, 10);
                                                $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                                $palautuskello = substr($rowt22[lisayspvm], 11, 5);
                                                $rowt22[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;

                                                $rowt22[palaute] = str_replace('<br />', "", $rowt22[palaute]);
                                                if ($tall == 1) {
                                                    if ($linkki == 1) {
                                                        echo'<tr id="' . $rowt22[tyoid] . '"><td ><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt22[tyonimi] . '</a></p><td><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki">' . $rowt22[omatallennusnimi] . '</a></td><td>' . $rowt22[lisayspvm];
                                                        if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                            echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                        }

                                                        echo'</td><td><form action="muokkaapalaute.php" method="post" >' . $rowt22[palaute] . '<input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="&#9998 Muokkaa" class="myButton8" role="button" style="padding:2px 4px; margin-left: 10px"></form></td>';
                                                    } else {
                                                        echo '<tr id="' . $rowt22[tyoid] . '"><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt22[tyonimi] . '</a></td><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . ' target="_blank">' . $tallnimi2 . '</a></td><td>' . $rowt22[lisayspvm];
                                                        if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                            echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                        }
                                                        echo'</td><td><form action="muokkaapalaute.php" method="post" >' . $rowt22[palaute] . '<input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="&#9998 Muokkaa" class="myButton8" role="button" style="padding:2px 4px; margin-left: 10px"></form></td>';
                                                    }
                                                } else {
                                                    if ($linkki == 1) {
                                                        echo'<tr id="' . $rowt22[tyoid] . '"><td ><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt22[tyonimi] . '</a></p></td><td><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki">' . $rowt22[omatallennusnimi] . '</a></td><td>' . $rowt22[lisayspvm];

                                                        if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                            echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                        }
                                                        //loppu alle
                                                        echo '</td><td><b  style="font-weight: normal; color: red">Kommenttien tallennus lähettää automaattisesti kommentin sisällön ryhmän opiskelijoiden sähköpostiin.</b><br><br><form action="tallennapalaute.php" method="post" ><textarea name="palaute" rows="2" style="display: inline-block">' . $rowt22[palaute] . '</textarea><input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="Tallenna" class="myButton8" role="button" style="padding:2px 4px; margin-top: 5px"></form></td>';
                                                    } else {
                                                        echo '<tr id="' . $rowt22[tyoid] . '"><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt22[tyonimi] . '</a></td><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . ' target="_blank">' . $tallnimi2 . '</a></td><td>' . $rowt22[lisayspvm];

                                                        if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                            echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                        }

                                                        //loppu alle
                                                        echo'</td><td><b  style="font-weight: normal; color: red">Kommenttien tallennus lähettää automaattisesti kommentin sisällön ryhmän opiskelijoiden sähköpostiin.</b><br><br><form action="tallennapalaute.php" method="post" ><textarea name="palaute" rows="2" style="display: inline-block">' . $rowt22[palaute] . '</textarea><input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="Tallenna" class="myButton8" role="button" style="padding:2px 4px; margin-top: 5px"></form></td>';
                                                    }
                                                }
                                                echo'<td><form action="poistovarmistus.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="ryid" value=' . $ryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $rowt22[tyoid] . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                            }
                                            echo "</table>";
                                        }
                                        echo'</div>';
                                    }

                                    // tähän palautus
                                }
                                // tähän open tiedostot

                                if (!$haetyot = $db->query("select distinct * from ryhmatope where ryhma_id='" . $ryhmaid . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }


                                echo'<div class="cm8-margin-left"><br>';
                                if ($haetyot->num_rows != 0) {
                                    echo '<h2 style="color:   #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 10px">Ryhmälle lisätyt tiedostot:</h2>';


                                    if ($haetyot->num_rows != 0) {


                                        echo '<table class="cm8-table3">';
                                        echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th>Tiedosto</th><th>Palautettu</th><th>Muokkaa / Poista</th></tr>';

                                        while ($rowt = $haetyot->fetch_assoc()) {
                                            $tallnimi = $rowt[omatallennusnimi];
                                            $tyoid = $rowt[id];
                                            $linkki = $rowt[linkki];
                                            $palautettu = $rowt[lisayspvm];
                                            $palautuspaiva = substr($rowt[lisayspvm], 0, 10);
                                            $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                            $palautuskello = substr($rowt[lisayspvm], 11, 5);
                                            $rowt[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;
                                            $rowt[palaute] = str_replace('<br />', "", $rowt[palaute]);
                                            if ($linkki == 1) {
                                                echo'<tr><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt[tyonimi] . '</a></p></td><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki">' . $rowt[omatallennusnimi] . '</a></td><td>' . $rowt[lisayspvm] . '</td>';


                                                echo'<td><form action="muokkaa_tiedosto_ope.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $ryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form> <form action="poistovarmistusope.php" method="post" style="display: inline-block"><input type="hidden" name="ryid" value=' . $ryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $tyoid . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                            } else {
                                                echo '<tr><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt[tyonimi] . '</a></td><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . ' target="_blank">' . $tallnimi . '</a></td><td>' . $rowt[lisayspvm] . '</td>';

                                                echo'<td><form action="muokkaa_tiedosto_ope.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $ryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form> <form action="poistovarmistusope.php" method="post" style="display: inline-block"><input type="hidden" name="ryid" value=' . $ryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $tyoid . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                            }
                                        }
                                        echo "</table>";
                                    }
                                }

                                if ($result2->num_rows != 0) {
                                    echo'<br><form action="tiedosto_ope.php" method="post" style="margin-bottom: 10px"><input type="hidden" name="ryid" value=' . $ryhmaid . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" class="myButton8" name="painike" value="&#9763 Lisää ryhmään tiedosto" style="font-size: 0.7em; margin-right: 30px; padding: 2px"></form>';
                                }

                                echo'</div>';
                                echo"</div>";

                                echo'<div class="cm8-margin-top"><br></div>';
                            } else {

                                echo'<div class="cm8-responsive" style="width: 90%; background-color: #272227; color: #f7f9f7" >';
                                echo '<table class="cm8-tabler" style="table-layout:fixed; width: 100%; overflow-y: hidden; overflow-x:auto;">';
                                echo '<tr id=' . $row[id] . ' style="background-color:red"><th colspan="2">' . $row[nimi] . "</th></tr>";

                                if (!$ryhmanopiskelijat2 = $db->query("select distinct * from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ryhma_id='" . $row[id] . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }


                                $ryhmaid = $row[id];

                                if (!$result2 = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from ryhmat, kayttajat, opiskelijankurssit where kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.ryhma_id='" . $ryhmaid . "' AND kayttajat.rooli <> 'admin' ORDER BY sukunimi, etunimi")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                //jos liittyneitä opiskelijoita
                                if ($result2->num_rows != 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        echo '<tr style="border: 2px solid grey"><td><a href="kayttaja.php?url=' . $urlmihin . '&ka=' . $row2[kaid] . '&r=' . $pid . '" style="padding: 2px 6px; margin-left: 60 px" title="Näytä käyttäjäprofiili">' . $row2[etunimi] . " " . $row2[sukunimi] . '</a><a href="poista.php?pid=' . $pid . '&oid=' . $row2[kaid] . '&ryid=' . $ryhmaid . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px; margin-left: 30px" title="Poista opiskelija ryhmästä">&#10007</a></td><td></td></tr>';
                                    }
                                }




                                echo "</table>";



                                if ($palautus == 1) {




                                    if (!$haetyotope2 = $db->query("select distinct ryhmat2.palaute_tallennettu as tall, ryhmat2.palaute as palaute, linkki, lisayspvm, omatallennusnimi, tallennettunimi, tyonimi, ryhmat2.id as tyoid from ryhmat2, opiskelijankurssit, opiskelijan_kurssityot where opiskelijan_kurssityot.projekti_id='" . $pid . "' AND opiskelijan_kurssityot.kayttaja_id=opiskelijankurssit.opiskelija_id AND opiskelijan_kurssityot.ryhmat2_id = ryhmat2.id  AND opiskelijankurssit.ryhma_id='" . $ryhmaid . "'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }
                                    if ($haetyotope2->num_rows != 0) {
                                        echo'<div class="cm8-margin-left"><br>';
                                        echo '<h2 style="color: #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 10px">Palautetut tiedostot:</h2>';

                                        $nyt = date("Y-m-d H:i");
                                        if ($haetyotope2->num_rows != 0) {
                                            echo '<table class="cm8-table3" >';
                                            echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th >Tiedosto</th><th>Palautettu</th><th >Opettajan kommentti</th><th>Poista</th></tr>';

                                            while ($rowt22 = $haetyotope2->fetch_assoc()) {
                                                $tallnimi2 = $rowt22[omatallennusnimi];
                                                $tyoid2 = $rowt22[tyoid];

                                                $linkki = $rowt22[linkki];
                                                $tall = $rowt22[tall];
                                                $palautettu = $rowt22[lisayspvm];
                                                $palautuspaiva = substr($rowt22[lisayspvm], 0, 10);
                                                $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                                $palautuskello = substr($rowt22[lisayspvm], 11, 5);
                                                $rowt22[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;

                                                $rowt22[palaute] = str_replace('<br />', "", $rowt22[palaute]);
                                                if ($tall == 1) {
                                                    if ($linkki == 1) {
                                                        echo'<tr id="' . $rowt22[tyoid] . '"><td ><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt22[tyonimi] . '</a></p></td><td><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki">' . $rowt22[omatallennusnimi] . '</a></td><td>' . $rowt22[lisayspvm];
                                                        if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                            echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                        }

                                                        echo'</td><td><form action="muokkaapalaute.php" method="post" >' . $rowt22[palaute] . '<input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="&#9998 Muokkaa" class="myButton8" role="button" style="padding:2px 4px; margin-left: 10px"></form></td>';
                                                    } else {
                                                        echo '<tr id="' . $rowt22[tyoid] . '"><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt22[tyonimi] . '</a></td><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . ' target="_blank">' . $tallnimi2 . '</a></td><td>' . $rowt22[lisayspvm];
                                                        if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                            echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                        }
                                                        echo'</td><td><form action="muokkaapalaute.php" method="post" >' . $rowt22[palaute] . '<input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="&#9998 Muokkaa" class="myButton8" role="button" style="padding:2px 4px; margin-left: 10px"></form></td>';
                                                    }
                                                } else {
                                                    if ($linkki == 1) {
                                                        echo'<tr id="' . $rowt22[tyoid] . '"><td ><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt22[tyonimi] . '</a></p></td><td><a href="' . $tallnimi2 . '" target="_blank" class="cm8-linkki">' . $rowt22[omatallennusnimi] . '</a></td><td>' . $rowt22[lisayspvm];

                                                        if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                            echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                        }
                                                        //loppu alle
                                                        echo '</td><td><b  style="font-weight: normal; color: red">Kommenttien tallennus lähettää automaattisesti kommentin sisällön ryhmän opiskelijoiden sähköpostiin.</b><br><br><form action="tallennapalaute.php" method="post" ><textarea name="palaute" rows="2" style="display: inline-block">' . $rowt22[palaute] . '</textarea><input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="Tallenna" class="myButton8" role="button" style="padding:2px 4px; margin-top: 5px"></form></td>';
                                                    } else {
                                                        echo '<tr id="' . $rowt22[tyoid] . '"><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt22[tyonimi] . '</a></td><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt22[tyoid] . ' target="_blank">' . $tallnimi2 . '</a></td><td>' . $rowt22[lisayspvm];

                                                        if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                            echo'<br><em style="color: red; font-weight: bold">Palautettu myöhässä!</em>';
                                                        }

                                                        //loppu alle
                                                        echo'</td><td><b  style="font-weight: normal; color: red">Kommenttien tallennus lähettää automaattisesti kommentin sisällön ryhmän opiskelijoiden sähköpostiin.</b><br><br><form action="tallennapalaute.php" method="post" ><textarea name="palaute" rows="2" style="display: inline-block">' . $rowt22[palaute] . '</textarea><input type="hidden" name="tyoid" value=' . $rowt22[tyoid] . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" value="Tallenna" class="myButton8" role="button" style="padding:2px 4px; margin-top: 5px"></form></td>';
                                                    }
                                                }
                                                echo'<td><form action="poistovarmistus.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="ryid" value=' . $ryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $rowt22[tyoid] . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                            }
                                            echo "</table>";
                                        }

                                        // tähän palautus


                                        echo "</div>";
                                    }
                                }

                                // tähän open tiedostot

                                if (!$haetyot = $db->query("select distinct * from ryhmatope where ryhma_id='" . $ryhmaid . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }


                                echo'<div class="cm8-margin-left"><br>';
                                if ($haetyot->num_rows != 0) {
                                    echo '<h2 style="color:   #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 10px">Ryhmälle lisätyt tiedostot:</h2>';

                                    if ($haetyot->num_rows != 0) {



                                        echo '<table class="cm8-table3">';
                                        echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th>Tiedosto</th><th>Palautettu</th><th>Muokkaa / Poista</th></tr>';

                                        while ($rowt = $haetyot->fetch_assoc()) {
                                            $tallnimi = $rowt[omatallennusnimi];
                                            $tyoid = $rowt[id];
                                            $linkki = $rowt[linkki];
                                            $palautettu = $rowt[lisayspvm];
                                            $palautuspaiva = substr($rowt[lisayspvm], 0, 10);
                                            $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                            $palautuskello = substr($rowt[lisayspvm], 11, 5);
                                            $rowt[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;
                                            $rowt[palaute] = str_replace('<br />', "", $rowt[palaute]);
                                            if ($linkki == 1) {
                                                echo'<tr><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt[tyonimi] . '</a></p></td><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki">' . $rowt[omatallennusnimi] . '</a></td><td>' . $rowt[lisayspvm] . '</td>';


                                                echo'<td><form action="muokkaa_tiedosto_ope.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $ryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form> <form action="poistovarmistusope.php" method="post" style="display: inline-block"><input type="hidden" name="ryid" value=' . $ryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $tyoid . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                            } else {
                                                echo '<tr><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt[tyonimi] . '</a></td><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . ' target="_blank">' . $tallnimi . '</a></td><td>' . $rowt[lisayspvm] . '</td>';

                                                echo'<td><form action="muokkaa_tiedosto_ope.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $ryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form><form action="poistovarmistusope.php" method="post" style="display: inline-block"><input type="hidden" name="ryid" value=' . $ryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $tyoid . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                            }
                                        }
                                        echo "</table>";
                                    }
                                }

                                if ($result2->num_rows != 0) {
                                    echo'<br><form action="tiedosto_ope.php" method="post" style="margin-bottom: 10px"><input type="hidden" name="ryid" value=' . $ryhmaid . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" class="myButton8" name="painike" value="&#9763 Lisää ryhmään tiedosto" style="font-size: 0.7em; margin-right: 30px; padding: 2px"></form>';
                                }


                                echo'</div>';
                                echo"</div>";

                                echo'<div class="cm8-margin-top"><br></div>';
                            }
                        }

                        if (!$lopulliset = $db->query("select * from ryhmat where projekti_id='" . $pid . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        if ($lopulliset->num_rows > 0) {

                            if (!$maara = $db->query("select * from ryhmat where projekti_id='" . $pid . "'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }

                            if ($maara->num_rows < $ryhmienmaksimi && $rlopullinen == 0)
                                echo '<form action="lisaaryhmakasa2.php" method="post"><input type="hidden" name="id" value=' . $pid . '> <input type="submit" value="+ Lisää uusi ryhmä" id="lisaa" class="myButton8"  role="button"  style="padding: 4px 6px; font-size: 0.9em"></form><br><br>';


                            if (!$resultvailla = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND opiskelijankurssit.projekti_id='" . $pid . "' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.ryhma_id=0 AND kayttajat.rooli='opiskelija' ORDER BY sukunimi, etunimi")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }
                            echo "<br>";

                            if ($resultvailla->num_rows != 0) {
                                echo'<div class="cm8-border-top" style="width: 70%; padding-bottom: 20px; "></div>';
                                echo'<br><b style="color: #f7f9f7">Seuraavat opiskelijat eivät ole missään ryhmässä: </b><br><br>';

                                echo '<table class="cm8-tablevailla" style="margin-left: 0px"><thead>';
                                echo '<tr ><th>Etunimi</th><th>Sukunimi</th></tr></thead><tbody>';

                                while ($rowvailla = $resultvailla->fetch_assoc()) {
                                    echo '<tr><td><a href="kayttaja.php?url=' . $urlmihin . '&ka=' . $rowvailla[kaid] . '&r=' . $pid . '" style="padding: 2px 6px; margin-left: 60 px" title="Näytä käyttäjäprofiili">' . $rowvailla[etunimi] . "</td><td>" . $rowvailla[sukunimi] . "</a></td></tr>";
                                }
                                echo "</tbody></table>";


                                if ($rlopullinen == 0) {
                                    if ($tarkkamaara != 0) {


                                        echo'<form action="arvo2.php" method="post" ><input type="hidden" name="pid" value=' . $pid . '><input type="submit" name="painike" value="&#9763 Arvo nämä opiskelijat ryhmiin" class="myButton9"  role="button"  style="padding:2px 4px; font-size: 0.8em"></form>';
                                    } else {
                                        echo'<form action="arvo.php" method="post"><input type="hidden" name="pid" value=' . $pid . '><input type="submit" name="painike" value="&#9763 Arvo nämä opiskelijat ryhmiin" class="myButton9"  role="button"  style="padding:2px 4px; font-size: 0.8em"></form>';
                                    }
                                }
                            } else {

                                if (!$opiskelijattaas = $db->query("select distinct * from kayttajat, opiskelijankurssit where opiskelijankurssit.projekti_id='" . $pid . "' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kayttajat.rooli='opiskelija' ORDER BY sukunimi, etunimi")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                if ($opiskelijattaas->num_rows != 0) {
                                    echo'<div class="cm8-border-top" style="width: 70%; padding-bottom: 30px; "></div>';
                                    echo'<br><b><em>Kaikki kurssille/opintojaksolle liittyneet opiskelijat ovat jossain ryhmässä.</em></b><br><br>';
                                }
                            }
                            if ($palautus == 1) {
                                $onko = false;
                                if (!$resulthae = $db->query("select distinct opiskelija_id as oid from opiskelijankurssit, kayttajat where opiskelijankurssit.projekti_id='" . $pid . "' AND opiskelijankurssit.opiskelija_id=kayttajat.id AND kayttajat.rooli='opiskelija'")) {

                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                while ($rowhae = $resulthae->fetch_assoc()) {

                                    $oid = $rowhae[oid];

                                    if (!$resulttyot = $db->query("select distinct id from opiskelijan_kurssityot where kayttaja_id='" . $oid . "' AND projekti_id='" . $pid . "'")) {

                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }
                                    //ei ole palauttanut

                                    if ($resulttyot->num_rows == 0) {

                                        $onko = true;
                                    }
                                }
                                if ($onko) {
                                    echo'<br><br><b style="color: #f7f9f7;">Seuraavat opiskelijat eivät ole palauttaneet tiedostoa: </b><br><br>';

                                    echo '<table class="cm8-tablevailla" style="margin-left: 0px"><thead>';
                                    echo '<tr><th>Etunimi</th><th>Sukunimi</th></tr></thead><tbody>';


                                    if (!$resulthae = $db->query("select distinct opiskelija_id as oid from opiskelijankurssit where projekti_id='" . $pid . "'")) {

                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }

                                    while ($rowhae = $resulthae->fetch_assoc()) {

                                        $oid = $rowhae[oid];
                                        if (!$resulttyot = $db->query("select distinct id from opiskelijan_kurssityot where kayttaja_id='" . $oid . "' AND projekti_id='" . $pid . "'")) {

                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        //ei ole palauttanut

                                        if ($resulttyot->num_rows == 0) {
                                            if (!$resultei = $db->query("select distinct sukunimi, etunimi, id as kid from kayttajat where id = '" . $oid . "' AND rooli='opiskelija'")) {

                                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                            }

                                            while ($rowhae2 = $resultei->fetch_assoc()) {

                                                echo '<tr><td><a href="kayttaja.php?url=' . $urlmihin . '&ka=' . $rowhae2[kid] . '&r=' . $pid . '" style="padding: 2px 6px; margin-left: 60 px" title="Näytä käyttäjäprofiili">' . $rowhae2[etunimi] . "</td><td>" . $rowhae2[sukunimi] . "</a></td></tr>";
                                            }
                                        }
                                    }

                                    echo "</tbody></table>";
                                } else {

                                    if ($haeoppilaat->num_rows != 0) {
                                        echo'<br><b style="color: #f7f9f7;"><em>Kaikki opiskelijat ovat tehneet palautuksen. </em></b><br><br>';
                                    }
                                }

                                echo "<br>";
                            }
                            echo'</div>';
                        }




                        //neljäsosa kiinni
                        echo "</div>";
                    }
                }








                //cointaineri kiinni
                echo "</div>";
            }
        }
    }

    //opiskelija
    else {


        if (!isset($_GET[r]) || empty($_GET[r])) {
            if (!$onkoprojekti = $db->query("select * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($onkoprojekti->num_rows == 0) {


                echo'<br><em id="ohje">Ei aktiivisia palautuksia.</em><br></div>';
            } else {
                echo'<br><em id="ohje">Valitse oheisesta valikosta haluamasi Palautus-osio.</em><br><br>';
            }
        } else {
            if (!$onkoprojekti = $db->query("select * from projektit where id='" . $_GET[r] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowP = $onkoprojekti->fetch_assoc()) {
                $kuvaus = $rowP[kuvaus];
                $pid = $rowP[id];
                $tarkkamaara = $rowP[tarkkamaara];
                $ryhmienmaksimi = $rowP[ryhmienmaksimi];
                $opmaksimi = $rowP[opmaksimi];
                $opminimi = $rowP[opminimi];
                $palautus = $rowP[palautus];


                echo'<h6tiedosto id="peite3" style="padding: 6px 100px 6px 20px;">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . '</h6tiedosto>';
                if (!$ryhmatiedot = $db->query("select distinct lopullinen from ryhmat where projekti_id='" . $pid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowRT = $ryhmatiedot->fetch_assoc()) {
                    $oplopullinen = $rowRT[lopullinen];
                }



                if (!$haeinfo = $db->query("select * from projektit where id='" . $pid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowv = $haeinfo->fetch_assoc()) {
                    $viesti = $rowv[info];
                }
                if ($viesti != '') {
                    echo'<div class="cm8-responsive" id="info_ope">';
                    echo'<div class="cm8-responsive cm8-ilmoitus" style="padding: 20px">';
                    echo htmlspecialchars_decode($viesti);
                    echo'</div>';
                    echo'</div>';
                } else {
                    echo'<div class="cm8-margin-top"></div>';
                }




                echo'<div class="cm8-responsive ohjeboxi" style="padding-top: 20px; padding-bottom: 0px">';

                if (!$ryhmatiedot = $db->query("select distinct lopullinen from ryhmat where projekti_id='" . $pid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowRT = $ryhmatiedot->fetch_assoc()) {
                    $oplopullinen = $rowRT[lopullinen];
                }



                if ($tarkkamaara != 0) {
                    echo '<p class="info" style="font-weight: normal; margin: 0px;color: #c7ef00;">Ryhmiä on yhteensä: <b>' . $tarkkamaara . '.</b></p><p class="info" style="font-weight: normal; color: #c7ef00;display: inline-block">Jokaisessa ryhmässä on oltava vähintään <b>' . $opminimi . '</b> ja saa olla korkeintaan <b>' . $opmaksimi . '</b> opiskelijaa.</p>';
                } else {
                    echo '<p class="info" style="font-weight: normal; margin: 0px;color: #c7ef00;">Ryhmien maksimimäärä on <b>' . $ryhmienmaksimi . '.</b></p><p class="info" style="font-weight: normal; color: #c7ef00;display:inline-block">Jokaisessa ryhmässä on oltava vähintään <b>' . $opminimi . '</b> ja saa olla korkeintaan <b>' . $opmaksimi . '</b> opiskelijaa.</p>';
                }

                echo'</div>';

                if (!$onkoprojekti = $db->query("select * from projektit where id='" . $_GET[r] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowP = $onkoprojekti->fetch_assoc()) {
                    $avautuu = $rowP[palautus_avautuu];
                    $sulkeutuu = $rowP[palautus_sulkeutuu];
                }


                if ($palautus == 1) {

                    echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding-top: 0px; padding-bottom: 0px">';

                    $nyt = date("Y-m-d H:i");
                    $avautumispaiva = substr($avautuu, 0, 10);
                    $avautumispaiva = date("d.m.Y", strtotime($avautumispaiva));
                    $avautumiskello = substr($avautuu, 11, 5);

                    $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
                    $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
                    $sulkeutumiskello = substr($sulkeutuu, 11, 5);



                    if (!empty($sulkeutuu) && $sulkeutuu != ' ' && $sulkeutuu != NULL) {



                        if ($nyt <= $sulkeutuu) {
                            echo'<p  style="color: #c7ef00; font-weight: bold">Palautusten takaraja on ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</p>';
                        } else {
                            echo'<p style="color: red; font-weight: bold">Palautusten takaraja oli ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</p>';
                        }
                    } else {
                        
                    }

                    echo'</div>';
                }





                if ($oplopullinen == 1) {
                    echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding-top: 0px; padding-bottom: 0px;">';
                    echo'<p style="font-weight: bold; color: red; font-size: 0.9em">Ilmoittautuminen ryhmiin on suljettu.</p>';
                    echo'</div>';
                }

                if (!$opiskelijantiedot = $db->query("select distinct * from opiskelijankurssit where opiskelija_id='" . $_SESSION["Id"] . "' AND projekti_id='" . $pid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                if (!$opiskelijanryhma = $db->query("select distinct ryhma_id as rid from opiskelijankurssit where opiskelija_id='" . $_SESSION["Id"] . "' AND projekti_id='" . $pid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowORY = $opiskelijanryhma->fetch_assoc()) {

                    $opryhmaid = $rowORY[rid];
                }
                echo'<div class="cm8-margin-top"></div>';

                if ($oplopullinen == 0) {

                    if ($opmaksimi == 1) {
                        $tyhjatryhmat = array();
                        if (!$haeryhmat = $db->query("select distinct * from ryhmat where projekti_id='" . $pid . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        while ($hae = $haeryhmat->fetch_assoc()) {
                            $rid = $hae[id];
                            if (!$haeoppilaat = $db->query("select distinct * from ryhmat, opiskelijankurssit where ryhmat.id='" . $rid . "' AND ryhmat.id=opiskelijankurssit.ryhma_id")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }
                            //tyhjät ryhmät talteen
                            if ($haeoppilaat->num_rows == 0) {
                                array_push($tyhjatryhmat, $rid);
                            }
                        }

                        $ryhmatkaikki = array();
                        if (!$kaikkiryhmat2 = $db->query("select distinct ryhmat.nimi as nimi, suljettu, ryhmat.id as id, lopullinen from ryhmat, opiskelijankurssit, kayttajat where ryhmat.id=opiskelijankurssit.ryhma_id AND opiskelijankurssit.opiskelija_id=kayttajat.id AND ryhmat.projekti_id='" . $pid . "' ORDER BY sukunimi, etunimi")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        while ($haek = $kaikkiryhmat2->fetch_assoc()) {
                            array_push($ryhmatkaikki, $haek[id]);
                        }
                        //tyhjät mukaan
                        if (!empty($tyhjatryhmat)) {
                            foreach ($tyhjatryhmat as $onid2) {
                                array_push($ryhmatkaikki, $onid2);
                            }
                        }


                        echo '<h2  style="color: #f7f9f7; text-decoration: underline; font-size: 1.3em; padding-top: 30px; padding-bottom: 10px">Ryhmät:</h2> ';

                        echo'<p style="color: #c7ef00">Koska ryhmissä on vain 1 opiskelija, niin ryhmät listataan aakkosjärjestyksessä.</p>';

                        echo'<div class="cm8-margin-top"></div>';

                        if (!empty($ryhmatkaikki)) {

                            foreach ($ryhmatkaikki as $onid) {

                                //haetaan kaikki projektin ryhmät


                                if (!$kaikkiryhmat = $db->query("select distinct * from ryhmat where id='" . $onid . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                while ($rowKR = $kaikkiryhmat->fetch_assoc()) {


                                    echo'<div class="cm8-responsive" style="width: 90%; ; margin-bottom: 30px; padding-bottom: 0px; background-color: #272227; color: #f7f9f7" >';
                                    echo '<table class="cm8-tabler" style="table-layout:fixed; width: 100%; overflow-y: hidden; overflow-x:auto;">';
                                    echo '<tr id=' . $rowKR[id] . ' ><th>' . $rowKR[nimi] . "</th>";

                                    if (!$ryhmanopiskelijat = $db->query("select distinct * from opiskelijankurssit where projekti_id='" . $pid . "' AND ryhma_id='" . $rowKR[id] . "'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }



                                    if (($ryhmanopiskelijat->num_rows < $opmaksimi) && $opryhmaid == 0 && $rowKR[suljettu] == 0 && $rowKR[lopullinen] == 0) {
                                        echo '<th><a href="liityryhmaan.php?pid=' . $pid . '&id=' . $rowKR[id] . '" class="myButton8"  role="button"  title="Liity ryhmään" style="margin-bottom: 0px; padding: 2px 6px">&#9745 Liity</a></th><th></th></tr>';
                                    } else if ($opryhmaid == $rowKR[id] && $rowKR[suljettu] == 0 && ($ryhmanopiskelijat->num_rows >= $opminimi && $rowKR[lopullinen] == 0)) {
                                        echo '<th><a href="suljeryhma.php?pid=' . $pid . '&id=' . $rowKR[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Sulje ryhmä">&#9746 Sulje</a></th><th>' . '<a href="poisturyhmasta.php?pid=' . $pid . '&id=' . $rowKR[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Poistu ryhmästä">&#10007 Poistu</a></th></tr>';
                                    } else if ($opryhmaid == $rowKR[id] && $rowKR[suljettu] == 0 && ($ryhmanopiskelijat->num_rows < $opminimi && $rowKR[lopullinen] == 0)) {
                                        echo '<th>' . '<a href="poisturyhmasta.php?pid=' . $pid . '&id=' . $rowKR[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Poistu ryhmästä">&#10007 Poistu</a></th></tr>';
                                    } else if ($opryhmaid == $rowKR[id] && $rowKR[suljettu] == 1 && $rowKR[lopullinen] == 0) {
                                        echo '<th><a href="avaa.php?pid=' . $pid . '&id=' . $rowKR[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Avaa ryhmä">&#9745 Avaa</a></th><th>' . '<a href="poisturyhmasta.php?pid=' . $pid . '&id=' . $rowKR[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Poistu ryhmästä">&#10007 Poistu</a></th></tr>';
                                    } else {
                                        echo'<th></th><th></th></tr>';
                                    }


                                    if (!$ryhmanopiskelijat2 = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli <> 'admin' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.ryhma_id='" . $rowKR[id] . "'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }

                                    while ($rowRO = $ryhmanopiskelijat2->fetch_assoc()) {

                                        echo '<tr style="border: 2px solid grey"><td>' . $rowRO[etunimi] . ' ' . $rowRO[sukunimi] . '</td><td></td><td></td></tr>';
                                    }



                                    echo "</table>";

                                    if ($rowKR[suljettu] == 1)
                                        echo'<p style="font-size:0.8em; margin-left: 5px; margin-top:5px; margin-bottom: 5px">Tämä ryhmä on suljettu</p>';



                                    if ($opryhmaid == $rowKR[id]) {
                                        if (!$haetyot = $db->query("select distinct * from ryhmat2 where ryhma_id='" . $opryhmaid . "' AND projekti_id='" . $pid . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }

                                        if (!$haemuut = $db->query("select distinct * from opiskelijankurssit where ryhma_id='" . $opryhmaid . "' AND projekti_id='" . $pid . "' AND opiskelija_id<>'" . $_SESSION["Id"] . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        if ($haemuut->num_rows > 0)
                                            echo'<br><form action="viestiryhmalle.php" method="post" style="display: inline-block"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $rowKR[id] . '><input type="submit" name="painike" class="myButton8" value="📧 &nbsp Lähetä viesti ryhmälle" style="padding: 2px; margin-left: 10px"></form><br><br>';

                                        if ($palautus == 1 && $opryhmaid == $rowKR[id]) {
                                            if (!$haetyot = $db->query("select distinct ryhmat2.palaute as palaute, linkki, omatallennusnimi, tallennettunimi, tyonimi, ryhmat2.id as tyoid, lisayspvm from ryhmat2, opiskelijankurssit, opiskelijan_kurssityot where opiskelijan_kurssityot.projekti_id='" . $pid . "' AND opiskelijan_kurssityot.kayttaja_id=opiskelijankurssit.opiskelija_id AND opiskelijan_kurssityot.ryhmat2_id = ryhmat2.id  AND opiskelijankurssit.ryhma_id='" . $opryhmaid . "'")) {
                                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                            }


                                            if (!$RTsuljettu = $db->query("select distinct palautus_suljettu, palautus_sulkeutuu from projektit where id='" . $pid . "'")) {
                                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                            }

                                            while ($RTs = $RTsuljettu->fetch_assoc()) {
                                                $suljettu = $RTs[palautus_suljettu];
                                                $sulkeutuu = $RTs[palautus_sulkeutuu];
                                            }
                                            $nyt = date("Y-m-d H:i");

                                            echo'<div class="cm8-margin-left"><br>';
                                            echo '<h2 style="color: #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 10px">Omat palautukset:</h2>';

                                            if ($haetyot->num_rows != 0) {
                                                echo '<table class="cm8-table3">';
                                                echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th>Tiedosto</th><th>Palautettu</th><th>Opettajan kommentti</th><th>Muokkaa / Poista</th></tr>';

                                                while ($rowt = $haetyot->fetch_assoc()) {
                                                    $tallnimi = $rowt[omatallennusnimi];
                                                    $tyoid = $rowt[tyoid];
                                                    $linkki = $rowt[linkki];
                                                    $palautettu = $rowt[lisayspvm];
                                                    $palautuspaiva = substr($rowt[lisayspvm], 0, 10);
                                                    $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                                    $palautuskello = substr($rowt[lisayspvm], 11, 5);
                                                    $rowt[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;
                                                    $rowt[palaute] = str_replace('<br />', "", $rowt[palaute]);
                                                    if ($linkki == 1) {
                                                        //TÄSSÄ
                                                        echo'<tr><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt[tyonimi] . '</a></p></td><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki">' . $rowt[omatallennusnimi] . '</a></td><td>' . $rowt[lisayspvm];

                                                        if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                            echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                        }
                                                        echo'</td><td>' . $rowt[palaute] . '</td>';
                                                        echo'<td><form action="muokkaa_tiedosto_opiskelija.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form><form action="poistovarmistus.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="ryid" value=' . $opryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $rowt[tyoid] . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                                    } else {
                                                        echo '<tr><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt[tyoid] . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt[tyonimi] . '</a></td><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt[tyoid] . ' target="_blank">' . $tallnimi . '</a></td><td>' . $rowt[lisayspvm];
                                                        if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                            echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                        }
                                                        echo'</td><td>' . $rowt[palaute] . '</td>';
                                                        echo'<td><form action="muokkaa_tiedosto_opiskelija.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form><form action="poistovarmistus.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="ryid" value=' . $opryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $rowt[tyoid] . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                                    }
                                                }
                                                echo "</table>";
                                            }

                                            if ($palautus == 1) {
                                                if (!$RTsuljettu = $db->query("select distinct palautus_suljettu, palautus_sulkeutuu from projektit where id='" . $pid . "'")) {
                                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                                }

                                                while ($RTs = $RTsuljettu->fetch_assoc()) {
                                                    $suljettu = $RTs[palautus_suljettu];
                                                    $sulkeutuu = $RTs[palautus_sulkeutuu];
                                                }
                                                $ryhma = false;
                                                if (!$haeryhma = $db->query("select distinct * from opiskelijankurssit where projekti_id='" . $pid . "' AND opiskelija_id='" . $_SESSION["Id"] . "' AND ryhma_id<>0")) {
                                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                                }
                                                if ($haeryhma->num_rows > 0) {
                                                    $ryhma = true;
                                                    while ($rowryhma = $haeryhma->fetch_assoc()) {
                                                        $opryhmaid = $rowryhma[ryhma_id];
                                                    }
                                                }

                                                if ($sulkeutuu != ' ' && $sulkeutuu != NULL && !empty($sulkeutuu)) {

                                                    if ($nyt <= $sulkeutuu) {
                                                        echo'<br><b style="color: #c7ef00">Palautusten takaraja on ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b><br><br>';
                                                    } else {
                                                        echo'<br><b style="color:red">Palautusten takaraja oli ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
                                                        echo'<p>Voit silti tehdä palautuksen, mutta siihen tulee merkintä myöhästymisestä.</p>';
                                                    }
                                                }
                                                if ($ryhma) {

                                                    echo'<form action="tiedosto.php" method="post"><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" class="myButton8" name="painike" value="&#9763 Palauta uusi työ" style="font-size: 0.7em; padding: 2px"></form>';
                                                } else {

                                                    echo'Voit tehdä palautuksen vasta, kun olet liittynyt johonkin ryhmään.<br><br>';
                                                }
                                            }
                                            echo "<br></div>";
                                        }
                                        // tähän open tiedostot

                                        if (!$haetyot = $db->query("select distinct * from ryhmatope where ryhma_id='" . $opryhmaid . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }




                                        if ($haetyot->num_rows != 0) {
                                            echo'<div class="cm8-margin-left"><br>';
                                            echo '<h2 style="color: #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 20px">Opettajan lisäämät tiedostot:</h2>';

                                            echo '<table class="cm8-table3">';
                                            echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th>Tiedosto</th><th>Lisätty</th></tr>';

                                            while ($rowt = $haetyot->fetch_assoc()) {
                                                $tallnimi = $rowt[omatallennusnimi];
                                                $tyoid = $rowt[id];
                                                $linkki = $rowt[linkki];
                                                $palautettu = $rowt[lisayspvm];
                                                $palautuspaiva = substr($rowt[lisayspvm], 0, 10);
                                                $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                                $palautuskello = substr($rowt[lisayspvm], 11, 5);
                                                $rowt[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;
                                                $rowt[palaute] = str_replace('<br />', "", $rowt[palaute]);
                                                if ($linkki == 1) {
                                                    echo'<tr><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt[tyonimi] . '</a></p></td><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki">' . $rowt[omatallennusnimi] . '</a></td><td>' . $rowt[lisayspvm];


                                                    echo'</td></tr>';
                                                } else {
                                                    echo '<tr><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt[tyonimi] . '</a></td><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . ' target="_blank">' . $tallnimi . '</a></td><td>' . $rowt[lisayspvm];

                                                    echo'</td></tr>';
                                                }
                                            }
                                            echo "</table>";
                                            echo'</div>';
                                        }
                                    } else {
                                        
                                    }

                                    echo'</div>';
                                }
                            }
                        }
                    } else {

                        echo '<h2  style="color: #f7f9f7; text-decoration: underline; font-size: 1.3em; padding-top: 30px; padding-bottom: 10px">Ryhmät:</h2> ';

                        echo'<div class="cm8-margin-top"></div>';

                        if (!$kaikkiryhmat = $db->query("select distinct * from ryhmat where projekti_id='" . $pid . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        //haetaan kaikki projektin ryhmät



                        while ($rowKR = $kaikkiryhmat->fetch_assoc()) {


                            echo'<div class="cm8-responsive" style="width: 90%; ; margin-bottom: 30px; padding-bottom: 0px; background-color: #272227; color: #f7f9f7" >';
                            echo '<table class="cm8-tabler" style="table-layout:fixed; width: 100%; overflow-y: hidden; overflow-x:auto;">';
                            echo '<tr id=' . $rowKR[id] . ' ><th>' . $rowKR[nimi] . "</th>";

                            if (!$ryhmanopiskelijat = $db->query("select distinct * from opiskelijankurssit where projekti_id='" . $pid . "' AND ryhma_id='" . $rowKR[id] . "'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }



                            if (($ryhmanopiskelijat->num_rows < $opmaksimi) && $opryhmaid == 0 && $rowKR[suljettu] == 0 && $rowKR[lopullinen] == 0) {
                                echo '<th><a href="liityryhmaan.php?pid=' . $pid . '&id=' . $rowKR[id] . '" class="myButton8"  role="button"  title="Liity ryhmään" style="margin-bottom: 0px; padding: 2px 6px">&#9745 Liity</a></th><th></th></tr>';
                            } else if ($opryhmaid == $rowKR[id] && $rowKR[suljettu] == 0 && ($ryhmanopiskelijat->num_rows >= $opminimi && $rowKR[lopullinen] == 0)) {
                                echo '<th><a href="suljeryhma.php?pid=' . $pid . '&id=' . $rowKR[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Sulje ryhmä">&#9746 Sulje</a></th><th>' . '<a href="poisturyhmasta.php?pid=' . $pid . '&id=' . $rowKR[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Poistu ryhmästä">&#10007 Poistu</a></th></tr>';
                            } else if ($opryhmaid == $rowKR[id] && $rowKR[suljettu] == 0 && ($ryhmanopiskelijat->num_rows < $opminimi && $rowKR[lopullinen] == 0)) {
                                echo '<th>' . '<a href="poisturyhmasta.php?pid=' . $pid . '&id=' . $rowKR[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Poistu ryhmästä">&#10007 Poistu</a></th></tr>';
                            } else if ($opryhmaid == $rowKR[id] && $rowKR[suljettu] == 1 && $rowKR[lopullinen] == 0) {
                                echo '<th><a href="avaa.php?pid=' . $pid . '&id=' . $rowKR[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Avaa ryhmä">&#9745 Avaa</a></th><th>' . '<a href="poisturyhmasta.php?pid=' . $pid . '&id=' . $rowKR[id] . '" class="myButton8"  role="button"  style="margin-bottom: 0px; padding: 2px 6px" title="Poistu ryhmästä">&#10007 Poistu</a></th></tr>';
                            } else {
                                echo'<th></th><th></th></tr>';
                            }


                            if (!$ryhmanopiskelijat2 = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli <> 'admin' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.ryhma_id='" . $rowKR[id] . "'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }

                            while ($rowRO = $ryhmanopiskelijat2->fetch_assoc()) {


                                echo '<tr style="border: 2px solid grey"><td>' . $rowRO[etunimi] . ' ' . $rowRO[sukunimi] . '</td><td></td><td></td></tr>';
                            }


                            echo "</table>";


                            if ($rowKR[suljettu] == 1)
                                echo'<p style="font-size:0.8em; margin-left: 5px; margin-top:5px; margin-bottom: 5px">Tämä ryhmä on suljettu</p>';



                            if ($opryhmaid == $rowKR[id]) {
                                if (!$haetyot = $db->query("select distinct * from ryhmat2 where ryhma_id='" . $opryhmaid . "' AND projekti_id='" . $pid . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                if (!$haemuut = $db->query("select distinct * from opiskelijankurssit where ryhma_id='" . $opryhmaid . "' AND projekti_id='" . $pid . "' AND opiskelija_id<>'" . $_SESSION["Id"] . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                if ($haemuut->num_rows > 0)
                                    echo'<br><form action="viestiryhmalle.php" method="post" style="display: inline-block"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $rowKR[id] . '><input type="submit" name="painike" class="myButton8" value="📧 &nbsp Lähetä viesti ryhmälle" style="padding: 2px; margin-left: 10px"></form><br><br>';

                                if ($palautus == 1 && $opryhmaid == $rowKR[id]) {
                                    if (!$haetyot = $db->query("select distinct ryhmat2.palaute as palaute, linkki, omatallennusnimi, tallennettunimi, tyonimi, ryhmat2.id as tyoid, lisayspvm from ryhmat2, opiskelijankurssit, opiskelijan_kurssityot where opiskelijan_kurssityot.projekti_id='" . $pid . "' AND opiskelijan_kurssityot.kayttaja_id=opiskelijankurssit.opiskelija_id AND opiskelijan_kurssityot.ryhmat2_id = ryhmat2.id  AND opiskelijankurssit.ryhma_id='" . $opryhmaid . "'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }

                                    if (!$RTsuljettu = $db->query("select distinct palautus_suljettu, palautus_sulkeutuu from projektit where id='" . $pid . "'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }

                                    while ($RTs = $RTsuljettu->fetch_assoc()) {
                                        $suljettu = $RTs[palautus_suljettu];
                                        $sulkeutuu = $RTs[palautus_sulkeutuu];
                                    }
                                    $nyt = date("Y-m-d H:i");

                                    echo'<div class="cm8-margin-left" ><br>';
                                    echo '<h2 style="color: #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 10px">Omat palautukset:</h2>';
                                    if ($haetyot->num_rows != 0) {
                                        echo '<table class="cm8-table3">';
                                        echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th >Tiedosto</th><th>Palautettu</th><th>Opettajan kommentti</th><th>Muokkaa / Poista</th></tr>';

                                        while ($rowt = $haetyot->fetch_assoc()) {
                                            $tallnimi = $rowt[omatallennusnimi];
                                            $tyoid = $rowt[tyoid];
                                            $linkki = $rowt[linkki];
                                            $palautettu = $rowt[lisayspvm];
                                            $palautuspaiva = substr($rowt[lisayspvm], 0, 10);
                                            $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                            $palautuskello = substr($rowt[lisayspvm], 11, 5);
                                            $rowt[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;
                                            $rowt[palaute] = str_replace('<br />', "", $rowt[palaute]);
                                            if ($linkki == 1) {
                                                echo'<tr><td ><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt[tyonimi] . '</a></p></td><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki">' . $rowt[omatallennusnimi] . '</a></td><td>' . $rowt[lisayspvm];

                                                if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                    echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                }
                                                echo'</td><td>' . $rowt[palaute] . '</td>';
                                                echo'<td><form action="muokkaa_tiedosto_opiskelija.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form><form action="poistovarmistus.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="ryid" value=' . $opryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $rowt[tyoid] . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                            } else {
                                                echo '<tr><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt[tyoid] . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt[tyonimi] . '</a></td><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt[tyoid] . ' target="_blank">' . $tallnimi . '</a></td><td>' . $rowt[lisayspvm];
                                                if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                    echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                }
                                                echo'</td><td>' . $rowt[palaute] . '</td>';
                                                echo'<td><form action="muokkaa_tiedosto_opiskelija.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form><form action="poistovarmistus.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="ryid" value=' . $opryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $rowt[tyoid] . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                            }
                                        }
                                        echo "</table>";
                                    }

                                    if ($palautus == 1) {
                                        if (!$RTsuljettu = $db->query("select distinct palautus_suljettu, palautus_sulkeutuu, palautus_avautuu from projektit where id='" . $pid . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        $nyt = date("Y-m-d H:i");
                                        while ($RTs = $RTsuljettu->fetch_assoc()) {
                                            $sulkeutuu = $RTs[sulkeutuu];
                                            $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
                                            $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
                                            $sulkeutumiskello = substr($sulkeutuu, 11, 5);

                                            $avautuu = $RTs[aukeaa];

                                            $avautumispaiva = substr($avautuu, 0, 10);
                                            $avautumispaiva = date("d.m.Y", strtotime($avautumispaiva));
                                            $avautumiskello = substr($avautuu, 11, 5);
                                        }
                                        $ryhma = false;
                                        if (!$haeryhma = $db->query("select distinct * from opiskelijankurssit where projekti_id='" . $pid . "' AND opiskelija_id='" . $_SESSION["Id"] . "' AND ryhma_id<>0")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        if ($haeryhma->num_rows > 0) {
                                            $ryhma = true;
                                            while ($rowryhma = $haeryhma->fetch_assoc()) {
                                                $opryhmaid = $rowryhma[ryhma_id];
                                            }
                                        }


                                        if ($sulkeutuu != ' ' && $sulkeutuu != NULL && !empty($sulkeutuu)) {

                                            if ($nyt <= $sulkeutuu) {
                                                echo'<br><b style="color: #c7ef00">Palautusten takaraja on ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b><br><br>';
                                            } else {
                                                echo'<br><b style="color:red">Palautusten takaraja oli ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
                                                echo'<p>Voit silti tehdä palautuksen, mutta siihen tulee merkintä myöhästymisestä.</p>';
                                            }
                                        }
                                        if ($ryhma) {

                                            echo'<form action="tiedosto.php" method="post"><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" class="myButton8" name="painike" value="&#9763 Palauta uusi työ" style="font-size: 0.7em; padding: 2px"></form>';
                                        } else {

                                            echo'Voit tehdä palautuksen vasta, kun olet liittynyt johonkin ryhmään.<br><br>';
                                        }
                                    }
                                    echo "<br></div>";




                                    // tähän open tiedostot

                                    if (!$haetyot = $db->query("select distinct * from ryhmatope where ryhma_id='" . $opryhmaid . "'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }




                                    if ($haetyot->num_rows != 0) {
                                        echo'<div class="cm8-margin-left"><br>';
                                        echo '<h2 style="color: #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 20px">Opettajan lisäämät tiedostot:</h2>';

                                        echo '<table class="cm8-table3">';
                                        echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th>Tiedosto</th><th>Lisätty</th></tr>';

                                        while ($rowt = $haetyot->fetch_assoc()) {
                                            $tallnimi = $rowt[omatallennusnimi];
                                            $tyoid = $rowt[id];
                                            $linkki = $rowt[linkki];
                                            $palautettu = $rowt[lisayspvm];
                                            $palautuspaiva = substr($rowt[lisayspvm], 0, 10);
                                            $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                            $palautuskello = substr($rowt[lisayspvm], 11, 5);
                                            $rowt[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;
                                            $rowt[palaute] = str_replace('<br />', "", $rowt[palaute]);
                                            if ($linkki == 1) {
                                                echo'<tr><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt[tyonimi] . '</a></p></td><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki">' . $rowt[omatallennusnimi] . '</a></td><td>' . $rowt[lisayspvm];


                                                echo'</td></tr>';
                                            } else {
                                                echo '<tr><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt[tyonimi] . '</a></td><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . ' target="_blank">' . $tallnimi . '</a></td><td>' . $rowt[lisayspvm];

                                                echo'</td></tr>';
                                            }
                                        }
                                        echo "</table>";
                                        echo'</div>';
                                    }
                                }
                            } else {
                                
                            }

                            echo'</div>';
                        }
                    }

                    if (!$maara2 = $db->query("select * from ryhmat where projekti_id='" . $pid . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    if (!$ryhmamaksimi2 = $db->query("select distinct ryhmienmaksimi from projektit where id='" . $pid . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($ryhmienmaksimi2 = $ryhmamaksimi2->fetch_assoc()) {
                        $ryhmamaks2 = $ryhmienmaksimi2[ryhmienmaksimi];
                    }

                    if ($maara2->num_rows < $ryhmamaks2 && $opryhmaid == 0 && $oplopullinen == 0)
                        echo'<form action="lisaaryhmakasa2.php" method="post"><input type="hidden" name="id" value=' . $pid . '><input type="submit" name="painike" class="myButton8" style="padding: 4px 6px; font-size: 0.9em" value="+ Lisää uusi ryhmä" id="lisaa"></form>';
                }

                if ($oplopullinen == 1) {


                    echo '<h2  style="color: #f7f9f7; text-decoration: underline; font-size: 1.4em; padding-top: 30px">Lopulliset ryhmät:</h2>';
                    if ($opmaksimi == 1) {
                        echo'<p style="color: #c7ef00; padding-top: 20px">Koska ryhmissä on vain 1 opiskelija, niin ryhmät listataan aakkosjärjestyksessä.</p>';
                    }
                    echo'<div class="cm8-margin-top"></div>';
                    //haetaan kaikki projektin ryhmät
                    if ($opmaksimi == 1) {

                        $tyhjatryhmat = array();
                        if (!$haeryhmat = $db->query("select distinct * from ryhmat where projekti_id='" . $pid . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        while ($hae = $haeryhmat->fetch_assoc()) {
                            $rid = $hae[id];
                            if (!$haeoppilaat = $db->query("select distinct * from ryhmat, opiskelijankurssit where ryhmat.id='" . $rid . "' AND ryhmat.id=opiskelijankurssit.ryhma_id")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }
                            //tyhjät ryhmät talteen
                            if ($haeoppilaat->num_rows == 0) {
                                array_push($tyhjatryhmat, $rid);
                            }
                        }

                        $ryhmatkaikki = array();
                        if (!$kaikkiryhmat2 = $db->query("select distinct ryhmat.nimi as nimi, suljettu, ryhmat.id as id, lopullinen from ryhmat, opiskelijankurssit, kayttajat where ryhmat.id=opiskelijankurssit.ryhma_id AND opiskelijankurssit.opiskelija_id=kayttajat.id AND ryhmat.projekti_id='" . $pid . "' ORDER BY sukunimi, etunimi")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        while ($haek = $kaikkiryhmat2->fetch_assoc()) {
                            array_push($ryhmatkaikki, $haek[id]);
                        }
                        //tyhjät mukaan
                        if (!empty($tyhjatryhmat)) {
                            foreach ($tyhjatryhmat as $onid2) {
                                array_push($ryhmatkaikki, $onid2);
                            }
                        }

                        if (!empty($ryhmatkaikki)) {

                            foreach ($ryhmatkaikki as $onid) {

                                //haetaan kaikki projektin ryhmät


                                if (!$kaikkiryhmat = $db->query("select distinct * from ryhmat where id='" . $onid . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                while ($rowKR = $kaikkiryhmat->fetch_assoc()) {
                                    if (!$ryhmanopiskelijat2 = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.ryhma_id='" . $rowKR[id] . "' AND kayttajat.rooli <> 'admin'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }

                                    echo'<div class="cm8-responsive" style="width: 90%; ; margin-bottom: 30px; padding-bottom: 0px; background-color: #272227; color: #f7f9f7" >';
                                    echo '<table class="cm8-tabler" style="table-layout:fixed; width: 100%; overflow-y: hidden; overflow-x:auto;">';
                                    echo '<tr id=' . $rowKR[id] . ' ><th>' . $rowKR[nimi] . "</th><th></th><th></th></tr>";




                                    while ($rowRO = $ryhmanopiskelijat2->fetch_assoc()) {

                                        echo '<tr style="border: 2px solid grey"><td><td>' . $rowRO[etunimi] . ' ' . $rowRO[sukunimi] . '</td><td></td><td></td></tr>';
                                    }


                                    echo "</table>";




                                    if ($rowKR[suljettu] == 1)
                                        echo'<p style="font-size:0.8em; margin-left: 5px; margin-top:5px; margin-bottom: 5px">Tämä ryhmä on suljettu</p>';



                                    if ($opryhmaid == $rowKR[id]) {
                                        if (!$haetyot = $db->query("select distinct * from ryhmat2 where ryhma_id='" . $opryhmaid . "' AND projekti_id='" . $pid . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }

                                        if (!$haemuut = $db->query("select distinct * from opiskelijankurssit where ryhma_id='" . $opryhmaid . "' AND projekti_id='" . $pid . "' AND opiskelija_id<>'" . $_SESSION["Id"] . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        if ($haemuut->num_rows > 0)
                                            echo'<form action="viestiryhmalle.php" method="post" style="display: inline-block"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $rowKR[id] . '><input type="submit" name="painike" class="myButton8" value="📧 &nbsp Lähetä viesti ryhmälle" style="padding:2px; margin-left: 10px"></form><br><br>';
                                    }

                                    if ($palautus == 1 && $opryhmaid == $rowKR[id]) {
                                        if (!$haetyot = $db->query("select distinct ryhmat2.palaute as palaute, linkki, omatallennusnimi, tallennettunimi, tyonimi, ryhmat2.id as tyoid, lisayspvm from ryhmat2, opiskelijankurssit, opiskelijan_kurssityot where opiskelijan_kurssityot.projekti_id='" . $pid . "' AND opiskelijan_kurssityot.kayttaja_id=opiskelijankurssit.opiskelija_id AND opiskelijan_kurssityot.ryhmat2_id = ryhmat2.id  AND opiskelijankurssit.ryhma_id='" . $opryhmaid . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        if (!$RTsuljettu = $db->query("select distinct palautus_suljettu, palautus_sulkeutuu from projektit where id='" . $pid . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }

                                        while ($RTs = $RTsuljettu->fetch_assoc()) {
                                            $suljettu = $RTs[palautus_suljettu];
                                            $sulkeutuu = $RTs[palautus_sulkeutuu];
                                        }
                                        $nyt = date("Y-m-d H:i");
                                        echo'<div class="cm8-margin-left"><br>';
                                        echo '<h2 style="color: #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 10px">Omat palautukset:</h2>';
                                        if ($haetyot->num_rows != 0) {
                                            echo '<table class="cm8-table3" style="font-size: 0.9em">';
                                            echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th >Tiedosto</th><th>Palautettu</th><th>Opettajan kommentti</th><th>Muokkaa / Poista</th></tr>';

                                            while ($rowt = $haetyot->fetch_assoc()) {
                                                $tallnimi = $rowt[omatallennusnimi];
                                                $tyoid = $rowt[tyoid];
                                                $linkki = $rowt[linkki];
                                                $palautettu = $rowt[lisayspvm];
                                                $palautuspaiva = substr($rowt[lisayspvm], 0, 10);
                                                $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                                $palautuskello = substr($rowt[lisayspvm], 11, 5);
                                                $rowt[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;
                                                $rowt[palaute] = str_replace('<br />', "", $rowt[palaute]);
                                                if ($linkki == 1) {
                                                    echo'<tr><td ><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt[tyonimi] . '</a></p></td><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki">' . $rowt[omatallennusnimi] . '</a></td><td>' . $rowt[lisayspvm];

                                                    if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                        echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                    }
                                                    echo'</td><td>' . $rowt[palaute] . '</td>';
                                                    echo'<td><form action="muokkaa_tiedosto_opiskelija.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form><form action="poistovarmistus.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="ryid" value=' . $opryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $rowt[tyoid] . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                                } else {
                                                    echo '<tr><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt[tyoid] . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt[tyonimi] . '</a></td><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt[tyoid] . ' target="_blank">' . $tallnimi . '</a></td><td>' . $rowt[lisayspvm];
                                                    if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                        echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                                    }
                                                    echo'</td><td>' . $rowt[palaute] . '</td>';
                                                    echo'<td><form action="muokkaa_tiedosto_opiskelija.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form><form action="poistovarmistus.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="ryid" value=' . $opryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $rowt[tyoid] . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                                }
                                            }
                                            echo "</table>";
                                        }

                                        if ($palautus == 1) {
                                            if (!$RTsuljettu = $db->query("select distinct palautus_suljettu, palautus_sulkeutuu from projektit where id='" . $pid . "'")) {
                                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                            }

                                            while ($RTs = $RTsuljettu->fetch_assoc()) {
                                                $suljettu = $RTs[palautus_suljettu];
                                                $sulkeutuu = $RTs[palautus_sulkeutuu];
                                            }
                                            $ryhma = false;
                                            if (!$haeryhma = $db->query("select distinct * from opiskelijankurssit where projekti_id='" . $pid . "' AND opiskelija_id='" . $_SESSION["Id"] . "' AND ryhma_id<>0")) {
                                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                            }
                                            if ($haeryhma->num_rows > 0) {
                                                $ryhma = true;
                                                while ($rowryhma = $haeryhma->fetch_assoc()) {
                                                    $opryhmaid = $rowryhma[ryhma_id];
                                                }
                                            }

                                            if ($sulkeutuu != ' ' && $sulkeutuu != NULL && !empty($sulkeutuu)) {

                                                if ($nyt <= $sulkeutuu) {
                                                    echo'<br><b style="color: #c7ef00">Palautusten takaraja on ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b><br><br>';
                                                } else {
                                                    echo'<br><b style="color:red">Palautusten takaraja oli ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
                                                    echo'<p>Voit silti tehdä palautuksen, mutta siihen tulee merkintä myöhästymisestä.</p>';
                                                }
                                            }
                                            if ($ryhma) {

                                                echo'<form action="tiedosto.php" method="post"><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" class="myButton8" name="painike" value="&#9763 Palauta uusi työ" style="font-size: 0.7em; padding: 2px"></form>';
                                            } else {

                                                echo'Voit tehdä palautuksen vasta, kun olet liittynyt johonkin ryhmään.<br><br>';
                                            }
                                        }
                                        echo "<br></div>";

                                        // tähän open tiedostot

                                        if (!$haetyot = $db->query("select distinct * from ryhmatope where ryhma_id='" . $opryhmaid . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }




                                        if ($haetyot->num_rows != 0) {
                                            echo'<div class="cm8-margin-left"><br>';
                                            echo '<h2 style="color: #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 20px">Opettajan lisäämät tiedostot:</h2>';

                                            echo '<table class="cm8-table3">';
                                            echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th>Tiedosto</th><th>Lisätty</th></tr>';

                                            while ($rowt = $haetyot->fetch_assoc()) {
                                                $tallnimi = $rowt[omatallennusnimi];
                                                $tyoid = $rowt[id];
                                                $linkki = $rowt[linkki];
                                                $palautettu = $rowt[lisayspvm];
                                                $palautuspaiva = substr($rowt[lisayspvm], 0, 10);
                                                $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                                $palautuskello = substr($rowt[lisayspvm], 11, 5);
                                                $rowt[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;
                                                $rowt[palaute] = str_replace('<br />', "", $rowt[palaute]);
                                                if ($linkki == 1) {
                                                    echo'<tr><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt[tyonimi] . '</a></p></td><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki">' . $rowt[omatallennusnimi] . '</a></td><td>' . $rowt[lisayspvm];


                                                    echo'</td></tr>';
                                                } else {
                                                    echo '<tr><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt[tyonimi] . '</a></td><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . ' target="_blank">' . $tallnimi . '</a></td><td>' . $rowt[lisayspvm];

                                                    echo'</td></tr>';
                                                }
                                            }
                                            echo "</table>";
                                            echo '</div>';
                                        }
                                    }


                                    echo"</div>";
                                }
                            }
                        }
                    } else {

                        if (!$kaikkiryhmat = $db->query("select distinct * from ryhmat where projekti_id='" . $pid . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        while ($rowKR = $kaikkiryhmat->fetch_assoc()) {


                            echo'<div class="cm8-responsive" style="width: 90%; ; margin-bottom: 30px; padding-bottom: 0px; background-color: #272227; color: #f7f9f7" >';
                            echo '<table class="cm8-tabler" style="table-layout:fixed; width: 100%; overflow-y: hidden; overflow-x:auto;">';
                            echo '<tr id=' . $rowKR[id] . ' ><th colspan="2">' . $rowKR[nimi] . "</th>";


                            if (!$ryhmanopiskelijat2 = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.ryhma_id='" . $rowKR[id] . "' AND kayttajat.rooli <> 'admin'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }

                            while ($rowRO = $ryhmanopiskelijat2->fetch_assoc()) {

                                echo '<tr style="border: 2px solid grey"><td>' . $rowRO[etunimi] . ' ' . $rowRO[sukunimi] . '</td><td></td></tr>';
                            }


                            echo "</table>";




                            if ($rowKR[suljettu] == 1)
                                echo'<p style="font-size:0.8em; margin-left: 5px; margin-top:5px; margin-bottom: 5px">Tämä ryhmä on suljettu</p>';



                            if ($opryhmaid == $rowKR[id]) {
                                if (!$haetyot = $db->query("select distinct * from ryhmat2 where ryhma_id='" . $opryhmaid . "' AND projekti_id='" . $pid . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                if (!$haemuut = $db->query("select distinct * from opiskelijankurssit where ryhma_id='" . $opryhmaid . "' AND projekti_id='" . $pid . "' AND opiskelija_id<>'" . $_SESSION["Id"] . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                if ($haemuut->num_rows > 0)
                                    echo'<form action="viestiryhmalle.php" method="post" style="display: inline-block"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $rowKR[id] . '><input type="submit" name="painike" class="myButton8" value="📧 &nbsp Lähetä viesti ryhmälle" style="padding:2px; margin-left: 10px"></form><br><br>';
                            }

                            if ($palautus == 1 && $opryhmaid == $rowKR[id]) {
                                if (!$haetyot = $db->query("select distinct ryhmat2.palaute as palaute, linkki, omatallennusnimi, tallennettunimi, tyonimi, ryhmat2.id as tyoid, lisayspvm from ryhmat2, opiskelijankurssit, opiskelijan_kurssityot where opiskelijan_kurssityot.projekti_id='" . $pid . "' AND opiskelijan_kurssityot.kayttaja_id=opiskelijankurssit.opiskelija_id AND opiskelijan_kurssityot.ryhmat2_id = ryhmat2.id  AND opiskelijankurssit.ryhma_id='" . $opryhmaid . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                if (!$RTsuljettu = $db->query("select distinct palautus_suljettu, palautus_sulkeutuu from projektit where id='" . $pid . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                while ($RTs = $RTsuljettu->fetch_assoc()) {
                                    $suljettu = $RTs[palautus_suljettu];
                                    $sulkeutuu = $RTs[palautus_sulkeutuu];
                                }
                                $nyt = date("Y-m-d H:i");
                                echo'<div class="cm8-margin-left"><br>';
                                echo '<h2 style="color: #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 10px">Omat palautukset:</h2>';
                                if ($haetyot->num_rows != 0) {
                                    echo '<table class="cm8-table3" style="font-size: 0.9em">';
                                    echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th >Tiedosto</th><th>Palautettu</th><th>Opettajan kommentti</th><th>Muokkaa / Poista</th></tr>';

                                    while ($rowt = $haetyot->fetch_assoc()) {
                                        $tallnimi = $rowt[omatallennusnimi];
                                        $tyoid = $rowt[tyoid];
                                        $linkki = $rowt[linkki];
                                        $palautettu = $rowt[lisayspvm];
                                        $palautuspaiva = substr($rowt[lisayspvm], 0, 10);
                                        $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                        $palautuskello = substr($rowt[lisayspvm], 11, 5);
                                        $rowt[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;
                                        $rowt[palaute] = str_replace('<br />', "", $rowt[palaute]);
                                        if ($linkki == 1) {
                                            echo'<tr><td ><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt[tyonimi] . '</a></p></td><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki">' . $rowt[omatallennusnimi] . '</a></td><td>' . $rowt[lisayspvm];

                                            if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                            }
                                            echo'</td><td>' . $rowt[palaute] . '</td>';
                                            echo'<td><form action="muokkaa_tiedosto_opiskelija.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form><form action="poistovarmistus.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="ryid" value=' . $opryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $rowt[tyoid] . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                        } else {
                                            echo '<tr><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt[tyoid] . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt[tyonimi] . '</a></td><td><a href=avaatiedosto.php?pid=' . $pid . '&id=' . $rowt[tyoid] . ' target="_blank">' . $tallnimi . '</a></td><td>' . $rowt[lisayspvm];
                                            if ($sulkeutuu != '' && $sulkeutuu < $palautettu) {
                                                echo'<br><em style="color: red; font-weight: bold"> Palautettu myöhässä!</em>';
                                            }
                                            echo'</td><td>' . $rowt[palaute] . '</td>';
                                            echo'<td><form action="muokkaa_tiedosto_opiskelija.php" method="get" style="display: inline-block; margin-right: 10px"><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="id" value=' . $tyoid . '><input type="submit" value="&#9998 Muokkaa" title="Muokkaa tiedostoa" class="pienikyna"></form><form action="poistovarmistus.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="ryid" value=' . $opryhmaid . ' ><input type="hidden" name="pid" value=' . $pid . '><input type="hidden" name="id" value=' . $rowt[tyoid] . '><button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form></td></tr>';
                                        }
                                    }
                                    echo "</table>";
                                }

                                if ($palautus == 1) {
                                    if (!$RTsuljettu = $db->query("select distinct palautus_suljettu, palautus_sulkeutuu from projektit where id='" . $pid . "'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }

                                    while ($RTs = $RTsuljettu->fetch_assoc()) {
                                        $suljettu = $RTs[palautus_suljettu];
                                        $sulkeutuu = $RTs[palautus_sulkeutuu];
                                    }
                                    $ryhma = false;
                                    if (!$haeryhma = $db->query("select distinct * from opiskelijankurssit where projekti_id='" . $pid . "' AND opiskelija_id='" . $_SESSION["Id"] . "' AND ryhma_id<>0")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }
                                    if ($haeryhma->num_rows > 0) {
                                        $ryhma = true;
                                        while ($rowryhma = $haeryhma->fetch_assoc()) {
                                            $opryhmaid = $rowryhma[ryhma_id];
                                        }
                                    }
                                    if ($sulkeutuu != ' ' && $sulkeutuu != NULL && !empty($sulkeutuu)) {

                                        if ($nyt <= $sulkeutuu) {
                                            echo'<br><b style="color: #c7ef00">Palautusten takaraja on ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b><br><br>';
                                        } else {
                                            echo'<br><b style="color:red">Palautusten takaraja oli ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
                                            echo'<p>Voit silti tehdä palautuksen, mutta siihen tulee merkintä myöhästymisestä.</p>';
                                        }
                                    }
                                    if ($ryhma) {

                                        echo'<form action="tiedosto.php" method="post"><input type="hidden" name="ryid" value=' . $opryhmaid . '><input type="hidden" name="pid" value=' . $pid . '><input type="submit" class="myButton8" name="painike" value="&#9763 Palauta uusi työ" style="font-size: 0.7em; padding: 2px"></form>';
                                    } else {

                                        echo'Voit tehdä palautuksen vasta, kun olet liittynyt johonkin ryhmään.<br><br>';
                                    }
                                }
                                echo "<br></div>";

                                // tähän open tiedostot

                                if (!$haetyot = $db->query("select distinct * from ryhmatope where ryhma_id='" . $opryhmaid . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }




                                if ($haetyot->num_rows != 0) {
                                    echo'<div class="cm8-margin-left"><br>';
                                    echo '<h2 style="color: #ec008d; text-decoration: underline; font-size: 1em; padding-top: 0px; padding-bottom: 20px">Opettajan lisäämät tiedostot:</h2>';

                                    echo '<table class="cm8-table3">';
                                    echo '<tr style="background-color: #ec008d"><th>Työn nimi</th><th>Tiedosto</th><th>Lisätty></th></tr>';

                                    while ($rowt = $haetyot->fetch_assoc()) {
                                        $tallnimi = $rowt[omatallennusnimi];
                                        $tyoid = $rowt[id];
                                        $linkki = $rowt[linkki];
                                        $palautettu = $rowt[lisayspvm];
                                        $palautuspaiva = substr($rowt[lisayspvm], 0, 10);
                                        $palautuspaiva = date("d.m.Y", strtotime($palautuspaiva));
                                        $palautuskello = substr($rowt[lisayspvm], 11, 5);
                                        $rowt[lisayspvm] = $palautuspaiva . ' klo ' . $palautuskello;
                                        $rowt[palaute] = str_replace('<br />', "", $rowt[palaute]);
                                        if ($linkki == 1) {
                                            echo'<tr><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki"><p><b style="font-size: 0.8em; font-weight: normal">&#128279; &nbsp</b>' . $rowt[tyonimi] . '</a></p></td><td><a href="' . $tallnimi . '" target="_blank" class="cm8-linkki">' . $rowt[omatallennusnimi] . '</a></td><td>' . $rowt[lisayspvm];


                                            echo'</td></tr>';
                                        } else {
                                            echo '<tr><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . '><b style="font-size: 0.8em"><i class="fa fa-file"></i>  &nbsp</b>' . $rowt[tyonimi] . '</a></td><td><a href=avaatiedosto_ope.php?pid=' . $pid . '&id=' . $tyoid . ' target="_blank">' . $tallnimi . '</a></td><td>' . $rowt[lisayspvm];

                                            echo'</td></tr>';
                                        }
                                    }
                                    echo "</table>";
                                    echo'</div>';
                                }
                            }


                            echo"</div>";
                        }
                    }
                }






                if (!$haetyot = $db->query("select distinct linkki, omatallennusnimi, tallennettunimi, tyonimi, ryhmat2.id as tyoid, lisayspvm from ryhmat2 where ryhma_id='" . $opryhmaid . "' AND projekti_id='" . $pid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                if (!$haeryhma = $db->query("select distinct ryhmat.nimi as rynimi, ryhmat.id as ryid from opiskelijankurssit, ryhmat where opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.ryhma_id=ryhmat.id AND opiskelijankurssit.projekti_id='" . $pid . "' AND opiskelijankurssit.projekti_id=ryhmat.projekti_id")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowry = $haeryhma->fetch_assoc()) {
                    $ryhmanimi = $rowry[rynimi];
                    $ryhmaid = $rowry[ryid];
                }

                echo'</div>';



                echo'</div>';
            }
        }
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}
echo"</div>";

echo "</div>";
echo "</div>";
include("footer.php");
echo'</body>
</html>	</!DOCTYPE html>';
?>	
