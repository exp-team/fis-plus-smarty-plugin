<?php
/**
 * 设置自动打包首屏完成
 * 
 * FIS-PLUS Smarty Plugin Autopack
 *
 * @see http://gitlab.baidu.com/fis-dev/fis-plus-smarty-plugin/blob/autopack-fisplus/compiler.setfs.php
 * @author Yang,junlong at 2015-07-03 16:49:08 update.
 * @version $Id: compiler.setfs.php 36496 2015-07-09 06:51:44Z scmpf $
 */

function smarty_compiler_setfs($params, $smarty) {
    $strCode = '';
    $strCode .= '<?php ';
    $strCode .= 'if (class_exists("FISAutoPack", false)) {';
    $strCode .= 'FISAutoPack::setFRender();'; //设置自动打包首屏完成
    $strCode .= '}';
    $strCode .= ' ?>';
    return $strCode;
}
