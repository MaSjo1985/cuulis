<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Muokkaa kurssia/opintojaksoa/opintojaksoa</title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("kurssisivustonheader.php");


        echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 30px">';

        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '" class="currentLink">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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








        echo'<div class="cm8-half" style="margin-top: 0px; padding-top: 0px">';





        if (!$result = $db->query("select * from kurssit where id = '" . $_SESSION[KurssiId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row2 = $result->fetch_assoc()) {


            $koeaika = $row2[koeaika];
            $koepvm = $row2[koepvm];

            $koodi = $row2[koodi];
            $nimi = $row2[nimi];
            $id = $row2[id];
        }
        if (!$resultl1 = $db->query("select LEFT(lukuvuosi,4) as alku from kurssit where id = '" .  $_SESSION[KurssiId]  . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$resultl2 = $db->query("select RIGHT(lukuvuosi,4) as loppu from kurssit where id = '" . $_SESSION[KurssiId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowl1 = $resultl1->fetch_assoc()) {
            $lukuvuosialku = $rowl1[alku];
        }
        while ($rowl2 = $resultl2->fetch_assoc()) {
            $lukuvuosiloppu = $rowl2[loppu];
        }



        if (!$result8 = $db->query("select * from koulut where id = '" . $_SESSION["kouluId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row8 = $result8->fetch_assoc()) {
            $koulunimi = $row8[Nimi];
        }
        echo '<form action="muokkaakurssitiedot.php" autocomplete="off" method="post" class="form-style-k"><fieldset>';
        echo '<legend>Muokkaa kurssia/opintojaksoa/opintojaksoa</legend>';

        echo'<a href="kurssi.php?id=' . $_SESSION[KurssiId] . '" class="palaa"> &#8630 &nbsp&nbsp&nbsp Palaa takaisin </a><br><br>';



        echo'<p>Oppilaitos: <br> 	<select name="kouluid">
<option value=' . $_SESSION["kouluId"] . ' selected>' . $koulunimi;


        if (!$resultkoulut = $db->query("select distinct * from kayttajankoulut, koulut where kayttajankoulut.kayttaja_id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajankoulut.koulu_id=koulut.id AND koulut.Nimi<>'" . $koulunimi . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowko = $resultkoulut->fetch_assoc()) {
            echo'
	<option value=' . $rowko[id] . '>' . $rowko[Nimi];
        }
        echo'</select></p>
<br><p style="font-weight: normal"><b>Vastuuopettaja:</b> &nbsp&nbsp&nbsp<input type="hidden" name="ope" value="' . $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"] . '"> ' . $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"] . ' </p><br>';

        echo'<p style="color: blue">Muut opettajat voit lisätä "Osallistujat"-osiossa:';

        echo'</p>';


        echo'<br><p>Kurssin/Opintojakson nimi:<br> <textarea style="width: 60%" rows="1" name="nimi" maxlength="255">' . $_SESSION["KurssiNimi"] . '</textarea></p><br>
<p>Koodi:<br> <input type="text" name="koodi" style="width: 30%" maxlength="50"  value=' . $_SESSION["Koodi"] . '> </p><br>';
        echo'<p>Avain:<br> <input type="text"  style="width: 30%"  name="avain"   maxlength="50" value=' . $_SESSION["Avain"] . '> </p>';




        echo'<br><p>Lukuvuosi: <br>	<select name="lukuvuosialku">
	<option value=' . $lukuvuosialku . ' selected>' . $lukuvuosialku;


        for ($i = 2020; $i <= 2040; $i++) {

            if ($i != $lukuvuosialku) {
                echo'
		<option value="' . $i . '">' . $i;
            }
        }
        echo'</select>';
        echo' <b> - </b> ';
        echo' <select name="lukuvuosiloppu">
	<option value=' . $lukuvuosiloppu . ' selected>' . $lukuvuosiloppu;


        for ($i = 2020; $i <= 2040; $i++) {

            if ($i != $lukuvuosiloppu) {
                echo'
		<option value="' . $i . '">' . $i;
            }
        }
        echo'</select></p>';
        echo'<br>';



//die($_SESSION["Alkupvm"]);
        $_SESSION["Alkupvm"] = date("d.m.Y", strtotime($_SESSION["Alkupvm"]));
        $_SESSION["Loppupvm"] = date("d.m.Y", strtotime($_SESSION["Loppupvm"]));

        echo'<p>Alkaa:<br> <input type="text"  style="width: 25%"  id="bdate" name="alkupvm" value=' . $_SESSION["Alkupvm"] . '> </p><br>
<p>Päättyy: <br> <input type="text"  style="width: 25%"  id="edate" name="loppupvm" value=' . $_SESSION["Loppupvm"] . '> </p><br>';

        echo'<p style="color: blue; font-weight: bold" class="eimitaan">Voit halutessasi lisätä kokeen päivämäärän ja aikalaskurin (countdown) kokeeseen: </p><br>';


        if ($koepvm != '01.01.1971') {
            echo'<p>Kokeen päivämäärä:<br>(annettava muodossa: pp.dd.yyyy)<br><input  style="width: 25%"  type="text" id="kdate" name="koepvm" value=' . $koepvm . '> </p>';
        } else {
            echo'<p>Kokeen päivämäärä:<br>(annettava muodossa: pp.dd.yyyy)<br><input  style="width: 25%" type="text" id="kdate" name="koepvm"> </p>';
        }
        echo'<br><p>Kokeen kellonaika:<br>(annettava muodossa: tt:mm)<br> <input type="text"  style="width: 30%"  id="kclock" name="koeaika" value=' . $koeaika . '> </p>
        
            <br><p>Salli aikalaskurin näkyminen kokeeseen: &nbsp&nbsp&nbsp';
        if ($_SESSION["Sallicd"] == 1)
            echo'<input type="checkbox" name="sallicd" checked>';
        else {
            echo'<input type="checkbox" name="sallicd">';
        }
        echo'</p>';
        ?>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

        <script type="text/javascript" src="jscm/jquery.timepicker.js"></script>
        <script src="jscm/jquery-ui.js"></script>
        <script type="text/javascript" src="/js/fi.js"></script>
        <script>
            (function () {
                $.datepicker.setDefaults($.datepicker.regional['fi']);
                var elem = document.createElement('input');
                elem.setAttribute('type', 'text');

                if (elem.type === 'text') {

                    $('#bdate').datepicker({
                        dateFormat: 'dd.mm.yy',
                    });

                    $("#bdate").change(function () {

                        var currentDate = $("#bdate").datepicker("getDate");


                        $('#edate').datepicker('option', 'minDate', new Date(currentDate));
                    });

                    $("#edate").change(function () {

                        var currentDate2 = $("#edate").datepicker("getDate");

                        $('#bdate').datepicker('option', 'maxDate', new Date(currentDate2));

                    });

                    $('#edate').datepicker({
                        dateFormat: 'dd.mm.yy',
                     
                    });
                    $('#kdate').datepicker({
                        dateFormat: 'dd.mm.yy',
                    });
                }

                $('#kclock').timepicker({
                    timeFormat: 'HH:mm',
                    // year, month, day and seconds are not important
                    minTime: new Date(0, 0, 0, 8, 0, 0),
                    maxTime: new Date(0, 0, 0, 23, 55, 0),
                    // time entries start being generated at 6AM but the plugin 
                    // shows only those within the [minTime, maxTime] interval
                    startHour: 6,
                    // the value of the first item in the dropdown, when the input
                    // field is empty. This overrides the startHour and startMinute 
                    // options
                    startTime: new Date(0, 0, 0, 8, 0, 0),
                    maxTime: new Date(0, 0, 0, 23, 55, 0),
                    // items in the dropdown are separated by at interval minutes
                    interval: 15
                });


            })();



        </script>

        <?php
session_start(); 


        ob_start();

        echo'<input type="hidden" name="id" value=' . $id . '>  
<br><br><input type="submit" value="&#10003 Tallenna" class="myButton9">			
		</fieldset></form>';
        echo'</div>';



        echo "<br>";
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";
echo "</div>";

include("footer.php");
?>
</body>
</html>			
