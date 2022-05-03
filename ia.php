<?php
session_start(); 


ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

echo'<!DOCTYPE html><html> 
<head>
<title> Itsearviointi</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
';


include("yhteys.php");
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}


if (isset($_SESSION["Kayttajatunnus"])) {
    include("kurssisivustonheader.php");

    include "libchart/libchart/classes/libchart.php";

    echo '<div class="cm8-container7" id="paluu" style="margin-top: 0px; padding-top:0px; padding-bottom: 30px; margin-bottom: 0px; ">';

    echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a>
          <a href="ia.php"  class="currentLink" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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


    echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 20px; padding-right: 20px; border: none">';


    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

        echo'<h2 style="display: inline-block; padding-top: 0px; padding-left: 0px; padding-bottom: 30px" id="lisaa">Itsearviointi</h2>';

    
    if (!$onkoprojekti = $db->query("select * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if ($onkoprojekti->num_rows != 0) {


            echo'<form action="varmistusia.php" method="post" style="float: right; margin-right: 100px"><button class="isoroskis" title="Poista Itsearviointi-osio"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista Itsearviointi-osio</b></i></button></form>';
        }

        if ($onkoprojekti->num_rows == 0) {




            echo'<div style="text-align: center">';
            echo'<form action="uusi_ia.php" method="post" style="display: inline-block; margin-right: 60px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikelu" value="+ Lisää Itsearviointi-osio" title="Lisää Itsearviointi-osio" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 1em"></form>';
               echo'<form action="tuoia.php" method="get" style="display: inline-block; margin-bottom: 40px"><input type="hidden" name="mihin" value="uusi">';
          echo'<button  name="painike" title="Tuo itsearviointi" class="myButton8" style="font-size: 1em"><i class="fa fa-recycle"></i>&nbsp&nbsp Tuo aiemmin luotu Itsearviointi-osio </button>';
  echo'</form>';
            echo'</div>';
        } else {



//INFORUUTU
            if (!$haeinfo = $db->query("select distinct infoitsearviointi from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowv = $haeinfo->fetch_assoc()) {
                $viesti = $rowv[infoitsearviointi];
            }

            $viesti = htmlspecialchars_decode($viesti);
         
              if ($viesti != '' && $viesti !='<br>') {
                   echo'<br><div class="cm8-responsive cm8-ilmoitus" id="info_ope" style="margin-top: 10px;display: inline-block">';
              }
              else{
                  echo'<br><div class="cm8-responsive cm8-ilmoitus" id="info_ope" style="margin-top: 10px;display: inline-block; width: 30%">';
              }
  
            echo'<div class="cm8-responsive" style="padding: 0px; margin: 0px">';

            echo '<form action="ilmoitus.php" method="post" id="infomuokkaus"><input type="hidden" name="kuvaus" value=' . $kuvaus . '><input type="submit" name= "painikeia" value="&#9998" title="Muokkaa sisältöä" class="muokkausinfo"  role="button"  style="padding: 2px 4px; font-size: 0.8em; float: left; margin-bottom: 0px"></form>';

            echo'</div>';

            echo'<div class="cm8-responsive cm8-ilmoitus" style="padding: 20px">';

            echo $viesti;
            echo'</div>';
            echo'</div>';

            if (!$RTsuljettu = $db->query("select distinct sulkeutuu from ia where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($RTs = $RTsuljettu->fetch_assoc()) {
                $sulkeutuu = $RTs[sulkeutuu];
            }

//            if (!empty($sulkeutuu) && $sulkeutuu != ' ') {
//
//                $nyt = date("Y-m-d H:i");
//                $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
//                $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
//                $sulkeutumiskello = substr($sulkeutuu, 11, 5);
//
//                $takaraja = $sulkeutuu;
//
//
//                if ($nyt <= $takaraja) {
//
//                    echo'<br><b style="color: #e608b8">Itsearviointilomakkeen muokkaus sulkeutuu ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
//                } else {
//                    echo'<br><b style="color: #e608b8">Itsearviointilomakkeen muokkaus on sulkeutunut ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
//                }
//            } else {
//                echo'<p id="ohje" style="display: inline-block">Itsearviointilomakkeen muokkaukselle ei ole asetettu takarajaa.</p>';
//            }
//
//
//            echo'<form action="asetatakarajaia.php" method="get" style="display: inline-block; margin-left: 20px"><input type="submit" name="painike" value="&#9998 Muokkaa" class="myButton8"  role="button"  style="padding:2px 4px;"></form>';
//

            if (!$haearvioinnit = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
   echo'<div style="text-align: center; margin-bottom: 0px;margin-top: 0px">';
            if ($haearvioinnit->num_rows != 0) {
             
                echo'<form action="tarkasteleiat.php" method="get" style="display: inline-block"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike"  title="Tarkastele opiskelijoiden lomakkeita" value="🕵 Tarkastele opiskelijoiden lomakkeita" class="myButtonTarkastele"  role="button" ></form>';
                echo'<form action="uusi_ia.php" style="margin-top: 40px; margin-bottom: 20px" method="post" ><input type="hidden" name="monesko" value=' . $monesko . '><input type="submit" name="painike" value="&#9998 Muokkaa itsearviointilomaketta"  title ="Muokkaa itsearviointilomaketta" class="myButton9"  role="button"  style="font-size: 0.9em; padding:2px 4px;"></form>';

              
            }

  echo'</div>';


            if (!$haesarakkeet = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            if (!$haeonko = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

              if (!$haeonko2 = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
         
            $nyt = date("Y-m-d H:i");
            if ($haeonko->num_rows != 0 || $haeonko2 -> num_rows !=0) {

                $onko = $haeonko->num_rows;

                $smaara = $haesarakkeet->num_rows;

                if ($smaara == 1) {

                    $divleveys = 50;
                } else {
                    $divleveys = 100 / $smaara;
                }

                while ($rows = $haesarakkeet->fetch_assoc()) {

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

                    echo'<div style="vertical-align: bottom; width: 100%; height: 80px;">';
                    if (!$haetehtavat = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $sid . "' ORDER BY jarjestys")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    $onko = $haetehtavat->num_rows;
                    echo '<form action="asetaiatakaraja.php" id="' . $sid . '" style="font-size: 0.9em" method="post" autocomplete="off">';

                    if ($avautuu != NULL) {

                        if ($nyt > $avautuu) {
                            echo'<b style="font-size:0.8em; margin-right: 20px; color: #e608b8">Tämä osio avautui ';
                        } else {
                            echo'<b style="font-size:0.8em; margin-right: 20px; color: #e608b8">Tämä osio avautuu';
                        }





                        echo'&nbsp&nbsp&nbsp' . $avautumispaiva . ' klo ' . $avautumiskello . '.</b>';
                       echo'<input type="hidden" name="kelloA" value='.$avautumiskello.'>';
                        echo'<input type="hidden" name="paivaA" value='.$avautumispaiva.'>';
                        echo'<input type="submit" style="font-size: 0.6em; margin-left: 10px; padding: 2px" value="Muokkaa (' . $sid . ')" class="myButton8" name="muokkaaA"  title="Muokkaa avatumisaikaa">';
                    } else if ($avautuu == NULL && (($sulkeutuu != NULL && $nyt < $sulkeutuu) || $sulkeutuu == NULL)) {
                        echo'<p style="margin: 0px 0px 2px 0px; font-weight: bold; font-size: 0.7em;color: #e608b8;">Aseta avautumissajankohta tälle osiolle: </p>';
                        echo'<b style="font-size: 0.6em; margin-right: 5px; color:  ">Pvm:</b>
     
            <input type="text" style="margin-right: 10px; width: 20%; font-size: 0.7em; color: #2b6777" class="kdate"  name="paivaA">';


                        echo'<b style="font-size: 0.6em; margin-right: 5px; color: ">Klo:</b>
    
               <input type="text"  name="kelloA" style="width: 20%; font-size: 0.7em; color: #2b6777" class="kello">
                                   	
      <input type="hidden" name="jarjestys" value=' . $sid . '>
      
	<input type="submit" style="margin-left:10px; padding: 2px; font-size: 0.6em" value="Tallenna (' . $sid . ')" class="myButton8" name="tallennaA"  title="Tallenna avautumisaika">';
                    }
               
                    if ($sulkeutuu != NULL) {

                        if ($nyt > $sulkeutuu) {
                            echo'<b style="font-size:0.8em; margin-right: 20px; color: #e608b8"><br>Tämä osio on sulkeutunut ';
                        } else {
                            echo'<b style="font-size:0.8em; margin-right: 20px; color: #e608b8"><br>Tämä osio sulkeutuu ';
                        }





                        echo'&nbsp&nbsp&nbsp' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '.</b>';
                         echo'<input type="hidden" name="kelloK" value='.$sulkeutumiskello.'>';
                        echo'<input type="hidden" name="paivaK" value='.$sulkeutumispaiva.'>';
                        echo'<input type="submit" style="font-size: 0.6em; margin-left: 10px; padding: 2px" value="Muokkaa (' . $sid . ')" class="myButton8" name="muokkaaK"  title="Muokkaa sulkeutumisaikaa">';
                    } else {
                        echo'<p style="margin: 2px 0px 2px 0px; font-weight: bold; font-size: 0.7em;color: #e608b8;">Aseta sulkeutumisajankohta tälle osiolle: </p>';
                        echo'<b style="font-size: 0.6em; margin-right: 5px; color:  ">Pvm:</b>
     
            <input type="text" style="margin-right: 10px; width: 20%; font-size: 0.7em; color: #2b6777" class="kdate"  name="paivaK">';


                        echo'<b style="font-size: 0.6em; margin-right: 5px; color: ">Klo:</b>
    
               <input type="text"  name="kelloK" style="width: 20%; font-size: 0.7em; color: #2b6777" class="kello">
                                   	
      <input type="hidden" name="jarjestys" value=' . $sid . '>
      
	<input type="submit" style=" margin-left:10px; padding: 2px; font-size: 0.6em" value="Tallenna (' . $sid . ')" class="myButton8" name="tallennaK"  title="Tallenna sulkeutumisaika"><br><br>';
                    }
                    echo'</form>';


                    echo'</div>';


                    echo '<table id="mytable" class="cm8-uusitableiauusi" style="width: 100%" ><thead></thead><tbody>';

                    if ($onko == 0) {
                        echo '<tr class="iaihe2"><td>Sisältö</td></tr>';
                    } else {
                        
                    }

                    while ($rowt = $haetehtavat->fetch_assoc()) {

                        if ($rowt[onotsikko] == 1) {

                            echo '<tr class="iaihe2"><td>' . $rowt[otsikko] . '</td></tr>';
                        } else if ($rowt[onvastaus] == 1) {

                            if ($rowt[onradio] == 1) {
                                if (!$haer = $db->query("select distinct * from iavaihtoehdot where ia_id='" . $rowt[id] . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

//        

                                echo '<tr class="osisalto"><td>';
                                while ($rowr = $haer->fetch_assoc()) {
                                    $rowr[vaihtoehto] = str_replace('<br />', "", $rowr[vaihtoehto]);
                                    echo'<p><input type="radio" style="margin-right: 10px">&nbsp&nbsp&nbsp' . $rowr[vaihtoehto] . '</p>';
                                }

                                echo'</td></tr>';
                            } else if ($rowt[oncheckbox] == 1) {
                                if (!$haec = $db->query("select distinct * from iavaihtoehdot where ia_id='" . $rowt[id] . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

//        

                                echo '<tr class="osisalto"><td>';
                                while ($rowc = $haec->fetch_assoc()) {
                                    $rowc[vaihtoehto] = str_replace('<br />', "", $rowc[vaihtoehto]);
                                    echo'<p><input type="checkbox" style="margin-right: 10px">&nbsp&nbsp&nbsp' . $rowc[vaihtoehto] . '</p>';
                                }

                                echo'</td></tr>';
                            } else if ($rowt[onteksti] == 1) {
                                echo '<tr class="osisalto"><td>' . $rowt[vastaus] . '</td></tr>';
                            }
                        }
                    }
                    echo "</tbody></table></div>";
                    $smaara--;
                }
            } else {
                echo'<em id="ohje">Itsearviointilomakkeessa ei ole sisältöä.</em>';
                echo'<br><br><form action="uusi_ia.php" method="post" ><input type="hidden" name="monesko" value=' . $monesko . '><input type="submit" name="painike" value="&#9998 Lisää sisältöä"  title ="Muokkaa itsearviointilomaketta" class="myButton9"  role="button"  style="font-size: 1em; padding:4px 6px; "></form>';
            }
            if ($haesarakkeet->num_rows == 1 && ($haeonko->num_rows != 0 || $haeonko2 -> num_rows !=0)) {
                echo'<form action="uusi_ia.php" style="margin-top: 20px" method="post" ><input type="hidden" name="monesko" value=' . $monesko . '><input type="submit" name="painike" value="&#9998 Muokkaa itsearviointilomaketta"  title ="Muokkaa itsearviointilomaketta" class="myButton9"  role="button"  style="font-size: 1em; padding:4px 6px;  margin-top: 20px"></form>';
            } if ($haesarakkeet->num_rows != 1 && ($haeonko->num_rows != 0 || $haeonko2 -> num_rows !=0)) {
                echo'<div style="text-align: center">';
                echo'<form action="uusi_ia.php" style="margin-top: 20px" method="post" ><input type="hidden" name="monesko" value=' . $monesko . '><input type="submit" name="painike" value="&#9998 Muokkaa itsearviointilomaketta"  title ="Muokkaa itsearviointilomaketta" class="myButton9"  role="button"  style="font-size: 1em; padding:4px 6px;  margin-top: 20px"></form>';

                echo'<br></div>';
            }



            echo'</div>';
            if ($haesarakkeet->num_rows == 1) {
                ?>



                <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
                <script>
                    var $table = $('#mytable');

                    $table.floatThead({zIndex: 1});

                </script>        
                <?php
session_start(); 


                ob_start();
            }
        }


        echo' <div class="cm8-margin-top" id="cm"></div>';







        echo'</div>';
    }

//opiskelija
    else {

        echo'<h2 style="display: inline-block; padding-top: 0px; padding-left: 0px; padding-bottom: 0px" id="lisaa">Itsearviointi</h2>';

        if (!$onkoprojekti = $db->query("select * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($onkoprojekti->num_rows == 0) {



            echo'<br><br><br><em id="ohje">Tätä osiota ei ole otettu käyttöön.</em><br><br>';
        } else {

   echo'<div class="cm8-responsive" style="margin: 0px; padding: 00px 0px 0px 0px; overflow-y: hidden">';
  echo'<div class="cm8-half" style="text-align: left; padding: 0px; margin: 0px"><br>';

//INFORUUTU
            if (!$haeinfo = $db->query("select distinct infoitsearviointi from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowv = $haeinfo->fetch_assoc()) {
                $viesti = $rowv[infoitsearviointi];
            }
            if ($viesti != '' && $viesti != '<br>' && $viesti != '<div><br></div>') {
                echo'<br><div style="margin-top: 30px; margin-bottom: 20px; display:inline-block" class="cm8-responsive cm8-ilmoitus" id="info">';

                echo htmlspecialchars_decode($viesti);
                echo'</div>';
            } else {
                if (!$haetehtavat = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "' AND avautuu IS NOT NULL")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($haetehtavat->num_rows != 0) {
                    echo'<div style="margin-top: 30px"></div>';
                }
//             
            }
echo'</div>';

  echo'<div class="cm8-half" style="text-align: center; "><br>';
       if (!$result = $db->query("select distinct opiskelijankurssit.id as kuid from ia, opiskelijankurssit WHERE opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND ia.kurssi_id=opiskelijankurssit.kurssi_id AND opiskelijankurssit.kurssi_id<>'".$_SESSION[KurssiId]."'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($result->num_rows != 0){
       
        echo'<h4><a href="omatiat.php?kurssi=1" class="ia">Muut itsearviointilomakkeet</a></h4>';
       
    }
    else{
        echo'<h4></h4>';
    }
echo'</div>';
echo'</div>';
            echo'<div class="cm8-responsive" style="margin: 0px; padding: 10px 0px 0px 0px; overflow-y: hidden">';

            if (!$haeonko = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($haeonko->num_rows != 0) {
                //            if (($nyt <= $takaraja && $takarajaon == 1) || $takarajaon == 0) {




                echo'<form action="tallennaiat.php" method="post" id="palaa" style="padding: 0px; margin:0px">';
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

                    if (!$haekommenttieka = $db->query("select distinct * from iakommentit where (kommentti IS NOT NULL && kommentti<>'' ) AND kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttaja_id='" . $_SESSION[Id] . "' && tallennettu = 1")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    
                     if (!$haekaikkikom = $db->query("select distinct * from iakommentit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttaja_id='" . $_SESSION[Id] . "' && tallennettu = 1")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        
                        if (!$haekommentti = $db->query("select distinct * from iakommentit where ia_sarakkeet_jarjestys = '" . $sid . "' AND kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttaja_id='" . $_SESSION[Id] . "' && tallennettu = 1")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        
                        
                        $kommentti = '';
                        while ($rowkom = $haekommentti->fetch_assoc()) {
                            $kommentti = $rowkom[kommentti];
                        }
                   
                        if($haekaikkikom -> num_rows != 0){
                                        if ($kommentti != NULL || $kommentti != '') {
                                
                            echo'<div style="padding: 0px; margin: 0px; text-align: center">';
                            echo'<p style="margin-bottom: 5px;font-size: 0.9em; font-weight: bold; color:  #48E5DA;">Opettajan kommentit tästä sarakkeesta: </p>';

                            echo'<div style="text-align: left;width: 80%;padding: 10px; height: 100px; overflow: auto; margin: 0px; font-weight:bold; display: inline-block;font-size: 0.8em;border: 2px solid  #48E5DA; border-radius: 10px; color: #2b6777; background-color: white">' . $kommentti . '</div><br><br>';
                            echo'</div>';
                            } else {
                            
                            echo'<p style="margin-bottom: 5px;font-size: 0.9em; font-weight: bold; color:  #2b6777;">Opettajan kommentit tästä sarakkeesta: </p>';

                          
                            echo'<div style="width: 100%;padding: 6px; height: 100px; overflow: auto; margin: 0px; font-weight:bold; display: inline-block;font-size: 0.7em;border: 2px solid  #2b6777; border-radius: 10px; color: #2b6777; background-color: #e5e5e5">' . $kommentti . '</div><br><br>';
                     
                            
                            }
                        }
            
                    

                             
                    if (!$haetehtavat = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $sid . "' ORDER BY jarjestys")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    $onko = $haetehtavat->num_rows;


                    if ($avautuu != NULL) {

                        if ($avautuu > $nyt) {
                            echo'<p style="margin: 0px; font-size: 0.7em; color:#e608b8; font-weight: bold">Tämä osio avautuu ';
                        } else {
                            echo'<p style="margin: 0px; font-size: 0.7em; color: #e608b8; font-weight: bold">Tämä osio avautui ';
                        }

                        echo'&nbsp&nbsp&nbsp' . $avautumispaiva . ' klo ' . $avautumiskello . '</p>';
                    } else {
                        echo'<p style="margin: 0px; font-size: 0.7em; font-weight: bold">&nbsp&nbsp&nbsp</p>';
                    }

                    if ($sulkeutuu != NULL) {

                        if ($sulkeutuu > $nyt) {
                            echo'<p style="margin: 5px 0px 8px 0px; font-size: 0.7em; color:#e608b8; font-weight: bold">Tämä osio sulkeutuu ';
                        } else {
                            echo'<p style="margin: 5px 0px 8px 0px; ; font-size: 0.7em; color:#e608b8; font-weight: bold">Tämä osio on sulkeutunut ';
                        }

                        echo'&nbsp&nbsp&nbsp' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</p>';
                    } else {
                        echo'<p style="margin: 5px 0px 8px 0px; font-size: 0.7em; font-weight: bold">&nbsp&nbsp&nbsp</p>';
                    }
                   

                    echo '<table id="mytable2" class="cm8-uusitableiauusi" style="margin-bottom: 10px; width: 100%;" ><thead>';

                    echo '</thead><tbody>';
                    if ($onko == 0) {
                        echo '<tr class="iaihe2"><td>Sisältö</td></tr>';
                    }

                    if (!$haet = $db->query("select distinct MIN(tallennettu) as tallennettu from iakp, ia where iakp.ia_id=ia.id AND iakp.kayttaja_id = '" . $_SESSION[Id] . "' AND  ia.ia_sarakkeet_jarjestys = '" . $sid . "' AND ia.kurssi_id='" . $_SESSION[KurssiId] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($rowkom = $haet->fetch_assoc()) {
                        $tallennettu = $rowkom[tallennettu];
                    }

                    while ($rowt = $haetehtavat->fetch_assoc()) {

                        if (!$haekp = $db->query("select distinct * from iakp where ia_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'"
                                . " AND id IN (select MIN(id) from iakp where ia_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "')")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        if ($rowt[onotsikko] == 1) {

                            echo '<tr class="iaihe2"><td>' . $rowt[otsikko] . '</td></tr>';
                        } else if ($rowt[onvastaus] == 1) {
                            $tallennettu=0;
                            while ($rowkp = $haekp->fetch_assoc()) {
                                if ($rowkp[tallennettu] == 1  || ($sulkeutuu != NULL && $sulkeutuu <= $nyt) || ($avautuu != NULL && $avautuu > $nyt)) {
                                    $tallennettu=1;
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
                                                $valittu = 1;
                                                echo'<p style="font-weight: bold" class="myButtonValittu">' . $rowr[vaihtoehto] . '</p>';
                                            } else {
                                                echo'<p style="font-size: 0.8em; font-weight: normal">' . $rowr[vaihtoehto] . '</p>';
                                            }
                                        }
                                        if ($valittu == 0 && $avautuu < $nyt) {
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
                                            if (!$haekpmoni = $db->query("select distinct * from iakp_moni where iavaihtoehdot_id= '" . $rowr[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                            }
                                            if ($haekpmoni->num_rows != 0) {
                                                $valittu2 = 1;
                                                echo'<p style="font-weight: bold; " class="myButtonValittu">' . $rowr[vaihtoehto] . '</p><br>';
                                            } else {
                                                echo'<p style="font-size: 0.8em; font-weight: normal">' . $rowr[vaihtoehto] . '</p>';
                                            }
                                        }
                                        if ($valittu2 == 0 && $avautuu < $nyt) {
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


                    if ((($sulkeutuu != NULL && $sulkeutuu > $nyt) || $sulkeutuu == NULL) && ($avautuu == NULL || ($avautuu != NULL && $avautuu < $nyt))) {

                        if ($tallennettu == 1) {
                            echo'<input name="muokkaa" class="myButtonLataa" value="&#9998 Muokkaa (' . $sid . ')" type="submit" style="font-size: 0.8em;display: inline-block; padding: 4px 6px" title="Muokkaa vastauksia">';
                        } else {
                            echo'<input type="submit" name="painiket" value="&#10003 Tallenna (' . $sid . ')" class="myButton8"  role="button"  style="font-size: 0.8em; padding:4px 6px; display:inline-block;" title="Tallenna">';
                        }
                    }





//            }

                    echo'</div>';
                    $smaara--;
                }

                echo'</form></div>';

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
                } else {
                    
                }
            } else {

                echo'<br><br><em id="ohje">Itsearviointilomakkeessa ei ole vielä sisältöä.</em><br><br>';
            }
        }
        echo'</div>';
        echo'</div>';
        echo'</div>';
    }

    echo'</div>';


    echo'</div>';








    echo'</div>';
    echo'</div>';
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



include("footer.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script type="text/javascript" src="jscm/jquery.timepicker.js"></script>
<script src="jscm/jquery-ui.js"></script>
<script type="text/javascript" src="/js/fi.js"></script>
<script>

                    (function () {
                        $.datepicker.setDefaults($.datepicker.regional['fi']);
                        var elem = document.createElement('input');
                        elem.setAttribute('type', 'text');

                        if (elem.type === 'text') {
                            $('.kdate').datepicker({
                                dateFormat: 'dd.mm.yy',
                            });


                        }
                        $('.kello').timepicker({
                            timeFormat: 'HH:mm',
                            // year, month, day and seconds are not important
                            minTime: new Date(0, 0, 0, 1, 0, 0),
                            maxTime: new Date(0, 0, 0, 23, 55, 0),
                            // time entries start being generated at 6AM but the plugin 
                            // shows only those within the [minTime, maxTime] interval
                            startHour: 6,
                            // the value of the first item in the dropdown, when the input
                            // field is empty. This overrides the startHour and startMinute 
                            // options
                            startTime: new Date(0, 0, 0, 8, 0, 0),
                            maxTime: new Date(0, 0, 0, 23, 55, 0),
                            // items in the dropdown are separated by at interval minutes
                            interval: 15
                        });


                    })();


</script>
<script>
    let buttons = document.querySelectorAll('.kello');
    buttons.forEach((btn) => {

        btn.addEventListener("keyup", function (event) {

            if (event.keyCode === 13) {
                event.preventDefault();
                var ancestor = this.parentNode;
                ancestor.submit();
//   document.getElementById("button").click();

            }
        });



    });


</script>
</body>
</html>		