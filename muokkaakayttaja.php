<?php
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Muokkaa tietoja </title>';

include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("header.php");
        include("header2.php");

        echo'<div class="cm8-container7">';
        if ($_SESSION["Rooli"] == 'admin')
            include("adminnavi.php");
        else if ($_SESSION["Rooli"] == 'admink')
            include("adminknavi.php");
        else if ($_SESSION["Rooli"] == 'opeadmin')
            include("opeadminnavi.php");
        echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';

        if (isset($_POST[id])) {

            if (!$result22 = $db->query("select * from kayttajat where id = '" . $_POST[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row22 = $result22->fetch_assoc()) {
                $etunimi = $row22[etunimi];
                $sukunimi = $row22[sukunimi];
                $sposti = $row22[sposti];
                $rooli = $row22[rooli];
                $id = $row22[id];
            }
        } else if (isset($_GET[id])) {

            if (!$result22 = $db->query("select * from kayttajat where id = '" . $_GET[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row22 = $result22->fetch_assoc()) {
                $etunimi = $row22[etunimi];
                $sukunimi = $row22[sukunimi];
                $sposti = $row22[sposti];
                $rooli = $row22[rooli];
                $id = $row22[id];
            }
        }
        echo"<h7>Muokkaa käyttäjän " . $etunimi . " " . $sukunimi . " tietoja</h7>";

        echo'<br><a href="kayttaja.php?url=' . $url . '&ka=' . $id . '"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin käyttäjäprofiiliin<br></a>';

        echo'<div class="cm8-half" style="margin-top: 0px; padding-top: 0px; padding-left: 0px">';
        echo '<form name="Form" id="myForm" class="form-style-k" onSubmit="return validateForm11();"  action="muokkaakayttaja2.php" method="post"><fieldset>';

        echo'<legend>Profiilikuva</legend>';
        if (!$result = $db->query("select * from kayttajat where id = '" . $id . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row2 = $result->fetch_assoc()) {
            $etunimi = $row2[etunimi];
            $sukunimi = $row2[sukunimi];
            $sposti = $row2[sposti];
            $rooli = $row2[rooli];
            $id = $row2[id];
            $omakuva = $row2[omakuva];
        }

        if ($omakuva != '') {
            echo'<img src="/' . $omakuva . '" style="width: 90px"><br>';
        } else {
            echo'<br>';
        }



        if (empty($omakuva)) {

            echo'<br><a href="lisaaomakuvak.php?kaid=' . $id . '" class="buttonlinkki"  role="button" >+ Lisää profiilikuva</a><br>';
        } else {
            echo'<br><br><a href="muokkaaomakuvak.php?kaid=' . $id . '" class="buttonlinkki"  role="button"  style="margin-right: 30px;">&#9998 Vaihda kuva</a>';
            echo'<a href="poistaomakuvavarmistusk.php?kaid=' . $id . '" class="buttonlinkki"  role="button" >&#10007 Poista kuva</a>';
        }

        echo'</fieldset>';
        echo'<br><fieldset>';

        echo'<legend>Perustiedot</legend>';

        echo'<p>Etunimi:<br>
            
  
<input type="text" id="etu"  style="width: 50%" name="uusietu" value=' . $etunimi . ' ></p>
    <div style="display: inline-block; color: red; font-weight: bold; padding-top: 0px" id="divID">
    <p class="eimitaan"></p>
</div> <br>
    

					<p>Sukunimi:<br> 
   

<input type="text" id="suku"  style="width: 50%" name="uusisuku" value=' . $sukunimi . ' ></p>
                                         
                                        <div style="display: inline-block; color: red; font-weight: bold; padding-top: 0px" id="divID2">
    <p class="eimitaan"></p>
</div> <br> 
					<p>Sähköpostiosoite:<br> 
 <input type="email" id="sposti" style="width: 50%" name="uusisposti" value=' . $sposti . ' ></p>
      <div style="display: inline-block; color: red; font-weight: bold; padding-top: 0px" id="divID3">
    <p class="eimitaan"></p>
</div> <br>
				<input type="hidden" id="id" name="id" value=' . $id . ' >
				<br><input type="button" id="button" onclick="validateForm11()" value="&#10003 Tallenna perustiedot" class="myButton9" style="font-size: 0.9em"><br>			
						</fieldset></form>';


        if ($_SESSION[Rooli] == 'admin') {
            echo '<form action="muokkaakayttajankoulu.php" class="form-style-k" method="post">';
            echo'<fieldset>';
            echo'<legend>Oppilaitokset</legend>';

            echo '<br><b style="font-size: 1em">Oppilaitokset, joihin käyttäjä on liittynyt:</b><br>';
            if (!$result2 = $db->query("select distinct kayttajat.id as kaid, koulut.id as koid, etunimi, sukunimi, rooli, sposti, Nimi from kayttajat, kayttajankoulut, koulut where kayttajat.id='" . $id . "' AND kayttajankoulut.odottaa=1 AND kayttajat.id=kayttajankoulut.kayttaja_id AND kayttajankoulut.koulu_id=koulut.id")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($row2 = $result2->fetch_assoc()) {
                echo "<br>" . $row2[Nimi];
                echo'<a href="poistakoulusta.php?id=' . $id . '&kouluid=' . $row2[koid] . '" class="myButton9" style="margin-left: 20px; font-size: 0.7em">X Poista oppilaitoksesta</a>';

//            
//            echo' <form action="poistukoulustavarmistus.php" method="post" style="display: inline-block"><br><br><input type="hidden" name="koid" value=' . $row2[koid] . '><input type="hidden" name="kaid" value=' . $_SESSION["Id"] . '><input type="submit" name="painikep" value="&#10007" title="Poista aikataulu" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
//        
            }


            echo '<br><br><p style="font-weight: normal; padding-top: 10px"><b style="font-size: 1.1em">Liitä käyttäjä uuteen oppilaitokseen:</b><br><br>';


            if (!$resultkoulut = $db->query("select distinct Nimi, koulut.id as kid from koulut, kayttajankoulut where koulut.id NOT IN(select distinct koulut.id from koulut, kayttajankoulut where kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id='" . $id . "')")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $maara = 0;
            while ($rowko = $resultkoulut->fetch_assoc()) {
                $maara++;
                echo'<input type="checkbox" id=' . $maara . ' class="formi" class="pieni" name="lista[]" value=' . $rowko[kid] . '>';
                echo'<label for=' . $maara . '>' . $rowko[Nimi] . '</label><br>';
            }
            echo'</p>';
            echo'<input type="hidden" name="id" value=' . $row2[id] . '> 
            <input type="hidden" id="id" name="kaid" value=' . $id . ' >
			<br>		
			<input type="submit" value="&#10003  Liitä" style="font-size: 0.9em">			
				</fieldset></form>';
        }




        echo'</div>';
        echo'</div>';
        echo'</div>';

        include("footer.php");
    } else {
        header("location: etusivu.php");
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}
?>
<script>
    var input = document.getElementById("etu");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("suku");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("sposti");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
</body>
</html>			
