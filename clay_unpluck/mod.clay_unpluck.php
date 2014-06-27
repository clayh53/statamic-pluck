<?php
/**
 * Modifier_clay_unpluck
 * filter to strip out specific string from content 
 * used in conjunction with excerpt filter 
 * const 'marker_start' and 'marker_end'should be the same as in mod.pluck.php
 * @author  Clay Harmon
 * 
 */
class Modifier_clay_unpluck extends Modifier
{
    public function index($string, $parameters=array())
    {
	    $marker_start = array_get($this->config, 'marker_start', '[=');
        $marker_end = array_get($this->config, 'marker_end', '=]');    

        $string = str_replace($marker_start, '', $string);
        $string = str_replace($marker_end, '', $string);
        
        return $string;
    }
}