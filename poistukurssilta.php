<?php
session_start();
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Poistu kurssilta/opintojaksolta</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

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

    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
    echo'<div class="cm8-margin-top"></div>';
    if ($_POST["valinta"] == "ei")
        header("location: omatkurssit.php");

    else {

        $lista = $_POST["mita"];

        foreach ($lista as $tuote) {





            //keskusteluihin liittyvät tiedot


            if (!$haekesk = $db->query("select distinct id from keskustelut where kurssi_id = '" . $tuote . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowkesk = $haekesk->fetch_assoc()) {
                $id = $rowkesk[id];
                $db->query("delete from kayttajan_tykkaykset where kayttaja_id = '" . $_SESSION["Id"] . "' AND keskustelut_id ='" . $id . "'");
            }

            $db->query("delete from keskustelut where kayttaja_id = '" . $_SESSION["Id"] . "' AND kurssi_id='" . $tuote . "'");



            //kysymyksiin liittyvät tiedot


            $db->query("delete from kysymykset where kayttaja_id = '" . $_SESSION["Id"] . "' AND kurssi_id='" . $tuote . "'");

            //äänestykset

            if (!$haeaanestykset = $db->query("select * from aanestykset where kurssi_id='" . $tuote . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowa = $haeaanestykset->fetch_assoc()) {

                $db->query("delete from aanestysvastaukset where kayttaja_id = '" . $_SESSION["Id"] . "' AND aanestys_id='" . $rowa[id] . "'");
            }


            // itsearvioinnit, VANHA

            if (!$haeitse = $db->query("select distinct id from itsearvioinnit where kurssi_id = '" . $tuote . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowitse = $haeitse->fetch_assoc()) {
                $id = $rowitse[id];
                $db->query("delete from itsearvioinnitkp where kayttaja_id = '" . $_SESSION["Id"] . "' AND itsearvioinnit_id ='" . $id . "'");
            }

            // itsearvioinnit UUS

            if (!$haesarakkeet = $db->query("select * from ia_sarakkeet where kurssi_id='" . $tuote . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rows = $haesarakkeet->fetch_assoc()) {
                $sid = $rows[id];
                $jarjestys = $rows[jarjestys];

                if (!$haeia = $db->query("select distinct * from ia where kurssi_id='" . $tuote . "' AND ia_sarakkeet_jarjestys='" . $jarjestys . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowia = $haeia->fetch_assoc()) {
                    $iaid = $rowia[id];

                    $db->query("delete from iakp where ia_id = '" . $iaid . "' AND kayttaja_id = '" . $_SESSION["Id"] . "'");
                    $db->query("delete from iakp_moni where ia_id = '" . $iaid . "' AND kayttaja_id = '" . $_SESSION["Id"] . "'");
                }
            }

            $db->query("delete from iakommentit where kurssi_id = '" . $tuote . "'  AND kayttaja_id = '" . $_SESSION["Id"] . "'");





            //itsenäisten töiden kirjanpito


            if (!$haeitseprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $tuote . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowi = $haeitseprojekti->fetch_assoc()) {
                //kirja
                $db->query("delete from opiskelijankirja where itseprojekti_id = '" . $rowi[id] . "' AND kayttaja_id = '" . $_SESSION["Id"] . "'");
                if (!$haetehtavat = $db->query("select * from itsetehtavat where itseprojektit_id='" . $rowi[id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowi2 = $haetehtavat->fetch_assoc()) {
                    $db->query("delete from itsetehtavatkp where kayttaja_id = '" . $_SESSION["Id"] . "' AND itsetehtavat_id='" . $rowi2[id] . "'");
                }
            }

            //kurssityo-tiedostot


            if (!$haetyot = $db->query("select ryhmat2.tallennettunimi as tallennettunimi, ryhmat2.linkki as linkki, ryhmat2.id as ryid, opiskelijan_kurssityot.id as okid from opiskelijan_kurssityot, ryhmat2, projektit where opiskelijan_kurssityot.kayttaja_id = '" . $_SESSION["Id"] . "' AND projektit.kurssi_id='" . $tuote . "' AND ryhmat2.projekti_id=projektit.id AND opiskelijan_kurssityot.ryhmat2_id=ryhmat2.id")) {
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



            // lopullinen viimeistely
            $db->query("delete from opiskelijankurssit where opiskelija_id='" . $_SESSION["Id"] . "' AND  kurssi_id = '" . $tuote . "'");
        }

        echo'<br><b>Olet nyt poistunut valitsemiltasi kursseilta/opintojaksoilta.</b><br><br><a href="omatkurssit.php"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin';
    }

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