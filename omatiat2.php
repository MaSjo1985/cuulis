<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Oma itsearviointilomake </title>
<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if(isset($_GET[kurssi])){
        if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}


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

    }
    else{
          include("header.php");
    include("header2.php");

    echo'<div class="cm8-container7">';
    echo'<nav class="topnavoppilas" id="myTopnav">';
    echo'         <a href="etusivu.php" >Etusivu</a> 
<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
     if (x.className === "topnavoppilas") {

        x.className += " responsive";
    } else {
        x.className = "topnavoppilas";
    }

}
</script>     
<a href="omatkurssit.php" >Omat kurssit/opintojaksot</a>
<a href="kurssit.php" >Kaikki kurssit/opintojaksot</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>

<div class="cm8-margin-bottom" style="padding-left: 20px">';  
    }

    if (!$haekurssi = $db->query("select distinct * from kurssit where id='" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($rowP = $haekurssi->fetch_assoc()) {

        $nimi = $rowP[nimi];
        $koodi = $rowP[koodi];
    }
    echo' <h4 style="color: #48E5DA">Itsearviointilomake kurssilta/opintojaksolta &nbsp ' . $koodi . ' ' . $nimi . '</h4>';

    if(isset($_GET[kurssi])){
          echo'<a href="omatiat.php?kurssi=1" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br><br>';
    }
    else{
          echo'<a href="omatiat.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br><br>';
    }
  


    echo'<div class="cm8-responsive" style="margin: 0px; padding: 10px 0px 0px 0px; overflow-y: hidden">';

    if (!$haeonko = $db->query("select distinct * from ia where kurssi_id='" . $_GET[id] . "' ORDER BY jarjestys")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($haeonko->num_rows != 0) {

        if (!$haesarakkeet = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        $onko = $haeonko->num_rows;

        $smaara = $haesarakkeet->num_rows;

        if ($smaara == 1) {
            $divleveys = 50;
        } else {
            $divleveys = 100 / $smaara;
        }

        while ($rows = $haesarakkeet->fetch_assoc()) {

            $sid = $rows[jarjestys];

            echo'<div class="cm8-responsive" style="vertical-align: top; margin: 0px; padding:0px; width:' . $divleveys . '%; display: inline-block">';

            if (!$haekommenttieka = $db->query("select distinct * from iakommentit where (kommentti IS NOT NULL && kommentti<>'' ) AND kurssi_id='" . $_GET[id] . "' AND kayttaja_id='" . $_SESSION[Id] . "' && tallennettu = 1")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($haekommenttieka->num_rows != 0) {
                if (!$haekommentti = $db->query("select distinct * from iakommentit where ia_sarakkeet_jarjestys = '" . $sid . "' AND kurssi_id='" . $_GET[id] . "' AND kayttaja_id='" . $_SESSION[Id] . "' && tallennettu = 1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $kommentti = '';
                while ($rowkom = $haekommentti->fetch_assoc()) {
                    $kommentti = $rowkom[kommentti];
                }

                if ($kommentti != NULL || $kommentti != '') {

                    echo'<p style="margin-bottom: 5px;font-size: 0.7em; font-weight: bold; color:  #48E5DA;">Opettajan kommentit tästä sarakkeesta: </p>';

                    echo'<div style="width: 80%;padding: 6px; height: 60px; overflow: auto; margin: 0px; font-weight:bold; display: inline-block;font-size: 0.7em;border: 2px solid  #48E5DA; border-radius: 10px; color: #2b6777; background-color: white">' . $kommentti . '</div>';
                } else {
                    echo'<p style="margin-bottom: 5px;font-size: 0.7em; font-weight: bold; color:  #2b6777;">Opettajan kommentit tästä sarakkeesta: </p>';

                    echo'<div style="width: 80%; height: 60px; overflow: auto;margin: 0px; font-weight:bold; display: inline-block;font-size: 0.7em; padding: 6px; border: 2px solid  #2b6777; border-radius: 10px; color: #2b6777; ">' . $kommentti . '</div>';
                }
            }


            if (!$haetehtavat = $db->query("select distinct * from ia where kurssi_id='" . $_GET[id] . "' AND ia_sarakkeet_jarjestys='" . $sid . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $onko = $haetehtavat->num_rows;


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

                    while ($rowkp = $haekp->fetch_assoc()) {

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
                    }
                }
            }
            echo "</tbody></table>";






//            }

            echo'</div>';
            $smaara--;
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
        } else {
            
        }
    } else {

        echo'<p id="ohje">Ei itsearviointilomaketta</p><br><br>';
    }
    echo'</div>';
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

</body>
</html>	




