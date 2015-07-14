<?php
/**
 * 页面静态资源占坑用的~~ js & css 预留接口 暂无用
 * 
 * Copyright (c) 2015 Baidu EXP Team
 * @see https://github.com/fex-team/fis-plus-smarty-plugin/blob/master/compiler.placeholder.php
 * @example
 * {%placeholder type="modjs"%}
 * @package fis-plus smarty plugin
 * @author  Yang,junlong at 2015-07-14 16:15:51 comments.
 * @version $Id$
 */

function smarty_compiler_placeholder($arrParams,  $smarty) {
    $strCode = '<?php ';
    $strType = $arrParams['type'];
    $strCode .= 'if(class_exists(\'FISResource\', false)){';
    $strCode .= 'echo FISResource::placeHolder(' . $strType .');}';
    $strCode .= '?>';
    return $strCode;
}
