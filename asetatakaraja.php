<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Muokkaa palautuksen takarajaa </title>';
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {
    if (!isset($_GET[r])) {

        if (!$hae_eka = $db->query("select MIN(id) as id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka->num_rows != 0) {
            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }
            header('location: ryhmatyot.php?r=' . $eka_id);
        }
    }

    include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
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



    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Palautukset</h2>';
    echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';
    if (!$hae_eka = $db->query("select id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka->num_rows == 1) {
        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
        echo'';
    } else {
        echo'';
    }



    echo'';
    if (!$haeprojekti = $db->query("select * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    if ($haeprojekti->num_rows != 0) {
        echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
        while ($rowP = $haeprojekti->fetch_assoc()) {
            $kuvaus = $rowP[kuvaus];
            $id = $rowP[id];
            if ($_GET[r] == $id) {

                echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
            } else {

                echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
            }
        }
        echo'<div class="cm8-margin-top"></div>';
    }









    echo'</nav>
 <div class="cm8-margin-top"></div></div>';
    if (!$onkoprojektia = $db->query("select * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($onkoprojektia->num_rows != 0) {

        if (!isset($_GET[r])) {
            if (!$hae_eka = $db->query("select MIN(id) as id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($hae_eka->num_rows != 0) {
                while ($rivieka = $hae_eka->fetch_assoc()) {
                    $eka_id = $rivieka[id];
                }
                header('location: ryhmatyot.php?r=' . $eka_id);
            }
        }
    }
    echo'<div class="cm8-half" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 40px">';


    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

        if (!$projekti = $db->query("select * from projektit where id='" . $_GET[r] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $projekti->fetch_assoc()) {
            $kuvaus = $rowP[kuvaus];
            $pid = $rowP[id];
            $sulkeutuu = $rowP[palautus_sulkeutuu];
        }


        if (!empty($sulkeutuu) && $sulkeutuu != ' ') {
            $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
            $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
            $takarajaon = 1;
        }


        $sulkeutumiskello = substr($sulkeutuu, 11, 5);





        echo '<form action="asetatakaraja2.php" class="form-style-k" method="post" autocomplete="off"><fieldset>';
        echo '<legend>Muokkaa kurssitöiden palautuksen takarajaa</legend>';
        echo '<a href="ryhmatyot.php?r=' . $pid . '" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br><br>';
        if ($takarajaon == 1) {
            echo'<p style="width: 50%">Päivämäärä:<br><b style="font-size: 0.8em; font-weight: normal">(annettava muodossa: pp.kk.yyyy)</b><br><br> 
    
            <input type="text" id="kdate" name="paiva" value=' . $sulkeutumispaiva . '></p><br>';
        } else {
            echo'<p style="width: 50%">Päivämäärä:<br><b style="font-size: 0.8em; font-weight: normal">(annettava muodossa: pp.kk.yyyy)</b><br><br> 
     
            <input type="text" id="kdate" name="paiva"></p><br>';
        }

        echo'<p style="width: 50%">Kellonaika:<br><b style="font-size: 0.8em; font-weight: normal">(annettava muodossa: tt:mm)</b><br><br>
       
               <input type="text" id="kello" name="kello" class="time" value="' . $sulkeutumiskello . '"></p>';
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
                    $('#kdate').datepicker({
                        dateFormat: 'dd.mm.yy',
                    });


                }
                $('#kello').timepicker({
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
session_start(); 


        ob_start();

        echo'<input type="hidden" name="pid" value=' . $pid . '>	
	<br><br><input id="button" type="submit" value="&#10003 Tallenna" name="tallenna" style="margin-right: 40px">
        
        <button name="poista" type="submit"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista takaraja</button>
	</fieldset></form>';
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";
echo "</div>";

include("footer.php");
?>
<script>
    var input = document.getElementById("kdate");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("kello");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
</body>
</html>	