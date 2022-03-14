<?php session_start(); 


ob_start();



echo'<!DOCTYPE html><html> 
<head>
<title>  ' . $_SESSION[Koodi] . ' ' . $_SESSION[KurssiNimi] . ' </title>';

echo'<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
<link rel="shortcut icon" href="favicon.png" type="image/png" />';
include("yhteys.php");


if (isset($_SESSION["Kayttajatunnus"])) {
    //tarkistetaan avaimet

    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "opeadmin" || $_SESSION["Rooli"] == "admink" || ($_SESSION[Rooli] == "opiskelija" && $_SESSION[vaihto] == 1)) {

        if (!$tulosAvain = $db->query("select * from kurssit where id='" . $_GET[id] . "' AND opettaja_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$tulosAvain2 = $db->query("select * from opiskelijankurssit where kurssi_id='" . $_GET[id] . "' AND opiskelija_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        if (!$onkoadmin = $db->query("select distinct * from koulunadminit where koulunadminit.koulu_id='" . $_SESSION[kouluId] . "' AND koulunadminit.kayttaja_id='" . $_SESSION[Id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if ($tulosAvain->num_rows == 0 && $tulosAvain2->num_rows == 0 && $onkoadmin->num_rows == 0) {
            header("location: avain.php?id=" . $_GET[id]);
        } else {
            if (!$tulos2 = $db->query("select * from kurssit where id='" . $_GET["id"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($tulos2->num_rows == 1) {
                while ($rivi2 = $tulos2->fetch_assoc()) {
                    $nimi = $rivi2[nimi];
                    $kouluid = $rivi2[koulu_id];
                    $koodi = $rivi2[koodi];
                    $avain = $rivi2[avain];
                    $id = $rivi2[id];
                    $ope = $rivi2[opettaja_id];
                    $lukuvuosi = $rivi2[lukuvuosi];
                    $alkupvm = $rivi2[alkupvm];
                    $loppupvm = $rivi2[loppupvm];
                    $sallicd = $rivi2[sallicd];
                    $koepvm = $rivi2[koepvm];
                    $koeaika = $rivi2[koeaika];
                    $muutopet = $rivi2[muutopet];
                }
                $_SESSION["KurssiNimi"] = $nimi;
                $_SESSION["kouluId"] = $kouluid;
                $_SESSION["Koodi"] = $koodi;
                $_SESSION["OpeId"] = $ope;
                $_SESSION["Avain"] = $avain;
                $_SESSION["Lukuvuosi"] = $lukuvuosi;
                $_SESSION["Alkupvm"] = $alkupvm;
                $_SESSION["Loppupvm"] = $loppupvm;
                if ($koepvm != '') {
                    $_SESSION["Koepvm"] = $koepvm;
                }


                $_SESSION["Koeaika"] = $koeaika;
                if ($_SESSION["Koeaika"] == '') {
                    $_SESSION["Koeaika"] = "09:00";
                }

                $_SESSION["Sallicd"] = $sallicd;
                $_SESSION["Muutopet"] = $muutopet;
                $_SESSION["KurssiId"] = $id;
            }
        }
    } else if ($_SESSION["Rooli"] == "opiskelija") {

        if (!$tulosAvain = $db->query("select * from opiskelijankurssit where kurssi_id='" . $_GET[id] . "' AND opiskelija_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($tulosAvain->num_rows == 0) {
            header("location: avain.php?id=" . $_GET[id]);
        } else {
            if (!$tulos2 = $db->query("select * from kurssit where id='" . $_GET["id"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($tulos2->num_rows == 1) {
                while ($rivi2 = $tulos2->fetch_assoc()) {
                    $nimi = $rivi2[nimi];
                    $kouluid = $rivi2[koulu_id];
                    $koodi = $rivi2[koodi];
                    $avain = $rivi2[avain];
                    $id = $rivi2[id];
                    $ope = $rivi2[opettaja_id];
                    $lukuvuosi = $rivi2[lukuvuosi];
                    $alkupvm = $rivi2[alkupvm];
                    $loppupvm = $rivi2[loppupvm];
                    $sallicd = $rivi2[sallicd];
                    $koepvm = $rivi2[koepvm];
                    $koeaika = $rivi2[koeaika];
                    $muutopet = $rivi2[muutopet];
                }
                $_SESSION["OpeId"] = $ope;
                $_SESSION["KurssiNimi"] = $nimi;
                $_SESSION["kouluId"] = $kouluid;
                $_SESSION["Koodi"] = $koodi;
                $_SESSION["Avain"] = $avain;
                $_SESSION["Lukuvuosi"] = $lukuvuosi;
                $_SESSION["Alkupvm"] = $alkupvm;
                $_SESSION["Loppupvm"] = $loppupvm;
                if ($koepvm != '') {
                    $_SESSION["Koepvm"] = $koepvm;
                }


                $_SESSION["Koeaika"] = $koeaika;
                if ($_SESSION["Koeaika"] == '') {
                    $_SESSION["Koeaika"] = "09:00";
                }

                $_SESSION["Sallicd"] = $sallicd;
                $_SESSION["Muutopet"] = $muutopet;
                $_SESSION["KurssiId"] = $id;
            }
        }
    } else if ($_SESSION[Rooli] == admin) {
        if (!$tulos2 = $db->query("select * from kurssit where id='" . $_GET["id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($tulos2->num_rows == 1) {
            while ($rivi2 = $tulos2->fetch_assoc()) {
                $nimi = $rivi2[nimi];
                $kouluid = $rivi2[koulu_id];
                $koodi = $rivi2[koodi];
                $avain = $rivi2[avain];
                $id = $rivi2[id];

                $lukuvuosi = $rivi2[lukuvuosi];
                $alkupvm = $rivi2[alkupvm];
                $loppupvm = $rivi2[loppupvm];
                $sallicd = $rivi2[sallicd];
                $koepvm = $rivi2[koepvm];
                $koeaika = $rivi2[koeaika];
                $muutopet = $rivi2[muutopet];
            }
            $_SESSION["KurssiNimi"] = $nimi;
            $_SESSION["kouluId"] = $kouluid;
            $_SESSION["Koodi"] = $koodi;
            $_SESSION["Avain"] = $avain;
            $_SESSION["Lukuvuosi"] = $lukuvuosi;
            $_SESSION["Alkupvm"] = $alkupvm;
            $_SESSION["Loppupvm"] = $loppupvm;
            if ($koepvm != '') {
                $_SESSION["Koepvm"] = $koepvm;
            }


            $_SESSION["Koeaika"] = $koeaika;
            if ($_SESSION["Koeaika"] == '') {
                $_SESSION["Koeaika"] = "09:00";
            }

            $_SESSION["Sallicd"] = $sallicd;
            $_SESSION["Muutopet"] = $muutopet;
            $_SESSION["KurssiId"] = $id;
        }
        $_SESSION["vaihto"] = 0;
    }

    if (!$haeaktit = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowp = $haeaktit->fetch_assoc()) {
        $palaute = $rowp[palauteakt];
        $aikataulu = $rowp[aikatauluakt];
        $tavoite = $rowp[tav_akt];
    }
    if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka->num_rows != 0) {
        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
    }
    if (!$hae_eka2 = $db->query("select MIN(id) as id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka2->num_rows != 0) {
        while ($rivieka2 = $hae_eka2->fetch_assoc()) {
            $eka_id2 = $rivieka2[id];
        }
    }




    include('kurssisivustonheader.php');



    echo '<div class="cm8-container7" id="paluu" style="margin-top: 0px; padding-top:0px; padding-bottom: 30px; margin-bottom: 0px; border-bottom: none">';

    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '" class="currentLink">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()"  >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	  ';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {

            $kysakt = $rowa[kysakt];
        }
//        if ($kysakt == 1) {
//
//
//            echo'<a href="kysymykset2.php" target="_blank">Kysy/kommentoi</a>';
//        } else {
        // // echo'<a  href="kysymyksetkommentit.php">Kysy/kommentoi</a>';
//        }


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
    }

    if ($_SESSION["Rooli"] == "opiskelija") {
        echo'<nav class="topnav" id="myTopnav">
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '" class="currentLink" >Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
		
		  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
			
	';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {

            $kysakt = $rowa[kysakt];
        }
        if ($kysakt == 1) {


//            echo'<a href="kysymykset2.php" target="_blank">Kysy/kommentoi</a>';
        } else {
            // // echo'<a  href="kysymyksetkommentit.php">Kysy/kommentoi</a>';
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
    }



    echo '<div class="cm8-container7" style="border: none; margin-left: 0px;margin-top: 0px; padding-top:10px; padding-bottom: 0px; margin-bottom: 0px; padding-left: 0px;">';





    if (!$haeaktit = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowp = $haeaktit->fetch_assoc()) {
        $palaute = $rowp[palauteakt];
        $aikataulu = $rowp[aikatauluakt];
        $tavoite = $rowp[tav_akt];
    }
    echo '<div  class="cm8-container7" style="border: none; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {


//        if ($tavoite == 0) {
//
//            echo'<p style="color: #48E5DA; display: inline-block; margin-left: 30px; margin-right: 40px;"><em>Opiskelijoille voidaan antaa mahdollisuus asettaa kurssille/opintojaksolle tavoite (näkyy myöhemmin osallistujaluettelossa).</em></p>';
//
//            echo'<form action="aktivoitavoite.php" method="post" style="display: inline-block; padding-top: 0px; margin-top: 0px; text-align: top; margin-left: 20px"><input type="hidden" name="arvo" value="joo"> <input type="submit" value="Salli" class="myButton8"  role="button" style="padding: 4px; font-size: 0.7em"></form>';
//
//            //salli tavoitteen anto
//        } else {
//            echo'<p style="color: #48E5DA; display: inline-block; margin-left: 30px; margin-right: 40px;"><em>Opiskelijat voivat asettaa tässä tavoitteensa, jotka näkyy Osallistujat-osiossa.</em></p>';
//            echo'<form action="aktivoitavoite.php" method="post" style="display: inline-block; padding-top: 0px; margin-top: 0px; text-align: top; margin-left: 20px"><input type="hidden" name="arvo" value="ei"> <input type="submit" value="Peru" class="myButton8"  role="button" style="padding:4px; font-size: 0.7em"></form>';
//
//            //peru tavoitteen anto
//        }
    } else {
//
//        if (!$haeakt = $db->query("select tav_akt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
//            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//        }
//        while ($rowakt = $haeakt->fetch_assoc()) {
//            $akt = $rowakt[tav_akt];
//        }
//
//        if ($akt != 0) {
//
//            if (!$haetavoite = $db->query("select distinct tavoite from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND opiskelija_id='" . $_SESSION["Id"] . "'")) {
//                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//            }
//
//            while ($rowtav = $haetavoite->fetch_assoc()) {
//
//                $tavoitteeni = $rowtav[tavoite];
//
//              
//            }
//              echo '<br><p style="margin-bottom: 0px; display: inline-block; margin-left: 30px;  margin-right: 10px; color: #e608b8"><b>Tavoitteeni kurssille/opintojaksolle: </b></p>';
//
//                echo'<form action="muokkaatavoite.php" method="post" style="display: inline-block; padding-top: 0px; margin-top: 0px; text-align: top; margin-left: 20px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '> <input type="submit" value="&#9998 Muokkaa" title="Muokkaa tavoitetta" class="myButton8"  role="button" style="padding: 2px 4px" ></form></p>';
//                echo '<p style="margin-top: 0px; margin-left: 30px;  margin-right: 10px; font-size: 0.8em">'.$tavoitteeni.'</p>';
//                
//            
//        }
    }


    echo'</div>';
    if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka->num_rows != 0) {
        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
    }
    if (!$hae_eka2 = $db->query("select MIN(id) as id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka2->num_rows != 0) {
        while ($rivieka2 = $hae_eka2->fetch_assoc()) {
            $eka_id2 = $rivieka2[id];
        }
    }







    echo'</div></div>';


    echo '<div class="cm8-container7" style="margin-top: 0px; padding-top:0px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 40px; border-top: none">';


    echo '<h2 style="display: inline-block; padding-top: 0px">ILMOITUSTAULU</h2>';


    if (!$haeilmoitus = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowv = $haeilmoitus->fetch_assoc()) {
        $viesti = $rowv[ilmoitus2];
    }

    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<br><div class="cm8-responsive" id="info_ope" style="display: inline-block">';
        echo'<div class="cm8-responsive" style="padding: 0px; margin: 0px; background-color: white;">';

        echo' <form action="ilmoitus.php" method="post" id="infomuokkaus" ><input type="submit" name= "painikek" value="&#9998" title="Muokkaa ilmoitustaulua" class="muokkausinfo"  role="button"  style="padding:2px 4px; font-size: 1em"></form>';

        echo'</div>';
        echo'<div class="cm8-responsive cm8-ilmoitus" style="padding: 20px; ">';


        echo htmlspecialchars_decode($viesti);
        echo'</div>';
        echo'</div>';
    } else {
        echo'<br><div class="cm8-responsive cm8-ilmoitus" id="info" style="display: inline-block">';

        echo htmlspecialchars_decode($viesti);
        echo'</div>';
    }



    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

        echo'<p style="color: #e608b8; font-size: 0.8em"><b style="margin-right: 20px;">Kurssin/Opintojakson avain on: </b>' . $_SESSION[Avain] . '</p>';
    }

    if ($aikataulu == 0) {

        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

            echo '<br><h2 style="padding-top: 20px; display: inline-block">AIKATAULU</h2>';

            echo' <form action="aktivoiaikataulu.php" method="post"><br><br><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikea" value="+ Lisää aikataulu" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 1em"></form>';
        }
    } else {

        echo '<br><h2 style="padding-top: 20px; display: inline-block; margin-right: 20px">AIKATAULU</h2>';
        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
            echo' <form action="muokkaa_aikataulu.php#tanne" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa aikataulua" class="muokkausN"  role="button"></form>';

            echo' <form action="aikatauluvarmistus.php" method="post" style="display: inline-block; margin-right: 10px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><button class="roskis" title="Poista aikataulu"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button></form>';
        }

        echo'<div class="cm8-responsive" style="padding-top: 10px; padding-right: 10px;">';
       
        echo '<table id="mytable" class="cm8-uusitablekurssi" style="max-width: 100%; margin-top: 0px !important;">  <thead>';

        echo '<tr style="border: 1px solid grey;id="palaa"><th style="border: 1px solid grey; width: 10%">Ajankohta</th><th style="border: 1px solid grey ">Aihe</th><th style="border: 1px solid grey">Lisätietoja</th></tr></thead><tbody>';

        if (!$haeaikataulu = $db->query("select distinct * from kurssiaikataulut where kurssi_id='" . $_SESSION[KurssiId] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        
        while ($rowt = $haeaikataulu->fetch_assoc()) {

            echo '<tr style="font-size: 0.9em;"><td style="border: 1px solid grey;    ">' . $rowt[aika] . '</td><td style="border: 1px solid grey;  ">' . $rowt[aihe] . '</td><td style="word-wrap: break-word;   border: 1px solid grey;  ">' . $rowt[lisa] . '</td></tr>';
        }

        echo "</tbody></table>";
 
        
        }

    echo'</div>';
    echo'</div>';
    echo'</div>';
    ?>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
    <script>
        var $table = $('#mytable');

        $table.floatThead();
    </script>        
    <?php
session_start(); 


    ob_start();
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');

    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}


echo "</div>";
include("footer.php");
?>

</body>
</html>	
