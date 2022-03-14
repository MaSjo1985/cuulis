<?php
session_start();
ob_start();
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title> Ylläpitäjän lisäys</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("header.php");
        include("header2.php");

        echo'<div class="cm8-container7">';
        if ($_SESSION["Rooli"] == 'admin') {
            include("etuosan_navit.php");
            tuoAdminNavi("Oma oppilaitos");
        } else if ($_SESSION["Rooli"] == 'admink') {
            echo'<nav class="topnavoppilas" id="myTopnav">';
            echo'<a href="etusivu.php" >Etusivu</a>          
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
<a href="kayttajatvahvistus.php" >Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" class="currentLink">Oma oppilaitos</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        } else if ($_SESSION["Rooli"] == "opeadmin") {
            echo'<nav class="topnavOpe" id="myTopnav">';
            echo'<a href="etusivu.php"  >Etusivu</a>         
<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnavOpe") {
  
        x.className += " responsive";
        
       
    } else {
  
        x.className = "topnavOpe";
      
    }
     
}
</script>
<a href="omatkurssit.php" >Omat kurssit/opintojaksot</a>
<a href="kurssitkaikki.php" >Kaikki kurssit/opintojaksot</a>
<a href="kayttajatvahvistus.php" >Käyttäjät &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="kurssit.php">Kurssit/Opintojaksot &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" class="currentLink">Oppilaitos &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)">  
    <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        } else
            include("opnavi.php");
        echo'<div class="cm8-container3" >';
        if (!empty($_POST["lista10"])) {
            if (!$result31 = $db->query("select distinct Nimi from koulut where id = '" . $_POST[koid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row31 = $result31->fetch_assoc()) {
                $nimi = $row31[Nimi];
            }
            $lista = $_POST["lista10"];

            foreach ($lista as $tuote) {
                $db->query("insert into koulunadminit (kayttaja_id, koulu_id) values ('" . $tuote . "', '" . $_POST[koid] . "')");


                echo'<div class="cm8-margin-left cm8-margin-bottom" style="margin-top: 10px">';
                $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
                $headers .= "X-Priority: 3\r\n";
                $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

                $otsikko = "Sinut on lisätty oppilaitoksen  ylläpitäjäksi";
                $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

                $viesti = 'Sinut on lisätty oppilaitoksen ' . $nimi . ' ylläpitäjäksi Cuulis-oppimisympäristössä.<br><br>Pääset Cuulis-oppimisympäristöön suoraan <a href="https://cuulis.cm8solutions.fi/">tästä.</a><br><br><em>Tähän viestiin ei voi vastata.</em>';
                $viesti = str_replace("\n.", "\n..", $viesti);

                if (!$tulos4 = $db->query("select distinct * from kayttajat where id='" . $tuote . "'")) {
                    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                }
                $maara = 0;
                while ($rivi2 = $tulos4->fetch_assoc()) {
                    $sposti = $rivi2[sposti];
                    $body = '<html><body>';


                    $body .= '<p>' . $viesti . '</p>';
                    $body .= "</body></html>";
                    $maara++;
                    $varmistus = mail($sposti, $otsikko, $body, $headers);
                }
            }

            header("location: muokkaakoulu.php?id=" . $_POST[koid]);
        } else {
            echo '<p style="font-weight: bold" >Et valinnut yhtään opettajaa!</p>';

            echo'<br><a href="uusikouluadmineka.php?koid=' . $_POST[koid] . '"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin';
        }



        echo'</div>';
        echo'</div>';
        echo'</div>';

        include("footer.php");
    }
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
