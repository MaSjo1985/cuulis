<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Käyttäjien poisto</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

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

    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
    echo'<div class="cm8-margin-top"></div>';
    if ($_POST["valinta"] == "ei") {
        if ($_POST["minne"] == "vahvistus") {
            header("location: kayttajatvahvistus.php");
        } else {
            header("location: kayttajatkaikki.php");
        }
    } else {




        $lista = $_POST["mita"];
//        foreach ($lista as $tuote) {
//      echo'<br><br>id on: '.$tuote;      
//        }
//die();
        foreach ($lista as $tuote) {

            //kursseihin liittyvät jutut
            //keskusteluihin liittyvät tiedot



            $db->query("delete from kayttajan_tykkaykset where kayttaja_id = '" . $tuote . "'");


            $db->query("delete from keskustelut where kayttaja_id = '" . $tuote . "'");



            //kysymyksiin liittyvät tiedot


//            $db->query("delete from kysymykset where kayttaja_id = '" . $tuote . "'");

            //äänestykset


//            $db->query("delete from aanestysvastaukset where kayttaja_id = '" . $tuote . "'");
//


            // itsearvioinnit, VANHA


            $db->query("delete from itsearvioinnitkp where kayttaja_id = '" . $tuote . "'");

            //itsearvioinnit, UUSI
            $db->query("delete from iakp where kayttaja_id = '" . $tuote . "'");
            $db->query("delete from iakp_moni where kayttaja_id = '" . $tuote . "'");
            $db->query("delete from iakommentit where kayttaja_id = '" . $tuote . "'");

            //itsenäisten töiden kirjanpito



            $db->query("delete from opiskelijankirja where kayttaja_id = '" . $tuote . "'");
      
                $db->query("delete from itsetehtavatkp where kayttaja_id = '" . $tuote . "'");
            



//kurssityo-tiedostot


            if (!$haetyot = $db->query("select ryhmat2.tallennettunimi as tallennettunimi, ryhmat2.linkki as linkki, ryhmat2.id as ryid, opiskelijan_kurssityot.id as okid from opiskelijan_kurssityot, ryhmat2, projektit where opiskelijan_kurssityot.kayttaja_id = '" . $tuote . "' AND ryhmat2.projekti_id=projektit.id AND opiskelijan_kurssityot.ryhmat2_id=ryhmat2.id")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowr = $haetyot->fetch_assoc()) {

                $nimi = $rowr[tallennettunimi];
                $linkki = $rowr[linkki];
                $ryid = $rowr[ryid];
                $okid = $rowr[okid];

                if ($linkki == 1) {
                    $db->query("delete from ryhmat2 where id = '" . $ryid . "'");
                    $db->query("delete from opiskelijan_kurssityot where ryhmat2_id = '" . $ryid . "'");
                } else {
                    if (file_exists($nimi)) {
                        unlink($nimi);
                    }


                    $db->query("delete from ryhmat2 where id = '" . $ryid . "'");
                    $db->query("delete from opiskelijan_kurssityot where ryhmat2_id = '" . $ryid . "'");
                }
            }

            //sektoridiagrammit
            $pienimi = 'images/sektori' . $tuote . '.png';
            if (file_exists($pienimi)) {
                unlink($pienimi);
            }
            $pienimi = 'images/sektori2' . $tuote . '.png';
            if (file_exists($pienimi)) {
                unlink($pienimi);
            }
            $pienimi = 'images/sektori3' . $tuote . '.png';
            if (file_exists($pienimi)) {
                unlink($pienimi);
            }
            $pienimi = 'images/sektori4' . $tuote . '.png';
            if (file_exists($pienimi)) {
                unlink($pienimi);
            }

            $db->query("delete from opiskelijankurssit where opiskelija_id='" . $tuote . "'");




            if (!$tulos4 = $db->query("select distinct * from kayttajat where id='" . $tuote . "'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }

            while ($rivi2 = $tulos4->fetch_assoc()) {
                $sposti = $rivi2[sposti];
            }

            $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

            $otsikko = "Viesti Cuulis-oppimisympäristöstä";
            $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

            $viesti = 'Käyttäjäprofiilinne on poistettu Cuulis-oppimisympäristöstä.<br><br><em>Tähän viestiin ei voi vastata.</em>';
            $viesti = str_replace("\n.", "\n..", $viesti);

//
//
//            $varmistus = mail($sposti, $otsikko, $viesti, $headers);

            $db->query("delete from kayttajat where id = '" . $tuote . "'");

            $db->query("delete from kayttajankoulut where kayttaja_id = '" . $tuote . "'");
            $db->query("delete from koulunadminit where kayttaja_id = '" . $tuote . "'");



            if (!$result = $db->query("select distinct * from kayttajat where id = '" . $tuote . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row = $result->fetch_assoc()) {
                $nimi = $row[omakuva];
            }



            if (file_exists($nimi)) {
                unlink($nimi);
            }
        }

        header("location: poistakayttaja102.php?minne=" . $_POST[minne]);
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