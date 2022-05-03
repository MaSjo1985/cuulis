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
    if (isset($_REQUEST["destination"])) {
        header("Location: {$_REQUEST["destination"]}");
    } else {
//       if (!isset($_GET[r])) {
//
//        if (!$hae_eka = $db->query("select * from kurssin_keskustelut where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
//            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//        }
//
//        if($hae_eka -> num_rows != 0){
//             while ($rivieka = $hae_eka->fetch_assoc()) {
//            $eka_id = $rivieka[id];
// 
//   header('location: keskustelut.php?r=' . $eka_id);
//            
//            
//             }
//
//
//   
//        }
//       
//    }
    }


    echo'<p  style="color: #2b6777; font-size: 0.1em" id="haeid" >' . $_GET[r] . '</p>';
    include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';



    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';


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
    echo'<div class="cm8-third" style="padding-left: 20px;"><h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px" id="lisaa">Keskustele</h2>';
    echo'<div class="cm8-margin-top" ></div>';
    echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; width: 80%; padding-left: 0px">';


    $oikea = str_replace('/', '', $_SERVER["REQUEST_URI"]);

    if (!$haeprojekti = $db->query("select * from kurssin_keskustelut where id='" . $_GET[r] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($haeprojekti->num_rows != 0) {

        while ($rowP = $haeprojekti->fetch_assoc()) {
            $otsikko = $rowP[otsikko];
            $id = $rowP[id];
            $idtoinen = $rowP[id] . "/";
            if ($_GET[r] == $id || $_GET[r] == $idtoinen) {

                echo'<a href="keskustelut.php?r=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.3em; ">&#9997 &nbsp&nbsp&nbsp' . $otsikko . ' </b></a>';
            }
        }
    }
    echo'</nav>';


    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo '<div class="cm8-margin-top"></div>';
        echo'<form action="aktivoikeskustelu.php" method="post" ><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikea" value="+ Lisää keskustelu" class="myButton8" role="button" style="font-size: 0.9em; padding:2px 4px"></form>';
        echo '<div class="cm8-margin-top"></div>';
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
    echo'<div class="cm8-margin-top"></div>';

    echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; width: 80%; padding-left: 0px">';



    if ($haeprojekti->num_rows != 0) {

        while ($rowP = $haeprojekti->fetch_assoc()) {
            $otsikko = $rowP[otsikko];
            $id = $rowP[id];
            $idtoinen = $rowP[id] . "/";

            if ($_GET[r] != $id && $_GET[r] != $idtoinen)
                echo'<a href="keskustelut.php?r=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 10px 6px 10px 40px"><b style="font-size: 1.3em; ">' . $otsikko . '</b></a>';
        }
        echo'<div class="cm8-margin-top"></div>';
    }

    echo'</nav></div>';



    echo'<div class="cm8-third" style="padding-top: 30px">';



    if ($_SESSION["Rooli"] == 'opiskelija') {


        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[keskakt];
        }
        if ($akt == 0) {
            echo'<br><em>Ei keskusteluja.</em></div>';
        } else if ($akt == 1 && !isset($_GET[r])) {
            echo'Valitse haluamasi keskustelu';
        } else {

            if (!$haekesk = $db->query("select distinct * from kurssin_keskustelut where id='" . $_GET[r] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowak = $haekesk->fetch_assoc()) {
                $kaihe = $rowak[keskusteluaihe];
                $otsikko = $rowak[otsikko];
            }
            $otsikko = htmlspecialchars_decode($otsikko);
            $kaihe = htmlspecialchars_decode($kaihe);
            echo'<h6>' . $otsikko . '</h6><br><br>';
            echo'<h6 style="display: inline-block; ">' . $kaihe . '</h6>';






            echo'<div class="cm8-margin-top"></div>';
            echo'<div id="chatlogs"></div>';





            echo'</div>';


            if (!$haeakt = $db->query("select distinct * from kurssit where keskakt = 1 AND id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($haeakt->num_rows != 0) {

                echo'<div class="cm8-third" style="padding-left: 40px;">';
                $nimi = $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"];




                echo'<form name="form1" class="form-style-k" style="width: 80%; background-color: white"><fieldset style="border: 2px solid #f5e1da">';



                echo'<b>Nimimerkki:</b><br><br><em style="font-style: normal; font-size: 0.9em">Voit laittaa viestin myös nimettömänä, kun otat tämän nimen pois</em> <br><br>
                                                                
                                                               <textarea name="nimi" rows="1" style="font-size:0.9em">' . $nimi . '</textarea><br>';

                echo'<br><br><b>Viesti:</b> <br> <br><textarea id="sendie" name="uusi" rows="8"  style="font-size:0.9em"></textarea>
								<input type="hidden" name="paiva" value=' . $paiva . '>
								<input type="hidden" name="kello" value=' . $kello . '>
                                                                    <input type="hidden" name="id" value=' . $_GET[r] . '>
                                                                           <input type="hidden" id="haeid" value=' . $_GET[r] . '>
								
<br><br><input type="submit" onClick="submitChat2()"  class="myButton9" value="&#10147 Lähetä" /> 
                                           <input type="hidden" name="destination" value=' . $oikea . '/>                     
                                                    </fieldset></form>';
                echo'</div>';
            }
        }
    } else {

        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[keskakt];
        }
        if ($akt == 0) {
            echo'<br><em>Ei keskusteluja.</em><form action="aktivoikeskustelu.php" method="post"><br><br><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikea" value="+ Lisää keskustelu" class="myButton8" role="button" style="font-size: 1em; padding:2px 4px"></form></div>';
        } else if ($akt == 1 && !isset($_GET[r])) {
            echo'Valitse haluamasi keskustelu';
        } else {

            if (!$haekesk = $db->query("select distinct * from kurssin_keskustelut where id='" . $_GET[r] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowak = $haekesk->fetch_assoc()) {
                $kaihe = $rowak[keskusteluaihe];
                $otsikko = $rowak[otsikko];
            }
            $otsikko = htmlspecialchars_decode($otsikko);
            $kaihe = htmlspecialchars_decode($kaihe);
            echo'<h6>' . $otsikko . '</h6><br><br>';
            echo'<h6 style="display: inline-block; ">' . $kaihe . '</h6>';


            echo'<form action="aktivoikeskustelu.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $_GET[r] . '><input type="submit" name="painikem" value="&#9998 Muokkaa" title="Muokkaa keskusteluaihetta" class="myButton8"  role="button"  style="padding:2px 4px"></form>';

            echo'<form action="aktivoikeskustelu.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $_GET[r] . '><button class="roskis" title="Poista keskustelu" name="painikepoista"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button>'
            . '</form>';



            echo'<br><p id="ohje"><em>Viestin lähettäjän saat selville klikkaamalla viestiä.</em></p>';
            echo'<div class="cm8-margin-top"><br></div>';

            if (!$haekeskustelu = $db->query("select distinct * from keskustelut where kurssin_keskustelut_id='" . $_GET[r] . "' order by id desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            if ($haekeskustelu->num_rows != 0) {


                echo'<form action="poistakeskustelutvarmistus.php" method="post"  style="margin-bottom: 0px;margin-right: 30px; display: inline-block">';
                echo'<button class="pieniroskis" title="Poista kaikki viestit"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista kaikki viestit</button>';
                echo'<input type="hidden" name="id" value=' . $_GET[r] . '>';
                echo'<br><br></form>';
            }

            echo'<div id="chatlogs"></div>';




            if (!$haekeskustelu = $db->query("select distinct * from keskustelut where kurssin_keskustelut_id='" . $_GET[r] . "' order by id desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            if ($haekeskustelu->num_rows != 0) {


                echo'<br><form action="poistakeskustelutvarmistus.php" method="post"  style="margin-bottom: 0px;margin-right: 30px; display: inline-block">';
                echo'<button class="pieniroskis" title="Poista kaikki viestit"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista kaikki viestit</button>';
                echo'<input type="hidden" name="id" value=' . $_GET[r] . '>';
                echo'</form>';
            }











            echo'</div>';
            if (!$haeakt = $db->query("select distinct * from kurssit where keskakt = 1 AND id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($haeakt->num_rows != 0) {
                echo'<div class="cm8-third" style="padding-left: 40px;">';
                $nimi = $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"];

                echo'<form name="form1" class="form-style-k" style="width: 80%; background-color: white"><fieldset style=" padding-right: 20px; border: 2px solid #f5e1da">
						<b>Nimimerkki:</b> <br><br><textarea name="nimi" rows="2" style="font-size:0.9em">' . $nimi . '</textarea><br><br><b>Viesti:</b> <br> <br><textarea id="sendie"  class="content" name="uusi" rows="2" style="font-size:0.9em" ></textarea>
								<input type="hidden" name="paiva" value=' . $paiva . '>
								<input type="hidden" name="kello" value=' . $kello . '>
                                                              <input type="hidden" name="id" value=' . $_GET[r] . '>
                                                                   <input type="hidden" id="haeid" value=' . $_GET[r] . '>
 <br><br><input type="submit"  onClick="submitChat2()"  class="myButton9" id="tanne" value="&#10147 Lähetä" />
<input type="hidden" name="destination" value=' . $oikea . '/>
								</fieldset></form>';
                echo'</div>';
            }
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

