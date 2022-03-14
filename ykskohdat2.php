<?php
session_start();

ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Yksityiskohdat aiheesta </title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />

';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("kurssisivustonheader.php");



        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';

        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" class="currentLink">Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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







        echo'<div class="cm8-margin-top"></div>';


        echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Tehtävälista</h2>';
        if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka->num_rows != 0) {
            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }
        }
        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';



        if (!$haeprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeprojekti->num_rows != 0) {
            echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
            while ($rowP = $haeprojekti->fetch_assoc()) {
                $kuvaus = $rowP[kuvaus];
                $id = $rowP[id];

                if ($_GET[id] == $id) {

                    echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
                } else {

                    echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
                }
            }

            echo'<div class="cm8-margin-top"></div>';
        }






        echo'


 
	
</nav>
        <div class="cm8-margin-top"></div>';
        echo'<div class="cm8-margin-top"></div>';
        echo'<div class="cm8-margin-top"></div>';
        echo'<div class="cm8-margin-top"></div>';


        echo '<table class="cm8-tableyks2 cm8-bordered cm8-striped" style="margin-top: 100px"><thead>';

        echo '<tr><th>Toivottu yhdessä läpikäytäväksi</th>';

        echo'</tr></thead><tbody>';


        if (!$haeaihe = $db->query("select distinct * from itsetehtavat where id='" . $_GET[tid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowA = $haeaihe->fetch_assoc()) {

            $otsikko = $rowA[otsikko];
            $eka = $rowA[jarjestys] + 1;
        }


        if (!$haetehtavat0 = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_GET[id] . "' AND jarjestys>='" . $eka . "' ORDER BY jarjestys ASC")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowt0 = $haetehtavat0->fetch_assoc()) {

            if ($rowt0[aihe] == 1) {


                $vika = $rowt0[jarjestys] - 1;

                break;
            } else
                $vika = $rowt0[jarjestys];
        }

        if (!$haetehtavat8888 = $db->query("select distinct itsetehtavat.id as id from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $_GET[id] . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavat.jarjestys>='" . $eka . "' AND itsetehtavat.jarjestys<='" . $vika . "' ORDER BY itsetehtavat.jarjestys ASC")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        $on = false;

        while ($rowt8888 = $haetehtavat8888->fetch_assoc()) {

            if (!$haetoiveet = $db->query("select distinct itsetehtavat.sisalto as sisalto from itsetehtavatkp, itsetehtavat where itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavat.id='" . $rowt8888[id] . "' AND itsetehtavatkp.toive=1")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowtoive = $haetoiveet->fetch_assoc()) {
                $on = true;
                echo ' <tr style="font-size: 1em"><td style="text-align: center; border: 1px solid grey">' . $rowtoive[sisalto] . '</td>';


                echo'</tr>';
            }
        }
        if (!$on) {
            echo ' <tr style="font-size: 1em"><td style="text-align: center; border: 1px solid grey"><em>Ei toiveita.</em></td>';


            echo'</tr>';
        }



        echo "</tbody></table>";

        echo'</div></nav>';




        echo'<div class="cm8-threequarter" style="padding-top: 0px; margin-top: 0px">';


        if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $onkoprojekti->fetch_assoc()) {

            $ipid = $rowP[id];
            $kuvaus = $rowP[kuvaus];
        }



        echo'<br><h6 style="padding-top: 10px; padding-bottom: 20px; font-size: 1.2em; color: #2b6777; display: inline-block">' . $kuvaus . '</h6>';
        echo'<br><a href="itsetyot.php?i=' . $_GET[id] . '""><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';
        echo'<br><br><b style="font-size: 1.1em; color:  #2b6777">Aiheeseen "' . $otsikko . '" liittyvät tehtävätilastot: </b><br>';








        echo'<br><br>o = opiskelija on osannut tehdä tehtävän.<br>';
        echo'<br>y = opiskelija on yrittänyt tehdä tehtävää, mutta ei ole osannut sitä.<br>';
        echo'<br>- = opiskelija ei ole tehnyt tehtävää.<br>';
        echo'<br><p id="ohje" style="font-size: 0.9em">Klikkaamalla opiskelijan nimeä pääset tarkastelemaan tarkemmin opiskelijan tehtäviä.</em></p>';

        if (!$haetehtavat8 = $db->query("select distinct itsetehtavat.sisalto as sisalto from itsetehtavat where itsetehtavat.itseprojektit_id='" . $_GET[id] . "' AND itsetehtavat.jarjestys>='" . $eka . "' AND itsetehtavat.jarjestys<='" . $vika . "' ORDER BY itsetehtavat.jarjestys ASC")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        echo'<div class="cm8-responsive" style=" padding-bottom: 0px; padding-top: 20px; ">';


        echo'<form action="tallennalisa.php" method="post">';
        echo '<table id="mytable" class="cm8-tableyks cm8-bordered cm8-striped" ><thead>';

        echo '<tr id="palaa"><th style="border: 1px solid grey">Opiskelija</th>';


        while ($rowt8 = $haetehtavat8->fetch_assoc()) {
            echo'<th style="text-align: center; border: 1px solid grey ">' . $rowt8[sisalto] . '</th>';
        }


        if (!$haelisa = $db->query("select distinct * from itseprojektit where id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowlisa = $haelisa->fetch_assoc()) {
            echo'<th style="border: 1px solid grey;  "><textarea name="lisa" rows="1" cols="20" style="font-size: 1em; text-align:center; font-weight: bold ">' . $rowlisa[lisa] . '</textarea><br><b style="font-size: 0.8em; font-weight: normal; text-align: center"> (Voit muokata tätä)</b></th>';
        }


        echo'</tr></thead><tbody>';


        if (!$haeopiskelijat = $db->query("select distinct kayttajat.id as id, kayttajat.etunimi as etunimi, kayttajat.sukunimi as sukunimi from kayttajat, itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $_GET[id] . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND kayttajat.id=itsetehtavatkp.kayttaja_id AND kayttajat.rooli='opiskelija' ORDER BY kayttajat.sukunimi ASC")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowo = $haeopiskelijat->fetch_assoc()) {
            echo ' <tr style="font-size: 1em"><td style="border: 1px solid grey"><a href="tarkasteleopiskelija.php?kaid=' . $rowo[id] . '&id=' . $ipid . '&url=ykskohdat2.php&tid=' . $_GET[tid] . '">' . $rowo[sukunimi] . ' ' . $rowo[etunimi] . '</td>';


            if (!$haetehtavat888 = $db->query("select distinct kayttajat.id as id, itsetehtavatkp.lisa as lisa, itsetehtavat.sisalto as sisalto, itsetehtavatkp.tehty as tehty, itsetehtavatkp.osattu as osattu from kayttajat, itsetehtavat, itsetehtavatkp where kayttajat.id='" . $rowo[id] . "' AND kayttajat.rooli='opiskelija' AND kayttajat.id=itsetehtavatkp.kayttaja_id AND itsetehtavat.itseprojektit_id='" . $_GET[id] . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavat.jarjestys>='" . $eka . "' AND itsetehtavat.jarjestys<='" . $vika . "' ORDER BY itsetehtavat.jarjestys ASC")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowt88 = $haetehtavat888->fetch_assoc()) {

                if ($rowt88[tehty] == 1 && $rowt88[osattu] == 1) {

                    echo'<td style="text-align: center; border: 1px solid grey">o</td>';
                } else if ($rowt88[tehty] == 1 && $rowt88[osattu] == 0) {

                    echo'<td style="text-align: center; border: 1px solid grey">y</td>';
                } else {
                    echo'<td style="text-align: center; border: 1px solid grey">-</td>';
                }
                $oplisa = $rowt88[lisa];
                $opid = $rowt88[id];
            }
            echo'<input type="hidden" id="' . $opid . '" name="id[]" value=' . $opid . '>';
            echo'<td style="border: 1px solid grey"><textarea name="kommenttiop[]" cols="20"  style="margin: 0; padding: 0; font-size: 1em;">' . $oplisa . '</textarea></td>';
            echo'</tr>';
        }


        echo "</tbody></table>";
        echo'</div>';
        echo'<input type="hidden" name="ipid" value=' . $_GET[id] . '>';
        echo'<input type="hidden" name="tid" value=' . $_GET[tid] . '>';
        echo'<br><input type="submit" name="painiket" value="&#10003 Tallenna merkinnät" class="myButton8"  role="button"  style="padding:4px 6px">';
        echo'</form>';









        echo'</div>





</div>';
        ?>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
        <script>
            var $table = $('#mytable');

            $table.floatThead({zIndex: 1});

        </script>        
        <?php
session_start();
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

</body>
</html>							