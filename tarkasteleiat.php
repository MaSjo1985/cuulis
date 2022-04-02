<?php
session_start();
ob_start();
ob_start();
echo'<!DOCTYPE html><html>
<head>
<title> Tarkastele opiskelijoiden itsearviointeja</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />';



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


        echo'<br><h6 style="padding-top: 0px; padding-bottom: 20px; font-size: 1.2em; color: #2b6777; ">Tarkastele opiskelijoiden itsearviointilomakkeita</h6>';
        echo'<a href="ia.php" ><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';





//
//      
//
        echo'<div style="text-align: center">';
        echo'<br><a href="excelia.php?id=' . $ipid . '" class="myButtonLataa"  role="button"  ><i class="fa fa-download" style="font-size:18px"></i> &nbsp&nbsp Lataa vastaukset Excel-tiedostona </a>';
        echo'</div>';
//        
//     echo'<p style="font-weight: bold; font-size: 1.3em">x = opiskelija on vastannut kyseisen otsikon alle</p>';
        echo'<br><p id="ohje" style="font-weight: bold">Klikkaamalla opiskelijan nimeä pääset tarkastelemaan opiskelijan itsearviointilomaketta tarkemmin ja kommentoimaan lomaketta.</p>';

        echo'<div style="margin-top: 40px">';
        if (!$haesarakkeet = $db->query("select distinct * from ia_sarakkeet WHERE kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $smaara = $haesarakkeet->num_rows;
echo'<input type="hidden" name="smaara" id="smaara" value="'.$smaara.'">';
        if ($smaara == 1) {
            $divleveys = 80;
        } else {
            $divleveys = 100 / $smaara;
        }

        while ($rows = $haesarakkeet->fetch_assoc()) {
           
            echo'<div class="cm8-responsive" style="vertical-align: top;margin-top: 20px; padding:0px;">';
           
            echo '<table id="mytable'.$smaara.'" class="cm8-uusitable10uusi" style="width: 100%; overflow-x: auto"><thead>';
             $smaara--;
            echo'<p style="color: #2b6777; margin: 0px; font-weight: bold; background-color: #04f9c5; padding: 8px;font-size: 1em; border: none">Sarake ' . $rows[jarjestys] . '</p>';
            echo '<tr style="background-color: #48E5DA"><th>Opiskelija</th>';
            if (!$haesisalto = $db->query("select distinct * from ia WHERE kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys ='" . $rows[jarjestys] . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowsis = $haesisalto->fetch_assoc()) {
                $otsikko = $rowsis[otsikko];
                $onotsikko = $rowsis[onotsikko];
                $onvastaus = $rowsis[onvastaus];
                $onteksti = $rowsis[onteksti];
                $onradio = $rowsis[onradio];
                $oncheckbox = $rowsis[oncheckbox];

                //kaks peräkkäistä otsikkoa
                if ($onotsikko == 1) {
                    echo'<th>' . $otsikko . '</th>';
                }

//        if($aihe == 0 && $valiaihe == 0 && $result5 -> num_rows !=0){
//                             echo'<th>'.$row2[otsikko].'</th>';
//
//        }
            }

            echo '<th>Viimeisin tallennus</th>';
            echo '<th>Kommentti</th>';
            echo'</tr>';

            echo'</thead><tbody>';

            $nyt = date("j.n.Y H:i");
            if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($row = $result->fetch_assoc()) {




                echo '<tr><td><a href="tarkasteleopiskelijaia.php?kaid=' . $row[kaid] . '">' . $row[sukunimi] . " " . $row[etunimi] . '&nbsp&nbsp&nbsp</a></td>';

                // HAKEE TEKSTIKENTÄT
                if (!$haevastaus = $db->query("select distinct * from ia where kurssi_id = '" . $_SESSION[KurssiId] . "' AND  ia_sarakkeet_jarjestys='" . $rows[jarjestys] . "' AND onvastaus=1 order by jarjestys")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($haevastaus->num_rows == 0) {
                    echo'<td></td>';
                }
                while ($rowvast = $haevastaus->fetch_assoc()) {
                    $iaid = $rowvast[id];

                    if ($rowvast[onteksti] == 1) {
                        if (!$result3 = $db->query("select distinct teksti from iakp where ia_id = '" . $rowvast[id] . "' AND kayttaja_id='" . $row[kaid] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        while ($row3 = $result3->fetch_assoc()) {
//         $row3[teksti] = str_replace('<br />', "", $row3[teksti]);

                            echo'<td>' . $row3[teksti] . '</td>';
                        }
                    } else if ($rowvast[onradio] == 1) {
                        if (!$result3 = $db->query("select distinct iavaihtoehdot.vaihtoehto as vaihtoehto from iakp, iavaihtoehdot where iakp.iavaihtoehdot_id=iavaihtoehdot.id AND iavaihtoehdot.ia_id = '" . $rowvast[id] . "' AND iakp.kayttaja_id='" . $row[kaid] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        echo'<td>';
                        while ($rowvaihtoehto = $result3->fetch_assoc()) {
                            echo'<p>' . $rowvaihtoehto[vaihtoehto] . '</p>';
                        }
                        echo'</td>';
                    } else if ($rowvast[oncheckbox] == 1) {
                        if (!$result3 = $db->query("select distinct iavaihtoehdot.vaihtoehto as vaihtoehto from iakp_moni, iavaihtoehdot where iakp_moni.iavaihtoehdot_id=iavaihtoehdot.id AND iavaihtoehdot.ia_id = '" . $rowvast[id] . "' AND iakp_moni.kayttaja_id='" . $row[kaid] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        echo'<td>';
                        while ($rowvaihtoehto = $result3->fetch_assoc()) {
                            echo'<p>' . $rowvaihtoehto[vaihtoehto] . '</p>';
                        }
                        echo'</td>';
                    }
                }



                //TÄHÄN MUOKATTU
                if (!$haeitse = $db->query("select distinct  id from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $rows[jarjestys] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowitse = $haeitse->fetch_assoc()) {
                    $itseid = $rowitse[id];

                    if (!$haemuokattu = $db->query("select distinct  muokattu from iakp where ia_id='" . $itseid . "' AND kayttaja_id='" . $row[kaid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($rowm = $haemuokattu->fetch_assoc()) {
                        $muokattu = $rowm[muokattu];
                    }
                }
                echo'<td>' . $muokattu . '</td>';

                $kommentti = '';
                //TÄHÄN kommentti
                if (!$haekom = $db->query("select distinct kommentti from iakommentit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $rows[jarjestys] . "' AND kayttaja_id='" . $row[kaid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowkom = $haekom->fetch_assoc()) {
                    $kommentti = $rowkom[kommentti];
                }

                echo'<td>' . $kommentti . '</td>';

                echo'</tr>';
            }

            echo "</tbody></table>";


            echo'</div>';
        }

        echo'<form action="poistaiavastaukset_varmistus.php" style="margin-top: 40px" method="post" ><input type="hidden" name="monesko" value=' . $monesko . '><button name="poista" class="myButton8" type="submit" style="padding: 2px 4px; font-size: 0.7em" title="Poista annetut vastaukset"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista annetut vastaukset</button><br><br></form>';


        echo'</div>';


        echo "<br>";










        echo'</div>




</div>
</div>';
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo'</div>';

include("footer.php");
?>
<script>


    $("#scrollbar").on("scroll", function () {

        var container = $("#container2");
        var scrollbar = $("#scrollbar");

        ScrollUpdate(container, scrollbar);
    });

    function ScrollUpdate(content, scrollbar) {
        $("#spacer").css({"width": "500px"}); // set the spacer width
        scrollbar.width = content.width() + "px";
        content.scrollLeft(scrollbar.scrollLeft());
    }

    ScrollUpdate($("#container2"), $("#scrollbar"));

</script>
<script>

    count();
</script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/tableHeadFixer.js"></script>
<script>

var smaara = document.getElementById("smaara").value;
    //ilman tätä mikään muu ei toimi kuin scrolli
for (let i = smaara; i > 0; i--) {
 $("#mytable"+i).tableHeadFixer({"head": false, "left": 1});
}
   

</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
<script>

var smaara = document.getElementById("smaara").value;
    //ilman tätä mikään muu ei toimi kuin scrolli
for (let i = smaara; i > 0; i--) {
  var $table = $('#mytable'+i);
    $table.floatThead({zIndex: 1});
}
  


</script> 
</body>
</html>								