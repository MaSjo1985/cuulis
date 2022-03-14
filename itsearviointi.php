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

    if (!$haeonkovanha = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($haeonkovanha->num_rows == 0) {
        header('location: ia.php');
    }

    include("kurssisivustonheader.php");

    include "libchart/libchart/classes/libchart.php";

    echo '<div class="cm8-container7" id="paluu" style="margin-top: 0px; padding-top:0px; padding-bottom: 30px; margin-bottom: 0px; ">';

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


    echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 0px; border: none">';


    echo'<div class="cm8-third" style="padding-left: 20px; width: 25% "><h2 style="display: inline-block; padding-top: 0px; padding-left: 0px; padding-bottom: 0px" id="lisaa">Itsearviointi</h2>';



    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

        if (!$onkoprojekti = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "' AND itsearviointi=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        ;
        if ($onkoprojekti->num_rows != 0) {


            echo'<form action="varmistusitsearviointi.php" method="post" style="display: inline-block; margin-left: 20px"><button class="roskis" title="Poista itsearviointi"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button></form>';
        }



        echo'</div>';

        echo'<div class="cm8-twothird" >';





        if (!$onkoprojekti = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "' AND itsearviointi=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if ($onkoprojekti->num_rows == 0) {



            echo'<br><em id="ohje">Sivustolle on mahdollista luoda kurssikohtainen itsearviointilomake, jota opiskelijat voivat muokata.</em><br><br>';


            echo'<br><form action="uusi_itsearviointieka.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää itsearviointilomake" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
        } else {



//INFORUUTU
            if (!$haeinfo = $db->query("select distinct infoitsearviointi from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowv = $haeinfo->fetch_assoc()) {
                $viesti = $rowv[infoitsearviointi];
            }

            echo'<div class="cm8-responsive cm8-ilmoitus" id="info_ope" style="margin-top: 10px">';
            echo'<div class="cm8-responsive" style="padding: 0px; margin: 0px">';

            echo '<form action="ilmoitus.php" method="post" id="infomuokkaus"><input type="hidden" name="kuvaus" value=' . $kuvaus . '><input type="submit" name= "painikeia" value="&#9998 Muokkaa" title="Muokkaa sisältöä" class="muokkausinfo"  role="button"  style="padding: 2px 4px; font-size: 0.8em; float: left; margin-bottom: 0px"></form>';

            echo'</div>';


            echo'<div class="cm8-responsive cm8-ilmoitus" style="padding: 20px">';

            echo htmlspecialchars_decode($viesti);
            echo'</div>';
            echo'</div>';

            if (!$RTsuljettu = $db->query("select distinct sulkeutuu from itsearvioinnit where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($RTs = $RTsuljettu->fetch_assoc()) {
                $sulkeutuu = $RTs[sulkeutuu];
            }

            if (!empty($sulkeutuu) && $sulkeutuu != ' ') {

                $nyt = date("Y-m-d H:i");
                $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
                $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
                $sulkeutumiskello = substr($sulkeutuu, 11, 5);

                $takaraja = $sulkeutuu;


                if ($nyt <= $takaraja) {

                    echo'<br><b style="color: #e608b8">Itsearviointilomakkeen muokkaus sulkeutuu ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
                } else {
                    echo'<br><b style="color: #e608b8"> Itsearviointilomakkeen muokkaus on sulkeutunut ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
                }
            } else {
                echo'<p id="ohje" style="display: inline-block">Itsearviointilomakkeen muokkaukselle ei ole asetettu takarajaa.</p>';
            }


            echo'<form action="asetatakarajaitse.php" method="get" style="display: inline-block; margin-left: 20px"><input type="submit" name="painike" value="&#9998 Muokkaa" class="myButton8"  role="button"  style="padding:2px 4px;"></form>';

            if (!$haearvioinnit = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($haearvioinnit->num_rows != 0) {
                echo'<br><br><form action="tarkastelearvioinnit.php" method="get" style="display: inline-block"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" title="Tarkastele opiskelijoiden lomakkeita" value="🕵 Tarkastele opiskelijoiden lomakkeita" class="myButtonTarkastele"  role="button" ></form>';
            }

            echo' <div class="cm8-margin-top"></div>';

            if ($haearvioinnit->num_rows != 0) {
                echo'<form action="uusi_itsearviointivarmistus.php" style="margin-top: 10px" method="post" ><input type="hidden" name="monesko" value=' . $monesko . '><input type="submit" name="painike" value="&#9998 Muokkaa"  title ="Muokkaa itsearviointilomaketta" class="myButton9"  role="button"  style="padding:2px 4px; margin-bottom: 20px; margin-top: 20px"></form>';
            } else {
                echo'<form action="uusi_itsearviointivarmistus.php" method="post" style="display: inline-block"><input type="hidden" name="monesko" value=' . $monesko . '><input type="submit" name="painike" value="&#9998 Lisää itsearviointilomake"  title ="Lisää itsearviointilomake" class="myButton9"  role="button"  style="font-size: 1em; padding:2px 4px"></form>';
            }

            echo'<div class="cm8-responsive" style="padding-right: 10px">';
            echo '<table id="mytable" class="cm8-uusitableia">';
            echo '<tbody>';

            while ($rowt = $haearvioinnit->fetch_assoc()) {


                if ($rowt[aihe] == 1) {

                    echo '<tr class="iaihe2"><td>' . $rowt[otsikko] . '</td></tr>';
                } else if ($rowt[valiaihe] == 1) {

                    echo '<tr class="ivaliaihe2"><td>' . $rowt[otsikko] . '</td></tr>';
                } else {
                    echo '<tr class="isisalto2"><td>' . $rowt[sisalto] . '</td></tr>';
                }
            }
            echo "</tbody></table></div>";
            if ($haearvioinnit->num_rows != 0) {
                echo'<form action="uusi_itsearviointivarmistus.php" style="margin-top: 10px" method="post" ><input type="hidden" name="monesko" value=' . $monesko . '><input type="submit" name="painike" value="&#9998 Muokkaa"  title ="Muokkaa itsearviointilomaketta" class="myButton9"  role="button"  style="padding:2px 4px; margin-top: 20px"></form>';
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

        if (!$onkoprojekti = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "' AND itsearviointi=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if ($onkoprojekti->num_rows == 0) {



            echo'<br><br><em id="ohje">Toimintoa ei ole aktivoitu.</em><br><br>';
        } else {

            if (!$haearvioinnit = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

//INFORUUTU
            if (!$haeinfo = $db->query("select distinct infoitsearviointi from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowv = $haeinfo->fetch_assoc()) {
                $viesti = $rowv[infoitsearviointi];
            }
            if ($viesti != '' && $viesti != '<br>' && $viesti != '<div><br></div>') {
                echo'<div style="margin-top: 10px" class="cm8-responsive cm8-ilmoitus" id="info">';

                echo htmlspecialchars_decode($viesti);
                echo'</div>';
            }

            if (!$RTsuljettu = $db->query("select distinct sulkeutuu from itsearvioinnit where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($RTs = $RTsuljettu->fetch_assoc()) {
                $sulkeutuu = $RTs[sulkeutuu];
            }

            if (!empty($sulkeutuu) && $sulkeutuu != ' ') {
                $nyt = date("Y-m-d H:i");
                $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
                $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
                $sulkeutumiskello = substr($sulkeutuu, 11, 5);

                $takaraja = $sulkeutuu;


                $takarajaon = 1;

                if ($nyt <= $takaraja) {
                    echo'<b style="color: #e608b8">Itsearviointilomakkeen muokkaus sulkeutuu ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
                } else {
                    echo'<b style="color:#e608b8"> Itsearviointilomakkeen muokkaus on sulkeutunut ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
                }
                echo'<br>';
            } else {
                $takarajaon == 0;
            }

            if (!$haearvioinnit8 = $db->query("select distinct * from itsearvioinnit_pisteet where kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttaja_id='" . $_SESSION[Id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowkpp = $haearvioinnit8->fetch_assoc()) {

                $pisteet8 = $rowkpp[pisteet];
                $opetallennus2 = $rowkpp[opetallennus2];
            }
            if ($haearvioinnit8->num_rows != 0 && $opetallennus2 != 0) {
                echo'<button type="button" class="btn btn-info btn-lg btn-radius" style="margin-bottom: 20px; padding: 10px 20px; text-transform: none; font-size: 0.9em" >Olet saanut itsearviointilomakkeesta ' . $pisteet8 . ' pistettä </button>';
            }


            echo'<div class="cm8-responsive" style="overflow-y: hidden">';

            if (($nyt <= $takaraja && $takarajaon == 1) || $takarajaon == 0) {
                echo'<p id="ohje" style="font-weight: bold; color: #e608b8">Huom! Muista tallentaa lomake muokattuasi sitä.</p>';
            }

            echo'<form action="tallennaarvioinnit.php" method="post">';



            echo'<div class="cm8-responsive">';
            echo '<br><table id="mytable2" class="cm8-tableoppilas"><thead>';

            echo '</thead><tbody>';


            while ($rowt = $haearvioinnit->fetch_assoc()) {

                if (!$haekp = $db->query("select distinct * from itsearvioinnitkp where itsearvioinnit_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'"
                        . " AND id IN (select MIN(id) from itsearvioinnitkp where itsearvioinnit_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "')")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($rowt[aihe] == 1)
                    echo '<tr class="iaihe2"><td style="padding: 6px 8px;"><b>' . $rowt[otsikko] . '</b></td><td style=" padding: 6px 8px; text-align:center">Opettajan kommentti</td></tr>';
                else if ($rowt[valiaihe] == 1)
                    echo '<tr class="ivaliaihe2"><td style="padding: 6px 8px;"><b>' . $rowt[otsikko] . '</b></td><td style="padding: 6px 8px;"></td></tr>';

                else {

                    while ($rowkp = $haekp->fetch_assoc()) {

                        if ($rowkp[tallennettu] == 1 || !(($nyt <= $takaraja && $takarajaon == 1) || $takarajaon == 0)) {


                            echo '<tr id="' . $rowt[id] . '" " class="osisalto"><td>' . $rowkp[teksti] . '</td><td>' . $rowkp[kommentti] . '</td></tr>';
                        } else {
                            if ($rowt[id] == $_GET[minne]) {

                                $rowkp[teksti] = str_replace('<br />', "", $rowkp[teksti]);
                                echo '<tr id="' . $rowt[id] . '"  class="osisalto"><td style="text-align: center; "><textarea name="kommentti[]" cols="50"  rows="4" style="font-size: 1em" autofocus>' . $rowkp[teksti] . '</textarea></td><td >' . $rowkp[kommentti] . '</td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            } else {

                                echo '<tr id="' . $rowt[id] . '"  class="osisalto"><td><textarea name="kommentti[]" cols="50" rows="4" style="font-size: 1em">' . $rowkp[teksti] . '</textarea></td><td>' . $rowkp[kommentti] . '</td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                            }
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

            if (($nyt <= $takaraja && $takarajaon == 1) || $takarajaon == 0) {
                echo'<br><br><input type="submit" name="painiket" value="&#10003 Tallenna" class="myButton8"  role="button"  style="padding:4px 6px; display:inline-block; margin-right: 60px" title="Tallenna">';
                echo'<input name="muokkaa" class="myButton8" value="&#9998 Muokkaa vastauksia" type="submit" style="background-color: green; display: inline-block; padding: 4px 6px" title="Muokkaa vastauksia"><br><br>';
            }

            echo'</form>';
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