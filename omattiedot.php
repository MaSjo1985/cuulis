<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Omat tiedot</title>
<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script><script src="https://code.jquery.com/jquery-1.10.2.js"></script>';
echo'<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
<script type="text/javascript" src="js/TimeCircles.js"></script>

<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script>';
echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js">   </script>
<script src="js/jquery.barrating.min.js"></script>';
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    include("header.php");
    echo'
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>



<script src="basic-javascript-functions.js" language="javascript" type="text/javascript"></script>';
    echo'
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js">   </script>
<script src="js/jquery.barrating.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>';

    echo' <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  <script type="text/javascript" src="jscm/jquery.timepicker.js"></script>
        <script src="jscm/jquery-ui.js"></script>
        <script type="text/javascript" src="/js/fi.js"></script>';
    if (!$resultoma = $db->query("select * from kayttajan_arvostelu where kayttaja_id = '" . $_SESSION["Id"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></figure></a></p></footer>');
    }
    if ($resultoma->num_rows == 0) {
        echo'<input type="hidden" id="oma" value="0"></>';
    } else {
        while ($row = $resultoma->fetch_assoc()) {
            $oma = $row[arvo];
        }
        echo'<input type="hidden" id="oma" value=' . $oma . '></>';
    }






    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');

    $url2 = $_SERVER[REQUEST_URI];

    $url2 = substr($url2, 1);


    echo'<div class="cm8-half" style="padding-bottom: 0px;padding-top: 0px; padding-left: 0px; margin-left: 0px">';
    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'opiskelija') {


        if ($_SESSION["Rooli"] == 'opiskelija' && $_SESSION["vaihto"] == 1) {


            echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3-valittu" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';


            echo'<form action="vaihda.php" method="post" style="display: inline-block; margin-left: 40px"><input type="hidden" name="url" value="' . $url . '" ><input type="hidden" name="mihin" value="etu"><input type="hidden" name="'
            . '" value="pois"> <input type="submit" value="Poistu opiskelijanäkymästä" class="munNappula2"  role="button"></form>';
        } else {

            echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3-valittu" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';
        }
    } else if ($_SESSION["Rooli"] == 'opeadmin' || $_SESSION["Rooli"] == 'admink') {
        echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3-valittu" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';
    } else {
        echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3 valittu" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a>
  	
 <a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i></a></p>';
    }
    echo'</div>';
    echo'<div class="cm8-quarter" style="padding-top: 0px;padding-left: 0px; margin-left: 0px">';
    echo'<p style="display: inline-block; margin-right: 20px; padding-top: 10px; margin-top: 0px; margin-bottom: 0px" ><select id="example">
  <option style="display: inline-block" value="1">1</option>
  <option style="display: inline-block" value="2">2</option>
  <option style="display: inline-block" value="3">3</option>
  <option style="display: inline-block" value="4">4</option>
  <option style="display: inline-block" value="5">5</option>
</select></p>';


    echo'<div style="display: inline-block; font-size: 0.8em; padding: 0px; margin: 0px" id="keski" ></div>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    ?>
    <script type="text/javascript">
        $(function () {
            var value = document.getElementById('oma').value;


            $('#example').barrating({
                theme: 'fontawesome-stars',
                deselectable: true,
                initialRating: document.getElementById('oma').value,
                allowEmpty: true,
                onSelect: function (value, text, event) {

                    // rating was selected by a user
                    var arvo = text;

                    $.ajax({
                        type: 'post',
                        url: 'kirjaa.php',
                        data: {arvo: arvo},
                        dataType: 'json',
                        success: function (data) {


                        }
                    });
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById('keski').innerHTML = xmlhttp.responseText;
                        }


                    }


                    xmlhttp.open('GET', 'haekeski.php', true);
                    xmlhttp.send();

                }

            });

            $('#example').barrating('set', value);

        });
    </script>
    <?php
