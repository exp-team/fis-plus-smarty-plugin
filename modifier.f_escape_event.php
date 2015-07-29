<?php
/**
 * {%$xss | f_escape_event%}
 *
 * @param  string $str [description]
 * @return string      [description]
 */
function smarty_modifier_f_escape_event($str){
    $map_array_keys = array( '&','<','>',"\\","'",'"',"\n","\r","/");
    $map_array_values = array('&amp;','&lt;','&gt;',"\\\\","\\&#39;","\\&quot;","\\n","\\r","\\/");

    $str = strval($str);
    return str_replace($map_array_keys, $map_array_values, $str);
}
