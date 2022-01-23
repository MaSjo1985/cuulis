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
include("diagrammit.php");
include("diagrammit3.php");

if (isset($_SESSION["Kayttajatunnus"])) {





    $lista2 = $_POST["lista"];




    $value2 = $lista2;
    if (isset($_POST[kommentti])) {
        $$_POST[kommentti] = nl2br($_POST[kommentti]);
        $db->query("update itsetehtavatkp set kommentti='" . $_POST[kommentti] . "' where itsetehtavat_id = '" . $value2 . "' AND kayttaja_id='" . $opid . "'");
    }
    if (isset($_POST[omat])) {
        $db->query("update itsetehtavatkp set opiskelijan_pisteet='" . $_POST[omat] . "' where itsetehtavat_id = '" . $value2 . "' AND kayttaja_id='" . $opid . "'");
    }

    $db->query("update itsetehtavatkp set tehty=1 where itsetehtavat_id = '" . $value2 . "' AND kayttaja_id='" . $opid . "'");
    $db->query("update itsetehtavatkp set osattu=0 where itsetehtavat_id = '" . $value2 . "' AND kayttaja_id='" . $opid . "'");
    $db->query("update itsetehtavatkp set tallennettu=1 where itsetehtavat_id = '" . $value2 . "' AND kayttaja_id='" . $opid . "'");

    tuoDiagrammi($opid, $ipid);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
}
?>


