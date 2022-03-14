<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Liitä opiskelijoita ryhmään </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("kurssisivustonheader.php");



        echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 30px">';
        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
            echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	   
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" class="currentLink">Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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
        }


        echo '<div class="cm8-container3">';
        $lista = $_POST["lista10"];
        $maara = 0;
        foreach ($lista as $tuote) {
            $maara++;
        }

        if (!$haemaksimi = $db->query("select distinct opmaksimi from projektit where id = '" . $_POST[pid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haemaara = $db->query("select distinct opiskelija_id from opiskelijankurssit where ryhma_id = '" . $_POST[ryhmaid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $yht = $maara + ($haemaara->num_rows);

        while ($row = $haemaksimi->fetch_assoc()) {

            $maksimi = $row[opmaksimi];
        }

        if (empty($_POST["lista10"])) {
            echo '<p style="font-weight: bold" >Et valinnut yhtään opiskelijaa!</p>';

            echo'<br><a href="liitaryhmaan.php?pid=' . $_POST[pid] . '&id=' . $_POST[ryhmaid] . '"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin';
        }
        //monta on jo?!?!?!?
        else if ($maara > $maksimi || $yht > $maksimi) {
            echo '<p style="font-weight: bold">Valitsemasi määrä opiskelijoita ei mahdu tähän ryhmään!</p>';

            echo'<br><a href="liitaryhmaan.php?pid=' . $_POST[pid] . '&id=' . $_POST[ryhmaid] . '"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin';
        } else {
            $lista = $_POST["lista10"];




            foreach ($lista as $tuote) {



                $db->query("update opiskelijankurssit set ryhma_id='" . $_POST[ryhmaid] . "' where opiskelija_id = '" . $tuote . "' AND projekti_id='" . $_POST[pid] . "'");

                //päivitä ryhmäid

                if (!$onkotyo = $db->query("select distinct * from opiskelijan_kurssityot where projekti_id='" . $_POST[pid] . "' AND kayttaja_id='" . $tuote . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowtyo = $onkotyo->fetch_assoc()) {

                    $tyoid = $rowtyo[id];
                    $ryhmat2id = $rowtyo[ryhmat2_id];


                    $db->query("update ryhmat2 set ryhma_id='" . $_POST[ryhmaid] . "' where id = '" . $ryhmat2id . "' AND projekti_id='" . $_POST[pid] . "'");
                }
            }



            header("location: ryhmatyot.php?r=" . $_POST[pid] . "#" . $_POST[ryhmaid]);
        }
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";
echo "</div>";

include("footer.php");
?>

</body>
</html>	