<?php
require_once 'configure/conf.php';
require_once LIBRARY .'php_serial.class.php';

require_once 'classes/GGA.php';
    $GGA = new GGA();

    // Instantiate Serial/Com port with php
    $serialport = new phpSerial();
    
    /**
     * Configure Port with hp for serial Access
     * On windows port ranges fro 'COM1' - 'COM17' preferred 4-9
     * On linux use '/dev/ttyS0' or 'COM1'
     * On mac use '/dev/tty.serial'
     * Change value in the configuration/conf file for easier management
     * 
     * SET BAUD RATE = 4800 NMEA standard
     * Parity  = none
     * Stop bits = 1
     * control flow = none
     * character length = 8
     * */

    // Change value in the configuration/conf file
    $serialport->deviceSet (SERIAL_COM_PORT);
    
    $serialport->confBaudRate (4800);
    $serialport->confCharacterLength (8);
    $serialport->confParity ("none");
    $serialport->confStopBits (1);
    $serialport->confFlowControl ("none");
    
    if(!$serialport->deviceOpen ()) die("Could not open port! Windows has issues,
                                        try on a linux like machine or change the serial port configuration in configure/conf.php");
    
    //$serialport->sendMessage ('testing 123.. ');
    
    // Read any message in the input buffer
    $data = $serialport->readPort ();
    
    if(strlen($data) > 82)
    {
    $decoded = $GGA->parseSentence($data);
    
    $writeto = "parsed.txt";
    file_put_contents($writeto, $decoded . PHP_EOL, FILE_APPEND);
    
    sleep(1);
    }
    
    // Clear the buffer
    $serialport->serialflush ();
    //$serialport->deviceClose ();

?>