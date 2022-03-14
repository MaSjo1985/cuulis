<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
<head>

<title> Rekisteröinti  </title>';
include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");

    echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px;">';
    if ($_SESSION["Rooli"] == 'admin') {
        include("adminnavi.php");
    } else if ($_SESSION["Rooli"] == 'admink') {
        include("etuosan_navit.php");
        tuoAdminkNavi("Oma oppilaitos");
    } else if ($_SESSION["Rooli"] == 'opeadmin') {
        include("etuosan_navit.php");
        tuoOpeadminNavi("Oma oppilaitos");
    }



    echo'<div class="cm8-container3" style="padding-top: 30px;">';


    if (!$result31 = $db->query("select distinct * from koulut where id = '" . $_POST[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row31 = $result31->fetch_assoc()) {

        echo '<header><div class="cm8-quarter"><p style="font-size: 1.2em; font-weight: bold; padding-top: 20px" >' . $row31[Nimi] . '</p></div><div class="cm8-quarter"><img src="/' . $row31[kuva] . '" style="height: 60px; weight:30px"></div> <div class="cm8-quarter"><br></div><div class="cm8-quarter"><br></div></h4></header></div>';
    }


    echo'<div class="cm8-container3" style="padding-top: 30px;">';





    $siivottusposti = mysqli_real_escape_string($db, $_POST[sposti]);

    $stmt = $db->prepare("SELECT DISTINCT id FROM kayttajat WHERE BINARY sposti=?");
    $stmt->bind_param("s", $sposti);
    // prepare and bind
    $sposti = $siivottusposti;

    $stmt->execute();

    $stmt->store_result();

    $stmt->bind_result($column1);


    if ($stmt->num_rows == 0) {
        echo'<br>Käyttäjä ei ole rekisteröitynyt oppimisympäristöön!<br><br><a href="uusikouluadmin.php?id=' . $_POST[id] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin </a>';
    } else {
        while ($stmt->fetch()) {
            $kaid = $column1;
        }


        if (!$tulos2 = $db->query("select distinct * from koulunadminit where kayttaja_id='" . $kaid . "' AND koulu_id='" . $_POST[id] . "'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }

        if ($tulos2->num_rows != 0) {

            echo'<br>Käyttäjä on jo oppilaitoksen ylläpitäjä!<br><br><a href="uusikouluadmin.php?id=' . $_POST[id] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin </a>';
        } else {
            if (!$tulos3 = $db->query("select distinct * from kayttajankoulut where kayttaja_id='" . $kaid . "' AND koulu_id='" . $_POST[id] . "'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }

            if ($tulos3->num_rows == 0) {
                echo'<br>Käyttäjä ei ole liittynyt oppilaitokseen!<br><br><a href="uusikouluadmin.php?id=' . $_POST[id] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin </a>';
            } else {

                if (!$tulos4 = $db->query("select distinct * from kayttajat where id='" . $kaid . "'")) {
                    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                }

                while ($rivi2 = $tulos4->fetch_assoc()) {
                    $etunimi = $rivi2[etunimi];
                    $sukunimi = $rivi2[sukunimi];
                    $rooli = $rivi2[rooli];
                }

                echo '<br><p style="color: #00; font-weight: bold" >Olet lisäämässä oppilaitoksen ylläpitäjäksi käyttäjän ' . $etunimi . ' ' . $sukunimi . ' (rooli: ' . $rooli . ')</p>';
                echo'<br>Haluatko jatkaa?<br><br><br><a href="adminrekisterointi?kaid=' . $kaid . '&koid=' . $_POST[id] . '" class="myButton9"  role="button"  style="margin-right: 30px">Kyllä </a><a href="uusikouluadmin?id=' . $_POST[id] . '" class="myButton9"  role="button"  style="margin-right: 30px">En </a>';
            }
        }
    }
    $stmt->close();


    echo'</div>';
    echo'</div>';
    echo'</div>';
    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>
</body>
</html>			
