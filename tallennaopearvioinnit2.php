<?php
session_start();

ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

 // ready to go!
include("yhteys.php");




if (isset($_SESSION["Kayttajatunnus"])) {

    if (isset($_POST["painiket"])) {

        if (!$projekti = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "' AND itsearviointi=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($projekti->num_rows != 0) {

            $pisteet = $_POST["pisteet"];
            $kayttaja = $_POST[opid];

            if (!$haearvioinnit = $db->query("select distinct * from itsearvioinnit_pisteet where kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttaja_id='" . $_POST[opid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            //eka kerta 
            if ($haearvioinnit->num_rows == 0) {
                $stmt = $db->prepare("INSERT INTO itsearvioinnit_pisteet (kurssi_id, kayttaja_id, pisteet, opetallennus2) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiii", $kurssi, $kayttaja, $pisteet, $opetallennus2);
                $kurssi = $_SESSION[KurssiId];
                $kayttaja = $kayttaja;
                $pisteet = $pisteet;
                $opetallennus2 = 1;
            } else {
                $stmt = $db->prepare("UPDATE itsearvioinnit_pisteet SET pisteet = ?, opetallennus2 = ? WHERE kurssi_id = ? AND kayttaja_id = ?");
                $stmt->bind_param("iiii", $pisteet, $opetallennus2, $kurssi, $kayttaja);
                $kurssi = $_SESSION[KurssiId];
                $kayttaja = $kayttaja;
                $pisteet = $pisteet;
                $opetallennus2 = 1;
            }


            $stmt->execute();
            $stmt->close();
        }
    }
    header('location: tarkasteleopiskelija2.php?kaid=' . $_POST[opid] . '#tuutanne');
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>


