var currentCity = {

    id: null,
    name: null,

    contructor: function (id, name) {
        this.id = id;
        this.name = name;
        this.init();
    },

    init: function () {

        /**/
        $("#city-target span").text(this.name);

        /*form input*/
        $("#input-city").val(this.id);
        $("#input-cityName").val(this.name);

        console.log(currentCity);
    },
    reset: function () {

        this.contructor(100000, "全国");
        $("#input-search_type").val(3);
        $("#search_form").submit();
    }

}

var effect = function () {

    var location = province.concat(city).concat(area);

    $('#typeahead-city').typeahead({
        source: location

    }).change(function () {

        var current = $(this).typeahead("getActive");
        if (current) {

            console.log(current);
            var id = current.id;
            var name = current.name;
            currentCity.contructor(id, name);
        }
    });


    /*COMPANY BTN*/
    $(".company-btn").click(function () {

        window.location = "?r=company/detail";
    });

    /*SEARCH TYPE*/
    $("input[name=searchtype]").change(function () {

        $("#input-search_type").val($(this).val());

        console.log($(this).val());
    })

    /*HIDDEN*/
    setInterval(function () {

        var iframe = $('.goog-te-banner-frame:first').contents();
        iframe.find(".goog-logo-link").css("display", "none");

        //console.log(iframe.find(".goog-logo-link").css("display"));

    }, 100);

    return;
}

var timer = 0;

var autoTranslate = function () {


    if ($("#goog-gt-tt").length != 0) {

        var Langname = lang.name.split(" ")[0];
        var condition = ".goog-te-menu2-item:contains('" + Langname + "')";

        var item = $("#goog-gt-tt").next("iframe").contents().find(condition);

        clearInterval(timer);

        try {
            item[0].click();
        }
        catch (e) {
            console.log(e);
        }

        //console.log(item);

        return true;
    }

    else
        return false;
};

/**
 * Created by nhatquang on 4/28/2015.
 */


$(function () {

    Soqi.province();

    effect();

    /*AUTO TRANSLATE*/
    timer = setInterval(autoTranslate, 500);


})