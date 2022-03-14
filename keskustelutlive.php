<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Keskustele </title>
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
	  <a href="keskustelut.php" class="currentLink" >Keskustele</a> 
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
	  <a href="keskustelut.php" class="currentLink">Keskustele</a> 
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


    echo '<div class="cm8-margin-top"></div>';
    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"><h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Keskustele</h2>';



    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'opeadmin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'admin') {
        echo'<div class="cm8-margin-top"></div>';
        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[keskakt];
            $kaihe = $rowa[keskusteluaihe];
            $opeid = $rowa[opettaja_id];
        }
        if ($akt == 1) {

            echo'<form action="aktivoikeskustelu.php" method="post" style="margin-bottom: 20px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikep" value="- Piilota toiminto" class="myButton8" role="button" style="padding:2px 4px; margin-right: 10px"></form>';
        }
    }
    echo'</div>';





    echo'<div class="cm8-threequarter cm8-margin-left" style="padding-top: 30px">';



    if ($_SESSION["Rooli"] == 'opiskelija') {


        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[keskakt];
            $kaihe = $rowa[keskusteluaihe];
            $opeid = $rowa[opettaja_id];
        }
        if ($akt == 0) {
            echo'<div id="akt4"></div>';
        } else {



            echo'<h6 style="color: #2b6777">' . $kaihe . '</h6>';




            if (!$haekeskustelu = $db->query("select distinct * from keskustelut where kurssi_id='" . $_SESSION["KurssiId"] . "' order by id desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            if ($haekeskustelu->num_rows == 0) {

                echo'<br><br><em>Ei viestejä</em><br><br>';
            } else {
                echo'<div class="cm8-margin-top"></div>';
                echo'<div id="chatlogs"></div>';
            }



            $paiva = date("j.n.Y");

            $kello = date("H:i");

            $nimi = $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"];




            echo'<form name="form1">';



            echo'<br><b>Nimimerkki:</b><br>
                                                                
                                                               <textarea name="nimi" rows="1" style="width: 40%">' . $nimi . '</textarea><br>';
            echo'<em>(Todellinen lähettäjä voidaan selvittää.)</em>';
            echo'<br><br><b>Viesti:</b> <br> <textarea id="sendie" name="uusi" rows="4" style="width: 40%" maxlength="255" style="font-size: 0.9em"></textarea>
								<input type="hidden" name="paiva" value=' . $paiva . '>
								<input type="hidden" name="kello" value=' . $kello . '>
                                                                    
								
<div id="akt5"></div>
                                                                
                                                    </form>
							</div>';
        }
    } else {

        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[keskakt];
            $kaihe = $rowa[keskusteluaihe];
            $opeid = $rowa[opettaja_id];
        }
        if ($akt == 0) {
            echo'<br><em>Toimintoa ei ole aktivoitu.</em><form action="aktivoikeskustelu.php" method="post"><br><br><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikea" value="+ Aktivoi toiminto" class="myButton8" role="button" style="padding:2px 4px"></form></div>';
        } else {

            echo'<h6 style="display: inline-block; color: #2b6777">' . $kaihe . '</h6>';


            echo'<form action="aktivoikeskustelu.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikem" value="&#9998 Muokkaa" title="Muokkaa keskusteluaihetta" class="myButton9"  role="button"  style="padding:2px 4px"></form>';




            if (!$haekeskustelu = $db->query("select distinct * from keskustelut where kurssi_id='" . $_SESSION["KurssiId"] . "' order by id desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            if ($haekeskustelu->num_rows == 0) {

                echo'<br><br><em>Ei viestejä</em><br><br>';
            } else {
                echo'<br><p id="ohje"><em>Yksittäisen viestin saat poistettua klikkaamalla sitä. Samalla saat selville sen lähettäneen opiskelijan.</em></p>';
                echo'<div class="cm8-margin-top"><br></div>';
                echo'<div id="chatlogs"></div>';
            }

            echo'<div class="cm8-margin-top"></div>';

            $paiva = date("j.n.Y");
            $kello = date("H:i");
            $nimi = $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"];

            if (!$haekeskustelu = $db->query("select distinct * from keskustelut where kurssi_id='" . $_SESSION["KurssiId"] . "' order by id desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            if ($haekeskustelu->num_rows != 0) {


                echo'<form action="poistakeskustelutvarmistus.php" method="post" style=" margin-right: 30px; display: inline-block">';
                echo'<button class="pieniroskis" title="Poista kaikki viestit"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista kaikki viestit</button>';
                echo'</form>';
                echo'<a href="valitsekeskustelu.php" class="myButton8"  role="button"  style="padding: 2px 4px">&#10007 Valitse poistettavat viestit</a><br><br>';
            }
            echo'<form name="form1">
						<br><b>Nimimerkki:</b> <br><textarea name="nimi" rows="1" style="width: 40%">' . $nimi . '</textarea><br><br><b>Viesti:</b> <br> <textarea id="sendie" name="uusi" rows="4" style="width: 40%" maxlength="255"></textarea>
								<input type="hidden" name="paiva" value=' . $paiva . '>
								<input type="hidden" name="kello" value=' . $kello . '>
                                                              
 <br><br><a href="" onClick="submitChat2()"  class="myButton9" id="tanne" role="button"   > Lähetä</a>
   
								</form>';


            echo'<div class="cm8-margin-top"></div>';





            echo'</div>';
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