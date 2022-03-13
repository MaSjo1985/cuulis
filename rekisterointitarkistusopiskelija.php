<?php
session_start();
ob_start();


echo'<!DOCTYPE html>
<html>
<head>';

include("yhteys.php");

include("header.php");
echo'<div class="cm8-container">';
echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
echo'<div class="cm8-margin-top"></div>';

 $_POST[Rooli]='opiskelija';
 
$siivottusposti = mysqli_real_escape_string($db, $_POST[Sposti]);
$siivottuetunimi = mysqli_real_escape_string($db, $_POST[Etunimi]);
$siivottusukunimi = mysqli_real_escape_string($db, $_POST[Sukunimi]);
$siivottusposti = trim($siivottusposti);
// $siivottusalasana=mysqli_real_escape_string($db, $_POST[Salasana]);
// $siivottuuusisalasana=mysqli_real_escape_string($db, $_POST[UusiSalasana]);

$etunimi100 = $siivottuetunimi;
$sukunimi100 = $siivottusukunimi;
$sposti100 = $siivottusposti;
$rooli100 =  $_POST[Rooli];


if (!$result100 = $db->query("select distinct * from koulut where id='" . $_POST[koulu] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
while ($row100 = $result100->fetch_assoc()) {
    $koulu100 = $row100[Nimi];
}

    //generoidaan salasana
    $salt = "CR85ms";
    $paivays = "" . date("h:i:s") . "";
    $krypattu = md5($salt . $paivays);

    //generoidaan tarkistuskoodi
   
   $paivays = "" . date("h:i:s") . "";
$uniqid = $paivays.uniqid('', true);
   $krypattu2 = md5($uniqid);


    $stmt = $db->prepare("INSERT INTO kayttajat (etunimi, sukunimi, kokonimi, salasana, rooli, sposti, vahvistettu, tarkistettu, tarkistuskoodi, uusitunnus, kayttoehdot_hyvaksytty) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 1)");
    $stmt->bind_param("ssssssiis", $etunimi, $sukunimi, $kokonimi, $salasana, $rooli, $sposti, $vahvistettu, $tarkistettu, $koodi);
    $etunimi = $siivottuetunimi;
    $sukunimi = $siivottusukunimi;
    $kokonimi = $siivottuetunimi . ' ' . $siivottusukunimi;
    $salasana = $krypattu;
    $rooli = $_POST[Rooli];
    $sposti = $siivottusposti;
    $vahvistettu = 0;
    $tarkistettu = 1;
    $koodi = $krypattu2;
    $stmt->execute();
    $stmt->close();


    $stmt2 = $db->prepare("SELECT DISTINCT id FROM kayttajat WHERE BINARY sposti=?");
    $stmt2->bind_param("s", $sposti);
    // prepare and bind
    $sposti = $siivottusposti;

    $stmt2->execute();

    $stmt2->store_result();

    $stmt2->bind_result($column1);


    while ($stmt2->fetch()) {
        $id = $column1;
    }

    $db->query("insert into kayttajankoulut  (kayttaja_id, koulu_id, odottaa) values('" . $id . "', '" . $_POST[koulu] . "', 1)");

    $stmt2->close();


    header('location: vahvistus.php?id=' . $id);




echo "</div>";
echo "</div>";

include("footer.php");
?>
</body>
</html>	