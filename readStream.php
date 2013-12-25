<?php
    
    /**
     * Reads Nmea strings from a log file to simulate an input stream
     *
     * */
    
    $log = "gga-log.txt";
    $fp = fopen($log, 'r');
    
    $data = array();
    
    // Read log line by line
    while($line = fgets($fp, 4056))
    {
        $data[] = $line;
    }
    
    echo json_encode($data);

?>