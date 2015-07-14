# fis-plus-smarty-plugin[百度经验版]

>基于FIS-PLUS，一套实现前端静态资源依赖分析的smarty插件集。

## 接入自动打包

安装插件

```javascript
npm install -g fis-postpackager-ext-map //在map.json中生成组件名Hash便于线上统计
npm install -g fis-packager-autopack     //自动合并插件
```

打开模块配置文件fis.conf，在配置文件底部添加以下配置

```javascript
fis.config.merge({
    modules: {
        postpackager: 'ext-map'
        //packager : 'autopack' 上线common插件第二天后开启使用
    },
    //插件参数设置
    settings: {
        packager : {
            autopack : {
                //fid为接入自动合并后分配的产品线FID字符串
                'fid' : 'exp'  
            }
        }
    }
});
```

## 在模板中使用

```html
<!DOCTYPE html>
{%html fid="exp" sampleRate="0.5" framework="common:static/lib/mod.js"%}
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
* [autopack](http://solar.baidu.com/autopack/doc)
