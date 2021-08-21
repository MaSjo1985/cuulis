function piilota() {

    $("#klik2").hide();
    $("#klik").click(function () {

        $("#tama").hide();
        $("#siirto").hide();
        $("#klik2").show();

    });
    $("#klik2").click(function () {
        $("#tama").show();
        $("#siirto").show();
        $("#klik2").hide();
    });
}

function piilota2() {

    $("#tama").hide();
    $("#siirto").hide();
    $("#klik2").show();
    $("#klik").hide();
    $("#klik").click(function () {

        $("#tama").hide();
        $("#siirto").hide();
        $("#klik2").show();

    });
    $("#klik2").click(function () {
        $("#tama").show();
        $("#tama1").show();
        $("#tama2").show();
        $("#tama3").show();

        $("#siirto").show();
        $("#siirto2").show();
        $("#klik2").hide();
        $("#klik").show();

    });
}

function siirra() {

    $("#siirto").draggable();
}

function muunna() {

    $("#siirto2").resizable({
        alsoResize: "#kirja"
    });
    $("#kirja").resizable();
}

function taulukko() {

    var j = jQuery.noConflict();

    $("#mytable").tableHeadFixer({"head": true, "left": 1, "right": 0});

    $("#mytable2").tableHeadFixer({"head": true, "left": 1, "right": 0});


}
function taulukko2() {
    var j = jQuery.noConflict();
    var $table2 = j('#mytable2');

    $table2.floatThead({zIndex: 1001});

    var $table = j('#mytable');
    $table.floatThead({zIndex: 1});
}

function taulukko3() {

    var j = jQuery.noConflict();
    var $table = $('#mytable');
    $table.floatThead({zIndex: 1});
}

function taulukko4() {
    var j = jQuery.noConflict();


    $("#mytable").tableHeadFixer({"head": true, "left": 1, "right": 0});

    $("#mytable2").tableHeadFixer({"head": true, "left": 1, "right": 0});



}
function taulukko5() {

    var j = jQuery.noConflict();


    var $table = j('#mytable');
    $table.floatThead({zIndex: 1});

    var $table2 = j('#mytable2');
    $table2.floatThead({zIndex: 1});
}
