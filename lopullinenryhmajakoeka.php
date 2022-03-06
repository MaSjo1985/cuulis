<?php
session_start();
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Arvo opiskelijat ryhmiin</title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("kurssisivustonheader.php");



        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px">';
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" class="currentLink" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
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

        echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Palautukset</h2>';
        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';

        if (!$hae_eka = $db->query("select id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka->num_rows == 1) {
            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }
            echo'';
        } else {
            echo'';
        }

        if (!$hae_eka2 = $db->query("select id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka2->num_rows == 1) {
            while ($rivieka2 = $hae_eka2->fetch_assoc()) {
                $eka_id2 = $rivieka2[id];
            }
            echo'';
        } else {
            echo'';
        }

        if (!$haeprojekti = $db->query("select * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeprojekti->num_rows != 0) {
            echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
            while ($rowP = $haeprojekti->fetch_assoc()) {
                $kuvaus = $rowP[kuvaus];
                $id = $rowP[id];
                if ($_GET[pid] == $id) {

                    echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
                } else {

                    echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
                }
            }
            echo'<div class="cm8-margin-top"></div>';
        }


        echo'</nav>

 </div> 

 
<div class="cm8-threequarter" style="padding-top: 0px; margin-top: 0px; padding-bottom: 30px ">';


        if (!$projekti = $db->query("select * from projektit where id='" . $_GET[pid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $projekti->fetch_assoc()) {


            $kuvaus = $rowP[kuvaus];
            $pid = $rowP[id];
            $ryhmienmaksimi = $rowP[ryhmienmaksimi];
            $opmaksimi = $rowP[opmaksimi];
            $opminimi = $rowP[opminimi];

            echo'<h6 style="padding-top: 10px; padding-bottom: 20px; font-size: 1.3em; color: #2b6777">' . $kuvaus . '</h6>';
            echo '<a href="ryhmatyot.php?r=' . $_GET[pid] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';

            echo'<div class="cm8-margin-top"><br></div>';
            if (!$result3 = $db->query("select nimi from ryhmat where id = '" . $_GET[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row3 = $result3->fetch_assoc()) {
                $nimi = $row3[nimi];
            }
            if (!$haetarkka = $db->query("select distinct tarkkamaara from projektit where id='" . $_GET[pid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            //sallittu määrä
            while ($rowtarkka = $haetarkka->fetch_assoc()) {
                $tarkkamaara = $rowtarkka[tarkkamaara];
            }



            echo'<p style="font-size: 1.2em; color: #2b6777; font-weight: bold">Valitse, ketkä opiskelijat haluat arpoa ryhmiin</p>';


            if (!$result = $db->query("select distinct kayttajat.id as kaid, sukunimi, etunimi from kayttajat, opiskelijankurssit where kayttajat.id=opiskelijankurssit.opiskelija_id AND ryhma_id=0 AND projekti_id='" . $_GET[pid] . "' AND kayttajat.rooli <> 'admin' AND kayttajat.rooli <> 'opettaja' ORDER BY kayttajat.sukunimi")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($result->num_rows == 0)
                echo '<br><em>Kurssilla ei ole opiskelijoita, joilla ei ole vielä ryhmää.</em><br>';
            else {
                if ($_GET[kaikki2] == 'joo') {

                    echo '<div class="cm8-margin-top"></div>';
                    if ($tarkkamaara != 0) {

                        echo'<form action="lopullinenryhmajako2.php" method="post">';
                    } else {
                        echo'<form action="lopullinenryhmajako.php" method="post">';
                    }



                    echo'<div class="cm8-responsive">';
                    echo '<table id="mytable" class="cm8-table cm8-bordered cm8-stripedeivikaa"><thead>';



                    echo '<tr><th><a href="lopullinenryhmajakoeka.php?kaikki2=ei&pid=' . $_GET[pid] . '" > Tyhjennä<br>valinnat<br>&nbsp&#9661&nbsp</a></th><th>Sukunimi</th><th>Etunimi</th></tr></thead><tbody>';

                    while ($row = $result->fetch_assoc()) {
                        echo'<tr><td style="padding-left: 10px"><input type="checkbox" class="pieni" name="lista[]" id=' . $row[kaid] . '  value=' . $row[kaid] . ' checked></td>';
                        echo'<td><label for=' . $row[kaid] . '> ' . $row[sukunimi] . '</label></td>';
                        echo'<td><label for=' . $row[kaid] . '> ' . $row[etunimi] . '</label></td>';
                        echo'</tr>';
                    }




                    echo "</tbody></table>";
                    echo'</div>';
                    echo "<br>";
                    echo'<input type="hidden" name="pid" value=' . $_GET[pid] . '>';
                    echo'<br><input type="submit" value="&#10003 Suorita arvonta" class="myButton8"  role="button"  style="padding:4px 6px">';
                    echo'</form>';
                } else {

                    echo '<div class="cm8-margin-top"></div>';
                    if ($tarkkamaara != 0) {

                        echo'<form action="lopullinenryhmajako2.php" method="post">';
                    } else {
                        echo'<form action="lopullinenryhmajako.php" method="post">';
                    }


                    echo'<div class="cm8-responsive">';
                    echo '<table id="mytable" class="cm8-table cm8-bordered cm8-stripedeivikaa"><thead>';




                    echo '<tr><th><a href="lopullinenryhmajakoeka.php?kaikki2=joo&pid=' . $_GET[pid] . '" > Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th>Sukunimi</th><th>Etunimi</th></tr></thead></tbody>';

                    while ($row = $result->fetch_assoc()) {
                        echo'<tr><td style="padding-left: 10px"><input type="checkbox" class="pieni" name="lista[]" id=' . $row[kaid] . '  value=' . $row[kaid] . '></td>';
                        echo'<td><label for=' . $row[kaid] . '> ' . $row[sukunimi] . '</label></td>';
                        echo'<td><label for=' . $row[kaid] . '> ' . $row[etunimi] . '</label></td>';
                        echo'</tr>';
                    }




                    echo "</tbody></table>";
                    echo'</div>';
                    echo "<br>";
                    echo'<input type="hidden" name="pid" value=' . $_GET[pid] . '>';
                    echo'<br><input type="submit" value="&#10003 Suorita arvonta" class="myButton8"  role="button"  style="padding:4px 6px; margin-right: 60px">';
                    echo'</form>';
                }
            }
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
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
}

echo "</div>";
echo "</div>";

include("footer.php");
?>

</body>
</html>	