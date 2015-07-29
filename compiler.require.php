<?php
/**
 * 静态资源引入
 * 
 * Copyright (c) 2015 Baidu EXP Team
 * @see https://github.com/fex-team/fis-plus-smarty-plugin/blob/master/compiler.require.php
 * @example
 * {%require name="demo:static/demo/demo.less"%}
 * @package fis-plus smarty plugin
 * @author  Yang,junlong at 2015-07-14 16:20:40 commonts.
 * @version $Id: compiler.require.php 36962 2015-07-29 09:27:24Z yangjunlong $
 */

/**
 * {%require name="demo:static/demo/demo.less"%}
 *
 * @param  [type] $arrParams [description]
 * @param  [type] $smarty    [description]
 * @return [type]            [description]
 */
function smarty_compiler_require($arrParams, $smarty) {
    $strName = $arrParams['name'];
    $src = isset($arrParams['src']) ? $arrParams['src'] : false;
    $type = isset($arrParams['type']) ? $arrParams['type'] : 'null';
    $async = 'false';

    if (isset($arrParams['async'])) {
    	$async = trim($arrParams['async'], "'\" ");
    	if ($async !== 'true') {
    		$async = 'false';
    	}
    }

    $strCode = '';
    if($strName || $src) {
        $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISResource.class.php');
        $strCode .= '<?php if(!class_exists(\'FISResource\', false)){require_once(\'' . $strResourceApiPath . '\');}';
        if ($strName) {
            $strCode .= 'FISResource::load(' . $strName . ',$_smarty_tpl->smarty, '.$async.');';
        } else if (is_string($src)) {
            $strCode .= 'FISResource::addStatic(' . $src . ', ' . $type . ');';
        }
        $strCode .= '?>';
    }

    return $strCode;
}
