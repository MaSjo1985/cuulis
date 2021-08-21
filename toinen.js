function loadProgress2() {


    $("#myprogress2").progressbar({
        value: false
    });




}



function loadProgress()
{

    var div = document.getElementById("progdivi");


    div.style.paddingTop = "20px";
    loadProgress2();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('myprogress').innerHTML = xmlhttp.responseText;
        }


    }


    xmlhttp.open('GET', 'progress.php', true);
    xmlhttp.send();


}




function loadProgress3()
{


    document.getElementById('myprogress3').innerHTML = '<p style="font-size:1.2em; color: white; font-weight: bold; text-align: center "><em>Haetaan tietoja...</em></p>';



}
