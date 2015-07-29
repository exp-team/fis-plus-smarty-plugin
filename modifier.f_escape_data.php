<?php
/**
 * {%f_escape_data%}
 * 
 * @param  string $str [description]
 * @return string      [description]
 */
function smarty_modifier_f_escape_data($str){

    $js_char_keys = array('<','>', "'", '"', '\\', "\n", "\r", "/");
    $js_char_values = array('&lt;', '&gt;', "\\&#39;", '\\&quot;', "\\\\", "\\n", "\\r", "\\/");

    $str = strval($str);
    $ret = str_replace($js_char_keys, $js_char_values, $str);
    return $ret;
}