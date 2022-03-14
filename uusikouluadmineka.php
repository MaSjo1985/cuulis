<?php
session_start();
ob_start();
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title> Lisää ylläpitäjä </title>';

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


        if ($_SESSION[Rooli] == 'admin') {

            $kouluid = $_POST[koid];
        } else {

            $kouluid = $_SESSION[kouluId];
        }

        if (!$result = $db->query("select distinct * from koulut where id = '" . $kouluid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row2 = $result->fetch_assoc()) {


            echo '<p style="font-size: 1.2em; font-weight: bold; padding-top: 10px;">' . $row2[Nimi] . '</p>';
        }
        if (isset($_GET[koid])) {
            $_POST[koid] = $_GET[koid];
        }
        echo '<a href="muokkaakoulu.php?id=' . $_POST[koid] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';


        echo '<p style="font-weight: bold; padding-top: 20px; display: inline-block">Valitse oppilaitokseen lisättävät ylläpitäjät:</p>';
        $field10 = 'sukunimi';
        $sort = 'ASC';
        $nuoli1 = '<div class="cm8-nuoliylos"> </div>';
        $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';


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






        if ($_GET['field10'] == 'sukunimi') {
            $field10 = "sukunimi";
        } elseif ($_GET['field10'] == 'etunimi') {
            $field10 = "etunimi";
        } elseif ($_GET['field10'] == 'rooli') {
            $field10 = "rooli";
        } elseif ($_GET['field10'] == 'sposti') {
            $field10 = "sposti";
        }


        if (!$result10 = $db->query("select distinct kayttajat.id as kaid, etunimi, sukunimi, rooli, sposti from kayttajat, kayttajankoulut where kayttajankoulut.odottaa=1 AND kayttajat.tarkistettu=1 AND kayttajat.vahvistettu=1 AND kayttajat.id=kayttajankoulut.kayttaja_id AND kayttajankoulut.koulu_id='" . $kouluid . "' AND kayttajat.rooli<>'opiskelija' ORDER BY $field10 $sort")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($result10->num_rows == 0)
            echo"<br><br>Ei ylläpitäjäksi lisättäviä käyttäjiä.<br>";
        else {

            echo'<div class="cm8-responsive" style="padding-top: 5px">';
            echo'<form action="uusikouluadmin.php" method="post">';
            echo'<input type="submit" value="&#10003 Lisää" class="myButton9"  role="button"  style="margin-left: 5px; padding:2px 4px; font-size: 0.7em"><br>';
            echo '<table id="mytable" class="cm8-table cm8-stripedeivikaa"><thead>';
            echo '<tr><th>Valitse<br>&nbsp&#9661&nbsp</th><th><a href="muokkaakoulu.php?id=' . $kouluid . '&sorting1=' . $sort . '&field10=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="muokkaakoulu.php?id=' . $kouluid . '&sorting2=' . $sort . '&field10=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th><a href="muokkaakoulu.php?id=' . $kouluid . '&sorting3=' . $sort . '&field10=rooli">Rooli &nbsp&nbsp&nbsp' . $nuoli3 . ' </a></th><th><a href="muokkaakoulu.php?id=' . $kouluid . '&sorting4=' . $sort . '&field10=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th></tr>';
            echo'</thead></tbody>';


            while ($row10 = $result10->fetch_assoc()) {


                if (!$result11 = $db->query("select distinct * from koulunadminit where koulu_id='" . $kouluid . "' AND kayttaja_id='" . $row10[kaid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }



                if ($result11->num_rows == 0) {


                    echo'<tr><td style="padding-left: 10px"><input type="checkbox" class="pieni" name="lista10[]" id=' . $row10[kaid] . '  value=' . $row10[kaid] . '>';
                    echo'<td><label for=' . $row10[kaid] . '> ' . $row10[sukunimi] . '</label></td>';
                    echo'<td><label for=' . $row10[kaid] . '> ' . $row10[etunimi] . '</label></td>';
                    echo'<td>' . $row10[rooli] . '</td><td>' . $row10[sposti] . '</td></tr>';
                }
            }
            echo "</tbody></table>";
            echo'<input type="hidden" name="koid" value=' . $kouluid . '>';

            echo'<br><input type="submit" value="&#10003 Lisää" class="myButton9"  role="button"  style="margin-left: 5px; padding:2px 4px; font-size: 0.7em">';
            echo'</form>';
            echo'</div>';
            echo "<br>";
            echo "<br>";
        }




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
