function poista(src) {

    $.ajax({
        type: "POST",
        url: "delete.php",
        data: {
            src: src
        }
    }).done(function () {

    });
}


function avaaOhje() {

    $('#avaa8').hide();
    $('#sulje8').show();
}
function suljeOhje() {

    $('#avaa8').show();
    $('#sulje8').hide();
}

function haetehtavat() {

    $.ajax({
        type: "POST",
        url: "lataatehtavat.php",
        success: function (data) {


        }

    });
}

function Varoitus(msg, myYes) {
    var confirmBox = $(".divi");
    confirmBox.find(".message").text('Huom! Jos muutat tietoja, niin ryhmäjako tehdään uudestaan!');
    confirmBox.find(".yes").unbind().click(function () {
        confirmBox.hide();
    });
    confirmBox.find(".yes").click(myYes);
    confirmBox.show();
}

function functionAlert(msg, myYes) {

    var confirmBox = $("#confirm");
    confirmBox.find(".message").text(msg);
    confirmBox.find(".yes").unbind().click(function () {
        confirmBox.hide();
    });
    confirmBox.find(".yes").click(myYes);
    confirmBox.show();
}

function tarkistaLinkki(pid, msg, myYes) {

    $.ajax({
        type: 'post',
        url: 'tarkistalinkki.php',
        data: {pid: pid},
        dataType: 'json',
        success: function (data) {


            if (data.status == "success") {

                window.location.href = "avaakaikki.php?id=" + pid;
            } else {

                if (data.viesti == "linkki" && data.lataa == "lataa") {

                    var confirmBox = $(".divi");
                    confirmBox.find(".message").text(data.teksti);
                    confirmBox.find(".yes").unbind().click(function () {
                        confirmBox.hide();
                    });
                    confirmBox.find(".yes").click(myYes);
                    confirmBox.show();
                    window.location.href = "avaakaikki.php?id=" + pid;
                } else {
                    var confirmBox = $(".divi");
                    confirmBox.find(".message").text(data.teksti);
                    confirmBox.find(".yes").unbind().click(function () {
                        confirmBox.hide();
                    });
                    confirmBox.find(".yes").click(myYes);
                    confirmBox.show();
                }

            }
        }
    });
}


function koulusafka() {



    $.ajax({
        type: "POST",
        url: "lisaaklikkaus.php",
        success: function (data) {


        }

    });
}

function check(e, f) {

    document.getElementById("peite").style.visibility = "hidden";
    if (document.getElementById('pisteytys').value == 1) {

        if (document.getElementById('itsepisteytys').value == 0) {
            var fuusi = $(e).parent().prev().prev().attr('id');
        } else {
            var fuusi = $(e).parent().prev().prev().prev().attr('id');
        }

    } else {
        var fuusi = $(e).parent().prev().attr('id');
    }


    if (document.getElementById('itsepisteytys').value == 0) {

// Muokkaa painetun napin td:n taustan vihreäksi
        $(e).parent().next().next().next().next().text('');
        $(e).parent().css({
            backgroundColor: 'rgb(127, 216, 88)'
        });
        // Muokkaa painettua nappia edeltävän td:n taustan vihreäksi
        $(e).parent().prev().css({
            backgroundColor: 'rgb(127, 216, 88)'
        });
        // Muokkaa tehtävän numeron taustan värin vihreäksi
        $(e).parent().prev().prev().css({
            backgroundColor: 'rgb(127, 216, 88)'
        });
        // Muokkaa painetun napin jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
        $(e).parent().next().css({
            backgroundColor: 'rgb(127, 216, 88)'
        }).text('');
        // Muokkaa painetun napin jälkeisen td:n jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
        $(e).parent().next().next().css({
            backgroundColor: 'rgb(127, 216, 88)'
        });
        // Lisää kommentinmuokkausnapin
        $(e).parent().next().next().next().after('<td style="background-color: #e5e5e5"><a onclick="korjaa(this, ' + fuusi + ')" title="Korjaa"  role="button" style="padding:2px 4px; margin: 0px">Korjaa</a></td>');
        // Poistaa kommenttikentän
// $(e).parent().next().next().next().text('');
// var b = document.getElementById('kom'+f).value;
        $(e).parent().next().next().next().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
//var kommentti = b;

        // Lisää check-merkin
        $(e).parent().text('✔');
//var lista = $('.lista1:checked').val();

        var lista = f;
        var ipid = $('#ipid').val();
//        data: {kommentti: kommentti, lista: lista, ipid: ipid},
        $.ajax({
            type: "POST",
            url: "tallennatehtavat_testi.php",
            data: {lista: lista, ipid: ipid},
            success: function (data) {

                $('#peite.cm8-responsive').replaceWith(data);
            }

        });
    } else {
        var a = document.getElementById('id' + f).value;
        var max = document.getElementById('paino' + f).value;
        var erotus = a - max;
        if (erotus > 0) {
            alert('Oma pisteytys pitää olla väliltä 0-' + max);
        } else {
//TÄHÄN JOS ITSEPISTEYTYS
// Muokkaa painetun napin td:n taustan vihreäksi
            $(e).parent().next().next().next().next().text('');
            $(e).parent().css({
                backgroundColor: 'rgb(127, 216, 88)'
            });
            // Muokkaa painettua nappia edeltävän td:n taustan vihreäksi
            $(e).parent().prev().css({
                backgroundColor: 'rgb(127, 216, 88)'
            });
            // Muokkaa tehtävän numeron taustan värin vihreäksi
            $(e).parent().prev().prev().css({
                backgroundColor: 'rgb(127, 216, 88)'
            });
            $(e).parent().prev().prev().prev().css({
                backgroundColor: 'rgb(127, 216, 88)'
            });
            // Muokkaa painetun napin jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
            $(e).parent().next().css({
                backgroundColor: 'rgb(127, 216, 88)'
            }).text('');
            // Muokkaa painetun napin jälkeisen td:n jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
            $(e).parent().next().next().css({
                backgroundColor: 'rgb(127, 216, 88)'
            });
            // Lisää kommentinmuokkausnapin
            $(e).parent().next().next().next().after('<td style="background-color: #e5e5e5"><a onclick="korjaa(this, ' + fuusi + ')" title="Korjaa" role="button" style="padding:2px 4px; margin: 0px">Korjaa</a></td>');
            $(e).parent().prev().text(a);
// 
//  var b = document.getElementById('kom'+f).value;
            $(e).parent().next().next().next().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
//var kommentti = b;

            // Poistaa kommenttikentän
//                $(e).parent().next().next().next().text('');


            // Lisää check-merkin
            $(e).parent().text('✔');
//var lista = $('.lista1:checked').val();

            var lista = f;
            var omat = a;
            var ipid = $('#ipid').val();
// data: {omat: omat, lista: lista, ipid: ipid, kommentti: kommentti},
            $.ajax({
                type: "POST",
                url: "tallennatehtavat_testi.php",
                data: {omat: omat, lista: lista, ipid: ipid},
                success: function (data) {

                    $('#peite.cm8-responsive').replaceWith(data);
                }

            });
        }



    }


    document.getElementById("peite").style.visibility = "visible";
}
function check2(e, f) {
    if (document.getElementById('pisteytys').value == 1) {

        if (document.getElementById('itsepisteytys').value == 0) {
            var fuusi = $(e).parent().prev().prev().prev().attr('id');
        } else {
            var fuusi = $(e).parent().prev().prev().prev().prev().attr('id');
        }

    } else {
        var fuusi = $(e).parent().prev().prev().attr('id');
    }
    if (document.getElementById('itsepisteytys').value == 0) {
        $(e).parent().css({
            backgroundColor: 'rgb(0, 191, 255)'
        });
        $(e).parent().next().next().next().text('');
        // Muokkaa painettua nappia edeltävän td:n taustan vihreäksi
        $(e).parent().prev().css({
            backgroundColor: 'rgb(0, 191, 255)'
        });
        // Muokkaa tehtävän numeron taustan värin vihreäksi
        $(e).parent().prev().prev().css({
            backgroundColor: 'rgb(0, 191, 255)'
        });
        $(e).parent().prev().prev().prev().css({
            backgroundColor: 'rgb(0, 191, 255)'
        });
        // Muokkaa painetun napin jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
        $(e).parent().prev().css({
            backgroundColor: 'rgb(0, 191, 255)'
        }).text('');
        // Muokkaa painetun napin jälkeisen td:n jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
        $(e).parent().next().css({
            backgroundColor: 'rgb(0, 191, 255)'
        });
        // Lisää kommentinmuokkausnapin

        $(e).parent().next().next().after('<td style="background-color: #e5e5e5"><a onclick="korjaa(this, ' + fuusi + ')" title="Korjaa" role="button" style="padding:2px 4px; margin: 0px">Korjaa</a></td>');
        // Poistaa kommenttikentän
//                $(e).parent().next().next().text('');
// var b = document.getElementById('kom'+f).value;
        $(e).parent().next().next().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
//var kommentti = b;

        // Lisää check-merkin
        $(e).parent().text('✔');
//var lista = $('.lista1:checked').val();

        var lista = f;
        var ipid = $('#ipid').val();
//   data: {kommentti: kommentti, lista: lista, ipid: ipid},
        $.ajax({
            type: "POST",
            url: "tallennatehtavat_testi2.php",
            data: {lista: lista, ipid: ipid},
            success: function (data) {

                $('#peite.cm8-responsive').replaceWith(data);
            }

        });
    } else {
        var a = document.getElementById('id' + f).value;
        var max = document.getElementById('paino' + f).value;
        var erotus = a - max;
        if (erotus > 0) {
            alert('Oma pisteytys pitää olla väliltä 0-' + max);
        } else {



//ITSEPISTEYTYS
            $(e).parent().css({
                backgroundColor: 'rgb(0, 191, 255)'
            });
            $(e).parent().next().next().next().text('');
            // Muokkaa painettua nappia edeltävän td:n taustan vihreäksi
            $(e).parent().prev().css({
                backgroundColor: 'rgb(0, 191, 255)'
            });
            // Muokkaa tehtävän numeron taustan värin vihreäksi
            $(e).parent().prev().prev().css({
                backgroundColor: 'rgb(0, 191, 255)'
            });
            $(e).parent().prev().prev().prev().css({
                backgroundColor: 'rgb(0, 191, 255)'
            });
            $(e).parent().prev().prev().prev().prev().css({
                backgroundColor: 'rgb(0, 191, 255)'
            });
            // Muokkaa painetun napin jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
            $(e).parent().prev().css({
                backgroundColor: 'rgb(0, 191, 255)'
            }).text('');
            // Muokkaa painetun napin jälkeisen td:n jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
            $(e).parent().next().css({
                backgroundColor: 'rgb(0, 191, 255)'
            });
            //Läpikäyntivalinta
            $(e).parent().next().html('<input type="checkbox" onclick="check3(this, ' + f + ')" name="lista3[]" id="lista1" value="' + f + '">');
            // Lisää kommentinmuokkausnapin
            $(e).parent().next().next().after('<td style="background-color: #e5e5e5"><a onclick="korjaa(this, ' + fuusi + ')" title="Korjaa" role="button" style="padding:2px 4px; margin: 0px">Korjaa</a></td>');
            // Poistaa kommenttikentän
//                $(e).parent().next().next().text('');

            $(e).parent().prev().prev().text(a);
            // Lisää check-merkin
            $(e).parent().text('✔');
// var b = document.getElementById('kom'+f).value;
            $(e).parent().next().next().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
//var kommentti = b;

//var lista = $('.lista1:checked').val();

            var lista = f;
            var omat = a;
            var ipid = $('#ipid').val();
//    data: {kommentti: kommentti, omat: omat, lista: lista, ipid: ipid},
            $.ajax({
                type: "POST",
                url: "tallennatehtavat_testi2.php",
                data: {omat: omat, lista: lista, ipid: ipid},
                success: function (data) {

                    $('#peite.cm8-responsive').replaceWith(data);
                }

            });
        }

    }

}

