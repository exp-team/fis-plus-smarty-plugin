<?php
/**
 * 接管模板页面中的html标签 结束标签时替换页面中的Hook
 * 
 * Copyright (c) 2015 Baidu EXP Team
 * @see https://github.com/fex-team/fis-plus-smarty-plugin/blob/master/compiler.html.php
 * @example
 * {%html id="html" class="html" framework=""%}
 *     {%head%}
 *     
 *     {%/head%}
 *     {%body%}
 *     
 *     {%/body%}
 * {%/html%}
 * @package fis-plus smarty plugin
 * @author  Yang,junlong at 2015-07-14 16:10:13 commonts.
 * @version $Id: compiler.html.php 36962 2015-07-29 09:27:24Z yangjunlong $
 */

/**
 * {%html%} ...
 * 
 * @param  [Array] $arrParams [description]
 * @param  [Smarty] $smarty    [description]
 * @return [String]            [description]
 */
function smarty_compiler_html($arrParams,  $smarty) {
    $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISResource.class.php');
    $strFramework = $arrParams['framework'];
    unset($arrParams['framework']);
    $strAttr = '';
    $strCode  = '<?php ';
    if (isset($strFramework)) {
        $strCode .= 'if(!class_exists(\'FISResource\', false)){require_once(\'' . $strResourceApiPath . '\');}';
        $strCode .= 'FISResource::setFramework(FISResource::getUri('.$strFramework.', $_smarty_tpl->smarty));';
    }
    $strCode .= ' ?>';

    foreach ($arrParams as $_key => $_value) {
        if (is_numeric($_key)) {
            $strAttr .= ' <?php echo ' . $_value .';?>';
        } else {
            $strAttr .= ' ' . $_key . '="<?php echo ' . $_value . ';?>"';
        }
    }

    return $strCode . "<html{$strAttr}>";
}

/**
 * {%/html%}
 * 
 * @param  [Array] $arrParams [description]
 * @param  [Smarty] $smarty    [description]
 * @return [String]            [description]
 */
function smarty_compiler_htmlclose($arrParams,  $smarty) {
    $strCode = '<?php ';
    $strCode .= '$_smarty_tpl->registerFilter(\'output\', array(\'FISResource\', \'renderResponse\'));';
    $strCode .= '?>';
    $strCode .= '</html>';
    return $strCode;
}
