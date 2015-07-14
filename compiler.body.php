<?php
/**
 * 接管页面静态资源(javascript)的引入 body jsHook
 *
 * Copyright (c) 2015 Baidu EXP Team
 * @see https://github.com/fex-team/fis-plus-smarty-plugin/blob/master/compiler.body.php
 * @example
 * {%body id="body" class="body" data="{data:123}"%}
 *     ...
 *     this is page body content
 *     ...
 * {%/body%}
 * @package fis-plus smarty plugin
 * @author  Yang,junlong at 2015-07-14 15:58:40 commonts.
 * @version $Id$
 */

function smarty_compiler_body($arrParams,  $smarty) {
    $strAttr = '';
    foreach ($arrParams as $_key => $_value) {
        if (is_numeric($_key)) {
            $strAttr .= ' <?php echo ' . $_value .';?>';
        } else {
            $strAttr .= ' ' . $_key . '="<?php echo ' . $_value . ';?>"';
        }
    }
    return '<body' . $strAttr . '>';
}

function smarty_compiler_bodyclose($arrParams,  $smarty) {
    $strCode = '</body>';
    $strCode .= '<?php ';
    $strCode .= 'if(class_exists(\'FISResource\', false)){';
    $strCode .= 'echo FISResource::jsHook();';
    $strCode .= '}';
    $strCode .= '?>';
    return $strCode;
}