function check3(e, f) {
    if (document.getElementById('pisteytys').value == 1) {

        if (document.getElementById('itsepisteytys').value == 0) {
            var fuusi = $(e).parent().prev().prev().prev().prev().attr('id');
        } else {
            var fuusi = $(e).parent().prev().prev().prev().prev().prev().attr('id');
        }

    } else {
        var fuusi = $(e).parent().prev().prev().prev().attr('id');
    }
    if (document.getElementById('itsepisteytys').value == 0) {
        $(e).parent().css({
            fontSize: '1.5em'
        });
//                
        // Poistaa kommenttikentän
        $(e).parent().next().next().text('');
        // Lisää kommentinmuokkausnapin
        $(e).parent().next().after('<td style="background-color: #e5e5e5"><a onclick="korjaa(this, ' + fuusi + ')" title="Korjaa" role="button" style="padding:2px 4px; margin: 0px">Korjaa</a></td>');
// var b = document.getElementById('kom'+f).value;
        $(e).parent().next().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
//var kommentti = b;



        // Lisää check-merkin
        $(e).parent().text('☝');
//var lista = $('.lista1:checked').val();

        var lista = f;
        var ipid = $('#ipid').val();
//    data: {kommentti: kommentti, lista: lista, ipid: ipid},
        $.ajax({
            type: "POST",
            url: "tallennatehtavat_testi3.php",
            data: {lista: lista, ipid: ipid},
            success: function (data) {

                $('#peite.cm8-responsive').replaceWith(data);
            }

        });
    } else {
//ITSEPISTEYTYS

        $(e).parent().css({
            fontSize: '1.5em'
        });
//                
        // Poistaa kommenttikentän
        $(e).parent().next().next().text('');
        // Lisää kommentinmuokkausnapin
        $(e).parent().next().after('<td style="background-color: #e5e5e5"><a onclick="korjaa(this, ' + fuusi + ')" title="Korjaa"  role="button" style="padding:2px 4px; margin: 0px">Korjaa</a></td>');
//
// var b = document.getElementById('kom'+f).value;
        $(e).parent().next().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
//var kommentti = b;

        // Lisää check-merkin<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
        $(e).parent().text('☝');
//var lista = $('.lista1:checked').val();

        var lista = f;
        var ipid = $('#ipid').val();
// data: {kommentti: kommentti, lista: lista, ipid: ipid},
        $.ajax({
            type: "POST",
            url: "tallennatehtavat_testi3.php",
            data: {lista: lista, ipid: ipid},
            success: function (data) {

                $('#peite.cm8-responsive').replaceWith(data);
            }

        });
    }


}
function korjaa(e, f) {
    if (document.getElementById('itsepisteytys').value == 0) {

        var lista = f;
        var ipid = $('#ipid').val();
        // Poistaa nappulan

        $(e).parent().prev().prev().prev().prev().html('<input type="checkbox" onclick="check(this, ' + f + ')" name="lista[]" id="lista1" class="lista1" value="' + f + '">');
        $(e).parent().prev().prev().prev().html('<input type="checkbox" onclick="check2(this, ' + f + ')" name="lista2[]" id="lista2" class="lista2" value="' + f + '">');
        $(e).parent().prev().prev().html('<input type="checkbox" onclick="check3(this, ' + f + ')" name="lista3[]" id="lista3" class="lista3" value="' + f + '">');
//              
        $(e).parent().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
        $(e).parent().html('<td style="border: 1px solid transparent; "><input type="hidden" name="id[]" value="' + f + '"></td>');
        $.ajax({
            type: "POST",
            url: "korjaatehtava_testi.php",
            data: {lista: lista, ipid: ipid},
            success: function (data) {

                $('#peite.cm8-responsive').replaceWith(data);
//       location.href = "http://www.example.com/ThankYou.html";
            }






        });
    } else {

//ITSEPISTEYTYS

        var lista = f;
        var ipid = $('#ipid').val();
        // Poistaa nappulan
        $(e).parent().prev().prev().prev().prev().html('<input type="checkbox" onclick="check(this, ' + f + ')" name="lista[]" id="lista1" class="lista1"  value="' + f + '">');
        $(e).parent().prev().prev().prev().html('<input type="checkbox" onclick="check2(this, ' + f + ')" name="lista2[]" id="lista2" class="lista2"  value="' + f + '">');
        $(e).parent().prev().prev().html('<input type="checkbox" onclick="check3(this, ' + f + ')" name="lista3[]" id="lista3" class="lista3"  value="' + f + '">');
//              
        $(e).parent().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
        var max = document.getElementById('paino' + f).value;
        $(e).parent().prev().prev().prev().prev().prev().html('<input  type="number" name="omatpisteet[]" id="id' + f + '" class="omat" value="0" min="0" max="' + max + '">');
        $(e).parent().html('<td style="border: 1px solid transparent; "><input type="hidden" name="id[]" value="' + f + '"></td>');
        $.ajax({
            type: "POST",
            url: "korjaatehtava_testi.php",
            data: {lista: lista, ipid: ipid},
            success: function (data) {

                $('#peite.cm8-responsive').replaceWith(data);
//       location.href = "http://www.example.com/ThankYou.html";
            }






        });
    }


}

function checkope(e, f, g, h) {
    if (document.getElementById('pisteytys').value == 1) {

        if (document.getElementById('itsepisteytys').value == 0) {
            var fuusi = $(e).parent().prev().prev().attr('id');
        } else {
            var fuusi = $(e).parent().prev().prev().prev().attr('id');
        }

    } else {
        var fuusi = $(e).parent().prev().attr('id');
    }
// Muokkaa painetun napin td:n taustan vihreäksi
    if (document.getElementById('itsepisteytys').value == 0) {
        var lista = f;
        var ipid = h;
        var opid = g;
        $(e).parent().next().next().next().next().text('');
        $(e).parent().css({
            backgroundColor: 'rgb(127, 216, 88)'
        });
        // Muokkaa painettua nappia edeltävän td:n taustan vihreäksi
        $(e).parent().prev().css({
            backgroundColor: 'rgb(127, 216, 88)'
        });
        // Muokkaa tehtävän numeron taustan värin vihreäksi
        $(e).parent().prev().prev().css({
            backgroundColor: 'rgb(127, 216, 88)'
        });
        // Muokkaa painetun napin jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
        $(e).parent().next().css({
            backgroundColor: 'rgb(127, 216, 88)'
        }).text('');
        // Muokkaa painetun napin jälkeisen td:n jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
        $(e).parent().next().next().css({
            backgroundColor: 'rgb(127, 216, 88)'
        });
        // Lisää kommentinmuokkausnapin
        $(e).parent().next().next().next().after('<td style="background-color: #e5e5e5"><a onclick="korjaaope(this, ' + fuusi + ', ' + opid + ', ' + h + ')" title="Korjaa"  role="button" style="padding:2px 4px; margin: 0px">Korjaa</a></td>');
        // Poistaa kommenttikentän
//                $(e).parent().next().next().next().text('');
//  var b = document.getElementById('kom'+f).value;
        $(e).parent().next().next().next().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
//var kommentti = b;


        // Lisää check-merkin
        $(e).parent().text('✔');
//var lista = $('.lista1:checked').val();

//    data: {kommentti: kommentti, lista: lista, ipid: ipid, opid: opid},

        $.ajax({
            type: "POST",
            url: "tallennatehtavat_ope.php",
            data: {lista: lista, ipid: ipid, opid: opid},
            success: function (data) {


                $('#peite.cm8-responsive').replaceWith(data);
            }

        });
    } else {
//ITSEPISTEYTYS
        var a = document.getElementById('id' + f).value;
        var max = document.getElementById('paino' + f).value;
        var erotus = a - max;
        if (erotus > 0) {
            alert('Oma pisteytys pitää olla väliltä 0-' + max);
        } else {
            var lista = f;
            var omat = a;
            var ipid = h;
            var opid = g;
            $(e).parent().next().next().next().next().text('');
            $(e).parent().css({
                backgroundColor: 'rgb(127, 216, 88)'
            });
            // Muokkaa painettua nappia edeltävän td:n taustan vihreäksi
            $(e).parent().prev().css({
                backgroundColor: 'rgb(127, 216, 88)'
            });
            // Muokkaa tehtävän numeron taustan värin vihreäksi
            $(e).parent().prev().prev().css({
                backgroundColor: 'rgb(127, 216, 88)'
            });
            $(e).parent().prev().prev().prev().css({
                backgroundColor: 'rgb(127, 216, 88)'
            });
            // Muokkaa painetun napin jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
            $(e).parent().next().css({
                backgroundColor: 'rgb(127, 216, 88)'
            }).text('');
            // Muokkaa painetun napin jälkeisen td:n jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
            $(e).parent().next().next().css({
                backgroundColor: 'rgb(127, 216, 88)'
            });
            // Lisää kommentinmuokkausnapin
            $(e).parent().next().next().next().after('<td style="background-color: #e5e5e5"><a onclick="korjaaope(this, ' + fuusi + ', ' + opid + ', ' + h + ')" title="Korjaa"  role="button" style="padding:2px 4px; margin: 0px">Korjaa</a></td>');
            // Poistaa kommenttikentän
//                $(e).parent().next().next().next().text('');
            $(e).parent().prev().text(a);
//  var b = document.getElementById('kom'+f).value;
            $(e).parent().next().next().next().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
//var kommentti = b;

            // Lisää check-merkin
            $(e).parent().text('✔');
//var lista = $('.lista1:checked').val();

//     data: {kommentti: kommentti, omat:omat, lista: lista, ipid: ipid, opid: opid},

            $.ajax({
                type: "POST",
                url: "tallennatehtavat_ope.php",
                data: {omat: omat, lista: lista, ipid: ipid, opid: opid},
                success: function (data) {

                    $('#peite.cm8-responsive').replaceWith(data);
                }

            });
        }

    }






}
function checkope2(e, f, g, h) {
    if (document.getElementById('pisteytys').value == 1) {

        if (document.getElementById('itsepisteytys').value == 0) {
            var fuusi = $(e).parent().prev().prev().prev().attr('id');
        } else {
            var fuusi = $(e).parent().prev().prev().prev().prev().attr('id');
        }

    } else {
        var fuusi = $(e).parent().prev().prev().attr('id');
    }
    if (document.getElementById('itsepisteytys').value == 0) {
        var lista = f;
        var ipid = h;
        var opid = g;
        $(e).parent().next().next().next().text('');
        $(e).parent().css({
            backgroundColor: 'rgb(0, 191, 255)'
        });
        // Muokkaa painettua nappia edeltävän td:n taustan vihreäksi
        $(e).parent().prev().css({
            backgroundColor: 'rgb(0, 191, 255)'
        });
        // Muokkaa tehtävän numeron taustan värin vihreäksi
        $(e).parent().prev().prev().css({
            backgroundColor: 'rgb(0, 191, 255)'
        });
        $(e).parent().prev().prev().prev().css({
            backgroundColor: 'rgb(0, 191, 255)'
        });
        // Muokkaa painetun napin jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
        $(e).parent().prev().css({
            backgroundColor: 'rgb(0, 191, 255)'
        }).text('');
        // Muokkaa painetun napin jälkeisen td:n jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
        $(e).parent().next().css({
            backgroundColor: 'rgb(0, 191, 255)'
        });
        // Lisää kommentinmuokkausnapin
        $(e).parent().next().next().after('<td style="background-color: #e5e5e5"><a onclick="korjaaope(this, ' + fuusi + ', ' + opid + ', ' + h + ')" title="Korjaa"  role="button" style="padding:2px 4px; margin: 0px;">Korjaa</a></td>');
        // Poistaa kommenttikentän
//                $(e).parent().next().next().text('');
//
//  var b = document.getElementById('kom'+f).value;
        $(e).parent().next().next().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
//var kommentti = b;

        // Lisää check-merkin
        $(e).parent().text('✔');
//var lista = $('.lista1:checked').val();
//     data: {kommentti: kommentti, lista: lista, ipid: ipid, opid: opid},
        $.ajax({
            type: "POST",
            url: "tallennatehtavat_ope2.php",
            data: {lista: lista, ipid: ipid, opid: opid},
            success: function (data) {

                $('#peite.cm8-responsive').replaceWith(data);
            }

        });
    } else {
//ITSEPISTEYTYS
        var a = document.getElementById('id' + f).value;
        var max = document.getElementById('paino' + f).value;
        var erotus = a - max;
        if (erotus > 0) {
            alert('Oma pisteytys pitää olla väliltä 0-' + max);
        } else {
            var lista = f;
            var omat = a;
            var ipid = h;
            var opid = g;
            $(e).parent().next().next().next().text('');
            $(e).parent().css({
                backgroundColor: 'rgb(0, 191, 255)'
            });
            // Muokkaa painettua nappia edeltävän td:n taustan vihreäksi
            $(e).parent().prev().css({
                backgroundColor: 'rgb(0, 191, 255)'
            });
            // Muokkaa tehtävän numeron taustan värin vihreäksi
            $(e).parent().prev().prev().css({
                backgroundColor: 'rgb(0, 191, 255)'
            });
            $(e).parent().prev().prev().prev().css({
                backgroundColor: 'rgb(0, 191, 255)'
            });
            $(e).parent().prev().prev().prev().prev().css({
                backgroundColor: 'rgb(0, 191, 255)'
            });
            // Muokkaa painetun napin jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
            $(e).parent().prev().css({
                backgroundColor: 'rgb(0, 191, 255)'
            }).text('');
            // Muokkaa painetun napin jälkeisen td:n jälkeisen td:n taustan vihreäksi, sekä poistaa napin td:stä
            $(e).parent().next().css({
                backgroundColor: 'rgb(0, 191, 255)'
            });
            // Lisää kommentinmuokkausnapin
            $(e).parent().next().next().after('<td style="background-color: #e5e5e5"><a onclick="korjaaope(this, ' + fuusi + ', ' + opid + ', ' + h + ')" title="Korjaa"  role="button" style="padding:2px 4px; margin: 0px;">Korjaa</a></td>');
            $(e).parent().prev().prev().text(a);
            // Poistaa kommenttikentän
//                $(e).parent().next().next().text('');
//  var b = document.getElementById('kom'+f).value;
            $(e).parent().next().next().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
//var kommentti = b;


            // Lisää check-merkin
            $(e).parent().text('✔');
//var lista = $('.lista1:checked').val();
//  data: {kommentti: kommentti, omat: omat, lista: lista, ipid: ipid, opid: opid},
            $.ajax({
                type: "POST",
                url: "tallennatehtavat_ope2.php",
                data: {omat: omat, lista: lista, ipid: ipid, opid: opid},
                success: function (data) {

                    $('#peite.cm8-responsive').replaceWith(data);
                }

            });
        }


    }

}

