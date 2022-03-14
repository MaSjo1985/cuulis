<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Oppilaitokset </title>
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

        echo'<div class="cm8-container7">';
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
<a href="oppilaitokset.php" class="currentLink">Oppilaitokset</a>
<a href="kayttajatvahvistus.php" >Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="kaikkitiedostot.php style="margin-bottom: 5px" >Palvelimella olevat tiedostot</a><a href="arvostelut.php">Arvostelut</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';

        echo'<div class="cm8-container3">';
        echo'<h4 style="display: inline-block; margin-right: 80px">Oppimisympäristössä olevat oppilaitokset:</h4>';
        echo '<a href="uusikoulu.php" class="myButton8"  role="button" >+ Lisää uusi oppilaitos</a>';
        echo'<p id="ohje">Klikkaamalla oppilaitoksen nimeä pääset tarkastelemaan ja muokkaamaan sen tietoja.</p>';
        echo'<br>';




        if (!$resultkoulut = $db->query("select distinct * from koulut  ORDER BY Nimi asc")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($resultkoulut->num_rows == 0)
            echo"<br><br>Ei oppilaitoksia.<br><br>";
        else {

            if ($_GET[kaikki] == 'joo') {



                echo'<form action="varmistuskoulu.php" method="post">';

                echo'<div class="cm8-responsive">';
                echo '<table id="mytable" class="cm8-tableoppilaitos cm8-bordered cm8-stripedeivikaa"><thead>';
                echo '<tr><th><a href="oppilaitokset.php?kaikki=ei">Tyhjennä valinnat<br> &nbsp&#9661&nbsp</a></th><th>Oppilaitos</th></tr>';
                echo'</thead>';
                while ($rowko = $resultkoulut->fetch_assoc()) {

                    echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $rowko[id] . ' checked></td><td><a href="muokkaakoulu.php?id=' . $rowko[id] . '">' . $rowko[Nimi] . '</a></td>';


                    echo'</tr>';
                }

                echo "</table>";
                echo "</div>";
                echo "<br>";
                echo "<br>";
                echo'<button class="pieniroskis" title="Poista oppilaitos"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button>';
                echo'</form>';
            } else {

                echo'<form action="varmistuskoulu.php" method="post">';


                echo'<div class="cm8-responsive">';
                echo '<table id="mytable" class="cm8-tableoppilaitos cm8-bordered cm8-stripedeivikaa"><thead>';
                echo '<tr><th><a href="oppilaitokset.php?kaikki=joo">Valitse kaikki<br> &nbsp&#9661&nbsp</a></th><th>Oppilaitos</th></tr>';
                echo'</thead>';
                while ($rowko = $resultkoulut->fetch_assoc()) {

                    echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $rowko[id] . ' ></td><td><a href="muokkaakoulu.php?id=' . $rowko[id] . '">' . $rowko[Nimi] . '</a>';


                    echo'</td></tr>';
                }

                echo "</table>";

                echo "</div>";
                echo "<br>";
                echo "<br>";

                echo'<button class="pieniroskis" title="Poista oppilaitos"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button>';
                echo'</form>';
            }
        }

        echo "<br>";
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

