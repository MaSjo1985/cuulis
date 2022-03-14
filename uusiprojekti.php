<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Lisää uusi Palautus-osio </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("kurssisivustonheader.php");



        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';

        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" class="currentLink" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {

            $kysakt = $rowa[kysakt];
        }
        if ($kysakt == 1) {
            
        } else {
            // echo'<a  href="kysymyksetkommentit.php">Kysy/kommentoi</a>';
        }


        echo'
	  <a href="keskustelut.php" >Keskustele</a> 
	  <a href="osallistujat.php"   >Osallistujat</a>  	  
	   <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
	</nav>';




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




        echo'<div class="cm8-margin-top"></div>';

        echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Palautukset</h2>';
        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';
        if (!$haeprojekti = $db->query("select * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeprojekti->num_rows != 0) {
            echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
            while ($rowP = $haeprojekti->fetch_assoc()) {
                $kuvaus = $rowP[kuvaus];
                $id = $rowP[id];

                echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
            }

            echo'<div class="cm8-margin-top"></div>';


            echo'</div>';
        }






        echo'
	
</nav>
 </div>';





        echo'<div class="cm8-threequarter" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px">';
        echo '<form name="Form" id="myForm" onSubmit="return validateFormKurssityo()" style="padding-top: 0px; margin-top: 10px" action="lisaaprojekti.php" class="form-style-k" method="post"><fieldset>';

        echo' <legend>Lisää uusi Palautus-osio</legend>';
        echo' <a href="ryhmatyot.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br><br>';


        echo'<p>Anna osiolle nimi:<br><input type="text" name="kuvaus" maxlength="60"></p>
	

<br><br><p>Valitse joko ryhmien tarkka määrä:	<select name="tarkka" id="tasan">';
        echo'<option value="0">-';
        for ($i = 1; $i <= 100; $i++) {
            echo'
	<option value=' . $i . '>' . $i;
        }

        echo'</select><br><br><br>
<b>tai </b> ryhmien maksimimäärä:	<select name="lkm" id="lkm">';


        echo'<option value="0">-';
        for ($i = 1; $i <= 100; $i++) {
            echo'
	<option id="0' . $i . '" value=' . $i . '>' . $i;
        }

        echo'</select><br></p><br>';
        echo'<div style="color: #e608b8; font-weight: bold; padding-top: 0px" id="divID">
    
</div>';

        echo'<br><p>Opiskelijoita vähintään/ryhmä:<br>	<select id="min" name="minimi">';

        for ($i = 1; $i <= 100; $i++) {
            echo'
	<option value=' . $i . '>' . $i;
        }

        echo'</select></p>';

        echo'<br><p>Opiskelijoita enintään/ryhmä: <br><select  id="max" name="maksimi">';

        for ($i = 1; $i <= 100; $i++) {
            echo'
	<option id=' . $i . ' value=' . $i . '>' . $i;
        }

        echo'</select></p>
 
<br><p>Sallitaanko opiskelijoille tiedostojen palautus projektisivulle: <br>
<input type="radio" name="palautus" value="1" checked> Kyllä <br>
<input type="radio" name="palautus" value="0"> Ei </p><br> <br>
	
	<input type="hidden" name="kurssiId" value=' . $_SESSION["KurssiId"] . '>  						
	<input type="button" onclick="validateFormKurssityo()" class="myButton9" value="&#10003 Tallenna">
	</fieldset></form>';



        echo'</div>
    
</div></div>';
        ?>

        <script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="jscm/jquery-ui.js"></script>
        <script>

            $(function () {
                $("#min").change(function () {
                      for ($i = 0; $i <= 100; $i++) {
                        var id = $i;

                        $('#' + id).show();
                    }
                    var value = $('option:selected', this).val();
                    $("#max").val(value);

                    for ($i = (value - 1); $i >= 1; $i--) {
                        var id = $i;

                        $('#' + id).hide();
                    }


                });



            });



        </script>
        <script>


            $(function () {
                $("#tasan").change(function () {
                    var value = "-";
                    $("#lkm").val(value);



                });



            });



        </script>
        <script>


            $(function () {
                $("#lkm").change(function () {
                    var value = "-";
                    $("#tasan").val(value);



                });



            });



        </script>
        <?php
session_start();
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";

include("footer.php");
?>

</body>
</html>			