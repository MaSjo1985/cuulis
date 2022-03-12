
<html>
    <head>
        <?php
session_start();
        ob_start();
        $id = 1222;
        ?>
        <script>
            function newDoc(d) {
                var myVariable = <?php
session_start();
        ob_start();
        echo(json_encode($id));
        ?>;
                window.location.assign("https://cuulis.cm8solutions.fi/testaus2.php?id=" + d);
            }
        </script>
    </head>
    <body>
        <?php
session_start();
        ob_start();
        echo'<a href="#" onclick="newDoc(' . $id . ')">Testi</a>';

        echo'</body>
</html>';
        