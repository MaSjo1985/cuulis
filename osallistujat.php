<?php
session_start(); 


ob_start();

echo'<!DOCTYPE html><html> 
<head>
<title> Osallistujat </title>
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
    include("kurssisivustonheader.php");




    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px;">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	   
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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
	  <a href="osallistujat.php" class="currentLink"  >Osallistujat</a>  	  
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
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '" >Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
		  
		  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
			
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
	  <a href="osallistujat.php"  class="currentLink" >Osallistujat</a>  	  
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
    echo '<div class="cm8-container3" style="padding-top: 10px">';
    echo'<div class="cm8-third" style="width: 20%; margin-top: 30px">';
    echo' <h2>Osallistujat</h2>';

    echo'</div>';

    echo'<div class="cm8-twothird" style="padding-top: 0px; margin-top: 10px; width: 79%">';


    if (!$tulos22 = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from kurssit, kayttajat where kurssit.id='" . $_SESSION["KurssiId"] . "' AND kurssit.opettaja_id=kayttajat.id")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($rivi22 = $tulos22->fetch_assoc()) {
        $etunimi = $rivi22[etunimi];
        $sukunimi = $rivi22[sukunimi];
        $id = $rivi22[kaid];
    }

    $akt = 0;

    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
               echo'<p style="font-weight: bold; display: inline-block; margin-right: 60px;font-size: 1.2em">Opettajat:</p>';
        echo'<a href="lisaaopettajaeka.php" class="myButton98">+ Lisää opettajia kurssille/opintojaksolle</a>';
        echo'<br>';
        
    } else {
              echo'<p style="font-weight: bold; font-size: 1.2em">Opettajat:</p>';
    }
    if ($_SESSION["Muutopet"] == 1) {
        if (!$tulos88 = $db->query("select distinct etunimi, sukunimi, kayttajat.id as kaid from kayttajat, opiskelijankurssit where ope=1 AND opiskelijankurssit.opiskelija_id=kayttajat.id AND opiskelijankurssit.kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttajat.rooli='opettaja'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $lkm = $tulos88->num_rows;
        

        if ($lkm == 0) {

        echo'<p style="padding: 10px 40px 10px 8px ;background-color:  #f7f9f7;display: inline-block; margin-right: 20px"  ><a id="title" href="kayttaja.php?url=osallistujat.php&ka=' . $id. '"> ' . $etunimi . ' ' . $sukunimi . '</a></p>';


            if ($_SESSION["Id"] != $id) {
                echo'<a id="title2" href="viestikayttajalle2.php?url=osallistujat.php&id=' . $id . '"  title="Lähetä viesti käyttäjälle" >📧 &nbsp </a></b>';
            }
            
        } else {

            echo '<br><b>Vastuuopettaja:</b><br>';
  echo'<p style="padding: 10px 40px 10px 8px ;background-color:  #f7f9f7;display: inline-block; margin-right: 20px"  ><a id="title" href="kayttaja.php?url=osallistujat.php&ka=' . $id. '"> ' . $etunimi . ' ' . $sukunimi . '</a></p>';


            if ($_SESSION["Id"] != $id) {
                echo'<a id="title2" href="viestikayttajalle2.php?url=osallistujat.php&id=' . $id . '"  title="Lähetä viesti käyttäjälle" >📧 &nbsp </a></b>';
            }

              echo '<br><br><b>Muut opettajat:</b><br>';
            $laskuri = 0;

            while ($rivi88 = $tulos88->fetch_assoc()) {
                $laskuri++;

                echo'<p style="padding: 10px 40px 10px 8px ;background-color:  #f7f9f7;display: inline-block; margin-right: 20px"  ><a id="title" href="kayttaja.php?url=osallistujat.php&ka=' . $rivi88[kaid]. '"> ' . $rivi88[etunimi] . ' ' . $rivi88[sukunimi] . '</a>';
      if ($_SESSION["Id"] == $id || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin")
                        echo'<a href="poistaopevarmistus.php?url=' . $url . '&id=' . $rivi88[kaid] . '"  style="margin-left: 20px; " id="title3" title="Poista opettaja"><i class="fa fa-trash-o"><b class="title3"></b></i> </a></b>';
                echo'</p>';

            if ($_SESSION["Id"] != $rivi88[kaid]) {
                echo'<a id="title2" href="viestikayttajalle2.php?url=osallistujat.php&id=' . $rivi88[kaid] . '"  title="Lähetä viesti käyttäjälle" >📧 &nbsp </a></b>';
           
                
            }

            }
        }
    }
    else {
        echo $etunimi . ' ' . $sukunimi;
        if ($_SESSION["Id"] != $id)
            echo'<b><a href="viestikayttajalle2.php?url=' . $url . '&id=' . $id . '" style="padding: 0px 4px; margin-left: 60 px" title="Lähetä viesti käyttäjälle">📧 &nbsp &nbsp Lähetä viesti</a></b>';
    }
    echo '<div class="cm8-margin-top"></div>';


    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
             echo'<p style="font-weight: bold; display: inline-block; margin-right: 60px;font-size: 1.2em">Opiskelijat:</p>';

        echo'<a href="lisaaopiskelijaeka.php" class="myButton98" style="margin-right: 20px">+ Lisää opiskelijoita kurssille/opintojaksolle</a>';

        if (!$resultyht = $db->query("select distinct  kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND opiskelijankurssit.projekti_id=0 AND opiskelijankurssit.itseprojekti_id=0 AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        echo'<br><p style="display: inline-block; margin-right: 10px">Opiskelijoita on yhteensä: </p>' . $resultyht->num_rows;
        
        echo'<br><a href="excel4.php?kurssi=' . $_SESSION[KurssiId] . '" class="myButtonLataa"  role="button"  style="padding:6px 6px 4px 6px; font-size: 0.8em"><i class="fa fa-download" style="font-size:0.8em"></i> &nbsp&nbsp Lataa opiskelijalista </a>';
    
        echo'<br><br>';
    } else {
         echo'<p style="font-weight: bold; font-size: 1.2em">Opiskelijat:</p>';
    }



    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

        $field2 = 'sukunimi';
        $sort2 = 'DESC';
        $nuoli2 = "&#8661";
        if (isset($_GET['sorting2'])) {

            if ($_GET['sorting2'] == 'ASC') {
                $sort2 = 'DESC';
            } else {
                $sort2 = 'ASC';
            }
        }
        if ($_GET['field2'] == 'sukunimi') {
            $field2 = "sukunimi";
        } elseif ($_GET['field2'] == 'etunimi') {
            $field2 = "etunimi";
        }

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, tavoite, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND opiskelijankurssit.projekti_id=0 AND opiskelijankurssit.itseprojekti_id=0 AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($result->num_rows == 0)
            echo"<br><br>Ei opiskelijoita.<br>";
        else {
         echo'<br><form action="poistakurssiltavarmistus.php" method="post">';

                echo'<div class="cm8-responsive" id="piilota">';
                echo'<div id="scrollbar"><div id="spacer"></div></div>';

                echo '<table id="mytable" class="cm8-striped cm8-uusitable18" style="font-size: 0.9em; font-weight: bold; table-layout:fixed; min-width: 40%; max-width: 100% "><thead>';

            if ($_GET[kaikki2] == 'joo') {

      
                    echo '<tr><th><a href="osallistujat.php?kaikki2=ei" > Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th>Sukunimi</th><th>Etunimi</th></tr></thead><tbody>';

                    while ($row = $result->fetch_assoc()) {
                    
                        echo '<tr><td><input type="checkbox" name="lista[]" value=' . $row[kaid] . ' checked></td><td><a style="color: #2b6777; " href="kayttaja.php?url=osallistujat.php&ka=' . $row[kaid]. '">' . $row[sukunimi] . '</a></td><td><a style="color: #2b6777; " href="kayttaja.php?url=osallistujat.php&ka=' . $row[kaid]. '">' . $row[etunimi] . '</a></td>';
                       
                        echo'</tr>';
                    }
                

            } else {


     

                    echo '<tr><th><a href="osallistujat.php?kaikki2=joo"> Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th>Sukunimi</th><th>Etunimi</th></tr></thead></tbody>';

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr><td><input type="checkbox" name="lista[]" value=' . $row[kaid] . ' ></td><td><a style="color: #2b6777; " href="kayttaja.php?url=osallistujat.php&ka=' . $row[kaid]. '">' . $row[sukunimi] . '</a></td><td><a style="color: #2b6777; " href="kayttaja.php?url=osallistujat.php&ka=' . $row[kaid]. '">' . $row[etunimi] . '</a></td>';

                        echo'</tr>';
                    }




            
            }
            
                echo "</tbody></table>";
                echo'</div>';
             
                echo'<br><button class="pieniroskis" title="Poista kurssilta/opintojaksolta"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button>';
                echo'</form>';
        }
    }

    if ($_SESSION["Rooli"] == 'opiskelija') {
        $field2 = 'sukunimi';
        $sort2 = 'DESC';
        $nuoli2 = "&#8661";
        if (isset($_GET['sorting2'])) {

            if ($_GET['sorting2'] == 'ASC') {
                $sort2 = 'DESC';
            } else {
                $sort2 = 'ASC';
            }
        }
        if ($_GET['field2'] == 'sukunimi') {
            $field2 = "sukunimi";
        } elseif ($_GET['field2'] == 'etunimi') {
            $field2 = "etunimi";
        }

        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND opiskelijankurssit.projekti_id=0 AND opiskelijankurssit.itseprojekti_id=0 AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($result->num_rows == 0)
            echo"<br><br>Ei opiskelijoita.<br>";
        else {
                 echo'<div class="cm8-responsive" id="piilota">';
                echo'<div id="scrollbar"><div id="spacer"></div></div>';

                echo '<table id="mytable" class="cm8-striped cm8-uusitable18" style="font-size: 0.9em; font-weight: bold; table-layout:fixed; min-width: 40%; max-width: 100% "><thead>';
    
               echo '<tr><th>Sukunimi</th><th>Etunimi</th></tr></thead></tbody>';
             
                while ($row = $result->fetch_assoc()) {
                    echo '<tr><td><a style="color: #2b6777; " href="kayttaja.php?url=osallistujat.php&ka=' . $row[kaid]. '">' . $row[sukunimi] . '</a></td><td><a style="color: #2b6777; " href="kayttaja.php?url=osallistujat.php&ka=' . $row[kaid]. '">' . $row[etunimi] . '</a></td>';

                    echo'</tr>';
                }
                echo "</tbody></table>";
                echo'</div>';

                echo "<br>";
            
        }
    }

    echo'</div>';
    echo'</div>';
    ?>
    <script src="js/jquery-2.1.3.js"></script>
    <script src="js/tableHeadFixer.js"></script>
    <script>
        //ilman tätä mikään muu ei toimi kuin scrolli

        $("#mytable").tableHeadFixer({"head": false, "left": 1});

    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
    <script>
        var $table = $('#mytable');

        $table.floatThead({zIndex: 1});

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