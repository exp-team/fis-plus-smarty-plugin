<?php
/**
 * xss 过滤
 * 
 * @param  [type]  $callback [description]
 * @param  integer $len      [description]
 * @return [type]            [description]
 */
function smarty_modifier_f_escape_callback($callback, $len = 50){
    $forbiddenStart_array = array('window', 'document', 'alert', 'location');

    $callback = substr($callback, 0, $len);    //MAX_LENGTH
    $callback = preg_replace('/[^\w\.]/', '' ,$callback);
    $callbackSplit = explode('.', $callback);
    $first = strtolower($callbackSplit[0]);
    if(in_array($first, $forbiddenStart_array) || strpos($first, '.alert') !== false){
        return false;
    }
    return $callback;
}
