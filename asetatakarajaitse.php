<?php
session_start(); 


ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

echo'<!DOCTYPE html><html> 
<head>
<title> Itsearviointi</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
';


include("yhteys.php");
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}


if (isset($_SESSION["Kayttajatunnus"])) {
    include("kurssisivustonheader.php");

    include "libchart/libchart/classes/libchart.php";

    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px">';


    echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a>
          <a href="itsearviointi.php"  class="currentLink" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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



    echo '</div>';
    echo '<div class="cm8-container7" style="padding-left: 40px; margin-top: 0px; padding-top: 10px; padding-bottom: 60px">';




    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {



        if (!$projekti = $db->query("select * from itsearvioinnit where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $projekti->fetch_assoc()) {

            $sulkeutuu = $rowP[sulkeutuu];
        }


        if (!empty($sulkeutuu) && $sulkeutuu != ' ') {
            $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
            $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
            $takarajaon = 1;
        }


        $sulkeutumiskello = substr($sulkeutuu, 11, 5);
        echo'<div class="cm8-half" style="padding-top: 0px; margin-top: 0px">';




        echo '<form action="asetatakarajaitse2.php" class="form-style-k" method="post" autocomplete="off"><fieldset>';
        echo '<legend>Muokkaa itsearviointilomakkeen muokkauksen takarajaa</legend>';
        echo '<a href="itsearviointi.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br><br>';
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


        echo'<br><br><input id="button" type="submit" value="&#10003 Tallenna" name="tallenna" style="margin-right: 40px">
        
        <button name="poista" type="submit"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista takaraja</button>
	</fieldset></form>';
        echo "</div>";
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