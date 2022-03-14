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
        echo'<a href="itsearviointi.php" ><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';




        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$result2 = $db->query("select distinct * from itsearvioinnit WHERE kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        echo'<div style="text-align: center">';
        echo'<br><a href="excel2.php?id=' . $ipid . '" class="myButtonLataa"  role="button"  ><i class="fa fa-download" style="font-size:18px"></i> &nbsp&nbsp Lataa vastaukset Excel-tiedostona </a>';
        echo'</div>';

//     echo'<p style="font-weight: bold; font-size: 1.3em">x = opiskelija on vastannut kyseisen otsikon alle</p>';
        echo'<br><br><p id="ohje">Klikkaamalla opiskelijan nimeä pääset tarkastelemaan opiskelijan itsearviointilomaketta tarkemmin.</em></p>';
        echo'<form action="poistaitsevastaukset_varmistus.php" style="margin-top: 40px" method="post" ><input type="hidden" name="monesko" value=' . $monesko . '><button name="poista" class="myButton8" type="submit" style="font-size: 0.9em" title="Poista annetut vastaukset"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista annetut vastaukset</button><br><br></form>';

        echo'<div class="cm8-responsive">';
        echo'<div id="scrollbar"><div id="spacer"></div></div>';
        echo'<div class="cm8-responsive" id="container2">';
        echo '<table id="mytable" class="cm8-uusitable10 cm8-striped" style="overflow-x: auto"><thead>';
        echo '<tr style="background-color: #48E5DA"><th>Opiskelija</th>';


        while ($row2 = $result2->fetch_assoc()) {
            $paaotsikko = $row2[aihe];
            $valiotsikko = $row2[valiaihe];
            if ($valiotsikko == 0 && $paaotsikko == 0) {
                $tekstikentta = 1;
            } else {
                $tekstikentta = 0;
            }

            $jarjestys = $row2[jarjestys];
            $seuraava = $jarjestys + 1;
            $edellinen = $jarjestys - 1;
            if (!$result5 = $db->query("select distinct * from itsearvioinnit WHERE kurssi_id='" . $_SESSION["KurssiId"] . "' AND jarjestys='" . $seuraava . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowaihe = $result5->fetch_assoc()) {
                $aihe = $rowaihe[aihe];
                $valiaihe = $rowaihe[valiaihe];
                $seurotsikko = $rowaihe[otsikko];
            }
            if (!$result6 = $db->query("select distinct * from itsearvioinnit WHERE kurssi_id='" . $_SESSION["KurssiId"] . "' AND jarjestys='" . $edellinen . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowaihe2 = $result6->fetch_assoc()) {
                $saihe = $rowaihe2[aihe];
                $svaliaihe = $rowaihe2[valiaihe];
            }

            //kaks peräkkäistä otsikkoa
            if ($paaotsikko == 1 && $valiaihe == 1 && $result5->num_rows != 0) {
                echo'<th>' . $row2[otsikko] . '<br><br>' . $seurotsikko . '</th>';
            } else if ($paaotsikko == 1 && $aihe == 0 && $valiaihe == 0 && $result5->num_rows != 0) {
                echo'<th>' . $row2[otsikko] . '</th>';
            } else if ($valiotsikko == 1 && $saihe == 0 && $aihe == 0 && $valiaihe == 0 && $result5->num_rows != 0) {
                echo'<th>' . $row2[otsikko] . '</th>';
            }

//        if($aihe == 0 && $valiaihe == 0 && $result5 -> num_rows !=0){
//                             echo'<th>'.$row2[otsikko].'</th>';
//
//        }
        }
        echo '<th>Pisteet</th>';
        echo '<th>Viimeisin tallennus</th></tr>';
        echo'</thead><tbody>';

        $nyt = date("j.n.Y H:i");
        while ($row = $result->fetch_assoc()) {

            //


            if (!$haearvioinnit = $db->query("select distinct * from itsearvioinnit_pisteet where kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttaja_id='" . $row[kaid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($haearvioinnit->num_rows == 0) {
                $pisteet = '-';
            } else {
                $pisteet = 0;
                while ($row8 = $haearvioinnit->fetch_assoc()) {

                    $opetallennus = $row8[opetallennus2];
                    if ($opetallennus == 1) {
                        $pisteet = $row8[pisteet];
                    } else {
                        $pisteet = '-';
                    }
                }
            }


            echo '<tr><td><a href="tarkasteleopiskelija2.php?kaid=' . $row[kaid] . '">' . $row[sukunimi] . " " . $row[etunimi] . '&nbsp&nbsp&nbsp</a></td>';

            // HAKEE TEKSTIKENTÄT

            if (!$haetekstit = $db->query("select distinct jarjestys from itsearvioinnit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ((aihe=0 AND valiaihe=0) OR (aihe=0 and valiaihe IS NULL)) ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowot = $haetekstit->fetch_assoc()) {

                $jarjestys = $rowot[jarjestys];

                if (!$haevastaus = $db->query("select distinct * from itsearvioinnit where kurssi_id = '" . $_SESSION[KurssiId] . "' AND  jarjestys='" . $jarjestys . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowvast = $haevastaus->fetch_assoc()) {

                    if (!$result3 = $db->query("select distinct * from itsearvioinnitkp where itsearvioinnit_id = '" . $rowvast[id] . "' AND kayttaja_id='" . $row[kaid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    if ($result3->num_rows != 0) {

                        while ($row3 = $result3->fetch_assoc()) {

                            $row3[teksti] = str_replace('<br />', "", $row3[teksti]);

                            echo'<td>' . $row3[teksti] . '</td>';
                        }
                    } else {
                        echo'<td></td>';
                    }
                }
            }
//TÄHÄN MUOKKAUSNAPPI PERÄÄN!!
            if ($opetallennus2 == 1) {
                echo'<td>' . $pisteet . '</td>';
            }
// TÄHÄN TEKSTIKENTTÄ + TALLENNUSNAPPI
            else {
                echo'<td>' . $pisteet . '</td>';
            }

            //TÄHÄN MUOKATTU
            if (!$haeitse = $db->query("select distinct  id from itsearvioinnit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowitse = $haeitse->fetch_assoc()) {
                $itseid = $rowitse[id];

                if (!$haemuokattu = $db->query("select distinct  muokattu from itsearvioinnitkp where itsearvioinnit_id='" . $itseid . "' AND kayttaja_id='" . $row[kaid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowm = $haemuokattu->fetch_assoc()) {
                    $muokattu = $rowm[muokattu];
                }
            }
            echo'<td>' . $muokattu . '</td>';
            echo'</tr>';
        }

        echo "</tbody></table>";


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


    //ilman tätä mikään muu ei toimi kuin scrolli

    $("#mytable").tableHeadFixer({"head": false, "left": 1});

</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
<script>


    var $table = $('#mytable');
    $table.floatThead({zIndex: 1});


</script> 
</body>
</html>								