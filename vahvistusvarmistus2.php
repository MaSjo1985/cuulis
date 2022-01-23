<?php
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title> Käyttäjien vahvistus/poisto</title>';


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
        echo'<div class="cm8-margin-top"></div>';
        if (isset($_POST['painikep'])) {

            if (empty($_POST["lista81"])) {
                echo '<p style="font-weight: bold" >Et valinnut yhtään käyttäjää!</p>';
                echo'<br><br><a href="kayttajatvahvistus.php"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin';
            } else {
                $lista = $_POST["lista81"];
                $idt = $_POST["lista81"];
                echo '<p style="font-weight: bold" >Haluatko todella hylätä seuraavien käyttäjien liittymisen oppilaitokseen?</p>';


                foreach ($lista as $tuote) {

                    if (!$result = $db->query("select etunimi, sukunimi, id from kayttajat where id = '" . $tuote . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($row2 = $result->fetch_assoc()) {
                        $etunimi = $row2[etunimi];
                        $sukunimi = $row2[sukunimi];
                        $id = $row2[id];
                    }

                    echo "<br>" . $etunimi . " " . $sukunimi;
                }
                echo "<br>";
                echo "<br>";


                echo'<form action="hylkaakayttaja.php" method="post">
						 <input type="radio" name = "valinta" value="joo"> Kyllä <br>
					   <input type="radio" name = "valinta" value="ei" selected> En<br>';

                for ($i = 0; $i < count($idt); $i++) {
                    echo'<input type="hidden" name="mita[]" value=' . $idt[$i] . '>';
                }

                echo'<br><br><input type="submit" class="myButton9"  role="button"  value="&#10003 Valitse">
						</form>';
            }
        }

        if (isset($_POST['painikev'])) {

            if (empty($_POST["lista81"])) {
                echo '<p style="font-weight: bold" >Et valinnut yhtään käyttäjää!</p>';
                echo'<br><br><a href="kayttajatvahvistus.php"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin';
            } else {
                $lista = $_POST["lista81"];
                $idt = $_POST["lista81"];
                echo '<p style="font-weight: bold" >Haluatko todella hyväksyä seuraavien käyttäjien liittymisen oppilaitokseen?</p>';


                foreach ($lista as $tuote) {

                    if (!$result = $db->query("select etunimi, sukunimi, id from kayttajat where id = '" . $tuote . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($row2 = $result->fetch_assoc()) {
                        $etunimi = $row2[etunimi];
                        $sukunimi = $row2[sukunimi];
                        $id = $row2[id];
                    }

                    echo "<br>" . $etunimi . " " . $sukunimi;
                }
                echo "<br>";
                echo "<br>";


                echo'<form action="vahvistaliittyminen.php" method="post">
						 <input type="radio" name = "valinta" value="joo"> Kyllä <br>
					   <input type="radio" name = "valinta" value="ei" selected> En <br>';

                for ($i = 0; $i < count($idt); $i++) {
                    echo'<input type="hidden" name="mita[]" value=' . $idt[$i] . '>';
                }

                echo'<br><br><input type="submit" class="myButton9"  role="button"  value="&#10003 Valitse">
						</form>';
            }
        }

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
    header("location: kirjautuminenuusi.php?url=" . $url);
}
?>

</body>
</html>	