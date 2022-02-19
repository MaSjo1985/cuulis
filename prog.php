
<style>
    #myProgress {
        position: relative;
        width: 30%;
        height: 20px;
        background-color: #4095c6;
        box-shadow: 10px 10px 5px  #4095c6;

    }

    #myBar {
        position: absolute;
        width: 10%;
        height: 100%;
        background-color: #4095c6;

    }

    #label {
        text-align: center;
        line-height: 30px;
        color: #2b6777;
    }
</style>
<body onload="move()">



    <div id="myProgress">
        <div id="myBar">
            <div id="label"><em></em></div>
        </div>
    </div>




    <script>
        function move() {

            var elem = document.getElementById("myBar");
            var width = 80;
            setInterval(frame, 100);
            function frame() {
                if (width >= 100) {

                    clearInterval(id);
                } else {

                    width++;
                    elem.style.width = width + '%';
                    document.getElementById("label").innerHTML = 'ööööö...';
                }
            }
        }
    </script>

