session_start(); 


    echo'<div class="cm8-container7">';

    if ($_SESSION["Rooli"] == 'admin')
        include("adminnavi.php");
    else if ($_SESSION["Rooli"] == 'admink')
        include("adminknavi.php");
    else if ($_SESSION["Rooli"] == 'opeadmin')
        include("opeadminnavi.php");
    else
        include ("opnavi.php");
    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
    echo"<h4>Oma käyttäjäprofiili </h4>";


    echo"<br>";

    if (!$result = $db->query("select distinct * from kayttajat where id='" . $_SESSION["Id"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    echo'<div class="cm8-responsive">';
    echo '<table class="cm8-table2 cm8-bordered2">';
    echo"<tr><td>";

    while ($row = $result->fetch_assoc()) {

   
            echo'<br>';
        


        echo "<b>Etunimi: </b> &nbsp&nbsp&nbsp " . $row[etunimi] . '<br><br>';
        echo "<b>Sukunimi: </b> &nbsp&nbsp&nbsp " . $row[sukunimi] . '<br><br>';
        if ($_SESSION["Rooli"] == 'opeadmin') {
            echo '<b>Rooli:</b> &nbsp&nbsp&nbsp  Opettaja ja oppilaitoskohtainen ylläpitäjä<br><br>';
        } else if ($_SESSION["Rooli"] == 'admink') {
            echo '<b>Rooli:</b> &nbsp&nbsp&nbsp  Oppilaitoskohtainen ylläpitäjä<br><br>';
        } else if ($_SESSION["Rooli"] == 'admin') {
            echo '<b>Rooli:</b>  &nbsp&nbsp&nbsp Yleinen ylläpitäjä<br><br>';
        } else if ($_SESSION["Rooli"] == 'opettaja') {
            echo '<b>Rooli:</b>  &nbsp&nbsp&nbsp Opettaja<br><br>';
        } else if ($_SESSION["Rooli"] == 'opiskelija') {
            echo '<b>Rooli:</b>  &nbsp&nbsp&nbsp Opiskelija<br><br>';
        }


        echo "<b>Käyttäjätunnus: </b> &nbsp&nbsp&nbsp " . $row[sposti] . '<br><br>';
    }
    if ($_SESSION["Rooli"] == 'opiskelija' || $_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {
        echo "<b>Oppilaitokset, joihin olet liittynyt:</b><br> ";
        if (!$result2 = $db->query("select distinct etunimi, sukunimi, rooli, sposti, Nimi, koulut.id as koid from kayttajat, kayttajankoulut, koulut where kayttajat.id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajat.id=kayttajankoulut.kayttaja_id AND kayttajankoulut.koulu_id=koulut.id")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($row2 = $result2->fetch_assoc()) {


            echo "<br>" . $row2[Nimi];
        }
    }
    if ($_SESSION[Viimepaiva] != "") {
        echo "<br><br><br><b>Edellinen sisäänkirjautumisesi oli :</b>  &nbsp&nbsp&nbsp " . $_SESSION[Viimepaiva] . ' ' . $_SESSION["Viimekello"] . '<br><br>';
    }
    echo "</td></tr></table></div>";



    echo'<br><br><a href="muokkaaomat.php" class="myButton8"  role="button"  style="margin-right: 60px">&#9998 Muokkaa tietoja</a>';
    echo'<a href="poistuvarmistus.php" class="myButton8"  role="button" >&#10007 Poistu oppimisympäristöstä</a><br>';


    echo'<div class="cm8-quarter" style="padding-top: 10px">';


    echo '<form name="Form" id="myForm" class="form-style-k" onSubmit="return validateForm6();" action="salasananvaihtotarkistus.php" method="post"><fieldset>
 <legend>Vaihda salasana:</legend>
<br><b style="color: #e608b8; font-size: 0.8em">Hyvässä salasanassa on vähintään 12 merkkiä, pieniä ja isoja kirjaimia sekä erikoismerkkejä ja numeroita.</b>
<br><br><br>
<p>Vanha salasana: <br>

<input type="password" style="width: 80%" id="vanha" name="VanhaSalasana" > 
  <span id="show1" class="fa fa-eye-slash" style="display: inline-block" title="Näytä salasana"> </span></p>
<div style="display: inline-block; color: #e608b8; font-weight: bold; padding-top: 0px" id="divID">
    <p class="eimitaan"></p>
</div>
 
	<br><p>Uusi salasana:<br>
     
<input type="password" style="width: 80%" id="uusi" name="Salasana">
  <span id="show2" class="fa fa-eye-slash" style="display: inline-block" title="Näytä salasana"> </span></p>
<div style="display: inline-block; color: #e608b8; font-weight: bold; padding-top: 0px" id="divID2">
    <p class="eimitaan"></p>
</div>  

	<br><p>Toista uusi salasana:<br>
   
<input type="password" style="width: 80%" id="uusi2" name="UusiSalasana">
  <span id="show3" class="fa fa-eye-slash" style="display: inline-block" title="Näytä salasana"> </span></p>
<div style="display: inline-block; color: #e608b8; font-weight: bold; padding-top: 0px" id="divID3">
    <p class="eimitaan"></p>
</div>
<input type="hidden" name="omat" value="1">
	<br><input type="button" id="button" onclick="validateForm6()" value="&#10003 Vaihda salasana" class="myButton9"><br><br>
	</fieldset></form>';
    echo'</div>';
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
$('#vanha').on('keyup', function() {
      var div2 = document.getElementById("divID");
    document.getElementById("vanha").style.backgroundColor = "white";
        div2.style.padding = "10px 60px 10px 0px";

        div2.innerHTML = "";
});
 </script>
    <script type="text/javascript">
$('#uusi').on('keyup', function() {
      var div2 = document.getElementById("divID2");
    document.getElementById("uusi").style.backgroundColor = "white";
        div2.style.padding = "10px 60px 10px 0px";

        div2.innerHTML = "";
});
 </script>
 <script type="text/javascript">
$('#uusi2').on('keyup', function() {
      var div3 = document.getElementById("divID3");
    document.getElementById("uusi2").style.backgroundColor = "white";
        div3.style.padding = "10px 60px 10px 0px";

        div3.innerHTML = "";
});
 </script>
<script>
    $(function () {

        $("#show1").on("click", function () {
            var x = $("#vanha");
            if (x.attr('type') === "password") {
                x.attr('type', 'text');
                $(this).removeClass('fa fa-eye-slash');
                document.getElementById('show1').setAttribute('title', 'Piilota salasana');
                $(this).addClass('fa fa-eye');
            } else {
                x.attr('type', 'password');
                $(this).removeClass('fa fa-eye');
                $(this).addClass('fa fa-eye-slash');
                document.getElementById('show1').setAttribute('title', 'Näytä salasana');
            } // End of if
        })// End of click event

    });
</script>
<script>
    $(function () {

        $("#show2").on("click", function () {
            var x = $("#uusi");
            if (x.attr('type') === "password") {
                x.attr('type', 'text');
                $(this).removeClass('fa fa-eye-slash');
                document.getElementById('show2').setAttribute('title', 'Piilota salasana');
                $(this).addClass('fa fa-eye');
            } else {
                x.attr('type', 'password');
                $(this).removeClass('fa fa-eye');
                $(this).addClass('fa fa-eye-slash');
                document.getElementById('show2').setAttribute('title', 'Näytä salasana');
            } // End of if
        })// End of click event

    });
</script>
<script>
    $(function () {

        $("#show3").on("click", function () {
            var x = $("#uusi2");
            if (x.attr('type') === "password") {
                x.attr('type', 'text');
                $(this).removeClass('fa fa-eye-slash');
                document.getElementById('show3').setAttribute('title', 'Piilota salasana');
                $(this).addClass('fa fa-eye');
            } else {
                x.attr('type', 'password');
                $(this).removeClass('fa fa-eye');
                $(this).addClass('fa fa-eye-slash');
                document.getElementById('show3').setAttribute('title', 'Näytä salasana');
            } // End of if
        })// End of click event

    });
</script>
<script>
    var input = document.getElementById("vanha");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("uusi");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("uusi2");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
</body>
</html>			
