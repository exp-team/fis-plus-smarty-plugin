<?php
/**
 * 收集页面中的javascript资源, 添加到脚本pool中, 便于同样在页面底部输出
 * 
 * Copyright (c) 2015 Baidu EXP Team
 * @see https://github.com/fex-team/fis-plus-smarty-plugin/blob/master/compiler.script.php
 * @example
 * {%script id="demo" priority="10"%}
 *     //TODO javascript code
 * {%/script%}
 * @package fis-plus smarty plugin
 * @author  Yang,junlong at 2015-07-14 16:24:32 comments.
 * @version $Id$
 */

function smarty_compiler_script($params, $smarty) {
    $strPriority = isset($params['priority']) ? $params['priority'] : '0';
    $strCode = '<?php ';
    if (isset($params['id'])) {
        $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISResource.class.php');
        $strCode .= 'if(!class_exists(\'FISResource\', false)){require_once(\'' . $strResourceApiPath . '\');}';
        $strCode .= 'FISResource::$cp = ' . $params['id'].';';
    }
    $strCode .= '$fis_script_priority = ' . $strPriority . ';';
    $strCode .= 'ob_start();?>';
    return $strCode;
}

function smarty_compiler_scriptclose($params, $smarty){
    $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISResource.class.php');
    $strCode  = '<?php ';
    $strCode .= '$script=ob_get_clean();';
    $strCode .= 'if($script!==false){';
    $strCode .=     'if(!class_exists(\'FISResource\', false)){require_once(\'' . $strResourceApiPath . '\');}';
    $strCode .=     'if(FISResource::$cp) {';
    $strCode .=         'if (!in_array(FISResource::$cp, FISResource::$arrEmbeded)){';
    $strCode .=             'FISResource::addScriptPool($script, $fis_script_priority);';
    $strCode .=             'FISResource::$arrEmbeded[] = FISResource::$cp;';
    $strCode .=         '}';
    $strCode .=     '} else {';
    $strCode .=         'FISResource::addScriptPool($script, $fis_script_priority);';
    $strCode .=     '}';
    $strCode .= '}';
    $strCode .= 'FISResource::$cp = null;?>';
    return $strCode;
}
