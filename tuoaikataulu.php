<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Tuo aikataulu</title>
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



        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';


        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '" class="currentLink">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
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




        echo'<div class="cm8-container3" style="padding-top: 30px" >';




        echo'<h7>Tuo aikataulu toisesta kurssista/opintojaksosta</h7>';
        echo'<br><a href="muokkaa_aikataulu.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';



        $field = 'koodi';
        $sort = 'ASC';
        $nuoli = "&#8661";


        if (isset($_GET['sorting'])) {

            if ($_GET['sorting'] == 'ASC') {
                $sort = 'DESC';
            } else {
                $sort = 'ASC';
            }
        }


        if ($_GET['field'] == 'kurssit.nimi') {
            $field = "kurssit.nimi";
        } elseif ($_GET['field'] == 'koodi') {
            $field = "koodi";
        } elseif ($_GET['field'] == 'koulut.Nimi') {
            $field = "koulut.Nimi";
        } elseif ($_GET['field'] == 'luomispvm') {
            $field = "luomispvm";
        } elseif ($_GET['field'] == 'lukuvuosi') {
            $field = "lukuvuosi";
        } elseif ($_GET['field'] == 'alkupvm') {
            $field = "alkupvm";
        } elseif ($_GET['field'] == 'loppupvm') {
            $field = "loppupvm";
        }

        if (!$result = $db->query("select distinct lukuvuosi, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi from kurssit, koulut, kayttajat, kayttajankoulut, opiskelijankurssit where ((opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id) OR (kurssit.opettaja_id='" . $_SESSION["Id"] . "')) AND (kayttajat.id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id=kayttajat.id AND kurssit.koulu_id=koulut.id) ORDER BY $field $sort, alkupvm DESC")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($result->num_rows == 0)
            echo"<br><em>Ei kursseja/opintojaksoja.</em><br>";
        else {

          
            echo '<br><form action="tuoaikataulu.php" method="get">

			<br>&#128270 <input type="search"  onkeyup="showResultAika(this.value)" name="search"  id="search_box" class="haku" style="width: 50%"> 
		
			</form>';

            echo'<div style="margin-top: 0px; margin-bottom: 0px" id="searchresults">
<ul id="results" class="update">
</ul></div>';
            echo'<div id="scrollbar"><div id="spacer"></div></div>';
            
             
            echo'<div class="cm8-responsive" id="piilota">';
             echo'<br><b style="color: #e608b8" >Klikkaa sen kurssin/opintojakson nimeä, jonka aikataulun haluat tuoda.</b><br><br>';
            
            echo '<table id="mytable" class="cm8-table cm8-bordered cm8-stripedeivikaa" style="width: 99%"><thead>';

            echo '<tr><th><a href="tuoaikataulu.php?sorting=' . $sort . '&field=koodi">Koodi &nbsp&nbsp&nbsp' . $nuoli . '</a></th><th><a href="tuoaikataulu.php?sorting=' . $sort . '&field=kurssit.nimi">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli . '</a></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="tuoaikataulu.php?sorting=' . $sort . '&field=lukuvuosi">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli . '</a></th><th><a href="tuoaikataulu.php?sorting=' . $sort . '&field=alkupvm">Alkaa' . $nuoli . '</a></th><th><a href="tuoaikataulu.php?sorting=' . $sort . '&field=loppupvm">Päättyy' . $nuoli . ' </a></th></tr>';
            echo '</thead>';
            while ($row = $result->fetch_assoc()) {
                if (!$resulthaeope = $db->query("select distinct etunimi, sukunimi from kayttajat, kurssit where kurssit.id='" . $row[kid] . "' AND kayttajat.id=kurssit.opettaja_id")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowope = $resulthaeope->fetch_assoc()) {
                    $etunimi = $rowope[etunimi];
                    $sukunimi = $rowope[sukunimi];
                }
                $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));
                echo '<tr><td><a href="tuoaikataulu2.php?id=' . $row[kid] . '&ipid=' . $ipid . '&monesko=' . $_GET[monesko] . '">' . $row[koodi] . '</a></td><td><a href="tuoaikataulu2.php?id=' . $row[kid] . '&ipid=' . $ipid . '&monesko=' . $_GET[monesko] . '">' . $row[nimi] . '</a></td><td>' . $etunimi . ' ' . $sukunimi . '</td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td></tr>';
            }
            echo "</table>";
            echo "</div>";
            echo "<br>";
            echo "<br>";
        }
        ?>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
        <script>
            var $table = $('#mytable');

            $table.floatThead({zIndex: 1});

        </script>        
        <?php
session_start();
        echo'</div>





</div>';
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