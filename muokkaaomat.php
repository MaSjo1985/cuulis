<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Muokkaa omia tietoja </title>
<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script><script src="https://code.jquery.com/jquery-1.10.2.js"></script>';

include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");

    echo'<div class="cm8-container7">';

    if ($_SESSION["Rooli"] == 'admin')
        include("adminnavi.php");
    else if ($_SESSION["Rooli"] == 'admink')
        include("adminknavi.php");
    else if ($_SESSION["Rooli"] == 'opeadmin')
        include("opeadminnavi.php");
    else
        include("opnavi.php");

    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';


    if (!$result = $db->query("select distinct * from kayttajat where id = '" . $_SESSION["Id"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row2 = $result->fetch_assoc()) {
        $etunimi = $row2[etunimi];
        $sukunimi = $row2[sukunimi];
        $sposti = $row2[sposti];
        $id = $row2[id];
        $omakuva = $row2[omakuva];
    }






    echo'<h7> Muokkaa omia tietojasi</h7>';
    echo'<br><a href="omattiedot.php?id=' . $_SESSION["Id"] . '" > <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin muutoksia tekemättä</a><br>';
    echo'<div class="cm8-half" style="padding-top: 10px; margin-left: 0px; padding-left: 0px">';
    if($_SESSION[Rooli]=='opiskelija'){
         echo '<form name="Form" id="myForm" onSubmit="return validateForm7opiskelija();" class="form-style-k"  action="muokkaaomattiedot2.php" method="post" ><fieldset>';

    }
    else{
         echo '<form name="Form" id="myForm" onSubmit="return validateForm7ope();" class="form-style-k"  action="muokkaaomattiedot2.php" method="post" ><fieldset>';

    }
   


    echo'<br><fieldset>';

    echo'<legend>Perustiedot</legend>';

    echo'<p>Etunimi:<br><br>
    
<input type="text" id="etu"  style="width:50%"  name="uusietu" value=' . $etunimi . ' ></p>
    <div style="display: inline-block; color: #e608b8; font-weight: bold; padding-top: 0px" id="divID" >
    <p class="eimitaan" style="display: inline-block"></p>
</div>    <br> 
	<p>Sukunimi:<br><br>
        
<input type="text" id="suku"  style="width:50%"  name="uusisuku" value=' . $sukunimi . ' ></p>
    <div style="display: inline-block; color: #e608b8; font-weight: bold; padding-top: 0px" id="divID2">
    <p class="eimitaan"></p>
</div> <br><br>';
    
    if($_SESSION["Rooli"]=='opiskelija'){
        	echo'<p>Käyttäjätunnus:<br><br>
                      <b style="color: #e608b8; font-size: 0.8em">On suositeltavaa, että et valitse sähköpostiosoitetta käyttäjätunnukseksi.</b><br><br>
     <b style="color: #e608b8; font-size: 0.8em">Käyttäjätunnuksessa ei saa olla välilyöntiä.</b><br><br>
   
<textarea style="width:50%" id="spostir" name="uusisposti" placeholder="Käyttäjätunnus" value=' . $sposti . ' rows="1">'.$sposti.'</textarea></p>';
    }
    else{
        	echo'<p>Käyttäjätunnus eli sähköpostiosoite:<br><br>  
<input type="email" style="width:50%" id="spostir" name="uusisposti" placeholder="Käyttäjätunnus eli sähköpostiosoite" value=' . $sposti . ' ></p>';
    }

        
    echo'<div style="display: inline-block; color: #e608b8; font-weight: bold; padding-top: 0px" id="divID3">
    <p class="eimitaan"></p>
</div>      
	<input type="hidden" id="id" name="id" value=' . $_SESSION["Id"] . ' >';
   if($_SESSION[Rooli]=='opiskelija'){
          echo'<br><br><input id="button" type="button" onclick="validateForm7opiskelija()" value="&#10003 Tallenna perustiedot" class="myButton9" style="font-size: 0.9em"><br>';
   }
   else{
          echo'<br><br><input id="button" type="button" onclick="validateForm7ope()" value="&#10003 Tallenna perustiedot" class="myButton9" style="font-size: 0.9em"><br>';
   }
 		
	echo'</fieldset></form>';


    if ($_SESSION[Rooli] != 'admin' && $_SESSION[Rooli] != 'admink') {
        echo '<form action="muokkaaomakoulu.php" class="form-style-k" method="post">';
        echo'<fieldset>';
        echo'<legend>Oppilaitokset</legend>';
        echo '<br><b style="font-size: 1em">Oppilaitokset, joihin olet liittynyt liittynyt:</b><br><ber>';


        if (!$result2 = $db->query("select distinct kayttajat.id as kaid, koulut.id as koid, etunimi, sukunimi, rooli, sposti, Nimi from kayttajat, kayttajankoulut, koulut where kayttajat.id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajat.id=kayttajankoulut.kayttaja_id AND kayttajankoulut.koulu_id=koulut.id")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($row2 = $result2->fetch_assoc()) {
            echo '<br><b style="font-weight: normal; font-size: 0.9em">' . $row2[Nimi] . '</b>';
            echo'<a href="poistukoulusta.php?kouluid=' . $row2[koid] . '" class="myButton9" style="margin-left: 20px; font-size: 0.7em"> X &nbsp&nbspPoistu</a>';

//            
//            echo' <form action="poistukoulustavarmistus.php" method="post" style="display: inline-block"><br><br><input type="hidden" name="koid" value=' . $row2[koid] . '><input type="hidden" name="kaid" value=' . $_SESSION["Id"] . '><input type="submit" name="painikep" value="&#10007" title="Poista aikataulu" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
//        
        }

        if ($_SESSION["Rooli"] == 'opiskelija' && $_SESSION["vaihto"] != 1) {

            echo '<br><p style="padding-top: 10px"><b  style="font-size: 1.1em">Liity uuteen oppilaitokseen:</b><br><br>';





            if (!$resultkoulut = $db->query("select distinct Nimi, koulut.id as kid from koulut, kayttajankoulut where koulut.id NOT IN(select distinct koulut.id from koulut, kayttajankoulut where kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id='" . $_SESSION["Id"] . "')")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $maara = 0;
            while ($rowko = $resultkoulut->fetch_assoc()) {
                $maara++;
                echo'<input id=' . $maara . ' type="checkbox" class="formi" class="pieni" name="lista[]" value=' . $rowko[kid] . '>';
                echo'<label for=' . $maara . '>' . $rowko[Nimi] . '</label><br>';
            }
            echo'</p>';
            echo'<input type="hidden" name="id" value=' . $row2[id] . '>  
			<br>		
			<input type="submit" value="&#10003 Liity" class="myButton9" style="font-size: 0.9em">			
				</fieldset></form>';
        }

        if (($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'opeadmin') || ($_SESSION["vaihto"] == 1 && $_SESSION["Rooli"] == 'opiskelija')) {
            echo '<br><form action="muokkaaomakoulu.php" method="post">';
            echo '<br><p style="padding-top: 10px"><b  style="font-size: 1.1em">Liity uuteen oppilaitokseen:</b> <br><br> <b style="font-size: 0.8em">(Oppilaitoksen ylläpitäjän hyväksymisen jälkeen vahvistusviesti lähetetään sähköpostiosoitteeseesi)</b><br><br>';


            if (!$resultkoulut = $db->query("select distinct Nimi, koulut.id as kid from koulut, kayttajankoulut where koulut.id NOT IN(select distinct koulut.id from koulut, kayttajankoulut where kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id='" . $_SESSION["Id"] . "')")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowko = $resultkoulut->fetch_assoc()) {

                if ($rowko[kid] != 19) {
                    echo'<input type="checkbox" name="lista[]" id=' . $rowko[kid] . '  value=' . $rowko[kid] . '>';
                    echo'<label for=' . $rowko[kid] . '>' . $rowko[Nimi] . '</label><br>';
                }
            }
            echo'</p>';
            echo'<input type="hidden" name="id" value=' . $row2[id] . '>
            
			<br>	
			<input type="submit" value="&#10003 Liity" class="myButton9" style="font-size: 0.9em">			
				</fieldset></form>';
        }
    }


    echo'</div>';
    echo'</div>';
    echo'</div>';

    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>
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
<script>
$("textarea").keydown(function(e){
// Enter was pressed without shift key
if (e.keyCode == 13 && !e.shiftKey)
{
    // prevent default behavior
    e.preventDefault();
}
});
</script>
</body>
</html>			
