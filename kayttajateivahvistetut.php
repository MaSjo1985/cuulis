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
            echo' <a href="etusivu.php" >Etusivu</a>         
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
<a href="kaikkitiedostot.php style="margin-bottom: 5px" >Palvelimella olevat tiedostot</a><a href="arvostelut.php">Arvostelut</a>

</nav>';
        } else if ($_SESSION["Rooli"] == "admink") {
            echo'<nav class="topnavoppilas" id="myTopnav">';
            echo'  <a href="etusivu.php" >Etusivu</a>       
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
  <a href="kayttajatvahvistus.php">Vahvistusta odottavat käyttäjät</a> 
   

  <a href="kayttajatopettajat.php" >Opettajat</a>
  <a href="kayttajatopiskelijat.php">Opiskelijat</a> 
  
 <a href="lisaakayttajaeka.php">+ Lisää uusi käyttäjä</a><a href="javascript:void(0);" class="icon" onclick="myFunction2(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>';
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
        if ($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
            echo' <a href="kayttajateivahvistetut.php" class="currentLink3">Vahvistamattomat käyttäjät</a>';
        }

        echo'</nav>';

        echo'<div class="cm8-container3" style="padding-top: 0px">';

        echo '<h3>Vahvistamattomat käyttäjät:</h3>';

        $field8 = 'sukunimi';
        $sort = 'DESC';
        $nuoli0 = '<div class="cm8-nuolialas"> </div>';
        $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';


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
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
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
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
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
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }
        if (isset($_GET['sorting3'])) {

            if ($_GET['sorting3'] == 'ASC') {
                $sort = 'DESC';
                $nuoli3 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli3 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }
        if (isset($_GET['sorting4'])) {

            if ($_GET['sorting4'] == 'ASC') {
                $sort = 'DESC';
                $nuoli4 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli4 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
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
        } elseif ($_GET['field8'] == 'rekisteroitynyt') {
            $field8 = "rekisteroitynyt";
        }
        if ($_SESSION["Rooli"] == "admin") {
            if (!$result = $db->query("select distinct rekisteroitynyt, kayttajat.id as kaid, etunimi, sukunimi,Nimi,rooli, sposti from kayttajat, kayttajankoulut, koulut where kayttajat.vahvistettu=0 AND kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id ORDER BY $field8 $sort8")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
        }
        if ($_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
            if (!$result = $db->query("select distinct rekisteroitynyt, kayttajat.id as kaid, etunimi, sukunimi,Nimi,rooli, sposti from kayttajat, kayttajankoulut, koulut where kayttajankoulut.koulu_id='" . $_SESSION["kouluId"] . "' AND kayttajat.vahvistettu=0 AND kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id ORDER BY $field8 $sort8")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
        }

        if ($result->num_rows == 0)
            echo"<br><br>Oppimisympäristössä ei ole tällä hetkellä vahvistamattomia käyttäjiä<br><br><br>";
        else {



            echo'<br>';


            echo'<form action="varmistuskayttajat10.php" method="post">';

            echo "<br>";
            echo'<div class="cm8-responsive">';
            echo '<table id="mytable" class="cm8-table cm8-bordered cm8-striped"><thead>';
            echo '<tr><th></th><th><a href="kayttajateivahvistetut.php?sorting0=' . $sort8 . '&field8=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajateivahvistetut.php?sorting1=' . $sort8 . '&field8=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajateivahvistetut.php?sorting2=' . $sort8 . '&field8=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th>Rooli</th><th><a href="kayttajateivahvistetut.php?sorting3=' . $sort8 . '&field8=Nimi">Oppilaitos &nbsp&nbsp&nbsp' . $nuoli3 . ' </a></th><th><a href="kayttajateivahvistetut.php?sorting4=' . $sort8 . '&field8=rekisteroitynyt">Rekisteröitynyt &nbsp&nbsp&nbsp' . $nuoli4 . '</a></th><th></th></tr>';
            echo'</thead>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista10[]" value=' . $row[kaid] . '></td><td>' . $row[sukunimi] . "</td><td>" . $row[etunimi] . "</td><td>" . $row[sposti] . '</td><td>' . $row[rooli] . '</td><td>' . $row[Nimi] . '</td><td>' . $row[rekisteroitynyt] . '</th><th><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row[kaid] . '" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
            }
            echo "</table>";
            echo'</div>';
            echo "<br>";
            echo "<br>";
            echo'<button class="pieniroskis" title="Poista käyttäjä"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button>';
            echo'</form>';
            echo "<br>";
            echo "<br>";
            echo'<a href="viestivahvistamattomille.php" style="font-weight: bold">Lähetä viesti kaikille vahvistamattomille käyttäjille <p style="font-size: 1.5em; display: inline-block; padding:0; margin: 0">&#8631</p></a>';
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