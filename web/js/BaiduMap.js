var BaiduMap = {

    /*private*/
    map: null,
    panorama: null,
    maker: null,


    getInfo: function (data) {

        var template = $("#searchInfo-tmpl").html();
        var obj = $(template);

        /*HERE CAN TRAVELLING OBJECT*/
        //OBJ
        /**/

        var content = $('<div>').append(obj.clone()).html();

        //创建检索信息窗口对象
        //var searchInfoWindow = null;
        var searchInfoWindow = new BMapLib.SearchInfoWindow(this.map, content, {
            title: "百度大厦",      //标题
            width: 500,             //宽度
            height: 150,              //高度
            panel: "panel",         //检索结果面板
            enableAutoPan: true,     //自动平移
            searchTypes: [
                BMAPLIB_TAB_SEARCH,   //周边检索
                BMAPLIB_TAB_TO_HERE,  //到这里去
                BMAPLIB_TAB_FROM_HERE //从这里出发
            ]
        });

        return searchInfoWindow;
    },
    currentLocation: function () {

        /* var geolocationControl = new BMap.GeolocationControl();
         geolocationControl.addEventListener("locationSuccess", function(e){
         // 定位成功事件
         var address = '';
         address += e.addressComponent.province;
         address += e.addressComponent.city;
         address += e.addressComponent.district;
         address += e.addressComponent.street;
         address += e.addressComponent.streetNumber;
         alert("当前定位地址为：" + address);
         });
         geolocationControl.addEventListener("locationError",function(e){
         // 定位失败事件
         alert(e.message);
         });

         map.addControl(geolocationControl);*/
    },

    constructor: function () {

        // 百度地图API功能
        var map = new BMap.Map("allmap");

        var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
        var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
        var top_right_navigation = new BMap.NavigationControl({

            anchor: BMAP_ANCHOR_TOP_RIGHT,
            type: BMAP_NAVIGATION_CONTROL_SMALL

        }); //右上角，仅包含平移和缩放按钮

        /*缩放控件type有四种类型:
         BMAP_NAVIGATION_CONTROL_SMALL：仅包含平移和缩放按钮；BMAP_NAVIGATION_CONTROL_PAN:仅包含平移按钮；BMAP_NAVIGATION_CONTROL_ZOOM：仅包含缩放按钮*/
        map.addControl(top_left_control);
        map.addControl(top_left_navigation);
        //map.addControl(top_right_navigation)

        map.addControl(new BMap.MapTypeControl({anchor: BMAP_ANCHOR_BOTTOM_RIGHT}));    //左上角，默认地图控件

        //map.addControl(new BMap.OverviewMapControl());              //添加默认缩略地图控件
        //map.addControl(new BMap.OverviewMapControl({isOpen:true, anchor: BMAP_ANCHOR_TOP_RIGHT}));   //右上角，打开;


        //var mapType1 = new BMap.MapTypeControl({mapTypes: [BMAP_NORMAL_MAP, BMAP_HYBRID_MAP]});
        var mapType2 = new BMap.MapTypeControl({anchor: BMAP_ANCHOR_TOP_LEFT});

        var overView = new BMap.OverviewMapControl();
        var overViewOpen = new BMap.OverviewMapControl({isOpen: true, anchor: BMAP_ANCHOR_BOTTOM_RIGHT});

        //map.addControl(mapType1);          //2D图，卫星图
        map.addControl(mapType2);          //左上角，默认地图控件
        map.addControl(overView);          //添加默认缩略地图控件
        map.addControl(overViewOpen);      //右下角，打开

        /*滚动*/
        map.enableScrollWheelZoom(true);

        /*事件*/
        map.addEventListener("tilesloaded", function () {

            console.log("地图加载完毕");
            /*FIX TABLE*/
            $(".BMapLib_nav_tab_content td").attr({width: ""});


        });

        this.map = map;

        /*PANORAMA*/
        this.panoramaConstructor();

        return;
    },

    /*全景*/
    panoramaConstructor: function () {

        var opt = {
            albumsControlOptions: {
                anchor: BMAP_ANCHOR_BOTTOM_LEFT
            },
            albumsControl: true
        }

        //var param = param || opt;
        /*PANORAMA CONTROL*/
        var stCtrl = new BMap.PanoramaControl({anchor: BMAP_ANCHOR_TOP_RIGHT}); //构造全景控件
        stCtrl.setOffset(new BMap.Size(30, 30));
        this.map.addControl(stCtrl);//添加全景控件

        //GET PANORAMA SPACE
        var panorama = this.map.getPanorama();

        //console.log(panorama);

        /*OPTION*/
        panorama.setOptions(opt);

        //this.map.setPanorama(panorama);
        this.panorama = panorama;

        return;
    },

    showPOI: function(param) {

        /*POI DATA in MAP*/
        var panorama = this.panorama;

        panorama.setPanoramaPOIType(BMAP_PANORAMA_POI_CATERING); //餐饮
        panorama.setPov({pitch: 6, heading: 138}); //手动参数，场景内已有该室内景，旋转后可见，现调整角度到该POI点的位置，方便开发者可见

        return;
    },

    bindingMarker: function () {

        var marker = this.maker;

        /*OPEN INFO WINDOWS*/
        var searchInfoWindow = this.getInfo();
        searchInfoWindow.open(marker);

        marker.addEventListener("click", function (e) {
            console.log(e);
            searchInfoWindow.open(marker);
        });
    },

    /*SET UP THE MAP PARAM*/
    execute: function (param) {

        var map = this.map;

        var pos = param.position || {lng: 116.316169, lat: 40.005567};
        var city = param.city || "上海市";

        //if (param.position != null) {

        var point = new BMap.Point(pos.lng, pos.lat);
        var marker = new BMap.Marker(point);  // 创建标注

        map.setCurrentCity(city);        //由于有3D图，需要设置城市哦

        /*GET POSITION BASE ON GEO NAME*/
        if (param.address != null) {

            // 创建地址解析器实例
            var myGeo = new BMap.Geocoder();
            // 将地址解析结果显示在地图上,并调整地图视野
            myGeo.getPoint(param.address, function (point) {
                if (point) {

                    /*ANOTATION*/
                    var marker = new BMap.Marker(point);

                    map.centerAndZoom(point, 16);
                    map.addOverlay(marker);

                    /*窗口显示*/
                    BaiduMap.maker = marker;
                    BaiduMap.bindingMarker();


                } else {
                    alert("您选择地址没有解析到结果!");
                }
            }, city);
        }
        else {

            map.addOverlay(marker);              // 将标注添加到地图中
            map.centerAndZoom(point, 20);

            /*窗口显示*/
            BaiduMap.maker = marker;
            BaiduMap.bindingMarker();
            /* */
        }

        /*get the lng and lat*/
        /*map.addEventListener("click", function (e) {
         //console.log(e);
         //return false;
         });*/




        return;
    }

}
/**
 * Created by nhatquang on 4/24/2015.
 */
