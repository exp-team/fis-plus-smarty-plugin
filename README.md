# fis-plus-smarty-plugin[百度经验版]

>基于FIS-PLUS，一套实现前端静态资源依赖分析的smarty插件集。

当前版本：exp-v1.5.0代码优化注释版

## 在模板中使用

```html
<!DOCTYPE html>
{%html framework="common:static/lib/mod.js"%}
    <!--STATUS OK-->
    {%head%}
        {%require name="common:static/css/base.less"%}
        {%placeholder type="css"%}
        {%style%}
            body{
                color: #333;
            }
        {%/style%}
    {%/head%}
{%body id="body" class="body"%}
    <img src="{%uri name="static/img/logo.png"%}" />
    {%widget name="home:widget/home/home.tpl"%}
    {%script%}
        var test = 'hello world!';
        console.log(test);
    {%/script%}
{%/body%}
{%/html%}
```
## 更多资料

* [fis](https://github.com/fex-team/fis) 前端集成解决方案
* [fis-plus](https://github.com/fex-team/fis-plus)
