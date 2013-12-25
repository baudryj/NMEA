<?php
require_once 'configure/conf.php';
require_once 'classes/GGA.php';

?>

<html>
    <head>
        <title>NMEA Parser & Pseudo Stream Simulator</title>
        <link href="css/nmea.css" rel="stylesheet" media="all"/>
    </head>
    <body>
        <header>
            <ul class="nav">
                <li>
                <li><a href="index.php">Instructions</a></li>
                <li><a href="simulation.php">Stream Simulation</a></li>
                <li class="selected"><a href="parse.php">Parse sentence Stream</a></li> 
            </ul>
        </header>
        <section id="stream">
            <h3>Parser</h3>
            <h4>NB actual parsed strings appended to the parsed.txt log file! check</h4>
        <?php
        
        $GGA = new GGA();
        
        $log = "gga-log.txt";
        $fp = fopen($log, 'rb+');
        
        // Parsed data will be written and appended to this file
        $writeto = "parsed.txt";
        
        // Read log line by line to simulate stream
        while($line = fgets($fp, 4056))
        {
           // Parse the sentences after doing validations 
           $data = $GGA->parseSentence($line);
           // Write decoded data to file, apending to the existing data if any
           // stored in JSON format for flexibility to use with 3rd party apps
           file_put_contents($writeto, $data . PHP_EOL, FILE_APPEND);
           
           // Display parsed data to browser
           echo $data;
        }
        fclose($fp);
        ?>
        </section>
    </body>
</html>