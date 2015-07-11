# fis-plus-smarty-plugin[百度经验]

>基于FIS-PLUS，一套实现前端静态资源依赖分析的smarty插件集。

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
