<?php
session_start(); 


ob_start();

echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';
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
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka->num_rows != 0) {
        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
    }


    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Palautukset</h2>';
    echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">


';
    if (!$haeprojekti = $db->query("select * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    if ($haeprojekti->num_rows != 0) {
        echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
        while ($rowP = $haeprojekti->fetch_assoc()) {
            $kuvaus = $rowP[kuvaus];
            $id = $rowP[id];
            if ($_GET[pid] == $id) {

                echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
            } else {

                echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
            }
        }
        echo'<div class="cm8-margin-top"></div>';

        if ($_SESSION["Rooli"] <> 'opiskelija') {
             echo'<form action="uusiprojekti.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää Palautus-osio" class="myButton8"  role="button"  style="padding: 2px 6px"></form>';
        
                echo'<form action="tuoprojekti.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '>';
           
 echo'<button  name="painike" title="Tuo Palautus-osio" class="myButton8" style="font-size: 0.8em"><i class="fa fa-recycle"></i>&nbsp&nbsp Tuo Palautus-osio </button>';
  echo'</form><br><br>';
            }
    }
    echo'</nav>
 <div class="cm8-margin-top"></div></div>

 


<div class="cm8-half" style="padding-top: 20px">';


    if (!$projekti = $db->query("select * from projektit where id='" . $_GET[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($projekti->num_rows != 0) {


        if (!$onkosuljettu = $db->query("select distinct lopullinen from ryhmat where id='" . $_GET[ryid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row = $onkosuljettu->fetch_assoc()) {

            $lopullinen = $row[lopullinen];
        }



        while ($rowP = $projekti->fetch_assoc()) {
            $kuvaus = $rowP[kuvaus];
            $pid = $rowP[id];
        }




        if (!$ryhma = $db->query("select * from ryhmat where id='" . $_GET[ryid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowR = $ryhma->fetch_assoc()) {
            $nimi = $rowR[nimi];
            $ryid = $rowR[id];
        }

        if (!$haeopiskelijat = $db->query("select distinct opiskelija_id as oid from opiskelijankurssit where ryhma_id='" . $_GET[ryid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $maara = $haeopiskelijat->num_rows;

        if ($maara == 1) {
            echo' <h8 style="font-size: 1.3em">Muokkaa opiskelijalle ';
        } else {
            echo' <h8 style="font-size: 1.3em">Muokkaa opiskelijoille ';
        }


        while ($rowOP = $haeopiskelijat->fetch_assoc()) {
            $oid = $rowOP[oid];

            if (!$haenimi = $db->query("select distinct etunimi, sukunimi from kayttajat where id='" . $oid . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowN = $haenimi->fetch_assoc()) {
                $maara--;
                echo$rowN[etunimi] . ' ' . $rowN[sukunimi];
                if ($maara > 0) {
                    echo', ';
                } else {
                    echo'';
                }
            }
        }
        echo' palautettua tiedostoa';
        echo'</h8>';
        echo '<br><br><a href="ryhmatyot.php?r=' . $_GET[pid] . '#' . $_GET[ryid] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br>';

        if (!$haetiedosto = $db->query("select * from ryhmatope where id='" . $_GET["id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($row = $haetiedosto->fetch_assoc()) {

            $id = $row[id];
            $ryid = $row[ryhma_id];
            $tyonimi = $row[tyonimi];
            $tallennettunimi = $row[tallennettunimi];
            $pid = $row[projekti_id];
            $omatallennusnimi = $row[omatallennusnimi];
            $linkki = $row[linkki];
        }

        echo'<div class="cm8-margin-top" ></div>';
        if ($linkki == 0) {
            echo'<form action="muokkaatiedostoope.php" method="POST" onSubmit="return validateFormOT()"  enctype="multipart/form-data" class="form-style-k"><fieldset style="width: 80%">';

            echo'<p><b>Tiedoston nimi: </b><b style="color: #e608b8">*</b><br><br><textarea class="textarea" rows="1" name="tyonimi" id="tyonimi">' . $tyonimi . '</textarea><br></p>
                 <div style="color: #e608b8; font-weight: bold; padding:0px; margin:0px" name="divID2" id="divID2">
    <p class="eimitaan" style="color: #e608b8; padding:0px; margin:0px"></p>
</div>
		<input type="hidden" name="pid" value=' . $pid . ' >
		<input type="hidden" name="ryid" value=' . $ryid . ' >
                    <input type="hidden" name="kaid" value=' . $_SESSION[Id] . ' >
                         <input type="hidden" name="id" value=' . $id . ' >
		<br><input type="submit" class="myButton9" id="button1" value="&#10003 Tallenna">
	</fieldset></form>';
        } else {

            echo'<form name="Form" id="myForm" onSubmit="return validateFormO()" action="muokkaalinkkiope.php" method="POST" class="form-style-k"><fieldset style="width: 80%">';


            echo'<p><b>Tiedoston nimi: </b><b style="color: #e608b8">*</b><br><br> <textarea class="textarea" type="text" name="kuvaus" rows="1" id="tama1">' . $tyonimi . '</textarea></p>
  <div style="color: #e608b8; font-weight: bold; padding:0px; margin:0px" name="divID" id="divID">
    <p style="color: #e608b8; padding:0px; margin:0px" id="demo4" class="eimitaan"></p>
</div> 

<p><b>Tiedoston URL-osoite</b>:<br> <input type="text" name="osoite" id="osoite" value=' . $omatallennusnimi . ' /></p>
	<input type="hidden" name="pid" value=' . $pid . ' >
		<input type="hidden" name="ryid" value=' . $ryid . ' >
                           <input type="hidden" name="kaid" value=' . $_SESSION[Id] . ' >
                                           <input type="hidden" name="id" value=' . $id . ' >
		<br><br><input type="button" onclick="validateFormO()" value="&#10003 Tallenna" id="button2" class="myButton9">

</fieldset></form>';
        }
    } else
        header("location: ryhmatyot.php");
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
    var input = document.getElementById("tyonimi");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button1").click();
        }
    });
</script>

<script>
    var input = document.getElementById("tama1");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button2").click();
        }
    });
</script>
<script>
    var input = document.getElementById("osoite");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button2").click();
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