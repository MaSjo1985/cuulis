<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Lisääkurssi/opintojakso</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7">';
    if ($_SESSION["Rooli"] == 'opettaja') {
        include("opnavi.php");
    }
    if ($_SESSION["Rooli"] == 'opeadmin') {
        include("opeadminnavi.php");
    }

    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"></div>';

    $nextYear = time() + (7 * 24 * 60 * 60 * 52);
    // 7 days; 24 hours; 60 mins; 60 secs
    // 1 year= 52 * weeks
    $poisto = date('Y-m-d', strtotime('+1 years'));

    if (!empty($_POST[AlkuPvm])) {
        $originalDate = $_POST[AlkuPvm];
        $newDate = date("Y-m-d", strtotime($originalDate));
    } else {
        $newDate = date("Y-m-d");
    }
    if (!empty($_POST[LoppuPvm])) {
        $originalDate2 = $_POST[LoppuPvm];
        $newDate2 = date("Y-m-d", strtotime($originalDate2));
    } else {

        $newDate2 = date('Y-m-d', strtotime($newDate . ' + 365 day'));
    }




// prepare and bind
    $stmt = $db->prepare("INSERT INTO kurssit (nimi, koodi, avain, opettaja_id, koulu_id, lukuvuosi, alkupvm, loppupvm, koepvm, koeaika, sallicd, muutopet, poistopvm) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiisssssiis", $nimi, $koodi, $avain, $ope, $koulu, $lukuvuosi, $alkupvm, $loppupvm, $koepvm, $koeaika, $sallicd, $muutopet, $poistopvm);
    $nimi = $_POST[KurssiNimi];
    $koodi = $_POST[KurssiKoodi];
    $avain = $_POST[Avain];
    $ope = $_POST[opeid];
    $koulu = $_POST[kouluid];

    $lukuvuosialku = $_POST[lukuvuosialku];
    $lukuvuosiloppu = $_POST[lukuvuosiloppu];
    $lukuvuosi = $lukuvuosialku . '-' . $lukuvuosiloppu;


    $alkupvm = $newDate;
    $loppupvm = $newDate2;
    $koepvm = $_POST[koepvm];
    $koeaika = $_POST[koeaika];
    if ($_POST["MuutOpet"] == "ei") {
        if (isset($_POST['sallicd'])) {
            $sallicd = 1;
            $muutopet = 0;
            $poistopvm = $poisto;
        } else {
            $sallicd = 0;
            $muutopet = 0;
            $poistopvm = $poisto;
        }
        $stmt->execute();
        $stmt->close();
        header("location: lisaakurssi2.php?muut=ei");
    } else {

        if (isset($_POST['sallicd'])) {
            $sallicd = 1;
            $muutopet = 1;
            $poistopvm = $poisto;
        } else {
            $sallicd = 0;
            $muutopet = 1;
            $poistopvm = $poisto;
        }

        $stmt->execute();
        $stmt->close();
        header("location: lisaakurssi2.php?muut=joo");
    }


    echo'</div>';
    echo'</div>';

    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>
</body>
</html>		
</html>	

