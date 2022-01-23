<?php
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Muokkaa kyselylomaketta</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!
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
          <a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  class="currentLink" >Kyselylomake</a>
		
	 ';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
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



        if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka->num_rows != 0) {
            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }
        }
        echo'<div class="cm8-container3" style="padding-top: 30px">';

        echo'<br><h6 style="padding-top: 0px; padding-bottom: 20px; font-size: 1.2em; color: #f7f9f7">Muokkaa kyselylomaketta</h6>';
        echo'<a href="kysely.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';





        if (!$haetehtavat = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $onko = $haetehtavat->num_rows;



        echo'<div style="text-align: center">';

        if($onko == 0){
                echo'<form action="tuokyselylomake.php" method="get" style="display: inline-block; font-size: 1.1em"><input type="hidden" name="monesko" value=' . $_GET[monesko] . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9850;&nbsp&nbsp Tuo lomake toisesta kurssista/opintojaksosta" class="myButtonTuo"  role="button"></form>';

        }
    
        echo'</div>';
        echo'<div class="cm8-responsive">';
        echo'<br><br><form action="lahetakyselylomake.php" method="post">';





        echo '<table id="mytable" class="cm8-uusitablekysely" style="table-layout:fixed; width: 90%;">  <thead>';

        if ($_GET[kaikki] == 'joo') {

            if ($onko != 0) {
                echo '<tr style="border: 1px solid grey; background-color: #48E5DA"><th style="border-right: 1px solid grey;"><button class="roskis" title="Poista" style="font-size: 0.8em; margin-left: 0px" name="painikep"><i class="fa fa-trash-o" style="display: inline-block; margin-right: 10px"></i>Poista</button><br><br><a href="uusikysely.php?&monesko=' . $_GET[monesko] . '#cm" style="font-size: 0.9em">Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th style="border-right: 1px solid grey; text-align: center;"><input type="submit" id="tanne" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="font-size: 0.9em; padding:4px 6px;"><br><br>Sisältö</th><th>Pakollinen</th><th><input type="submit" name="painikelo" value="+ Lisää kysymys yläpuolelle" class="myButton8"  role="button"><br><input type="submit" name="painikel" value="+ Lisää vastauskenttä yläpuolelle" class="myButton8"  role="button"></th></tr></thead><tbody>';
            } else {
                echo '<tr style="border: 1px solid grey; background-color: #48E5DA"><th style="border-right: 1px solid grey;"></th><th style="border-right: 1px solid grey; text-align: center;">Sisältö</th><th>Pakollinen</th><th></th></tr></thead><tbody>';
            }

            while ($rowt = $haetehtavat->fetch_assoc()) {
                $rowt[sisalto] = str_replace('<br />', "", $rowt[sisalto]);
                $rowt[otsikko] = str_replace('<br />', "", $rowt[otsikko]);
                $info = $rowt[info];

                if ($rowt[aihe] == 1) {
                    $paluu = $rowt[jarjestys];

                    if ($_GET[vikao] == 1) {
                        if (($_GET[monesko] == ($paluu)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                            echo '<tr  class="iaihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><textarea name="otsikko[]" rows="3"   autofocus>' . $rowt[otsikko] . '</textarea>';
                        } else {
                            echo '<tr  class="iaihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><b><textarea name="otsikko[]" rows="3"  >' . $rowt[otsikko] . '</textarea>';
                        }
                    } else {
                        if (($_GET[monesko] == ($paluu - 1)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                            echo '<tr  class="iaihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><textarea name="otsikko[]" rows="3"   autofocus>' . $rowt[otsikko] . '</textarea>';
                        } else {
                            echo '<tr  class="iaihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><textarea name="otsikko[]" rows="3"  >' . $rowt[otsikko] . '</textarea>';
                        }
                    }

                    echo '</td><td></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                    echo'<input type="hidden" id="' . $paluu . '" name="id[]" value=' . $rowt[id] . '>';
                    echo'<input type="hidden" name="sisalto[]" value=' . $rowt[sisalto] . '>';
                } else if ($rowt[valiaihe] == 1) {
                    $paluu = $rowt[jarjestys];

                    if ($_GET[vikao] == 1) {
                        if (($_GET[monesko] == ($paluu)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                            echo '<tr  class="ivaliaihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><textarea name="otsikko[]" rows="3"  autofocus>' . $rowt[otsikko] . '</textarea>';
                        } else {
                            echo '<tr  class="ivaliaihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><b><textarea name="otsikko[]" rows="3" >' . $rowt[otsikko] . '</textarea>';
                        }
                    } else {
                        if (($_GET[monesko] == ($paluu - 1)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                            echo '<tr  class="ivaliaihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><textarea name="otsikko[]" rows="3"  autofocus>' . $rowt[otsikko] . '</textarea>';
                        } else {
                            echo '<tr  class="ivaliaihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><textarea name="otsikko[]" rows="3" >' . $rowt[otsikko] . '</textarea>';
                        }
                    }




                    echo '</td><td></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                    echo'<input type="hidden" id="' . $paluu . '" name="id[]" value=' . $rowt[id] . '>';
                    echo'<input type="hidden" name="sisalto[]" value=' . $rowt[sisalto] . '>';
                } else {
                    $paluu = $rowt[jarjestys];

                    if ($rowt[pakollinen] == 0) {
                        if ($_GET[vikao] == 1) {
                            if (($_GET[monesko] == ($paluu)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                                echo '<tr class="isisalto"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . '></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            } else {
                                echo '<tr class="isisalto"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . '></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            }
                        } else {
                            if (($_GET[monesko] == ($paluu - 1)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                                echo '<tr class="isisalto"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . '></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            } else {
                                echo '<tr class="isisalto"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . '></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            }
                        }
                    } else {
                        if ($_GET[vikao] == 1) {
                            if (($_GET[monesko] == ($paluu)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                                echo '<tr class="isisalto"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            } else {
                                echo '<tr class="isisalto"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            }
                        } else {
                            if (($_GET[monesko] == ($paluu - 1)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                                echo '<tr class="isisalto"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            } else {
                                echo '<tr class="isisalto"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            }
                        }
                    }



                    echo'<input type="hidden" id="' . $paluu . '" name="id[]" value=' . $rowt[id] . '>';
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
        } else {
            if ($onko != 0) {
                echo '<tr style="border: 1px solid grey; background-color: #48E5DA"><th style="border-right: 1px solid grey; "><button class="roskis" title="Poista" style="font-size: 0.8em; margin-left: 0px" name="painikep"><i class="fa fa-trash-o" style="display: inline-block; margin-right: 10px"></i>Poista</button><br><br><a href="uusikysely.php?kaikki=joo&monesko=' . $_GET[monesko] . '#cm"  style="font-size: 0.9em"> Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th style="border-right: 1px solid grey; text-align: center; "><input type="submit" id="tanne" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="font-size: 0.9em; padding:4px 6px;"><br><br>Sisältö</th><th>Pakollinen</th><th><input type="submit" name="painikelo" value="+ Lisää kysymys yläpuolelle" class="myButton8"  role="button" ><br><input type="submit" name="painikel" value="+ Lisää vastauskenttä yläpuolelle" class="myButton8"  role="button"></th></tr></thead><tbody>';
            } else {
                echo '<tr style="border: 1px solid grey; background-color: #48E5DA"><th style="border-right: 1px solid grey; "></th><th style="border-right: 1px solid grey; text-align: center; ">Sisältö</th><th>Pakollinen</th><th style="text-align: center;"></th></tr></thead><tbody>';
            }

            while ($rowt = $haetehtavat->fetch_assoc()) {
                $rowt[sisalto] = str_replace('<br />', "", $rowt[sisalto]);
                $rowt[otsikko] = str_replace('<br />', "", $rowt[otsikko]);
                $info = $rowt[info];


                if ($rowt[valiaihe] == 1) {
                    $paluu = $rowt[jarjestys];

                    if ($_GET[vikao] == 1) {
                        if (($_GET[monesko] == ($paluu)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                            echo '<tr id="' . $paluu . '" class="ivaliaihe"><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="otsikko[]" rows="3"  autofocus>' . $rowt[otsikko] . '</textarea>';
                        } else {
                            echo '<tr id="' . $paluu . '" class="ivaliaihe"><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="otsikko[]" rows="3" >' . $rowt[otsikko] . '</textarea>';
                        }
                    } else {
                        if (($_GET[monesko] == ($paluu - 1)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                            echo '<tr id="' . $paluu . '" class="ivaliaihe"><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="otsikko[]" rows="3"  autofocus>' . $rowt[otsikko] . '</textarea>';
                        } else {
                            echo '<tr id="' . $paluu . '" class="ivaliaihe"><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="otsikko[]" rows="5" >' . $rowt[otsikko] . '</textarea>';
                        }
                    }


                    echo '</td><td></td><td style="text-align: center;"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';


                    echo'<input type="hidden" name="id[]" value=' . $rowt[id] . '>';
                    echo'<input type="hidden" name="sisalto[]" value=' . $rowt[sisalto] . '>';
                } else if ($rowt[aihe] == 1) {
                    $paluu = $rowt[jarjestys];

                    if ($_GET[vikao] == 1) {
                        if (($_GET[monesko] == ($paluu)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                            echo '<tr id="' . $paluu . '" class="iaihe"><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="otsikko[]" rows="3"  autofocus>' . $rowt[otsikko] . '</textarea>';
                        } else {
                            echo '<tr id="' . $paluu . '" class="iaihe"><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="otsikko[]" rows="3"  >' . $rowt[otsikko] . '</textarea>';
                        }
                    } else {
                        if (($_GET[monesko] == ($paluu - 1)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                            echo '<tr id="' . $paluu . '" class="iaihe"><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="otsikko[]" rows="3"   autofocus>' . $rowt[otsikko] . '</textarea>';
                        } else {
                            echo '<tr id="' . $paluu . '" class="iaihe"><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="otsikko[]" rows="3"  >' . $rowt[otsikko] . '</textarea>';
                        }
                    }


                    echo '</td><td></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';

                    echo'<input type="hidden" name="id[]" value=' . $rowt[id] . '>';
                    echo'<input type="hidden" name="sisalto[]" value=' . $rowt[sisalto] . '>';
                } else {
                    $paluu = $rowt[jarjestys];

                    if ($rowt[pakollinen] == 0) {
                        if ($_GET[vikat] == 1) {
                            if (($_GET[monesko] == ($paluu)) && ($rowt[sisalto] == "")) {
                                echo '<tr id="' . $paluu . '" class="isisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . '></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            } else {
                                echo '<tr id="' . $paluu . '" class="isisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . '></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            }
                        } else {
                            if (($_GET[monesko] == ($paluu - 1)) && ($rowt[sisalto] == "")) {
                                echo '<tr id="' . $paluu . '" class="isisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . '></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            } else {
                                echo '<tr id="' . $paluu . '" class="isisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . '></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            }
                        }
                    } else {
                        if ($_GET[vikat] == 1) {
                            if (($_GET[monesko] == ($paluu)) && ($rowt[sisalto] == "")) {
                                echo '<tr id="' . $paluu . '" class="isisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            } else {
                                echo '<tr id="' . $paluu . '" class="isisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            }
                        } else {
                            if (($_GET[monesko] == ($paluu - 1)) && ($rowt[sisalto] == "")) {
                                echo '<tr id="' . $paluu . '" class="isisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            } else {
                                echo '<tr id="' . $paluu . '" class="isisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td class="sisaltoselitys">' . $rowt[sisalto] . '</td><td><input type="checkbox" name="pakollinen[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            }
                        }
                    }





                    echo'<input type="hidden" name="id[]" value=' . $rowt[id] . '>';
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
        }
        if ($onko != 0) {
            echo '<tr style="border-bottom: none"><td><button class="pieniroskis" title="Poista" name="painikep"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td><td><input type="submit" id="tanne" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="font-size: 0.9em; padding:4px 6px; margin-bottom: 20px;"></td><td><input type="hidden" name="ipid" value=' . $ipid . '> ';
            echo'<input type="submit" name="painikelo" value="+ Lisää kysymys yläpuolelle" class="myButton8"  role="button" ><br><input type="submit" name="painikel" value="+ Lisää vastauskenttä yläpuolelle" class="myButton8"  role="button"></td></tr>';
        } else {
            echo '<tr style="border-bottom: none"><td></td><td></td><td><input type="hidden" name="ipid" value=' . $ipid . '><input type="submit" name="painikelo" value="+ Lisää kysymys" class="myButton8"  role="button"><br><input type="submit" name="painikel" value="+ Lisää vastauskenttä" class="myButton8"  role="button"></td></tr>';
        }
        echo "</tbody></table></div>";
        echo'<input type="hidden" name="monesko" value=' . $_GET[monesko] . '>';
        echo'<input type="hidden" name="ipid" value=' . $ipid . '>';
        echo'<input type="hidden" name="info" value="' . $info . '">';
        echo'<div style="text-align: center">';
        echo'<br>';
        echo'</div>';
        echo'</form>';

        echo' <div class="cm8-margin-top" id="cm"></div>';









        echo'</div>





</div>';
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
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