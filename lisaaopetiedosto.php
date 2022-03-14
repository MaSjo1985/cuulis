<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Lisää uusi materiaali </title>
';
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
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

                if ($id == $_POST[kid]) {
                    echo'<a href="tiedostot.php?k=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">&#128194 &nbsp <b>' . $nimi . '</b></a>';
                } else {

                    echo'<a href="tiedostot.php?k=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">&#128193 &nbsp ' . $nimi . '</a>';
                }
            }

            echo'<div class="cm8-margin-top"></div>';


            echo'</div>';
        }




        echo' 
 
	
</nav>

 </div>
    <div id="content" class="cm8-twothird" style="padding-left: 20px; margin-right: 0px; margin-top: 40px; margin-bottom: 0px; padding-bottom: 10px">';
        if (isset($_POST[kid])) {
            echo'   <h6 style="font-size: 1.2em;  color: #e608b8;">Valitse, millaisen tiedoston / linkin haluat lisätä</h6><br><a href="tiedostot.php?k=' . $_POST[kid] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
        } else {
            echo' <h6 style="font-size: 1.2em; color: #e608b8;">Valitse, millaisen tiedoston / linkin haluat lisätä</h6><br><a href="tiedostot.php?k=' . $_GET[kid] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
        }


        echo '<form action="lahetaopetiedosto8.php" class="form-style-k" method="POST" enctype="multipart/form-data"><fieldset style="width: 80%">';
        echo'<legend>1&nbsp&nbsp Lisää tiedosto omalta laitteelta &nbsp&nbsp </legend>
       
	

<p style="color: #e608b8; font-size: 1em" class="eimitaan"><b>Huom! </b><b style="font-weight: normal">Tiedoston maksimikoko on 20,0MB.<br>Sallitut tiedostomuodot: .pdf,  .tnsp, .tns, .docx, .ods, .odt, .odp, .odg, .csv, .zip, .rar, .doc, .dat, .ppt, .txt tai .rtf, .ppt, .pptx, .xls, .xlsx, .png, .jpg, 	</b></p>
<br><input type="hidden" name="kid" value=' . $_POST[kid] . '> 
			<br><input type="file" name="my_file[]" style="font-size: 0.9em" multiple="" >
 	
		<br><br><br><input type="submit" value="&#10003 Tallenna" class="myButton9">
	</fieldset></form>';



        echo'  <script type="text/javascript">

    </script>';


//multiple="" 

        echo'<form name="Form" id="myForm" onSubmit="return validateForm()" class="form-style-k" action="lahetaopetiedostolinkki.php" class="" method="POST"><fieldset style="width: 80%">';
        echo'<legend>2)&nbsp&nbsp Lisää tiedosto linkkinä &nbsp&nbsp </legend>';





        echo'
	<p><b>Tiedoston nimi:</b> <b style="color: #e608b8">*</b><br> <input type="text" name="kuvaus" id="tama1"/></p>';


        echo'<div style="color: #e608b8; font-weight: bold; padding:0px; margin:0px" name="divID" id="divID">
    <p class="eimitaan"></p>
</div>';

        echo'<p><b>Tiedoston URL-osoite</b>:<br> <input type="text"  name="osoite" id="osoite" /></p>
	<input type="hidden" id="kid" name="kid" value=' . $_POST[kid] . '> 
           <input type="hidden" id="upotus" name="upotus" value="0"> 
          <input type="hidden" id="youtube" name="youtube" value="0">
		<br><br><input id="button1" type="button" onclick="validateForm()" value="&#10003 Tallenna" class="myButton9">

</fieldset></form>';


        echo'<form name="Form2" id="myForm2" onSubmit="return validateFormU()" class="form-style-k" action="lahetaopetiedostolinkki.php" method="POST"><fieldset style="width: 80%">';
        echo'<legend>3)&nbsp&nbsp Lisää upotuslinkki &nbsp&nbsp </legend>';

        echo'
	<p><b>Tiedoston nimi:</b><b style="color: #e608b8">*</b><br> <input type="text"  name="kuvaus" id="tama2"/></p>';
        echo'<div style="color: #e608b8; font-weight: bold; padding:0px; margin:0px" name="divID2" id="divID2">
  <p class="eimitaan"></p>
</div>';
        echo'<p><b>Tiedoston URL-osoite:</b><br> <input type="text"  name="osoite" id="osoite2"/></p>
	<input type="hidden" name="kid" value=' . $_POST[kid] . '> 
            <input type="hidden" id="upotus" name="upotus" value="1"> 
          <input type="hidden" id="youtube" name="youtube" value="0">
		<br><br><input id="button2" type="button" onclick="validateFormU()" value="&#10003 Tallenna" class="myButton9">

</fieldset></form>';


        echo'<form name="Form3" id="myForm3" onSubmit="return validateFormY()" class=" form-style-k" action="lahetaopetiedostolinkki.php" method="POST"><fieldset style="width: 80%">';
        echo'<legend>4)&nbsp&nbsp Lisää Youtube-upotuslinkki &nbsp&nbsp </legend>';

        echo'
	<p><b>Tiedoston nimi: </b><b style="color: #e608b8">*</b><br> <input type="text"  name="kuvaus" id="tama3"/></p>';
        echo'<div style="color: #e608b8; font-weight: bold; padding:0px; margin:0px" name="divID3" id="divID3">
<p class="eimitaan"></p>
</div>';
        echo'<p><b>Youtuben upotuskoodi:</b><br> <input type="text" id="osoite3"  name="osoite" /></p>
	<input type="hidden" name="kid" value=' . $_POST[kid] . '> 
            <input type="hidden" id="youtube" name="youtube" value="1"> 
          <input type="hidden" id="upotus" name="upotus" value="0"> 
		<br><br><input id="button3" type="button" onclick="validateFormY()" value="&#10003 Tallenna" class="myButton9">

</fieldset></form>';
        echo'</div>';
        echo'</div>';
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
<script>
    var input = document.getElementById("tama1");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button1").click();
        }
    });
</script>
<script>
    var input = document.getElementById("osoite");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button1").click();
        }
    });
</script>
<script>
    var input = document.getElementById("tama2");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button2").click();
        }
    });
</script>
<script>
    var input = document.getElementById("osoite2");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button2").click();
        }
    });
</script>
<script>
    var input = document.getElementById("tama3");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button3").click();
        }
    });
</script>
<script>
    var input = document.getElementById("osoite3");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button3").click();
        }
    });
</script>

</body>
</html>	