<?php
/**
 * {%$xss | f_escape_xml%}
 * 
 * @param  string $str [description]
 * @return string      [description]
 */
function smarty_modifier_f_escape_xml($str){
    $xml_search_array = array('&', '<', '>', '\'', '"');
    $xml_value_array = array('&amp;', '&lt;', '&gt;', '&#39;', '&quot;');

    return str_replace($xml_search_array, $xml_value_array, strval($str));
}