function checkope3(e, f, g, h) {
    if (document.getElementById('pisteytys').value == 1) {

        if (document.getElementById('itsepisteytys').value == 0) {
            var fuusi = $(e).parent().prev().prev().prev().prev().attr('id');
        } else {
            var fuusi = $(e).parent().prev().prev().prev().prev().prev().attr('id');
        }

    } else {
        var fuusi = $(e).parent().prev().prev().prev().attr('id');
    }
    if (document.getElementById('itsepisteytys').value == 0) {
        var lista = f;
        var ipid = h;
        var opid = g;
        $(e).parent().css({
            fontSize: '1.5em'
        });
//                
        // Poistaa kommenttikentän
        $(e).parent().next().next().text('');
        // Lisää kommentinmuokkausnapin
        $(e).parent().next().after('<td style="background-color: #e5e5e5"><a onclick="korjaaope(this, ' + fuusi + ', ' + opid + ', ' + h + ')" title="Korjaa"  role="button" style="padding:2px 4px; margin: 0px">Korjaa</a></td>');
        // Lisää check-merkin
        $(e).parent().text('☝');
//var lista = $('.lista1:checked').val();
//
//  var b = document.getElementById('kom'+f).value;
        $(e).parent().next().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
//var kommentti = b;
//
//   data: {kommentti: kommentti, lista: lista, ipid: ipid, opid: opid},
        $.ajax({
            type: "POST",
            url: "tallennatehtavat_ope3.php",
            data: {lista: lista, ipid: ipid, opid: opid},
            success: function (data) {

                $('#peite.cm8-responsive').replaceWith(data);
            }

        });
    } else {
//ITSEPISTEYTYS

        var lista = f;
        var ipid = h;
        var opid = g;
        $(e).parent().css({
            fontSize: '1.5em'
        });
//                
        // Poistaa kommenttikentän
        $(e).parent().next().next().text('');
        // Lisää kommentinmuokkausnapin
        $(e).parent().next().after('<td style="background-color: #e5e5e5"><a onclick="korjaaope(this, ' + fuusi + ', ' + opid + ', ' + h + ')" title="Korjaa"  role="button" style="padding:2px 4px; margin: 0px">Korjaa</a></td>');
        // Lisää check-merkin
        $(e).parent().text('☝');
//var lista = $('.lista1:checked').val();
//
//  var b = document.getElementById('kom'+f).value;
        $(e).parent().next().next().next().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
//var kommentti = b;
//
//     data: {kommentti: kommentti, lista: lista, ipid: ipid, opid: opid},
        $.ajax({
            type: "POST",
            url: "tallennatehtavat_ope3.php",
            data: {lista: lista, ipid: ipid, opid: opid},
            success: function (data) {

                $('#peite.cm8-responsive').replaceWith(data);
            }

        });
    }


}



function korjaaope(e, f, g, h) {
    if (document.getElementById('itsepisteytys').value == 0) {
        var lista = f;
        var ipid = h;
        var opid = g;
        // Poistaa nappulan

        $(e).parent().prev().prev().prev().prev().html('<input type="checkbox" onclick="checkope(this, ' + f + ',  ' + g + ',  ' + h + ')" name="lista[]" id="lista1" class="lista1"  value="' + f + '">');
        $(e).parent().prev().prev().prev().html('<input type="checkbox" onclick="checkope2(this, ' + f + ',  ' + g + ',  ' + h + ')"  name="lista2[]" id="lista2" class="lista2" value="' + f + '">');
        $(e).parent().prev().prev().html('<input type="checkbox" onclick="checkope3(this, ' + f + ',  ' + g + ',  ' + h + ')"  name="lista3[]" id="lista3" class="lista3" value="' + f + '">');
//              
        $(e).parent().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
        $(e).parent().html('');
        $.ajax({
            type: "POST",
            url: "korjaatehtava_ope.php",
            data: {lista: lista, ipid: ipid, opid: opid},
            success: function (data) {

                $('#peite.cm8-responsive').replaceWith(data);
            }






        });
    } else {
//ITSEPISTEYTYS
        var lista = f;
        var max = document.getElementById('paino' + f).value;
        var ipid = h;
        var opid = g;
        // Poistaa nappulan

        $(e).parent().prev().prev().prev().prev().html('<input type="checkbox" onclick="checkope(this, ' + f + ',  ' + g + ',  ' + h + ')" name="lista[]" id="lista1" class="lista1"  value="' + f + '">');
        $(e).parent().prev().prev().prev().html('<input type="checkbox" onclick="checkope2(this, ' + f + ',  ' + g + ',  ' + h + ')"  name="lista2[]" id="lista2" class="lista2"  value="' + f + '">');
        $(e).parent().prev().prev().html('<input type="checkbox" onclick="checkope3(this, ' + f + ',  ' + g + ',  ' + h + ')"  name="lista3[]" id="lista3" class="lista3"  value="' + f + '">');
//              
        $(e).parent().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'
        });
        $(e).parent().prev().prev().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'

        });
        $(e).parent().prev().prev().prev().prev().prev().prev().prev().css({
            backgroundColor: 'rgb(255, 255, 255)'

        });
        $(e).parent().prev().prev().prev().prev().prev().html('<input  type="number" name="omatpisteet[]" id="id' + f + '" class="omat" value="0" min="0" max="' + max + '">');
        $(e).parent().prev().html('<textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 0.8em"></textarea>');
        $(e).parent().html('');
        $.ajax({
            type: "POST",
            url: "korjaatehtava_ope.php",
            data: {lista: lista, ipid: ipid, opid: opid},
            success: function (data) {




                $('#peite.cm8-responsive').replaceWith(data);
            }






        });
    }



}








function showResult(str) {
    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota2').show();
        $('#piilota').show();
        $('#piilota3').show();
        $('#piilota8').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        $('#piilota2').hide();
        $('#piilota3').hide();
        $('#piilota8').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {

            var code = event.keyCode || event.which;
            //jos enteriä painettu
            if (code == 13) {

                event.preventDefault();
                return false;
            }

        });
    });
    return false;
}

function showResult2(str) {
    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota2').show();
        $('#piilota').show();
        $('#piilota3').show();
        $('#piilota8').show();
    }
// if searchString is not empty
    else {
        $('#piilota2').hide();
        $('#piilota').hide();
        $('#piilota3').hide();
        $('#piilota8').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch2.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}

function showResult3(str) {
    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota2').show();
        $('#piilota').show();
        $('#piilota3').show();
        $('#piilota8').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        $('#piilota2').hide();
        $('#piilota3').hide();
        $('#piilota8').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch3.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}

function showResult4(str) {
    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota2').show();
        $('#piilota').show();
    }
// if searchString is not empty
    else {
        $('#piilota2').hide();
        $('#piilota').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch4.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}

function showResult5(str) {
    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota2').show();
        $('#piilota').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        $('#piilota2').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch5.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}

function showResult6(str) {
    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota2').show();
        $('#piilota').show();
    }
// if searchString is not empty
    else {
        $('#piilota2').hide();
        $('#piilota').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch6.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}

function showResult7(str) {
    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota2').show();
        $('#piilota').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        $('#piilota2').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch7.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}
function showResult8(str) {
    $('#searchresults').hide();
    $('#piilota99').hide();
    $('#piilota100').show();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota99').show();
        $('#piilota2').show();
        $('#piilota').show();
        $('#piilota3').show();

    }
// if searchString is not empty
    else {
        $('#piilota99').hide();
        $('#piilota').hide();
        $('#piilota2').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch8.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}
function piilota100(str) {
    $('#piilota100').hide();
}
function showResult9(str) {
    $('#searchresults').hide();
    $('#piilota100').show();

    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {

        $('#searchresults').hide();

        $('#piilota2').show();
        $('#piilota').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        $('#piilota2').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch9.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}
function showResultAika(str) {

    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch_aika.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {

                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}
function showResultKansio(str) {

    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch_kansio.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {

                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}
function showResultPalautus(str) {

    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch_palautus.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {

                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}
function showResultOpetiedosto(str, kid) {

    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    var mihin = mihin;
    var data = {search: searchString, kid: kid};
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch_opetiedosto.php",
            data: data,
            beforeSend: function (html) {
                // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {

                $("#searchresults").show(); // this happens after we get results

                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }

        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}
function showResultKysely(str) {

    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch_kysely.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}
function showResultItse(str) {

    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var data = 'search=' + searchString;
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch_itse.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}
function showResultItseUusi(str, mihin) {

    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    var mihin = mihin;
    var data = {search: searchString, mihin: mihin};
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch_itseuusi.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }
        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}
function showResultTehtavat(str, ipid) {


    $('#searchresults').hide();
    // getting the value that user typed
    var searchString = str;
    // forming the queryString
    var search = searchString;
    var ipid = ipid;
    var data = {search: searchString, ipid: ipid};
    if (searchString == '') {
        $('#searchresults').hide();
        $('#piilota').show();
    }
// if searchString is not empty
    else {

        $('#piilota').hide();
        // ajax call
        $.ajax({
            type: "POST",
            url: "livesearch_tehtavat.php",
            data: data,
            beforeSend: function (html) { // this happens before actual call
                $("#results").html('');
                $(".word").html(searchString);
            },
            success: function (html) {
                $("#searchresults").show(); // this happens after we get results
                $("#results").show();
                $("#results").html('');
                $("#results").append(html);
            }

        });
    }
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    return false;
}

function submitChat()
{
    if (form1.uusi.value == ' ')
    {
        alert("Tyhjää kenttää ei voi lähettää!");
        return;
    }

    var uusi = form1.uusi.value;
    var paiva = form1.paiva.value;
    var kello = form1.kello.value;
    var kuid = form1.kuid.value;
    var kaid = form1.kaid.value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
        }


    }
    var newText = encodeURIComponent(uusi);
    xmlhttp.open('GET', 'insert.php?uusi=' + uusi + '&kello=' + kello + '&paiva=' + paiva + '&kuid=' + kuid + '&kaid=' + kaid, true);
    xmlhttp.send();
}
function halytarek() {

}


function move() {
    var elem = document.getElementById("myBar");
    var width = 80;
    var id = setInterval(frame, 100);
    function frame() {

        if (width >= 100) {


            clearInterval(id);
        } else {

            width++;
            elem.style.width = width + '%';
            document.getElementById("label").innerHTML = '';
        }
    }
}
//
//function loadProgress2() {
//
//    $(function () {
//        $('#tama').hide();
//        $("#myprogress2").progressbar({
//            value: false
//        });
//
//
//    });
//
//}


//
//function loadProgress()
//{
//
//    loadProgress2();
//
//    var xmlhttp = new XMLHttpRequest();
//    xmlhttp.onreadystatechange = function () {
//        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//            document.getElementById('myprogress').innerHTML = xmlhttp.responseText;
//        }
//
//
//    }
//
//
//    xmlhttp.open('GET', 'progress.php', true);
//    xmlhttp.send();
//
//
//}




function loadChat()
{



    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
        }


    }


    xmlhttp.open('GET', 'load.php', true);
    xmlhttp.send();
}

