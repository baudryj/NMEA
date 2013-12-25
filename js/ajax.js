/**
 * On DOM ready, asynchronously opens and reads nmea log file
 *  at an interval of 1 second writes nmea data to the page
 *  simulating a 1 HZ GPS device streaming NMEA GPGGA sentences
 *
 * The stream is automatically timed out and ended after 10 seconds
 *  so as to prevent memory flooding resulting from an infinite read & write.
 **/
$(document).ready(function(){
 
        $.ajax({
            url : 'readStream.php',
            type : 'get',
            success : function(result)
            {
                var data = $.parseJSON(result);
                var ID = setInterval(function(){
                        if (data.length) {
                            $.each(data, function(i, val){
                               $('#streamUpdate').append(val + "<br/>");
                            });
                        }
                        else{
                            // all data displayed end simulation
                            clearInterval(ID);
                        }
                        setTimeout(function(){
                                clearInterval(ID);
                        }, 10000);
                    }, 1000);
                }
        });
});