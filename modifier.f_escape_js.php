<?php
/**
 * {%$xss | f_escape_js%}
 * 
 * @param  string $str [description]
 * @return string      [description]
 */
function smarty_modifier_f_escape_js($str){
    $map_array_keys = array("\\","'","\"","/","\n","\r");
    $map_array_values = array("\\\\","\\x27","\\x22","\\/","\\n","\\r");

    $str = strval($str);
    return str_replace($map_array_keys, $map_array_values, $str);
}