<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Muokkaa itsearviointilomaketta</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        ini_set('display_errors', '0');
        include("kurssisivustonheader.php");
// ready to go!

        $url = $_SERVER[REQUEST_URI];
        $url = substr($url, 1);
        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';


        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a>
          <a href="ia.php"  class="currentLink" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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

        if (isset($_POST[painikelu])) {
            if (!$onkoprojekti = $db->query("select * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($onkoprojekti->num_rows == 0) {
                $db->query("insert into ia_sarakkeet (kurssi_id, jarjestys) values('" . $_SESSION[KurssiId] . "', 1)");
            }
        }


        if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka->num_rows != 0) {
            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }
        }
        echo'<div class="cm8-container3" style="padding-top: 30px">';
if (!$haeonko = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        $onko = $haeonko->num_rows;
        
        if($onko !=0){
             echo'<br><h6 style="padding-top: 0px; padding-bottom: 20px; font-size: 1.3em; color: #2b6777">Muokkaa itserviointilomaketta</h6>';
       
        }
        else{
             echo'<br><h6 style="padding-top: 0px; padding-bottom: 20px; font-size: 1.3em; color: #2b6777">Lisää sisältöä itserviointilomakkeeseen</h6>';
       
        }
       
        echo'<a href="ia.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';


        if (!$haesarakkeet = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if (!$haeonko = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        $onko = $haeonko->num_rows;

        $smaara = $haesarakkeet->num_rows;

        $divleveys = 100 / $smaara;
        echo'<br><br><div style="text-align: center" style="margin-top: 40px">';

        if ($onko == 0) {

            echo'<form action="tuoia.php" method="get" style="display: inline-block; margin-bottom: 40px"><input type="hidden" name="mihin" value="uusi">';
          echo'<button  name="painike" title="Tuo itsearviointi" class="myButtonTuo"><i class="fa fa-recycle"></i>&nbsp&nbsp Tuo aiemmin luotu itsearviointilomake </button>';
  echo'</form>';
            
        }


        echo'</div>';
        echo'<form action="lahetaia.php" method="post">';

        if ($onko != 0) {
            echo'<div style="text-align: center;margin-top: 20px; margin-bottom: 40px">';
            echo'<input type="submit"  name="painiket" value="&#10003  Tallenna itsearviointilomake" class="myButton9"  role="button"  style="font-size: 1em;padding:4px 6px; ">';
            echo'</div>';
        }

        echo'<div style="margin-top: 40px">';
  echo' <div class="cm8-margin-top" id="cm"></div>';
        echo'<div style="text-align: center;margin-top: 0px; margin-bottom: 20px">';
        echo'<input type="submit" name="painikeus" value="+ Lisää sarake" class="myButton8"  role="button" >';
        echo'</div>';
        $sarakkeita = $haesarakkeet->num_rows;
        while ($rows = $haesarakkeet->fetch_assoc()) {
            $smaara--;

            echo'<div class="cm8-responsive" style="overflow: hidden; vertical-align: top; margin: 0px; padding:0px; width:' . $divleveys . '%; display: inline-block">';
            $sid = $rows[jarjestys];


            echo'<input type="hidden" name="sid" value=' . $sid . '>';

            if (!$haetehtavat = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $sid . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $onko = $haetehtavat->num_rows;

            if ($onko != 0) {
                echo '<table id="mytable" class="cm8-uusitableitsea" style="table-layout: fixed; width:100%; overflow-x: scroll">  <thead>';
            } else {
                echo '<table id="mytable" class="cm8-uusitableia" style="width: 100%; "><thead>';
            }





            if ($onko == 0) {

                if ($sarakkeita > 1) {
                    echo '<tr style="border: 1px solid grey; background-color: #48E5DA"><th style="border-right: 1px solid grey; text-align: center; "><input type="submit" name="painikeps" value="Poista sarake ' . $sid . '"  role="button" style="padding: 4px 6px; font-size: 0.9em"></th></tr></thead><tbody>';
                } else {
                    echo '<tr style="border: 1px solid grey; background-color: #48E5DA"><th style="border-right: 1px solid grey; text-align: center; ">Sarake ' . $sid . '</th></tr></thead><tbody>';
                }
            } else {
                if ($sarakkeita > 1) {
                    echo '<tr style="border: 1px solid grey; background-color: #48E5DA" id="poistopaluu'.$sid.'"><th style="border-right: 1px solid grey;text-align: center "><button class="roskis" title="Poista" value="'.$sid.'" style="font-size: 0.8em; margin-left: 0px" name="painikep"><i class="fa fa-trash-o" style="display: inline-block;"></i>&nbspPoista</button></th><th style="border-right: 1px solid grey; text-align: center; "><input type="submit" name="painikeps" value="Poista sarake ' . $sid . '" class="myButton8"  role="button" style="padding: 4px 6px; font-size: 0.9em"></th><th style="text-align: center; font-size:0.8em">Lisää<br>yläpuolelle</th></tr></thead><tbody>';
                } else {
                    echo '<tr style="border: 1px solid grey; background-color: #48E5DA" id="poistopaluu'.$sid.'"><th style="border-right: 1px solid grey;text-align: center "><button class="roskis" title="Poista" value="'.$sid.'" style="font-size: 0.8em; margin-left: 0px" name="painikep"><i class="fa fa-trash-o" style="display: inline-block;"></i>&nbspPoista</button></th><th style="border-right: 1px solid grey; text-align: center; "><input type="submit" name="painikeps" value="Poista sarake '.$sid.'" class="myButton8" role="button" style="padding: 6px 8px; font-size: 1em"></th><th style="text-align: center">Lisää<br>yläpuolelle</th></tr></thead><tbody>';
                }
            }


            while ($rowt = $haetehtavat->fetch_assoc()) {



                if ($rowt[onotsikko] == 1) {
                   
                    $rowt[otsikko] = str_replace('<br />', "", $rowt[otsikko]);

                    echo '<tr id="pj' . $rowt[jarjestys] . '" class="iaihe"><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="otsikko[]"  >' . $rowt[otsikko] . '</textarea>';
                  


                    echo '</td><td style="text-align: center;"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';

                    echo'<input type="hidden" name="id[]" value=' . $rowt[id] . '>';
                    echo'<input type="hidden" name="kysymys[]" value=' . $rowt[kysymys] . '>';
                    echo'<input type="hidden" name="vastaus[]" value=' . $rowt[vastaus] . '>';
                } else if ($rowt[onvastaus] == 1) {

                
                    if ($rowt[onradio] == 1) {


                        echo '<tr id="pj' . $rowt[jarjestys] . '" class="isisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td>';

                        echo'<td style="margin: 0px; padding: 0px" class="sisaltoselitys">';
                        echo '<div class="form-style-spinner"  method="post" style="margin: 0px; padding: 0px"><fieldset>';
                        if (!$haer = $db->query("select distinct * from iavaihtoehdot where ia_id='" . $rowt[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        if ($haer->num_rows > 0) {
                            echo'<div style="text-align: left;  ">';
                            while ($rowr = $haer->fetch_assoc()) {

                                $rowr[vaihtoehto] = str_replace('<br />', "", $rowr[vaihtoehto]);
                                
                                if($_GET[focus]==$rowr[id]){
                                     echo'<input type="radio"  name="listar[]" value=' . $rowr[id] . ' style="margin-right:20px">&nbsp&nbsp&nbsp<textarea  id="rv'.$rowr[id].'" style="display: inline-block; overflow-x: hidden; max-width: 80% " name="vaihtoehto[]" rows="1" autofocus>' . $rowr[vaihtoehto] . '</textarea>';

                                }
                                else{
                                     echo'<input type="radio"  name="listar[]" value=' . $rowr[id] . ' style="margin-right:20px">&nbsp&nbsp&nbsp<textarea  id="rv'.$rowr[id].'" style="display: inline-block; overflow-x: hidden; max-width: 80% " name="vaihtoehto[]" rows="1">' . $rowr[vaihtoehto] . '</textarea>';

                                }
                 
                               
                                echo'<input type="hidden" name="id2[]" value=' . $rowr[id] . '>';


                                echo'<br>';
                            }

                            echo'<br><button title="Poista vaihtoehto" name="painikeprv" style=" display: inline-block"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></p><br>';
                            echo'</div>';
                        }

                        echo'<p style="display: block; margin: 0px; padding: 0px"><input type="submit" name="painikelrv" value="+ Lisää vaihtoehto (' . $rowt[id] . ')" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 1em">';
                        echo'<input type="hidden" name="iaidr" value=' . $rowt[id] . '>';

                        echo'</p></fieldset></div>';

                        echo'</td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                    } else if ($rowt[oncheckbox] == 1) {

                        echo '<tr id="pj' . $rowt[jarjestys] . '" class="isisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td>';

                        echo'<td style="margin: 0px; padding: 0px" class="sisaltoselitys">';
                        echo '<div class="form-style-spinner"  method="post" style="margin: 0px; padding: 0px"><fieldset>';
                        if (!$haec = $db->query("select distinct * from iavaihtoehdot where ia_id='" . $rowt[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        if ($haec->num_rows > 0) {
                            echo'<div style="text-align: left;">';
                            while ($rowc = $haec->fetch_assoc()) {

                                $rowc[vaihtoehto] = str_replace('<br />', "", $rowc[vaihtoehto]);
                                
                                if($_GET[focus] == $rowc[id] ){
                                      echo'<input type="checkbox"  name="listac[]" value=' . $rowc[id] . ' style="margin-right:20px">&nbsp&nbsp&nbsp<textarea id="cv'.$rowc[id].'" style="display: inline-block; overflow-x: hidden; max-width: 80% " name="vaihtoehtoc[]" rows="1" autofocus>' . $rowc[vaihtoehto] . '</textarea>';

                                }
                                else{
                                    echo'<input type="checkbox"  name="listac[]" value=' . $rowc[id] . ' style="margin-right:20px">&nbsp&nbsp&nbsp<textarea id="cv'.$rowc[id].'" style="display: inline-block; overflow-x: hidden; max-width: 80% " name="vaihtoehtoc[]" rows="1" >' . $rowc[vaihtoehto] . '</textarea>';
  
                                }
                              
                                echo'<input type="hidden" name="idc[]" value=' . $rowc[id] . '>';


                                echo'<br>';
                            }
                            echo'<br><button title="Poista vaihtoehto" name="painikepcv" style=" display: inline-block"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></p><br>';
                            echo'</div>';
                        }


                        echo'<p style="display: block; margin: 0px; padding: 0px"><input type="submit" name="painikelcv" value="+ Lisää vaihtoehto (' . $rowt[id] . ')" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 1em">';
                        echo'<input type="hidden" name="iaidc" value=' . $rowt[id] . '>';

                        echo'</p></fieldset></div>';

                        echo'</td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                    } else if ($rowt[onteksti] == 1) {
                        $rowt[vastaus] = str_replace('<br />', "", $rowt[vastaus]);
                   
                         echo '<tr id="pj' . $rowt[jarjestys] . '" class="isisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td class="sisaltoselitys">' . $rowt[vastaus] . '</td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                     
                    }



                    echo'<input type="hidden" name="id[]" value=' . $rowt[id] . '>';
//                    echo'<input type="hidden" name="vastaus[]" value=' . $rowt[vastaus] . '>';
                    echo'<input type="hidden" name="otsikko[]" value=' . $rowt[otsikko] . '>';
                }
            }
            ?>



            <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
            <script>
                var $table = $('#mytable');

                $table.floatThead({zIndex: 1});

            </script>        
            <?php
session_start();
            if ($onko != 0) {
                   echo'<input type="hidden" name="sid" value=' . $sid . '>';
                echo '<tr style="border: none; text:align: left" id="poistopaluu'.$sid.'"><td><button class="pieniroskis" value="'.$sid.'" title="Poista" name="painikep"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td><td style="text-align: center; padding-top: 10px"><input type="hidden" name="ipid" value=' . $ipid . '><input type="hidden" name="sid" value="'.$sid.'">';
                
                echo'<input type="submit" id="paluu'.$sid.'" name="painikelo" value="+ Lisää otsikko/kysymys (' . $sid . ')" class="myButton8"  role="button"><br><input type="submit" name="painikelt" value="+ Lisää tekstivastaus (' . $sid . ')" class="myButton8"  role="button"  ><br><input type="submit" name="painikelr" value="+ Lisää vaihtoehtoja (' . $sid . ')" class="myButton8"  role="button" ><br><input type="submit" name="painikelc" value="+ Lisää monivalintoja (' . $sid . ')" class="myButton8"  role="button"  ></td>';

                echo'<td></td></tr>';
            } else {

                echo '<tr style="border: none; background-color: transparent; text-align: center"><td style="border: none; padding-top:10px"><input type="hidden" name="ipid" value=' . $ipid . '> ';

                echo'<input type="submit" id="paluu'.$sid.'" name="painikelo" value="+ Lisää otsikko/kysymys (' . $sid . ')" class="myButton8"  role="button"><br><input type="submit" name="painikelt" value="+ Lisää tekstivastaus (' . $sid . ')" class="myButton8"  role="button"  ><br><input type="submit" name="painikelr" value="+ Lisää vaihtoehtoja (' . $sid . ')" class="myButton8"  role="button" ><br><input type="submit" name="painikelc" value="+ Lisää monivalintoja (' . $sid . ')" class="myButton8"  role="button"  ></td>';

                echo'</tr>';
            }


            echo "</tbody></table>";


            echo'<input type="hidden" name="monesko" value=' . $_GET[monesko] . '>';
            echo'<input type="hidden" name="ipid" value=' . $ipid . '>';
     echo'<div style="text-align: center;margin-top: 40px">';
        echo'<input type="submit" id="tanne" name="painiket" value="&#10003 Tallenna itsearviointilomake" class="myButton9"  role="button"  style="font-size: 1em;padding:4px 6px; margin-bottom: 20px">';
        
        echo'</div>';
            echo'</div>';
        
        }


      


       


        echo'</form>';
        echo'</div>';


        echo'</div>';
        echo'</div>';
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



include("footer.php");
?>

<script type="text/javascript">

    $('.cm8-responsive').on('change keyup keydown paste cut', 'textarea', function () {
        $(this).height(0).height(this.scrollHeight);
    }).find('textarea').change();
</script>
</body>
</html>								