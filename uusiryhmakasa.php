<?php
session_start();

ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Uusi projekti </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("kurssisivustonheader.php");



        echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 30px">';

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
	
	</nav>';


        echo '<div class="cm8-margin-top"></div>';
        echo' <h2>Lisää Palautus-osio</h2>';
        echo '<br><a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';

        echo '<div class="cm8-margin-top"></div>';
        echo'<div class="cm8-quarter">';
        echo '<form action="lisaaryhmakasa.php" method="post">

	<br>Ryhmien maksimimäärä:	<select name="lkm">';

        for ($i = 1; $i <= 100; $i++) {
            echo'
	<option value=' . $i . '>' . $i;
        }

        echo'</select><br><br>';

        echo'<br>Minimi henkilömäärä/ryhmä:	<select id="min" name="minimi">';

        for ($i = 1; $i <= 100; $i++) {
            echo'
	<option value=' . $i . '>' . $i;
        }

        echo'</select><br><br>';

        echo'<br>Maksimi henkilömäärä/ryhmä:	<select id="max" name="maksimi">';

        for ($i = 1; $i <= 100; $i++) {
            echo'
	<option value=' . $i . '>' . $i;
        }

        echo'</select><br><br>		
	<input type="hidden" name="kurssiId" value=' . $_SESSION["KurssiId"] . '>  						
	<br><input type="submit" value="&#10003 Lisää">
	</form>';
        ?>

        <script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="jscm/jquery-ui.js"></script>
        <script>

            (function () {
                var min = $('#min').val();
                $('#max').change(min);
            })();



        </script>

        <?php
session_start();
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo '</div>';

include("footer.php");
?>

</body>
</html>