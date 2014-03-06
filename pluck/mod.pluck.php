<?php
/**
 * Modifier_pluck
 * returns portion of string between defined markers marker_start and marker_end
 * characters used for markers are tricky - some get parsed by either slim or php and send it to the moon
 * the ones below DO work, and seem to make some sense
 * @author  Clay Harmon
 *   
 */
class Modifier_pluck extends Modifier
{
    const marker_start = '[=';
    const marker_end = '=]';
    const more_string = ' &rArr;';

    public function index($value, $parameters=array()) {
        
        

        if( ($beg = strpos($value,self::marker_start) + strlen(self::marker_start)) && ( $end = strpos($value, self::marker_end) ) )  
        //test for existence of markers in string and just return original if false
        {	
	        
            $length = $end  - $beg;

            $value = substr($value, $beg, $length).self::more_string;
	        
	        return $value;
    	}
    	else return $value;
    }
}
