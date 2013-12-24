<?php
/**--------------------------------------------------------------
# @appName: NMEA 0183 GPGGA Simulator & Sentense Parser
# @reference: http://aprs.gids.nl/nmea/#gga
# @version: 0.0.1
# @fileName: GGA.class.php,
    GGA sentense type, class defining methods, properties & structure
# @date: December 21st, 2013
# @author: Derrick Muturi
# @appUrl: http://www.github.com/nmea-gpgga-simulator-parser
# @COPYRIGHTS: Refer to License File
----------------------------------------------------------------/
# Global Positioning System Fix Data
# Time, Position and fix related data for a GPS receiver
/------------------------------------------------------------------------
    0    1         2      3  4       5 6 7   8   9  10 11 12 13  14   15
    |    |         |      |  |       | | |   |   |  |  |  |  |   |    |
 $--GGA,hhmmss.ss,llll.ll,a,yyyyy.yy,a,x,xx,x.x,x.x,M,x.x,M,x.x,xxxx*hh
-------------------------------------------------------------------------/

 Field Number:
 
 0) Talker ID and Sentence type identifier
 1) Time (UTC)
 2) Latitude
 3) N or S (North or South)
 4) Longitude
 5) E or W (East or West)
 6) GPS Quality Indicator,
      0 - fix not available,
      1 - GPS fix,
      2 - Differential GPS fix
 7) Number of satellites in view, 00 - 12
 8) Horizontal Dilution of precision
 9) Antenna Altitude above/below mean-sea-level (geoid)
10) Units of antenna altitude, meters
11) Geoidal separation, the difference between the WGS-84 earth ellipsoid and mean-sea-level (geoid), "-" means mean-sea-level below ellipsoid
12) Units of geoidal separation, meters
13) Age of differential GPS data, time in seconds since last SC104 type 1 or 9 update, null field when DGPS is not used
14) Differential reference station ID, 0000-1023
15) Checksum
**/

require_once 'NMEA.php';

class GGA extends NMEA {
    
    private $UTC;
    private $latitude;
    private $N_S;
    private $longitude;
    private $E_W;
    private $quality;
    private $satsInView;
    private $HDOP;
    private $antennaAlt;
    private $antennaAltMetres;
    private $geoidSeparation;
    private $geoidSeparationMetres;
    private $age;
    private $refStationId;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->talker_id = 'GP';
        $this->senteceID = 'GGA';
        $this->description = 'Fix Data';
    }
    
    // Decodes the sentence and returns field values if sentence is validated
    public function parseSentence($sentence)
    {
        if(NMEA::validSentenceLength($sentence))
        $fields = NMEA::getFields($sentence);
    
        $this->UTC = $fields['field'][1];
        $this->latitude = $fields['field'][2];
        $this->N_S = $fields['field'][3];
        $this->longitude = $fields['field'][4];
        $this->E_W = $fields['field'][5];
        $this->quality = $fields['field'][6];
        $this->satsInView = $fields['field'][7];
        $this->HDOP = $fields['field'][8];
        $this->antennaAlt = $fields['field'][9];
        $this->antennaAltMetres = $fields['field'][10];
        $this->geoidSeparation = $fields['field'][11];
        $this->geoidSeparationMetres = $fields['field'][12];
        $this->age = $fields['field'][13];
        $this->refStationId = $fields['field'][14];
        $this->status = $fields['status'];
        
        $ParsedData = array(
            'talker' => $this->talker_id,
            'sentenceID' => $this->senteceID,
            'description' => $this->description,
            'UTC' => $this->UTC,
            'latitude' => $this->latitude,
            'N|S' => $this->N_S,
            'longitude' => $this->longitude,
            'E|W' => $this->E_W,
            'quality' => $this->quality,
            'satsInView' => $this->satsInView,
            'HDOP' => $this->HDOP,
            'antennaAlt' => $this->antennaAlt,
            'antennaAltMetres' => $this->antennaAltMetres,
            'geoidSeparation' => $this->geoidSeparation,
            'geoidSeparationMetres' => $this->geoidSeparationMetres,
            'updateAge' => $this->age,
            'referenceStationID' => $this->refStationId,
            'status' => $this->status
        );
        
        return json_encode($ParsedData);
    }
    
}
?>