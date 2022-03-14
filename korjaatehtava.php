<?php
session_start(); 


ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
include("yhteys.php");



if (isset($_SESSION["Kayttajatunnus"])) {
    if (!$projekti = $db->query("select * from itseprojektit where id='" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($projekti->num_rows != 0) {



        if (!$haekommentti = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $_GET[teid] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowi = $haekommentti->fetch_assoc()) {
            $kom = $rowi[kommentti];
        }

        if ($kom != '') {

            $db->query("update itsetehtavatkp set tallennettu=0 where itsetehtavat_id = '" . $_GET[teid] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");

            $db->query("update itsetehtavatkp set tehty=0 where itsetehtavat_id = '" . $_GET[teid] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
        } else {
            $db->query("update itsetehtavatkp set tehty=0 where itsetehtavat_id = '" . $_GET[teid] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
        }

        $db->query("update itsetehtavatkp set osattu=0 where itsetehtavat_id = '" . $_GET[teid] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
        $db->query("update itsetehtavatkp set toive=0 where itsetehtavat_id = '" . $_GET[teid] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
    }

    if (!$haejarjestys = $db->query("select distinct jarjestys from itsetehtavat where id='" . $_GET[teid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowj = $haejarjestys->fetch_assoc()) {

        $jarjestys = $rowj[jarjestys];
    }
    if (!$haeseuraava = $db->query("select distinct itsetehtavat.id as tid from itsetehtavat, itsetehtavatkp where itsetehtavat.jarjestys=('" . $jarjestys . "' - 3) AND itsetehtavat.itseprojektit_id='" . $_GET[id] . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowm = $haeseuraava->fetch_assoc()) {

        $palaa = $rowm[tid];
    }



    header('location: itsetyot.php?i=' . $_GET[id] . '#' . $palaa);
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

