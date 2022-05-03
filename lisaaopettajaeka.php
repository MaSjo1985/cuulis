<?php
session_start(); 


ob_start();

echo'<!DOCTYPE html><html>
<head>
<title> Lisää opettaja kurssille/opintojaksolle </title>
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



    echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 60px">';
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




        echo '<div class="cm8-container3" style="padding-top: 0px">';
        echo' <h4>Lisää opettaja kurssille/opintojaksolle</h4>';
        echo '<a href="osallistujat.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';

        if (!$result = $db->query("select distinct kayttajat.id as kaid, etunimi, sukunimi, sposti from kayttajat, kayttajankoulut where kayttajat.tarkistettu=1 AND kayttajankoulut.kayttaja_id=kayttajat.id AND kayttajankoulut.koulu_id ='" . $_SESSION["kouluId"] . "' AND kayttajankoulut.odottaa=1 AND kayttajat.id<>'" . $_SESSION["Id"] . "' AND kayttajat.rooli='opettaja' ORDER BY kayttajat.sukunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$result2 = $db->query("select distinct kayttajat.id as kaid, etunimi, sukunimi, sposti from kayttajat, kayttajankoulut where kayttajat.tarkistettu=1 AND kayttajankoulut.kayttaja_id=kayttajat.id AND kayttajankoulut.koulu_id ='" . $_SESSION["kouluId"] . "' AND kayttajankoulut.odottaa=1 AND kayttajat.id<>'" . $_SESSION["Id"] . "' AND kayttajat.rooli='opettaja' ORDER BY kayttajat.sukunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $array = array();
        $array2 = array();
        if (!$haekurssinopettajat = $db->query("select distinct kayttajat.id as kaid from kayttajat, opiskelijankurssit, kurssit where opiskelijankurssit.opiskelija_id=kayttajat.id AND opiskelijankurssit.kurssi_id = '" . $_SESSION["KurssiId"] . "' AND projekti_id=0 AND itseprojekti_id=0 AND kayttajat.rooli='opettaja' AND (opiskelijankurssit.ope=1 || (kurssit.opettaja_id=kayttajat.id AND opiskelijankurssit.ope=0))")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haekurssinopettajat2 = $db->query("select distinct kayttajat.id as kaid from kayttajat, opiskelijankurssit, kurssit where opiskelijankurssit.opiskelija_id=kayttajat.id AND opiskelijankurssit.kurssi_id = '" . $_SESSION["KurssiId"] . "' AND projekti_id=0 AND itseprojekti_id=0 AND kayttajat.rooli='opettaja' AND (opiskelijankurssit.ope=1 || (kurssit.opettaja_id=kayttajat.id AND opiskelijankurssit.ope=0))")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowkaikki = $haekurssinopettajat->fetch_assoc()) {
            array_push($array, $rowkaikki[kaid]);
        }
        while ($rowkaikki2 = $haekurssinopettajat2->fetch_assoc()) {
            array_push($array2, $rowkaikki2[kaid]);
        }


        $loyty = false;

        while ($row2 = $result->fetch_assoc()) {
            if (!empty($array2)) {
                foreach ($array2 as $onid2) {
                    if ($row2[kaid] != $onid2) {
                        $loyty = true;
                    }
                }
            } else {
                $loyty = true;
            }
        }
        if (!$loyty)
            echo '<br><b style="color: #e608b8;">Oppilaitoksessa ei ole opettajia, joita voisi lisätä kurssille/opintojaksolle.</b><br>';

        else {

            echo'&#128270 <input type="search"  onkeyup="showResult9(this.value)" name="search"   id="search_box" class="haku" style="width: 25%">';

		 echo'<div  id="piilota100" ><br><br></div>';	
            echo'<div style="margin-top: 0px; margin-bottom: 0px" id="searchresults">
<ul id="results" class="update">
</ul></div>';
            echo'<div id="scrollbar"><div id="spacer"></div></div>';
            echo'<form action="lisaaopettajavarmistus.php" method="post">';

            echo'<div class="cm8-responsive" id="piilota">';
            echo'<input type="submit" value="+ Lisää" title="Lisää opettaja kurssille/opintojaksolle" id="piilota3" class="myButton8" style="font-size: 0.9em; padding: 2px 4px; margin-left: 5px; margin-top: 5px"><br>';

      echo '<table id="mytable" class="cm8-striped cm8-uusitable18" style="font-size: 0.9em; font-weight: bold; table-layout:fixed; min-width: 40%; max-width: 100% "><thead>';

            echo '<tr><th style="padding-left: 6px">Valitse<br>&nbsp&#9661&nbsp</th><th>Sukunimi</th><th>Etunimi</th></tr>';
            echo'</thead><tbody>';

            while ($row = $result2->fetch_assoc()) {

                if (!empty($array)) {

                    $loyty2 = false;
                    foreach ($array as $onid) {
                        if ($row[kaid] == $onid) {
                            $loyty2 = true;
                        }
                    }
                    if (!$loyty2)
                        echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista10[]" value=' . $row[kaid] . ' ></td><td><a style="color: #2b6777; " href="kayttaja.php?url=lisaaopettajaeka.php&ka=' . $row[kaid]. '">' . $row[sukunimi] . '</a></td><td><a style="color: #2b6777; " href="kayttaja.php?url=lisaaopettajaeka.php&ka=' . $row[kaid]. '">' . $row[etunimi] . '</a></td></tr>';
                }
                else {
                    echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista10[]" value=' . $row[kaid] . ' ></td><td><a style="color: #2b6777; " href="kayttaja.php?url=lisaaopettajaeka.php&ka=' . $row[kaid]. '">' . $row[sukunimi] . '</a></td><td><a style="color: #2b6777; " href="kayttaja.php?url=lisaaopettajaeka.php&ka=' . $row[kaid]. '">' . $row[etunimi] . "</a></td></tr>";
                }
            }

        
         echo'<tr style="border: none; background-color:  #2b6777"><td style="border: none;text-align: left; padding-top: 10px; margin-left: 0px; padding-left: 0px"> <input title="Lisää opettaja kurssille/opintojaksolle" type="submit" value="+ Lisää" class="myButton8" style="padding: 2px 4px; font-size: 1em; margin-top: 10px"></td><td style="border: none;"></td><td style="border: none;"></td></tr>';

            echo "</tbody></table>";
  

        echo'</form></div></div>';
            
        }
    }
         echo'</div>';
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
<script src="js/jquery-2.1.3.js"></script>
<script src="js/tableHeadFixer.js"></script>
<script>
    //ilman tätä mikään muu ei toimi kuin scrolli

    $("#mytable").tableHeadFixer({"head": false, "left": 1});

</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
<script>
    var j = jQuery.noConflict();
    var $table = j('#mytable');

    $table.floatThead({zIndex: 1});


</script>        
<script>


    $("#scrollbar").on("scroll", function () {


        var container = $("#piilota");

        var scrollbar = $("#scrollbar");

        ScrollUpdate(container, scrollbar);

    });


    function ScrollUpdate(content, scrollbar) {

        $("#spacer").css({"width": "1000px"}); // set the spacer width'
        // set the spacer width
        scrollbar.width = content.width() + "px";
        content.scrollLeft(scrollbar.scrollLeft());
    }


    ScrollUpdate($("#piilota"), $("#scrollbar"));

</script>



</body>
</html>	