<?php
session_start();
ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Tarkastele opiskelijoiden kyselylomakkeita</title>
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
        echo'<div class="cm8-container3" style="padding-top: 30px">';

if (!$resultn = $db->query("select distinct nimella from kyselyt where kurssi_id='".$_SESSION[KurssiId]."'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                } 
                
                 while ($rown = $resultn->fetch_assoc()) {
                     $nimella = $rown[nimella];
                 }
                 
        echo'<br><h6 style="padding-top: 0px; padding-bottom: 20px; font-size: 1.2em; color: #2b6777; ">Tarkastele opiskelijoiden kyselylomakkeita</h6>';
        echo'<a href="kysely.php" ><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';



        $ipid = $_POST[id];
        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kyselytkp, kyselyt, kayttajat, opiskelijankurssit where kyselytkp.kayttaja_id = kayttajat.id AND kyselytkp.teksti <> '' AND kyselytkp.kyselyt_id = kyselyt.id AND kyselyt.kurssi_id = '" . $_SESSION["KurssiId"] . "' AND kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.kurssi_id='" . $_SESSION["KurssiId"] . "' AND kyselytkp.tallennettu=1 order by kyselytkp.muokattu")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($result->num_rows != 0) {
            if (!$result2 = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
//                 
            echo'<div style="text-align: center">';
            echo'<br><a href="excel3.php?id=' . $ipid . '" class="myButtonLataa"  role="button"><i class="fa fa-download" style="font-size:18px"></i> &nbsp&nbsp Lataa vastaukset Excel-tiedostona </a>';
            echo'</div>';

//     echo'<p style="font-weight: bold; font-size: 1.3em">x = opiskelija on vastannut kyseisen otsikon alle</p>';


            echo'<form action="poistakyselyvastaukset_varmistus.php" style="margin-top: 40px" method="post" ><input type="hidden" name="monesko" value=' . $monesko . '><button name="poista" class="myButton8" type="submit" style="font-size: 0.9em" title="Poista annetut vastaukset"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista annetut vastaukset</button><br><br></form>';

            
     echo'<p>Vastauksia yhteensä: '.$result->num_rows.'</p>';
            echo'<div class="cm8-responsive">';
            echo'<div id="scrollbar"><div id="spacer"></div></div>';
            echo'<div class="cm8-responsive" id="container2">';
            echo '<table id="mytable" class="cm8-uusitable10 cm8-striped" style="overflow-x: auto"><thead>';
            echo '<tr style="background-color: #48E5DA"><th>Vastaus lähetetty</th>';
           
            if($nimella == 1){
                 echo '<th>Sukunimi</th>';   
                  echo '<th>Etunimi</th>';  
            }

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
                if (!$result5 = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "' AND jarjestys='" . $seuraava . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowaihe = $result5->fetch_assoc()) {
                    $aihe = $rowaihe[aihe];
                    $valiaihe = $rowaihe[valiaihe];
                    $seurotsikko = $rowaihe[otsikko];
                }
                if (!$result6 = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "' AND jarjestys='" . $edellinen . "'")) {
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
            echo '</tr>';
            echo'</thead><tbody>';


            $nyt = date("j.n.Y H:i");
            $vastausnro = 0;
            while ($row = $result->fetch_assoc()) {

                // haetaan käyttäjä -> luo rivi!

                if (!$result3 = $db->query("select distinct kyselyt.id as id, kyselytkp.teksti as teksti, kyselytkp.muokattu as muokattu from kyselyt, kyselytkp where kyselyt.id=kyselytkp.kyselyt_id AND kyselyt.kurssi_id='" . $_SESSION["KurssiId"] . "' AND kyselytkp.teksti <> '' AND kyselytkp.kayttaja_id='" . $row[kaid] . "' AND (valiaihe = 0 OR valiaihe IS NULL) AND aihe = 0 order by kyselyt.jarjestys")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if (!$result4 = $db->query("select distinct kyselyt.id as id, kyselytkp.teksti as teksti, kyselytkp.muokattu as muokattu from kyselyt, kyselytkp where kyselyt.id=kyselytkp.kyselyt_id AND kyselyt.kurssi_id='" . $_SESSION["KurssiId"] . "' AND kyselytkp.kayttaja_id='" . $row[kaid] . "' AND valiaihe = 0 AND aihe = 0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                $yht = $result3->num_rows;
                echo'<tr>';

                $vastausnro++;

                if (!$result5 = $db->query("select distinct kyselytkp.muokattu as muokattu from kyselyt, kyselytkp where kyselyt.id=kyselytkp.kyselyt_id AND kyselyt.kurssi_id='" . $_SESSION["KurssiId"] . "' AND kyselytkp.teksti <> '' AND kyselytkp.kayttaja_id='" . $row[kaid] . "' AND (valiaihe = 0 OR valiaihe IS NULL) AND aihe = 0 order by kyselyt.jarjestys")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($row5 = $result5->fetch_assoc()) {
                    $muokattu = $row5[muokattu];
                    echo '<td>' . $muokattu . '</td>';
                }
                if($nimella==1){
                     if (!$resultnimi = $db->query("select distinct etunimi, sukunimi from kayttajat where id='" . $row[kaid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                    while ($rownimi = $resultnimi->fetch_assoc()) {
                    $etunimi = $rownimi[etunimi];
                     $sukunimi = $rownimi[sukunimi];
                    echo '<td>' . $sukunimi.'</td>';
                    echo '<td>' . $etunimi.'</td>';
                }
                }

                $eityhjia = 0;

                while ($row3 = $result3->fetch_assoc()) {


                    $eityhjia++;
                    $row3[teksti] = str_replace('<br />', "", $row3[teksti]);
                    echo'<td>' . $row3[teksti] . '</td>';
                }

                $tyhjia = $yht - $eityhjia;

                while ($tyhjia > 0) {
                    echo'<td></td>';
                    $tyhjia--;
                }

                echo'</tr>';
            }

            echo "</tbody></table>";


            echo'</div>';





            echo "<br>";










            echo'</div>';
        } else {



            echo'<p id="ohje">Kyselylomakkeeseen ei ole vielä tullut vastauksia.</p>';
        }






        echo'</div>
</div>';
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



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