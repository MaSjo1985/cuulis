<?php
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title> Ota yhteyttä</title>
<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script><script src="https://code.jquery.com/jquery-1.10.2.js"></script>';
echo'<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
<script type="text/javascript" src="js/TimeCircles.js"></script>

<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script>';
echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js">   </script>
<script src="js/jquery.barrating.min.js"></script>';

$urlmihin = $_SERVER[REQUEST_URI];

$urlmihin = substr($urlmihin, 1);

$url = $_SERVER[REQUEST_URI];
$url = substr($url, 1);
$url = strtok($url, '?');

$url2 = $_SERVER[REQUEST_URI];

$url2 = substr($url2, 1);

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    include("header.php");
    echo'
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>



<script src="basic-javascript-functions.js" language="javascript" type="text/javascript"></script>';
    echo'
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js">   </script>
<script src="js/jquery.barrating.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>';

    echo' <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  <script type="text/javascript" src="jscm/jquery.timepicker.js"></script>
        <script src="jscm/jquery-ui.js"></script>
        <script type="text/javascript" src="/js/fi.js"></script>';
    if (!$resultoma = $db->query("select * from kayttajan_arvostelu where kayttaja_id = '" . $_SESSION["Id"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></figure></a></p></footer>');
    }
    if ($resultoma->num_rows == 0) {
        echo'<input type="hidden" id="oma" value="0"></>';
    } else {
        while ($row = $resultoma->fetch_assoc()) {
            $oma = $row[arvo];
        }
        echo'<input type="hidden" id="oma" value=' . $oma . '></>';
    }






    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');

    $url2 = $_SERVER[REQUEST_URI];

    $url2 = substr($url2, 1);


    echo'<div class="cm8-half" style="padding-bottom: 0px;padding-top: 0px; padding-left: 0px; margin-left: 0px">';
    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'opiskelija') {


        if ($_SESSION["Rooli"] == 'opiskelija' && $_SESSION["vaihto"] == 1) {


            echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3-valittu" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a><a href="bugi.php" class="cm8-linkk3" title="Löytyikö virheitä/onko kehitysideoita?" >🙋 &nbsp Kehitysideoita?</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';


            echo'<form action="vaihda.php" method="post" style="display: inline-block; margin-left: 40px"><input type="hidden" name="url" value="' . $url . '" ><input type="hidden" name="mihin" value="etu"><input type="hidden" name="'
            . '" value="pois"> <input type="submit" value="Poistu opiskelijanäkymästä" class="munNappula2"  role="button"></form>';
        } else {

            echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3-valittu" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a><a href="bugi.php" class="cm8-linkk3" title="Löytyikö virheitä/onko kehitysideoita?" >🙋 &nbsp Kehitysideoita?</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';
        }
    } else if ($_SESSION["Rooli"] == 'opeadmin' || $_SESSION["Rooli"] == 'admink') {
        echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3-valittu" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a><a href="bugi.php" class="cm8-linkk3" title="Löytyikö virheitä/onko kehitysideoita?" >🙋 &nbsp Kehitysideoita?</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';
    } else {
        echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a>
  	
 <a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i></a></p>';
    }
    echo'</div>';
    echo'<div class="cm8-quarter" style="padding-top: 0px;padding-left: 0px; margin-left: 0px">';
    echo'<p style="display: inline-block; margin-right: 20px; padding-top: 10px; margin-top: 0px; margin-bottom: 0px" ><select id="example">
  <option style="display: inline-block" value="1">1</option>
  <option style="display: inline-block" value="2">2</option>
  <option style="display: inline-block" value="3">3</option>
  <option style="display: inline-block" value="4">4</option>
  <option style="display: inline-block" value="5">5</option>
</select></p>';


    echo'<div style="display: inline-block; font-size: 0.8em; padding: 0px; margin: 0px" id="keski" ></div>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    ?>
    <script type="text/javascript">
        $(function () {
            var value = document.getElementById('oma').value;


            $('#example').barrating({
                theme: 'fontawesome-stars',
                deselectable: true,
                initialRating: document.getElementById('oma').value,
                allowEmpty: true,
                onSelect: function (value, text, event) {

                    // rating was selected by a user
                    var arvo = text;

                    $.ajax({
                        type: 'post',
                        url: 'kirjaa.php',
                        data: {arvo: arvo},
                        dataType: 'json',
                        success: function (data) {


                        }
                    });
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById('keski').innerHTML = xmlhttp.responseText;
                        }


                    }


                    xmlhttp.open('GET', 'haekeski.php', true);
                    xmlhttp.send();

                }

            });

            $('#example').barrating('set', value);

        });
    </script>
    <?php
    ob_start();
    echo'<div class="cm8-container7">';

    if ($_SESSION["Rooli"] == 'admin')
        include("adminnavi.php");
    else if ($_SESSION["Rooli"] == 'admink')
        include("adminknavi.php");
    else if ($_SESSION["Rooli"] == 'opeadmin')
        include("opeadminnavi.php");
    else if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "opiskelija")
        include ("opnavi.php");


    echo'<div class="cm8-half" style="padding-top: 0px; margin-left: 0px; margin-top: 0px">';

    if (!$result = $db->query("select * from kayttajat where id='" . $_SESSION["Id"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($row = $result->fetch_assoc()) {
        $nimi = $row[etunimi] . " " . $row[sukunimi];
        $sposti = $row[sposti];
    }


    if ($_SESSION["Rooli"] <> 'admink' && $_SESSION["Rooli"] <> 'opeadmin') {
        if (!$result2 = $db->query("select distinct koulut.Nimi as Nimi, koulut.id as kid from kayttajankoulut, koulut where kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.odottaa=1 AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($result2->num_rows > 1) {

            echo '<form action="yhteydenotto2.php" method="post" class="form-style-k"><fieldset>';
            echo' <legend>Lähetä viesti oppilaitoksen ylläpitäjälle </legend>';
            echo '<a href="etusivu.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa etusivulle</a><br><br>';
            echo'<br><b>Olet liittynyt useaan eri oppilaitokseen. Valitse, minkä oppilaitoksen ylläpitäjään haluat ottaa yhteyttä:</b><br><br>';

            echo'<select name="kouluid">';

            while ($row2 = $result2->fetch_assoc()) {
                echo'
				<option value=' . $row2[kid] . '>' . $row2[Nimi];
            }

            echo'</select><br><br>';

            echo'<br><input type="submit" value="&#10003 Valitse" class="myButton9">
				</fieldset></form>';
        } else {

            while ($row2 = $result2->fetch_assoc()) {
                $kouluid = $row2[kid];
                $Nimi = $row2[Nimi];
            }
            if (!$resultv = $db->query("select * from kayttajat, koulunadminit where koulu_id='" . $kouluid . "' AND koulunadminit.kayttaja_id=kayttajat.id")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowv = $resultv->fetch_assoc()) {
                $nimiv = $rowv[etunimi] . " " . $rowv[sukunimi];
                $spostiv = $rowv[sposti];
            }

            if ($resultv->num_rows == 0) {
                if (!$resultv = $db->query("select * from kayttajat where rooli='admin'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                while ($rowv = $resultv->fetch_assoc()) {
                    $nimiv = $rowv[etunimi] . " " . $rowv[sukunimi];
                    $spostiv = $rowv[sposti];
                }
            }


            echo'<form class="form-style-k" action="lahetayhteydenotto.php" method="post"><fieldset>';
            echo' <legend>Lähetä viesti oppilaitoksen ' . $Nimi . ' ylläpitäjälle</legend>';
            echo '<a href="etusivu.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa etusivulle</a><br><br>';
            echo'<br><p style="font-weight: normal"><b>Lähettäjän nimi:</b>&nbsp&nbsp&nbsp <input type="hidden" name="nimi" value="' . $nimi . '"> ' . $nimi . ' </p>
			<br><p style="font-weight: normal"><b>Lähettäjän käyttäjätunnus:</b>&nbsp&nbsp&nbsp <input type="hidden" size="30" name="sposti" value=' . $sposti . '> ' . $sposti . ' </p> 	
			 <input type="hidden" name="id" value="' . $kouluid . '">
                         <input type="hidden" name="url" value="' . $urlmihin . '">';

            echo' <br><p style="font-weight: normal"><b>Vastaanottajan nimi:</b> &nbsp&nbsp&nbsp ' . $nimiv . ' </p>';
            if ($_SESSION[Rooli] == 'admin' || $_SESSION[Rooli] == 'admink' || $_SESSION[Rooli] == 'opeadmin') {

                echo'<br><p style="font-weight: normal"><b>Vastaanottajan sähköpostiosoite:</b> &nbsp&nbsp&nbsp ' . $spostiv . ' </p> ';
            }
            echo'<br><p><b> Viesti: </b><br><textarea name="viesti" style="width: 80%" rows="8"></textarea></p> <br><br> 

   	<input type="submit" class="myButton9" value="📧 &nbsp Lähetä" style="padding-bottom: 5px" >
		  </fieldset></form>';
        }
    } else {

        if (!$haekoulut = $db->query("select distinct koulut.id as id, koulut.Nimi as Nimi from koulut, kayttajankoulut where koulut.id=kayttajankoulut.koulu_id AND kayttaja_id='" . $_SESSION[Id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($haekoulut->num_rows > 1) {

            echo'<p style="margin-left: 20px; margin-top:40px; font-size: 1.2em; font-weight: bold; color: #c7ef00">Valitse kenelle haluat lähettää yhteydenottoviestin</p>';

            while ($rowkoulut = $haekoulut->fetch_assoc()) {
                $kouluidk = $rowkoulut[id];
                $koulunimi = $rowkoulut[Nimi];

                if ($_SESSION[kouluId] != $kouluidk) {
                    if (!$haeadminit = $db->query("select distinct etunimi, sukunimi, sposti from kayttajat, koulunadminit where kayttajat.id=koulunadminit.kayttaja_id AND kayttaja_id <> '" . $_SESSION[Id] . "' and koulu_id='" . $kouluidk . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($rowadminit = $haeadminit->fetch_assoc()) {
                        $nimia = $rowadminit[etunimi] . " " . $rowv[sukunimi];
                        $spostia = $rowadminit[sposti];
                    }
                    if ($haeadminit->num_rows == 0) {
                        if (!$resultv = $db->query("select * from kayttajat where rooli='admin'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }


                        while ($rowv = $resultv->fetch_assoc()) {
                            $nimia = $rowv[etunimi] . " " . $rowv[sukunimi];
                            $spostia = $rowv[sposti];
                        }
                    }
                    echo'<form class="form-style-k" action="lahetayhteydenotto.php" method="post"><fieldset>';

                    echo' <legend>Lähetä viesti oppilaitoksen ' . $koulunimi . ' ylläpitäjälle ' . $nimia . '</legend>';
                    echo '<a href="etusivu.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';

                    echo'   <br><p style="font-weight: normal"><b>Lähettäjän nimi:</b>&nbsp&nbsp&nbsp <input type="hidden" name="nimi" value="' . $nimi . '"> ' . $nimi . ' </p>
			<br><p style="font-weight: normal"><b>Lähettäjän käyttäjätunnus:</b><input type="hidden" size="30" name="sposti" value=' . $sposti . '> ' . $sposti . ' </p> 	

<input type="hidden" name="id" value="0">';

                    echo' <br><p style="font-weight: normal"><b>Vastaanottajan nimi:</b> &nbsp&nbsp&nbsp ' . $nimia . ' </p> 
<br><p style="font-weight: normal"><b>Vastaanottajan sähköpostiosoite:</b> &nbsp&nbsp&nbsp ' . $spostia . ' </p> ';
                    echo'<br><p><b> Viesti: </b><br><textarea name="viesti" style="width: 80%" rows="8"></textarea></p> <br><br> 
			
		 <input type="hidden" name="url" value="' . $urlmihin . '">

       	<input type="submit" class="myButton9" value="📧 &nbsp Lähetä" style="padding-bottom: 5px" >
    

	
		  </fieldset></form>';
                }
            }





            if (!$resultv = $db->query("select * from kayttajat where rooli='admin'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowv = $resultv->fetch_assoc()) {
                $nimiv = $rowv[etunimi] . " " . $rowv[sukunimi];
                $spostiv = $rowv[sposti];
            }


            echo'<form class="form-style-k" action="lahetayhteydenotto.php" method="post"><fieldset>';

            echo' <legend>Lähetä viesti Cuulis-oppimisympäristön ylläpitäjälle</legend>';
            echo '<a href="etusivu.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';

            echo'   <br><p style="font-weight: normal"><b>Lähettäjän nimi:</b>&nbsp&nbsp&nbsp <input type="hidden" name="nimi" value="' . $nimi . '"> ' . $nimi . ' </p>
			<br><p style="font-weight: normal"><b>Lähettäjän käyttäjätunnus:</b><input type="hidden" size="30" name="sposti" value=' . $sposti . '> ' . $sposti . ' </p> 	

<input type="hidden" name="id" value="0">';

            echo' <br><p style="font-weight: normal"><b>Vastaanottajan nimi:</b> &nbsp&nbsp&nbsp ' . $nimiv . ' </p> 
<br><p style="font-weight: normal"><b>Vastaanottajan sähköpostiosoite:</b> &nbsp&nbsp&nbsp ' . $spostiv . ' </p> ';
            echo'<br><p><b> Viesti: </b><br><textarea name="viesti" style="width: 80%" rows="8"></textarea></p> <br><br> 
			
		 <input type="hidden" name="url" value="' . $urlmihin . '">

       	<input type="submit" class="myButton9" value="📧 &nbsp Lähetä" style="padding-bottom: 5px" >
    

	
		  </fieldset></form>';
        } else {
            if (!$resultv = $db->query("select * from kayttajat where rooli='admin'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowv = $resultv->fetch_assoc()) {
                $nimiv = $rowv[etunimi] . " " . $rowv[sukunimi];
                $spostiv = $rowv[sposti];
            }


            echo'<form class="form-style-k" action="lahetayhteydenotto.php" method="post"><fieldset>';

            echo' <legend>Lähetä viesti Cuulis-oppimisympäristön ylläpitäjälle</legend>';
            echo '<a href="etusivu.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';

            echo'   <br><p style="font-weight: normal"><b>Lähettäjän nimi:</b>&nbsp&nbsp&nbsp <input type="hidden" name="nimi" value="' . $nimi . '"> ' . $nimi . ' </p>
			<br><p style="font-weight: normal"><b>Lähettäjän käyttäjätunnus:</b><input type="hidden" size="30" name="sposti" value=' . $sposti . '> ' . $sposti . ' </p> 	

<input type="hidden" name="id" value="0">';

            echo' <br><p style="font-weight: normal"><b>Vastaanottajan nimi:</b> &nbsp&nbsp&nbsp ' . $nimiv . ' </p> 
<br><p style="font-weight: normal"><b>Vastaanottajan sähköpostiosoite:</b> &nbsp&nbsp&nbsp ' . $spostiv . ' </p> ';
            echo'<br><p><b> Viesti: </b><br><textarea name="viesti" style="width: 80%" rows="8"></textarea></p> <br><br> 
			
		 <input type="hidden" name="url" value="' . $urlmihin . '">

       	<input type="submit" class="myButton9" value="📧 &nbsp Lähetä" style="padding-bottom: 5px" >
    

	
		  </fieldset></form>';
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
    header("location: kirjautuminen.php?url=" . $url);
}
?>
</body>
</html>		