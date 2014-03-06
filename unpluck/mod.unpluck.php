<?php
/**
 * Modifier_unpluck
 * filter to strip out specific string from content 
 * used in conjunction with excerpt filter 
 * const 'marker_start' and 'marker_end'should be the same as in mod.pluck.php
 * @author  Clay Harmon
 * 
 */
class Modifier_unpluck extends Modifier
{
    const marker_start = '[=';
    const marker_end = '=]';


    public function index($string, $parameters=array()) {
        
        $string = str_replace(self::marker_start,"",$string);
        $string = str_replace(self::marker_end,"",$string);
        
        return $string;
    }
}