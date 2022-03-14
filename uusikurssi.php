<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Lisää uusikurssi/opintojakso</title><meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />

';
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("header.php");
        include("header2.php");

        echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px;">';

        if ($_SESSION["Rooli"] == 'opettaja')
            include("opnavi.php");
        else {
            include("opeadminnavi.php");
        }

        echo'<div class="cm8-container3" style="padding-top: 0px;">';
        echo'<div class="cm8-half" >';




        echo '<form action="lisaakurssi.php" class="form-style-k" autocomplete="off" method="post" ><fieldset>';
        echo '<legend>Lisää uusi kurssi/opintojakso</legend>';
        echo'<a href="omatkurssit.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        if (!$resultkoulut = $db->query("select distinct * from kayttajankoulut, koulut where kayttajankoulut.kayttaja_id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajankoulut.koulu_id=koulut.id ")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        echo'<p>Oppilaitos:<br> 	<select name="kouluid">';

        while ($rowko = $resultkoulut->fetch_assoc()) {
            echo'
	<option value=' . $rowko[id] . '>' . $rowko[Nimi];
        }



        echo'</select></p><br> 
	<p style="font-weight: normal"><b>Vastuuopettaja:</b>  &nbsp&nbsp&nbsp<input type="hidden" name="VastuuOpe" value="' . $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"] . '"> ' . $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"] . ' </p><br>';

        echo'<p style="color: blue">Muut opettajat voit lisätä myöhemmin "Osallistujat"-osiossa:';

        echo'</p>';
        echo'<br><p>Kurssin/Opintojakson nimi:<br> <input  style="width: 50%"  type="text" name="KurssiNimi" maxlength="255" > </p><br>
	<p>Kurssin/Opintojakson koodi: <br><input style="width: 30%"  type="text" name="KurssiKoodi" maxlength="50" ></p> <br>	
	<p>Kurssin/Opintojakson avain:<br><input  style="width: 30%" type="text" name="Avain" maxlength="50" > </p><br>';

        $alkupvm = date('Y-m-d', strtotime("+2 days"));

        $loppupvm = date('Y-m-d', strtotime("+60 days"));

        $lukuvuosialku0 = substr($alkupvm, 5, 5);
        $lukuvuosiloppu0 = substr($loppupvm, 5, 5);


        if ($lukuvuosialku0 <= "12-31" && $lukuvuosialku0 >= "06-05") {
            $lukuvuosialku = substr($alkupvm, 0, 4);
        } else {
            $lukuvuosialku = substr($alkupvm, 0, 4) - 1;
        }
        if ($lukuvuosiloppu0 >= "01-01" && $lukuvuosiloppu0 <= "06-04") {
            $lukuvuosiloppu = substr($loppupvm, 0, 4);
        } else {
            $lukuvuosiloppu = substr($loppupvm, 0, 4) + 1;
        }

        echo'<p>Lukuvuosi:<br>	<select name="lukuvuosialku">';

        echo'<option value=' . $lukuvuosialku . ' selected>' . $lukuvuosialku;


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



 $alkuoletus =  date("j.n.Y");
 $loppuoletus = date('j.n.Y', strtotime($alkuoletus. ' + 60 days'));
 
        echo'<br><p>Alkaa:<br><input type="text" style="width: 25%"  id="bdate" name="AlkuPvm" value=' . $alkuoletus . '> </p><br>
	<p>Päättyy:<br><input type="text"  style="width: 25%" id="edate" name="LoppuPvm" value=' . $loppuoletus. '> </p><br>';

        echo'<p style="color: blue; font-weight: bold" class="eimitaan">Voit halutessasi lisätä kokeen päivämäärän ja aikalaskurin (countdown) kokeeseen: </p>';

        echo'<br><p>Kokeen päivämäärä:<br> <input type="text"  style="width: 25%" id="kdate" name="koepvm"></p> <br>
         
<p>Kokeen kellonaika:<br>(anna muodossa: tt:mm)<br> <input type="text"  style="width: 25%" id="kclock" name="koeaika"> </p><br>
        
  
<p>Salli aikalaskurin näkyminen:<br>';

        echo'<input type="checkbox" name="sallicd"> </p><br><br>';
        ?>


        <script type="text/javascript">

            (function () {
                $.datepicker.setDefaults($.datepicker.regional['fi']);
                var elem = document.createElement('input');
                elem.setAttribute('type', 'text');

                if (elem.type === 'text') {
                    $('#kdate').datepicker({
                        dateFormat: 'dd.mm.yy',
                    });
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
                        minDate: 0
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
        echo'<input type="hidden" name="opeid" value=' . $_SESSION["Id"] . '>	
	<input type="submit" value="&#10003 Lisää kurssi/opintojakso" class="myButton9">
	</fieldset></form>';
        echo'</div>';
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
echo '</div>';
echo '</div>';
echo '</div>';

include("footer.php");
?>

</body>
</html>