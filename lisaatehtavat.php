<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    if (isset($_POST["lisaa"])) {
        die($_POST[ipid]);
        if (!empty($_POST[tehtmaara])) {

            $maara = $_POST[tehtmaara];

            while ($maara > 0) {
                if (!$haevika = $db->query("select distinct jarjestys from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                while ($rowP = $haevika->fetch_assoc()) {

                    $uusijarjestys = $rowP[jarjestys] + 1;
                }



                $db->query("insert into itsetehtavat (itseprojektit_id, jarjestys, aihe) values('" . $_POST[ipid] . "', '" . $uusijarjestys . "', 0)");

                if (!$haeuusin = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowu = $haeuusin->fetch_assoc()) {
                    $teid = $rowu[id];
                }

                if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where itseprojekti_id='" . $_POST[ipid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                while ($rowo = $haeopiskelijat->fetch_assoc()) {
                    $db->query("insert into itsetehtavatkp (itsetehtavat_id, kayttaja_id) values('" . $teid . "', '" . $rowo[opiskelija_id] . "')");
                }





                $maara--;
            }
        }



        header('location: testaamuokkaus.php?id=' . $_POST[ipid] . '#tanne');
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
