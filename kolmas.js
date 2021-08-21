function loadProgress3() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('myprogress2').innerHTML = xmlhttp.responseText;
        }


    }


    xmlhttp.open('GET', 'prog.php', true);
    xmlhttp.send();

}



