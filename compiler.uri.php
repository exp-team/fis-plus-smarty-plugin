<?php
/**
 * 获取静态资源地址
 * 
 * Copyright (c) 2015 Baidu EXP Team
 * @see https://github.com/fex-team/fis-plus-smarty-plugin/blob/master/compiler.uri.php
 * @example
 * <img src="{%url name="demo:widget/test/img/test.png"%}" />
 * @package fis-plus smarty plugin
 * @author  Yang,junlong at 2015-07-14 16:29:29 commonts.
 * @version $Id: compiler.uri.php 36962 2015-07-29 09:27:24Z yangjunlong $
 */

/**
 * 
 * 
 * @param  [Array] $arrParams [description]
 * @param  [Smarty] $smarty    [description]
 * @return [String]            [description]
 */
function smarty_compiler_uri($arrParams, $smarty) {
    $strName = $arrParams['name'];
    $strCode = '';
    if($strName){
        $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISResource.class.php');
        $strCode .= '<?php if(!class_exists(\'FISResource\', false)){require_once(\'' . $strResourceApiPath . '\');}';
        $strCode .= 'echo FISResource::getUri(' . $strName . ',$_smarty_tpl->smarty);';
        $strCode .= '?>';
    }
    return $strCode;
}
