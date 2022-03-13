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
// $siivottusalasana=mysqli_real_escape_string($db, $_POST[Salasana]);
// $siivottuuusisalasana=mysqli_real_escape_string($db, $_POST[UusiSalasana]);

$etunimi100 = $siivottuetunimi;
$sukunimi100 = $siivottusukunimi;
$sposti100 = $siivottusposti;
$rooli100 = $_POST[Rooli];


if (!$result100 = $db->query("select distinct * from koulut where id='" . $_SESSION[kouluId] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
while ($row100 = $result100->fetch_assoc()) {
    $koulu100 = $row100[Nimi];
}

if ($_POST[Rooli] == "opettaja" || $_POST[Rooli] == "opiskelija" || $_POST[Rooli] == "muu") {

    //generoidaan salasana
    $salt = "CR85ms";
    $paivays = "" . date("h:i:s") . "";
    $krypattu = md5($salt . $paivays);

   $paivays = "" . date("h:i:s") . "";
$uniqid = $paivays.uniqid('', true);
   $krypattu2 = md5($uniqid);
   
    $stmt = $db->prepare("INSERT INTO kayttajat (etunimi, sukunimi, kokonimi, salasana, rooli, sposti, vahvistettu, tarkistettu, tarkistuskoodi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiis", $etunimi, $sukunimi, $kokonimi, $salasana, $rooli, $sposti, $vahvistettu, $tarkistettu, $koodi);
    $etunimi = $siivottuetunimi;
    $sukunimi = $siivottusukunimi;
    $kokonimi = $siivottuetunimi . ' ' . $siivottusukunimi;
    $salasana = $krypattu;
    $rooli = $_POST[Rooli];
    $sposti = $siivottusposti;
    $vahvistettu = 1;
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

    $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

    $otsikko = "Sinut on lisätty Cuulis-oppimisympäristön käyttäjäksi";
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


    $viesti = 'Sinut on lisätty Cuulis-oppimisympäristöön seuraavilla tiedoilla:<br><br>Etunimi: ' . $etunimi100 . '<br>Sukunimi: ' . $sukunimi100 . '<br>Ensisijainen oppilaitos: ' . $koulu100 . '<br>Rooli: ' . $rooli100 . '<br><br>Sinun tulee vielä asettaa itsellesi salasana, minkä voit tehdä suoraan<a href="https://cuulis.cm8solutions.fi/vahvistus.php?admin=1&tk=' . $koodi . '"> tästä. </a><br><br><em>Tähän viestiin ei voi vastata.</em>';

    $viesti = str_replace("\n.", "\n..", $viesti);


  if($_POST[Rooli] != 'opiskelija'){
                $varmistus = mail($siivottusposti, $otsikko, $viesti, $headers);
            }

    

    $db->query("insert into kayttajankoulut  (kayttaja_id, koulu_id, odottaa) values ('" . $id . "', '" . $_SESSION[kouluId] . "', 1)");


    if (!$result = $db->query("select kayttajat.sposti as sposti from koulunadminit, kayttajat where koulunadminit.koulu_id='" . $_SESSION[kouluId] . "' AND koulunadminit.kayttaja_id=kayttajat.id")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($result->num_rows != 0) {

        while ($row = $result->fetch_assoc()) {
            $sposti2 = $row[sposti];



            $otsikko2 = "Uusi käyttäjä on lisätty Cuulis-oppimisympäristöön";
            $otsikko2 = "=?UTF-8?B?" . base64_encode($otsikko2) . "?=";

            $viesti2 = 'Uusi käyttäjä on lisätty Cuulis-oppimisympäristöön seuraavilla tiedoilla:<br><br>Etunimi: ' . $etunimi100 . '<br>Sukunimi: ' . $sukunimi100 . '<br>Ensisijainen oppilaitos: ' . $koulu100 . '<br>Rooli: ' . $rooli100 . '<br><br><em>Tähän viestiin ei voi vastata.</em>';

            $viesti2 = str_replace("\n.", "\n..", $viesti2);



            if($_POST[Rooli] != 'opiskelija'){
                $varmistus2 = mail($sposti2, $otsikko2, $viesti2, $headers);
            }
            
        }

        if (!$tulos3 = $db->query("select distinct sposti from kayttajat where rooli='admin'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }

        while ($row3 = $tulos3->fetch_assoc()) {
            $sposti3 = $row3["sposti"];
        }

        $otsikko3 = "Uusi käyttäjä on lisätty Cuulis-oppimisympäristöön";
        $otsikko3 = "=?UTF-8?B?" . base64_encode($otsikko3) . "?=";

        $kysely3 = 'Uusi käyttäjä on lisätty Cuulis-oppimisympäristöön seuraavilla tiedoilla:<br><br>Etunimi: ' . $etunimi100 . '<br>Sukunimi: ' . $sukunimi100 . '<br>Ensisijainen oppilaitos: ' . $koulu100 . '<br>Rooli: ' . $rooli100 . '<br><br><em>Tähän viestiin ei voi vastata.</em>';
   if($_POST[Rooli] != 'opiskelija'){
                    $viesti3 = mail($sposti3, $otsikko3, $kysely3, $headers);
            }

    
        $stmt2->close();
        header("location: uusikayttajavahvistus.php");
    } else {

        if (!$result100 = $db->query("select sposti from kayttajat where rooli='admin'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($row = $result100->fetch_assoc()) {
            $sposti3 = $row[sposti];

            $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

            $otsikko = "Uusi käyttäjä on lisätty Cuulis-oppimisympäristöön";
            $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";
            $viesti = 'Uusi käyttäjä on lisätty Cuulis-oppimisympäristöön seuraavilla tiedoilla:<br><br>Etunimi: ' . $etunimi100 . '<br>Sukunimi: ' . $sukunimi100 . '<br>Ensisijainen oppilaitos: ' . $koulu100 . '<br>Rooli: ' . $rooli100 . '<br><br><em>Tähän viestiin ei voi vastata.</em>';

            $viesti = str_replace("\n.", "\n..", $viesti);

  if($_POST[Rooli] != 'opiskelija'){
                      $varmistus = mail($sposti3, $otsikko, $viesti, $headers); 
            }

     
        }
        $stmt2->close();
        header("location: uusikayttajavahvistus.php");
    }
}





echo "</div>";
echo "</div>";

include("footer.php");
?>
</body>
</html>	