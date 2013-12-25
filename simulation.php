<html>
    <head>
        <title>Pseudo Streamer</title>
        <link href="css/nmea.css" rel="stylesheet" media="all"/>
    </head>
    <body>
        <header>
            <ul class="nav">
                <li>
                <li><a href="readme.md">Instructions</a></li>
                <li class="selected"><a href="simulation.php">Stream Simulation</a></li>
                <li><a href="parse.php">Parse sentence Stream</a></li> 
            </ul>
        </header>
        <section id="stream">
            <h3>Simulates a GPS device emmitting strings at 1HZ </h3>
            <div id="streamUpdate"> </div>
        </section>
        <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="js/ajax.js"></script>
    </body>
</html>