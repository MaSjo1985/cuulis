<?php
session_start(); 


ob_start();

echo'<!DOCTYPE html>
<html>
 
<head>

<title>Lähetä viesti </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

 
    if ($_POST[url]=='osallistujat.php' || $_POST[url]=='lisaaopettajaeka.php') {
            include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 30px">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">';

        echo'<a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	   
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a>';


        if ($_GET[url] == "ryhmatyot.php") {
            echo' <a href="ryhmatyot.php"  class="currentLink">Palautukset</a>';
        } else {
            echo' <a href="ryhmatyot.php">Palautukset</a>';
        }

        echo'<a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>';

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
	  ';

        if ($_GET[url] == "osallistujat.php") {
            echo' <a href="osallistujat.php"  class="currentLink">Osallistujat</a>';
        } else {
            echo' <a href="osallistujat.php"  class="currentLink">Osallistujat</a>  ';
        }



        echo'   <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
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
        echo'<nav class="topnav" id="myTopnav">';

        echo'<a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	   
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a>';


        if ($_GET[url] == "ryhmatyot.php") {
            echo' <a href="ryhmatyot.php"  class="currentLink">Palautukset</a>';
        } else {
            echo' <a href="ryhmatyot.php">Palautukset</a>';
        }

        echo'<a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>';

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
	  ';

        if ($_GET[url] == "osallistujat.php") {
            echo' <a href="osallistujat.php"  class="currentLink">Osallistujat</a>';
        } else {
            echo' <a href="osallistujat.php"  class="currentLink">Osallistujat</a>  ';
        }


        echo' <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
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
    }
    else{
 
        include("header.php");
        include("header2.php");
        echo'<div class="cm8-container7">';
        if ($_SESSION["Rooli"] == 'admin')
            include("adminnavi.php");
        else if ($_SESSION["Rooli"] == 'admink')
            include("adminknavi.php");
        else if ($_SESSION["Rooli"] == 'opeadmin')
            include("opeadminnavi.php");
        else
            include ("opnavi.php"); 
        
    }



    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"></div>';

       if (!strlen(trim($_POST['viesti']))) {
        echo '<b style="color: #e608b8">Et voi lähettää tyhjää viestiä!</b>';
          if ($_POST[url]=='osallistujat.php' || $_POST[url]=='lisaaopettajaeka.php') {
                  echo '<br><br><a href="viestikayttajalle2.php?id='.$_POST[id].'&url='.$_POST[url].'"><p>&#8630 &nbsp&nbsp&nbspPalaa takaisin </p></a>';
                       }
                       else{
                            echo '<br><br><a href="viestikayttajalle.php?id='.$_POST[id].'&url='.$_POST[url].'"><p>&#8630 &nbsp&nbsp&nbspPalaa takaisin </p></a>';
                       }
    } else {

        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";


        $otsikko = "Viesti Cuulis-oppimisympäristöstä";
        $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

        function poista_rivinvaihdot($teksti) {
            return str_replace(array("\r", "\n"), "", $teksti);
        }

        $nimi = poista_rivinvaihdot($_POST[nimi]);
        $email = poista_rivinvaihdot($_POST[sposti]);

        $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";




        if (!$result = $db->query("select distinct sposti, etunimi, sukunimi from kayttajat where id='" . $_POST["id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row = $result->fetch_assoc()) {
            $sposti = $row[sposti];
            $etunimi = $row[etunimi];
            $sukunimi = $row[sukunimi];
        }
            if ($sposti != null) {

                $viesti2 = $_POST[viesti];
                $viesti2 = str_replace("\n.", "\n..", $viesti2);
//            $viesti2 = wordwrap($viesti2, 70, "\r\n");
                $viesti2 = nl2br($viesti2);
                $body = '<html><body>';


                  $body .= '<p>' . $viesti2 . '</p><br>----------------------------------<br><p>Viestin lähettäjän nimi: <b>'.$_POST[nimi].'</b><p>Viestin lähettäjän käyttäjätunnus: <b>'.$_POST[sposti].'</b></p>';
            
                $body .= "</body></html>";
                $viesti = mail($sposti, $otsikko, $body, $headers);

                if (!$tulosa = $db->query("select distinct sposti from kayttajat where rooli='admin'")) {
                    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                }

                while ($rowa = $tulosa->fetch_assoc()) {
                    $spostia = $rowa["sposti"];
                }
                $otsikkoa = "Cuulis-oppimisympäristön sisällä on lähetetty viesti";
                $otsikkoa = "=?UTF-8?B?" . base64_encode($otsikkoa) . "?=";
                $headers2 .= "MIME-Version: 1.0" . "\r\n";
                $headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                $headers2 .= "X-Priority: 3\r\n";
                $headers2 .= "X-Mailer: PHP" . phpversion() . "\r\n";
                $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
                $body = '<html><body>';


                  $body .= '<b>Cuulis-oppimisympäristön sisällä on lähetetty viesti: </b><br><p>' . $viesti2 . '</p><br>----------------------<br><p>Viestin vastaanottaja: <b>'.$etunimi.' '.$sukunimi.'</b<br>Vastaanottajan sähköpostiosoite: <b>'.$sposti.'<br><p>Viestin lähettäjän nimi: <b>'.$_POST[nimi].'</b><p>Viestin lähettäjän käyttäjätunnus: <b>'.$_POST[sposti].'</b></p>';
            
                $body .= "</body></html>";
                $viestia = mail($spostia, $otsikkoa, $body, $headers2);

                if ($viesti) {
             
                    header('location: lahetaviestiyksilollinen2.php?url='.$_POST[url]);
                } else {
                    echo '<br><br><b style="color: #e608b8">Viestin lähettäminen ei onnistunut!</b>';
                        if ($_POST[url]=='osallistujat.php' || $_POST[url]=='lisaaopettajaeka.php') {
                  echo '<br><br><a href="viestikayttajalle2.php?id='.$_POST[id].'&url='.$_POST[url].'"><p>&#8630 &nbsp&nbsp&nbspPalaa takaisin </p></a>';
                       }
                       else{
                            echo '<br><br><a href="viestikayttajalle.php?id='.$_POST[id].'&url='.$_POST[url].'"><p>&#8630 &nbsp&nbsp&nbspPalaa takaisin </p></a>';
                       }
                 
                }
            }
        
    }

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
</html>	