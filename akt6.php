<?php
session_start(); 



ob_start();



include("yhteys.php");


// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
$kuid = $_SESSION['KurssiId'];




if ($_SESSION["Rooli"] == 'opiskelija') {


    if (!$haeakt = $db->query("select distinct * from aanestykset where id='" . $_GET[a] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowa = $haeakt->fetch_assoc()) {

        if ($rowa[nakyvissa] == 1 && $rowa[aktiivinen] == 1) {
            echo '<form action="aanesta.php" method="post">';
            echo'<h5  id="' . $rowa[id] . '"  style="display: inline-block; padding-top:0px; font-size:1.1em">' . $rowa[kysymys] . '</h5>';
            echo'<br>(Vain viimeisin annettu vastaus rekisteröidään.)<br>';
            if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowb = $haevaihtoehdot->fetch_assoc()) {

                echo'<br><br><input type="radio" name="vastaus" value=' . $rowb[id] . '> ' . $rowb[nimi];
            }

            echo'<br><br>';

            echo'<input type="hidden" name="id" value=' . $rowa[id] . '> <br> 						
										<div class="cm8-quarter"> <input type="submit" name="painike" value="&#10003 Lähetä vastaus" class="myButton9"  role="button"  style="padding:2px 4px"></div></form>';
            echo'<div class="cm8-margin-bottom"></div>';
        } else if ($rowa[nakyvissa] == 1 && $rowa[aktiivinen] == 0) {


            echo'<h5 id="' . $rowa[id] . '"  style="display: inline-block; padding-top:0px; font-size:1.1em">' . $rowa[kysymys] . '</h5>';

            echo'<br><b style="color: #2b6777">Tulokset: </b><br><br>';

            if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            // kaikki vaihtoehdot läpi

            while ($rowv = $haevaihtoehdot->fetch_assoc()) {

                if (!$haevastaukset = $db->query("select distinct * from aanestysvastaukset where aanestysvaihtoehdot_id='" . $rowv[id] . "' AND aanestys_id='" . $rowa[id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                //kunkin vaihtoehdon vastaukset läpi

                $maara = $haevastaukset->num_rows;

                echo$rowv[nimi] . ': ' . $maara . ' kpl <br><br>';
            }
        } else if ($rowa[nakyvissa] == 0) {
            echo'<h5 id="' . $rowa[id] . '"  style="display: inline-block; padding-top:0px; font-size:1.1em">' . $rowa[kysymys] . '</h5>';
            echo'<br><em>Äänestys ei ole aktiivinen.</em>';
        }
    }
}
?>

