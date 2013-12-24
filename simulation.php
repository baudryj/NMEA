<?php
    
    /**
     * Reads Nmea strings from a log file to simulate a stream
     *
     * */
    
    $log = "gga-log.txt";
    $fp = fopen($log, 'r');
    
    // Read log line by line after every 0.5 seconds to simulate a stream
    while($line = fgets($fp, 4056))
    {
        sleep(0.5);
        echo $line;
    }

?>