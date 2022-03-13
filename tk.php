<?php
session_start();

include("yhteys.php");

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$results_per_page = 20;
$start_from = ($page-1) * $results_per_page;


   if (!$result10 = $db->query("select distinct paiva, kello, kayttajat.id as kaid, etunimi, sukunimi, rooli, sposti, Nimi from kayttajat, kayttajankoulut, koulut where kayttajankoulut.odottaa=1 AND  kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id AND kayttajat.tarkistettu=1 AND kayttajat.vahvistettu=1 ORDER BY sukunimi LIMIT $start_from, $results_per_page")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

echo'määrä on: '.$result10 -> num_rows;
?> 
<table border="1" cellpadding="4">
<tr>
  
    <td bgcolor="#CCCCCC"><strong>Sukunimi</strong></td><td bgcolor="#CCCCCC"><strong>Etunimi</strong></td></tr>
<?php
session_start(); 
 while($row = $result10->fetch_assoc()) {
?> 
            <tr>
            <td><? echo $row["sukunimi"]; ?></td>
            <td><? echo $row["etunimi"]; ?></td>
            </tr>
<?php
session_start(); 
}; 
?> 
</table>
<?php
session_start(); 
  if (!$result = $db->query("select distinct paiva, kello, kayttajat.id as kaid, etunimi, sukunimi, rooli, sposti, Nimi from kayttajat, kayttajankoulut, koulut where kayttajankoulut.odottaa=1 AND  kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id AND kayttajat.tarkistettu=1 AND kayttajat.vahvistettu=1 ORDER BY sukunimi")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
$yht = $result->num_rows;
$total_pages = ceil($yht / $results_per_page); // calculate total pages with results
  
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
            echo "<a href='index.php?page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a> "; 
}; 
?>