function haeAkt()
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('akt').innerHTML = xmlhttp.responseText;
        }


    }

    xmlhttp.open('GET', 'akt.php', true);
    xmlhttp.send();
}
function haeAktPainike(id)
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('aktpainike').innerHTML = xmlhttp.responseText;
        }


    }

    xmlhttp.open('GET', 'aktpainike.php?r=' + id, true);
    xmlhttp.send();
}
function haeAkt3()
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('akt2').innerHTML = xmlhttp.responseText;
        }


    }

    xmlhttp.open('GET', 'akt2.php', true);
    xmlhttp.send();
}

function haeAkt4()
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('akt4').innerHTML = xmlhttp.responseText;
        }


    }

    xmlhttp.open('GET', 'akt4.php', true);
    xmlhttp.send();
}


function haeAkt5()
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('akt5').innerHTML = xmlhttp.responseText;
        }


    }

    xmlhttp.open('GET', 'akt5.php', true);
    xmlhttp.send();
}

function haeAkt6()
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('akt6').innerHTML = xmlhttp.responseText;
        }


    }

    xmlhttp.open('GET', 'akt6.php', true);
    xmlhttp.send();
}

function haeNavi()
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('navi').innerHTML = xmlhttp.responseText;
        }


    }

    xmlhttp.open('GET', 'haeaanestysnavi.php', true);
    xmlhttp.send();
}
function avaaOikopolut()
{
    var cookieValue = 1;
    $.ajax({
        type: 'post',
        url: 'avaaoikopolut.php',
        data: {cookieValue: cookieValue},
        dataType: 'json',
        success: function (data) {
            if (data.status == "success") {


            } else {




            }
            document.location = data.location;
        }

    });
    document.location = data.location;
}


function suljeOikopolut()
{
    $('#tama').hide();
    var cookieValue = 1;
    $.ajax({
        type: 'post',
        url: 'suljeoikopolut.php',
        data: {cookieValue: cookieValue},
        dataType: 'json',
        success: function (data) {
            if (data.status == "success") {


            } else {




            }
            document.location = data.location;
        }

    });
    document.location = data.location;
}


function myLikes(cookieValue)
{

    $.ajax({
        type: 'post',
        url: 'tykkaa2.php',
        data: {cookieValue: cookieValue},
        dataType: 'json',
        success: function (data) {
            if (data.status == "success") {


            } else {




            }

        }

    });
}

function myNouLikes(cookieValue)
{


    $.ajax({
        type: 'post',
        url: 'perutykkays2.php',
        data: {cookieValue: cookieValue},
        dataType: 'json',
        success: function (data) {
            if (data.status == "success") {


            } else {




            }
        }
    });
}


function validateFormY()
{


    var myElem2 = document.getElementById("tama3").value;
    document.getElementById("tama3").style.backgroundColor = "white";
    document.getElementById("divID3").innerHTML = "";
    if (myElem2 == null || myElem2 == "") {
        document.getElementById("tama3").style.backgroundColor = "yellow";
        document.getElementById("divID3").style.padding = "10px 60px 10px 0px";
        document.getElementById("divID3").innerHTML = "Kuvaus on annettava!";
        return false;
    } else {
        document.getElementById("myForm3").submit();
    }
}

function validateForm()
{

    var x = document.getElementById("tama1").value;
    document.getElementById("tama1").style.backgroundColor = "white";
    document.getElementById("divID").innerHTML = "";
    if (x == null || x == "")
    {

        document.getElementById("tama1").style.backgroundColor = "yellow";
        document.getElementById("divID").style.padding = "10px 60px 10px 0px";
        document.getElementById("divID").innerHTML = "Kuvaus on annettava!";
        return false;
    } else {
        document.getElementById("myForm").submit();
    }
}

function validateFormU()
{

    var myElem = document.getElementById("tama2").value;
    document.getElementById("tama2").style.backgroundColor = "white";
    document.getElementById("divID2").innerHTML = "";
    if (myElem == null || myElem == "") {
        document.getElementById("tama2").style.backgroundColor = "yellow";
        document.getElementById("divID2").style.padding = "10px 60px 10px 0px";
        document.getElementById("divID2").innerHTML = "Kuvaus on annettava!";
        return false;
    } else {
        document.getElementById("myForm2").submit();
    }
}

function validateFormO()
{

    var x = document.getElementById("tama1").value;
    document.getElementById("tama1").style.backgroundColor = "white";
    document.getElementById("divID").innerHTML = "";
    if (x == null || x == "")
    {

        document.getElementById("tama1").style.backgroundColor = "yellow";
        document.getElementById("divID").style.padding = "20px 0px 20px 0px";
        document.getElementById("divID").innerHTML = "Tiedoston nimi on annettava!";
        return false;
    } else {
        document.getElementById("myForm").submit();
    }
}
function validateFormOT()
{

    var x = document.getElementById("tyonimi").value;
    document.getElementById("tyonimi").style.backgroundColor = "white";
    document.getElementById("divID2").innerHTML = "";
    if (x == null || x == "")
    {

        document.getElementById("tyonimi").style.backgroundColor = "yellow";
        document.getElementById("divID2").style.padding = "20px 0px 20px 0px";
        document.getElementById("divID2").innerHTML = "Tiedoston nimi on annettava!";
        return false;
    } else {
        document.getElementById("myForm1").submit();
    }
}

function validateForO2()
{

    var x = document.getElementById("tama1").value;
    document.getElementById("tama1").style.backgroundColor = "white";
    document.getElementById("demo4").innerHTML = "";
    if (x == null || x == "")
    {

        document.getElementById("tama1").style.backgroundColor = "yellow";
        document.getElementById("divID").style.padding = "0px 0px 0px 0px";
        document.getElementById("demo4").innerHTML = "Tiedoston nimi on annettava!";
        return false;
    } else {
        document.getElementById("myForm").submit();
    }
}




function validateForm3(f)
{

    var a = document.forms["Form"]["sposti"].value;
    var div = document.getElementById("divID");
    if (a == null || a == "")
    {
        document.getElementById("tama").style.backgroundColor = "yellow";
        document.getElementById("divID").style.padding = "10px 60px 10px 0px";
        div.innerHTML = "";
        div.innerHTML = div.innerHTML + "Sähköpostiosoite on annettava!";
        return false;
    } else {
        document.getElementById("myForm").submit();
    }
}


