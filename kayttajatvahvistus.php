<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Vahvistusta odottavat käyttäjät </title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("header.php");
        include("header2.php");

        echo'<div class="cm8-container7">';
        if ($_SESSION["Rooli"] == "admin") {
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
<a href="kayttajatvahvistus.php" class="currentLink">Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="kaikkitiedostot.php style="margin-bottom: 5px" >Palvelimella olevat tiedostot</a><a href="arvostelut.php">Arvostelut</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        } else if ($_SESSION["Rooli"] == "admink") {
            echo'<nav class="topnavoppilas" id="myTopnav">';
            echo'   <a href="etusivu.php" >Etusivu</a>       
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
<a href="kayttajatvahvistus.php" class="currentLink">Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" >Oma oppilaitos</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
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
<a href="kayttajatvahvistus.php" class="currentLink">Käyttäjät &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="kurssit.php">Kurssit/Opintojaksot &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" >Oppilaitos &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)">  
    <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        }
        echo'<nav id="myTopnav2" class="topnav2">
  <a href="kayttajatvahvistus.php" class="currentLink3">Vahvistusta odottavat käyttäjät</a> 
   

  <a href="kayttajatopettajat.php" >Opettajat</a>
  <a href="kayttajatopiskelijat.php">Opiskelijat</a> 
  
 <a href="lisaakayttajaeka.php">+ Lisää uusi käyttäjä</a><a href="javascript:void(0);" class="icon" onclick="myFunction2(this)"><div class="bar1K"></div>
  <div class="bar2K"></div>
  <div class="bar3K"></div></a>';
        echo'

