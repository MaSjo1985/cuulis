<?php
session_start(); 



ob_start();



include("yhteys.php");


// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
$kuid = $_SESSION['KurssiId'];



if (!$haeaanestykset = $db->query("select * from aanestykset where kurssi_id='" . $kuid . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if ($haeaanestykset->num_rows != 0) {
    echo'<div class="cm8-sidenav" style="padding-top: 30px; margin-top:0px; height: 100%; padding-left: 0px">';
    while ($rowP = $haeaanestykset->fetch_assoc()) {
        $kysymys = $rowP[kysymys];
        $id = $rowP[id];



        if ($_GET[a] == $id) {

            echo$id . '<a href="aanestykset.php?a=' . $id . '" class="btn-info3" style="font-weight: normal; margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp</b> ' . $kysymys . '</a>';
        } else {

            echo$id . '<a href="aanestykset.php?a=' . $id . '" class="btn-info3" style="font-weight: normal; margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kysymys . '</a>';
        }
    }

    echo'</div>';
    echo'<div class="cm8-margin-top"></div>';
    if ($_SESSION["Rooli"] <> 'opiskelija') {
        echo'<form action="aktivoiaanestys.php" method="post" ><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikelisaa" value="+ Lisää äänestys" class="myButton8"  role="button"  style="padding:2px 4px"></form><br>';
    }
}
?>
