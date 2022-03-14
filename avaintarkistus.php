<?php
session_start(); 



ob_start();


echo'<!DOCTYPE html>
    <html>

    <head>

        <meta charset="UTF-8">

        <title> Kirjautuminen kurssille/opintojaksolle</title>

    </head>

    <body>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if (!$tulosK = $db->query("select distinct koulu_id from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
        die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
    }
    while ($rowK = $tulosK->fetch_assoc()) {
        $kouluid = $rowK[koulu_id];
    }
    if (!$haeonko = $db->query("select distinct id from opiskelijankurssit where opiskelija_id='" . $_SESSION["Id"] . "' AND kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($haeonko->num_rows == 0) {
        $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id) values('" . $_SESSION["Id"] . "', '" . $_SESSION["KurssiId"] . "', '" . $kouluid . "')");

        if ($_SESSION["Rooli"] == 'opiskelija') {
            if (!$tulosP = $db->query("select distinct * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }
            if ($tulosP->num_rows != 0) {
                while ($rowP = $tulosP->fetch_assoc()) {
                    $id = $rowP[id];
                    $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id, projekti_id) values('" . $_SESSION["Id"] . "', '" . $_SESSION["KurssiId"] . "', '" . $kouluid . "', '" . $id . "')");
                }
            }
            if (!$tulosIP = $db->query("select distinct * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }
            if ($tulosIP->num_rows != 0) {
                while ($rowIP = $tulosIP->fetch_assoc()) {
                    $id = $rowIP[id];
                    $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id, itseprojekti_id) values('" . $_SESSION["Id"] . "', '" . $_SESSION["KurssiId"] . "', '" . $kouluid . "', '" . $id . "')");


                    if (!$tulosIPtehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $id . "'")) {
                        die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                    }

                    if ($tulosIPtehtavat->num_rows != 0) {
                        while ($rowIPt = $tulosIPtehtavat->fetch_assoc()) {

                            $db->query("insert itsetehtavatkp (kayttaja_id, itsetehtavat_id) values('" . $_SESSION["Id"] . "', '" . $rowIPt[id] . "')");
                        }
                    }
                }
            }


            //itsearvioinnit VANHA
            if (!$tulosIA = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }

            //itsearviointi on luotu VANHA
            if ($tulosIA->num_rows != 0) {
                while ($rowIA = $tulosIA->fetch_assoc()) {
                    $ida = $rowIA[id];
                    if ($rowIA[aihe] == 0)
                        $db->query("insert itsearvioinnitkp (kayttaja_id, itsearvioinnit_id) values('" . $_SESSION["Id"] . "', '" . $ida . "')");
                }
            }
            //itsearvioinnit 
            if (!$tulosias = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }


            while ($rowias = $tulosias->fetch_assoc()) {
                $jarjestys = $rowias[jarjestys];

                if (!$tulosia = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $jarjestys . "' AND onvastaus=1")) {
                    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                }
                while ($rowia = $tulosia->fetch_assoc()) {
                    $ida = $rowia[id];
                    $db->query("insert iakp (kayttaja_id, ia_id) values('" . $_SESSION["Id"] . "', '" . $ida . "')");
                }
            }

            //kysely
            if (!$tuloskys = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }

            //kysely on luotu
            if ($tuloskys->num_rows != 0) {
                while ($rowkys = $tuloskys->fetch_assoc()) {
                    $idk = $rowkys[id];
                    if ($rowkys[aihe] == 0)
                        $db->query("insert kyselytkp (kayttaja_id, kyselyt_id) values('" . $_SESSION["Id"] . "', '" . $idk . "')");
                }
            }
        }
    }
    echo'a';

    header('location: kurssi.php?id=' . $_SESSION[KurssiId]);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo'</body>

</html>	';
?>