<?php
ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

session_start(); // ready to go!
$ipid = $_POST[ipid];
$kayttaja_id = $_POST[opid];
$opid = $_POST[opid];

include "libchart/libchart/classes/libchart.php";
include("yhteys.php");
include("pie.php");
include("diagrammit3.php");
include("diagrammit.php");
if (isset($_SESSION["Kayttajatunnus"])) {
    $lista = $_POST["lista"];
    $ipid = $_POST["ipid"];

    if (!$projekti = $db->query("select * from itseprojektit where id='" . $ipid . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($projekti->num_rows != 0) {



        if (!$haekommentti = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $lista . "' AND kayttaja_id='" . $opid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowi = $haekommentti->fetch_assoc()) {
            $kom = $rowi[kommentti];
        }

        if ($kom != '') {

            $db->query("update itsetehtavatkp set tallennettu=0 where itsetehtavat_id = '" . $lista . "' AND kayttaja_id='" . $opid . "'");

            $db->query("update itsetehtavatkp set tehty=0 where itsetehtavat_id = '" . $lista . "' AND kayttaja_id='" . $opid . "'");
        } else {
            $db->query("update itsetehtavatkp set tehty=0 where itsetehtavat_id = '" . $lista . "' AND kayttaja_id='" . $opid . "'");
        }
        $kom = str_replace('<br />', "", $kom);
        $db->query("update itsetehtavatkp set osattu=0 where itsetehtavat_id = '" . $lista . "' AND kayttaja_id='" . $opid . "'");
        $db->query("update itsetehtavatkp set toive=0 where itsetehtavat_id = '" . $lista . "' AND kayttaja_id='" . $opid . "'");
        $db->query("update itsetehtavatkp set kommentti='' where itsetehtavat_id = '" . $lista . "' AND kayttaja_id='" . $opid . "'");
        $db->query("update itsetehtavatkp set opiskelijan_pisteet=0 where itsetehtavat_id = '" . $lista . "' AND kayttaja_id='" . $opid . "'");
    }
    tuoDiagrammi($opid, $ipid);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
}
?>
</body>
</html>		
</html>	