<script>
function myFunction2(y) {
 y.classList.toggle("change");
    var x = document.getElementById("myTopnav2");
    if (x.className === "topnav2") {
        x.className += " responsive";
    } else {
        x.className = "topnav2";
    }
}
</script>';
//    if($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin" )
//    {
//        echo' <a href="kayttajateivahvistetut.php">Vahvistamattomat käyttäjät</a>';
//    }

        echo'</nav>';

        echo'<div class="cm8-container3" style="padding-top: 0px">';

        if ($_SESSION["Rooli"] == 'admin') {
            echo '<h3>Rekisteröinnin vahvistusta odottavat käyttäjät:</h3>';

            $field8 = 'sukunimi';
            $sort = 'ASC';
            $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';


            if (isset($_GET['sorting0'])) {

                if ($_GET['sorting0'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli0 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }
            if (isset($_GET['sorting1'])) {

                if ($_GET['sorting1'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli1 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli1 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }
            if (isset($_GET['sorting2'])) {

                if ($_GET['sorting2'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli2 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli2 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }


            if ($_GET['field8'] == 'sukunimi') {
                $field8 = "sukunimi";
            } elseif ($_GET['field8'] == 'etunimi') {
                $field8 = "etunimi";
            } elseif ($_GET['field8'] == 'sposti') {
                $field8 = "sposti";
            } elseif ($_GET['field8'] == 'Nimi') {
                $field8 = "Nimi";
            }

            if (!$result = $db->query("select distinct rekisteroitynyt, kayttajat.id as kaid, etunimi, sukunimi,Nimi,rooli, sposti from kayttajat, kayttajankoulut, koulut where kayttajat.tarkistettu=0 AND kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id ORDER BY $field8 $sort")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($result->num_rows == 0)
                echo"<br><em>Ei rekisteröinnin vahvistusta odottavia käyttäjiä.</em><br>";
            else {

                if ($_GET[kaikki8] == 'joo') {
                    echo'<br>';

                    echo'<form action="vahvistusvarmistus.php" method="post">';


                    echo "<br>";
                    echo'<div class="cm8-responsive" >';
                    echo '<table id="mytable" class="cm8-striped cm8-uusitable10" style="table-layout:fixed; max-width: 100%; ">  <thead>';
                    echo '<tr><th><a href="kayttajatvahvistus.php?kaikki8=ei" > Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th><a href="kayttajatvahvistus.php?sorting0=' . $sort . '&kaikki8=joo&field8=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting1=' . $sort . '&kaikki8=joo&field8=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting2=' . $sort . '&kaikki8=joo&field8=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th>Rooli</th><th>Oppilaitos</th><th>Rekisteröitynyt</th><th>Lähetä viesti</th></tr>';
                    echo'</thead>';
                    while ($row = $result->fetch_assoc()) {
                          $row[rekisteroitynyt] = date("d.m.Y H:i", strtotime($row[rekisteroitynyt]));
                        echo'<tr><td style="padding-left: 10px"><input type="checkbox" name="lista8[]" id=' . $row[kaid] . '  value=' . $row[kaid] . ' checked>';
                        echo'<td><label for=' . $row[kaid] . '> ' . $row[sukunimi] . '</label></td>';
                        echo'<td><label for=' . $row[kaid] . '> ' . $row[etunimi] . '</label></td>';
                        echo"<td>" . $row[sposti] . '</td><td>' . $row[rooli] . '</td><td>' . $row[Nimi] . '</td><td>'.$row[rekisteroitynyt].'</td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row[kaid] . '" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
                    }
                    echo "</table>";
                    echo'</div>';
                    echo "<br>";
                    echo "<br>";
                    echo'<input type="submit" name="painikev" id="hyvaksy" class="myButton8" value="&#10003 Vahvista" style="padding: 2px" style="padding: 4px 6px" alt="Vahvista" tabindex="4"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ';
                    echo'<input type="submit" name="painikep" id="hylkaa" value="&#10007 Hylkää" class="myButton8" style="padding: 2px" style="padding: 4px 6px" style="padding: 2px" style="padding: 2px" alt="Hylkää" tabindex="5" />';
                    echo'</form>';
                } else {

                    echo'<br>';

                    echo'<form action="vahvistusvarmistus.php" method="post">';


                    echo "<br>";
                    echo'<div class="cm8-responsive">';
                    echo '<table id="mytable" class="cm8-striped cm8-uusitable10" style="table-layout:fixed; max-width: 100%; ">  <thead>';
                    echo '<tr><th><a href="kayttajatvahvistus.php?kaikki8=joo" > Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th><a href="kayttajatvahvistus.php?sorting0=' . $sort . '&field8=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting1=' . $sort . '&field8=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting2=' . $sort . '&field8=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th>Rooli</th><th>Oppilaitos</th><th>Rekisteröitynyt</th><th>Läheta viesti</th></tr>';
                    echo'</thead>';
                    while ($row = $result->fetch_assoc()) {
                        $row[rekisteroitynyt] = date("d.m.Y H:i", strtotime($row[rekisteroitynyt]));
                        echo'<tr><td style="padding-left: 10px"><input type="checkbox" name="lista8[]" id=' . $row[kaid] . '  value=' . $row[kaid] . '>';
                        echo'<td><label for=' . $row[kaid] . '> ' . $row[sukunimi] . '</label></td>';
                        echo'<td><label for=' . $row[kaid] . '> ' . $row[etunimi] . '</label></td>';
                        echo"<td>" . $row[sposti] . '</td><td>' . $row[rooli] . '</td><td>' . $row[Nimi] . '</td><td>'.$row[rekisteroitynyt].'</td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row[kaid] . '" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
                    }
                    echo "</table>";
                    echo'</div>';
                    echo "<br>";
                    echo "<br>";
                    echo'<input type="submit" name="painikev" id="hyvaksy" value="&#10003 Vahvista" style="padding: 4px 6px" alt="Vahvista" class="myButton8" tabindex="4"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ';
                    echo'<input type="submit" name="painikep" id="hylkaa" value="&#10007 Hylkää" style="padding: 4px 6px" alt="Hylkää" class="myButton8" tabindex="5" />';
                    echo'</form>';
                }
            }

            echo'<br><br><div class="cm8-border"></div>';

            echo '<h3>Oppilaitokseen liittymisen vahvistusta odottavat käyttäjät:</h3>';


            $field8 = 'sukunimi';
            $sort = 'ASC';
            $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';


            if (isset($_GET['sorting0'])) {

                if ($_GET['sorting0'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli0 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }
            if (isset($_GET['sorting1'])) {

                if ($_GET['sorting1'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli1 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli1 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }
            if (isset($_GET['sorting2'])) {

                if ($_GET['sorting2'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli2 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli2 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }



            if ($_GET['field8'] == 'sukunimi') {
                $field8 = "sukunimi";
            } elseif ($_GET['field8'] == 'etunimi') {
                $field8 = "etunimi";
            } elseif ($_GET['field8'] == 'sposti') {
                $field8 = "sposti";
            } elseif ($_GET['field8'] == 'Nimi') {
                $field8 = "Nimi";
            }

            if (!$result = $db->query("select distinct koulut.Nimi as Nimi, etunimi, sukunimi, sposti, rooli, kayttajat.id as kaid from kayttajat, kayttajankoulut, koulut where odottaa=0 AND kayttajankoulut.kayttaja_id=kayttajat.id AND kayttajankoulut.koulu_id=koulut.id ORDER BY $field8 $sort")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($result->num_rows == 0)
                echo"<br><em>Ei vahvistusta odottavia käyttäjiä.</em>";
            else {
                echo'<p id="ohje">Klikkaamalla käyttäjän suku- tai etunimeä pääset tarkastelemaan käyttäjän profiilia ja muokkaamaan tietoja.</p>';

                if ($_GET[kaikki81] == 'joo') {
                    echo'<br>';

                    echo'<form action="vahvistusvarmistus2.php" method="post">';


                    echo "<br>";
                    echo'<div class="cm8-responsive">';
                    echo '<table id="mytable" class="cm8-striped cm8-uusitable10" style="table-layout:fixed; max-width: 100%; ">  <thead>';
                    echo '<tr><th><a href="kayttajatvahvistus.php?kaikki81=ei" > Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th><a href="kayttajatvahvistus.php?sorting0=' . $sort . '&kaikki81=joo&field8=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting1=' . $sort . '&kaikki81=joo&field8=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting2=' . $sort . '&kaikki81=joo&field8=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th>Rooli</th><th>Oppilaitos</th><th>Lähetä viesti</th></tr>';
                    echo'</thead>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista81[]" value=' . $row[kaid] . ' checked ></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[sukunimi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[etunimi] . "</a></td><td>" . $row[sposti] . '</td><td>' . $row[rooli] . '</td><td>' . $row[Nimi] . '</td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row[kaid] . '" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
                    }
                    echo "</table>";
                    echo'</div>';
                    echo "<br>";
                    echo "<br>";
                    echo'<input type="submit" name="painikev" id="hyvaksy" value="&#10003 Vahvista" class="myButton8" style="padding: 4px 6px" alt="Vahvista" tabindex="4"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ';
                    echo'<input type="submit" name="painikep" id="hylkaa" value="&#10007 Hylkää" class="myButton8" style="padding: 4px 6px" style="padding: 2px" alt="Hylkää" tabindex="5" />';
                    echo'</form>';
                } else {

                    echo'<br>';

                    echo'<form action="vahvistusvarmistus2.php" method="post">';


                    echo "<br>";
                    echo'<div class="cm8-responsive">';
                    echo '<table id="mytable" class="cm8-striped cm8-uusitable10" style="table-layout:fixed; max-width: 100%; ">  <thead>';
                    echo '<tr><th><a href="kayttajatvahvistus.php?kaikki81=joo" > Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th><a href="kayttajatvahvistus.php?sorting0=' . $sort . '&field8=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting1=' . $sort . '&field8=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting2=' . $sort . '&field8=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th>Rooli</th><th>Oppilaitos</th><th>Lähetä viesti</th></tr>';
                    echo'</thead>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista81[]" value=' . $row[kaid] . '></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[sukunimi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[etunimi] . "</a></td><td>" . $row[sposti] . '</td><td>' . $row[rooli] . '</td><td>' . $row[Nimi] . '</td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row[kaid] . '" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
                    }
                    echo "</table>";
                    echo'</div>';
                    echo "<br>";
                    echo "<br>";
                    echo'<input type="submit" name="painikev" id="hyvaksy" value="&#10003 Vahvista" style="padding: 4px 6px" alt="Vahvista" class="myButton8" tabindex="4"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ';
                    echo'<input type="submit" name="painikep" id="hylkaa" value="&#10007 Hylkää" style="padding: 4px 6px" style="padding: 2px" alt="Hylkää" class="myButton8" tabindex="5" />';
                    echo'</form>';
                }
            }
        } else if ($_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {
            if (!$haekoulu = $db->query("select distinct * from koulut where id = '" . $_SESSION[kouluId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($row2 = $haekoulu->fetch_assoc()) {
                $koulu = $row2[Nimi];
            }
            echo '<h3>Ylläpitämääsi oppilaitokseen ' . $koulu . ' rekisteröityneet käyttäjät, jotka odottavat sinulta vahvistusta:</h3>';

            $field8 = 'sukunimi';
            $sort = 'ASC';
            $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';


            if (isset($_GET['sorting0'])) {

                if ($_GET['sorting0'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli0 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }
            if (isset($_GET['sorting1'])) {

                if ($_GET['sorting1'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli1 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli1 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }
            if (isset($_GET['sorting2'])) {

                if ($_GET['sorting2'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli2 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli2 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }


            if ($_GET['field8'] == 'sukunimi') {
                $field8 = "sukunimi";
            } elseif ($_GET['field8'] == 'etunimi') {
                $field8 = "etunimi";
            } elseif ($_GET['field8'] == 'sposti') {
                $field8 = "sposti";
            } elseif ($_GET['field8'] == 'Nimi') {
                $field8 = "Nimi";
            }

            if (!$result = $db->query("select distinct rekisteroitynyt, kayttajat.id as kaid, etunimi, sukunimi,Nimi,rooli, sposti from kayttajat, kayttajankoulut, koulut where koulut.id='" . $_SESSION["kouluId"] . "' AND  kayttajat.tarkistettu=0 AND kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id ORDER BY $field8 $sort")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($result->num_rows == 0)
                echo"<br><em>Ei rekisteröinnin vahvistusta odottavia käyttäjiä.</em><br>";
            else {

                if ($_GET[kaikki8] == 'joo') {
                    echo'<br>';

                    echo'<form action="vahvistusvarmistus.php" method="post">';


                    echo "<br>";
                    echo'<div class="cm8-responsive">';
                    echo '<table id="mytable" class="cm8-striped cm8-uusitable10" style="table-layout:fixed; max-width: 100%; ">  <thead>';
                    echo '<tr><th><a href="kayttajatvahvistus.php?kaikki8=ei" > Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th><a href="kayttajatvahvistus.php?sorting0=' . $sort . '&kaikki8=joo&field8=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting1=' . $sort . '&kaikki8=joo&field8=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting2=' . $sort . '&kaikki8=joo&field8=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th>Rooli</th><th>Oppilaitos</th><th>Rekisteröitynyt</th><th>Lähetä viesti</th></tr>';
                    echo'</thead>';
                    while ($row = $result->fetch_assoc()) {
                        $row[rekisteroitynyt] = date("d.m.Y H:i", strtotime($row[rekisteroitynyt]));
                        echo'<tr><td style="padding-left: 10px"><input type="checkbox" name="lista8[]" id=' . $row[kaid] . '  value=' . $row[kaid] . ' checked>';
                        echo'<td><label for=' . $row[kaid] . '> ' . $row[sukunimi] . '</label></td>';
                        echo'<td><label for=' . $row[kaid] . '> ' . $row[etunimi] . '</label></td>';
                        echo"<td>" . $row[sposti] . '</td><td>' . $row[rooli] . '</td><td>' . $row[Nimi] . '</td><td>'.$row[rekisteroitynyt].'</td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row[kaid] . '" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
                    }
                    echo "</table>";
                    echo'</div>';
                    echo "<br>";
                    echo "<br>";
                    echo'<input type="submit" name="painikev" id="hyvaksy" class="myButton8" value="&#10003 Vahvista" style="padding: 4px 6px" alt="Vahvista" tabindex="4"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ';
                    echo'<input type="submit" name="painikep" id="hylkaa" class="myButton8" value="&#10007 Hylkää" style="padding: 4px 6px" style="padding: 2px" alt="Hylkää" tabindex="5" />';
                    echo'</form>';
                } else {

                    echo'<br>';

                    echo'<form action="vahvistusvarmistus.php" method="post">';


                    echo "<br>";
                    echo'<div class="cm8-responsive" >';
                    echo '<table id="mytable" class="cm8-striped cm8-uusitable10" style="table-layout:fixed; max-width: 100%; ">  <thead>';
                    echo '<tr><th><a href="kayttajatvahvistus.php?kaikki8=joo" > Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th><a href="kayttajatvahvistus.php?sorting0=' . $sort8 . '&field8=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting1=' . $sort . '&field8=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting2=' . $sort . '&field8=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th>Rooli</th><th>Oppilaitos</th><th>Rekisteröitynyt</th><th>Lähetä viesti</th></tr>';
                    echo'</thead>';
                    while ($row = $result->fetch_assoc()) {
$row[rekisteroitynyt] = date("d.m.Y H:i", strtotime($row[rekisteroitynyt]));

                        echo'<tr><td style="padding-left: 10px"><input type="checkbox" name="lista8[]" id=' . $row[kaid] . '  value=' . $row[kaid] . '>';
                        echo'<td><label for=' . $row[kaid] . '> ' . $row[sukunimi] . '</label></td>';
                        echo'<td><label for=' . $row[kaid] . '> ' . $row[etunimi] . '</label></td>';
                        echo"<td>" . $row[sposti] . '</td><td>' . $row[rooli] . '</td><td>' . $row[Nimi] . '</td><td>'.$row[rekisteroitynyt].'</td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row[kaid] . '" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
                    }
                    echo "</table>";
                    echo'</div>';
                    echo "<br>";
                    echo "<br>";
                    echo'<input type="submit" name="painikev" id="hyvaksy" class="myButton8" value="&#10003 Vahvista" style="padding: 4px 6px" alt="Vahvista" tabindex="4"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ';
                    echo'<input type="submit" name="painikep" id="hylkaa" class="myButton8" value="&#10007 Hylkää" style="padding: 4px 6px" style="padding: 2px" alt="Hylkää" tabindex="5" />';
                    echo'</form>';
                }
            }


            echo'<br><br><div class="cm8-border"></div>';
            if (!$haekoulu = $db->query("select distinct * from koulut where id = '" . $_SESSION[kouluId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($row2 = $haekoulu->fetch_assoc()) {
                $koulu = $row2[Nimi];
            }
            echo '<h3>Ylläpitämääsi oppilaitokseen ' . $koulu . ' liittymisen vahvistusta odottavat käyttäjät:</h3>';


            $field8 = 'sukunimi';
            $sort = 'ASC';
            $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';


            if (isset($_GET['sorting0'])) {

                if ($_GET['sorting0'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli0 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }
            if (isset($_GET['sorting1'])) {

                if ($_GET['sorting1'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli1 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli1 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }
            if (isset($_GET['sorting2'])) {

                if ($_GET['sorting2'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli2 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli2 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }


            if ($_GET['field8'] == 'sukunimi') {
                $field8 = "sukunimi";
            } elseif ($_GET['field8'] == 'etunimi') {
                $field8 = "etunimi";
            } elseif ($_GET['field8'] == 'sposti') {
                $field8 = "sposti";
            } elseif ($_GET['field8'] == 'Nimi') {
                $field8 = "Nimi";
            }

            if (!$result = $db->query("select distinct koulut.Nimi as Nimi, etunimi, sukunimi, sposti, rooli, kayttajat.id as kaid from kayttajat, kayttajankoulut, koulut where koulut.id='" . $_SESSION["kouluId"] . "' AND  odottaa=0 AND kayttajankoulut.kayttaja_id=kayttajat.id AND kayttajankoulut.koulu_id=koulut.id ORDER BY $field8 $sort")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($result->num_rows == 0)
                echo"<br><em>Ei liittymisen vahvistusta odottavia käyttäjiä.</em>";
            else {
                echo'<p id="ohje">Klikkaamalla käyttäjän suku- tai etunimeä pääset tarkastelemaan käyttäjän profiilia.</p>';
                if ($_GET[kaikki81] == 'joo') {

                    echo'<br>';

                    echo'<form action="vahvistusvarmistus2.php" method="post">';


                    echo "<br>";
                    echo'<div class="cm8-responsive">';
                    echo '<table id="mytable" class="cm8-striped cm8-uusitable10" style="table-layout:fixed; max-width: 100%; ">  <thead>';
                    echo '<tr><th><a href="kayttajatvahvistus.php?kaikki81=ei" > Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th><a href="kayttajatvahvistus.php?sorting0=' . $sort . '&kaikki81=joo&field8=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting1=' . $sort . '&kaikki81=joo&field8=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting2=' . $sort . '&kaikki81=joo&field8=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th>Rooli</th><th>Oppilaitos</th><th>Lähetä viesti</th></tr>';
                    echo'</thead>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista81[]" value=' . $row[kaid] . ' checked ></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[sukunimi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[etunimi] . "</a></td><td>" . $row[sposti] . '</td><td>' . $row[rooli] . '</td><td>' . $row[Nimi] . '</td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row[kaid] . '" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
                    }
                    echo "</table>";
                    echo'</div>';
                    echo "<br>";
                    echo "<br>";
                    echo'<input type="submit" name="painikev" id="hyvaksy" class="myButton8" value="&#10003 Vahvista" style="padding: 4px 6px" alt="Vahvista" tabindex="4"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ';
                    echo'<input type="submit" name="painikep" id="hylkaa" class="myButton8" value="&#10007 Hylkää" style="padding: 4px 6px" style="padding: 2px" alt="Hylkää" tabindex="5" />';
                    echo'</form>';
                } else {

                    echo'<br>';

                    echo'<form action="vahvistusvarmistus2.php" method="post">';


                    echo "<br>";
                    echo'<div class="cm8-responsive">';
                    echo '<table id="mytable" class="cm8-striped cm8-uusitable10" style="table-layout:fixed; max-width: 100%; ">  <thead>';
                    echo '<tr><th><a href="kayttajatvahvistus.php?kaikki81=joo" > Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th><a href="kayttajatvahvistus.php?sorting0=' . $sort . '&field8=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting1=' . $sort . '&field8=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajatvahvistus.php?sorting2=' . $sort . '&field8=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th>Rooli</th><th>Oppilaitos</th><th>Lähetä viesti</th></tr>';
                    echo'</thead>';
                    while ($row = $result->fetch_assoc()) {

                        echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista81[]" value=' . $row[kaid] . '></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[sukunimi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[etunimi] . "</a></td><td>" . $row[sposti] . '</td><td>' . $row[rooli] . '</td><td>' . $row[Nimi] . '</td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row[kaid] . '" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
                    }
                    echo "</table>";
                    echo'</div>';
                    echo "<br>";
                    echo "<br>";
                    echo'<input type="submit" name="painikev" id="hyvaksy" class="myButton8" value="&#10003 Vahvista" style="padding: 4px 6px" alt="Vahvista" tabindex="4"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ';
                    echo'<input type="submit" name="painikep" id="hylkaa" class="myButton8" value="&#10007 Hylkää" style="padding: 4px 6px" style="padding: 2px" alt="Hylkää" tabindex="5" />';
                    echo'</form>';
                }
            }
        }
        ?>



        <script>

            var $table = $('#mytable');
            $table.floatThead();

        </script>        
        <?php
session_start(); 


        ob_start();

        echo'</div>';
        echo'</div>';

        echo'</div>';
        include("footer.php");
    } else {
        header("location: etusivu.php");
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