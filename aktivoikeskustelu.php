<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Keskusteluaiheen muokkaus </title>';

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



        echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 0px; border: none">';
        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[keskakt];
        }
        if ($akt == 0) {
            echo'<div class="cm8-quarter" ><h2 style="padding-top: 0px; padding-left: 10px; padding-bottom: 0px" id="lisaa">Keskustele</h2>';
        } else {

            echo'<div class="cm8-quarter" ><h2 style="padding-top: 0px; padding-left: 10px; padding-bottom: 0px" id="lisaa">Keskustele</h2>';

            echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; width: 90%;padding-left: 10px">';

            echo'<div class="cm8-sidenav" style="padding-left: 0px; margin-left: 0px; padding-top: 20px; margin-top:0px;  margin-left: 0px; height: 100%;">';

            if (!$haeonko = $db->query("select * from kurssin_keskustelut where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $onyksi = false;
            if ($haeonko->num_rows == 1) {
                $onyksi = true;
            }


            if (!$haeprojekti = $db->query("select * from kurssin_keskustelut where id='" . $_POST[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($haeprojekti->num_rows != 0) {

                while ($rowP = $haeprojekti->fetch_assoc()) {
                    $otsikko = $rowP[otsikko];
                    $id = $rowP[id];
                    $idtoinen = $rowP[id] . "/";
                    if ($_POST[id] == $id || $_POST[id] == $idtoinen) {

                        echo'<a href="keskustelut.php?r=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 6px 10px"><b style="font-size: 1em; ">&#9997 &nbsp&nbsp&nbsp' . $otsikko . ' </b></a>';
                    }
                    else{
                        echo'<sdas';
                    }
                }
            }





            if (!$haeprojekti3 = $db->query("select * from kurssin_keskustelut where kurssi_id='" . $_SESSION["KurssiId"] . "' ")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }



            if (!$haeakt = $db->query("select distinct * from kurssit where keskakt = 1 AND id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }




            if (!$haeprojekti = $db->query("select * from kurssin_keskustelut where kurssi_id='" . $_SESSION[KurssiId] . "' order by id desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }




            if ($haeprojekti->num_rows != 0) {

                while ($rowP = $haeprojekti->fetch_assoc()) {
                    $otsikko = $rowP[otsikko];
                    $id = $rowP[id];
                    $idtoinen = $rowP[id] . "/";

                    if ($_POST[id] != $id && $_POST[id] != $idtoinen){
                        echo'<a href="keskustelut.php?r=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px; padding: 3px 6px 6px 10px"><b style="font-size: 1em; ">' . $otsikko . '</b></a>';
                    }  
                        
                    }
                echo'<div class="cm8-margin-top"></div>';
            }
            if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

                if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowa = $haeakt->fetch_assoc()) {
                    $akt = $rowa[keskakt];
                }
                if ($akt != 0) {
                
                }
            }
            echo' </div></nav>';
        }
        echo'</div>';







        echo'<div class="cm8-half" style="margin-top: 0px; padding-top: 0px">';

        if (isset($_POST['painikea'])) {

            echo '<form action="aktivoikeskustelu2.php" method="post" class="form-style-k" style="width: 80%; margin-top:20px" ><fieldset>';

            echo'<legend>Lisää keskustelu</legend>';

            echo'<a href="keskustelut.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br><br>';
            echo'<p>Otsikko: <br>
	<textarea name="otsikko" maxlength="255" rows="2"></textarea></p><br>';
            echo'<p style="font-weight: normal; color: inherit"><br><b>Infotaulun teksti: </b><br><br>
	<textarea class="content"  name="aihe" rows="2"></textarea></p><br>

	<input type="hidden" name="kid" value=' . $_SESSION[KurssiId] . '>

	<br><input type="submit" value="&#10003 Tallenna" class="myButton9">			
		</fieldset></form>';



            echo'</div><div class="cm8-third"></div></div></div>';
        }
        if (isset($_POST['painikemo'])) {


            if (!$haeakt = $db->query("select distinct * from kurssin_keskustelut where id='" . $_POST[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowa = $haeakt->fetch_assoc()) {
                $otsikko = $rowa[otsikko];
            }
            $otsikko = str_replace('<br />', "", $otsikko);
            echo '<form action="aktivoikeskustelu3.php" method="post" class="form-style-k" style="width: 80%; margin-top:20px"><fieldset>';

            echo'<legend>Muokkaa otsikkoa</legend>';

            echo'<a href="keskustelut.php?r=' . $_POST[id] . '"  class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br><br>';
            echo'<p>Otsikko: <br><br>
	<textarea name="otsikko" maxlength="255" rows="2" >' . $otsikko . '</textarea></p><br>';


            echo'<input type="hidden" name="id" value=' . $_POST[id] . '>

	<br><input type="submit" value="&#10003 Tallenna" name="tallennao" class="myButton9">			
		</fieldset></form>';



            echo'</div><div class="cm8-third"></div></div></div>';
        }
        if (isset($_POST['painikemt'])) {


            if (!$haeakt = $db->query("select distinct * from kurssin_keskustelut where id='" . $_POST[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowa = $haeakt->fetch_assoc()) {
                $otsikko = $rowa[otsikko];
                $kaihe = $rowa[keskusteluaihe];
            }
            $kaihe = str_replace('<br />', "", $kaihe);
            echo '<form action="aktivoikeskustelu3.php" method="post" class="form-style-k" style="width: 80%; margin-top:20px"><fieldset>';

            echo'<legend>Muokkaa infotaulun tekstiä</legend>';

            echo'<a href="keskustelut.php?r=' . $_POST[id] . '"  class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br><br>';

            echo'<p style="font-weight: normal; color: inherit"><b>Infotaulun teksti: </b><br><br>
	<textarea class="content" name="aihe" rows="2">' . $kaihe . '</textarea></p><br>

	<input type="hidden" name="id" value=' . $_POST[id] . '>

	<br><input type="submit" value="&#10003 Tallenna" name="tallennat" class="myButton9">			
		</fieldset></form>';



            echo'</div><div class="cm8-third"></div></div></div>';
        } else if (isset($_POST['painikepoista'])) {

            header("location: poistakeskusteluvarmistus.php?r=" . $_POST[id]);
        }
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
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="js/tekstieditori.js"></script>

<script>
    $(document).ready(function () {
        $('.content').richText({

            translations: {
                'title': 'Otsikko',
                'white': 'Valkoinen',
                'black': 'Musta',
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