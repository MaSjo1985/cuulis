<?php
session_start(); 



ob_start();





include("yhteys.php");


echo'<br><br><b>ENNEN KORJAUKSIA: </b>';

if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $lause2 = $rowt[avain];
    $korjattavat = array("ä");

//
    $lause = str_replace($korjattavat, "a?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("a?", "a?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>ä:t löydetty: ' . $maara . ' kpl.';
echo'<br>a?-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><br><b>KORJAUSTEN JÄLKEEN: </b>';

// KORJATAAN: ä -> a?

if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $id = $rowt[id];
    $korjattavat = array("ä");
//
    $lause = str_replace($korjattavat, "a?", $lause, $uusimaara);
//$maara = $maara + substr_count($lause, "ä"); //

    $maara = $maara + $uusimaara;
//$db->query("update tiedostot set omatallennusnimi = '".$lause."' where id = '".$id."'");
}


echo'<br><br>ä-merkinnät korvattu a?:llä ' . $maara . ' kpl.';




if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $lause2 = $rowt[avain];
    $korjattavat = array("ä");

//
    $lause = str_replace($korjattavat, "a?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("a?", "a?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>ä:t löydetty: ' . $maara . ' kpl.';
echo'<br>a?-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><b>ENNEN KORJAUKSIA: </b>';

if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $lause2 = $rowt[avain];
    $korjattavat = array("Ä");

//
    $lause = str_replace($korjattavat, "A?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("A?", "A?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>Ä:t löydetty: ' . $maara . ' kpl.';
echo'<br>A?-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><br><b>KORJAUSTEN JÄLKEEN: </b>';

// KORJATAAN: Ä -> A?

if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $id = $rowt[id];
    $korjattavat = array("Ä");
//
    $lause = str_replace($korjattavat, "A?", $lause, $uusimaara);
//$maara = $maara + substr_count($lause, "ä"); //

    $maara = $maara + $uusimaara;
//$db->query("update tiedostot set omatallennusnimi = '".$lause."' where id = '".$id."'");
}


echo'<br><br>Ä-merkinnät korvattu A?:llä ' . $maara . ' kpl.';




if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $lause2 = $rowt[avain];
    $korjattavat = array("Ä");

//
    $lause = str_replace($korjattavat, "A?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("A?", "A?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>Ä:t löydetty: ' . $maara . ' kpl.';
echo'<br>A?-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><b>ENNEN KORJAUKSIA: </b>';

if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $lause2 = $rowt[avain];
    $korjattavat = array("ö");

//
    $lause = str_replace($korjattavat, "o?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;



    $lause2 = str_replace("o?", "o?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>ö:t löydetty: ' . $maara . ' kpl.';

echo'<br>o?-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><br><b>KORJAUSTEN JÄLKEEN: </b>';

// KORJATAAN: ö -> o?

if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $id = $rowt[id];
    $korjattavat = array("ö");
//
    $lause = str_replace($korjattavat, "o?", $lause, $uusimaara);
//$maara = $maara + substr_count($lause, "ä"); //

    $maara = $maara + $uusimaara;
//$db->query("update tiedostot set omatallennusnimi = '".$lause."' where id = '".$id."'");
}


echo'<br><br>ö-merkinnät korvattu o?:llä ' . $maara . ' kpl.';




if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $lause2 = $rowt[avain];
    $korjattavat = array("ö");

//
    $lause = str_replace($korjattavat, "o?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("o?", "o?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>ö:t löydetty: ' . $maara . ' kpl.';
echo'<br>o?-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><b>ENNEN KORJAUKSIA: </b>';

if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $lause2 = $rowt[avain];
    $korjattavat = array("Ö");

//
    $lause = str_replace($korjattavat, "O?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("O?", "O?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>Ö:t löydetty: ' . $maara . ' kpl.';
echo'<br>O?-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><br><b>KORJAUSTEN JÄLKEEN: </b>';

// KORJATAAN: Ö -> O?

if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $id = $rowt[id];
    $korjattavat = array("Ö");
//
    $lause = str_replace($korjattavat, "O?", $lause, $uusimaara);
//$maara = $maara + substr_count($lause, "ä"); //

    $maara = $maara + $uusimaara;
//$db->query("update tiedostot set omatallennusnimi = '".$lause."' where id = '".$id."'");
}


echo'<br><br>Ö-merkinnät korvattu O?:llä ' . $maara . ' kpl.';




if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $lause2 = $rowt[avain];
    $korjattavat = array("Ö");

//
    $lause = str_replace($korjattavat, "O?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("O?", "O?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>Ö:t löydetty: ' . $maara . ' kpl.';
echo'<br>O?-merkkejä löydetty: ' . $maara2 . ' kpl.';




echo'<br><br><b>ENNEN KORJAUKSIA: </b>';

if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $lause2 = $rowt[avain];
    $korjattavat = array("å");

//
    $lause = str_replace($korjattavat, "q?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("q?", "q?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>å:t löydetty: ' . $maara . ' kpl.';
echo'<br>q?-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><br><b>KORJAUSTEN JÄLKEEN: </b>';

// KORJATAAN: å -> q?

if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $id = $rowt[id];
    $korjattavat = array("å");
//
    $lause = str_replace($korjattavat, "q?", $lause, $uusimaara);
//$maara = $maara + substr_count($lause, "ä"); //

    $maara = $maara + $uusimaara;
//$db->query("update tiedostot set omatallennusnimi = '".$lause."' where id = '".$id."'");
}


echo'<br><br>å-merkinnät korvattu q?:llä ' . $maara . ' kpl.';




if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $lause2 = $rowt[avain];
    $korjattavat = array("å");

//
    $lause = str_replace($korjattavat, "q?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("q?", "q?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>å:t löydetty: ' . $maara . ' kpl.';
echo'<br>q?-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><b>ENNEN KORJAUKSIA: </b>';

if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $lause2 = $rowt[avain];
    $korjattavat = array("Å");

//
    $lause = str_replace($korjattavat, "Q?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("Q?", "Q?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>Å:t löydetty: ' . $maara . ' kpl.';
echo'<br>Q?-merkkejä löydetty: ' . $maara2 . ' kpl.';



echo'<br><br><br><b>KORJAUSTEN JÄLKEEN: </b>';

// KORJATAAN: Å -> Q?

if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $id = $rowt[id];
    $korjattavat = array("Å");
//
    $lause = str_replace($korjattavat, "Q?", $lause, $uusimaara);
//$maara = $maara + substr_count($lause, "ä"); //

    $maara = $maara + $uusimaara;
//$db->query("update tiedostot set omatallennusnimi = '".$lause."' where id = '".$id."'");
}


echo'<br><br>Å-merkinnät korvattu Q?:llä ' . $maara . ' kpl.';




if (!$haetiedostot = $db->query("select distinct * from kurssit")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$maara = 0;
$maara2 = 0;
while ($rowt = $haetiedostot->fetch_assoc()) {

    $lause = $rowt[avain];
    $lause2 = $rowt[avain];
    $korjattavat = array("Å");

//
    $lause = str_replace($korjattavat, "Q?", $lause, $uusimaara);
    $maara = $maara + $uusimaara;

    $lause2 = str_replace("Q?", "Q?", $lause2, $uusimaara2);
    $maara2 = $maara2 + $uusimaara2;
}


echo'<br><br>Å:t löydetty: ' . $maara . ' kpl.';
echo'<br>Q?-merkkejä löydetty: ' . $maara2 . ' kpl.';
//
//  