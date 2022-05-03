<?php
session_start(); 


ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

echo'<!DOCTYPE html><html> 
<head>
<title> Kyselylomake</title>
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
          <a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  class="currentLink" >Kyselylomake</a>
		
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



    echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 0px; border: none">';


    echo'<div class="cm8-third" style="padding-left: 10px; width: 25% "><h2 style="display: inline-block; padding-top: 0px; padding-left: 0px; padding-bottom: 0px" id="lisaa">Kyselylomake</h2>';

    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {


    
        


        echo'</div>';

    





        if (!$onkoprojekti = $db->query("select * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if ($onkoprojekti->num_rows == 0) {
               echo'<div class="cm8-half" style="padding-top: 60px;">';

             echo'<div style="text-align: center; margin:0px; padding:0px">';
                   echo'<form action="uusikyselyeka.php" method="post" style="margin-right: 100px; display:inline-block" ><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää Kyselylomake-osio" title="Lisää Kyselylomake-osio" class="myButton8"  role="button"  style="font-size: 1em; padding:4px 6px"></form>';
        
                          echo'<form action="tuokyselylomake.php" method="get" style="display: inline-block; "><input type="hidden" name="monesko" value=' . $_GET[monesko] . '><input type="hidden" name="id" value=' . $ipid . '>';
  echo'<button  name="painike" title="Tuo kyselylomake" class="myButton8"  style="font-size: 1em;"><i class="fa fa-recycle"></i>&nbsp&nbsp Tuo aiemmin luotu Kyselylomake-osio </button>';
  echo'</form>';
                   echo'</div>';
            } else {


    echo'<div class="cm8-twothird" style="padding-top: 0px;">';
//INFORUUTU
            if (!$haeinfo = $db->query("select distinct kyselyinfo as info from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowv = $haeinfo->fetch_assoc()) {
                $viesti = $rowv[info];
            }
    if (!$onkoprojekti = $db->query("select * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($onkoprojekti->num_rows != 0) {
            echo'<div style="float: right">';
            echo'<form action="varmistuskysely.php" method="post" style="margin-top: 0px; margin-bottom: 20px"><button class="isoroskis" title="Poista Kyselylomake-osio"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista Kyselylomake-osio</b></i></button></form>';
        echo'</div><br>';
            
        }

            echo'<div class="cm8-responsive cm8-ilmoitus" id="info_ope" style="margin-top: 20px; max-width: 60%; margin-bottom: 40px">';
            echo'<div class="cm8-responsive" style="padding: 0px; margin: 0px">';

            echo '<form action="ilmoitus.php" method="post" id="infomuokkaus"><input type="hidden" name="kuvaus" value=' . $kuvaus . '><input type="submit" name= "painikekysely" value="&#9998" title="Muokkaa sisältöä" class="muokkausinfo"  role="button"  style="padding: 2px 4px; font-size: 0.9em;"></form>';

            echo'</div>';


            echo'<div class="cm8-responsive cm8-ilmoitus" style="padding: 20px;">';
            echo htmlspecialchars_decode($viesti);
            echo'</div>';
            echo'</div>';

            if (!$RTsuljettu = $db->query("select distinct sulkeutuu, aukeaa from kyselyt where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $nyt = date("Y-m-d H:i");
            while ($RTs = $RTsuljettu->fetch_assoc()) {
                $sulkeutuu = $RTs[sulkeutuu];
                $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
                $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
                $sulkeutumiskello = substr($sulkeutuu, 11, 5);

                $avautuu = $RTs[aukeaa];

                $avautumispaiva = substr($avautuu, 0, 10);
                $avautumispaiva = date("d.m.Y", strtotime($avautumispaiva));
                $avautumiskello = substr($avautuu, 11, 5);
            }
            echo '<br><form id="takaraja" action="asetatakarajakysely2.php" style="padding-bottom: 10px; font-size: 0.9em" method="post" autocomplete="off">';


            if ($avautuu != NULL) {

                if ($nyt > $avautuu) {
                    echo'<b style="margin-right: 20px; color: #e608b8">Kyselylomake avautui opiskelijoille ';
                } else {
                    echo'<b style="margin-right: 20px; color: #e608b8">Kyselylomake avautuu opiskelijoille';
                }

                echo'&nbsp&nbsp&nbsp' . $avautumispaiva . ' klo ' . $avautumiskello . '.</b>';
                 echo'<input type="hidden" name="kelloA" value='.$avautumiskello.'>';
                        echo'<input type="hidden" name="paivaA" value='.$avautumispaiva.'>';
                echo'<input type="submit" style="margin-left: 10px; padding: 4px 6px" value="Muokkaa" class="myButton8" name="muokkaaA"  title="Muokkaa avautumisaikaa">';
            } else if ($avautuu == NULL && (($sulkeutuu != NULL && $nyt < $sulkeutuu) || $sulkeutuu == NULL)) {
                echo'<p style="margin: 0px 0px 2px 0px; font-weight: bold;color: #e608b8;">Aseta avautumissajankohta kyselylomakkeelle: </p>';
                echo'<b style="margin-right: 5px; color:  ">Pvm:</b>
     
            <input type="text" style="margin-right: 10px; width: 20%; font-size: 0.9em; color: #2b6777" class="kdate"  name="paivaA">';


                echo'<b style="margin-right: 5px; color: ">Klo:</b>
    
               <input type="text"  name="kelloA" style="width: 20%; color: #2b6777" class="kello">
                                   	
      <input type="hidden" name="jarjestys" value=' . $sid . '>
      
	<input type="submit" style="margin-left:10px; padding: 4px 6px; " value="Tallenna" class="myButton8" name="tallennaA"  title="Tallenna avautumisaika">';
            }
            echo'<br><br>';





            if ($sulkeutuu != NULL) {
                if ($nyt > $sulkeutuu) {
                    echo'<b style=" margin-right: 20px; color: #e608b8">Kyselylomake on sulkeutunut ';
                } else {
                    echo'<b style="margin-right: 20px; color: #e608b8">Kyselylomake sulkeutuu ';
                }


                echo'&nbsp&nbsp&nbsp' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '.</b>';
                 echo'<input type="hidden" name="kelloS" value='.$sulkeutumiskello.'>';
                        echo'<input type="hidden" name="paivaS" value='.$sulkeutumispaiva.'>';
                echo'<input type="submit" style="margin-left: 10px; padding: 4px 6px" value="Muokkaa" class="myButton8" name="muokkaaS"  title="Muokkaa sulkeutumisaikaa">';
            } else {
                echo'<p style="margin: 2px 0px 2px 0px; font-weight: bold; color: #e608b8;">Aseta sulkeutumisajankohta kyselylomakkeelle: </p>';
                echo'<b style="margin-right: 5px; color:  ">Pvm:</b>
     
            <input type="text" style="margin-right: 10px; width: 20%;color: #2b6777" class="kdate"  name="paivaS">';


                echo'<b style="margin-right: 5px; color: ">Klo:</b>
    
               <input type="text"  name="kelloS" style="width: 20%; color: #2b6777" class="kello">
                                   	
      <input type="hidden" name="jarjestys" value=' . $sid . '>
      
	<input type="submit" style=" margin-left:10px; padding: 4px 6px;" value="Tallenna" class="myButton8" name="tallennaS"  title="Tallenna sulkeutumisaika"><br><br>';
            }

            echo'</form>';
                                echo'<b style="font-size: 0.9em;  color: #e608b8;">Tuleeko vastaukset nimettömänä?</b>';
                if (!$result = $db->query("select distinct nimella from kyselyt where kurssi_id = '" . $_SESSION[KurssiId] . "' AND nimella = 0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                echo'<form id="form2" name="form2" style="font-size: 0.9em" method="post" action="kyselynimella.php">';
                if ($result->num_rows != 0) {


                      echo'<p style="display: inline-block; margin-right: 20px"><input type="radio" name="nimella" onchange="this.form.submit();" value="0" checked>&nbsp Kyllä</p>';
                   
                    echo'<p style="display: inline-block"><input type="radio" name="nimella" onchange="this.form.submit();" value="1">&nbsp Ei</p>';
                
                    
                } else {
                    echo'<p style="display: inline-block; margin-right: 20px"><input type="radio" name="nimella" onchange="this.form.submit();" value="0">&nbsp Kyllä</p>';
                   
                    echo'<p style="display: inline-block"><input type="radio" name="nimella" onchange="this.form.submit();" value="1" checked>&nbsp Ei</p>';
                
                    
                }
                echo'</form><br>';
            ?>


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
                        minTime: new Date(0, 0, 0, 0, 0, 0),
                        maxTime: new Date(0, 0, 0, 23, 59, 0),
                        // time entries start being generated at 6AM but the plugin 
                        // shows only those within the [minTime, maxTime] interval

                        // the value of the first item in the dropdown, when the input
                        // field is empty. This overrides the startHour and startMinute 
                        // options
                        startTime: new Date(0, 0, 0, 0, 0, 0),

                        // items in the dropdown are separated by at interval minutes
                        interval: 15
                    });


                })();


            </script>

            <?php
session_start(); 


            ob_start();

            if (!$haearvioinnit = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($haearvioinnit->num_rows != 0) {
                echo'<br><form action="tarkastelekyselyt.php" method="get" style="display: inline-block"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike"  title="Tarkastele vastauksia" value="🕵 Tarkastele vastauksia" class="myButtonTarkastele"  role="button" ></form>';

           
//                echo'<b id="ohje"> Kyselylomakkeen vastaukset tulee oletuksena nimettömänä.</b>';
            }


            echo' <div class="cm8-margin-top"></div>';
            if ($haearvioinnit->num_rows != 0) {
                echo'<form action="uusikyselyvarmistus.php" method="post" style="display: inline-block"><input type="hidden" name="monesko" value=' . $monesko . '><input type="submit" name="painike" value="&#9998 Muokkaa"  title ="Muokkaa kyselylomaketta" class="myButton9"  role="button"  style="padding:2px 4px; margin-bottom: 20px; margin-top: 20px"></form>';
            } else {
                echo'<form action="uusikyselyvarmistus.php" method="post" style="display: inline-block"><input type="hidden" name="monesko" value=' . $monesko . '><input type="submit" name="painike" value="+ Lisää kysymyksiä"  title ="Lisää kysymyksiä" class="myButton9"  role="button"  style="padding:4px 6px; font-size: 1em"></form>';
            }
            echo'<div class="cm8-responsive" style="padding-right: 10px">';
            echo '<table id="mytable" class="cm8-uusitableia" style="table-layout:fixed; max-width: 100%;"> ';
            echo '<tbody>';

            while ($rowt = $haearvioinnit->fetch_assoc()) {


                if ($rowt[aihe] == 1) {

                    echo '<tr class="iaihe2"><td>' . $rowt[otsikko] . '</td></tr>';
                } else if ($rowt[valiaihe] == 1) {

                    echo '<tr class="ivaliaihe"><td>' . $rowt[otsikko] . '</td></tr>';
                } else {
                    if ($rowt[pakollinen] == 1) {
                        echo '<tr class="isisalto2"><td>' . $rowt[sisalto] . '<b style="margin-left: 40px; font-style: normal; font-weight: normal; color: #e608b8">* Pakollinen</b></td></tr>';
                    } else {
                        echo '<tr class="isisalto2"><td>' . $rowt[sisalto] . ' <b style="margin-left: 40px; font-style: normal; font-weight: normal; color: green">Vapaaehtoinen</b></td></tr>';
                    }
                }
            }
            echo "</tbody></table></div>";
            if ($haearvioinnit->num_rows != 0) {
                echo'<form action="uusikyselyvarmistus.php" style="margin-top: 10px" method="post" ><input type="hidden" name="monesko" value=' . $monesko . '><input type="submit" name="painike" value="&#9998 Muokkaa"  title ="Muokkaa kyselylomaketta" class="myButton9"  role="button"  style="padding:2px 4px; margin-top: 20px"></form>';
            }
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


        echo' <div class="cm8-margin-top" id="cm"></div>';







        echo'</div>';
    }




//opiskelija
    else {

        echo'</div>';
        echo'<div class="cm8-twothird">';

        if (!$onkoprojekti = $db->query("select * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if ($onkoprojekti->num_rows == 0) {



            echo'<br><br><p id="ohje">Ei kyselylomaketta</p><br><br>';
        } else {

            if (!$haearvioinnit = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if (!$haearvioinnit2 = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "' AND aihe=0 ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowt2 = $haearvioinnit2->fetch_assoc()) {

                if (!$haekp2 = $db->query("select distinct * from kyselytkp where kyselyt_id='" . $rowt2[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'"
                        . " AND id IN (select MIN(id) from kyselytkp where kyselyt_id='" . $rowt2[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "')")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowkp2 = $haekp2->fetch_assoc()) {

                    $tallennettu = $rowkp2[tallennettu];
                }
            }

//INFORUUTU
            if (!$haeinfo = $db->query("select distinct kyselyinfo as info from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowv = $haeinfo->fetch_assoc()) {
                $viesti = $rowv[info];
            }

            if ($viesti != '' && $viesti != '<br>' && $viesti != '<div><br></div>') {
                echo'<div style="margin-top: 10px;  max-width: 60%; " class="cm8-responsive cm8-ilmoitus" id="info">';

                echo htmlspecialchars_decode($viesti);
                echo'</div>';
            }

            if (!$RTsuljettu = $db->query("select distinct sulkeutuu, aukeaa from kyselyt where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $nyt = date("Y-m-d H:i");

            while ($RTs = $RTsuljettu->fetch_assoc()) {
                $sulkeutuu = $RTs[sulkeutuu];
                $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
                $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
                $sulkeutumiskello = substr($sulkeutuu, 11, 5);

                $avautuu = $RTs[aukeaa];

                $avautumispaiva = substr($avautuu, 0, 10);
                $avautumispaiva = date("d.m.Y", strtotime($avautumispaiva));
                $avautumiskello = substr($avautuu, 11, 5);
            }

            $aukiok = 1;
            $sulkuok = 1;

            if ($avautuu != NULL) {
                echo'<br>';
                if ($avautuu > $nyt) {
                    echo'<p style=" color:#e608b8; font-weight: bold">Kyselylomake avautuu ';
                    $aukiok = 0;
                } else {
                    echo'<p style="color: #e608b8; font-weight: bold">Kyselylomake avautui ';
                }

                echo'&nbsp&nbsp&nbsp' . $avautumispaiva . ' klo ' . $avautumiskello . '</p>';
            } else {
                echo'<br>';
            }

            if ($sulkeutuu != NULL) {

                if ($sulkeutuu > $nyt) {
                    echo'<p style="color:#e608b8; font-weight: bold">Kyselylomake sulkeutuu ';
                } else {
                    echo'<p style="color:#e608b8; font-weight: bold">Kyselylomake on sulkeutunut ';
                    $sulkuok = 0;
                }

                echo'&nbsp&nbsp&nbsp' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</p>';
            } else {
                
            }

            echo'<br>';

            if ($tallennettu == 0 && $aukiok == 1) {

                if ($sulkuok == 1) {
                     if (!$result = $db->query("select distinct nimella from kyselyt where kurssi_id = '" . $_SESSION[KurssiId] . "' AND nimella = 0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($result->num_rows != 0) {
                       echo'<b id="ohje" style="font-size: 1em"> Kyselylomakkeen vastaukset tulee nimettömänä.</b>';
                }
               
                 
                }

                echo'<div class="cm8-responsive" style="overflow-y: hidden">';


                echo'<form name="Form" id="myForm" action="tallennakyselyt.php" onSubmit="return validateFormItse();" method="post">';
                echo'<br><br>';

                echo'<div class="cm8-responsive">';
                echo '<table id="mytable2" class="cm8-tableoppilas" style="table-layout:fixed; max-width: 100%; font-size: 1em"> ';


                echo '<tbody>';

                while ($rowt = $haearvioinnit->fetch_assoc()) {

                    if (!$haekp = $db->query("select distinct * from kyselytkp where kyselyt_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'"
                            . " AND id IN (select MIN(id) from kyselytkp where kyselyt_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "')")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    if ($rowt[aihe] == 1)
                        echo '<tr class="iaihe2"><td style="border-left: 1px solid grey; padding: 6px 8px;"><b>' . $rowt[otsikko] . '</b></td><td></td></tr>';
                    else if ($rowt[valiaihe] == 1)
                        echo '<tr class="ivaliaihe2"><td style="border-left: 1px solid grey; padding: 6px 8px;"><b>' . $rowt[otsikko] . '</b></td><td></td></tr>';

                    else {

                        while ($rowkp = $haekp->fetch_assoc()) {


                            if ($rowt[id] == $_GET[minne]) {

                                $rowkp[teksti] = str_replace('<br />', "", $rowkp[teksti]);

                                if ($rowt[pakollinen] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" class="isisalto2"><td style="text-align: center; border: 1px solid grey"><textarea class="pakollinen" name="kommentti[]" cols="50"  rows="4" style="font-size: 1em" autofocus>' . $rowkp[teksti] . '</textarea></td><td><b style="font-size:0.9em; font-style: normal; color: #e608b8">* Pakollinen</b></td></tr>';
                                } else {
                                    echo '<tr id="' . $rowt[id] . '" class="isisalto2"><td style="text-align: center; border: 1px solid grey"><textarea name="kommentti[]" cols="50"  rows="4" style="font-size: 1em" autofocus>' . $rowkp[teksti] . '</textarea></td><td><b style="font-size:0.9em; font-style: normal; color: green">Vapaaehtoinen</b></td></tr>';
                                }




                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            } else {

                                $rowkp[teksti] = str_replace('<br />', "", $rowkp[teksti]);
                                if ($rowt[pakollinen] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" class="isisalto2"><td style="border: 1px solid grey"><textarea class="pakollinen" name="kommentti[]" cols="50" rows="4" style="font-size: 1em">' . $rowkp[teksti] . '</textarea><div class="muuta"></div></td><td><b style="font-size:0.9em; font-style: normal; color: #e608b8">* Pakollinen</b></td></tr>';
                                } else {
                                    echo '<tr id="' . $rowt[id] . '" class="isisalto2"><td style="border: 1px solid grey"><textarea name="kommentti[]" cols="50" rows="4" style="font-size: 1em">' . $rowkp[teksti] . '</textarea></td><td><b style="font-size:0.9em; font-style: normal; color: green">Vapaaehtoinen</b></td></tr>';
                                }



                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            }
                        }
                    }
                }

                echo "</tbody></table>";
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

                if ($aukiok == 1 && $sulkuok == 1 && $tallennettu == 0) {

                    if (!$haet = $db->query("select teksti from kyselytkp where kayttaja_id='" . $_SESSION["Id"] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    $onkot = 0;
                    while ($rowt = $haet->fetch_assoc()) {
                        if ($rowt[teksti] != '') {
                            $onkot = 1;
                        }
                    }
                    if ($onkot == 1) {
                        echo'<br><input type="submit" name="painiket" value="&#10147 Lähetä vastaukset" class="myButton8"  role="button"  style="display: inline-block; margin-left: 5px; padding:4px 6px; margin-right: 60px; font-size: 1em">';
                        echo'<button name="poista" class="myButton8" type="submit" style="background-color: #e608b8; font-size: 1em"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista vastaukset</button><br><br>';
                    } else {
                        echo'<br><input type="submit" name="painiket" value="&#10147 Lähetä vastaukset" class="myButton8"  role="button"   style="margin-left: 5px; padding:4px 6px; font-size: 1em"><br><br>';
                    }
                }

                echo'</form>';
            }else if ($tallennettu == 1 && $_GET[tarkastele]==1) {
                        echo'<div class="cm8-responsive" style="overflow-y: hidden">';


   echo'<a  href="kysely.php?tarkastele=0"  class="myButton8"  role="button"  style="padding:6px 8px; ">Piilota vastaukset</a></td></tr>';
                
                echo'<div class="cm8-responsive">';
                echo '<table id="mytable2" class="cm8-tableoppilas" style="table-layout:fixed; max-width: 100%;"> ';


                echo '<tbody>';

                while ($rowt = $haearvioinnit->fetch_assoc()) {

                    if (!$haekp = $db->query("select distinct * from kyselytkp where kyselyt_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'"
                            . " AND id IN (select MIN(id) from kyselytkp where kyselyt_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "')")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    if ($rowt[aihe] == 1)
                        echo '<tr class="iaihe2"><td style="border-left: 1px solid grey; padding: 6px 8px;"><b>' . $rowt[otsikko] . '</b></td><td></td></tr>';
                    else if ($rowt[valiaihe] == 1)
                        echo '<tr class="ivaliaihe2"><td style="border-left: 1px solid grey; padding: 6px 8px;"><b>' . $rowt[otsikko] . '</b></td><td></td></tr>';

                    else {

                        while ($rowkp = $haekp->fetch_assoc()) {


                                $rowkp[teksti] = str_replace('<br />', "", $rowkp[teksti]);

                                if ($rowt[pakollinen] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" class="isisalto2"><td style="font-style: normal;border: 1px solid grey">' . $rowkp[teksti] . '</td><td><b style="font-size:0.9em; font-style: normal; color: #e608b8">* Pakollinen</b></td></tr>';
                                } else {
                                    echo '<tr id="' . $rowt[id] . '" class="isisalto2"><td style="font-style: normal;border: 1px solid grey">' . $rowkp[teksti] . '</td><td><b style="font-size:0.9em; font-style: normal; color: green">Vapaaehtoinen</b></td></tr>';
                                }

                     
                        }
                    }
                }

                echo "</tbody></table>";
                   echo'<a  href="kysely.php?tarkastele=0"  class="myButton8"  role="button"  style="padding:6px 8px; margin-top: 10px">Piilota vastaukset</a></td></tr>';
                
            } 
            else if ($tallennettu == 1 && $_GET[tarkastele]!=1) {

                echo'<br><p style="font-size: 1.1em; display: inline-block">Olet lähettäny vastaukset.</p>';
                if ($aukiok == 1 && $sulkuok == 1) {

                    echo'<a  href="korjaa_kysely.php"  class="myButton8"  role="button"  style="padding:2px 4px; margin-left: 30px">&#9998 &nbspMuokkaa vastauksia</a></td></tr>';
                
                    
                }
                else{
                    
                    echo'<a  href="kysely.php?tarkastele=1"  class="myButton8"  role="button"  style="padding:6px 8px; margin-left: 30px">Katso omat vastaukset</a></td></tr>';
                
                }
            } else if ($aukiok == 0) {
                echo'<b id="ohje">Kyselylomakkeen vastausmahdollisuus ei ole vielä auennut.</b>';
            }
        }
        echo'</div>';
        echo'</div>';
    }




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

</body>
</html>		