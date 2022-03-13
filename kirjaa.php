<?php
session_start(); 



ob_start();



include("yhteys.php");


$arvo = $_POST[arvo];
$kayttaja = $_SESSION["Id"];

if (!$result22 = $db->query("select * from kayttajan_arvostelu where kayttaja_id = '" . $_SESSION["Id"] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

if ($_POST[arvo] != 0) {
    if ($_POST[arvo] > 0 && $_POST[arvo] <= 5) {
        if ($result22->num_rows == 0) {
            $db->query("insert into kayttajan_arvostelu (kayttaja_id, arvo) values('" . $kayttaja . "', '" . $arvo . "')");
            echo json_encode(array('status' => 'insert', 'msg' => 'Lisätty'));
        } else {
            $db->query("update kayttajan_arvostelu set arvo = '" . $arvo . "' where kayttaja_id = '" . $kayttaja . "'");
            echo json_encode(array('status' => 'update', 'msg' => 'Päivitetty'));
        }
    }
} else {
    if ($result22->num_rows != 0) {
        $db->query("delete from kayttajan_arvostelu where kayttaja_id='" . $kayttaja . "'");
    }
}
?>
