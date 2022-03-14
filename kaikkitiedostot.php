<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Palvelimella olevat tiedostot </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


ini_set('display_errors', '0');
 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "admin") {

        echo'
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
<meta charset="UTF-8">
<link rel="stylesheet" href="css/TimeCircles.css" />
<link href="https://fonts.googleapis.com/css?family=Playfair+Display+SC:400,700" rel="stylesheet" type="text/css"> <link href="//fonts.googleapis.com/css?family=Questrial" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Actor" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css"> <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Neucha" /><link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="csscm/jquery-ui.css" rel="stylesheet" />
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="css/trontastic.css" />
<link rel="stylesheet" type="text/css" href="jscm/jquery.timepicker.css" /><link rel="stylesheet" type="text/css" href="jscm/jquery.datepicker.css" />
<link rel="shortcut icon" href="favicon.png" type="image/png">
<link rel="stylesheet" href="css/TimeCircles.css" />
 

<link href="ulkoasu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

<link rel="stylesheet" href="css/fontawesome-stars.css">
<link rel="stylesheet" href="css/fontawesome-stars-o.css">

<script src="funktioita.js" language="javascript" type="text/javascript"></script>
<script src="basic-javascript-functions.js" language="javascript" type="text/javascript"></script>


<script src="js/jquery-2.1.3.js"></script>
<script src="js/tableHeadFixer.js"></script>
<script src="js/jquery.barrating.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>



</head>
  <body onload="lataa()">';

        echo'<div class="cm8-container" style="padding-top: 5px; padding-bottom: 5px;padding-left: 20px">';
        echo'<div class="cm8-quarter" style="padding: 0px; margin:0px">';
        echo'<h1 style="padding-bottom: 0px; display: inline-block;"><a href="etusivu.php">Cuulis</h1>
  <b style="font-size: 0.8em; display: inline-block">&nbsp - &nbspoppimisympäristö</b></a>';

        echo'</div>';



        //floatHead ei tartte tätä: <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        if (!$resultoma = $db->query("select * from kayttajan_arvostelu where kayttaja_id = '" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></figure></a></p></footer>');
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


                echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';


                echo'<form action="vaihda.php" method="post" style="display: inline-block; margin-left: 40px"><input type="hidden" name="url" value="' . $url . '" ><input type="hidden" name="mihin" value="etu"><input type="hidden" name="'
                . '" value="pois"> <input type="submit" value="Poistu opiskelijanäkymästä" class="munNappula2"  role="button"></form>';
            } else {

                echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';
            }
        } else if ($_SESSION["Rooli"] == 'opeadmin' || $_SESSION["Rooli"] == 'admink') {
            echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
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
session_start(); 


        ob_start();

        echo'<div class="cm8-container7" style="padding-top: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 60px">';


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

<a href="oppilaitokset.php" >Oppilaitokset</a>
<a href="kayttajatvahvistus.php" >Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="kaikkitiedostot.php style="margin-bottom: 5px" class="currentLink">Palvelimella olevat tiedostot</a><a href="arvostelut.php">Arvostelut</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';

        echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
        echo'<h4>Palvelimella olevat tiedostot:</h4>';
        echo'<div class="cm8-margin-top"></div>';
        echo'<h6 style="text-decoration: underline; color: #2b6777">Opettajien lisäämät tiedostot:</h6>';
        $field = 'lisayspvm';
        $sort = 'DESC';
        $nuoli = "&#8661";


        if (isset($_GET['sorting'])) {

            if ($_GET['sorting'] == 'ASC') {
                $sort = 'DESC';
            } else {
                $sort = 'ASC';
            }
        }


        if ($_GET['field'] == 'omatallennusnimi') {
            $field = "omatallennusnimi";
        } elseif ($_GET['field'] == 'kurssit.nimi') {
            $field = "kurssit.nimi";
        } elseif ($_GET['field'] == 'lisayspvm') {
            $field = "lisayspvm";
        }



        if (!$result = $db->query("select distinct omatallennusnimi, lisayspvm, kurssit.nimi as nimi, tiedostot.id as tid from kurssit, tiedostot, kansiot where tiedostot.kansio_id=kansiot.id AND kurssit.id=kansiot.kurssi_id ORDER BY $field $sort")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($result->num_rows == 0)
            echo"<br><br>Ei tiedostoja.<br>";
        else {
            echo'<br>';

            echo'<form action="varmistusopetiedostot.php" method="post">';
            echo "<br>";



            if ($_GET[kaikki] == 'joo') {

                echo'<div class="cm8-responsive" style="width: 100%">';
                echo'<table  class="cm8-bordered cm8-uusitable12 cm8-striped"  style="table-layout:fixed; width: 100%;">';
                echo '<thead style="width: 100%">';


                echo '<tr><th width="10%"><a href="kaikkitiedostot.php style="margin-bottom: 5px" > Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th width="30%"><a href="kaikkitiedostot.php?kaikki=joo&sorting=' . $sort . '&field=omatallennusnimi">Tiedosto &nbsp&nbsp&nbsp' . $nuoli . '</a></th><th width="30%"><a href="kaikkitiedostot.php?kaikki=joo&sorting=' . $sort . '&field=kurssit.nimi">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli . '</a></th><th width="30%"><a href="kaikkitiedostot.php?kaikki=joo&sorting=' . $sort . '&field=lisayspvm">Lisätty (vvvv-kk-pp) &nbsp&nbsp&nbsp' . $nuoli . '</a></th></tr>';

                echo'</thead></table></div>';

                echo'<div class="cm8-responsive" style="max-height: 100vh; width: 100%">';
                echo'<table  class="cm8-bordered cm8-uusitable12 cm8-striped3"  style="table-layout:fixed; width: 100%;">';

                echo'<tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr><td width="10%"><input type="checkbox" name="lista[]" value=' . $row[tid] . ' checked></td><td width="30%"><a href="avaaopetiedosto.php?id=' . $row[tid] . '">' . $row[omatallennusnimi] . '</a></td><td width="30%">' . $row[nimi] . '</td><td width="30%">' . $row[lisayspvm] . '</td></tr>';
                }
                echo "</tbody></table>";
                echo "</div>";
                echo "<br>";
                echo "<br>";
                echo'<button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button>';
                echo'</form>';
            } else {
                echo'<div class="cm8-responsive" style="width: 100%">';
                echo'<table  class="cm8-bordered cm8-uusitable12 cm8-striped"  style="table-layout:fixed; width: 100%;">';
                echo '<thead style="width: 100%">';

                echo '<tr><th width="10%"><a href="kaikkitiedostot.php?kaikki=joo" > Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th width="30%"><a href="kaikkitiedostot.php?sorting=' . $sort . '&field=omatallennusnimi">Tiedosto &nbsp&nbsp&nbsp' . $nuoli . '</a></th><th width="30%"><a href="kaikkitiedostot.php?sorting=' . $sort . '&field=kurssit.nimi">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli . '</a></th><th width="30%"><a href="kaikkitiedostot.php?sorting=' . $sort . '&field=lisayspvm">Lisätty (vvvv-kk-pp) &nbsp&nbsp&nbsp' . $nuoli . '</a></th></tr>';

                echo'</thead></table></div>';

                echo'<div class="cm8-responsive" style="max-height: 100vh; width: 100%">';
                echo'<table  class="cm8-bordered cm8-uusitable12 cm8-striped3"  style="table-layout:fixed; width: 100%;">';

                echo'<tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr><td width="10%"><input type="checkbox" name="lista[]" value=' . $row[tid] . '></td><td width="30%"><a href="avaaopetiedosto.php?id=' . $row[tid] . '">' . $row[omatallennusnimi] . '</a></td><td width="30%">' . $row[nimi] . '</td><td width="30%">' . $row[lisayspvm] . '</td></tr>';
                }
                echo "</tbody></table>";
                echo "</div>";
                echo "<br>";
                echo "<br>";

                echo'<button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button>';
                echo'</form>';
            }
        }

        echo'<div class="cm8-margin-top"></div>';
        echo'<div class="cm8-border-top"></div>';
        echo'<div class="cm8-margin-top"></div>';
        echo'<h6 style="text-decoration: underline; color: #2b6777">Kurssitöiden tiedostot:</h6>';
        $field2 = 'lisayspvm';
        $sort2 = 'ASC';
        $nuoli2 = "&#8661";


        if (isset($_GET['sorting2'])) {

            if ($_GET['sorting2'] == 'ASC') {
                $sort2 = 'DESC';
            } else {
                $sort2 = 'ASC';
            }
        }


        if ($_GET['field2'] == 'omatallennusnimi') {
            $field2 = "omatallennusnimi";
        } elseif ($_GET['field2'] == 'kurssit.nimi') {
            $field2 = "kurssit.nimi";
        } elseif ($_GET['field2'] == 'lisayspvm') {
            $field2 = "lisayspvm";
        }



        if (!$result2 = $db->query("select distinct omatallennusnimi, lisayspvm, kurssit.nimi as nimi, ryhmat2.id as tid from kurssit, ryhmat2, projektit where kurssit.id=projektit.kurssi_id AND ryhmat2.projekti_id=projektit.id ORDER BY $field2 $sort2")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($result2->num_rows == 0)
            echo"<br><br>Ei tiedostoja.<br>";
        else {
            echo'<br>';

            echo'<form action="varmistusryhmatiedostot.php" method="post">';
            echo "<br>";


            if ($_GET[kaikki2] == 'joo') {

                echo'<div class="cm8-responsive" style="width: 100%">';
                echo'<table  class="cm8-bordered cm8-uusitable12 cm8-striped"  style="table-layout:fixed; width: 100%;">';
                echo '<thead style="width: 100%">';

                echo '<tr><th width="10%"><a href="kaikkitiedostot.php style="margin-bottom: 5px" > Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th width="30%"><th><a href="kaikkitiedostot.php?kaikki2=joo&sorting2=' . $sort2 . '&field2=omatallennusnimi">Tiedosto &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th width="30%"><a href="kaikkitiedostot.php?kaikki2=joo&sorting2=' . $sort2 . '&field2=kurssit.nimi">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th width="30%"><a href="kaikkitiedostot.php?kaikki2=joo&sorting2=' . $sort2 . '&field2=lisayspvm">Lisätty (vvvv-kk-pp) &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th></tr>';
                echo'</thead></table></div>';

                echo'<div class="cm8-responsive" style="max-height: 100vh; width: 100%">';
                echo'<table  class="cm8-bordered cm8-uusitable12 cm8-striped3"  style="table-layout:fixed; width: 100%;">';

                echo'<tbody>';
                while ($row2 = $result2->fetch_assoc()) {
                    echo '<tr><td width="10%"><input type="checkbox" name="lista[]" value=' . $row2[tid] . ' checked></td><td width="30%"><a href="avaatiedosto.php?id=' . $row2[tid] . '">' . $row2[omatallennusnimi] . '</a></td><td width="30%">' . $row2[nimi] . '</td><td width="30%">' . $row2[lisayspvm] . '</td></tr>';
                }
                echo "</tbody></table>";
                echo "</div>";
                echo "<br>";
                echo "<br>";
                echo'<button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button>';
                echo'</form>';
            } else {
                echo'<div class="cm8-responsive" style="width: 100%">';
                echo'<table  class="cm8-bordered cm8-uusitable12 cm8-striped"  style="table-layout:fixed; width: 100%;">';
                echo '<thead style="width: 100%">';

                echo '<tr><th width="10%"><a href="kaikkitiedostot.php?kaikki2=joo" > Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th width="30%"><a href="kaikkitiedostot.php?sorting2=' . $sort2 . '&field2=omatallennusnimi">Tiedosto &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th width="30%"><a href="kaikkitiedostot.php?sorting2=' . $sort2 . '&field2=kurssit.nimi">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th width="30%"><a href="kaikkitiedostot.php?sorting2=' . $sort2 . '&field2=lisayspvm">Lisätty (vvvv-kk-pp) &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th></tr>';
                echo'</thead></table></div>';

                echo'<div class="cm8-responsive" style="max-height: 100vh; width: 100%">';
                echo'<table  class="cm8-uusitable12 cm8-striped3"  style="table-layout:fixed; width: 100%;">';

                echo'<tbody>';
                while ($row2 = $result2->fetch_assoc()) {


                    $row2[omatallennusnimi] = str_replace('<br />', "", $row2[omatallennusnimi]);
                    echo '<tr><td width="10%"><input type="checkbox" name="lista[]" value=' . $row2[tid] . '></td><td width="30%"><a href="avaatiedosto.php?id=' . $row2[tid] . '">' . $row2[omatallennusnimi] . '</a></td><td width="30%">' . $row2[nimi] . '</td><td width="30%">' . $row2[lisayspvm] . '</td></tr>';
                }

                echo "</tbody></table>";
                echo "</div>";
                echo "<br>";
                echo "<br>";

                echo'<button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button>';
                echo'</form>';
            }
        }
        echo'<div class="cm8-margin-top"></div>';
        echo'<div class="cm8-border-top"></div>';
        echo'<div class="cm8-margin-top"></div>';
        echo'<h6 style="text-decoration: underline; color: #2b6777">Opettajan ryhmiin lisäämät tiedostot:</h6>';
        $field2 = 'lisayspvm';
        $sort2 = 'ASC';
        $nuoli2 = "&#8661";


        if (isset($_GET['sorting2'])) {

            if ($_GET['sorting2'] == 'ASC') {
                $sort2 = 'DESC';
            } else {
                $sort2 = 'ASC';
            }
        }


        if ($_GET['field2'] == 'omatallennusnimi') {
            $field2 = "omatallennusnimi";
        } elseif ($_GET['field2'] == 'kurssit.nimi') {
            $field2 = "kurssit.nimi";
        } elseif ($_GET['field2'] == 'lisayspvm') {
            $field2 = "lisayspvm";
        }



        if (!$result2 = $db->query("select distinct omatallennusnimi, lisayspvm, kurssit.nimi as nimi, ryhmatope.id as tid from kurssit, ryhmatope, projektit where kurssit.id=projektit.kurssi_id AND ryhmatope.projekti_id=projektit.id ORDER BY $field2 $sort2")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($result2->num_rows == 0)
            echo"<br><br>Ei tiedostoja.<br>";
        else {
            echo'<br>';

            echo'<form action="varmistusryhmatiedostotope.php" method="post">';
            echo "<br>";


            if ($_GET[kaikki2] == 'joo') {

                echo'<div class="cm8-responsive" style="width: 100%">';
                echo'<table  class="cm8-bordered cm8-uusitable12 cm8-striped"  style="table-layout:fixed; width: 100%;">';
                echo '<thead style="width: 100%">';

                echo '<tr><th width="10%"><a href="kaikkitiedostot.php style="margin-bottom: 5px" > Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th width="30%"><th><a href="kaikkitiedostot.php?kaikki2=joo&sorting2=' . $sort2 . '&field2=omatallennusnimi">Tiedosto &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th width="30%"><a href="kaikkitiedostot.php?kaikki2=joo&sorting2=' . $sort2 . '&field2=kurssit.nimi">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th width="30%"><a href="kaikkitiedostot.php?kaikki2=joo&sorting2=' . $sort2 . '&field2=lisayspvm">Lisätty (vvvv-kk-pp) &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th></tr>';
                echo'</thead></table></div>';

                echo'<div class="cm8-responsive" style="max-height: 100vh; width: 100%">';
                echo'<table  class="cm8-bordered cm8-uusitable12 cm8-striped3"  style="table-layout:fixed; width: 100%;">';

                echo'<tbody>';
                while ($row2 = $result2->fetch_assoc()) {
                    echo '<tr><td width="10%"><input type="checkbox" name="lista[]" value=' . $row2[tid] . ' checked></td><td width="30%"><a href="avaatiedosto.php?id=' . $row2[tid] . '">' . $row2[omatallennusnimi] . '</a></td><td width="30%">' . $row2[nimi] . '</td><td width="30%">' . $row2[lisayspvm] . '</td></tr>';
                }
                echo "</tbody></table>";
                echo "</div>";
                echo "<br>";
                echo "<br>";
                echo'<button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button>';
                echo'</form>';
            } else {
                echo'<div class="cm8-responsive" style="width: 100%">';
                echo'<table  class="cm8-bordered cm8-uusitable12 cm8-striped"  style="table-layout:fixed; width: 100%;">';
                echo '<thead style="width: 100%">';

                echo '<tr><th width="10%"><a href="kaikkitiedostot.php?kaikki2=joo" > Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th width="30%"><a href="kaikkitiedostot.php?sorting2=' . $sort2 . '&field2=omatallennusnimi">Tiedosto &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th width="30%"><a href="kaikkitiedostot.php?sorting2=' . $sort2 . '&field2=kurssit.nimi">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th width="30%"><a href="kaikkitiedostot.php?sorting2=' . $sort2 . '&field2=lisayspvm">Lisätty (vvvv-kk-pp) &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th></tr>';
                echo'</thead></table></div>';

                echo'<div class="cm8-responsive" style="max-height: 100vh; width: 100%">';
                echo'<table  class="cm8-uusitable12 cm8-striped3"  style="table-layout:fixed; width: 100%;">';

                echo'<tbody>';
                while ($row2 = $result2->fetch_assoc()) {


                    $row2[omatallennusnimi] = str_replace('<br />', "", $row2[omatallennusnimi]);
                    echo '<tr><td width="10%"><input type="checkbox" name="lista[]" value=' . $row2[tid] . '></td><td width="30%"><a href="avaatiedosto.php?id=' . $row2[tid] . '">' . $row2[omatallennusnimi] . '</a></td><td width="30%">' . $row2[nimi] . '</td><td width="30%">' . $row2[lisayspvm] . '</td></tr>';
                }

                echo "</tbody></table>";
                echo "</div>";
                echo "<br>";
                echo "<br>";

                echo'<button class="pieniroskis" title="Poista tiedosto"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button>';
                echo'</form>';
            }
        }
        echo'<div class="cm8-margin-top"></div>';
        echo'<div class="cm8-border-top"></div>';
        echo'<div class="cm8-margin-top"></div>';
        echo'<h6 style="text-decoration: underline; color: #2b6777">Profiilikuvan lisänneet käyttäjät:</h6><br><br>';


        $field3 = 'sukunimi';
        $sort3 = 'ASC';
        $nuoli3 = "&#8661";


        if (isset($_GET['sorting3'])) {

            if ($_GET['sorting3'] == 'ASC') {
                $sort3 = 'DESC';
            } else {
                $sort3 = 'ASC';
            }
        }


        if ($_GET['field3'] == 'sukunimi') {
            $field3 = "sukunimi";
        }




        if (!$result3 = $db->query("select distinct * from kayttajat where omakuva<>'' ORDER BY $field3 $sort3")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($result3->num_rows == 0)
            echo"<br><br>Ei profiilikuvia.<br>";
        else {


            echo'<p id="ohje">Klikkaamalla käyttäjän nimeä näet käyttäjän profiilikuvan.</p><br>';

            echo'<br>';


            echo'<div class="cm8-responsive" style="width: 100%">';
            echo'<table  class="cm8-bordered cm8-uusitable12 cm8-striped"  style="table-layout:fixed; width: 100%;">';
            echo '<thead style="width: 100%">';

            echo '<tr><th><a href="kaikkitiedostot.php?&sorting3=' . $sort3 . '&field3=sukunimi">Käyttäjä &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th></tr>';
            echo'</thead></table></div>';

            echo'<div class="cm8-responsive" style="max-height: 100vh; width: 100%">';
            echo'<table  class="cm8-bordered cm8-uusitable12 cm8-striped3"  style="table-layout:fixed; width: 100%;">';

            echo'<tbody>';
            while ($row3 = $result3->fetch_assoc()) {
                echo '<tr><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row3[id] . '">' . $row3[sukunimi] . ' ' . $row3[etunimi] . '</a></td></tr>';
            }
            echo "</tbody></table>";
            echo "</div>";
            echo "<br>";
            echo "<br>";
        }



        // poistaa kaikki sektorikuvat
        if (!$haekurssit = $db->query("select distinct id, koodi, nimi from kurssit")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $maara = 0;
        $maara2 = 0;
        $maara3 = 0;
        while ($rivik = $haekurssit->fetch_assoc()) {
            $kid = $rivik[id];


            $nimi = $rivik[koodi] . " " . $rivik[nimi];

            $pienimi = 'tiedostot/excel/cuulis_Itsearvioinnit_' . $nimi . '.csv';
            if (file_exists($pienimi)) {
                unlink($pienimi);
                $maara2++;
            }

            if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where kurssi_id='" . $kid . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }





            while ($rowP = $onkoprojekti->fetch_assoc()) {


                $kuvaus = $rowP[kuvaus];
                $pienimi = 'tiedostot/excel/cuulis_' . $kuvaus . '_' . $nimi . '.csv';
                if (file_exists($pienimi)) {
                    unlink($pienimi);
                    $maara++;
                }
            }













            if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where kurssi_id = '" . $kid . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rivi = $haeopiskelijat->fetch_assoc()) {
                $id = $rivi[opiskelija_id];



                $pienimi = 'images/sektori' . $id . '.png';
                if (file_exists($pienimi)) {
                    unlink($pienimi);
                    $maara3++;
                }
                $pienimi = 'images/sektori2' . $id . '.png';
                if (file_exists($pienimi)) {
                    unlink($pienimi);
                    $maara3++;
                }
                $pienimi = 'images/sektori3' . $id . '.png';
                if (file_exists($pienimi)) {
                    unlink($pienimi);
                    $maara3++;
                }
                $pienimi = 'images/sektori4' . $id . '.png';
                if (file_exists($pienimi)) {
                    unlink($pienimi);
                    $maara3++;
                }
            }
        }
        $maara0 = $maara + $maara2;
        echo'<br><b>Excel-tiedostoja poistettu ' . $maara0 . ' kappaletta.</b>';
        echo'<br><b>Sektoridiagrammeja poistettu ' . $maara3 . ' kappaletta.</b>';
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
<script>
    //ilman tätä mikään muu ei toimi kuin scrolli
    var j = jQuery.noConflict();
    $("#mytable").tableHeadFixer({"head": false, "left": 1});

</script> 
<script>

    var j = jQuery.noConflict();


    var $table = j('#mytable');
    $table.floatThead({zIndex: 1});

</script> 

<script>


    $("#scrollbar").on("scroll", function () {

        var container = $("#piilota");
        var scrollbar = $("#scrollbar");

        ScrollUpdate(container, scrollbar);
    });

    function ScrollUpdate(content, scrollbar) {
        $("#spacer").css({"width": "1000px"}); // set the spacer width
        scrollbar.width = content.width() + "px";
        content.scrollLeft(scrollbar.scrollLeft());
    }

    ScrollUpdate($("#piilota"), $("#scrollbar"));

</script>


</body>
</html>	