function validateForm4()
{

    var ok = 0;
    var a = document.forms["Form"]["Sposti"].value;
    var b = document.forms["Form"]["Etunimi"].value;
    var c = document.forms["Form"]["Sukunimi"].value;
    var d = document.forms["Form"]["koulu"].value;
    var e = document.forms["Form"]["Rooli"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    var div3 = document.getElementById("divID3");
    var div4 = document.getElementById("divID4");
    var div5 = document.getElementById("divID5");
    div1.innerHTML = "";
    div2.innerHTML = "";
    div3.innerHTML = "";
    div4.innerHTML = "";
    div5.innerHTML = "";
    document.getElementById("etu").style.backgroundColor = "white";
    document.getElementById("suku").style.backgroundColor = "white";
    document.getElementById("sposti").style.backgroundColor = "white";
    document.getElementById("koulu").style.backgroundColor = "white";
    document.getElementById("rooli").style.backgroundColor = "white";
    if (b == null || b == "")
    {

        document.getElementById("etu").style.backgroundColor = "yellow";
        div1.style.padding = "10px 60px 10px 0px";
        div1.innerHTML = "Etunimi on annettava!";
        ok = 1;
    }


    if (c == null || c == "")
    {

        document.getElementById("suku").style.backgroundColor = "yellow";
        div2.style.padding = "10px 60px 10px 0px";
        div2.innerHTML = "Sukunimi on annettava!";
        ok = 1;
    }

    if (a == null || a == "")
    {

        document.getElementById("sposti").style.backgroundColor = "yellow";
        div3.style.padding = "10px 60px 10px 0px";
        div3.innerHTML = "Sähköpostiosoite on annettava!";
        ok = 1;
    }

    if (d == "valitsekoulu")
    {

        document.getElementById("koulu").style.backgroundColor = "yellow";
        div4.style.padding = "10px 60px 10px 0px";
        div4.innerHTML = "Valitse ensisijainen oppilaitos!";
        ok = 1;
    }
    if (e == "valitser")
    {

        document.getElementById("rooli").style.backgroundColor = "yellow";
        div5.style.padding = "10px 60px 10px 0px";
        div5.innerHTML = "Valitse rooli, jossa haluat kirjautua!";
        ok = 1;
    }
    if (ok == 1) {
        return false;
    } else {




        var username = $('#sposti').val();
        var returnVal = 0;
        document.getElementById("sposti").style.backgroundColor = "yellow";
        div3.style.padding = "10px 60px 10px 0px";
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistatunnus.php',
            data: {username: username},
            dataType: 'json',
            success: function (data) {
                if (data.status == "success") {
                    document.getElementById("myForm").submit();
                } else {

                    if (data.msg == 'virhe')
                        div3.innerHTML = 'Käyttäjätunnuksen tulee olla sähköpostiosoite!';
                    else
                        div3.innerHTML = '<b style="color:red">Antamasi käyttäjätunnus on käytössä!<br><br>Ole hyvä ja valitse toinen.</b>';
                }
            }
        });
        return false;
    }


}
function validateForm4ope()
{

    var ok = 0;
    var a = document.forms["Form"]["Sposti"].value;
    var b = document.forms["Form"]["Etunimi"].value;
    var c = document.forms["Form"]["Sukunimi"].value;
    var d = document.forms["Form"]["koulu"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    var div3 = document.getElementById("divID3");
    var div4 = document.getElementById("divID4");
    var div5 = document.getElementById("divID5");
    div1.innerHTML = "";
    div2.innerHTML = "";
    div3.innerHTML = "";
    div4.innerHTML = "";
    div5.innerHTML = "";
    document.getElementById("etu").style.backgroundColor = "white";
    document.getElementById("suku").style.backgroundColor = "white";
    document.getElementById("spostir").style.backgroundColor = "white";
    document.getElementById("koulu").style.backgroundColor = "white";
    document.getElementById("kayttoehdot").style.backgroundColor = "white";
    if (b == null || b == "")
    {

        document.getElementById("etu").style.backgroundColor = "yellow";
        div1.style.padding = "10px 60px 10px 0px";
        div1.innerHTML = "Etunimi on annettava!";
        ok = 1;
    }


    if (c == null || c == "")
    {

        document.getElementById("suku").style.backgroundColor = "yellow";
        div2.style.padding = "10px 60px 10px 0px";
        div2.innerHTML = "Sukunimi on annettava!";
        ok = 1;
    }

    if (a == null || a == "")
    {

        document.getElementById("spostir").style.backgroundColor = "yellow";
        div3.style.padding = "10px 60px 10px 0px";
        div3.innerHTML = "Käyttäjätunnus eli sähköpostiosoite on annettava!";
        ok = 1;
    }

    if (d == "valitsekoulu")
    {

        document.getElementById("koulu").style.backgroundColor = "yellow";
        div4.style.padding = "10px 60px 10px 0px";
        div4.innerHTML = "Valitse ensisijainen oppilaitos!";
        ok = 1;
    }

    if (!document.getElementById('kayttoehdot').checked) {

        document.getElementById("kayttoehdotl").style.backgroundColor = "yellow";
        div5.style.padding = "10px 60px 10px 0px";
        div5.innerHTML = "Käyttöehdot on hyväksyttävä!";
        ok = 1;
    }

    if (ok == 1) {

        return false;
    } else {

        var username = $('#spostir').val();
        var returnVal = 0;
        var admin = $('#admin').val();
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistatunnusope.php',
            data: {username: username, admin: admin},
            dataType: 'json',
            success: function (data) {

                if (data.status == "success") {
                    document.getElementById("myForm").submit();
                } else {
                    document.getElementById("spostir").style.backgroundColor = "yellow";
                    div3.style.padding = "10px 60px 10px 0px";


                    if (data.msg == 'virhe')
                        div3.innerHTML = 'Käyttäjätunnuksen tulee olla sähköpostiosoite!';
                    else {

                        if (admin == 'admin') {
                            div3.innerHTML = '<b style="color:red">Antamasi käyttäjätunnus eli sähköpostiosoite on käytössä!<br><br>Ole hyvä ja valitse toinen.</b>';
                        } else {
                            div3.innerHTML = '<b style="color:red">Antamasi käyttäjätunnus eli sähköpostiosoite on käytössä!<br><br>Ole hyvä ja valitse toinen.</b>';
                        }

                    }



                }
            }
        });
        return false;
    }


}
function validateForm4opiskelija()
{
    var admin = $('#admin').val();
    var ok = 0;
    var a = document.forms["Form"]["Sposti"].value;
    var b = document.forms["Form"]["Etunimi"].value;
    var c = document.forms["Form"]["Sukunimi"].value;
    var d = document.forms["Form"]["koulu"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    var div3 = document.getElementById("divID3");
    var div4 = document.getElementById("divID4");
    var div5 = document.getElementById("divID5");
    div1.innerHTML = "";
    div2.innerHTML = "";
    div3.innerHTML = "";
    div4.innerHTML = "";
    div5.innerHTML = "";
    document.getElementById("etu").style.backgroundColor = "white";
    document.getElementById("suku").style.backgroundColor = "white";
    document.getElementById("spostir").style.backgroundColor = "white";
    document.getElementById("koulu").style.backgroundColor = "white";
    document.getElementById("kayttoehdot").style.backgroundColor = "white";
    if (admin == 'admin') {

        var e = document.forms["Form"]["Salasana"].value;
        var f = document.forms["Form"]["UusiSalasana"].value;
        var div6 = document.getElementById("divID6");
        var div7 = document.getElementById("divID7");
        div6.innerHTML = "";
        div7.innerHTML = "";
        document.getElementById("uusi").style.backgroundColor = "white";
        document.getElementById("uusi2").style.backgroundColor = "white";
        if (e == null || e == "")
        {
            document.getElementById("uusi").style.backgroundColor = "yellow";
            div6.style.padding = "10px 0px 20px 0px";
            div6.innerHTML = '<b style="font-size: 0.8em">Anna salasana!</b>';
            ok = 1;
        }
        if (f == null || f == "")
        {

            document.getElementById("uusi2").style.backgroundColor = "yellow";
            div7.style.padding = "10px 0px 10px 0px";
            div7.innerHTML = '<b style="font-size: 0.8em">Toista salasana!</b>';
            ok = 1;
        }

    }



    if (b == null || b == "")
    {

        document.getElementById("etu").style.backgroundColor = "yellow";
        div1.style.padding = "10px 60px 10px 0px";
        div1.innerHTML = "Etunimi on annettava!";
        ok = 1;
    }


    if (c == null || c == "")
    {

        document.getElementById("suku").style.backgroundColor = "yellow";
        div2.style.padding = "10px 60px 10px 0px";
        div2.innerHTML = "Sukunimi on annettava!";
        ok = 1;
    }

    if (a == null || a == "")
    {
        document.getElementById("spostir").style.backgroundColor = "yellow";
        div3.style.padding = "10px 60px 10px 0px";
        div3.innerHTML = "Käyttäjätunnus on annettava!";
        ok = 1;
    }

    if (d == "valitsekoulu")
    {

        document.getElementById("koulu").style.backgroundColor = "yellow";
        div4.style.padding = "10px 60px 10px 0px";
        div4.innerHTML = "Valitse ensisijainen oppilaitos!";
        ok = 1;
    }

    if (!document.getElementById('kayttoehdot').checked) {

        document.getElementById("kayttoehdotl").style.backgroundColor = "yellow";
        div5.style.padding = "10px 60px 10px 0px";
        div5.innerHTML = "Käyttöehdot on hyväksyttävä!";
        ok = 1;
    }
    if (ok == 1) {
        return false;
    } else {

        var username = $('#spostir').val();
        var returnVal = 0;
        document.getElementById("spostir").style.backgroundColor = "white";
        var admin = $('#admin').val();
        var uusi = $('#uusi').val();
        var uusi2 = $('#uusi2').val();
        var okke = 0;
        $.ajax({

            type: 'post',
            url: 'tarkistatunnusopiskelija.php',
            data: {username: username, admin: admin, uusi: uusi, uusi2: uusi2},
            dataType: 'json',
            success: function (data) {

                if (data.status === "lyonti") {

                    document.getElementById("spostir").style.backgroundColor = "yellow";
                    div3.innerHTML = '<b style="color:red">Käyttäjätunnuksessa ei saa olla välilyöntiä!</b>';
                } else if (data.status == "errors") {
                    document.getElementById("uusi").style.backgroundColor = "yellow";
                    div6.style.padding = "10px 0px 20px 0px";
                    div6.innerHTML = '<b style="font-size: 0.8em">Salasanat eivät vastaa toisiaan!</b>';
                    document.getElementById("uusi2").style.backgroundColor = "yellow";
                    div7.style.padding = "10px 0px 20px 0px";
                    div7.innerHTML = '<b style="font-size: 0.8em">Salasanat eivät vastaa toisiaan!</b>';
                } else if (data.status == "errork") {


                    document.getElementById("spostir").style.backgroundColor = "yellow";
                    div3.innerHTML = '<b style="color:red">Antamasi käyttäjätunnus on käytössä!<br><br>Ole hyvä ja valitse toinen.</b>';
                } else if (data.status == "success") {

                    document.getElementById("myForm").submit();
                }

            }

        });
        return false;
    }


}
function validateFormKe()
{

    var div5 = document.getElementById("divID5");
    document.getElementById("kayttoehdot").style.backgroundColor = "white";
    var ok = 0;
    if (!document.getElementById('kayttoehdot').checked) {

        document.getElementById("kayttoehdotl").style.backgroundColor = "yellow";
        div5.style.padding = "10px 60px 10px 0px";
        div5.innerHTML = "Käyttöehdot on hyväksyttävä!";
        ok = 1;
    }
    if (ok == 1) {
        return false;
    } else {
        document.getElementById("myForm").submit();
    }


}
function validateFormUusiKayttaja()
{

    var ok = 0;
    var a = document.forms["Form"]["Sposti"].value;
    var b = document.forms["Form"]["Etunimi"].value;
    var c = document.forms["Form"]["Sukunimi"].value;
    var e = document.forms["Form"]["Rooli"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    var div3 = document.getElementById("divID3");
    var div5 = document.getElementById("divID5");
    div1.innerHTML = "";
    div2.innerHTML = "";
    div3.innerHTML = "";
    div5.innerHTML = "";
    document.getElementById("etu").style.backgroundColor = "white";
    document.getElementById("suku").style.backgroundColor = "white";
    document.getElementById("sposti").style.backgroundColor = "white";
    document.getElementById("rooli").style.backgroundColor = "white";
    if (b == null || b == "")
    {

        document.getElementById("etu").style.backgroundColor = "yellow";
        div1.style.padding = "10px 60px 10px 0px";
        div1.innerHTML = "Etunimi on annettava!";
        ok = 1;
    }


    if (c == null || c == "")
    {

        document.getElementById("suku").style.backgroundColor = "yellow";
        div2.style.padding = "10px 60px 10px 0px";
        div2.innerHTML = "Sukunimi on annettava!";
        ok = 1;
    }

    if (a == null || a == "")
    {

        document.getElementById("sposti").style.backgroundColor = "yellow";
        div3.style.padding = "10px 60px 10px 0px";
        div3.innerHTML = "Sähköpostiosoite on annettava!";
        ok = 1;
    }


    if (e == "valitser")
    {

        document.getElementById("rooli").style.backgroundColor = "yellow";
        div5.style.padding = "10px 60px 10px 0px";
        div5.innerHTML = "Valitse rooli!";
        ok = 1;
    }
    if (ok == 1) {
        return false;
    } else {




        var username = $('#sposti').val();
        var returnVal = 0;
        document.getElementById("sposti").style.backgroundColor = "yellow";
        div3.style.padding = "10px 60px 10px 0px";
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistatunnus_uusikayttaja.php',
            data: {username: username},
            dataType: 'json',
            success: function (data) {
                if (data.status == "success") {
                    document.getElementById("myForm").submit();
                } else {

                    if (data.msg == 'virhe')
                        div3.innerHTML = 'Käyttäjätunnuksen tulee olla sähköpostiosoite!';
                    else
                        div3.innerHTML = '<b style="color:red">Antamasi käyttäjätunnus on käytössä!<br><br>Ole hyvä ja valitse toinen.</b>';
                }
            }
        });
        return false;
    }


}


