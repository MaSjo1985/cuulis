
<?php
session_start();

include("yhteys.php");
//haetaan kaikki kurssit
if (!$haekurssit = $db->query("select distinct id from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
while ($rivikurssi = $haekurssit->fetch_assoc()) {
    $kurssi_id = $rivikurssi[id];

//haetaan kaikki kyseisen kurssin/opintojakson linkit
    if (!$haelinkit = $db->query("select distinct * from linkit where kurssi_id = '" . $kurssi_id . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($haelinkit->num_rows > 0) {

        $db->query("insert into kansiot (kurssi_id, nimi) values('" . $kurssi_id . "', 'Linkit')");
        if (!$haeviimeisin = $db->query("select distinct id from kansiot where kurssi_id='" . $kurssi_id . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowV = $haeviimeisin->fetch_assoc()) {
            $viimeisin = $rowV[id];
        }
        while ($rivilinkki = $haelinkit->fetch_assoc()) {
            $linkki_id = $rivilinkki[id];
            $kuvaus = $rivilinkki[kuvaus];
            $osoite = $rivilinkki[osoite];
            $youtube = $rivilinkki[youtube];
            $upotus = $rivilinkki[upotus];
            $db->query("insert into tiedostot (kansio_id, kuvaus, omatallennusnimi, vanhalinkki, linkki, upotus, youtube) values('" . $viimeisin . "', '" . $osoite . "', '" . $kuvaus . "', 1, 1, '" . $upotus . "', '" . $youtube . "')");
        }
    }
}
?>

