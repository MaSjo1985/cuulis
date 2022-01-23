<?php
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Muokkaa lisäpisterajoja </title>';
include("yhteys.php");


// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {

    include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()"  class="currentLink">Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {

            $kysakt = $rowa[kysakt];
        }
        if ($kysakt == 1) {

//
//            echo'<a href="kysymykset2.php" target="_blank">Kysy/kommentoi</a>';
        } else {
//            echo'<a  href="kysymyksetkommentit.php">Kysy/kommentoi</a>';
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



    if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka->num_rows != 0) {
        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
    }


    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Tehtävälista</h2>';
    echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">

<a href="itsetyot.php?i=' . $eka_id . '"';

    if (!$haeprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($haeprojekti->num_rows != 0) {
        echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
        while ($rowP = $haeprojekti->fetch_assoc()) {
            $kuvaus = $rowP[kuvaus];
            $id = $rowP[id];

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
 <div class="cm8-margin-top"></div>';

    echo'<div class="cm8-threequarter" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 40px">';


    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $onkoprojekti->fetch_assoc()) {

            $ipid = $rowP[id];
            $kuvaus = $rowP[kuvaus];
        }

        if (!$onkorivi = $db->query("select distinct * from itseprojektit_tasot where itseprojekti_id='" . $ipid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if ($onkorivi->num_rows == 0) {
            $db->query("insert into itseprojektit_tasot (itseprojekti_id) values('" . $ipid . "')");
        }

        if (!$onkorivi2 = $db->query("select distinct * from itseprojektit_lpisteet where itseprojekti_id='" . $ipid . "' ORDER BY osuus DESC")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }





        echo '<form action="muokkaalisapisteita2.php" class="form-style-spinner"  method="post"><fieldset>';
        $maara = 0;
        $maara2 = 0;
        echo '<legend>Muokkaa lisäpisteiden rajoja</legend>';
        echo '<a href="itsetyot.php?i=' . $ipid . '" class="erilainen">&#8630&nbsp&nbsp&nbsp Palaa takaisin</a><br><br>';
        while ($row = $onkorivi2->fetch_assoc()) {
            $maara++;
            $maara2++;
            echo'<br><p style="display: inline-block;"><b style="margin-right: 10px">Tehtäviä tehty (%):&nbsp&nbsp&nbsp</b><input type="text" id="spinner' . $maara . '" style="width: 50px; " name="osuus[]" value=' . $row[osuus] . '></p>';

            echo'<p style="display: inline-block; margin-right: 40px"><b>Lisäpisteitä: &nbsp&nbsp&nbsp</b><input type="text" id="spinner2' . $maara2 . '" name="selite[]"  style="width: 50px" value=' . $row[pisteet] . '></p>';

            echo'<input type="hidden" name="id[]" value=' . $row[id] . '>';
            echo'<input type="hidden" name="lista" value=' . $row[id] . '>';
            echo'<button name="painikep" title="Poista rivi" style="margin-left: 40px;"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button>';
        }
        echo'<input type="hidden" id="ipid" name="ipid" value=' . $ipid . '>';
        echo'<input type="hidden" id="maara" name="maara" value=' . $maara . '>';
        echo'<input type="hidden" id="maara2" name="maara2" value=' . $maara2 . '>';
        echo'<br><br><br><input type="submit" name="painikel" value="+ Lisää uusi taso" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.9em">';

        echo'<br><br><br><br><input type="submit" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="padding:4px 6px; font-size: 0.9em">';

        echo'</fieldset></form>';
        ?>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="/resources/demos/external/jquery-mousewheel/jquery.mousewheel.js"></script>
        <script>
            $(function () {
                var maara = document.getElementById('maara').value;

                for (var i = 1; i <= maara; i++) {
                    $("#spinner" + i).spinner({
                        min: 0,
                        max: 100
                    });
                }

                var maara2 = document.getElementById('maara2').value;

                for (var j = 1; j <= maara2; j++) {
                    $("#spinner2" + j).spinner({
                        min: 0,
                        max: 1000
                    });
                }


            });
        </script>
        <?php
        ob_start();

        echo "</div>";
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
}

echo "</div>";
echo "</div>";

include("footer.php");
?>

</body>
</html>	