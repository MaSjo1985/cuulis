 
<head>

    <meta charset="UTF-8">
    <title> Etusivu </title>

</head>

<body>

    <?php
session_start();
    ob_start();
    include("yhteys.php");

    $db->query("insert into kayttajat (etunimi, sukunimi, tunnus, salasana) values('" . $_POST[Etunimi] . "," . $_POST[Sukunimi] . "," . $_POST[Tunnus] . "," . $_POST[Salasana] . "')");

    header("location: admin.php");
    ?>