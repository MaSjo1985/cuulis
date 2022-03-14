<?php
session_start();

ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title> Ota yhteyttä</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
$urlmihin = $_SERVER[REQUEST_URI];

$urlmihin = substr($urlmihin, 1);

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7">';

    if ($_SESSION["Rooli"] == 'admin')
        include("adminnavi.php");
    else if ($_SESSION["Rooli"] == 'admink')
        include("adminknavi.php");
    else if ($_SESSION["Rooli"] == 'opeadmin')
        include("opeadminnavi.php");
    else
        include ("opnavi.php");

    echo'<div class="cm8-half" style="padding-top: 10px">';

    if (!$result = $db->query("select * from kayttajat where id='" . $_SESSION["Id"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($row = $result->fetch_assoc()) {
        $nimi = $row[etunimi] . " " . $row[sukunimi];
        $sposti = $row[sposti];
    }



    if (!$result2 = $db->query("select distinct * from koulut where id='" . $_POST[kouluid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($row2 = $result2->fetch_assoc()) {
        $kouluid = $row2[id];
        $Nimi = $row2[Nimi];
    }
    if (!$resultv = $db->query("select * from kayttajat, koulunadminit where koulu_id='" . $kouluid . "' AND koulunadminit.kayttaja_id=kayttajat.id")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($rowv = $resultv->fetch_assoc()) {
        $nimiv = $rowv[etunimi] . " " . $rowv[sukunimi];
        $spostiv = $rowv[sposti];
    }

    if ($resultv->num_rows == 0) {
        if (!$resultv = $db->query("select * from kayttajat where rooli='admin'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowv = $resultv->fetch_assoc()) {
            $nimiv = $rowv[etunimi] . " " . $rowv[sukunimi];
            $spostiv = $rowv[sposti];
        }
    }


    echo'<form class="form-style-k" action="lahetayhteydenotto.php" method="post"><fieldset>';
    echo' <legend>Lähetä viesti oppilaitoksen ' . $Nimi . ' ylläpitäjälle </legend>';
    echo '<a href="etusivu.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa etusivulle</a><br><br>';



    echo'<br><p style="font-weight: normal"><b>Lähettäjän nimi:</b>&nbsp&nbsp&nbsp <input type="hidden" name="nimi" value="' . $nimi . '"> ' . $nimi . ' </p>
		<br><p style="font-weight: normal"><b>Lähettäjän käyttäjätunnus:</b>&nbsp&nbsp&nbsp<input type="hidden" size="30" name="sposti" value=' . $sposti . '> ' . $sposti . ' </p> 	
<br><p style="font-weight: normal"><b>Vastaanottajan nimi:</b> &nbsp&nbsp&nbsp ' . $nimiv . ' </p>';
    if ($_SESSION[Rooli] == 'admin' || $_SESSION[Rooli] == 'admink' || $_SESSION[Rooli] == 'opeadmin') {

        echo'<br><p style="font-weight: normal"><b>Vastaanottajan sähköpostiosoite:</b> &nbsp&nbsp&nbsp ' . $spostiv . ' </p> ';
    }

    echo'<input type="hidden" name="id" value="' . $kouluid . '">
 <input type="hidden" name="url" value="' . $urlmihin . '">';
    echo'<br><p><b> Viesti: </b><br><textarea name="viesti" style="width: 80%" rows="8"></textarea></p> <br><br>
<input type="submit" value="📧 &nbsp Lähetä" style="padding-bottom: 5px"  >
		  </fieldset></form>';

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