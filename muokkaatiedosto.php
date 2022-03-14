<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Materiaalit </title>
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
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  class="currentLink">Materiaalit</a>  
	  
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
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  class="currentLink">Materiaalit</a>  
	
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

    echo'<div <div class="cm8-third" style="padding-left: 20px;width: 25%; margin-right: 40px; margin-top: 40px; padding-top: 0px "> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Materiaalit</h2>';

    echo '<nav class="cm8-sidenav " style="margin-left: 0px;padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';


    if (!$haekansio = $db->query("select * from kansiot where kurssi_id='" . $_SESSION["KurssiId"] . "' order by nimi asc")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($haekansio->num_rows != 0) {

        $numeric1 = 0;
        $numeric3 = 0;
        while ($rowekak = $haekansio->fetch_assoc()) {
            $id = $rowekak[id];
            $nimi = $rowekak[nimi];
            if (is_numeric($rest = substr($nimi, 0, 1))) {

                $numeric1 = 1;
            } else if (is_numeric($rest = substr($nimi, 0, 3))) {

                $numeric3 = 1;
            }
        }

        if ($numeric1 == 1) {

            if ($numeric3 == 1) {

                if (!$haekansio = $db->query("select distinct * from kansiot where kurssi_id='" . $_SESSION[KurssiId] . "' order by  SUBSTR(nimi FROM 1 FOR 1),
    CAST(SUBSTR(nimi FROM 3) AS UNSIGNED)")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
            } else {
                if (!$haekansio = $db->query("select distinct * from kansiot where kurssi_id='" . $_SESSION[KurssiId] . "' order by cast(nimi as unsigned) asc")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
            }
        } else {
            if (!$haekansio = $db->query("select distinct * from kansiot where kurssi_id='" . $_SESSION[KurssiId] . "' order by nimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
        }
        echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';


        while ($rowK = $haekansio->fetch_assoc()) {
            $nimi = $rowK[nimi];
            $id = $rowK[id];

            if ($_POST[kaid] == $id) {
                echo'<a id="' . $id . '" href="tiedostot.php?k=' . $id . '" class="btn-info3-valittu"  style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">&#128194 &nbsp <b>' . $nimi . '</b></a>';
            } else {
                echo'<a id="' . $id . '" href="tiedostot.php?k=' . $id . '" class="btn-info3"  style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">&#128193 &nbsp ' . $nimi . '</a>';
            }
        }

        echo'<div class="cm8-margin-top"></div>';
        if ($_SESSION["Rooli"] <> 'opiskelija') {
            echo'<form action="uusikansio.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää uusi kansio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';

            echo'<form action="tuokansio.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Tuo kansio" class="myButton8"  role="button"  style="padding:2px 4px"></form><br><br>';
        }

        echo'</div>';
    }





    echo' 
 
	
</nav>

 </div>
 
    <div id="content" class="cm8-twothird" style="padding-left: 20px; margin-right: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px">';

    if (!$result = $db->query("select distinct * from tiedostot where id = '" . $_POST[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }




    while ($row2 = $result->fetch_assoc()) {
        $osoite = $row2[omatallennusnimi];
        $kuvaus = $row2[kuvaus];
        $id = $row2[id];
        $linkki = $row2[linkki];
        $vanhalinkki = $row2[vanhalinkki];
        $youtube = $row2[youtube];
        $upotus = $row2[upotus];
        if ($linkki == 1) {
            $osoite = str_replace('<br />', "", $osoite);
        }
        if ($vanhalinkki == 1) {
            $kuvaus = str_replace('<br />', "", $kuvaus);
        }
    }

    if ($linkki == 1 && $youtube == 0 && $upotus == 0) {


        echo'<form name="Form" id="myForm" class="form-style-k" onSubmit="return validateForm()" action="muokkaatiedosto2.php" method="POST"><fieldset>';
        echo' <legend>Muokkaa tiedoston nimeä</legend>';
        echo '<a href="tiedostot.php?k=' . $_POST[kaid] . '" class="palaa">&#8630&nbsp&nbsp&nbsp Palaa takaisin</a>';

        echo'<div style="color: #e608b8; font-weight: bold; padding:0px; margin:0px" name="divID" id="divID">
    <p class="eimitaan"></p>
</div>';
        echo'
	<br><br><p style="width: 100%">Tiedoston nimi: <b style="color: #e608b8">*</b><br> <textarea class="textarea" rows="1" name="kuvaus" id="tama1" style="width: 40%">' . $osoite . '</textarea>
			<br><p style="width: 100%">Tiedoston URL-osoite:<br> <input type="text" name="osoite" id="osoite" style="width: 100%" value=' . $kuvaus . '></p>
<input type="hidden" name="id" value=' . $id . ' ><br>
    <input type="hidden" name="kaid" value=' . $_POST[kaid] . ' >
	<br><input id="button" type="button" onclick="validateForm()" value="&#10003 Tallenna" class="myButton9">			
	</fieldset></form>';
    } else if ($upotus == 1) {
        echo'<form name="Form" id="myForm2" onSubmit="return validateFormU()" class="form-style-k" action="muokkaatiedosto2.php" method="POST"><fieldset>';
        echo' <legend>Muokkaa tiedoston nimeä</legend>';
        echo '<a href="tiedostot.php?k=' . $_POST[kaid] . '" class="palaa">&#8630&nbsp&nbsp&nbsp Palaa takaisin</a>';

        echo'<div style="color: #e608b8; font-weight: bold; padding:0px; margin:0px" name="divID2" id="divID2">
    <p style="padding:0px; margin:0px" id="demo2" class="eimitaan"></p>
</div>';
        echo'
	<br><br><p style="width: 100%">Tiedoston nimi:<b style="color: #e608b8">*</b><br> <textarea class="textarea" name="kuvaus" id="tama2" rows="1">' . $osoite . '</textarea>';

        echo'<br><p style="width: 100%">Tiedoston URL-osoite:<br> <input type="text" id="osoite"  name="osoite" value=' . $kuvaus . '></p>';



        echo'<input type="hidden" name="id" value=' . $id . ' > 
    <input type="hidden" name="vanhalinkki" value="1" >
      <input type="hidden" name="kaid" value=' . $_POST[kaid] . ' ><br>
	<br><input id="button" type="button" onclick="validateFormU()" value="&#10003 Tallenna" class="myButton9">			
	</fieldset></form>';
    } else if ($youtube == 1) {
        echo'<form name="Form" id="myForm3" onSubmit="return validateFormY()" class="form-style-k" action="muokkaatiedosto2.php" method="POST"><fieldset>';
        echo' <legend>Muokkaa tiedoston nimeä</legend>';
        echo '<a href="tiedostot.php?k=' . $_POST[kaid] . '" class="palaa">&#8630&nbsp&nbsp&nbsp Palaa takaisin</a>';

        echo'<div style="color: #e608b8; font-weight: bold; padding:0px; margin:0px" name="divID3" id="divID3">
    <p style="padding:0px; margin:0px" id="demo3" class="eimitaan"></p>
</div>';
        echo'
	<br><br><p style="width: 100%">Tiedoston nimi: <b style="color: #e608b8">*</b><br> <textarea class="textarea"  rows="1" name="kuvaus" id="tama3">' . $osoite . '</textarea>';

        echo'<br><p style="width: 100%"><b>Youtube-upotuskoodi</b>:<br> <input type="text" id="osoite" name="osoite" value=' . $kuvaus . '></p>';



        echo'<input type="hidden" name="id" value=' . $id . ' > 
    <input type="hidden" name="vanhalinkki" value="1" >
      <input type="hidden" name="kaid" value=' . $_POST[kaid] . ' ><br>
	<br><input id="button" type="button" onclick="validateFormY()" value="&#10003 Tallenna" class="myButton9">			
	</fieldset></form>';
    }






    echo'
</div></div></div>';
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



include("footer.php");
?>
<script>
    var input = document.getElementById("tama1");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("tama2");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("tama3");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("osoite");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    $(".textarea").keydown(function (e) {
// Enter was pressed without shift key
        if (e.keyCode == 13 && !e.shiftKey)
        {
            // prevent default behavior
            e.preventDefault();
        }
    });
</script>
</body>
</html>	