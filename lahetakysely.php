<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
<head>';

if($_POST[akt] == 1){
  echo'<title>Kayttäjätunnuksen uudelleenaktivointi </title>';
}
else{
 echo'<title>Unohtunut käyttäjätunnus/salasana</title>';
}





include("yhteys.php");

include("header.php");
echo'<div class="cm8-container7">';

$siivottusposti = mysqli_real_escape_string($db, $_POST["sposti"]);
$siivottusposti = trim($siivottusposti);
$siivottusposti=strtolower($siivottusposti);

$headers .= "Organization: Cuulis-oppimisympäristö\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . PHP_EOL;
$headers .= "X-Priority: 1 (Highest)\n";
$headers .= "X-MSMail-Priority: High\n";
$headers .= "Importance: High\n";
$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

//$headers         = 'From: ' . $website_naam . ' <' . $from . '>' 
//$headers        .= 'X-Mailer: PHP/' . phpversion() . PHP_EOL;
//$headers        .= 'X-Priority: Normal' . PHP_EOL;
//$headers        .= ($html) ? 'MIME-Version: 1.0' . PHP_EOL : '';
//$headers        .= ($html) ? 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL : '';
if($_POST[akt] == 1){
    $otsikko = "Cuulis-oppimisympäristön käyttäjätunnuksen uudelleenaktivointilinkki";
}
else{
    $otsikko = "Cuulis-oppimisympäristön salasanan vaihtolinkki";
}

$otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";




$stmt = $db->prepare("SELECT DISTINCT sposti FROM kayttajat WHERE sposti=?");
$stmt->bind_param("s", $sposti);
// prepare and bind
$sposti = $siivottusposti;

$stmt->execute();

$stmt->store_result();

$stmt->bind_result($column1);

if (!$tulos2 = $db->query("select distinct sposti from kayttajat where rooli='admin'")) {
    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
}

if ($stmt->num_rows == 1) {
    
  $paivays = "" . date("h:i:s") . "";
$uniqid = $paivays.uniqid('', true);

    $tarkistuskoodi = md5($uniqid);

    while ($stmt->fetch()) {
        $sposti = $column1;
    }

    while ($row2 = $tulos2->fetch_assoc()) {
        $sposti2 = $row2["sposti"];
    }

    $stmt2 = $db->prepare("UPDATE kayttajat SET tarkistuskoodi=? WHERE sposti=?");
    $stmt2->bind_param("ss", $koodi, $sposti3);
    // prepare and bind
    $koodi = $tarkistuskoodi;
    $sposti3 = $siivottusposti;

    $stmt2->execute();

if($_POST[akt] == 1){
   $kysely = 'Cuulis-oppimisympäristön käyttäjätunnuksesi on nyt aktivoitu uudelleen.<br><br>Käy antamassa uusi salasana <a href="https://cuulis.cm8solutions.fi/uudelleenaktivointi.php?tk=' . $tarkistuskoodi . '">tästä linkistä</a><br><br><em>Tähän viestiin ei voi vastata.</em>';

}
else{
  $kysely = 'Voit käydä vaihtamassa Cuulis-oppimisympäristön salasanasi <a href="https://cuulis.cm8solutions.fi/uudelleenaktivointi.php?tk=' . $tarkistuskoodi . '">tästä linkistä</a><br><br><em>Tähän viestiin ei voi vastata.</em>';

}
  
    $kysely = str_replace("\n.", "\n..", $kysely);

    $body = '<html><body>';


    $body .= '<p>' . $kysely . '</p>';
    $body .= "</body></html>";
    if ($sent == 0) {
        $viesti = mail($sposti, $otsikko, $body, $headers);
        $sent = 1;
    }


    $kysely2 = 'Cuulis-oppimisympäristöstä on lähetetty käyttäjätunnuksen uudelleenaktivointilinkki osoitteeseen: ' . $siivottusposti . '.';
//    $viesti2 = mail($sposti2, $otsikko, $kysely2, $headers);


    if ($viesti) {
        header("location: lahetakysely2.php?akt=".$_POST[akt]);
    } else {
        echo "<br>Viestin lähettäminen ei onnistunut. Yritä uudelleen!";
        echo '<br><br><a href="tunnustenkysely.php?akt='.$_POST[akt].'"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
    }
} else {
    echo '<br>Sähköpostiosoitetta ei ole rekisteröity. <a href="tunnustenkysely.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Yritä uudelleen </a>';
    echo '<br><br> <a href="palaute.php">Voit ottaa yhteyttä Cuulis-oppimisympäristön ylläpitäjään tästä.</a>';
}
$stmt->close();
$stmt2->close();
echo "</div>";

include("footer.php");
?>

</body>
</html>	