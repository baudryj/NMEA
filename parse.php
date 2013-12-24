<?php
require_once 'configure/conf.php';
require_once 'classes/GGA.php';

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