<?php
session_start();
ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Opiskelijan itsearviointi</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("kurssisivustonheader.php");
        include "libchart/libchart/classes/libchart.php";



        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';


        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a>
          <a href="itsearviointi.php"  class="currentLink" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {

            $kysakt = $rowa[kysakt];
        }
        if ($kysakt == 1) {
            
        } else {
            // echo'<a  href="kysymyksetkommentit.php">Kysy/kommentoi</a>';
        }


        echo'
	  <a href="keskustelut.php" >Keskustele</a> 
	  <a href="osallistujat.php"   >Osallistujat</a>  	  
	   <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
	</nav>';




        echo'

<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>';


        echo'<div class="cm8-container3" style="padding-top: 30px">';


        if (!$haeopiskelija = $db->query("select distinct * from kayttajat where id='" . $_GET[kaid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        while ($rowO = $haeopiskelija->fetch_assoc()) {
            $kaid = $rowO[id];
            $etunimi = $rowO[etunimi];
            $sukunimi = $rowO[sukunimi];
        }


        echo'<p style="font-size: 1.2em; color: #2b6777; margin: 10px"><b>Opiskelijan ' . $etunimi . ' ' . $sukunimi . ' itsearviointi</b></p>';
        echo'<a href="tarkasteleiat.php" style="font-size: 0.8em"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';

        //ONKO EKA 

        $onkoeka = 0;

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $kaytylapi = 0;
        while ($row = $result->fetch_assoc()) {
            $kaytylapi++;
            if ($row[kaid] == $_GET[kaid] && $kaytylapi == 1) {
                $onkoeka = 1;
            }
        }

        //ONKO VIKA
        $onkovika = 0;
        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $yhteensa = $result->num_rows;
        $kaytylapi = 0;
        while ($row = $result->fetch_assoc()) {
            $kaytylapi++;
            if ($row[kaid] == $_GET[kaid] && $kaytylapi == $yhteensa) {
                $onkovika = 1;
            }
        }



        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $seuraavaloyty = 0;

        while ($row = $result->fetch_assoc()) {



            if ($seuraavaloyty == 1) {
                echo'<br><br><br><a href="tarkasteleopiskelijaia.php?kaid=' . $row[kaid] . '"  class="cm8-navigointilinkki">Katso seuraava -> </a>';

                break;
            } else {
                $haettuid = $row[kaid];

                if ($haettuid == $_GET[kaid]) {

                    $seuraavaloyty = 1;
                }
            }
        }


        if ($onkovika == 1) {


            if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $kaytylapi = 0;
            while ($row = $result->fetch_assoc()) {
                $kaytylapi++;
                if ($kaytylapi == 1) {
                    echo'<br><br><br><a href="tarkasteleopiskelijaia.php?kaid=' . $row[kaid] . '"  class="cm8-navigointilinkki">Katso seuraava -> </a>';
                }
            }
        }

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $maara = 0;

        while ($row = $result->fetch_assoc()) {

            $maara++;

            $haettuid = $row[kaid];

            if ($haettuid == $_GET[kaid]) {

                break;
            }
        }

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        $oikeamaara = $maara - 1;

        $maara = 0;

        while ($row = $result->fetch_assoc()) {
            $maara++;

            if ($maara == $oikeamaara) {
                echo'<br><br><a href="tarkasteleopiskelijaia.php?kaid=' . $row[kaid] . '" class="cm8-navigointilinkki"><- Katso edellinen</a>';

                break;
            }
        }

        if ($onkoeka == 1) {

            if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $yhteensa = $result->num_rows;
            $kaytylapi = 0;
            while ($row = $result->fetch_assoc()) {
                $kaytylapi++;

                if ($kaytylapi == $yhteensa) {
                    echo'<br><br><a href="tarkasteleopiskelijaia.php?kaid=' . $row[kaid] . '"  class="cm8-navigointilinkki"><- Katso edellinen</a>';
                }
            }
        }






        echo'<div class="cm8-responsive" style="overflow-y: hidden">';

        if (!$haeonko = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeonko->num_rows != 0) {
            //            if (($nyt <= $takaraja && $takarajaon == 1) || $takarajaon == 0) {
//            }
            echo'<div class="cm8-margin-top"><br></div>';

            if (!$haesarakkeet = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $nyt = date("Y-m-d H:i");


            $onko = $haeonko->num_rows;

            $smaara = $haesarakkeet->num_rows;

            if ($smaara == 1) {
                $divleveys = 50;
            } else {
                $divleveys = 100 / $smaara;
            }

            while ($rows = $haesarakkeet->fetch_assoc()) {

                $smaara--;
                $sid = $rows[jarjestys];
                $sulkeutuu = $rows[sulkeutuu];

                $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
                $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
                $sulkeutumiskello = substr($sulkeutuu, 11, 5);

                $avautuu = $rows[avautuu];

                $avautumispaiva = substr($avautuu, 0, 10);
                $avautumispaiva = date("d.m.Y", strtotime($avautumispaiva));
                $avautumiskello = substr($avautuu, 11, 5);


                echo'<div class="cm8-responsive" style="vertical-align: top; margin: 0px; padding:0px; width:' . $divleveys . '%; display: inline-block">';

                if (!$haetehtavat = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $sid . "' ORDER BY jarjestys")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $onko = $haetehtavat->num_rows;


                if ($avautuu != NULL) {

                    if ($avautuu > $nyt) {
                        echo'<p style="font-size: 0.7em; color:#e608b8; font-weight: bold">Tämä osio avautuu ';
                    } else {
                        echo'<p style="font-size: 0.7em; color:  #e608b8; font-weight: bold">Tämä osio on avautunut ';
                    }

                    echo'&nbsp&nbsp&nbsp' . $avautumispaiva . ' klo ' . $avautumiskello . '</p>';
                } else {
                    echo'<p style="font-size: 0.7em; font-weight: bold">&nbsp&nbsp&nbsp</p>';
                }

                if ($sulkeutuu != NULL) {

                    if ($sulkeutuu > $nyt) {
                        echo'<p style="font-size: 0.7em; color:#e608b8; font-weight: bold">Tämä osio sulkeutuu ';
                    } else {
                        echo'<p style="font-size: 0.7em; color:#e608b8; font-weight: bold">Tämä osio on sulkeutunut ';
                    }

                    echo'&nbsp&nbsp&nbsp' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</p>';
                } else {
                    echo'<p style="font-size: 0.7em;  font-weight: bold">&nbsp&nbsp&nbsp</p>';
                }


                echo '<table id="mytable2" class="cm8-uusitableiauusi" style="margin-bottom: 10px; width: 100%" ><thead>';

                echo '</thead><tbody>';
                while ($rowt = $haetehtavat->fetch_assoc()) {

                    if (!$haekp = $db->query("select distinct * from iakp where ia_id='" . $rowt[id] . "' AND kayttaja_id='" . $_GET[kaid] . "'"
                            . " AND id IN (select MIN(id) from iakp where ia_id='" . $rowt[id] . "' AND kayttaja_id='" . $_GET[kaid] . "')")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    if ($rowt[onotsikko] == 1) {

                        echo '<tr class="iaihe2"><td>' . $rowt[otsikko] . '</td></tr>';
                    } else if ($rowt[onvastaus] == 1) {

                        while ($rowkp = $haekp->fetch_assoc()) {
                            $tallennettu = 0;
                            if ($rowkp[tallennettu] == 1 || ($sulkeutuu != NULL && $sulkeutuu <= $nyt) || ($avautuu != NULL && $avautuu > $nyt)) {
                                $tallennettu = 1;
                                if ($rowt[onteksti] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" " class="ivaliaihe2"><td>' . $rowkp[teksti] . '</td></tr>';
                                    $rowkp[teksti] = str_replace('<br />', "", $rowkp[teksti]);
                                    echo'<input type="hidden" name="teksti[]" value=' . $rowkp[teksti] . '>';
                                    echo'<input type="hidden" name="valinta[]" value="0">';
                                    echo'<input type="hidden" name="valinta2[]" value="0">';
                                    echo'<input type="hidden" name="idt[]" value=' . $rowkp[ia_id] . '>';
                                } else if ($rowt[onradio] == 1) {

                                    if (!$haer = $db->query("select distinct * from iavaihtoehdot where ia_id='" . $rowt[id] . "'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }

//        

                                    echo '<tr class="ivaliaihe2"><td>';
                                    $valittu == 0;
                                    while ($rowr = $haer->fetch_assoc()) {

                                        $rowr[vaihtoehto] = str_replace('<br />', "", $rowr[vaihtoehto]);
                                        if ($rowkp[iavaihtoehdot_id] == $rowr[id]) {
                                            $valittu == 1;
                                            echo'<p style="font-weight: bold" class="myButtonValittu">' . $rowr[vaihtoehto] . '</p>';
                                        } else {
                                            echo'<p style="font-size: 0.8em; font-weight: normal">' . $rowr[vaihtoehto] . '</p>';
                                        }
                                    }
                                    if ($valittu == 0) {
                                        echo'<p style="font-weight: bold" class="myButtonValittu">Ei valintaa.</p>';
                                    }
                                    echo'</td></tr>';
                                    //tarviiko tekstitki?
                                    echo'<input type="hidden" name="idt[]" value=' . $rowkp[ia_id] . '>';
                                    echo'<input type="hidden" name="teksti[]" value="0">';
                                    echo'<input type="hidden" name="valinta[]" value="0">';
                                    echo'<input type="hidden" name="valinta2[]" value="0">';
                                } else if ($rowt[oncheckbox] == 1) {



                                    if (!$haer = $db->query("select distinct * from iavaihtoehdot where ia_id='" . $rowt[id] . "'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }

//        

                                    echo '<tr class="ivaliaihe2"><td>';
                                    $valittu2 = 0;
                                    while ($rowr = $haer->fetch_assoc()) {

                                        $rowr[vaihtoehto] = str_replace('<br />', "", $rowr[vaihtoehto]);
                                        if (!$haekpmoni = $db->query("select distinct * from iakp_moni where iavaihtoehdot_id= '" . $rowr[id] . "' AND kayttaja_id='" . $_GET[kaid] . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        if ($haekpmoni->num_rows != 0) {
                                            $valittu2 = 1;
                                            echo'<p style="font-weight: bold; " class="myButtonValittu">' . $rowr[vaihtoehto] . '</p><br>';
                                        } else {
                                            echo'<p style="font-size: 0.8em; font-weight: normal">' . $rowr[vaihtoehto] . '</p>';
                                        }
                                    }
                                    if ($valittu2 == 0) {
                                        echo'<p style="font-weight: bold" class="myButtonValittu">Ei valintaa.</p>';
                                    }

                                    echo'</td></tr>';
                                    //tarviiko tekstitki?
                                    echo'<input type="hidden" name="idt[]" value=' . $rowkp[ia_id] . '>';
                                    echo'<input type="hidden" name="teksti[]" value="0">';
                                    echo'<input type="hidden" name="valinta[]" value="0">';
                                    echo'<input type="hidden" name="valinta2[]" value="0">';
                                }
                            } else {

                                $rowkp[teksti] = str_replace('<br />', "", $rowkp[teksti]);
                                if ($rowt[onteksti] == 1) {
                                    echo '<tr id="' . $rowt[id] . '"  class="osisalto"><td><textarea name="teksti[]" cols="50" rows="4" style="font-size: 1em">' . $rowkp[teksti] . '</textarea></td></tr>';
                                    echo'<input type="hidden" name="valinta' . $rowt[id] . '" value="0">';

                                    echo'<input type="hidden" name="idt[]" value=' . $rowkp[ia_id] . '>';
                                } else if ($rowt[onradio] == 1) {


                                    if (!$haer = $db->query("select distinct * from iavaihtoehdot where ia_id='" . $rowt[id] . "'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }

//        

                                    echo '<tr class="osisalto"><td>';
                                    while ($rowr = $haer->fetch_assoc()) {
                                        $rowr[vaihtoehto] = str_replace('<br />', "", $rowr[vaihtoehto]);
                                        if ($rowkp[iavaihtoehdot_id] == $rowr[id]) {
                                            echo'<p><input type="radio" name="valinta' . $rowt[id] . '"  style="margin-right: 10px" value=' . $rowr[id] . ' checked>&nbsp&nbsp&nbsp' . $rowr[vaihtoehto] . '</p>';
                                        } else {
                                            echo'<p><input type="radio" name="valinta' . $rowt[id] . '" style="margin-right: 10px" value=' . $rowr[id] . '>&nbsp&nbsp&nbsp' . $rowr[vaihtoehto] . '</p>';
                                        }
                                    }

                                    echo'</td></tr>';
                                    //tarviiko tekstitki?
                                    echo'<input type="hidden" name="idt[]" value=' . $rowkp[ia_id] . '>';
                                    echo'<input type="hidden" name="teksti[]" value="0">';
                                } else if ($rowt[oncheckbox] == 1) {
                                    if (!$haer = $db->query("select distinct * from iavaihtoehdot where ia_id='" . $rowt[id] . "'")) {
                                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                    }
                                    $vaihtoehtoja = $haer->num_rows;
//        
                                    echo '<tr class="osisalto"><td>';
                                    while ($rowr = $haer->fetch_assoc()) {
                                        $rowr[vaihtoehto] = str_replace('<br />', "", $rowr[vaihtoehto]);

                                        if (!$haekpmoni = $db->query("select distinct * from iakp_moni where iavaihtoehdot_id= '" . $rowr[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        if ($haekpmoni->num_rows != 0) {
                                            echo'<p><input type="checkbox" name="valinta2' . $rowt[id] . '[]" style="margin-right: 10px" value=' . $rowr[id] . ' checked>&nbsp&nbsp&nbsp' . $rowr[vaihtoehto] . '</p>';
                                        } else {
                                            echo'<p><input type="checkbox" name="valinta2' . $rowt[id] . '[]" style="margin-right: 10px" value=' . $rowr[id] . '>&nbsp&nbsp&nbsp' . $rowr[vaihtoehto] . '</p>';
                                        }
                                    }

                                    echo'</td></tr>';
                                    //tarviiko tekstitki?
                                    echo'<input type="hidden" name="idt[]" value=' . $rowkp[ia_id] . '>';
                                    echo'<input type="hidden" name="teksti[]" value="0">';
                                    echo'<input type="hidden" name="valinta' . $rowt[id] . '" value="0">';
                                }
                            }
                        }
                    }
                }
                echo "</tbody></table>";
                //            if (($nyt <= $takaraja && $takarajaon == 1) || $takarajaon == 0) {
//            }
                
                $tallennettu = 0;
                $kommentti = '';
                if (!$haekommentti = $db->query("select distinct * from iakommentit where ia_sarakkeet_jarjestys = '" . $rows[jarjestys] . "' AND kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttaja_id='" . $_GET[kaid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowkom = $haekommentti->fetch_assoc()) {
                    $kommentti = $rowkom[kommentti];
                    $tallennettu = $rowkom[tallennettu];
                }

                echo'<form action="tallennaiatope.php" method="post" style="text-align: center" >';

                echo'<input type="hidden" name="jarjestys" value=' . $rows[jarjestys] . '>';
                echo'<input type="hidden" name="kaid" value=' . $_GET[kaid] . '>';
                if ($tallennettu == 0) {
                    $kommentti = str_replace('<br />', "", $kommentti);
                    echo'<p style="font-weight: bold; color:  #48E5DA; font-size: 0.8em; margin-bottom: 5px">Kommentoi tätä saraketta: </p>';
                    echo'<textarea style="width: 80%;padding: 6px; border: 2px solid  #48E5DA; border-radius: 10px; color: #2b6777;" rows="10"  name="kommentti">' . $kommentti . '</textarea><br>';
                    echo'<input type="submit" name="painiket" class="myButton8" value="&#10003 Tallenna" title="Tallenna" id="tuutanne" style="font-size: 0.7em; padding: 2px 4px">';
                } else {
                    echo'<p style="font-weight: bold; color:  #48E5DA; font-size: 0.8em; margin-bottom: 5px">Kommenttisi tästä sarakkeesta: </p>';
                    echo'<div style="text-align: left;  margin-bottom: 5px;padding: 0px; display: inline-block; width: 80%" >';
                    echo'<p style="margin: 0px;padding: 0px; font-weight: bold; font-size: 0.7em; padding: 10px; border: 2px solid  #48E5DA; border-radius: 10px; color: #2b6777; background-color: white">' . $kommentti . '</p>';
                    echo'</div>';
                    echo'<br><input type="submit" name="painikem" class="myButton8" value="&#9998 Muokkaa" title="Muokkaa" id="tuutanne" style="font-size: 0.7em; padding: 2px 4px; background-color: #00FF00;">';
                }

                echo'</form>';
                echo'</div>';
            }

            echo'</div>';
            if ($haesarakkeet->num_rows == 1) {
                ?>



                <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
                <script>
                    var $table = $('#mytable2');

                    $table.floatThead({zIndex: 1});

                </script>        
                <?php
session_start();
                ob_start();
            }
        } else {
            echo'<div class="cm8-margin-top"><br>';
            echo '<table id="mytable" class="cm8-uusitableia" style="width:50%"><thead><th style="text-align:center">Sisältö</th></thead><tbody>';

            echo '</tbody></table>';
            echo'</div>';
        }
  if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $seuraavaloyty = 0;

        while ($row = $result->fetch_assoc()) {



            if ($seuraavaloyty == 1) {
                echo'<br><br><br><a href="tarkasteleopiskelijaia.php?kaid=' . $row[kaid] . '"  class="cm8-navigointilinkki">Katso seuraava -> </a>';

                break;
            } else {
                $haettuid = $row[kaid];

                if ($haettuid == $_GET[kaid]) {

                    $seuraavaloyty = 1;
                }
            }
        }


        if ($onkovika == 1) {


            if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $kaytylapi = 0;
            while ($row = $result->fetch_assoc()) {
                $kaytylapi++;
                if ($kaytylapi == 1) {
                    echo'<br><br><br><a href="tarkasteleopiskelijaia.php?kaid=' . $row[kaid] . '"  class="cm8-navigointilinkki">Katso seuraava -> </a>';
                }
            }
        }

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $maara = 0;

        while ($row = $result->fetch_assoc()) {

            $maara++;

            $haettuid = $row[kaid];

            if ($haettuid == $_GET[kaid]) {

                break;
            }
        }

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        $oikeamaara = $maara - 1;

        $maara = 0;

        while ($row = $result->fetch_assoc()) {
            $maara++;

            if ($maara == $oikeamaara) {
                echo'<br><br><a href="tarkasteleopiskelijaia.php?kaid=' . $row[kaid] . '" class="cm8-navigointilinkki"><- Katso edellinen</a>';

                break;
            }
        }

        if ($onkoeka == 1) {
            
            if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $yhteensa = $result->num_rows;
            $kaytylapi = 0;
            while ($row = $result->fetch_assoc()) {
                $kaytylapi++;

                if ($kaytylapi == $yhteensa) {
                    echo'<br><br><a href="tarkasteleopiskelijaia.php?kaid=' . $row[kaid] . '"  class="cm8-navigointilinkki"><- Katso edellinen</a>';
                }
            }
        }
        
        
        echo'<br><br><br><br><a href="tarkasteleiat.php" style="font-size: 1em"><p style="font-size: 1.2em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';

        echo'</div>';
        echo'</div>';





        echo'</div>';
    } else {
        header("location: etusivu.php");
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



include("footer.php");
?>

</body>
</html>										