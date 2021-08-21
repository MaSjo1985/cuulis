<?php
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title> Kurssin poisto</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("header.php");
        include("header2.php");
        echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px;">';

        if ($_SESSION["Rooli"] == "opeadmin") {
            echo'<nav class="topnavOpe" id="myTopnav">';
            echo'<a href="etusivu.php"  >Etusivu</a>         
<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnavOpe") {
  
        x.className += " responsive";
        
       
    } else {
  
        x.className = "topnavOpe";
      
    }
     
}
</script>
<a href="omatkurssit.php" class="currentLink">Omat kurssit/opintojaksot</a>
<a href="kurssitkaikki.php" >Kaikki kurssit/opintojaksot</a>
<a href="kayttajatvahvistus.php" >Käyttäjät &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="kurssit.php">Kurssit/Opintojaksot &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" >Oppilaitos &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)">  
    <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        } else {

            echo'<nav class="topnavoppilas" id="myTopnav">';
            echo'         
	<a href="etusivu.php" >Etusivu</a>      
	<a href="omatkurssit.php" class="currentLink">Omat kurssit/opintojaksot</a>
	<a href="kurssit.php" >Kaikki kurssit/opintojaksot</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
            echo'

<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
   if (x.className === "topnavoppilas") {

        x.className += " responsive";
    } else {
        x.className = "topnavoppilas";
    }

}
</script>';
        }


        echo'<div class="cm8-container3" style="padding-top: 30px; ">';
        if (empty($_POST["lista"])) {
            echo '<p style="font-weight: bold" >Et valinnut yhtään kurssia/opintojaksoa poistettavaksi!</p>';

            if ($_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink')
                echo' <a href="kurssit.php"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin';
            else
                echo' <a href="omatkurssit.php"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin';
        } else {
            $lista = $_POST["lista"];
            $idt = $_POST["lista"];

            echo '<p style="font-weight: bold; font-size: 1.2em; padding-top: 20px; color: #f7f9f7" >Olet poistamassa seuraavat kurssit/opintojaksot: </p>';

            foreach ($lista as $tuote) {

                if (!$result = $db->query("select nimi, id, koodi from kurssit where id = '" . $tuote . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($row2 = $result->fetch_assoc()) {
                    $nimi = $row2[nimi];
                    $id = $row2[id];
                    $koodi = $row2[koodi];
                }

                echo '<br><b style="font-size: 1.1em">' . $koodi . ' ' . $nimi . '</b>';

                //katsotaan kurssikohtaisesti, onko jotain tiedostoja, jotka viety toisen kurssiin:
                if (!$resultk = $db->query("select distinct * from kansiot where kurssi_id = '" . $tuote . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                $onko = false;
                $kurssit = array();

                //hakee kurssin/opintojakson kansiot
                while ($rowk = $resultk->fetch_assoc()) {

                    if (!$result3 = $db->query("select distinct * from tiedostot where kansio_id = '" . $rowk[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    //hakee kansion tiedostot
                    while ($row3 = $result3->fetch_assoc()) {

                        $nimi = $row3[omatallennusnimi];
                        $id = $row3[id];
                        $tnimi = $row3[nimi];
                        $tuotu = $row3[tuotu];
                        $linkki = $row3[linkki];
                        if ($tuotu == 0 && $linkki == 0) {
                            if (!$result2 = $db->query("select distinct kurssit.nimi as kurssi, kurssit.koodi as koodi from kurssit, kansiot, tiedostot where kansiot.kurssi_id=kurssit.id AND tiedostot.tuotu=1 AND tiedostot.linkki=0 AND tiedostot.kansio_id=kansiot.id AND tiedostot.nimi='" . $tnimi . "'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }
                            if ($result2->num_rows > 0) {
                                $onko = true;
                                while ($row88 = $result2->fetch_assoc()) {
                                    $kokonimi = $row88[koodi] . ' ' . $row88[kurssi];
                                    $onkolaitettu = false;
                                    if (!empty($kurssit)) {
                                        foreach ($kurssit as $tuote2) {
                                            if ($kokonimi == $tuote2) {
                                                $onkolaitettu = true;
                                            }
                                        }
                                    }
                                    if (!$onkolaitettu) {
                                        array_push($kurssit, $kokonimi);
                                    }
                                }
                            }
                        }
                    }
                }

                if ($onko) {

                    $kurssimaara = count($kurssit);
                    $kurssimaara2 = count($kurssit);
                    if ($kurssimaara > 1) {
                        echo'<br><br><b style="color: #c7ef00">Huom! Tämän kurssin/opintojakson tiedostoja on viety kurssien <b style="color: #080708">';
                    } else if ($kurssimaara == 1) {
                        echo'<br><br><b style="color: #c7ef00">Huom! Tämän kurssin/opintojakson tiedostoja on viety kurssin/opintojakson <b style="color: #080708">';
                    }
                    foreach ($kurssit as $tuote2) {
                        $kurssimaara--;
                        if ($kurssimaara == 0) {
                            if ($kurssimaara2 > 1) {
                                echo$tuote2 . '</b> materiaaleihin. Kurssin poisto poistaa kyseiset tiedostot myös näistä kursseista!</b><br>';
                            } else if ($kurssimaara2 == 1) {
                                echo$tuote2 . '</b> materiaaleihin. Kurssin poisto poistaa kyseiset tiedostot myös tästä kurssista/opintojaksosta!</b><br>';
                            }
                        } else {
                            echo$tuote2 . ', ';
                        }
                    }
                }
            }

            echo "<br>";
            echo "<br>";
            echo '<p style="font-weight: bold; font-size: 1em; padding-top: 20px; color: #f7f9f7" >Haluatko jatkaa? </p>';
            echo'<form action="poistakurssi.php" method="post">
			 <input type="radio" name = "valinta" id="joo"  value="joo"> Kyllä<br>
		   <input type="radio" name = "valinta" id="ei" value="ei" selected> En';
            echo "<br>";

            for ($i = 0; $i < count($idt); $i++) {
                echo'<input type="hidden" name="mita[]" value=' . $idt[$i] . '>';
            }

            echo'<br><br><input type="submit" class="myButton9"  role="button"  value="&#10003 Valitse">
			</form>';
        }
        echo'</div>';
        echo'</div>';

        include("footer.php");
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}
?>

</body>
</html>	