<?php
/**
 * 设置httpresponse的头部
 * 
 * File:  compiler.setheader.php
 * Author:  shen zhou(shenzhou1982@gmail.com)
 * Modifier:  shen zhou(shenzhou1982@gmail.com)
 * Modified:  2011-10-26 15:14:52
 * 
 * 参数：
 * type:设置返回类型，默认是html，其它类型为：html/json/javascript/xml/js
 * 其中js=javascript；
 * 
 * charset:设置编码：默认是utf-8编码
 * Copyright:  (c) 2011-2021 baidu.inc
 * @example
 * {%http_header type="json" charset="utf-8"%}
 * @author Yang,junlong at 2015-07-03 16:45:32 update.
 * @version $Id: function.http_header.php 36962 2015-07-29 09:27:24Z yangjunlong $
 */

/**
 * {%http_header type="html" charset="UTF-8"%}
 * 
 * @param  [type] $params  [description]
 * @param  [type] &$smarty [description]
 * @return [type]          [description]
 */
function smarty_function_http_header($params, &$smarty) {
    $DEFAULT_MIME = 'html';
    $DEFAULT_CHARSET = 'utf-8';
    $type = (empty($params['type'])) ? $DEFAULT_MIME : $params['type'];
    $charset = (empty($params['charset'])) ? $DEFAULT_CHARSET : $params['charset']; // UTF-8 ? GBK
    $mimeTypes = array(
        'html' => 'text/html',
        'json' => 'application/json',
        'javascript' => 'application/x-javascript',
        'js' => 'application/x-javascript',
        'xml' => 'text/xml',
        'stream' => 'application/octet-stream',
    );
    if (array_key_exists($type, $mimeTypes)) {
        $mime = $mimeTypes[$type];
    } else {
        $mime = "text/plain";
    }
    header("Content-Type:$mime; charset=$charset;");
}
