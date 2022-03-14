<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Käyttäjäprofiili </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
$urlmihin = $_SERVER[REQUEST_URI];

$urlmihin = substr($urlmihin, 1);


if (isset($_SESSION["Kayttajatunnus"])) {


    if (!isset($_GET[url])) {
        include("header.php");
        include("header2.php");
    } else {
        if ($_GET[url] == "osallistujat.php" || $_GET[url] == "ryhmatyot.php" || $_GET[url] == "lisaaopettajaeka.php" || $_GET[url] == "lisaaopiskelijaeka.php") {
            include("kurssisivustonheader.php");
        } else {
            include("header.php");
            include("header2.php");
        }
    }


    echo'<div class="cm8-container7">';

    if (strpos($_GET[url], 'osallistujat.php') !== false || strpos($_GET[url], 'lisaaopiskelijaeka.php') !== false || strpos($_GET[url], 'lisaaopettajaeka.php') !== false) {
        echo'<nav class="topnav" id="myTopnav">';

        echo'<a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	   
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a>';


        echo' <a href="ryhmatyot.php">Palautukset</a>';


        echo'<a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>';

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
	  ';

        echo' <a href="osallistujat.php"  class="currentLink">Osallistujat</a>';



        echo' <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
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
    } else if (strpos($_GET[url], 'ryhmatyot.php') !== false) {
        echo'<nav class="topnav" id="myTopnav">';

        echo'<a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	   
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a>';


        echo' <a href="ryhmatyot.php"   class="currentLink">Palautukset</a>';


        echo'<a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>';

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
	  ';

        echo' <a href="osallistujat.php" >Osallistujat</a>';



        echo' <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
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
    } else {

        if ($_SESSION["Rooli"] == 'admin' || ($_SESSION["Rooli"] == 'opiskelija' && $_SESSION["vaihto"] == 1 ))
            include("adminnavi.php");
        else if ($_SESSION["Rooli"] == 'admink' || ($_SESSION["Rooli"] == 'opiskelija' && $_SESSION["vaihto"] == 1 ))
            include("adminknavi.php");
        else if ($_SESSION["Rooli"] == 'opeadmin' || ($_SESSION["Rooli"] == 'opiskelija' && $_SESSION["vaihto"] == 1 ))
            include("opeadminnavi.php");
        else
            include("opnavi.php");
    }


    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px;">';
    if (!$resulteka = $db->query("select distinct * from kayttajat where id='" . $_GET[ka] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($roweka = $resulteka->fetch_assoc()) {
        $nimi = $roweka[etunimi] . ' ' . $roweka[sukunimi];
    }

    echo'<h4 style="padding-bottom: 20px; margin-bottom: 0px">Käyttäjä ' . $nimi . ' </h4>';


    //palaa takaisin 



    if ($_GET[url] == "kayttajatkaikki.php") {
        echo '<a href="kayttajatkaikki.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "arvostelut.php") {
        echo '<a href="arvostelut.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "kaikkitiedostot.php") {
        echo '<a href="kaikkitiedostot.php style="margin-bottom: 5px"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "kayttajatmuut.php") {
        echo '<a href="kayttajatmuut.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "kayttajatopettajat.php") {
        echo '<a href="kayttajatopettajat.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "kayttajatopiskelijat.php") {
        echo '<a href="kayttajatopiskelijat.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "kayttajatvahvistus.php") {
        echo '<a href="kayttajatvahvistus.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "kurssit.php") {
        echo '<a href="kurssit.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "kurssitkaikki.php") {
        echo '<a href="kurssitkaikki.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "livesearch.php") {
        echo '<a href="kurssit.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "livesearch2.php") {
        echo '<a href="omatkurssit.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "livesearch3.php") {
        echo '<a href="kurssitkaikki.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "livesearch4.php") {
        echo '<a href="kayttajatkaikki.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "livesearch5.php") {
        echo '<a href="kayttajatopettajat.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "livesearch6.php") {
        echo '<a href="kayttajatopiskelijat.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "livesearch7.php") {
        echo '<a href="kayttajatmuut.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "omatkurssit.php") {
        echo '<a href="omatkurssit.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "osallistujat.php") {
        echo '<a href="osallistujat.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else if ($_GET[url] == "lisaaopettajaeka.php") {
        echo '<a href="lisaaopettajaeka.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    }else if ($_GET[url] == "lisaaopiskelijaeka.php") {
        echo '<a href="lisaaopiskelijaeka.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    }else if ($_GET[url] == "ryhmatyot.php") {
        echo '<a href="ryhmatyot.php?r=' . $_GET[r] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';
    } else {
        
    }



    if (!$result = $db->query("select distinct * from kayttajat where id='" . $_GET[ka] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }




    echo'<div class="cm8-responsive">';
    echo '<table class="cm8-table2 cm8-bordered2" style="font-size: 0.9em">';
    echo"<tr><td>";

    while ($row = $result->fetch_assoc()) {

        if ($row[rooli] == 'admin') {

            if ($row[omakuva] != '') {
                echo'<img src="/' . $row[omakuva] . '" style="width: 90px"><br><br><br>';
            } else {
                echo'<br>';
            }


            echo "<b>Etunimi: </b> &nbsp&nbsp&nbsp " . $row[etunimi] . '<br><br>';
            echo "<b>Sukunimi: </b>&nbsp&nbsp&nbsp" . $row[sukunimi] . '<br><br>';

            echo '<b>Rooli: </b>&nbsp&nbsp&nbspYleinen ylläpitäjä<br><br>';


            echo "<b>Käyttäjätunnus:</b>&nbsp&nbsp&nbsp " . $row[sposti] . '<br><br>';

            echo "</td>" . "</tr>" . "</table>" . "</div><br><br>";
        } else {
           
                echo'<br>';
            


            echo "<b>Etunimi: </b> &nbsp&nbsp&nbsp" . $row[etunimi] . '<br><br>';
            echo "<b>Sukunimi: </b>&nbsp&nbsp&nbsp" . $row[sukunimi] . '<br><br>';
            if ($row[rooli] == 'muu') {
                echo '<b>Rooli: </b>&nbsp&nbsp&nbspOppilaitoskohtainen ylläpitäjä<br><br>';
            } else if ($row[rooli] == 'admin') {
                echo '<b>Rooli: </b>&nbsp&nbsp&nbspYleinen ylläpitäjä<br><br>';
            } else if ($row[rooli] == 'opettaja') {

                if (!$result2 = $db->query("select distinct * from koulunadminit where kayttaja_id='" . $_GET[ka] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($result2->num_rows != 0) {
                    echo '<b>Rooli: </b>&nbsp&nbsp&nbspOpettaja ja oppilaitoskohtainen ylläpitäjä<br><br>';
                } else {
                    echo '<b>Rooli: </b>&nbsp&nbsp&nbspOpettaja<br><br>';
                }
            } else {
                echo "<b>Rooli: </b>&nbsp&nbsp&nbspOpiskelija<br><br>";
            }
            if ($_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin'){
                echo "<b>Käyttäjätunnus:</b>&nbsp&nbsp&nbsp " . $row[sposti] . '<br>';

            if ($row[rooli] <> 'admin') {
                echo "<br><b>Oppilaitokset, joihin käyttäjä on liittynyt:</b>";

                if (!$result2 = $db->query("select distinct etunimi, sukunimi, rooli, sposti, Nimi, koulut.id as koid from kayttajat, kayttajankoulut, koulut where kayttajankoulut.odottaa=1 AND kayttajat.id='" . $row[id] . "' AND kayttajat.id=kayttajankoulut.kayttaja_id AND kayttajankoulut.koulu_id=koulut.id")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($row2 = $result2->fetch_assoc()) {
                 
                    echo "<br>" . $row2[Nimi];
                }
            }


            echo "<br><br><b>Kurssit/Opintojaksot, joissa käyttäjä on mukana:</b>";
            if (!$result89 = $db->query("select distinct kurssit.koodi as koodi, kurssit.nimi as nimi, koulut.Nimi as N from kayttajat, kurssit, opiskelijankurssit, koulut where kurssit.id=opiskelijankurssit.kurssi_id AND kayttajat.id='" . $row[id] . "' AND (kayttajat.id=opiskelijankurssit.opiskelija_id OR kayttajat.id=kurssit.opettaja_id) AND kurssit.koulu_id=koulut.id")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($row89 = $result89->fetch_assoc()) {
                echo "<br>" . $row89[koodi] . ' ' . $row89[nimi] . ' (' . $row89[N] . ')';
            }



            if ($_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {

                if ($row[paiva] != "0000-00-00" && $row[paiva] !== null) {
                    $row[paiva] = date("d.m.Y", strtotime($row[paiva]));
                    echo "<br><br><b>Viimeisin sisäänkirjautuminen:</b> &nbsp&nbsp&nbsp" . $row[paiva] . ' ' . $row[kello] . '<br><br>';
                }
            }       
            }
         





            echo "</td>" . "</tr>" . "</table>" . "</div><br><br>";
        }
        $rooli = $row[rooli];
         
    }

    if ($_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {
        if (!$resultkoulu = $db->query("select distinct * from kayttajankoulut, koulunadminit where kayttajankoulut.kayttaja_id='" . $_GET[ka] . "' AND kayttajankoulut.koulu_id=koulunadminit.koulu_id AND koulunadminit.kayttaja_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($resultkoulu->num_rows != 0) {
            echo'<form action="muokkaakayttaja.php" method="get" style="display: inline-block"><input type="hidden" name="id" value=' . $_GET[ka] . '> <input type="submit" value="&#9998 Muokkaa tietoja" class="myButton8" style="padding: 4px 6px; margin-right: 40px" role="button"  ></form>';

            
        }
    } else if ($_SESSION["Rooli"] == 'admin') {
        echo'<form action="muokkaakayttaja.php" method="get" style="display: inline-block"><input type="hidden" name="id" value=' . $_GET[ka] . '> <input type="submit" value="&#9998 Muokkaa tietoja" class="myButton8" style="padding: 4px 6px; margin-right: 40px" role="button"  ></form>';


        echo'<form action="varmistuskayttaja.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $_GET[ka] . '> <button class="pieniroskis" title="Poista käyttäjä" style="margin-right: 40px"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista käyttäjä</button></form>';
    }


    if($rooli != 'opiskelija' && $_GET[ka] != $_SESSION[Id]){
            if($_GET[url]=='osallistujat.php' || $_GET[url]=='lisaaopettajaeka.php'){
                 echo'<form action="viestikayttajalle2.php" method="get" style="display: inline-block"><input type="hidden" name="url" value=' . $_GET[url] . '><input type="hidden" name="id" value=' . $_GET[ka] . '> <input type="submit" value="📧 &nbsp Lähetä viesti" class="myButton8" style="padding: 4px 6px"  role="button" ></form>';

            }
            else{
                 echo'<form action="viestikayttajalle.php" method="get" style="display: inline-block"><input type="hidden" name="url" value=' . $_GET[url] . '><input type="hidden" name="id" value=' . $_GET[ka] . '> <input type="submit" value="📧 &nbsp Lähetä viesti" class="myButton8" style="padding: 4px 6px"  role="button" ></form>';

            }
          
    }
 
    echo'<br><div class="form-style-k cm8-quarter" style="padding-top: 10px">';

    if ($_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin' || $_SESSION["Rooli"] == 'admin') {
        echo '<form name="Form" id="myForm" onSubmit="return validateForm10();" action="salasananvaihtotarkistusadmin.php" method="post"><fieldset>
 
<legend style="margin-left: 0px">Luo käyttäjälle uusi salasana:</legend>
<br><b style="color: blue;">Muista ilmoittaa käyttäjälle valitsemasi salasana.</b>
<br><br>

<br><b style="color: #e608b8; font-size: 0.8em">Hyvässä salasanassa on vähintään 12 merkkiä, pieniä ja isoja kirjaimia sekä erikoismerkkejä ja numeroita.</b>
<br><br>



	<br><p>Uusi salasana:<br>
    
<input type="password" style="width: 80%" id="uusi" name="Salasana" placeholder="Salasana">
  <span id="show1" class="fa fa-eye-slash" style="display: inline-block" title="Näytä salasana"> </span></p>
<div style="display: inline-block; color: #e608b8; font-weight: bold; padding-top: 0px" id="divID2">
    <p class="eimitaan"></p>
</div>    
	
       <br><p>Toista uusi salasana:<br>

<input type="password" style="width: 80%" id="uusi2" name="UusiSalasana" placeholder="Toista uusi salasana">
  <span id="show2" class="fa fa-eye-slash" style="display: inline-block" title="Näytä salasana"> </span></p>
<div style="display: inline-block; color: #e608b8; font-weight: bold; padding-top: 0px" id="divID3">
    <p class="eimitaan"></p>
</div>        <br>
<input type="hidden" name="url" value=' . $_GET[url] . '>
<input type="hidden" id="id" name="Id" value=' . $_GET[ka] . '> ';
        if ($_SESSION[Rooli] == 'admin') {
            echo'<input type="hidden" id="id" name="rooli" value="admin">';
        }

        echo'<br><input id="button" type="button" onclick="validateForm10()" value="&#10003 Vaihda salasana" class="myButton9">
	</fieldset></form>';
    }

    echo'</div>';


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
<script type="text/javascript">
$('#uusi').on('keyup', function() {
      var div2 = document.getElementById("divID2");
    document.getElementById("uusi").style.backgroundColor = "white";
        div2.style.padding = "10px 60px 10px 0px";

        div2.innerHTML = "";
});
 </script>
 <script type="text/javascript">
$('#uusi2').on('keyup', function() {
      var div3 = document.getElementById("divID3");
    document.getElementById("uusi2").style.backgroundColor = "white";
        div3.style.padding = "10px 60px 10px 0px";

        div3.innerHTML = "";
});
 </script>
 
<script>
    $(function () {

        $("#show1").on("click", function () {
            var x = $("#uusi");
            if (x.attr('type') === "password") {
                x.attr('type', 'text');
                $(this).removeClass('fa fa-eye-slash');
                document.getElementById('show1').setAttribute('title', 'Piilota salasana');
                $(this).addClass('fa fa-eye');
            } else {
                x.attr('type', 'password');
                $(this).removeClass('fa fa-eye');
                $(this).addClass('fa fa-eye-slash');
                document.getElementById('show1').setAttribute('title', 'Näytä salasana');
            } // End of if
        })// End of click event

    });
</script>
<script>
    $(function () {

        $("#show2").on("click", function () {
            var x = $("#uusi2");
            if (x.attr('type') === "password") {
                x.attr('type', 'text');
                $(this).removeClass('fa fa-eye-slash');
                document.getElementById('show2').setAttribute('title', 'Piilota salasana');
                $(this).addClass('fa fa-eye');
            } else {
                x.attr('type', 'password');
                $(this).removeClass('fa fa-eye');
                $(this).addClass('fa fa-eye-slash');
                document.getElementById('show2').setAttribute('title', 'Näytä salasana');
            } // End of if
        })// End of click event

    });
</script>
<script>
    var input = document.getElementById("uusi");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("uusi2");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
</body>
</html>			
