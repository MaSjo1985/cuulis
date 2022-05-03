<?php
session_start();
ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Keskustele </title>
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



    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';
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
	  <a href="keskustelut.php" class="currentLink" >Keskustele</a> 
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

    if ($_SESSION["Rooli"] == "opiskelija") {
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
	  <a href="keskustelut.php" class="currentLink">Keskustele</a> 
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


    echo '<div class="cm8-margin-top"></div>';
    echo'<div class="cm8-third" style="padding-left: 20px; border: 2px solid blue"><h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Keskustele</h2>';



    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'opeadmin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'admin') {
        echo'<div class="cm8-margin-top"></div>';
        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[keskakt];
            $kaihe = $rowa[keskusteluaihe];
            $opeid = $rowa[opettaja_id];
        }
        if ($akt == 1) {

            echo'<form action="aktivoikeskustelu.php" method="post" style="margin-bottom: 20px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikep" value="- Piilota toiminto" class="myButton8" role="button" style="padding:2px 4px; margin-right: 10px"></form>';
        }
    }



    echo '<div  style="margin-top: 100px;"></div>';
    if (!$haeakt = $db->query("select distinct * from kurssit where keskakt = 1 AND id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($haeakt->num_rows != 0) {
        if ($_SESSION["Rooli"] == 'opiskelija') {
            $paiva = date("j.n.Y");

            $kello = date("H:i");

            $nimi = $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"];




            echo'<form name="form1" class="form-style-k"><fieldset>';



            echo'<b>Nimimerkki:</b><br><br><em style="font-style: normal; font-size: 0.8em">Voit laittaa viestin myös nimettömänä, kun otat tämän nimen pois</em> <br><br>
                                                                
                                                               <textarea name="nimi" rows="1"">' . $nimi . '</textarea><br>';

            echo'<br><br><b>Viesti:</b> <br> <textarea id="sendie" name="uusi" rows="8"  ></textarea>
								<input type="hidden" name="paiva" value=' . $paiva . '>
								<input type="hidden" name="kello" value=' . $kello . '>
                                                                    
								
<br><br><a href="" onClick="submitChat2()"  class="myButton9"  role="button"> &#10147 Lähetä</a>
                                                                
                                                    </fieldset></form>';
        } else {

            $paiva = date("j.n.Y");
            $kello = date("H:i");
            $nimi = $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"];
            echo'<form name="form1" class="form-style-k" "><fieldset style="font-size: 0.8em">
						<b>Nimimerkki:</b> <br><textarea name="nimi" rows="2" >' . $nimi . '</textarea><br><br><b>Viesti:</b> <br> <textarea id="sendie"  class="content" name="uusi" rows="8"  ></textarea>
								<input type="hidden" name="paiva" value=' . $paiva . '>
								<input type="hidden" name="kello" value=' . $kello . '>
                                                              
 <br><br><a href="" onClick="submitChat2()"  class="myButton9" id="tanne" role="button"   >&#10147 Lähetä</a>
   
								</fieldset></form>';
        }
    }



    echo'</div>';





    echo'<div class="cm8-twothird" style="padding-top: 20px; border: 2px solid #e608b8">';



    if ($_SESSION["Rooli"] == 'opiskelija') {


        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[keskakt];
            $kaihe = $rowa[keskusteluaihe];
            $opeid = $rowa[opettaja_id];
        }
        if ($akt == 0) {
            echo'<br><br><em>Toimintoa ei ole aktivoitu.</em>';
        } else {



            echo'<h6>' . $kaihe . '</h6>';




            if (!$haekeskustelu = $db->query("select distinct * from keskustelut where kurssi_id='" . $_SESSION["KurssiId"] . "' order by id desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            if ($haekeskustelu->num_rows == 0) {

                echo'<br><br><em>Ei viestejä</em><br><br>';
            } else {
                echo'<div class="cm8-margin-top"></div>';
                echo'<div id="chatlogs"></div>';
            }




            echo'</div>';
        }
    } else {

        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[keskakt];
            $kaihe = $rowa[keskusteluaihe];
            $opeid = $rowa[opettaja_id];
        }
        if ($akt == 0) {
            echo'<br><em>Toimintoa ei ole aktivoitu.</em><form action="aktivoikeskustelu.php" method="post"><br><br><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikea" value="+ Aktivoi toiminto" class="myButton8" role="button" style="padding:2px 4px"></form></div>';
        } else {

            echo'<h6 style="display: inline-block; ">' . $kaihe . '</h6>';


            echo'<form action="aktivoikeskustelu.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikem" value="&#9998 Muokkaa" title="Muokkaa keskusteluaihetta" class="myButton8"  role="button"  style="padding:2px 4px"></form>';

            echo'<form action="aktivoikeskustelu.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><button class="roskis" title="Poista keskustelu" name="painikepoista"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button>'
            . '</form>';



            if (!$haekeskustelu = $db->query("select distinct * from keskustelut where kurssi_id='" . $_SESSION["KurssiId"] . "' order by id desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            if ($haekeskustelu->num_rows == 0) {

                echo'<br><br><em>Ei viestejä</em><br><br>';
            } else {
                echo'<br><p id="ohje"><em>Yksittäisen viestin saat poistettua klikkaamalla sitä. Samalla saat selville sen lähettäneen opiskelijan.</em></p>';
                echo'<div class="cm8-margin-top"><br></div>';

                if (!$haekeskustelu = $db->query("select distinct * from keskustelut where kurssi_id='" . $_SESSION["KurssiId"] . "' order by id desc")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                if ($haekeskustelu->num_rows != 0) {


                    echo'<form action="poistakeskustelutvarmistus.php" method="post"  style="margin-bottom: 0px;margin-right: 30px; display: inline-block">';
                    echo'<button class="pieniroskis" title="Poista kaikki viestit"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista kaikki viestit</button>';
                    echo'</form>';
                }

                echo'<div id="chatlogs"></div>';
            }



            if (!$haekeskustelu = $db->query("select distinct * from keskustelut where kurssi_id='" . $_SESSION["KurssiId"] . "' order by id desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            if ($haekeskustelu->num_rows != 0) {


                echo'<form action="poistakeskustelutvarmistus.php" method="post"  style="margin-bottom: 0px;margin-right: 30px; display: inline-block">';
                echo'<button class="pieniroskis" title="Poista kaikki viestit"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista kaikki viestit</button>';
                echo'</form>';
            }





            echo'<div class="cm8-margin-top"></div>';





            echo'</div>';
        }
    }




    echo'</div>';

    echo'</div>';
    echo'</div>';
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



include("footer.php");
?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="js/tekstieditori.js"></script>

<script>
    $(document).ready(function () {
        $('.content').richText({

            translations: {
                'title': 'Otsikko',
                '#f7f9f7': 'Valkoinen',
                '#2b6777': 'Musta',
                'brown': 'Ruskea',
                'beige': 'Beige',
                'darkBlue': 'Tummansininen',
                'blue': 'Sininen',
                'lightBlue': 'Vaaleansininen',
                'darkRed': 'Tummanpunainen',
                'red': 'Punainen',
                'darkGreen': 'Tummanvihreä',
                'green': 'Vihreä',
                'purple': 'Purppura',
                'darkTurquois': 'Tekstin oletusväri',
                'turquois': 'Turkoosi',
             'darkOrange': 'Tummanoranssi',
                            'orange': 'Oranssi',
                'yellow': 'Keltainen',
                'imageURL': 'Kuvan URL-osoite',
                'fileURL': 'Tiedoston URL-osoite',
                'linkText': 'Linkin teksti',
                'url': 'URL-osoite',
                'size': 'Koko',
                'responsive': '<a href="https://www.jqueryscript.net/tags.php?/Responsive/">Responsiivinen</a>',
                'text': 'Teksti',
                'openIn': 'Avaa..',
                'sameTab': 'Samassa välilehdessä',
                'newTab': 'Uudessa välilehdessä',
                'align': 'Kohdistus',
                'left': 'Vasemmalle',
                'center': 'Keskelle',
                'right': 'Oikealle',
                'rows': 'Rivit',
                'columns': 'Sarakkeet',
                'add': 'Lisää',
                'pleaseEnterURL': 'Anna URL-osoite',
                'videoURLnotSupported': 'Videon URL-osoitetta ei ole tuettu',
                'pleaseSelectImage': 'Valitse kuva',
                'pleaseSelectFile': 'Valitse tiedosto',
                'bold': 'Bold',
                'italic': 'Italic',
                'underline': 'Underline',
                'alignLeft': 'Kohdistus vasemmalle',
                'alignCenter': 'Kohdistus keskelle',
                'alignRight': 'Kohdistus oikealle',
                'addOrderedList': 'Lisää järjestetty lista',
                'addUnorderedList': 'Lisää järjestämätön lista',
                'addHeading': 'Lisää otsikko',
                'addFont': 'Fontti',
                'addFontColor': 'Fontin väri',
                'addFontSize': 'Fontin koko',
                'addImage': 'Lisää kuva',
                'addVideo': 'Lisää video',
                'addFile': 'Lisää tiedosto',
                'addURL': 'Lisää URL-osoite',
                'addTable': 'Lisää taulukko',
                'removeStyles': 'Poista muotoilut',
                'code': 'Näytä HTML-koodi',
                'undo': 'Kumoa',
                'redo': 'Tee uudelleen',
                'close': 'Sulje'
            },

        });
    });
</script>
</body>
</html>		

