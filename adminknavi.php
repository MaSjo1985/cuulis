<?php
session_start(); 



ob_start();



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
<a href="kayttajatvahvistus.php" >Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" >Oma oppilaitos</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
?>
