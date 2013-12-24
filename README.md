# NMEA 0183 GPGGA PHP Parser

This software simulates a stream of Time, position and fix related data
(GPGGA) for a GPS receiver.

* SUPPORTED SENTENCES
    
    * GPGGA

# Installation

To run the sample application requires a web server as the aplication is written in PHP.

You can use WAMP server http://www.sourceforge.org/wamp
After getting WAMP or XAMP and installing it on your machine, Grab the all
the code in this project folder as a zip and if on wamp extract to the folder
www found in C:/wamp/www/

Start wamp server by clicking its icon on your desktop and go to your browser
and type in http://localhost/NMEA

	*Click Stream Simulation
	*Click Parse sentence Stream
	*Click Try serial port stream

# Simulate stream

Php this may not give the implied meaning of streaming as php uses
blocking I/O, that is, processing occurs step by step hence all data
is read once and proccesed as a single block.

The streaming is best achived using Node.js that uses none blocking I/O.

For this simulation, Nmea GPGGA strings will be read from a log file (gga-log.txt)
and the contents written to a web page.

For better simulation, go the configuration file at configure/conf.php and set your
environmental variables, if on a Linux OS change serial port to '/dev/ttyS0' or 'COM1',
on windows change it to 'COM1' (OR anything between COM1-9, finding the right one is problematic),
on mac '/dev/tty.serial',
then connect GPS device to a serial port and start this application in your browser,
the app will listen to that port as Nmea strings are emmitted to the buffer,
capture them and write them to file.

Sentences are simulated one per second, i.e. it simulates GPS with a
1 Hz NMEA stream.

# Sentence processing & parsing

The Nmea strings are read from the gga-log.txt file a line at a time
simulating an input stream and are checked for minimum and maximum length
14 and 82 respectively, computes the checksum of the message and compares if
the checksum computed matches the reference checksum supplied in the message.

The processed string is then parsed (decoded) and the output streamed to a file (parsed.txt)
in JSON format where it can be used by a 3rd party application such as a mobile phone,
a web app or decoded right into a database.
(JSON is light weight as compared to XML and is very portable as well).

It takes PHP seconds to parse this data. My benchmark test with a log of 60 lines
took about 4 seconds on a 1GB RAM laptop.

# References & Attributions

* NMEA 0183 GPGGA reference http://aprs.gids.nl/nmea/#gga
* NMEA sample log courtesy http://freenmea.net/Home/NmeaEmitter
* Php-serial authored by Rémy Sanchez

