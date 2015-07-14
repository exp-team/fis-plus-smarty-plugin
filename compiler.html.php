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
 * @version $Id$
 */

function smarty_compiler_html($arrParams, $smarty) {
    $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISResource.class.php');
    $strFramework = $arrParams['framework'];
    unset($arrParams['framework']);
    $strAttr = '';
    $strCode  = '<?php ';
    if (isset($strFramework)) {
        $strCode .= 'if(!class_exists(\'FISResource\', false)){require_once(\'' . $strResourceApiPath . '\');}';
        $strCode .= 'FISResource::setFramework(FISResource::getUri('.$strFramework.', $_smarty_tpl->smarty));';
    }

    /********************autopack init********************************/
    $strAutoPackPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/FISAutoPack.class.php');
    $strCode .= 'if(!class_exists(\'FISAutoPack\', false)){require_once(\'' . $strAutoPackPath . '\');}';
    $fid = $arrParams['fid'];
    $sampleRate = $arrParams['sampleRate'];
    unset($arrParams['fid']);
    unset($arrParams['sampleRate']);
    if (isset($fid)){
        $strCode .= 'FISAutoPack::setFid('.$fid.');';    
    }
    if (isset($sampleRate)){
        $strCode .= 'FISAutoPack::setSampleRate('.$sampleRate.');';  
    }
    //set page tpl
    $template_dir = $smarty->getTemplateDir();
    $template_dir = str_replace('\\', '/', $template_dir[0]);
    $strCode .= '$tpl=str_replace("\\\\", "/", $_smarty_tpl->template_resource);';
    $strCode .= 'FISAutoPack::setPageName(str_replace("' . $template_dir . '", "", $tpl));';
    /*********************autopack end*******************************/
    
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

function smarty_compiler_htmlclose($arrParams, $smarty) {
    $strCode = '<?php ';
    $strCode .= '$_smarty_tpl->registerFilter(\'output\', array(\'FISResource\', \'renderResponse\'));';
    $strCode .= '?>';
    $strCode .= '</html>';
    return $strCode;
}
