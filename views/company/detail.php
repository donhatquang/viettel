<?php
/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/23/2015
 * Time: 6:41 PM
 */

var_dump($data);

?>
<style type="text/css">

    body, html {
        width: 100%;
        height: 100%;
        margin: 0;

    }


    #allmap {
        width: 100%;
        height: 100%;
        overflow: hidden;
         position: absolute; left: 0px; top: 0px;
        z-index: 10000;
        /*top: 10%;*/
    }



    .tmpl {
        display: none;
    }

</style>


<div class="row">
    <div id="allmap" class="col-md-12" style="">
       MAP LOADING
    </div>
</div>

<!--<table class="table table-striped">
    <tbody>
    <tr>
        <th style="width: 30%;">公司名称：</th>
        <td style="width: 70%;">广州翔鸽服装有限公司</td>
        <iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe>
    </tr>
    <tr class="bgcolor">
        <th style="color: green;">公司类型：</th>
        <td>有限责任公司</td>
    </tr>
    <tr>
        <th>经营模式：</th>
        <td>暂无数据</td>
    </tr>
    <tr class="bgcolor">
        <th>主营产品：</th>
        <td>暂无数据</td>
    </tr>
    <tr>
        <th>经营地址：</th>
        <td>广东省广州市番禺区广州市番禺区南村镇塘埗西龙祥大道18-22号五层<a href="javascript:getMap();" style="float: right;padding-right: 25px;">查看地图</a>
        </td>
    </tr>
    <tr class="bgcolor">
        <th>邮编：</th>
        <td>511446</td>
    </tr>


    </tbody>
</table>-->


<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=aajaYCAgZMHgoffcVkk6EEK7"></script>
<script type="text/javascript"
        src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css"/>

<script type="text/javascript">


    window.onload = function () {

        BaiduMap.constructor();
        BaiduMap.execute({
            address: "徐家汇",
            city: "上海"
        });

        /*setInterval(function() {

         if ($(document).fullScreen() == false) {

         $('#allmap').css({
         height: 600
         });
         }

         },500);*/

    }

    function fullscreen() {

        $('#allmap').css({
            height: "100%"
        });
        $("#allmap").fullScreen(true);

        return;
    }


</script>

<div id="searchInfo-tmpl" class="tmpl">

    <div class="media">
        <div class="media-left media-middle">
            <a href="#">
                <img src="http://i.telegraph.co.uk/multimedia/archive/02552/empire_2552202b.jpg" class="media-object" style="width: 200px;" alt="pic">

            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">Media heading</h4>
            <p>地址：北京市海淀区上地十街10号<br/>电话：(010)59928888<br/>简介：百度大厦位于北京市海淀区西二旗地铁站附近，为百度公司综合研发及办公总部</p>

        </div>
    </div>


</div>

<button type="button" class="btn btn-primary btn-lg" onclick="fullscreen();">
    Launch demo modal
</button>
<button type="button" class="btn btn-primary btn-lg" onclick="$(document).fullScreen(false);">
    Exit fuilscreen
</button>