<?php
/**
 * 收集页面中的样式资源, 并输出到页面
 * 
 * Copyright (c) 2015 Baidu EXP Team
 * @see https://github.com/fex-team/fis-plus-smarty-plugin/blob/master/compiler.style.php
 * @example
 * {%style id="demo"%}
 *     //TODO stylesheet
 * {%/style%}
 * @package fis-plus smarty plugin
 * @author  Yang,junlong at 2015-07-14 16:27:12 comments.
 * @version $Id: compiler.style.php 36962 2015-07-29 09:27:24Z yangjunlong $
 */

/**
 * {%style id="demo"%}
 * 
 * @param  [Array] $params [description]
 * @param  [Smarty] $smarty [description]
 * @return [String]         [description]
 */
function smarty_compiler_style($params, $smarty) {
    $strCode = '<?php ';
    if (isset($params['id'])) {
        $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISResource.class.php');
        $strCode .= 'if(!class_exists(\'FISResource\', false)){require_once(\'' . $strResourceApiPath . '\');}';
        $strCode .= 'FISResource::$cp = ' . $params['id'].';';
    }
    $strCode .= 'ob_start();?>';
    return $strCode;
}

/**
 * {%/stype%}
 * 
 * @param  [Array] $params [description]
 * @param  [Smarty] $smarty [description]
 * @return [String]         [description]
 */
function smarty_compiler_styleclose($params, $smarty) {
    $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISResource.class.php');
    $strCode  = '<?php ';
    $strCode .= '$style=ob_get_clean();';
    $strCode .= 'if($style!==false){';
    $strCode .= 'if(!class_exists(\'FISResource\', false)){require_once(\'' . $strResourceApiPath . '\');}';
    $strCode .=     'if(FISResource::$cp){';
    $strCode .=         'if (!in_array(FISResource::$cp, FISResource::$arrEmbeded)){';
    $strCode .=             'echo "<style type=\'text/css\'>" . $style . "</style>";';
    $strCode .=             'FISResource::$arrEmbeded[] = FISResource::$cp;';
    $strCode .=         '}';
    $strCode .=     '} else {';
    $strCode .=         'echo "<style type=\'text/css\'>" . $style . "</style>";';
    $strCode .=     '}';
    $strCode .= '}';
    $strCode .= 'FISResource::$cp = false;?>';
    return $strCode;
}
