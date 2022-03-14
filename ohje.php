<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Ohje </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");

    echo'<div class="cm8-container7">';

    if ($_SESSION["Rooli"] == "admin")
        include ("adminnavi.php");
    else if ($_SESSION["Rooli"] == "admink")
        include ("adminknavi.php");
    else
        include ("opnavi.php");
    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
    echo'<h4>Ohje</h4>';
    echo'<a href="etusivu.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa etusivulle</a><br><br><br><br>';

    $file = fopen("ohje.txt", "r");

    /* function file_get_contents_utf8($file) { 
      $content = file_get_contents($fn);
      return mb_convert_encoding($content, 'UTF-8',
      mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
      }
      $file=file_get_contents_utf8($file);

     */
    while (!feof($file)) {
        echo fgets($file) . "<br />";
    }

    fclose($file);







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
    echo "</div>";
    echo "</div>";

    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>
</body>
</html>	