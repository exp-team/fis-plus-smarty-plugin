<?php
/**
 * 接管页面静态资源(css)的引入 head cssHook
 * 
 * Copyright (c) 2015 Baidu EXP Team
 * @see https://github.com/fex-team/fis-plus-smarty-plugin/blob/master/compiler.head.php
 * @example
 * {%head%}
 *     <meta charset="UTF-8" />
 *     <title>fis-plus</title>
 *     {%require name="demo:static/demo/demo.less"%}
 * {%/head%}
 * @package fis-plus smarty plugin
 * @author  Yang,junlong at 2015-07-14 16:06:44 commonts.
 * @version $Id: compiler.head.php 36962 2015-07-29 09:27:24Z yangjunlong $
 */

/**
 * {%head%} start
 * 
 * @param  [Array] $arrParams [description]
 * @param  [Smarty] $smarty    [description]
 * @return [String]            [description]
 */
function smarty_compiler_head($arrParams, $smarty) {
    $strAttr = '';
    foreach ($arrParams as $_key => $_value) {
        $strAttr .= ' ' . $_key . '="<?php echo ' . $_value . ';?>"';
    }
    return '<head' . $strAttr . '>';
}

/**
 * {%/head%} end
 * 
 * @param  [Array] $arrParams [description]
 * @param  [Smarty] $smarty    [description]
 * @return [String]            [description]
 */
function smarty_compiler_headclose($arrParams, $smarty) {
    $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISResource.class.php');
    $strCode = '<?php ';
    $strCode .= 'if(!class_exists(\'FISResource\', false)){require_once(\'' . $strResourceApiPath . '\');}';
    $strCode .= 'echo FISResource::cssHook();';
    $strCode .= '?>';
    $strCode .= '</head>';
    return $strCode;
}
