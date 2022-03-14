<?php
session_start();
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Osallistujat </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    if(isset($_POST[id])){
        $tuote = $_POST[id];


    echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 30px">';

    if ($_POST["valinta"] == "ei"){
         header("location: osallistujat.php");
    }
       

    else {


            $pienimi = 'images/sektori' . $tuote . '.png';
            if (file_exists($pienimi)) {
                unlink($pienimi);
            }




            //keskusteluihin liittyvät tiedot


            if (!$haekesk = $db->query("select distinct id from keskustelut where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowkesk = $haekesk->fetch_assoc()) {
                $id = $rowkesk[id];
                $db->query("delete from kayttajan_tykkaykset where kayttaja_id = '" . $tuote . "' AND keskustelut_id ='" . $id . "'");
            }

            $db->query("delete from keskustelut where kayttaja_id = '" . $tuote . "' AND kurssi_id='" . $_SESSION["KurssiId"] . "'");




            //kysymyksiin liittyvät tiedot (vanha)
            $db->query("delete from kysymykset where kayttaja_id = '" . $tuote . "' AND kurssi_id='" . $_SESSION["KurssiId"] . "'");



            //äänestykset

            if (!$haeaanestykset = $db->query("select * from aanestykset where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowa = $haeaanestykset->fetch_assoc()) {

                $db->query("delete from aanestysvastaukset where kayttaja_id = '" . $tuote . "' AND aanestys_id='" . $rowa[id] . "'");
            }


            // itsearvioinnit VANHA

            if (!$haeitse = $db->query("select distinct id from itsearvioinnit where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowitse = $haeitse->fetch_assoc()) {
                $id = $rowitse[id];
                $db->query("delete from itsearvioinnitkp where kayttaja_id = '" . $tuote . "' AND itsearvioinnit_id ='" . $id . "'");
            }


            // itsearvioinnit UUS

            if (!$haesarakkeet = $db->query("select * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rows = $haesarakkeet->fetch_assoc()) {
                $sid = $rows[id];
                $jarjestys = $rows[jarjestys];

                if (!$haeia = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $jarjestys . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowia = $haeia->fetch_assoc()) {
                    $iaid = $rowia[id];

                    $db->query("delete from iakp where ia_id = '" . $iaid . "' AND kayttaja_id = '" . $tuote . "'");
                    $db->query("delete from iakp_moni where ia_id = '" . $iaid . "' AND kayttaja_id = '" . $tuote . "'");
                }
            }

            $db->query("delete from iakommentit where kurssi_id = '" . $_SESSION[KurssiId] . "'  AND kayttaja_id = '" . $tuote . "'");


            //itsenäisten töiden kirjanpito

            if (!$haeitseprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowi = $haeitseprojekti->fetch_assoc()) {
                //kirja
                $db->query("delete from opiskelijankirja where itseprojekti_id = '" . $rowi[id] . "' AND kayttaja_id = '" . $tuote . "'");

                if (!$haetehtavat = $db->query("select * from itsetehtavat where itseprojektit_id='" . $rowi[id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowi2 = $haetehtavat->fetch_assoc()) {
                    $db->query("delete from itsetehtavatkp where kayttaja_id = '" . $tuote . "' AND itsetehtavat_id='" . $rowi2[id] . "'");
                }
            }

            //kurssityo-tiedostot


            if (!$haetyot = $db->query("select ryhmat2.tallennettunimi as tallennettunimi, ryhmat2.linkki as linkki, ryhmat2.id as ryid, opiskelijan_kurssityot.id as okid from opiskelijan_kurssityot, ryhmat2, projektit where opiskelijan_kurssityot.kayttaja_id = '" . $tuote . "' AND projektit.kurssi_id='" . $_SESSION["KurssiId"] . "' AND ryhmat2.projekti_id=projektit.id AND opiskelijan_kurssityot.ryhmat2_id=ryhmat2.id")) {
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
            $pienimi = 'images/sektori' . $tuote . '.png';
            if (file_exists($pienimi)) {
                unlink($pienimi);
            }
            $pienimi = 'images/sektori2' . $tuote . '.png';
            if (file_exists($pienimi)) {
                unlink($pienimi);
            }
            $pienimi = 'images/sektori3' . $tuote . '.png';
            if (file_exists($pienimi)) {
                unlink($pienimi);
            }
            $pienimi = 'images/sektori4' . $tuote . '.png';
            if (file_exists($pienimi)) {
                unlink($pienimi);
            }

            //lopullinen viimeistely
           
                    
            $db->query("delete from opiskelijankurssit where opiskelija_id='" . $tuote . "' AND  kurssi_id = '" . $_SESSION["KurssiId"] . "'");
       

        header("location: osallistujat.php");
    }
    }

} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";

include("footer.php");
?>

</body>
</html>			