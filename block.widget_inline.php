<?php
/**
 * 规范代码
 *
 * Copyright (c) 2015 Baidu EXP Team
 * @see https://github.com/fex-team/fis-plus-smarty-plugin/blob/master/block.widget_inline.php
 * @example
 * {%widget_inline key='value'%}
 *     this block content is hello {%$key%}.
 * {%/widget_inline%}
 * @package fis-plus smarty plugin
 * @author  Yang,junlong at 2015-07-14 15:34:54 comments.
 * @version $Id: block.widget_inline.php 36962 2015-07-29 09:27:24Z yangjunlong $
 */

// 为了处理参数压栈，定义一个静态变量：参数栈
class FISBlockFisWidget{
    private static $_vars = array();
    /**
     * 压入栈中
     * 
     * @param  [type] $params    [description]
     * @param  [type] &$tpl_vars [description]
     * @return [void]            [description]
     */
    public static function push($params, &$tpl_vars) {
        self::$_vars[] = $tpl_vars;
        foreach($params as $key => $value) {
            if($value instanceof Smarty_Variable) {
                $tpl_vars[$key] = $value;
            } else {
                $tpl_vars[$key] = new Smarty_Variable($value);
            }
        }
    }
    /**
     * 出栈
     * 
     * @param  [type] &$tpl_vars [description]
     * @return [void]            [description]
     */
    public static function pop(&$tpl_vars) {
        $tpl_vars = array_pop(self::$_vars);
    }
}

/**
 * block widget_inline
 *
 * @example
 * {%widget_inline key='value'%}
 *     this block content is hello {%$key%}.
 * {%/widget_inline%}
 *
 * @param  [type]                   $params   [description]
 * @param  [type]                   $content  [description]
 * @param  Smarty_Internal_Template $template [description]
 * @param  [type]                   &$repeat  [description]
 * @return [type]                             [description]
 */
function smarty_block_widget_inline($params, $content, Smarty_Internal_Template $template, &$repeat) {
    if(!$repeat) {// block 定义结束
        FISBlockFisWidget::pop($template->tpl_vars);
        return $content;
    } else {// block 定义开始
        FISBlockFisWidget::push($params, $template->tpl_vars);
    }
}
