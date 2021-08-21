<?php
ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!
if (!$result = $db->query("select distinct ryhma_id as ryid from ryhmat2 where id='" . $_POST[tyoid] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}


while ($row = $result->fetch_assoc()) {


    $ryid = $row[ryid];
}
if (isset($_SESSION["Kayttajatunnus"])) {
    if (!empty($_POST[palaute])) {

        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";






        if (!$resultope = $db->query("select * from kayttajat where id='" . $_SESSION[Id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowope = $resultope->fetch_assoc()) {
            $nimil = $rowope[etunimi];
            $spostil = $rowope[sposti];
        }

        function poista_rivinvaihdot($teksti) {
            return str_replace(array("\r", "\n"), "", $teksti);
        }

        $nimil = poista_rivinvaihdot($nimil);
        $spostil = poista_rivinvaihdot($spostil);
        echo'<br>Nimi: ' . $nimil;
        echo'<br>Sposti: ' . $spostil;

        $headers .= "From: " . $nimil . " <" . $spostil . ">\r\n";

        $otsikko = 'Olen kommentoinut kurssin/opintojakson ' . $_SESSION[Koodi] . ' ' . $_SESSION[KurssiNimi] . ' palautustasi Cuulis-oppimisympäristössä';
        $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

        if (!$result = $db->query("select distinct ryhma_id as ryid from ryhmat2 where id='" . $_POST[tyoid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($row = $result->fetch_assoc()) {


            $ryid = $row[ryid];
        }

        if (!$haelahettaja = $db->query("select distinct * from kayttajat where id='" . $_SESSION[Id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowlahettaja = $haelahettaja->fetch_assoc()) {

            $etunimi = $rowlahettaja[etunimi];
            $sukunimi = $rowlahettaja[sukunimi];
        }
        if (!$result2 = $db->query("select distinct kayttajat.sposti as sposti from kayttajat, opiskelijankurssit where kayttajat.id = opiskelijankurssit.opiskelija_id AND opiskelijankurssit.ryhma_id='" . $ryid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        $_POST[palaute] = str_replace("\n.", "\n..", $_POST[palaute]);
//            $viesti2 = wordwrap($viesti2, 70, "\r\n");
        $_POST[palaute] = nl2br($_POST[palaute]);


        $viestieka = '<b>' . $_SESSION[Koodi] . ' ' . $_SESSION[KurssiNimi] . '</b>: <br><br>' . $_POST[palaute];
        while ($row2 = $result2->fetch_assoc()) {
            $sposti = $row2[sposti];
            $body = '<html><body>';
            echo'<br>vastaanottajan sposti: ' . $sposti;

            $body .= '<p>' . $viestieka . '</p>';
            $body .= '<img style="margin-top: 40px" src="http://cuulis.cm8solutions.fi/images/cuulis_email.png"  /><br/>';
            $body .= "</body></html>";
            $viesti = mail($sposti, $otsikko, $body, $headers);
        }

        $stmt = $db->prepare("UPDATE ryhmat2 SET palaute = ?, palaute_tallennettu = ? WHERE id = ?");
        $stmt->bind_param("sii", $kommentti2, $tall, $id4);

        $tall = 1;
        $kommentti = $_POST[palaute];
        $kommentti = nl2br($kommentti);

        $kommentti2 = $kommentti;
        $id4 = $_POST[tyoid];

        $stmt->execute();


        $stmt->close();
    }


    header("location: ryhmatyot.php?r=" . $_POST[pid] . "#" . $ryid);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}

echo "</div>";
echo "</div>";

include("footer.php");
?>

</body>
</html>	