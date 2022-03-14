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

    //poistetaan sarake jos on jo




    $kidmihin = $_POST[kidmihin];
    $kidmista = $_POST[kidmista];
    if (!$haeinfo = $db->query("select distinct infoitsearviointi from kurssit where id='" . $kidmista . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
     while ($rowinfo = $haeinfo->fetch_assoc()) {
            $info = $rowinfo[infoitsearviointi];
        }
    $db->query("delete from ia_sarakkeet where kurssi_id = '" . $kidmihin . "'");
    if (!$haesarakkeet = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $kidmista . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rows = $haesarakkeet->fetch_assoc()) {

        $db->query("insert into ia_sarakkeet (kurssi_id, jarjestys) values('" . $kidmihin . "', '" . $rows[jarjestys] . "')");


        //haetaan arvioinnit
        if (!$haeia = $db->query("select distinct * from ia where kurssi_id='" . $kidmista . "' AND ia_sarakkeet_jarjestys='" . $rows[jarjestys] . "' order by jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowia = $haeia->fetch_assoc()) {
            $iaidvanha = $rowia[id];
            $db->query("insert into ia (kurssi_id) values('" . $kidmihin . "')");

            if (!$haeviimeisin2 = $db->query("select distinct id from ia where kurssi_id='" . $kidmihin . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowv2 = $haeviimeisin2->fetch_assoc()) {
                $iaiduusi = $rowv2[id];
            }

            $db->query("update ia set otsikko='" . $rowia[otsikko] . "' where id = '" . $iaiduusi . "'");
            $db->query("update ia set jarjestys='" . $rowia[jarjestys] . "' where id = '" . $iaiduusi . "'");
            $db->query("update ia set vastaus='" . $rowia[vastaus] . "' where id = '" . $iaiduusi . "'");
            $db->query("update ia set onvastaus='" . $rowia[onvastaus] . "' where id = '" . $iaiduusi . "'");
            $db->query("update ia set onotsikko='" . $rowia[onotsikko] . "' where id = '" . $iaiduusi . "'");
            $db->query("update ia set onradio='" . $rowia[onradio] . "' where id = '" . $iaiduusi . "'");
            $db->query("update ia set oncheckbox='" . $rowia[oncheckbox] . "' where id = '" . $iaiduusi . "'");
            $db->query("update ia set onteksti='" . $rowia[onteksti] . "' where id = '" . $iaiduusi . "'");
            $db->query("update ia set ia_sarakkeet_jarjestys='" . $rowia[ia_sarakkeet_jarjestys] . "' where id = '" . $iaiduusi . "'");
 $db->query("update kurssit set infoitsearviointi='" . $info . "' where id = '" . $_SESSION[KurssiId] . "'");
            if ($rowia[onradio] == 1 || $rowia[oncheckbox]) {

                if (!$haevaihtoehto = $db->query("select distinct * from iavaihtoehdot where ia_id='" . $iaidvanha . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowv = $haevaihtoehto->fetch_assoc()) {
                    $db->query("INSERT INTO iavaihtoehdot (ia_id, vaihtoehto) VALUES ('" . $iaiduusi . "', '" . $rowv[vaihtoehto] . "')");
                }
            }
            if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit, kayttajat where opiskelijankurssit.kurssi_id='" . $kidmihin . "' AND kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.kurssi_id='" . $kidmihin . "' AND projekti_id=0 AND itseprojekti_id=0")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowo = $haeopiskelijat->fetch_assoc()) {
                $db->query("insert into iakp (ia_id, kayttaja_id) values('" . $iaiduusi . "', '" . $rowo[opiskelija_id] . "')");
            }
        }
    }





    if ($_POST[mihin] == "uusi") {
        header("location: uusi_ia.php");
    } else if ($_POST[mihin] == "ia") {
        header("location: ia.php");
    } else {
        header("location: ia.php");
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

