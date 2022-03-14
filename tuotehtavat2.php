<?php
session_start();
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {


//    if (!$result5 = $db->query("select distinct * from itseprojektit where id = '" . $_GET[id] . "'")) {
//        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//    }
//
//    while ($row5 = $result5->fetch_assoc()) {
//        $ipid = $row5[id];
//
//        if (!$result6 = $db->query("select distinct * from itsetehtavat where itseprojektit_id = '" . $ipid . "'")) {
//            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//        }
//
//        while ($row6 = $result6->fetch_assoc()) {
//            $iptid = $row6[id];
//            $db->query("delete from itsetehtavatkp where itsetehtavat_id = '" . $iptid . "'");
//            $db->query("delete from itsetehtavat where id = '" . $iptid . "'");
//        }
//    }
//
//    if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where kurssi_id = '" . $_SESSION[KurssiId] . "'")) {
//        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//    }
//
//    while ($rivi = $haeopiskelijat->fetch_assoc()) {
//        $id = $rivi[opiskelija_id];
//
//
//
//        $pienimi = 'images/sektori' . $id . '.png';
//        if (file_exists($pienimi)) {
//            unlink($pienimi);
//        }
//        $pienimi = 'images/sektori2' . $id . '.png';
//        if (file_exists($pienimi)) {
//            unlink($pienimi);
//        }
//        $pienimi = 'images/sektori3' . $id . '.png';
//        if (file_exists($pienimi)) {
//            unlink($pienimi);
//        }
//        $pienimi = 'images/sektori4' . $id . '.png';
//        if (file_exists($pienimi)) {
//            unlink
//($pienimi);
//        }
//    }
//    $ipidvanha = $_GET[valinta];
//
//    if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipidvanha . "' AND painotus = 1")) {
//        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//    }
//    if ($onkopisteet->num_rows != 0) {
//        $db->query("update itseprojektit set painotus=1 where id = '" . $_GET[id] . "'");
//    } else {
//        $db->query("update itseprojektit set painotus=0 where id = '" . $_GET[id] . "'");
//    }
//
//
//
//    if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipidvanha . "' ORDER BY jarjestys")) {
//        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//    }
    if ($_GET["valinta"] == "ei") {
        header('location: tuotehtavat.php?id=' . $_GET[id]);
    } else {
        if (!empty($_GET["mita"])) {
            $lista = $_GET["mita"];
            if (!$haeviimeisin = $db->query("select MAX(jarjestys) as jarjestys from itsetehtavat where itseprojektit_id='" . $_GET[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowV = $haeviimeisin->fetch_assoc()) {
                $vika = $rowV[jarjestys];
            }

            $uusijarjestys = $vika;

            foreach ($lista as $tuote) {
                $uusijarjestys++;
                if (!$haetehtava = $db->query("select distinct * from itsetehtavat where id='" . $tuote . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }




                while ($rowT = $haetehtava->fetch_assoc()) {
                    $db->query("insert into itsetehtavat (itseprojektit_id, sisalto, aihe, otsikko, paino, jarjestys) values('" . $_GET[id] . "', '" . $rowT[sisalto] . "', '" . $rowT[aihe] . "', '" . $rowT[otsikko] . "', '" . $rowT[paino] . "', '" . $uusijarjestys . "')");
                }




                //opiskelijat 

                if (!$haeuusin = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $_GET[id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowU = $haeuusin->fetch_assoc()) {
                    $tehtavaid = $rowU[id];
                }


                if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit, kayttajat where opiskelijankurssit.itseprojekti_id='" . $_GET[id] . "' AND kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                while ($rowo = $haeopiskelijat->fetch_assoc()) {
                    $db->query("insert into itsetehtavatkp (itsetehtavat_id, kayttaja_id) values('" . $tehtavaid . "', '" . $rowo[opiskelija_id] . "')");
                }
            }
        } else {
            
        }




        header('location: testaamuokkaus.php?id=' . $_GET[id]);
    }
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
</html>	

