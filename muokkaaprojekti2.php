<?php
session_start(); 


ob_start();

echo'<!DOCTYPE html><html> 
<head>
<title> Muokkaa Palautus-osiota</title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        $_SESSION[r] = $_POST[pid];
        include("kurssisivustonheader.php");
        echo'<div class="divi" >
         <div class="message"></div>
         <button class="yes">OK</button>
      </div>';


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
        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">

';
        if (!$hae_eka2 = $db->query("select id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka2->num_rows != 0) {
            while ($rivieka2 = $hae_eka2->fetch_assoc()) {
                $eka_id2 = $rivieka2[id];
            }
        }
        echo'';

        if (!$haeprojekti = $db->query("select * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeprojekti->num_rows != 0) {
            echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
            while ($rowP = $haeprojekti->fetch_assoc()) {
                $kuvaus = $rowP[kuvaus];
                $id = $rowP[id];
                if ($_POST[pid] == $id) {

                    echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
                } else {

                    echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
                }
            }
            echo'<div class="cm8-margin-top"></div>';
        }


        echo'</nav>
 </div>';

        if (!$onkoprojekti = $db->query("select * from projektit where id='" . $_POST[pid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowP = $onkoprojekti->fetch_assoc()) {

            $kuvaus = $rowP[kuvaus];
            $pid = $rowP[id];
            $ryhmienmaksimi = $rowP[ryhmienmaksimi];
            $tarkkamaara = $rowP[tarkkamaara];
            $opmaksimi = $rowP[opmaksimi];
            $opminimi = $rowP[opminimi];
            $palautus = $rowP[palautus];
            $sulkeutuu = $rowP[palautus_sulkeutuu];
        }


        echo'<div class="cm8-threequarter" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px">';
        echo '<form name="Form" id="myForm" onSubmit="return validateFormKurssityo();" action="muokkaaprojekti3.php" style="padding-top: 0px; margin-top: 10px" class="form-style-k" style="width:50%" method="post"><fieldset>';

        echo' <legend>Muokkaa Palautus-osiota <b>' . $kuvaus . '</b></legend>';
        echo' <a href="ryhmatyot.php?r=' . $_POST[pid] . '" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';

        if (!$haeoppilaat = $db->query("select distinct * from opiskelijankurssit where ryhma_id <> 0 AND projekti_id='" . $_POST[pid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeoppilaat->num_rows != 0) {
//            echo'<p class="eimitaan" style="color: #e608b8; font-weight: bold;">HUOM! Jos muutat alla olevia tietoja, niin ryhmäjako tehdään uudestaan!</p>';
        }

        echo'<br><p>Muokkaa nimeä: <br><br><input type="text" name="kuvaus" maxlength="60" value="' . $kuvaus . '"></p><br>
	

<br><p>Valitse joko ryhmien tarkka määrä:	<select name="tarkka" id="tasan">';
        if ($tarkkamaara == 0) {
            echo'<option value="' . $tarkkamaara . '">-';
        } else {
            echo'<option value="' . $tarkkamaara . '">' . $tarkkamaara;
            echo'<option value="0">-';
        }

        for ($i = 1; $i <= 100; $i++) {
            echo'
	<option value=' . $i . '>' . $i;
        }

        echo'</select><br><br><br>
<b>tai </b> ryhmien maksimimäärä:	<select name="lkm" id="lkm">';


        echo'<option value="' . $ryhmienmaksimi . '">' . $ryhmienmaksimi;
        echo'<option value="0">-';
        for ($i = 1; $i <= 100; $i++) {
            echo'
	<option id="0' . $i . '" value=' . $i . '>' . $i;
        }

        echo'</select><br></p><br>';

        echo'<div style="color: #e608b8; font-weight: bold; padding-top: 0px" id="divID">
    
</div>';

        echo'<p>Opiskelijoita vähintään/ryhmä:<br><br>	<select id="min" name="minimi">';
        echo'<option value="' . $opminimi . '">' . $opminimi;
        for ($i =  $opminimi+1; $i <= 100; $i++) {
            echo'
	<option value=' . $i . '>' . $i;
        }

        echo'</select><br></p><br>';

        echo'<p>Opiskelijoita enintään/ryhmä:	<br><br><select  id="max" name="maksimi">';
        echo'<option id="piilotamaksimi" value="' . $opmaksimi . '">' . $opmaksimi;
        for ($i =  1; $i <= 100; $i++) {
            echo'
	<option id=' . $i . ' value=' . $i . '>' . $i;
        }

        echo'</select><br></p><br>
 
<p>Sallitaanko opiskelijoille taaiedostojen palautus projektisivulle:<br> <br>';

        if ($palautus = 1) {
            echo'<input type="radio" name="palautus" value="1" checked> Kyllä <br>
<input type="radio" name="palautus" value="0"> Ei <br> <br>';
        } else {
            echo'<input type="radio" name="palautus" value="1"> Kyllä <br>
<input type="radio" name="palautus" value="0" checked> Ei <br> <br>';
        }
        echo'</p><br>';
        echo'<input type="hidden" name="pid" value=' . $_POST[pid] . '>';
        echo'<input type="hidden" name="kurssiId" value=' . $_SESSION["KurssiId"] . '>  						
	<input type="button" onclick="validateFormKurssityo()"  class="myButton9" value="&#10003 Tallenna">
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

                    for ($i = (value - 1); $i >= 0; $i--) {
                        var id = $i;

                        $('#' + id).hide();
                   
                    }
                  
                 
                 $('#piilotamaksimi').hide();
                });



            });



        </script>
        <script>


            $(function () {




                $("#tasan").change(function () {

                    var e = document.getElementById("lkm");
                    var strUser = e.options[e.selectedIndex].text;
                    if (strUser != '-') {
                        var value = "-";
                        $("#lkm").val(value);
                    }




                });









            });



        </script>
        <script>


            $(function () {



                $("#lkm").change(function () {

                    var e = document.getElementById("tasan");
                    var strUser = e.options[e.selectedIndex].text;
                    if (strUser != '-') {
                        var value = '-';
                        $("#tasan").val(value);
                    }



                });



            });


        </script>
        <script>
            document.onkeydown = function (evt) {
                var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
                if (keyCode == 13)
                {
                    //your function call here
                    document.Form.submit();
                }
            }
        </script>
        <?php
session_start(); 


        ob_start();
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