<?php
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Käyttäjän salasana vaihdettu </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7">';
    if ($_SESSION["Rooli"] == 'admin')
        include("adminnavi.php");
    else if ($_SESSION["Rooli"] == 'admink')
        include("adminknavi.php");
    else if ($_SESSION["Rooli"] == 'opeadmin')
        include("opeadminnavi.php");
    else
        include ("opnavi.php");
    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
    echo'<div class="cm8-margin-top"></div>';





    $siivottusalasana = mysqli_real_escape_string($db, $_POST[Salasana]);
    $siivottuuusisalasana = mysqli_real_escape_string($db, $_POST[UusiSalasana]);
    $salt = "8CMr85";
    $krypattu = md5($salt . $siivottusalasana);
       $uniqid = uniqid('', true);
   $krypattu2 = md5($uniqid);

    $stmt = $db->prepare("UPDATE kayttajat SET salasana=?, tarkistuskoodi=?, yritykset=? WHERE id=?");
    $stmt->bind_param("ssii", $salasana, $koodi, $yritykset, $id);
// prepare and bind

    $salasana = $krypattu;
    $koodi = $krypattu2;
    $yritykset = 0;
    $id = $_POST["Id"];

    $stmt->execute();

    $stmt->close();

    $stmt2 = $db->prepare("SELECT DISTINCT sposti FROM kayttajat WHERE id=?");
    $stmt2->bind_param("i", $idv);
    // prepare and bind

    $idv = $_POST["Id"];

    $stmt2->execute();

    $stmt2->store_result();

    $stmt2->bind_result($column1);

    while ($stmt2->fetch()) {
        $sposti = $column1;
    }

    $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

    $otsikko = "Sinulle on luotu väliaikainen Cuulis-oppimisympäristössä";
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

    if (!$tulosa = $db->query("select distinct sposti from kayttajat where rooli='admin'")) {
        die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
    }

    while ($rowa = $tulosa->fetch_assoc()) {
        $spostia = $rowa["sposti"];
    }

    function poista_rivinvaihdot($teksti) {
        return str_replace(array("\r", "\n"), "", $teksti);
    }

    $email = poista_rivinvaihdot($spostia);

    $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";

    if (isset($_POST[rooli])) {
        $viesti = 'Cuulis-oppimisympäristön ylläpitäjä Marianne Sjöberg on luonut sinulle väliaikaisen salasanan Cuulis-oppimisympäristössä.<br><br>Pääset oppimisympäristöön suoraan <a href="https://cuulis.cm8solutions.fi/"> tästä. </a><br><br><b style="color: red">Jos et tiedä tätä uutta salasanaa, niin lähetä viesti Cuulis-oppimisympäristön ylläpitäjälle osoitteeseen marianne.sjoberg@cm8solutions.fi.</b><br><br><em>Tähän viestiin ei voi vastata.</em>';
    } else {
        if (!$haeadmin = $db->query("select distinct koulut.Nimi as nimi, kayttajat.sposti as sposti, kayttajat.etunimi as etunimi, kayttajat.sukunimi as sukunimi from koulut, koulunadminit, kayttajat where koulunadminit.koulu_id='" . $_SESSION[kouluId] . "' AND koulunadminit.kayttaja_id=kayttajat.id AND koulut.id='" . $_SESSION[kouluId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowadmin = $haeadmin->fetch_assoc()) {
            $etunimi = $rowadmin[etunimi];
            $sukunimi = $rowadmin[sukunimi];
            $spostiadmin = $rowadmin[sposti];
            $koulunimi = $rowadmin[nimi];
        }
        $viesti = 'Oppilaitoksen ' . $koulunimi . ' ylläpitäjä ' . $etunimi . ' ' . $sukunimi . ' on luonut sinulle väliaikaisen salasanan Cuulis-oppimisympäristössä.<br><br>Pääset oppimisympäristöön suoraan <a href="https://cuulis.cm8solutions.fi/"> tästä. </a><br><br><b style="color: red">Jos et tiedä tätä uutta salasanaa, niin lähetä viesti ylläpitäjälle osoitteeseen  ' . $spostiadmin . '</b><br><br><em>Tähän viestiin ei voi vastata.</em>';
    }


    $viesti = str_replace("\n.", "\n..", $viesti);

    $body = '<html><body>';


    $body .= '<p>' . $viesti . '</p>';
    $body .= '<img style="margin-top: 40px" src="http://cuulis.cm8solutions.fi/images/cuulis_email.png"  /><br/>';
    $body .= "</body></html>";


    $varmistus = mail($sposti, $otsikko, $body, $headers);


    $stmt2->close();

    echo('<br>Käyttäjän salasana on vaihdettu. <br><br><a href="kayttaja.php?url=' . $url . '&ka=' . $_POST["Id"] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>');

    echo'</div>';

    echo'</div>';
    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}
?>
</body>
</html>		
