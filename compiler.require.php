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
 * @version $Id$
 */

function smarty_compiler_require($arrParams, $smarty){
    $strName = $arrParams['name'];

    $async = 'false';

    if (isset($arrParams['async'])) {
        $async = trim($arrParams['async'], "'\" ");
        if ($async !== 'true') {
            $async = 'false';
        }
    }

    $strCode = '';
    if($strName) {
        $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISResource.class.php');
        $strCode .= '<?php if(!class_exists(\'FISResource\', false)){require_once(\'' . $strResourceApiPath . '\');}';
        $strCode .= 'FISResource::load(' . $strName . ',$_smarty_tpl->smarty, '.$async.');';

        /********autopack collect require resource************/
        $strAutoPackPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISAutoPack.class.php');
        $strCode .= 'if(!class_exists(\'FISAutoPack\')){require_once(\'' . $strAutoPackPath . '\');}';
        $strCode .= 'FISAutoPack::addHashTable(' . $strName . ',$_smarty_tpl->smarty' . ');';
        /*****************autopack end**********************/
        
        $strCode .= '?>';
    }
    return $strCode;
}
