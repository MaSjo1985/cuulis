<?php
session_start();

include("yhteys.php");
echo'<br><br><b>ENNEN KORJAUKSIA: </b>';

if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $lause2 = $rowt[omatallennusnimi];
    $korjattavat = array("ä");

//
    $lause = str_replace($korjattavat, "a?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("a?", "a?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>a?:t löydetty: ' . $maara . ' kpl.';
echo'<br>ä-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><br><b>KORJAUSTEN JÄLKEEN: </b>';

// KORJATAAN: a? -> ä

if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $id = $rowt[id];
    $korjattavat = array("a?");
//
    $lause = str_replace($korjattavat, "ä", $lause, $uusimaara);
//$maara = $maara + substr_count($lause, "ä"); //

    $maara = $maara + $uusimaara;
    $db->query("update tiedostot set omatallennusnimi = '" . $lause . "' where id = '" . $id . "'");
}


echo'<br><br>ä-merkinnät korvattu a?:llä ' . $maara . ' kpl.';




if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $lause2 = $rowt[omatallennusnimi];
    $korjattavat = array("a?");

//
    $lause = str_replace($korjattavat, "ä", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("ä", "ä", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>a?:t löydetty: ' . $maara . ' kpl.';
echo'<br>ä-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><b>ENNEN KORJAUKSIA: </b>';

if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $lause2 = $rowt[omatallennusnimi];
    $korjattavat = array("A?");

//
    $lause = str_replace($korjattavat, "Ä", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("Ä", "Ä", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>A?:t löydetty: ' . $maara . ' kpl.';
echo'<br>Ä-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><br><b>KORJAUSTEN JÄLKEEN: </b>';

// KORJATAAN: A? -> Ä

if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $id = $rowt[id];
    $korjattavat = array("A?");
//
    $lause = str_replace($korjattavat, "Ä", $lause, $uusimaara);
//$maara = $maara + substr_count($lause, "ä"); //

    $maara = $maara + $uusimaara;
    $db->query("update tiedostot set omatallennusnimi = '" . $lause . "' where id = '" . $id . "'");
}


echo'<br><br>A?-merkinnät korvattu Ä:llä ' . $maara . ' kpl.';




if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $lause2 = $rowt[omatallennusnimi];
    $korjattavat = array("A?");

//
    $lause = str_replace($korjattavat, "Ä", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("Ä", "Ä", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>A?:t löydetty: ' . $maara . ' kpl.';
echo'<br>Ä-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><b>ENNEN KORJAUKSIA: </b>';

if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $lause2 = $rowt[omatallennusnimi];
    $korjattavat = array("o?");

//
    $lause = str_replace($korjattavat, "ö", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("ö", "ö", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>o?:t löydetty: ' . $maara . ' kpl.';
echo'<br>ö-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><br><b>KORJAUSTEN JÄLKEEN: </b>';

// KORJATAAN: o? -> ö

if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $id = $rowt[id];
    $korjattavat = array("o?");
//
    $lause = str_replace($korjattavat, "ö", $lause, $uusimaara);
//$maara = $maara + substr_count($lause, "ä"); //

    $maara = $maara + $uusimaara;
    $db->query("update tiedostot set omatallennusnimi = '" . $lause . "' where id = '" . $id . "'");
}


echo'<br><br>o?-merkinnät korvattu ö:llä ' . $maara . ' kpl.';




if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $lause2 = $rowt[omatallennusnimi];
    $korjattavat = array("o?");

//
    $lause = str_replace($korjattavat, "ö", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("ö", "ö", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>o?:t löydetty: ' . $maara . ' kpl.';
echo'<br>ö-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><b>ENNEN KORJAUKSIA: </b>';

if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $lause2 = $rowt[omatallennusnimi];
    $korjattavat = array("O?");

//
    $lause = str_replace($korjattavat, "Ö", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("Ö", "Ö", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>O?:t löydetty: ' . $maara . ' kpl.';
echo'<br>Ö-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><br><b>KORJAUSTEN JÄLKEEN: </b>';

// KORJATAAN: O? -> Ö

if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $id = $rowt[id];
    $korjattavat = array("O?");
//
    $lause = str_replace($korjattavat, "Ö", $lause, $uusimaara);
//$maara = $maara + substr_count($lause, "ä"); //

    $maara = $maara + $uusimaara;
    $db->query("update tiedostot set omatallennusnimi = '" . $lause . "' where id = '" . $id . "'");
}


echo'<br><br>O?-merkinnät korvattu Ö:llä ' . $maara . ' kpl.';




if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $lause2 = $rowt[omatallennusnimi];
    $korjattavat = array("O?");

//
    $lause = str_replace($korjattavat, "Ö", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("Ö", "Ö", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>O?:t löydetty: ' . $maara . ' kpl.';
echo'<br>Ö-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><b>ENNEN KORJAUKSIA: </b>';

if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $lause2 = $rowt[omatallennusnimi];
    $korjattavat = array("q?");

//
    $lause = str_replace($korjattavat, "å", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("å", "å", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>q?:t löydetty: ' . $maara . ' kpl.';
echo'<br>å-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><br><b>KORJAUSTEN JÄLKEEN: </b>';

// KORJATAAN: q? -> å

if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $id = $rowt[id];
    $korjattavat = array("q?");
//
    $lause = str_replace($korjattavat, "å", $lause, $uusimaara);
//$maara = $maara + substr_count($lause, "ä"); //

    $maara = $maara + $uusimaara;
    $db->query("update tiedostot set omatallennusnimi = '" . $lause . "' where id = '" . $id . "'");
}


echo'<br><br>q?-merkinnät korvattu å:llä ' . $maara . ' kpl.';




if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $lause2 = $rowt[omatallennusnimi];
    $korjattavat = array("q?");

//
    $lause = str_replace($korjattavat, "å", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("å", "å", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>q?:t löydetty: ' . $maara . ' kpl.';
echo'<br>å-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><b>ENNEN KORJAUKSIA: </b>';

if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $lause2 = $rowt[omatallennusnimi];
    $korjattavat = array("Q?");

//
    $lause = str_replace($korjattavat, "Å", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("Å", "Å", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>Q?:t löydetty: ' . $maara . ' kpl.';
echo'<br>Å-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><br><b>KORJAUSTEN JÄLKEEN: </b>';

// KORJATAAN: Q? -> Å

if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $id = $rowt[id];
    $korjattavat = array("Q?");
//
    $lause = str_replace($korjattavat, "Å", $lause, $uusimaara);
//$maara = $maara + substr_count($lause, "ä"); //

    $maara = $maara + $uusimaara;
    $db->query("update tiedostot set omatallennusnimi = '" . $lause . "' where id = '" . $id . "'");
}


echo'<br><br>Q?-merkinnät korvattu Å:llä ' . $maara . ' kpl.';




if (!$haetiedostot = $db->query("select distinct * from tiedostot")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[omatallennusnimi];
    $lause2 = $rowt[omatallennusnimi];
    $korjattavat = array("Q?");

//
    $lause = str_replace($korjattavat, "Å", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("Å", "Å", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>Q?:t löydetty: ' . $maara . ' kpl.';
echo'<br>Å-merkkejä löydetty: ' . $maara2 . ' kpl.';
