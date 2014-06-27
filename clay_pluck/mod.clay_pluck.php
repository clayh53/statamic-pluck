<?php
/**
 * Modifier_pluck
 * returns portion of string between defined markers marker_start and marker_end
 * characters used for markers are tricky - some get parsed by either slim or php and send it to the moon
 * the ones below DO work, and seem to make some sense
 * @author  Clay Harmon
 *   
 */
class Modifier_clay_pluck extends Modifier
{
    public function index($value, $parameters=array())
    {
        $marker_start = array_get($this->config, 'marker_start', '[=');
        $marker_end = array_get($this->config, 'marker_end', '=]');
        $more_string = array_get($this->config, 'more_string', '&rArr;');

        //test for existence of markers in string and just return original if false
        if (   ($beg = strpos($value, $marker_start) + strlen($marker_start))
            && ($end = strpos($value, $marker_end))) {
        
            $length = $end  - $beg;

            return substr($value, $beg, $length) . $more_string;
    	}
    	
        return $value;
    }
}
