<?php
session_start();

echo'<input type="checkbox" onclick="return false;">';

// ei pisteitä
if ($rowkp[tallennettu] == 1) {


    if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
        echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
    } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

        echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
    } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
        echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
    } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

        echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
    } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] <> '') {

        echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
    } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

        echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
    }
} else {
    if ($rowt[id] == $_GET[minne]) {

        if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
            echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
        } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
        } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
        } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
        } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
        } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0) {
            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
        }
    } else {
        if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
            echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
        } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
        } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey">>' . $rowkp[kommentti] . '</td></tr>';
            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
        } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
        } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
        } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0) {
            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
        }
    }
}



if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey">' . $rowkp[kommentti] . '</td></tr>';
    echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" id="id" value=' . $rowkp[id] . '>';
}