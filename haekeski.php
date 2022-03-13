<?php
session_start(); 



ob_start();



include("yhteys.php");

if (!$resulteka = $db->query("select arvo as keski from kayttajan_arvostelu ")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if ($resulteka->num_rows == 0) {

    echo'<p style="display: inline-block; margin-left: 20px" ><em>(ei arvosteluja)</em></p>';
} else {
    if (!$result22 = $db->query("select AVG(arvo) as keski from kayttajan_arvostelu ")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($row = $result22->fetch_assoc()) {
        if ($resulteka->num_rows == 1)
            echo'<p style="display: inline-block; " >(1 arvostelu, keskiarvo: ' . round($row[keski], 1) . '/5)</p>';
        else {
            echo'<p style="display: inline-block;  " >(' . $resulteka->num_rows . ' arvostelua, keskiarvo: ' . round($row[keski], 1) . '/5)</p>';
        }
    }
}
