<?php
ob_start();
echo'
<!DOCTYPE html>
<html>
 
<head>

<title> Uuden navigointipalkin testausta </title>';

include("yhteys.php");

include("header.php");
echo'<div class="topnav" id="myTopnav">
  <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</div>';



echo'

<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>';



include("footer.php");
?>
</body>
</html>	