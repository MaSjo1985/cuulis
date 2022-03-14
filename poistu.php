<?php
session_start();
ob_start();

echo'
<!DOCTYPE html>
<html>
 
<head>

<title> Poistu oppimisympäristöstä</title>';

include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");

    echo'<div class="cm8-container7">';
    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"></div>';



    //kursseihin liittyvät jutut
    //keskusteluihin liittyvät tiedot



    $db->query("delete from kayttajan_tykkaykset where kayttaja_id = '" . $_SESSION["Id"] . "'");


    $db->query("delete from keskustelut where kayttaja_id = '" . $_SESSION["Id"] . "'");



    //kysymyksiin liittyvät tiedot

 $db->query("delete from kyselytkp where kayttaja_id = '" . $_SESSION["Id"] . "'");
    $db->query("delete from kysymykset where kayttaja_id = '" . $_SESSION["Id"] . "'");

    //äänestykset


    $db->query("delete from aanestysvastaukset where kayttaja_id = '" . $_SESSION["Id"] . "'");



    // itsearvioinnit


    $db->query("delete from itsearvioinnitkp where kayttaja_id = '" . $_SESSION["Id"] . "'");
    //itsearvioinnit, UUSI
    $db->query("delete from iakp where kayttaja_id = '" . $_SESSION["Id"] . "'");
    $db->query("delete from iakp_moni where kayttaja_id = '" . $_SESSION["Id"] . "'");
    $db->query("delete from iakommentit where kayttaja_id = '" . $_SESSION["Id"] . "'");



    //itsenäisten töiden kirjanpito



    $db->query("delete from opiskelijankirja where kayttaja_id = '" . $_SESSION["Id"] . "'");
    if (!$haetehtavat = $db->query("select * from itsetehtavat where itseprojektit_id='" . $rowi[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowi2 = $haetehtavat->fetch_assoc()) {
        $db->query("delete from itsetehtavatkp where kayttaja_id = '" . $_SESSION["Id"] . "'");
    }



//kurssityo-tiedostot


    if (!$haetyot = $db->query("select ryhmat2.tallennettunimi as tallennettunimi, ryhmat2.linkki as linkki, ryhmat2.id as ryid, opiskelijan_kurssityot.id as okid from opiskelijan_kurssityot, ryhmat2, projektit where opiskelijan_kurssityot.kayttaja_id = '" . $_SESSION["Id"] . "' AND ryhmat2.projekti_id=projektit.id AND opiskelijan_kurssityot.ryhmat2_id=ryhmat2.id")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowr = $haetyot->fetch_assoc()) {

        $nimi = $rowr[tallennettunimi];
        $linkki = $rowr[linkki];
        $ryid = $rowr[ryid];
        $okid = $rowr[okid];

        if ($linkki == 1) {
            $db->query("delete from ryhmat2 where id = '" . $ryid . "'");
            $db->query("delete from opiskelijan_kurssityot where ryhmat2_id = '" . $ryid . "'");
        } else {
            if (file_exists($nimi)) {
                unlink($nimi);
            }


            $db->query("delete from ryhmat2 where id = '" . $ryid . "'");
            $db->query("delete from opiskelijan_kurssityot where ryhmat2_id = '" . $ryid . "'");
        }
    }

    //sektoridiagrammit
    $pienimi = 'images/sektori' . $_SESSION["Id"] . '.png';
    if (file_exists($pienimi)) {
        unlink($pienimi);
    }
    $pienimi = 'images/sektori2' . $_SESSION["Id"] . '.png';
    if (file_exists($pienimi)) {
        unlink($pienimi);
    }
    $pienimi = 'images/sektori3' . $_SESSION["Id"] . '.png';
    if (file_exists($pienimi)) {
        unlink($pienimi);
    }
    $pienimi = 'images/sektori4' . $_SESSION["Id"] . '.png';
    if (file_exists($pienimi)) {
        unlink($pienimi);
    }

    $db->query("delete from opiskelijankurssit where opiskelija_id='" . $_SESSION["Id"] . "'");


    $db->query("delete from kayttajat where id = '" . $_SESSION["Id"] . "'");

    $db->query("delete from kayttajankoulut where kayttaja_id = '" . $_SESSION["Id"] . "'");
    $db->query("delete from koulunadminit where kayttaja_id = '" . $_SESSION["Id"] . "'");



//kuvan poisto

    if (!$result = $db->query("select distinct * from kayttajat where id = '" . $_SESSION["Id"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row = $result->fetch_assoc()) {
        $nimi = $row[omakuva];
    }



    if (file_exists($nimi)) {
        unlink($nimi);
    }






    unset($_SESSION["Kayttajatunnus"]);


    echo'<br><b>Käyttäjäprofiilisi on poistettu Cuulis-oppimisympäristöstä.</b><br><br>Voit halutessasi sulkea selaimen.';

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
