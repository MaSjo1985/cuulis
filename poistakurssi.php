<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Kurssin poisto</title>';


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



    if ($_POST["valinta"] == "ei") {
        if ($_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink')
            header("location: kurssit.php");
        else
            header("location: omatkurssit.php");
    }
    else {



        $lista = $_POST["mita"];
        $vaarat = array();

        if ($_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin' || $_SESSION["Rooli"] == 'opettaja') {

            foreach ($lista as $tuote) {

                if (!$onkovastuuope = $db->query("select distinct * from kurssit where id = '" . $tuote . "' AND opettaja_id = '" . $_SESSION["Id"] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($onkovastuuope->num_rows == 0 || $_SESSION[Rooli == 'opettaja']) {

                    $vaarat[] = $tuote;
                } else {

                    //ope on vastuuope
                    if (!$result = $db->query("select distinct * from projektit where kurssi_id = '" . $tuote . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    //poistetaan kurssiin liittyvien projektien tiedostot

                    while ($row = $result->fetch_assoc()) {
                        // POISTAA OPETTAJAN LISÄÄMÄT TIEDOSTOT

                        if (!$resulto = $db->query("select distinct * from ryhmatope where projekti_id = '" . $row[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        while ($rowo = $resulto->fetch_assoc()) {
                            $nimi = $rowo[tallennettunimi];
                            $linkki = $rowo[linkki];
                            $id = $rowo[id];

                            if ($linkki == 1) {
                                $db->query("delete from ryhmatope where id = '" . $id . "'");
                            } else {
                                if (file_exists($nimi)) {
                                    unlink($nimi);
                                }

                                if (file_exists($nimi)) {
                                    echo'<br>Tiedostoa ' . $nimi . ' ei pystytty poistamaan!<br><br>Voit ottaa yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br><br>';
                                } else {
                                    $db->query("delete from ryhmatope where id = '" . $id . "'");
                                }
                            }
                        }


                        if (!$resultope = $db->query("select distinct * from open_palautustiedosto where projekti_id = '" . $row[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        while ($rowope = $resultope->fetch_assoc()) {
                            $nimi = $rowope[tallennettunimi];
                            $linkki = $rowope[linkki];
                            $id2 = $rowope[id];



                            if ($linkki == 1) {
                                $db->query("delete from open_palautustiedosto where id = '" . $id2 . "'");
                            } else {

                                if (!$resultmuut = $db->query("select distinct * from open_palautustiedosto where id <> '" . $id2 . "' AND tallennettunimi='" . $nimi . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                if ($resultmuut->num_rows == 0) {

                                    if (file_exists($nimi)) {
                                        unlink($nimi);
                                    }
                                }

                                $db->query("delete from open_palautustiedosto where id = '" . $id2 . "'");
                            }
                        }








                        if (!$result2 = $db->query("select distinct * from ryhmat2 where projekti_id = '" . $row[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }


                        while ($row2 = $result2->fetch_assoc()) {
                            $nimi = $row2[tallennettunimi];
                            $linkki = $row2[linkki];
                            if ($linkki != 1) {
                                if (file_exists($nimi)) {
                                    unlink($nimi);
                                }
                                if (file_exists($nimi)) {
                                    echo'<br>Tiedostoa ' . $nimi . ' ei pystytty poistamaan!<br><br>Voit ottaa yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br><br>';
                                }
                            }
                        }

                        $db->query("delete from ryhmat where projekti_id = '" . $row[id] . "'");
                        $db->query("delete from ryhmat2 where projekti_id = '" . $row[id] . "'");
                        $db->query("delete from opiskelijan_kurssityot where projekti_id = '" . $row[id] . "'");
                    }

                    //poistetaan kurssin/opintojakson projektit

                    $db->query("delete from projektit where kurssi_id = '" . $tuote . "'");



                    //poistetaan kurssin/opintojakson tiedostot, haetaan kansiot

                    if (!$resultk = $db->query("select distinct * from kansiot where kurssi_id = '" . $tuote . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($rowk = $resultk->fetch_assoc()) {

                        if (!$result3 = $db->query("select distinct * from tiedostot where kansio_id = '" . $rowk[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        while ($row3 = $result3->fetch_assoc()) {
                            $nimi = $row3[nimi];
                            $tuotu = $row3[tuotu];
                            $kuvaus = $row3[kuvaus];
                            $linkki = $row3[linkki];
                            if ($linkki == 0) {
                                if (!$resultmuut = $db->query("select distinct * from tiedostot where kansio_id <> '" . $rowk[id] . "' AND nimi='" . $nimi . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                if ($resultmuut->num_rows == 0) {
                                    $tiedostonimi = 'tiedostot/' . $omatallennusnimi;

                                    if (file_exists($tiedostonimi)) {
                                        unlink($tiedostonimi);
                                    }
                                }
                            }



                            $db->query("delete from tiedostot where id = '" . $row3[id] . "'");
                        }
                    }


                    //poistetaan kansiot

                    $db->query("delete from kansiot where kurssi_id = '" . $tuote . "'");





                    //poistetaan kurssin/opintojakson linkit
                    $db->query("delete from linkit where kurssi_id = '" . $tuote . "'");



                    // äänestykset

                    if (!$result4 = $db->query("select distinct * from aanestykset where kurssi_id = '" . $tuote . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($row4 = $result4->fetch_assoc()) {
                        $aanestysid = $row4[id];
                        $db->query("delete from aanestysvaihtoehdot where aanestys_id = '" . $aanestysid . "'");
                        $db->query("delete from aanestysvastaukset where aanestys_id = '" . $aanestysid . "'");
                    }

                    $db->query("delete from aanestykset where kurssi_id = '" . $tuote . "'");


                    // itsearvioinnit  VANHA

                    if (!$haeitse = $db->query("select distinct id from itsearvioinnit where kurssi_id = '" . $tuote . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($rowitse = $haeitse->fetch_assoc()) {
                        $id = $rowitse[id];
                        $db->query("delete from itsearvioinnitkp where itsearvioinnit_id ='" . $id . "'");
                    }

                    $db->query("delete from itsearvioinnit where kurssi_id ='" . $tuote . "'");


                    // itsearvioinnit  UUSI
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

                            $db->query("delete from iakp where ia_id = '" . $iaid . "'");
                            $db->query("delete from iakp_moni where ia_id = '" . $iaid . "'");

                            $db->query("delete from iavaihtoehdot where ia_id = '" . $iaid . "'");

                            $db->query("delete from ia where id = '" . $iaid . "'");
                        }


                        $db->query("delete from ia_sarakkeet where id = '" . $sid . "'");
                    }

                    $db->query("delete from iakommentit where kurssi_id = '" . $tuote . "'");




                    //poistetaan itsenäisen työn matskut

                    if (!$result5 = $db->query("select distinct * from itseprojektit where kurssi_id = '" . $tuote . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($row5 = $result5->fetch_assoc()) {
                        $ipid = $row5[id];

                        if (!$result6 = $db->query("select distinct * from itsetehtavat where itseprojektit_id = '" . $ipid . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        while ($row6 = $result6->fetch_assoc()) {
                            $iptid = $row6[id];
                            $db->query("delete from itsetehtavatkp where itsetehtavat_id = '" . $iptid . "'");
                            $db->query("delete from itsetehtavat where id = '" . $iptid . "'");
                        }

                        $db->query("delete from opiskelijankurssit where itseprojekti_id ='" . $ipid . "'");

                        $db->query("delete from itseprojektit_tasot where itseprojekti_id = '" . $ipid . "'");
                        $db->query("delete from opiskelijankirja where itseprojekti_id = '" . $ipid . "'");
                        $db->query("delete from itseprojektit where id = '" . $ipid . "'");
                    }

                    //sektoridiagrammit

                    if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where kurssi_id = '" . $tuote . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($rivi = $haeopiskelijat->fetch_assoc()) {
                        $id = $rivi[opiskelija_id];



                        $pienimi = 'images/sektori' . $id . '.png';
                        if (file_exists($pienimi)) {
                            unlink($pienimi);
                        }
                        $pienimi = 'images/sektori2' . $id . '.png';
                        if (file_exists($pienimi)) {
                            unlink($pienimi);
                        }
                        $pienimi = 'images/sektori3' . $id . '.png';
                        if (file_exists($pienimi)) {
                            unlink($pienimi);
                        }
                        $pienimi = 'images/sektori4' . $id . '.png';
                        if (file_exists($pienimi)) {
                            unlink($pienimi);
                        }
                    }


                    //kysymykset (vanha)
                    $db->query("delete from kysymykset where kurssi_id = '" . $tuote . "'");


                    //keskustelut
                    if (!$haekesk = $db->query("select distinct id from keskustelut where kurssi_id = '" . $tuote . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($rowkesk = $haekesk->fetch_assoc()) {
                        $id = $rowkesk[id];
                        $db->query("delete from kayttajan_tykkaykset where keskustelut_id ='" . $id . "'");
                    }

                    $db->query("delete from keskustelut where kurssi_id = '" . $tuote . "'");

                    $db->query("delete from kurssin_keskustelut where kurssi_id = '" . $tuote . "'");
                    //etusivun aikataulu
                    $db->query("delete from kurssiaikataulut where kurssi_id = '" . $tuote . "'");
                    //etusivun palautteet
                    $db->query("delete from palautteet where kurssi_id = '" . $tuote . "'");


                    //lopulliset poistot

                    $db->query("delete from opiskelijankurssit where kurssi_id = '" . $tuote . "'");
                    $db->query("delete from kurssit where id = '" . $tuote . "'");
                }
            }
        }


        if (empty($vaarat)) {
            echo'<br><b style="color: #e608b8;">Valitut kurssit/opintojaksot on nyt poistettu.</b><br><br>';

            if ($_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink')
                echo' <a href="kurssit.php"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
            else
                echo' <a href="omatkurssit.php"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
        }
        else {

            echo'<br>Seuraavissa kursseissa et ole vastuuopettaja, joten et voi poistaa niitä.<br>';

            $arrlength = count($vaarat);

            for ($x = 0; $x < $arrlength; $x++) {


                if (!$resultv = $db->query("select nimi, id, koodi from kurssit where id = '" . $vaarat[$x] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($row2 = $resultv->fetch_assoc()) {
                    $nimi = $row2[nimi];
                    $id = $row2[id];
                    $koodi = $row2[koodi];
                }

                echo "<br><b>" . $koodi . ' ' . $nimi . '</b>';
            }


            echo "<br>";
            echo "<br>";

            echo "<br>";
            echo '<p style="color: #2b6777; font-weight: bold" >Haluatko poistua näiltä kursseilta/opintojaksoilta?</p>';


            echo'<form action="poistukurssilta.php" method="post" style="display: inline-block">';



            for ($i = 0; $i < count($vaarat); $i++) {
                echo'<input type="hidden" name="mita[]" value=' . $vaarat[$i] . '>';
            }

            echo'<input type="submit" class="myButton8"  role="button"  value="Kyllä">
			</form>';
            echo' <a href="omatkurssit.php" class="myButton8"  role="button"  style="margin-left: 30px">En</a>';
        }
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