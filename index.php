<html>
    <head>
        <title>NMEA Parser & Pseudo Stream Simulator</title>
        <link href="css/nmea.css" rel="stylesheet" media="all"/>
    </head>
    <body>
        <header>
            <ul class="nav">
                <li>
                <li class="selected"><a href="index.php">Instructions</a></li>
                <li><a href="simulation.php">Stream Simulation</a></li>
                <li><a href="parse.php">Parse sentence Stream</a></li> 
            </ul>
        </header>
        <section id="stream">
            <h3>Features</h3>
            <ul>
                <li>Streaming of NMEA GPGGA sentences from a log file at 1 HZ, simulating a GPS device</li>
                <li>Parses (decodes) the streaming NMEA strings and writes them to file in JSON format</li>
            </ul>
            <p>Click the links above to view</p>
        </section>
    </body>
</html>