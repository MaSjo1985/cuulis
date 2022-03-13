
<?php
session_start();
ob_start();

echo'
<!DOCTYPE html>
<html>
 
<head>

<title> Rekisteröinti epäonnistui </title>';

include("yhteys.php");

include("header.php");
echo'<div class="cm8-container7" style="padding-top: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px">';

echo' <h4 style="color: #2b6777; padding-top: 0px">Rekisteröityminen</h4>';

echo '<a href="etusivu.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa etusivulle</a><br><br><p style="color:#FF0000 ; font-size:1.1em">Antamasi sähköpostiosoite on jo rekisteröity!</p> <br><b>Kaikki tiedot ovat pakollisia. <br><p style="color: #2b6777">Huom! Roolia ja ensisijaista oppilaitosta ei voi enää myöhemmin muuttaa!!</b></p><br>Vahvistustiedot lähetetään antamaasi sähköpostiosoitteeseen.<br><br>';
echo '<form action="rekisterointitarkistus.php" method="post">

 
<div class="cm8-quarter style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px">

<br><b>Etunimi: <b style="color: #e608b8">*</b></b><br><input type="text"  name="Etunimi">
<br><br><b>Sukunimi: <b style="color: #e608b8">*</b></b><br><input type="text"  name="Sukunimi" >
<br><br><b>Käyttäjätunnus: <b style="color: #e608b8">*</b></b><br><input type="email"  name="Sposti">

</div></div>';

echo'<div class="cm8-container3" style="padding-bottom: 60px">';

if (!$resultkoulut = $db->query("select distinct * from koulut ORDER BY Nimi ASC")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

echo'<br><b>Ensisijainen oppilaitos: <b style="color: #e608b8">*</b></b><br> (Voit myöhemmin liittyä myös muihin)<br><br><select name="koulu">';
echo' <option value="valitsekoulu" selected> Valitse';

while ($rowko = $resultkoulut->fetch_assoc()) {

    echo '<option value=' . $rowko[id] . '>' . $rowko[Nimi];
}
echo'</select>';
echo'
<br><br><br><b>Rooli: <b style="color: #e608b8">*</b></b><br><select name="Rooli">
<option value="valitser" selected> Valitse
		<option value="opettaja"> Opettaja
		<option value="opiskelija"> Opiskelija
	<option value="muu"> Muu		
		</select><br><br><br>


<input type="submit" value="&#10003 Rekisteröidy" class="myButton9">
</form>';


echo '</div>';

include("footer.php");
?>
</body>
</html>	