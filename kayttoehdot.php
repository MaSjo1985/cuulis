<?php
session_start(); 


ob_start();
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title>Käyttöehdot</title>
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
include("header.php");

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

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour
// ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    echo'<div class="cm8-container" style="padding-top: 0px; padding-bottom: 0px;"> ';

    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');

    $url2 = $_SERVER[REQUEST_URI];

    $url2 = substr($url2, 1);


    echo'<div class="cm8-half" style="padding-bottom: 0px;padding-top: 0px; padding-left: 0px; margin-left: 0px">';
    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'opiskelija') {


        if ($_SESSION["Rooli"] == 'opiskelija' && $_SESSION["vaihto"] == 1) {


            echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a>
</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';


            echo'<form action="vaihda.php" method="post" style="display: inline-block; margin-left: 40px"><input type="hidden" name="url" value="' . $url . '" ><input type="hidden" name="mihin" value="etu"><input type="hidden" name="'
            . '" value="pois"> <input type="submit" value="Poistu opiskelijanäkymästä" class="munNappula2"  role="button"></form>';
        } else {

            echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a>
 </a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';
        }
    } else if ($_SESSION["Rooli"] == 'opeadmin' || $_SESSION["Rooli"] == 'admink') {
        echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a>
 </a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';
    } else {
        echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a>
  	
 </a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i></a></p>';
    }
    echo'</div><div class="cm8-half" style="padding-top: 0px;padding-left: 0px; margin-left: 0px">';
    echo'<p style="display: inline-block; margin-right: 20px; padding-top: 10px; margin-top: 0px; margin-bottom: 0px" ><select id="example">
  <option style="display: inline-block" value="1">1</option>
  <option style="display: inline-block" value="2">2</option>
  <option style="display: inline-block" value="3">3</option>
  <option style="display: inline-block" value="4">4</option>
  <option style="display: inline-block" value="5">5</option>
</select></p>';


    echo'<div style="display: inline-block; font-size: 0.8em; padding: 0px; margin: 0px" id="keski" ></div>';
    echo'</div></div>';
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


    ob_start();
    echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px;">';

    if ($_SESSION["Rooli"] == 'admin')
        include("adminnavi.php");
    else if ($_SESSION["Rooli"] == 'admink')
        include("adminknavi.php");
    else if ($_SESSION["Rooli"] == 'opeadmin')
        include("opeadminnavi.php");
    else if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "opiskelija" || $_SESSION["Rooli"] == "muu")
        include ("opnavi.php");
}



echo'<div class="cm8-container3">';




echo'<h7>Tietoa <b style="font-size: 1.2em"> Cuulis </b>- oppimisympäristöstä</h7>';
echo'<a href="etusivu.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Etusivulle</a><br><br><br>';





if (!$haeadmin = $db->query("select distinct * from kayttajat where rooli='admin'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
while ($rowP = $haeadmin->fetch_assoc()) {

    $id = $rowP[id];
}
header("location: käyttöehdot.pdf");


//$file = fopen("tietoa.txt", "r");

/* function file_get_contents_utf8($file) { 
  $content = file_get_contents($fn);
  return mb_convert_encoding($content, 'UTF-8',
  mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
  }
  $file=file_get_contents_utf8($file);

 */
//while (!feof($file)) {
//    echo fgets($file) . "<br />";
//}
//
//fclose($file);







/* echo' <object data="testi.docx" type="text" width="100%" heigth="100%">
  alt : <a href="testi.docx">testi.docx</a>
  </object>'; */

/*  function read_file_docx($filename){

  $striped_content = '';
  $content = '';
  if(!$filename || !file_exists($filename)) return false;

  $zip = zip_open($filename);

  if (!$zip || is_numeric($zip)) return false;


  while ($zip_entry = zip_read($zip)) {

  if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

  if (zip_entry_name($zip_entry) != "word/document.xml") continue;

  $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

  zip_entry_close($zip_entry);
  }// end while

  zip_close($zip);

  /*  echo $content; */
/*         echo "<hr>";
  file_put_contents('1.xml', $content);

  $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
  $content = str_replace('</w:r></w:p>', "\r\n", $content);
  $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
  $content = str_replace('</w:r></w:p>', "\r\n", $content);
  $striped_content = strip_tags($content);

  return $striped_content;
  }



  $filename = "testi.docx";

  $content = read_file_docx($filename);

  if($content !== false) {

  echo nl2br($content);
  }
  else {
  echo 'Couldn\'t find the file. Please check that file.';
  }
 */


echo'<br><br><p style="font-weight: bold; "><em>Lisätietoja antaa Cuulis-oppimisympäristön kehittäjä ja ylläpitäjä<a href="admininfo.php" class="cm8-linkki" style="color: #2b6777; font-weight: bold; text-decoration: underline"> <u>Marianne Sjöberg</u></em></a></p>';



echo "</div>";
echo "</div>";
echo "</div>";

include("footer.php");
?>
</body>
</html>	