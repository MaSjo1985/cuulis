<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Kysy/kommentoi </title>';
echo'<script src="basic-javascript-functions2.js" language="javascript" type="text/javascript">
</script>';
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("kurssiheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 20px">';
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
			
		  <a href="luento.php"   class="currentLink">Kysy/kommentoi</a> 
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
    echo'</div>';


    if ($_SESSION["Rooli"] == 'opiskelija') {
        echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 0px; border: none">';

        echo'<div class="cm8-third"> <h2>Kysy/kommentoi</h2></div>';

        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[luentoakt];
            $aihe = $rowa[luentoaihe];
            $luentopvm = $rowa[luentopvm];
            $kysakt = $rowa[kysakt];
        }



        echo'<div class="cm8-third" style="padding-top: 10px">Luennon aihe: &nbsp&nbsp<b>' . $aihe . '</b></div><div class="cm8-third" style="padding-top: 10px">Päivämäärä: &nbsp&nbsp<b>' . $luentopvm . '</b></div></div>';
    } else {
        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px">';



        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[luentoakt];
            $aihe = $rowa[luentoaihe];
            $luentopvm = $rowa[luentopvm];
            $kysakt = $rowa[kysakt];
        }

        echo'<div class="cm8-quarter"> <h2>Kysy/kommentoi</h2></div>';


        echo'<div class="cm8-quarter" style="padding-top: 10px">Luennon aihe: &nbsp&nbsp<b>' . $aihe . '</b></div><div class="cm8-quarter" style="padding-top: 10px">Päivämäärä:&nbsp &nbsp<b>' . $luentopvm . '</b></div>';

        echo'<div class="cm8-quarter" ><form action="aktivoiluento.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="hidden" name="aihe" value=' . $aihe . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa luentotietoja" class="myButton9"  role="button"  style="padding:2px 4px"></form><br><br>	 </div></div>';
    }
    if ($kysakt == 1) {
        ?>	
        <script language="javascript">
            function sayHelloWorld() {

                var hello = screen.height;
                var world = screen.width;

                window.open(
                        "kysymykset2.php?w1=" + hello + "&w2=" + world,
                        '_blank'
                        );

            }
        </script>   
        <?php
session_start(); 


        ob_start();

        echo'<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; margin-bottom:0px">';

        echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px">';
        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%">
<a href="luento.php" class="btn-info2 active"  style="box-shadow: 2px 2px 2px #888888">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a> 
<a class="btn-info2" style="cursor: hand"  onClick="sayHelloWorld()"  style="box-shadow: 2px 2px 2px #888888">Kysymykset/kommentit</a>';


        echo'</nav>

			 </div>';
    } else {
        ?>	
        <script language="javascript">
            function sayHelloWorld3() {

                var hello3 = screen.height;
                var world3 = screen.width;

                window.location.href = "kysymyksetkommentit.php?w1=" + hello3 + "&w2=" + world3;


            }
        </script>   
        <?php
session_start(); 


        ob_start();

        echo'<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; margin-bottom:0px">';

        echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px">';
        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%">
<a href="luento.php" class="btn-info2 active"  style="box-shadow: 2px 2px 2px #888888">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a> 
<a class="btn-info2" style="cursor: hand"  onClick="sayHelloWorld3()"  style="box-shadow: 2px 2px 2px #888888">Kysymykset/kommentit</a>';



        echo'</nav>

			 </div>';
    }
    echo'<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px">';


    echo'<div class="cm8-half" style="padding-top: 0px; margin-top: 0px">';

    if (!$haeilmoitus = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($rowv = $haeilmoitus->fetch_assoc()) {
        $viesti = $rowv[luentoilmoitus];
    }
    if ($viesti != "") {
        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin")
            echo'<form action="ilmoitus.php" method="post"><input type="submit" name="painikel" value="&#9998 Muokkaa" title="Muokkaa etusivun tekstiä" class="myButton9"  role="button"  style="padding: 2px 4px; font-size: 0.8em"></form>';

        echo'<div class="cm8-responsive">';

        echo'<table class="cm8-table" style="margin-left: 0px; padding-left: 0px; padding-bottom: 20px; border: none">';
        echo'<tr><td style="text-align: left; padding-top: 20px; padding-bottom: 20px">' . $viesti . '</td></tr>
					   </table></div>';


        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin")
            echo '<br>';
    }
    else {
        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin")
            echo '<form action="ilmoitus.php" method="post"><input type="submit" name="painikel" value="&#9998 Muokkaa etusivun tekstiä" title="Muokkaa etusivun tekstiä" class="myButton8"  role="button"  style="padding: 2px 4px; font-size: 0.8em"></form>';
    }
    echo'</div></div>
			
 	
</div>';
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