function validateForm5()
{
    var ok = 0;
    var a = document.forms["Form"]["Sposti"].value;
    var b = document.forms["Form"]["Salasana"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    div1.innerHTML = "";
    div2.innerHTML = "";
    div1.style.padding = "10px 0px 0px 0px";
    div2.style.padding = "10px 0px 0px 0px";
    document.getElementById("sposti").style.backgroundColor = "white";
    document.getElementById("salasana").style.backgroundColor = "white";
    if ((a == null || a == "") && (b == null || b == ""))
    {

        document.getElementById("sposti").style.backgroundColor = "yellow";
        document.getElementById("salasana").style.backgroundColor = "yellow";
        div1.innerHTML = "Anna sähköpostiosoite!";
        div2.innerHTML = "Anna salasana!";
        ok = 1;
    } else if ((a == null || a == "") && (b != null || b != ""))
    {
        document.getElementById("sposti").style.backgroundColor = "yellow";
        div1.innerHTML = "Anna sähköpostiosoite!";
        ok = 1;
    } else if ((a != null || a != "") && (b == null || b == ""))
    {
        document.getElementById("salasana").style.backgroundColor = "yellow";
        div2.innerHTML = "Anna salasana!";
        ok = 1;
    }
    if (ok == 1) {
        return false;
    } else {

        var username = $('#sposti').val();
        var password = $('#salasana').val();
        var returnVal = 0;
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistakirjautuminen.php',
            data: {username: username, password: password},
            dataType: 'json',
            success: function (data) {

                if (data.status == "success") {
                    document.getElementById("myForm").submit();
                } else {

                    if (data.status == "error8") {
                        document.getElementById("sposti").style.backgroundColor = "yellow";
                        div1.innerHTML = 'Antamaasi käyttäjätunnusta ei ole rekisteröity oppimisympäristöön! Jos et muista antamaasi käyttäjätunnusta, niin lähetä sähköpostia ylläpitäjälle osoitteeseen <u><a href="mailto: marianne.sjoberg@cm8solutions.fi" class="osoite">marianne.sjoberg@cm8solutions.fi.</a></u>';
                    } else if (data.status == "error9") {
                        document.getElementById("salasana").style.backgroundColor = "yellow";
                        div2.innerHTML = 'Salasanaa on yritetty syöttää liian monta kertaa!<br>Voit aktivoida tunnuksesi uudelleen <u><a href="tunnustenkysely" class="osoite">painamalla tästä.</a></u>';
                    } else if (data.status == "error1") {
                        document.getElementById("sposti").style.backgroundColor = "yellow";
                        div1.innerHTML = 'Käyttäjätunnuksen tulee olla sähköpostiosoite!';
                    } else {
                        document.getElementById("salasana").style.backgroundColor = "yellow";
                        div2.innerHTML = 'Antamasi salasana on väärä! <b>Mikäli olet unohtanut salasanasi, voit aktivoida tunnuksesi uudelleen <u><a href="tunnustenkysely" class="osoite">painamalla tästä.</a></u>';
                    }


                }
            }
        });
        return false;
    }


}
function validateForm5uusi()
{
    var ok = 0;
    var a = document.forms["Form"]["Sposti"].value;
    var b = document.forms["Form"]["Salasana"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    div1.innerHTML = "";
    div2.innerHTML = "";
    div1.style.padding = "10px 0px 0px 0px";
    div2.style.padding = "10px 0px 0px 0px";
    document.getElementById("sposti").style.backgroundColor = "white";
    document.getElementById("salasana").style.backgroundColor = "white";
    if ((a == null || a == "") && (b == null || b == ""))
    {

        document.getElementById("sposti").style.backgroundColor = "yellow";
        document.getElementById("salasana").style.backgroundColor = "yellow";
        div1.innerHTML = "Anna sähköpostiosoite!";
        div2.innerHTML = "Anna salasana!";
        ok = 1;
    } else if ((a == null || a == "") && (b != null || b != ""))
    {
        document.getElementById("sposti").style.backgroundColor = "yellow";
        div1.innerHTML = "Anna käyttäjätunnus!";
        ok = 1;
    } else if ((a != null || a != "") && (b == null || b == ""))
    {
        document.getElementById("salasana").style.backgroundColor = "yellow";
        div2.innerHTML = "Anna salasana!";
        ok = 1;
    }
    if (ok == 1) {
        return false;
    } else {

        var username = $('#sposti').val();
        var password = $('#salasana').val();
        var returnVal = 0;
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistakirjautuminenuusi.php',
            data: {username: username, password: password},
            dataType: 'json',
            success: function (data) {

                if (data.status == "success") {
                    document.getElementById("myForm").submit();
                } else {

                    if (data.status == "error8") {

                        document.getElementById("sposti").style.backgroundColor = "yellow";
                        div1.innerHTML = 'Antamaasi käyttäjätunnusta ei ole rekisteröity oppimisympäristöön!<br><br>Jos et muista käyttäjätunnustasi, niin klikkaa alla olevaa linkkiä.';
                    } else if (data.status == "errort") {

                        var sposti = data.msg;
                        document.getElementById("sposti").style.backgroundColor = "yellow";
                        div1.innerHTML = '<b>Ylläpitäjä ei ole vielä vahvistanut rekisteröitymistäsi<br><br>Lähetä asiasta sähköpostia ylläpitäjälle osoitteeseen <a class="osoite" href="mailto: ' + sposti + '">' + sposti + '</a></b>';
                    } else if (data.status == "errorv") {

                        var id = data.msg;
                        document.getElementById("sposti").style.backgroundColor = "yellow";
                        div1.innerHTML = '<b>Et ole valinnut itsellesi vielä salasanaa.<br><br>Voit tehdä sen <a class="osoite" href="vahvistus?id=' + id + '">tästä</a></b>';
                    } else if (data.status == "error9") {
                        document.getElementById("salasana").style.backgroundColor = "yellow";
                        div2.innerHTML = 'Salasanaa on yritetty syöttää liian monta kertaa!<br><br>Voit aktivoida käyttäjätunnuksesi uudelleen <u><a href="tunnustenkyselyuusieka.php?akt=1" class="osoite">painamalla tästä.</a></u>';
                    } else if (data.status == "error1") {
                        document.getElementById("sposti").style.backgroundColor = "yellow";
                        div1.innerHTML = 'Käyttäjätunnuksen tulee olla sähköpostiosoite!';
                    } else {
                        document.getElementById("salasana").style.backgroundColor = "yellow";
                        div2.innerHTML = 'Antamasi salasana on väärä!<br><br>Jos et muista salasanaasi, niin klikkaa alla olevaa linkkiä.';
                    }


                }
            }
        });
        return false;
    }


}
function validateForm6()
{
    var ok = 0;
    var a = document.forms["Form"]["VanhaSalasana"].value;
    var b = document.forms["Form"]["Salasana"].value;
    var c = document.forms["Form"]["UusiSalasana"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    var div3 = document.getElementById("divID3");
    div1.innerHTML = "";
    div2.innerHTML = "";
    div3.innerHTML = "";
    document.getElementById("vanha").style.backgroundColor = "white";
    document.getElementById("uusi").style.backgroundColor = "white";
    document.getElementById("uusi2").style.backgroundColor = "white";
    if (a == null || a == "")
    {

        document.getElementById("vanha").style.backgroundColor = "yellow";
        div1.style.padding = "10px 0px 20px 0px";
        div1.innerHTML = "Anna vanha salasana!";
        ok = 1;
    }


    if (b == null || b == "")
    {
        document.getElementById("uusi").style.backgroundColor = "yellow";
        div2.style.padding = "10px 0px 20px 0px";
        div2.innerHTML = "Anna uusi salasana!";
        ok = 1;
    }
    if (c == null || c == "")
    {

        document.getElementById("uusi2").style.backgroundColor = "yellow";
        div3.style.padding = "10px 0px 10px 0px";
        div3.innerHTML = "Anna uusi salasana uudelleen!<br><br>";
        ok = 1;
    }


    if (ok == 1) {
        return false;
    } else {

        var vanha = $('#vanha').val();
        var uusi = $('#uusi').val();
        var uusi2 = $('#uusi2').val();
        var returnVal = 0;
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistavaihto.php',
            data: {vanha: vanha, uusi: uusi, uusi2: uusi2},
            dataType: 'json',
            success: function (data) {
                if (data.status == "success") {
                    document.getElementById("myForm").submit();
                } else {

                    if (data.msg == "Vanha salasana väärin") {
                        document.getElementById("vanha").style.backgroundColor = "yellow";
                        div1.style.padding = "10px 60px 20px 0px";
                        div1.innerHTML = 'Vanha salasana on väärä!';
                    } else {
                        document.getElementById("uusi2").style.backgroundColor = "yellow";
                        div3.style.padding = "10px 60px 20px 0px";
                        div3.innerHTML = 'Salasanat eivät vastaa toisiaan!';
                    }


                }
            }
        });
        return false;
    }


}
function validateForm7opiskelija()
{
    var ok = 0;
    var a = document.forms["Form"]["uusietu"].value;
    var b = document.forms["Form"]["uusisuku"].value;
    var c = document.forms["Form"]["uusisposti"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    var div3 = document.getElementById("divID3");
    div1.innerHTML = "";
    div2.innerHTML = "";
    div3.innerHTML = "";
    document.getElementById("etu").style.backgroundColor = "white";
    document.getElementById("suku").style.backgroundColor = "white";
    document.getElementById("spostir").style.backgroundColor = "white";
    if (a == null || a == "")
    {

        document.getElementById("etu").style.backgroundColor = "yellow";
        div1.innerHTML = "Etunimi on annettava!";
        ok = 1;
    }


    if (b == null || b == "")
    {
        document.getElementById("suku").style.backgroundColor = "yellow";
        div2.innerHTML = "Sukunimi on annettava!";
        ok = 1;
    }
    if (c == null || c == "")
    {

        document.getElementById("spostir").style.backgroundColor = "yellow";
        div3.innerHTML = "Sähköpostiosoite on annettava!";
        ok = 1;
    }


    if (ok == 1) {
        return false;
    } else {

        var etu = $('#etu').val();
        var suku = $('#suku').val();
        var username = $('#spostir').val();
        var id = $('#id').val();
        var returnVal = 0;
        var okke = 0;

        $.ajax({
            type: 'post',
            url: 'tarkistatunnusopiskelija.php',
            data: {username: username, id: id},
            dataType: 'json',
            success: function (data) {

                if (data.status === "lyonti") {

                    document.getElementById("spostir").style.backgroundColor = "yellow";
                    div3.innerHTML = '<b style="color:red">Käyttäjätunnuksessa ei saa olla välilyöntiä!</b>';
                } else if (data.status == "errors") {
                    document.getElementById("uusi").style.backgroundColor = "yellow";
                    div6.style.padding = "10px 0px 20px 0px";
                    div6.innerHTML = '<b style="font-size: 0.8em">Salasanat eivät vastaa toisiaan!</b>';
                    document.getElementById("uusi2").style.backgroundColor = "yellow";
                    div7.style.padding = "10px 0px 20px 0px";
                    div7.innerHTML = '<b style="font-size: 0.8em">Salasanat eivät vastaa toisiaan!</b>';
                } else if (data.status == "errork") {


                    document.getElementById("spostir").style.backgroundColor = "yellow";
                    div3.innerHTML = '<b style="color:red">Antamasi käyttäjätunnus on käytössä!<br><br>Ole hyvä ja valitse toinen.</b>';
                } else if (data.status == "success") {

                    document.getElementById("myForm").submit();
                }
            }
        });
        return false;
    }


}
function validateForm7ope()
{
    var ok = 0;
    var a = document.forms["Form"]["uusietu"].value;
    var b = document.forms["Form"]["uusisuku"].value;
    var c = document.forms["Form"]["uusisposti"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    var div3 = document.getElementById("divID3");
    div1.innerHTML = "";
    div2.innerHTML = "";
    div3.innerHTML = "";
    document.getElementById("etu").style.backgroundColor = "white";
    document.getElementById("suku").style.backgroundColor = "white";
    document.getElementById("spostir").style.backgroundColor = "white";
    if (a == null || a == "")
    {

        document.getElementById("etu").style.backgroundColor = "yellow";
        div1.innerHTML = "Etunimi on annettava!";
        ok = 1;
    }


    if (b == null || b == "")
    {
        document.getElementById("suku").style.backgroundColor = "yellow";
        div2.innerHTML = "Sukunimi on annettava!";
        ok = 1;
    }
    if (c == null || c == "")
    {

        document.getElementById("spostir").style.backgroundColor = "yellow";
        div3.innerHTML = "Sähköpostiosoite on annettava!";
        ok = 1;
    }


    if (ok == 1) {
        return false;
    } else {

        var etu = $('#etu').val();
        var suku = $('#suku').val();
        var username = $('#spostir').val();
        var id = $('#id').val();
        var returnVal = 0;
        var okke = 0;

        $.ajax({
            type: 'post',
            url: 'tarkistatunnusope.php',
            data: {username: username, id: id},
            dataType: 'json',
            success: function (data) {

                if (data.status == "success") {
                    document.getElementById("myForm").submit();
                } else {
                    document.getElementById("spostir").style.backgroundColor = "yellow";
                    div3.style.padding = "10px 60px 10px 0px";
                    if (data.msg == 'virhe')
                        div3.innerHTML = 'Käyttäjätunnuksen tulee olla sähköpostiosoite!';
                    else {

                   
                            div3.innerHTML = '<b style="color:red">Antamasi käyttäjätunnus eli sähköpostiosoite on käytössä!<br><br>Ole hyvä ja valitse toinen.</b>';
                        

                    }

                }
            }
        });
        return false;
    }


}
function validateForm8()
{

    var ok = 0;
    var a = document.forms["Form"]["sposti"].value;
    var div1 = document.getElementById("divID");
    div1.innerHTML = "";
    if (a == null || a == "")
    {

        document.getElementById("spostir").style.backgroundColor = "yellow";
        div1.style.padding = "10px 60px 20px 0px";
        div1.innerHTML = "Anna sähköpostiosoite!";
        ok = 1;
    }


    if (ok == 1) {
        return false;
    } else {

        var username = $('#spostir').val();
        var returnVal = 0;
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistaaktivointi.php',
            data: {username: username},
            dataType: 'json',
            success: function (data) {
                if (data.status == "success") {
                    document.getElementById("myForm").submit();
                } else {
                    if (data.msg == "error") {

                        document.getElementById("spostir").style.backgroundColor = "yellow";
                        div1.style.padding = "10px 60px 20px 0px";
                        div1.innerHTML = 'Antamaasi sähköpostiosoitetta ei ole rekisteröity oppimisympäristöön!';
                    } else {

                        document.getElementById("spostir").style.backgroundColor = "yellow";
                        div1.style.padding = "10px 60px 20px 0px";
                        div1.innerHTML = 'Käyttäjätunnuksen tulee olla sähköpostiosoite!';
                    }

                }
            }
        });
        return false;
    }


}

