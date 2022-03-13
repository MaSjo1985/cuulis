<?php
session_start(); 


ob_start();
ob_start();
echo'<!DOCTYPE html>
<html>
<head>';

include("yhteys.php");

include("header.php");
echo'<div class="cm8-container">';
echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
echo'<div class="cm8-margin-top"></div>';


$siivottusposti = mysqli_real_escape_string($db, $_POST[Sposti]);
$siivottuetunimi = mysqli_real_escape_string($db, $_POST[Etunimi]);
$siivottusukunimi = mysqli_real_escape_string($db, $_POST[Sukunimi]);
$siivottusposti = trim($siivottusposti);

if($_POST[rooli]=='opettaja'){
    $siivottusposti=strtolower($siivottusposti);
}
// $siivottusalasana=mysqli_real_escape_string($db, $_POST[Salasana]);
// $siivottuuusisalasana=mysqli_real_escape_string($db, $_POST[UusiSalasana]);

$etunimi100 = $siivottuetunimi;
$sukunimi100 = $siivottusukunimi;
$sposti100 = $siivottusposti;
$rooli100 = $_POST[rooli];


if($_SESSION[Rooli]!='admin'){
    if (!$result100 = $db->query("select distinct * from koulut where id='" . $_SESSION[kouluId] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
}
else{
    if (!$result100 = $db->query("select distinct * from koulut where id='" . $_POST[koulu] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
}


while ($row100 = $result100->fetch_assoc()) {
    $koulu100 = $row100[Nimi];
}

if($_POST[rooli]=='opettaja'){
 
    //generoidaan salasana
    $salt = "CR85ms";
    $paivays = "" . date("h:i:s") . "";
    $krypattu = md5($salt . $paivays);

   $paivays = "" . date("h:i:s") . "";
   $uniqid = $paivays.uniqid('', true);

   $krypattu2 = md5($uniqid);
   
    $stmt = $db->prepare("INSERT INTO kayttajat (etunimi, sukunimi, kokonimi, salasana, rooli, sposti, vahvistettu, tarkistettu, tarkistuskoodi, uusitunnus, kayttoehdot_hyvaksytty, nollattu) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 0, 1)");
    $stmt->bind_param("ssssssiis", $etunimi, $sukunimi, $kokonimi, $salasana, $rooli, $sposti, $vahvistettu, $tarkistettu, $koodi);
    $etunimi = $siivottuetunimi;
    $sukunimi = $siivottusukunimi;
    $kokonimi = $siivottuetunimi . ' ' . $siivottusukunimi;
    $salasana = $krypattu;
    $rooli = $_POST[rooli];
    $sposti = $siivottusposti;
    $vahvistettu = 0;
    $tarkistettu = 1;
    $nollattu = 1;
    $koodi = $krypattu2;

    $stmt->execute();
    $stmt->close();
    $stmt2 = $db->prepare("SELECT DISTINCT id FROM kayttajat WHERE sposti=?");
    $stmt2->bind_param("s", $sposti);
    // prepare and bind
    $sposti = $siivottusposti;

    $stmt2->execute();

    $stmt2->store_result();

    $stmt2->bind_result($column1);


    while ($stmt2->fetch()) {
        $id = $column1;
    }

    $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

    $otsikko = "Sinut on lisätty Cuulis-oppimisympäristön käyttäjäksi";
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


    $viesti = 'Sinut on lisätty opettajaksi Cuulis-oppimisympäristöön seuraavilla tiedoilla:<br><br>Etunimi: ' . $etunimi100 . '<br>Sukunimi: ' . $sukunimi100 . '<br>Käyttäjätunnus eli sähköpostiosoite: '.$sposti100.'<br>Ensisijainen oppilaitos: ' . $koulu100 . '<br><br>Sinun tulee vielä asettaa itsellesi salasana, minkä voit tehdä suoraan <a href="https://cuulis.cm8solutions.fi/vahvistus.php?admin=1&id=' . $id . '"> tästä. </a><br><br><em>Tähän viestiin ei voi vastata.</em>';

    $viesti = str_replace("\n.", "\n..", $viesti);


   $varmistus = mail($siivottusposti, $otsikko, $viesti, $headers);
            

    
   if($_SESSION[Rooli]!='admin'){
           $db->query("insert into kayttajankoulut  (kayttaja_id, koulu_id, odottaa) values ('" . $id . "', '" . $_SESSION[kouluId] . "', 1)");


   }
   else{
           $db->query("insert into kayttajankoulut  (kayttaja_id, koulu_id, odottaa) values ('" . $id . "', '" . $_POST[koulu] . "', 1)");

   }

      $stmt2->close();
}
else{
   
   
    //generoidaan salasana
      $siivottusalasana = mysqli_real_escape_string($db, $_POST[Salasana]);
    $siivottuuusisalasana = mysqli_real_escape_string($db, $_POST[UusiSalasana]);
    $siivottusalasana = trim($siivottusalasana);
$siivottuuusisalasana = trim($siivottuuusisalasana);
    $salt = "8CMr85";
    $krypattu = md5($salt . $siivottusalasana);
     
    //generoidaan tarkistuskoodi
   
   $paivays = "" . date("h:i:s") . "";
    $uniqid = $paivays.uniqid('', true);
   $krypattu2 = md5($uniqid);
    
    $stmt = $db->prepare("INSERT INTO kayttajat (etunimi, sukunimi, kokonimi, salasana, rooli, sposti, vahvistettu, tarkistettu, tarkistuskoodi, uusitunnus, kayttoehdot_hyvaksytty, nollattu) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiisiii", $etunimi, $sukunimi, $kokonimi, $salasana, $rooli, $sposti, $vahvistettu, $tarkistettu, $koodi, $uusitunnus, $kayttoehdot, $nollattu);
       
    $etunimi = $siivottuetunimi;
    $sukunimi = $siivottusukunimi;
    $kokonimi = $siivottuetunimi . ' ' . $siivottusukunimi;
    $salasana = $krypattu;
    $rooli = $_POST[rooli];
    $sposti = $siivottusposti;
    $vahvistettu = 0;
    $tarkistettu = 1;
    $nollattu=1;
      $uusitunnus=1;
    $koodi = $krypattu2;
  $kayttoehdot=0;
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


     if($_SESSION[Rooli]!='admin'){
           $db->query("insert into kayttajankoulut  (kayttaja_id, koulu_id, odottaa) values ('" . $id . "', '" . $_SESSION[kouluId] . "', 1)");


   }
   else{
           $db->query("insert into kayttajankoulut  (kayttaja_id, koulu_id, odottaa) values ('" . $id . "', '" . $_POST[koulu] . "', 1)");

   }
}

   header('location: uusikayttajavahvistus.php?id='.$id.'&rooli='.$_POST[rooli]);







echo "</div>";
echo "</div>";

include("footer.php");
?>
</body>
</html>	