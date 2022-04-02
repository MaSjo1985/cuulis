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





        if (isset($_POST['painikea']) || isset($_POST['painikem'])) {



            echo '<div class="cm8-margin-top"></div>';
            echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"><h2 style="padding-top: 0px; padding-ledt: 10px">Keskustele</h2></div>';





            echo'<div class="cm8-threequarter" style="padding-top: 10px">';

            if (!$haeakt = $db->query("select distinct * from kurssin_keskustelut where id='" . $_POST[id] . "' and tyhja=1")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowa = $haeakt->fetch_assoc()) {
                $id = $roa[id];
                $otsikko = $rowa[otsikko];
                $kaihe = $rowa[keskusteluaihe];
            }
            $kaihe = str_replace('<br />', "", $kaihe);
            echo '<form action="aktivoikeskustelu28.php" method="post" class="form-style-k"><fieldset>';

            echo'<label style="color: #2b6777; padding-top:20px; font-weight: bold; font-size: 1.2em">Muokkaa keskusteluaihetta</label>';

            echo'<a href="keskustelut.php"><b style="font-weight: normal; font-size: 1.5em; display: inline-block; padding:0; margin: 0">&#8630</b> Palaa takaisin</a><br><br><br>';
            echo'<b>Otsikko: <br><br>
	<textarea name="otsikko" maxlength="255" rows="2">' . $otsikko . '</textarea><br><br>';
            echo'<b>Lisätietoja: </b> <br><br>
	<textarea class="content" name="aihe" rows="2">' . $kaihe . '</textarea><br><br>

	<input type="hidden" name="id" value=' . $id . '>

	<input type="submit" value="&#10003 Tallenna" class="myButton9">			
		</fieldset></form>';



            echo'</div><div class="cm8-third"></div></div></div>';
        } else if (isset($_POST['painikep'])) {

            $db->query("delete from keskustelut where id = '" . $_POST[id] . "'");
            if (!$haekaikki = $db->query("select distinct * from keskustelut where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');

                if ($haekaikki->num_rows == 0) {

                    $db->query("update kurssit set keskakt=0 where kurssi_id = '" . $_SESSION[KurssiId] . "'");
                }
            }



            header("location: keskustelut.php");
        } else if (isset($_POST['painikepoista'])) {

            header("location: poistakeskusteluvarmistus.php?id=" . $_POST[id]);
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