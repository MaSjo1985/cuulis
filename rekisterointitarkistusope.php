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


$siivottusposti = mysqli_real_escape_string($db, $_POST[Sposti]);
$siivottuetunimi = mysqli_real_escape_string($db, $_POST[Etunimi]);
$siivottusukunimi = mysqli_real_escape_string($db, $_POST[Sukunimi]);
$siivottusposti = trim($siivottusposti);
$siivottusposti=strtolower($siivottusposti);
// $siivottusalasana=mysqli_real_escape_string($db, $_POST[Salasana]);
// $siivottuuusisalasana=mysqli_real_escape_string($db, $_POST[UusiSalasana]);
 $_POST[Rooli]='opettaja';
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
    $tarkistettu = 0;
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

    $otsikko = "Rekisteröityminen Cuulis-oppimisympäristöön";
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";


    $viesti = 'Olet rekisteröitynyt Cuulis-oppimisympäristöön seuraavilla tiedoilla:<br><br>Etunimi: ' . $etunimi100 . '<br>Sukunimi: ' . $sukunimi100 . '<br>Ensisijainen oppilaitos: ' . $koulu100 . '<br>Rooli: ' . $rooli100 . '<br><br><b>Oppimisympäristön ylläpitäjän on vielä vahvistettava rekisteröitymisesi, minkä jälkeen saat vahvistuslinkin tähän sähköpostiosoitteeseen.</b><br><br><em>Tähän viestiin ei voi vastata.</em>';
    $viesti = str_replace("\n.", "\n..", $viesti);

    $body = '<html><body>';


    $body .= '<p>' . $viesti . '</p>';
    $body .= "</body></html>";


    $varmistus = mail($siivottusposti, $otsikko, $body, $headers);

    $db->query("insert into kayttajankoulut  (kayttaja_id, koulu_id, odottaa) values ('" . $id . "', '" . $_POST[koulu] . "', 1)");

    if (!$haekoulu = $db->query("select distinct Nimi from koulut where id='" . $_POST[koulu] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowkoulu = $haekoulu->fetch_assoc()) {
        $koulunimi = $rowkoulu[Nimi];
    }

    if (!$result = $db->query("select kayttajat.sposti as sposti from koulunadminit, kayttajat where koulunadminit.koulu_id='" . $_POST[koulu] . "' AND koulunadminit.kayttaja_id=kayttajat.id")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($result->num_rows != 0) {

        while ($row = $result->fetch_assoc()) {
            $sposti2 = $row[sposti];



            $otsikko2 = "Uuden opettajan rekisteröityminen vaatii vahvistustasi";
            $otsikko2 = "=?UTF-8?B?" . base64_encode($otsikko2) . "?=";


            $viesti2 = 'Uusi opettaja on rekisteröitynyt Cuulis-oppimisympäristöön ylläpitämääsi oppilaitokseen ' . $koulunimi . ' seuraavilla tiedoilla: <br><br>Etunimi: ' . $siivottuetunimi . '<br>Sukunimi: '.$siivottusukunimi.'<br>Käyttäjätunnus eli sähköpostiosoite: ' . $siivottusposti . '<br><br><b>Sinun on vielä vahvistettava tämä. Pääset suorittamaan vahvistuksen suoraan <a href="https://cuulis.cm8solutions.fi/kayttajatvahvistus.php"> tästä. </a></b><br><br><em>Tähän viestiin ei voi vastata.</em>';

            $viesti2 = str_replace("\n.", "\n..", $viesti2);

            $body = '<html><body>';


            $body .= '<p>' . $viesti2 . '</p>';
            $body .= "</body></html>";


            $varmistus2 = mail($sposti2, $otsikko2, $body, $headers);
        }

        if (!$tulos3 = $db->query("select distinct sposti from kayttajat where rooli='admin'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }

        while ($row3 = $tulos3->fetch_assoc()) {
            $sposti3 = $row3["sposti"];
        }

        $otsikko3 = "Uuden käyttäjän rekisteröityminen odottaa oppilaitoksen ylläpitäjän vahvistusta";
        $otsikko3 = "=?UTF-8?B?" . base64_encode($otsikko3) . "?=";
        $kysely3 = 'Cuulis-oppimisympäristöön on rekisteröitynyt uusi käyttäjä roolissa ' . $_POST[Rooli] . ' oppilaitokseen ' . $koulunimi . '<br><br>Käyttäjän nimi: ' . $kokonimi . '<br><br>Käyttäjän sähköpostiosoite: ' . $siivottusposti . '. <br><br><b>Liittyminen odottaa oppilaitoksen ylläpitäjän vahvistusta.</b><br><br><em>Tähän viestiin ei voi vastata.</em>';

        $viesti2 = str_replace("\n.", "\n..", $kysely3);

        $body = '<html><body>';


        $body .= '<p>' . $kysely3 . '</p>';
        $body .= "</body></html>";
    $viesti3 = mail($sposti3, $otsikko3, $body, $headers);
        $stmt2->close();

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

            $otsikko = "Uuden käyttäjän rekisteröityminen vaatii vahvistustasi";
            $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";



             $viesti = 'Uusi opettaja on rekisteröitynyt Cuulis-oppimisympäristöön oppilaitokseen ' . $koulunimi . ' seuraavilla tiedoilla: <br><br>Etunimi: ' . $siivottuetunimi . '<br>Sukunimi: '.$siivottusukunimi.'<br>Käyttäjätunnus eli sähköpostiosoite: ' . $siivottusposti . '<br><br><b>Sinun on vielä vahvistettava tämä. Pääset suorittamaan vahvistuksen suoraan <a href="https://cuulis.cm8solutions.fi/kayttajatvahvistus.php"> tästä. </a></b><br><br><em>Tähän viestiin ei voi vastata.</em>';



            $viesti = str_replace("\n.", "\n..", $viesti);

            $body = '<html><body>';


            $body .= '<p>' . $viesti . '</p>';
            $body .= "</body></html>";

            $varmistus = mail($sposti3, $otsikko, $viesti, $headers);
        }
        $stmt2->close();
      
    }


  header('location: rekisterointisuoritettu2.php?id='.$id);



echo "</div>";
echo "</div>";

include("footer.php");
?>
</body>
</html>	