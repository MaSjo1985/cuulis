<?php
session_start(); 

 // ob_start();


echo'<div id="content"  style="padding-left: 20px; margin-right: 0px; margin-top: 40px; margin-bottom: 0px; padding-bottom: 10px">';
  

        echo '<form action="tktesti.php" class="form-style-k" method="POST" enctype="multipart/form-data"><fieldset style="width: 80%">';
        echo'<legend>1&nbsp&nbsp Lisää tiedosto SUN omalta laitteeltaeee &nbsp&nbsp </legend>
       
	

<p style="color: #e608b8; font-size: 1em" class="eimitaan"><b>Huom! </b><b style="font-weight: normal">Tiedoston maksimikoko on 20,0MB.<br>Sallitut tiedostomuodot: .pdf,  .tnsp, .tns, .docx, .ods, .odt, .odp, .odg, .csv, .zip, .rar, .doc, .dat, .ppt, .txt tai .rtf, .ppt, .pptx, .xls, .xlsx	</b></p>

			<br><input type="file" name="my_file[]" style="font-size: 0.9em" multiple="" >
 	
		<br><br><br><input type="submit" value="&#10003 Tallenna" class="myButton9">
	</fieldset></form>';

    
    echo'</div>';