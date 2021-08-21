<?php
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Omat itsearviointilomakkeet </title>
<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    include("header.php");
    include("header2.php");

    echo'<div class="cm8-container7">';
    echo'<nav class="topnavoppilas" id="myTopnav">';
    echo'         <a href="etusivu.php" >Etusivu</a> 
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
<a href="omatkurssit.php" >Omat kurssit/opintojaksot</a>
<a href="kurssit.php" >Kaikki kurssit/opintojaksot</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>

<div class="cm8-margin-bottom" style="padding-left: 20px">';


    echo' <h4>Omat itsearviointilomakkeet</h4><br>';

    $field = 'koodi';

    $sort = 'ASC';

    $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
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



    if ($_GET['field'] == 'kurssit.nimi') {
        $field = "kurssit.nimi";
    } elseif ($_GET['field'] == 'koodi') {
        $field = "koodi";
    } elseif ($_GET['field'] == 'koulut.Nimi') {
        $field = "koulut.Nimi";
    } elseif ($_GET['field'] == 'luomispvm') {
        $field = "luomispvm";
    } elseif ($_GET['field'] == 'lukuvuosi') {
        $field = "lukuvuosi";
    } elseif ($_GET['field'] == 'alkupvm') {
        $field = "alkupvm";
    } elseif ($_GET['field'] == 'loppupvm') {
        $field = "loppupvm";
    }

    if (!$result = $db->query("select distinct alkupvm, loppupvm, lukuvuosi, etunimi, sukunimi, luomispvm, kurssit.nimi as nimi, koodi, koulut.Nimi as Nimi, kayttajat.id as kaid, koulut.id as koid, kurssit.id as kid from ia, itsearvioinnit, kurssit, koulut, opiskelijankurssit, kayttajat WHERE opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND kurssit.koulu_id=koulut.id AND kurssit.opettaja_id=kayttajat.id AND (ia.kurssi_id=kurssit.id OR itsearvioinnit.kurssi_id=kurssit.id) ORDER BY $field $sort")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($result->num_rows == 0)
        echo"<br>Ei täytettyjä itsearviointilomakkeita<br>";
    else {

        echo'<br><b style="color: #c7ef00" >Itsearviointilomake löytyy seuraavilta kursseilta/opintojaksoilta</b><br><br>';

        echo'<br><b style="color: #c7ef00" >Klikkaa sen kurssin/opintojakson nimeä, jonka itsearviointilomaketta haluat tarkastella.</b><br><br>';
        echo '<form action="" method="get">';



        echo'<div id="scrollbar"><div id="spacer"></div></div>';
        echo "<br>";
        echo'<div class="cm8-responsive" id="piilota">';
        echo '<table id="mytable" class="cm8-bordered cm8-table cm8-stripedeivikaa"  style="overflow: hidden; width: 99%;"><thead>';

        echo '<tr><th><a href="omatiat.php?sorting0=' . $sort . '&field=koodi">Koodi &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatiat.php?sorting1=' . $sort . '&field=kurssit.nimi">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatiat.php?sorting2=' . $sort . '&field=lukuvuosi">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th><a href="omatiat.php?sorting3=' . $sort . '&field=alkupvm">Alkaa' . $nuoli3 . '</a></th><th><a href="omatiat.php?sorting4=' . $sort . '&field=loppupvm">Päättyy' . $nuoli4 . ' </a></th></tr>';
        echo '</thead>';
        while ($row = $result->fetch_assoc()) {
            if (!$resulthaeope = $db->query("select distinct etunimi, sukunimi from kayttajat, kurssit where kurssit.id='" . $row[kid] . "' AND kayttajat.id=kurssit.opettaja_id")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowope = $resulthaeope->fetch_assoc()) {
                $etunimi = $rowope[etunimi];
                $sukunimi = $rowope[sukunimi];
            }
            $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
            $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));

            if (!$haeia = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $row[kid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            if ($haeia->num_rows != 0) {
                echo '<tr><td><a href="omatiat3.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="omatiat3.php?id=' . $row[kid] . '">' . $row[nimi] . '</a></td><td>' . $etunimi . ' ' . $sukunimi . '</td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td></tr>';
            }

            if (!$haeia2 = $db->query("select distinct * from ia where kurssi_id='" . $row[kid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            if ($haeia2->num_rows != 0) {
                echo '<tr><td><a href="omatiat2.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="omatiat2.php?id=' . $row[kid] . '">' . $row[nimi] . '</a></td><td>' . $etunimi . ' ' . $sukunimi . '</td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td></tr>';
            }
        }
        echo "</table>";
        echo "</div>";
        echo "<br>";
        echo "<br>";
    }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
    <script>
        var $table = $('#mytable');

        $table.floatThead({zIndex: 1});

    </script>        
    <?php
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




