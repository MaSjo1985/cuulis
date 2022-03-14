<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Käyttäjien arvostelut </title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>';


include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "admin") {

        include("header.php");
        include("header2.php");


        echo'<div class="cm8-container7" style="padding-top: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 60px">';


        echo'<nav class="topnavOpe" id="myTopnav">';
        echo'<a href="etusivu.php" >Etusivu</a>          
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
<a href="oppilaitokset.php" >Oppilaitokset</a>
<a href="kayttajatvahvistus.php" >Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="kaikkitiedostot.php style="margin-bottom: 5px">Palvelimella olevat tiedostot</a><a href="arvostelut.php"  class="currentLink">Arvostelut</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';

        echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
        echo'<h4>Käyttäjien arvostelut:</h4>';

        $field = 'kayttajan_arvostelu.id';
        $sort = 'DESC';
        $nuoli0 = '<div class="cm8-nuolialas"> </div>';
        $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';

        if (isset($_GET['sorting1'])) {

            if ($_GET['sorting1'] == 'ASC') {
                $sort = 'DESC';
                $nuoli1 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli1 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        } else if (isset($_GET['sorting2'])) {

            if ($_GET['sorting2'] == 'ASC') {
                $sort = 'DESC';
                $nuoli2 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli2 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        } else if (isset($_GET['sorting3'])) {

            if ($_GET['sorting3'] == 'ASC') {
                $sort = 'DESC';
                $nuoli3 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli3 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        } else if (isset($_GET['sorting4'])) {

            if ($_GET['sorting4'] == 'ASC') {
                $sort = 'DESC';
                $nuoli4 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli4 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        } else if (isset($_GET['sorting5'])) {

            if ($_GET['sorting5'] == 'ASC') {
                $sort = 'DESC';
                $nuoli5 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli5 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        } else if (isset($_GET['sorting0'])) {

            if ($_GET['sorting0'] == 'ASC') {
                $sort = 'DESC';
                $nuoli0 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }



        if ($_GET['field'] == 'sukunimi') {
            $field = "sukunimi";
        } elseif ($_GET['field'] == 'etunimi') {
            $field = "etunimi";
        } if ($_GET['field'] == 'arvo') {
            $field = "arvo";
        } elseif ($_GET['field'] == 'Nimi') {
            $field = "Nimi";
        } elseif ($_GET['field'] == 'rooli') {
            $field = "rooli";
        } elseif ($_GET['field'] == 'kayttajan_arvostelu.id') {
            $field = "kayttajan_arvostelu.id";
        }





        if (!$result2 = $db->query("select distinct etunimi, sukunimi, Nimi, rooli, arvo, kayttajat.id as id from kayttajat, kayttajan_arvostelu, kayttajankoulut, koulut where kayttajankoulut.koulu_id=koulut.id and kayttajankoulut.kayttaja_id=kayttajat.id AND kayttajat.id=kayttajan_arvostelu.kayttaja_id ORDER BY $field $sort")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($result2->num_rows == 0)
            echo"<br><br>Ei arvosteluja.<br>";
        else {


            echo'<br>';

            echo "<br>";
            echo'<div class="cm8-responsive" >';
            echo '<table class="cm8-table cm8-bordered cm8-striped" id="mytable"  style="table-layout:fixed; max-width: 100%; ">';
           if($_GET[sorting0]=="ASC"){
                echo '<thead><tr style="text-align: center"><th><a href="arvostelut.php?sorting1=' . $sort . '&field=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli1 . '</a></th><th><a href="arvostelut.php?sorting2=' . $sort . '&field=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th><a href="arvostelut.php?sorting3=' . $sort . '&field=Nimi">Oppilaitos &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="arvostelut.php?sorting4=' . $sort . '&field=rooli">Rooli &nbsp&nbsp&nbsp' . $nuoli4 . '</a></th><th><a href="arvostelut.php?sorting5=' . $sort . '&field=arvo">Arvosana &nbsp&nbsp&nbsp' . $nuoli5 . '</a></th><th><a href="arvostelut.php?sorting0=' . $sort . '&field=kayttajan_arvostelu.id">Uusimmasta vanhimpaan &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th></tr>';
            
           }
           else{
                echo '<thead><tr style="text-align: center"><th><a href="arvostelut.php?sorting1=' . $sort . '&field=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli1 . '</a></th><th><a href="arvostelut.php?sorting2=' . $sort . '&field=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th><a href="arvostelut.php?sorting3=' . $sort . '&field=Nimi">Oppilaitos &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="arvostelut.php?sorting4=' . $sort . '&field=rooli">Rooli &nbsp&nbsp&nbsp' . $nuoli4 . '</a></th><th><a href="arvostelut.php?sorting5=' . $sort . '&field=arvo">Arvosana &nbsp&nbsp&nbsp' . $nuoli5 . '</a></th><th><a href="arvostelut.php?sorting0=' . $sort . '&field=kayttajan_arvostelu.id">Vanhimmasta uusimpaan &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th></tr>';
            
           }
           
            echo'</thead><tbody>';

            while ($row2 = $result2->fetch_assoc()) {
                echo '<tr style="text-align: center"><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row2[id] . '">' . $row2[sukunimi] . '</td><td>' . $row2[etunimi] . '</a></td><td>' . $row2[Nimi] . '</td><td>' . $row2[rooli] . '</td><td style="text-align: center">' . $row2[arvo] . '</td><td></td></tr>';
            }
            echo "</tbody></table>";
            echo "</div>";
            echo "<br>";
            echo "<br>";
        }

        echo'<div class="cm8-margin-top"></div>';
        echo'<div class="cm8-border-top"></div>';

        echo'</div>';
        echo'</div>';
        ?>



        <script>

            var $table = $('#mytable');
            $table.floatThead();

        </script>        
        <?php
session_start(); 


        ob_start();

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

</body>
</html>	
