<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Poista keskustelu </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("kurssisivustonheader.php");



        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';

        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';


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



        echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 0px; border: none">';
        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[keskakt];
        }
        if ($akt == 0) {
            echo'<div class="cm8-quarter" ><h2 style="padding-top: 0px; padding-left: 10px; padding-bottom: 0px" id="lisaa">Keskustele</h2>';
        } else {

            echo'<div class="cm8-quarter" ><h2 style="padding-top: 0px; padding-left: 10px; padding-bottom: 0px" id="lisaa">Keskustele</h2>';

            echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; width: 90%;padding-left: 10px">';

            echo'<div class="cm8-sidenav" style="padding-left: 0px; margin-left: 0px; padding-top: 20px; margin-top:0px;  margin-left: 0px; height: 100%;">';

            if (!$haeonko = $db->query("select * from kurssin_keskustelut where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $onyksi = false;
            if ($haeonko->num_rows == 1) {
                $onyksi = true;
            }


            if (!$haeprojekti = $db->query("select * from kurssin_keskustelut where id='" . $_GET[r] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($haeprojekti->num_rows != 0) {

                while ($rowP = $haeprojekti->fetch_assoc()) {
                    $otsikko = $rowP[otsikko];
                    $id = $rowP[id];
                    $idtoinen = $rowP[id] . "/";
                    if ($_GET[r] == $id || $_GET[r] == $idtoinen) {

                        echo'<a href="keskustelut.php?r=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 6px 10px"><b style="font-size: 1em; ">&#9997 &nbsp&nbsp&nbsp' . $otsikko . ' </b></a>';
                    }
                    else{
                        echo'<sdas';
                    }
                }
            }





            if (!$haeprojekti3 = $db->query("select * from kurssin_keskustelut where kurssi_id='" . $_SESSION["KurssiId"] . "' ")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }



            if (!$haeakt = $db->query("select distinct * from kurssit where keskakt = 1 AND id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }




            if (!$haeprojekti = $db->query("select * from kurssin_keskustelut where kurssi_id='" . $_SESSION[KurssiId] . "' order by id desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }




            if ($haeprojekti->num_rows != 0) {

                while ($rowP = $haeprojekti->fetch_assoc()) {
                    $otsikko = $rowP[otsikko];
                    $id = $rowP[id];
                    $idtoinen = $rowP[id] . "/";

                    if ($_GET[r] != $id && $_GET[r] != $idtoinen){
                        echo'<a href="keskustelut.php?r=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px; padding: 3px 6px 6px 10px"><b style="font-size: 1em; ">' . $otsikko . '</b></a>';
                    }  
                        
                    }
                echo'<div class="cm8-margin-top"></div>';
            }
            if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

                if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowa = $haeakt->fetch_assoc()) {
                    $akt = $rowa[keskakt];
                }
                if ($akt != 0) {
                
                }
            }
            echo' </div></nav>';
        }
        echo'</div>';








        echo'<div class="cm8-half" style="margin-top: 0px; padding-top: 0px">';



        echo '<p style="font-weight: bold" >Haluatko todella poistaa koko keskustelun '.$otsikko.'?</p>';


        echo '<br><a href="poistakeskustelu.php?r=' . $_GET[r] . '"  class="myButton9"  role="button"  style="margin-right: 30px">Kyllä</a>';
        echo '<a href="keskustelut.php"  class="myButton9"  role="button"  style="margin-right: 30px">En</a><br>';


        echo'
</div></div></div>';
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

</body>
</html>	
