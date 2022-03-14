<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Äänestä </title>
';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {
    if (!$haeonko = $db->query("select id from aanestykset where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if (!isset($_GET[a]) && $haeonko->num_rows != 0) {

        if (!$hae_eka = $db->query("select MIN(id) as id from aanestykset where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka->num_rows != 0) {
            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }
            header('location: aanestykset.php?a=' . $eka_id);
        }
    }


    include("kurssisivustonheader.php");


    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';
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
	  <a href="aanestykset.php" class="currentLink" >Äänestä</a><a href="osallistujat.php"   >Osallistujat</a>  	  
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
	  <a href="aanestykset.php" class="currentLink">Äänestä</a><a href="osallistujat.php"   >Osallistujat</a>  	  
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
    echo '<div class="cm8-margin-top"></div>';
    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"><h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Äänestä</h2>';

    if (!$haeaanestykset = $db->query("select * from aanestykset where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($haeaanestykset->num_rows != 0) {
        echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
        while ($rowP = $haeaanestykset->fetch_assoc()) {
            $kysymys = $rowP[kysymys];
            $id = $rowP[id];



            if ($_GET[a] == $id) {

                echo'<a href="aanestykset.php?a=' . $id . '" class="btn-info3" style="font-weight: normal; margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp</b> ' . $kysymys . '</a>';
            } else {

                echo'<a href="aanestykset.php?a=' . $id . '" class="btn-info3" style="font-weight: normal; margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kysymys . '</a>';
            }
        }

        echo'<div class="cm8-margin-top"></div>';
        if ($_SESSION["Rooli"] <> 'opiskelija') {
            echo'<form action="aktivoiaanestys.php" method="post" ><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikelisaa" value="+ Lisää äänestys" class="myButton8" role="button" style="padding:2px 4px"></form><br>';
        }
        echo'</div>';
    }



    echo'</div>';
    echo'<div class="cm8-threequarter" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px">';
    if ($_SESSION["Rooli"] == 'opiskelija') {

        if (!isset($_GET[a])) {
            if (!$haeaanestys = $db->query("select distinct * from aanestykset where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($haeaanestys->num_rows == 0) {

                echo'<br><em>Ei äänestyksiä.</em>';
            } else {
                echo'<br>Valitse oheisesta valikosta haluamasi äänestys.<br><br>';
            }
        } else {



            if (!$haeakt = $db->query("select distinct * from aanestykset where id='" . $_GET[a] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowa = $haeakt->fetch_assoc()) {

                if ($rowa[nakyvissa] == 1 && $rowa[aktiivinen] == 1) {
                    echo '<form name="form1">';
                    echo'<h5  id="' . $rowa[id] . '"  style="display: inline-block; padding-top:0px; font-size:1.1em">' . $rowa[kysymys] . '</h5>';
                    echo'<br>Vain viimeisin annettu vastaus rekisteröidään.<br>';
                    if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }


                    while ($rowb = $haevaihtoehdot->fetch_assoc()) {

                        echo'<br><br><input type="radio" name="vastaus" value=' . $rowb[id] . '> ' . $rowb[nimi];
                    }

                    echo'<br><br>';

                    echo'<input type="hidden" name="id" value=' . $rowa[id] . '> <br> 						
										<div class="cm8-quarter"> <input type="submit" onClick="submitAani()" name="painike" value="&#10003 Lähetä vastaus" class="myButton9"  role="button"  style="padding:2px 4px"></div></form>';
                    //tähän tulokset
                    echo'</div><div class="cm8-quarter">';
                    echo'<div id="tulokset"></div>';
                    echo'<b>Tämänhetkiset tulokset: </b><br><br>';

                    if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    // kaikki vaihtoehdot läpi

                    while ($rowv = $haevaihtoehdot->fetch_assoc()) {

                        if (!$haevastaukset = $db->query("select distinct * from aanestysvastaukset where aanestysvaihtoehdot_id='" . $rowv[id] . "' AND aanestys_id='" . $rowa[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        //kunkin vaihtoehdon vastaukset läpi

                        $maara = $haevastaukset->num_rows;

                        echo$rowv[nimi] . ': ' . $maara . ' kpl <br><br>';
                    }



                    echo'</div>';
                    echo'<div class="cm8-margin-bottom"></div>';
                } else if ($rowa[nakyvissa] == 1 && $rowa[aktiivinen] == 0) {


                    echo'<h5 id="' . $rowa[id] . '"  style="display: inline-block; padding-top:0px; font-size:1.1em">' . $rowa[kysymys] . '</h5>';

                    echo'<br><b style="color: #2b6777">Tulokset: </b><br><br>';

                    if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    // kaikki vaihtoehdot läpi

                    while ($rowv = $haevaihtoehdot->fetch_assoc()) {

                        if (!$haevastaukset = $db->query("select distinct * from aanestysvastaukset where aanestysvaihtoehdot_id='" . $rowv[id] . "' AND aanestys_id='" . $rowa[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        //kunkin vaihtoehdon vastaukset läpi

                        $maara = $haevastaukset->num_rows;

                        echo$rowv[nimi] . ': ' . $maara . ' kpl <br><br>';
                    }
                } else if ($rowa[nakyvissa] == 0) {
                    echo'<h5 id="' . $rowa[id] . '"  style="display: inline-block; padding-top:0px; font-size:1.1em">' . $rowa[kysymys] . '</h5>';
                    echo'<br><em>Äänestys ei ole aktiivinen.</em>';
                }
            }
        }
    } else {
        if (!isset($_GET[a])) {
            if (!$haeaanestys = $db->query("select distinct * from aanestykset where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($haeaanestys->num_rows == 0) {

                echo'<br><em>Ei äänestyksiä.</em>';
                echo'<form action="aktivoiaanestys.php" method="post"><br><br><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikelisaa" value="+ Lisää äänestys" class="myButton8" role="button" style="padding:2px 4px"></form>';
            } else {
                echo'<br>Valitse oheisesta valikosta haluamasi äänestys.<br><br>';
            }
        } else {

            if (!$haeaanestys = $db->query("select distinct * from aanestykset where id='" . $_GET[a] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowa = $haeaanestys->fetch_assoc()) {



                echo'<h5 id="' . $rowa[id] . '"  style="display: inline-block; padding-top:0px; font-size:1.1em">111' . $rowa[kysymys] . '</h5><form action="poistaaanestysvarmistus.php" method="post" style="margin-left: 30px; display: inline-block"><input type="hidden" name="aanid" value=' . $rowa[id] . '><input type="submit" name="painike" value="&#10007" title="Poista äänestys" class="myButton9" role="button" style="padding:2px 4px"></form>';


                if ($rowa[aktiivinen] == 0) {


                    echo'<br><b  style="color: #2b6777">Tulokset: </b><br><br>';

                    if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    // kaikki vaihtoehdot läpi

                    while ($rowv = $haevaihtoehdot->fetch_assoc()) {

                        if (!$haevastaukset = $db->query("select distinct * from aanestysvastaukset where aanestysvaihtoehdot_id='" . $rowv[id] . "' AND aanestys_id='" . $rowa[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        //kunkin vaihtoehdon vastaukset läpi

                        $maara = $haevastaukset->num_rows;

                        echo$rowv[nimi] . ': ' . $maara . ' kpl <br><br>';
                    }
                    if ($rowa[nakyvissa] == 0) {
                        echo'<em>Olet piilottanut äänestyksen opiskelijoilta, joten he eivät näe äänestystulosta.</em>';
                        echo'<form action="aktivoiaanestys.php" method="post" style="display: inline-block; margin-left: 30px"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikenayta" value="&#9757 Näytä" title="Näytä opiskelijoille" class="myButton8" role="button" style="padding:2px 4px;"></form>';
                    } else {
                        echo'<em>Opiskelijatkin näkevät äänestystulokset.</em>';
                        echo'<form action="aktivoiaanestys.php" method="post" style="display: inline-block; margin-left: 30px"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikepiilota" value="&#9759 Piilota" title="Piilota opiskelijoilta" class="myButton8" role="button" style="padding:2px 4px" ></form>';
                    }
                    echo'<br><br><br><form action="aktivoiaanestys.php" method="post"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikeaktivoi" value="&#9745 Aktivoi äänestys uudelleen" class="myButton8" role="button" style="padding:2px 4px"></form>';
                } else if ($rowa[aktiivinen] == 1 && $rowa[nakyvissa] == 1) {

                    echo'<br>Vain viimeisin annettu vastaus rekisteröidään.<br>';
                    echo '<form name="form1">';
                    if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }


                    while ($rowb = $haevaihtoehdot->fetch_assoc()) {

                        echo'<br><br><input type="radio" name="vastaus" value=' . $rowb[id] . '> ' . $rowb[nimi];
                    }

                    echo'<br><br>';

                    echo'<input type="hidden" name="id" value=' . $rowa[id] . '>						
						<input type="submit" name="painike" value="&#10003 Lähetä vastaus" class="myButton9"  role="button"  style="padding:2px 4px"></form><br>';



                    echo'<em>Opiskelijat voivat tällä hetkellä vastata kysymykseen.</em>';
                    echo'<form action="aktivoiaanestys.php" method="post" style="display: inline-block; margin-left: 30px"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikepiilota" value="&#9759 Piilota" title="Piilota opiskelijoilta" class="myButton8" role="button" style="padding:2px 4px"></form>';


                    echo'<br><form action="tulokset.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $rowa[id] . '>  <input type="submit" name="painikenayta" value="&#9763 Näytä äänestystilanne" class="myButton8" role="button" style="padding:2px 4px"></form>';

                    echo'<form action="aktivoiaanestys.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikesulje" value="&#9746 Sulje äänestys" class="myButton8" role="button" style="padding:2px 4px; margin-left: 30px"></form>';

                    //tähän tulokset
                    echo'</div><div class="cm8-quarter">';
                    echo'<div id="tulokset"></div>';
                    echo'<b>Tämänhetkiset tulokset: </b><br><br>';

                    if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    // kaikki vaihtoehdot läpi

                    while ($rowv = $haevaihtoehdot->fetch_assoc()) {

                        if (!$haevastaukset = $db->query("select distinct * from aanestysvastaukset where aanestysvaihtoehdot_id='" . $rowv[id] . "' AND aanestys_id='" . $rowa[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        //kunkin vaihtoehdon vastaukset läpi

                        $maara = $haevastaukset->num_rows;

                        echo$rowv[nimi] . ': ' . $maara . ' kpl <br><br>';
                    }



                    echo'</div>';
                } else if ($rowa[nakyvissa] == 0 && $rowa[aktiivinen] == 1) {
                    echo'<br>Vain viimeisin annettu vastaus rekisteröidään.<br>';
                    echo '<form name="form1">';
                    if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }


                    while ($rowb = $haevaihtoehdot->fetch_assoc()) {

                        echo'<br><br><input type="radio" name="vastaus" value=' . $rowb[id] . '> ' . $rowb[nimi];
                    }

                    echo'<br><br>';

                    echo'<input type="hidden" name="id" value=' . $rowa[id] . '>	
						
						 <input type="submit" name="painike" onClick="submitAani()" value="&#10003 Lähetä vastaus" class="myButton9"  role="button"  style="padding:2px 4px"></form>';



                    echo'<br><em>Opiskelijat eivät tällä hetkellä näe koko äänestystä.</em>';

                    echo'<form action="aktivoiaanestys.php" method="post" style="display: inline-block; margin-left: 30px"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikenayta" value="&#9757 Näytä" title="Näytä opiskelijoille" class="myButton8" role="button" style="padding:2px 4px;"></form>';

                    echo'<br><form action="tulokset.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $rowa[id] . '>  <input type="submit" name="painikenayta" value="&#9763 Näytä äänestystilanne" class="myButton8" role="button" style="padding:2px 4px"></form>';

                    echo'<form action="aktivoiaanestys.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikesulje" value="&#9746 Sulje äänestys" class="myButton8" role="button" style="padding:2px 4px; margin-left: 30px"></form>';
                } else if ($rowa[aktiivinen] == 0 || $rowa[nakyvissa] == 0) {


                    if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }


                    while ($rowb = $haevaihtoehdot->fetch_assoc()) {

                        echo'<br><br><input type="radio" name="vastaus" value=' . $rowb[id] . '> ' . $rowb[nimi];
                    }

                    echo'<br><br>';

                    echo'<br><em>Äänestys ei ole tällä hetkellä aktiivinen ja se on piilotettu kokonaan opiskelijoilta.</em>';

                    echo'<form action="aktivoiaanestys.php" method="post" style="display: inline-block; margin-left: 30px"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikeaktivoi" value="&#9745 Aktivoi" title="Aktivoi äänestys" class="myButton8" role="button" style="padding:2px 4px; font-size: 1.1em"></form>';
                }
            }
        }
    }


    echo'</div>';

    echo'</div>';
    echo'</div>';
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



include("footer.php");
?>

</body>
</html>		