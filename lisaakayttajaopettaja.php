<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Lisää opettaja </title>
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
            echo'<nav class="topnav" id="myTopnav">';
            echo'<a href="etusivu.php" >Etusivu</a>          
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
  <a href="kayttajatvahvistus.php" >Vahvistusta odottavat käyttäjät</a> 
   

  <a href="kayttajatopettajat.php" >Opettajat</a>
  <a href="kayttajatopiskelijat.php">Opiskelijat</a> 
  
 <a href="lisaakayttajaeka.php" class="currentLink3">+ Lisää uusi käyttäjä</a><a href="javascript:void(0);" class="icon" onclick="myFunction2(this)"><div class="bar1"></div>
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
//    if($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin" )
//    {
//        echo' <a href="kayttajateivahvistetut.php">Vahvistamattomat käyttäjät</a>';
//    }

        echo'</nav>';
        echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 60px; border:none">';



echo'<div class="cm8-half" style="padding-top: 0px; margin-top: 0px">';

echo '<form name="Form" id="myForm" class="form-style-k" onSubmit="return validateForm4ope();" action="lisaakayttajatarkistus.php" method="post"><fieldset>';

echo' <legend>Lisää opettaja Cuulis-oppimisympäristöön</legend>';

echo '<a href="lisaakayttajaeka.php" class="palaa">&#8630&nbsp&nbsp&nbsp Palaa takaisin</a>';
echo'<br><br><br><b style="color: #e608b8; font-size: 1em">Kaikki tiedot ovat pakollisia. </b><br>';




echo'<br><br><p>Etunimi: <b style="color: #e608b8">*</b><br><br>
 
<input type="text"   id="etu" name="Etunimi" placeholder="Etunimi"  style="width: 60%"></p>
<div style="color: #e608b8; font-weight: bold; padding: 0px; margin: 0px; display: inline-block" id="divID">
    <p class="eimitaan"></p>
</div>
<br><br><p>Sukunimi: <b style="color: #e608b8">*</b><br><br>

<input type="text" id="suku"    name="Sukunimi" placeholder="Etunimi" style="width: 60%"></p>


<div style="color: #e608b8; font-weight: bold; padding: 0px; margin: 0px; display: inline-block" id="divID2">
 <p class="eimitaan"></p>
</div>
<br><br><p>Käyttäjätunnus eli sähköpostiosoite: <b style="color: #e608b8">*</b><br><br>
<b style="color: blue; font-size: 0.8em" >Muista ilmoittaa käyttäjälle valitsemasi käyttäjätunnus.</b><br><br>


<input type="email"  placeholder="Käyttäjätunnus eli sähköpostiosoite"   id="spostir" name="Sposti" style="width: 60%"></p>';

echo'<div style="color: #e608b8; font-weight: bold; padding: 0px; margin: 0px; display: inline-block" id="divID3">
   <p class="eimitaan"></p>
</div>';
if($_SESSION[Rooli]!='admin'){
    if (!$resultkoulut = $db->query("select distinct * from koulut where id = '" . $_SESSION[kouluId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        
         while ($rowko = $resultkoulut->fetch_assoc()) {

            $koulu = $rowko[Nimi];
        }
        echo'<br><br><p >Ensisijainen oppilaitos: &nbsp&nbsp <b style="font-weight: normal">'.$koulu;
echo'<input type="hidden" id="koulu" name="koulu" value="koulu">';

       
        echo'</b></p>';
echo'<div style="color: #e608b8; font-weight: bold; padding: 0px; margin: 0px; display: inline-block" id="divID4">
     <p class="eimitaan"></p>
</div>';       
}
else{
    if (!$resultkoulut = $db->query("select distinct * from koulut ORDER BY Nimi ASC")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
    echo'<br><br><p>Valitse ensisijainen oppilaitos: <b style="color: #e608b8">*</b><br>
<br>';
echo'<select id="koulu" name="koulu"  onchange="changeFunc();">';
echo' <option value="valitsekoulu" selected>Valitse oppilaitos';

while ($rowko = $resultkoulut->fetch_assoc()) {
    if ($rowko[id] != 19) {
        echo '<option value=' . $rowko[id] . '>' . $rowko[Nimi];
    }
}
echo'</select></p>';

echo'<div style="color: #e608b8; font-weight: bold; padding: 0px; margin: 0px; display: inline-block" id="divID4">
     <p class="eimitaan"></p>
</div>';
}
echo'<br><br><p><label style="margin:0px; padding:0px; font-weight:bold; font-size: 1em; display: none" id="kayttoehdotl"><input onchange="isChecked()" type="checkbox" id="kayttoehdot" checked>&nbsp&nbspHyväksyn <a href="kayttoehdot_opettaja.php" style="border-bottom:1px solid blue; color: blue;"> käyttöehdot </a><b style="color: #e608b8">*</b></label></p>';
echo'<div style="color: #e608b8; font-weight: bold; padding: 0px; margin: 0px; display: none" id="divID5">
     <p class="eimitaan"></p>
</div>';
echo'<input type="hidden" id="admin" name="admin" value="admin">';
echo'<input type="hidden" id="rooli" name="rooli" value="opettaja">';
echo'<div id="username_availability_result"></div>  
<input type="hidden" id="vali" value="99">
<br><input id="button" type="button" onclick="validateForm4ope()" value="&#10003 Rekisteröi opettaja" ><br><br>
	</fieldset></form>';
echo'</div>';


echo '</div>';
echo '</div>';
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
function isChecked() {
     var div5 = document.getElementById("divID5");
    document.getElementById("kayttoehdotl").style.backgroundColor = "white";
        div5.style.padding = "10px 60px 10px 0px";

        div5.innerHTML = "";
}
 </script>
<script type="text/javascript">
$('#etu').on('keyup', function() {
      var div1 = document.getElementById("divID");
    document.getElementById("etu").style.backgroundColor = "white";
        div1.style.padding = "10px 60px 10px 0px";

        div1.innerHTML = "";
});
 </script>
 <script type="text/javascript">
$('#suku').on('keyup', function() {
      var div2 = document.getElementById("divID2");
    document.getElementById("suku").style.backgroundColor = "white";
        div2.style.padding = "10px 60px 10px 0px";

        div2.innerHTML = "";
});
 </script>
 <script type="text/javascript">
$('#spostir').on('keyup', function() {
      var div3 = document.getElementById("divID3");
    document.getElementById("spostir").style.backgroundColor = "white";
        div3.style.padding = "10px 60px 10px 0px";

        div3.innerHTML = "";
});
 </script>
<script type="text/javascript">

   function changeFunc() {
        var div4 = document.getElementById("divID4");
    document.getElementById("koulu").style.backgroundColor = "white";
        div4.style.padding = "10px 60px 10px 0px";

        div4.innerHTML = "";
   }

  </script>
<script>
    var input = document.getElementById("etu");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("suku");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("spostir");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
</body>
</html>	s