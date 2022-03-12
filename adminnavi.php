<?php
session_start(); 



ob_start();



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
<a href="kaikkitiedostot.php style="margin-bottom: 5px" >Palvelimella olevat tiedostot</a><a href="arvostelut.php">Arvostelut</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
?>