function validateForm8ope()
{

    var ok = 0;
    var a = document.forms["Form"]["sposti"].value;
    var div1 = document.getElementById("divID");
    div1.innerHTML = "";
    if (a == null || a == "")
    {

        document.getElementById("spostir").style.backgroundColor = "yellow";
        div1.style.padding = "10px 60px 20px 0px";
        div1.innerHTML = "Anna sähköpostiosoite!";
        ok = 1;
    }


    if (ok == 1) {
        return false;
    } else {

        var username = $('#spostir').val();
        var returnVal = 0;
        var okke = 0;

        $.ajax({
            type: 'post',
            url: 'tarkistaaktivointiope.php',
            data: {username: username},
            dataType: 'json',
            success: function (data) {

                if (data.status == "success") {
                    document.getElementById("myForm").submit();
                } else if (data.status == "erroropiskelija") {
                    document.getElementById("spostir").style.backgroundColor = "yellow";
                    div1.style.padding = "10px 60px 20px 0px";
                    div1.innerHTML = 'Olet rekisteröitynyt Cuulis-oppimisympäristöön opiskelijana, joten et voi tiedustella käyttäjätunnusta/salasanaa tästä.<br><br><u><a href="tunnustenkyselyuusieka.php" class="osoite">Palaa edelliselle sivulle</a></u> ja yritä uudelleen.';
                } else if (data.status == "error0") {

                    document.getElementById("spostir").style.backgroundColor = "yellow";
                    div1.style.padding = "10px 60px 20px 0px";
                    div1.innerHTML = 'Antamaasi sähköpostiosoitetta ei ole rekisteröity oppimisympäristöön!';
                } else if (data.status == "errort") {
                    var sposti = data.msg;
                    document.getElementById("spostir").style.backgroundColor = "yellow";
                    div1.style.padding = "10px 60px 20px 0px";
                    div1.innerHTML = '<b>Ylläpitäjä ei ole vielä vahvistanut rekisteröitymistäsi<br><br>Lähetä asiasta sähköpostia ylläpitäjälle osoitteeseen <a class="osoite" href="mailto: ' + sposti + '">' + sposti + '</a></b>';

                } else {

                    document.getElementById("spostir").style.backgroundColor = "yellow";
                    div1.style.padding = "10px 60px 20px 0px";
                    div1.innerHTML = 'Käyttäjätunnuksen tulee olla sähköpostiosoite!';
                }


            }
        });
        return false;
    }


}
function validateForm8uusi()
{
    var ok = 0;
    var div4 = document.getElementById("divID4");
    var d = document.forms["Form"]["koulu"].value;
    div4.innerHTML = "";
    if (d == "valitsekoulu")
    {

        document.getElementById("koulu").style.backgroundColor = "yellow";
        div4.style.padding = "10px 60px 10px 0px";
        div4.innerHTML = "Valitse oppilaitos!";
        ok = 1;
    }

    if (ok == 1) {
        return false;
    } else {


        return;
    }


}
function validateFormRek()
{
    var ok = 0;
    var div4 = document.getElementById("divID4");
    var d = document.forms["Form"]["rooli"].value;
    div4.innerHTML = "";
    if (d == "valitserooli")
    {

        document.getElementById("rooli").style.backgroundColor = "yellow";
        div4.style.padding = "10px 60px 10px 0px";
        div4.innerHTML = "Valitse rooli!";
        ok = 1;
    }

    if (ok == 1) {
        return false;
    } else {


        return;
    }


}
//function validateForm9()
//{
//    var ok = 0;
//
//    var a = document.forms["Form"]["Salasana"].value;
//    var b = document.forms["Form"]["UusiSalasana"].value;
//
//    var div1 = document.getElementById("divID");
//    var div2 = document.getElementById("divID2");
//
//
//    div1.innerHTML = "";
//    div2.innerHTML = "";
//
//
//    document.getElementById("salasana").style.backgroundColor = "white";
//    document.getElementById("salasana2").style.backgroundColor = "white";
//
//
//    if (a == null || a == "")
//    {
//
//        document.getElementById("salasana").style.backgroundColor = "yellow";
//  
//        div1.innerHTML = "Anna salasana!";
//
//        ok = 1;
//    }
//
//
//    if (b == null || b == "")
//    {
//        document.getElementById("salasana2").style.backgroundColor = "yellow";
//
//        div2.innerHTML = "Anna salasana uudelleen!";
//
//        ok = 1;
//    }
//
//
//
//    if (ok == 1) {
//        return false;
//    } else {
//
//
//        var salasana = $('#salasana').val();
//        var salasana2 = $('#salasana2').val();
//        var returnVal = 0;
//
//
//        var okke = 0;
//        $.ajax({
//            type: 'post',
//            url: 'tarkistavaihto3.php',
//            data: {salasana: salasana, salasana2: salasana2},
//            dataType: 'json',
//            success: function (data) {
//                if (data.status == "success") {
//                    document.getElementById("myForm").submit();
//
//                } else {
//
//
//                    document.getElementById("salasana").style.backgroundColor = "yellow";
//                    div1.style.padding = "10px 60px 10px 0px";
//                    div1.innerHTML = 'Salasanat eivät vastaa toisiaan!';
//
//                    document.getElementById("salasana2").style.backgroundColor = "yellow";
//
//
//                    div2.style.padding = "10px 60px 10px 0px";
//                    div2.innerHTML = 'Salasanat eivät vastaa toisiaan!';
//
//
//
//                }
//            }
//        });
//
//
//        return false;
//
//
//    }
//
//}

function validateForm10()
{
    var ok = 0;
    var b = document.forms["Form"]["Salasana"].value;
    var c = document.forms["Form"]["UusiSalasana"].value;
    var div2 = document.getElementById("divID2");
    var div3 = document.getElementById("divID3");
    div2.innerHTML = "";
    div3.innerHTML = "";
    document.getElementById("uusi").style.backgroundColor = "white";
    document.getElementById("uusi2").style.backgroundColor = "white";
    if (b == null || b == "")
    {
        document.getElementById("uusi").style.backgroundColor = "yellow";
        div2.style.padding = "10px 0px 20px 0px";
        div2.innerHTML = "Anna uusi salasana!";
        ok = 1;
    }
    if (c == null || c == "")
    {

        document.getElementById("uusi2").style.backgroundColor = "yellow";
        div3.style.padding = "10px 0px 10px 0px";
        div3.innerHTML = "Anna uusi salasana uudelleen!";
        ok = 1;
    }


    if (ok == 1) {
        return false;
    } else {


        var uusi = $('#uusi').val();
        var uusi2 = $('#uusi2').val();
        var returnVal = 0;
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistavaihtoadmin.php',
            data: {uusi: uusi, uusi2: uusi2},
            dataType: 'json',
            success: function (data) {
                if (data.status == "success") {
                    document.getElementById("myForm").submit();
                } else {

                    document.getElementById("uusi").style.backgroundColor = "yellow";
                    div2.style.padding = "10px 60px 10px 0px";
                    div2.innerHTML = 'Salasanat eivät vastaa toisiaan!';
                    document.getElementById("uusi2").style.backgroundColor = "yellow";
                    div3.style.padding = "10px 60px 10px 0px";
                    div3.innerHTML = 'Salasanat eivät vastaa toisiaan!';
                }
            }
        });
        return false;
    }


}

function validateForm11()
{

    var ok = 0;
    var a = document.forms["Form"]["uusietu"].value;
    var b = document.forms["Form"]["uusisuku"].value;
    var c = document.forms["Form"]["uusisposti"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    var div3 = document.getElementById("divID3");
    div1.innerHTML = "";
    div2.innerHTML = "";
    div3.innerHTML = "";
    document.getElementById("etu").style.backgroundColor = "white";
    document.getElementById("suku").style.backgroundColor = "white";
    document.getElementById("spostir").style.backgroundColor = "white";
    if (a == null || a == "")
    {

        document.getElementById("etu").style.backgroundColor = "yellow";
        div1.innerHTML = "Etunimi on annettava!";
        ok = 1;
    }


    if (b == null || b == "")
    {
        document.getElementById("suku").style.backgroundColor = "yellow";
        div2.innerHTML = "Sukunimi on annettava!";
        ok = 1;
    }
    if (c == null || c == "")
    {

        document.getElementById("spostir").style.backgroundColor = "yellow";
        div3.innerHTML = "Käyttäjätunnus eli sähköpostiosoite on annettava!";
        ok = 1;
    }


    if (ok == 1) {
        return false;
    } else {

        var etu = $('#etu').val();
        var suku = $('#suku').val();
        var sposti = $('#spostir').val();
        var id = $('#id').val();
        var returnVal = 0;
        var rooli = $('#rooli').val();
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistavaihto2admin.php',
            data: {id: id, sposti: sposti, rooli: rooli},
            dataType: 'json',
            success: function (data) {
            
                if (data.status == "success" && data.msg == "vapaa") {
              document.getElementById("myForm").submit();
                } else if (data.status == "success" && data.msg == "vanha") {
                  document.getElementById("myForm").submit();
                } else {

                    if (data.msg == "virhe") {
                        document.getElementById("spostir").style.backgroundColor = "yellow";
                        div3.style.padding = "10px 60px 10px 0px";
                        div3.innerHTML = 'Käyttäjätunnuksen tulee olla sähköpostiosoite!';
                    } else {
                        document.getElementById("spostir").style.backgroundColor = "yellow";
                        div3.style.padding = "10px 60px 10px 0px";
                        div3.innerHTML = '<b style="color:red">Antamasi käyttäjätunnus on käytössä!<br><br>Ole hyvä ja valitse toinen.</b>';
                    }


                }
            }
        });
        return false;
    }


}

function validateForm112()
{

    var ok = 0;
    var a = document.forms["Form"]["uusietu"].value;
    var b = document.forms["Form"]["uusisuku"].value;
    var c = document.forms["Form"]["uusisposti"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    var div3 = document.getElementById("divID3");
    div1.innerHTML = "";
    div2.innerHTML = "";
    div3.innerHTML = "";
    document.getElementById("etu").style.backgroundColor = "white";
    document.getElementById("suku").style.backgroundColor = "white";
    document.getElementById("spostir").style.backgroundColor = "white";
    if (a == null || a == "")
    {

        document.getElementById("etu").style.backgroundColor = "yellow";
        div1.innerHTML = "Etunimi on annettava!";
        ok = 1;
    }


    if (b == null || b == "")
    {
        document.getElementById("suku").style.backgroundColor = "yellow";
        div2.innerHTML = "Sukunimi on annettava!";
        ok = 1;
    }
    if (c == null || c == "")
    {

        document.getElementById("spostir").style.backgroundColor = "yellow";
        div3.innerHTML = "Käyttäjätunnus on annettava!";
        ok = 1;
    }


    if (ok == 1) {
        return false;
    } else {

        var etu = $('#etu').val();
        var suku = $('#suku').val();
        var sposti = $('#spostir').val();
        var id = $('#id').val();
        var returnVal = 0;
        var rooli = $('#rooli').val();
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistavaihto2admin.php',
            data: {id: id, sposti: sposti, rooli: rooli},
            dataType: 'json',
            success: function (data) {
                if (data.status == "success" && data.msg == "vapaa") {
                    document.getElementById("myForm").submit();
                } else if (data.status == "success" && data.msg == "vanha") {
                    document.getElementById("myForm").submit();
                } else {

                    if (data.msg == "virhe") {
                        document.getElementById("spostir").style.backgroundColor = "yellow";
                        div3.style.padding = "10px 60px 10px 0px";
                        div3.innerHTML = 'Käyttäjätunnuksen tulee olla sähköpostiosoite!';
                    } else {
                        document.getElementById("spostir").style.backgroundColor = "yellow";
                        div3.style.padding = "10px 60px 10px 0px";
                        div3.innerHTML = '<b style="color:red">Antamasi käyttäjätunnus on käytössä!<br><br>Ole hyvä ja valitse toinen.</b>';
                    }


                }
            }
        });
        return false;
    }


}
function validateForm9(f)
{
    var ok = 0;
    var a = document.forms["Form"]["Salasana"].value;
    var b = document.forms["Form"]["UusiSalasana"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    div1.innerHTML = "";
    div2.innerHTML = "";
    document.getElementById("salasana").style.backgroundColor = "white";
    document.getElementById("salasana2").style.backgroundColor = "white";
    if (a == null || a == "")
    {

        document.getElementById("salasana").style.backgroundColor = "yellow";
        div1.style.padding = "10px 60px 20px 0px";
        div1.innerHTML = "Anna salasana!";
        ok = 1;
    }


    if (b == null || b == "")
    {
        document.getElementById("salasana2").style.backgroundColor = "yellow";
        div2.style.padding = "10px 60px 20px 0px";
        div2.innerHTML = "Anna salasana uudelleen!";
        ok = 1;
    }



    if (ok == 1) {
        return false;
    } else {


        var salasana = $('#salasana').val();
        var salasana2 = $('#salasana2').val();
        var returnVal = 0;
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistavaihto3.php',
            data: {salasana: salasana, salasana2: salasana2},
            dataType: 'json',
            success: function (data) {
                if (data.status == "success") {

                    document.getElementById("myForm").submit();
                } else {


                    document.getElementById("salasana").style.backgroundColor = "yellow";
                    div1.style.padding = "10px 60px 20px 0px";
                    div1.innerHTML = 'Salasanat eivät vastaa toisiaan!';
                    document.getElementById("salasana2").style.backgroundColor = "yellow";
                    div2.style.padding = "10px 60px 20px 0px";
                    div2.innerHTML = 'Salasanat eivät vastaa toisiaan!';
                    return false;
                }
            }
        });
        return true;
    }

}
function validateFormTunnus()
{
    var ok = 0;
    var a = document.forms["Form"]["tunnus"].value;
    var div1 = document.getElementById("divID");
    div1.innerHTML = "";
    document.getElementById("tunnusr").style.backgroundColor = "white";
    if (a == null || a == "")
    {

        document.getElementById("tunnusr").style.backgroundColor = "yellow";
        div1.style.padding = "10px 60px 20px 0px";
        div1.innerHTML = "Anna käyttäjätunnus!";
        ok = 1;
    }




    if (ok == 1) {
        return false;
    } else {


        var tunnus = $('#tunnusr').val();
        var id = $('#id').val();
        var returnVal = 0;
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistavaihtotunnus.php',
            data: {tunnus: tunnus, id: id},
            dataType: 'json',
            success: function (data) {
                if (data.status === "success") {
                    document.getElementById("myForm").submit();
                } else if (data.status === "error2") {


                    document.getElementById("tunnusr").style.backgroundColor = "yellow";
                    div1.style.padding = "10px 60px 20px 0px";
                    div1.innerHTML = '<b style="color:red">Antamasi käyttäjätunnus on käytössä!<br><br>Ole hyvä ja valitse toinen.</b>';


                } else if (data.status === "error1") {


                    document.getElementById("tunnusr").style.backgroundColor = "yellow";
                    div1.style.padding = "10px 60px 20px 0px";
                    div1.innerHTML = '<b style="color:red">Et voi valita vanhaa käyttäjätunnusta!<br><br>Ole hyvä ja valitse uusi.</b>';


                }
            }
        });
        return false;
    }

}
function validateFormKurssityo()
{

    var a = document.forms["Form"]["tarkka"].value;
    var b = document.forms["Form"]["lkm"].value;
    var div = document.getElementById("divID");
    if (b == "0" && a == "0")
    {
        document.getElementById("tasan").style.backgroundColor = "yellow";
        document.getElementById("lkm").style.backgroundColor = "yellow";
        div.style.backgroundColor = "yellow";
        div.style.padding = "10px 60px 10px 0px";
        div.innerHTML = "";
        div.innerHTML = div.innerHTML + "Ryhmien tarkka määrä tai maksimimäärä on annettava!";
        return false;
    } else {
        document.getElementById("myForm").submit();
    }
}
function validateFormItse()
{
    var pakolliset = document.getElementsByClassName("pakollinen");
    var muutat = document.getElementsByClassName("muuta");
    var i;
    var onko = 0;
    for (i = 0; i < pakolliset.length; i++) {
        if (pakolliset[i].value == null || pakolliset[i].value == "") {
            pakolliset[i].style.backgroundColor = "yellow";
            onko = 1;
            muutat[i].style.fontWeight = "bolder";
            muutat[i].style.color = "red";
            muutat[i].style.fontStyle = "normal";
            muutat[i].innerHTML = 'Tämä kenttä on pakollinen';
        }


    }
    
    if (onko == 1) {
       
        return false;
    } else {
        
        document.getElementById("myForm").submit();
    }

}

