<?php
/**----------------------------------------------------------------
# @appName: NMEA 0183 GPGGA Simulator & Sentense Parser
# @version: 0.0.1
# @fileName: Nmea.class.php,
    Main Nmea protocol class defining methods and properties
# @date: December 21st, 2013
# @author: Derrick Muturi
# @appUrl: http://www.github.com/nmea-gpgga-simulator-parser
# @COPYRIGHTS: Refer to License File
----------------------------------------------------------------**/

class NMEA {
    
    protected $talker_id = '';
    protected $senteceID = '---';
    protected $description = '';
    protected $checksum = NULL;
    protected $status;

    public function __construct()
    {
        
    }
    
    /**
     * Check if the sentence is > 14 characters (min sentence count)
     *  and < 82 (max sentence count)
     *  
     * @param string, the nmea sentence we are checking
     * @return bool
     */
    public static function validSentenceLength($sentence)
    {
        if(strlen($sentence) >= MIN_STR_LENGTH && strlen($sentence) <= MAX_STR_LENGTH )
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    // If sentence is valid, explode it to get the field values
    public static function getFields($sentence)
    {
        // remove $ in the message to compute the CRC which is
        // bitwise ^ XOR of all characters between $ and * excluding the two symbols
        $string = substr($sentence, 1);
        // split sentence into array to get message & CRC
        $field = explode('*', $string);
        $message = $field[0];
        $checksum = $field[1];
        $checksum = trim($checksum);
        // generate checksum from message to compare the refernce checksum
        $CRC = self::generateCRC($message);
        // compare the crc and the checksum to see if they match
        
        (self::validateCRC($checksum, $CRC)) ? 
        $status = 'VALID' : $status = 'INVALID';
        
        // reconvert message to string to get the individual fields
        $message = array();
        $message[] = $field[0];
        $msg = implode($message);
        $fields = explode(',', $msg);
        
        $result = array(
            'field' => $fields,
            'status' => $status
        );
        
        return $result;
    }
     
    /**
     * Generate the CRC checksum which is the bitwise ^ XOR of
     *  all characters between $ and * in the sentence.
     *  
     * @param string the substring of the sentence we are gen a checksum for
     * @return hex 
     */
    protected static function generateCRC($message)
    {
        // Calculate checksum, begin at 0
        $crc = 0;
        for($i=0; $i<strlen($message); $i++)
        {
            //adding to the crc the XOR of the current value of checksum
            // + the ASCII code of the current character of the message on this iteration
            $crc = ($crc ^ ord($message {$i}));
            // Convert checksum to hex
            $CRC = dechex($crc);
        }
        return $CRC;
    }
       
    /**
     * Checksum reference is provided as a hex value after the * in the sentence.     *  all characters between $ and * in the sentence.
     *  check that the line passes checksum validation
     *  
     * @param int $arg1 referenced, int arg2 computed checksum
     * @return bool
     */
    protected static function validateCRC($checksum, $CRC)
    {
        if($checksum === $CRC)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    
}

?>