function validateFormPainike(f)
{
    var ok = 0;
    var paiva = document.forms["Form"]["paiva"].value;
    var kello = document.forms["Form"]["kello"].value;
    var div1 = document.getElementById("divID");
    var div2 = document.getElementById("divID2");
    div1.innerHTML = "";
    div2.innerHTML = "";
    document.getElementById("paiva").style.backgroundColor = "white";
    document.getElementById("kello").style.backgroundColor = "white";
    var salasana = $('#paiva').val();
    var salasana2 = $('#kello').val();
    var returnVal = 0;
    $.ajax({
        type: 'post',
        url: 'tarkistarajat.php',
        data: {paiva: paiva, kello: kello},
        dataType: 'json',
        success: function (data) {
            if (data.status == "success") {
                document.getElementById("myForm").submit();
            } else {

                if (data.msg == "paivaerror") {
                    document.getElementById("paiva").style.backgroundColor = "yellow";
                    div1.style.padding = "10px 60px 10px 0px";
                    div1.innerHTML = 'Anna päivämäärä muodossa: pp.kk.yyyy';
                } else if (data.msg == "kelloerror") {
                    document.getElementById("kello").style.backgroundColor = "yellow";
                    div2.style.padding = "10px 60px 10px 0px";
                    div2.innerHTML = 'Anna kellonaika muodossa: tt:mm';
                } else if (data.msg == "error") {

                    document.getElementById("paiva").style.backgroundColor = "yellow";
                    div1.style.padding = "10px 60px 10px 0px";
                    div1.innerHTML = 'Anna päivämäärä muodossa: pp.kk.yyyy';
                    document.getElementById("kello").style.backgroundColor = "yellow";
                    div2.style.padding = "10px 60px 10px 0px";
                    div2.innerHTML = 'Anna kellonaika muodossa: tt:mm';
                }


            }
        }
    });
    return false;
}

function validateForm12()
{

    var ok = 0;
    var a = document.forms["Form"]["Avain"].value;
    var div1 = document.getElementById("divID");
    div1.innerHTML = "";
    document.getElementById("Avain").style.backgroundColor = "white";
    if (a == null || a == "")
    {

        document.getElementById("Avain").style.backgroundColor = "yellow";
        div1.innerHTML = "Anna avain!<br><br>";
        ok = 1;
    }




    if (ok == 1) {
        return false;
    } else {

        var username = $('#Avain').val();
        var kurssi = $('#kurssi_id').val();
        var returnVal = 0;
        var okke = 0;
        $.ajax({
            type: 'post',
            url: 'tarkistaavain.php',
            data: {username: username, kurssi: kurssi},
            dataType: 'json',
            success: function (data) {
                if (data.status == "success") {
                    document.getElementById("myForm").submit();
                } else {


                    document.getElementById("Avain").style.backgroundColor = "yellow";
                    div1.style.padding = "10px 60px 10px 0px";
                    div1.innerHTML = 'Antamasi avain on väärä!<br><br>';
                }
            }
        });
        return false;
    }


}



function fixedHeader()
{
    var tableOffset = $("#mytable").offset().top;
    var $header = $("#mytable > thead").clone();
    var $fixedHeader = $("#headerfixed").append($header);
    $(window).bind("scroll", function () {
        var offset = $(this).scrollTop();
        if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
            $fixedHeader.show();
        } else if (offset < tableOffset) {
            $fixedHeader.hide();
        }
    });
}
function Hide()
{
    var monta = $('#monta').val();
    for ($i = monta; $i >= 1; $i--) {
        var piilo = $i;
        $('#' + piilo + '.cm8-margin-bottom').hide();
    }


}

function startLoad()
{

    setInterval('loadChat2()', 1000);
}
function startLoad6(a)
{

    haeNavi();
    setInterval('haeNavi()', 1000);
    loadChat3(a);
    setInterval('loadChat3(' + a + ')', 5000);
}

function lataaKeski()
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('keski').innerHTML = xmlhttp.responseText;
        }




    }


    xmlhttp.open('GET', 'haekeski.php', true);
    xmlhttp.send();
}
function lataaKeski2()
{
    var salasana = document.getElementById('taa').value;
    $.ajax({
        type: 'post',
        url: 'haekeski2.php',
        data: {salasana: salasana},
        dataType: 'json',
        success: function (data) {

            if (data.status == "on") {

                $('#oma').val(data.variable1);
            } else {

                $('#oma').val(data.variable1);
            }
        }
    });
    var value = document.getElementById('oma').value;
    $('#example').barrating({
        theme: 'fontawesome-stars-o',
        initialRating: document.getElementById('oma').value,
        readOnly: true


    });
    if (value === '0') {
        $('#example').barrating('clear');
    } else {
        $('#example').barrating('set', value);
    }
    $('#example').barrating('readonly', true);
}


function lataa() {

    lataaKeski();
    setInterval('lataaKeski()', 1000);
}
function lataa2() {

    lataaKeski2();
    lataaKeski();
    setInterval('lataaKeski2()', 1000);
    setInterval('lataaKeski()', 1000);
}
function submitChat2()
{
    if (form1.uusi.value == ' ')
    {
        alert("Tyhjää kenttää ei voi lähettää!");
        return;
    }

    var uusi = form1.uusi.value;
    var paiva = form1.paiva.value;
    var kello = form1.kello.value;
    var nimi = form1.nimi.value;
    var id = form1.id.value;
    var newText = encodeURIComponent(uusi);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
        }


    }
    document.getElementById('lisaa').innerHTML = 'pöö';
    xmlhttp.open('GET', 'insert2.php?uusi=' + newText + '&kello=' + kello + '&paiva=' + paiva + '&nimi=' + nimi + '&id=' + id, false);
    xmlhttp.send();
//window.location.replace('https://cuulis.cm8solutions.fi/keskustelut.php?r='+id);
// var baseURL = "https://cuulis.cm8solutions.fi/keskustelut.php";
// 
//return baseURL + "?r=" + id;
}

function submitAani()
{

    var id = form1.id.value;
    var radios = document.getElementsByName('vastaus');
    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            // do whatever you want with the checked radio
            var vastaus = (radios[i].value);
            // only one radio can be logically checked, don't check the rest
            break;
        }
    }


    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('tulokset').innerHTML = xmlhttp.responseText;
        }


    }


    xmlhttp.open('GET', 'insert3.php?id=' + id + '&vastaus=' + vastaus, true);
    xmlhttp.send();
}


function loadChat8()
{


    var id = document.getElementById("haeid").innerHTML;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
        }


    }

    xmlhttp.open('GET', 'load8.php?id=' + id, true);
    xmlhttp.send();
}











function loadChat2()
{


    var id = document.getElementById("haeid").innerHTML;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
        }


    }

    xmlhttp.open('GET', 'load2.php?id=' + id, true);
    xmlhttp.send();
}

function loadChat3(a)
{



    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('tulokset').innerHTML = xmlhttp.responseText;
        }


    }


    xmlhttp.open('GET', 'load3.php?a=' + a, true);
    xmlhttp.send();
}

function startLoad8()
{

    loadChat8();
    setInterval('loadChat8()', 1000);
    var bottom = document.getElementById("bottom");
    window.location.hash = bottom;
}

//function FocusOnBottom() {document.getElementById("bottom").focus();}





function startLoad2()
{

    loadChat2();
    setInterval('loadChat2()', 1000);
}

function startLoad3()
{
    haeAkt3();
    setInterval('haeAkt3()', 1000);
}
function startLoadPainike(r)
{

    haeAktPainike(r);
    setInterval('haeAktPainike(' + r + ')', 1000);
}
function count()
{
    $(".demo").TimeCircles({time: {
            Days: {color: "#ff0000", text: "päivää"},
            Hours: {color: "#ff9900", text: "tuntia"},
            Minutes: {color: "yellow", text: "minuuttia"},
            Seconds: {color: "#7FD858", text: "sekuntia"}
        },
        circle_bg_color: "#d9d9d9"
    });
}



function updateclock()
{
    var thetime = new Date();
    var nhours = thetime.getHours();
    var nmins = thetime.getMinutes();
    var nsecn = thetime.getSeconds();
    // add a zero in front of numbers<10
    nmins = checkTime(nmins);
    nsecn = checkTime(nsecn);
    var timeDivObj = document.getElementById('timeDiv');
    timeDivObj.innerHTML = nhours + ":" + nmins + ":" + nsecn;
}

function startclock()
{

    updateclock();
    setInterval('updateclock()', 1000);
}

function checkTime(i)
{
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

/* function myFunction(y) {
 y.classList.toggle("change");
 var x = "Total Height: " + screen.height + "px";
 document.getElementById("demo").innerHTML = x;
 } */




function myFunction(y) {
    y.classList.toggle("change");
    return screen.height;
}

function setScreenHWCookie() {
// Function to set persistant (default) or session cookie with screen ht & width
// Returns true if cookie matches screen ht & width or if valid cookie created
// Returns false if cannot create a cookies.
    var ok = getCookie("shw");
    var shw_value = screen.height + "px:" + screen.width + "px";
    if (!ok || ok != shw_value) {
        var expires = 7 // days
        var ok = setCookie("shw", shw_value, expires)
        if (ok == "") {
// not possible to set persistent cookie
            expires = 0
            ok = setCookie("shw", shw_value, expires)
            if (ok == "")
                return false // not possible to set session cookie
        }
        window.location.reload();
    }
    return true;
}


function sayHelloWorld() {

    var hello = "hello";
    var world = "world";
    window.location.href = "kysymykset3.php?w1=" + hello + "&w2=" + world;
    return true;
}

function loadLog() {

    $.ajax({
        url: "chathaku.php",
        cache: false,
        success: function (php) {
            $("#chatbox").php(php); //Insert chat log into the #chatbox div				
        },
    });
}


