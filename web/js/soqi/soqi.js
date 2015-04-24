/*CREATED BY NHAT QUANG*/
var Soqi = {

    province: function () {

        /*
         * City(cid, cpid, cname)
         * */
        var obj = this;

        for (i in province) {

            var item = province[i];
            var id = item.id;
            var pid = item.pid;
            var name = item.name;

            var li = $("<li/>");
            li.html('<a href="#profile" tabindex="-1" role="tab" id="' + id + '" data-toggle="tab" aria-controls="profile">' + name + '</a>');
            li.click(function () {

                var name = $(this).text();
                var id = $(this).find("a").attr("id");


                $("#myTabDrop1").text(name);

                /*LIST CITY OF PROVINCE*/
                obj.city(id);

                currentCity.contructor(id, name);

            }).appendTo("#cityTabDrop");

            //$("<p/>").html(name).appendTo("#profile");

            //console.log(item);
        }
    },

    /*CITY*/
    city: function (pid) {

        var obj = this;
        var callback = function () {

            var id = $(this).attr("rel");
            var name = $(this).text();

            currentCity.contructor(id, name);

            obj.district(id, name);

        };

        obj.cityBtn(pid, city, "#profile", callback);

        console.log(pid);

        return;
    },

    /*DISTRICT*/
    district: function (pid, pname) {

        var obj = this;

        /*CHECK EXIST*/
        if ($("#" + pid + '-tab').length != 0) {

            $("#" + pid + '-tab').tab("show");
            return;
        }

        /*ADD TAB*/
        var li = $("<li/>").attr({role: "presentation"}); //.addClass("active");
        li.html('<a href="#panel-' + pid + '" id="' + pid + '-tab" role="tab" data-toggle="tab" aria-controls="profile"aria-expanded="true">' + pname + '</a>');
        li.appendTo("#myTab");

        /*ADD CONTENT*/
        var div = $("<div/>").attr({

            role: "tabpanel",
            id: "panel-" + pid,
            "aria-labelledBy": pid + "-tab"

        }).addClass("tab-pane fade");

        div.appendTo("#myTabContent");

        /*LIST*/
        var callback = function () {

            var id = $(this).attr("rel");
            var name = $(this).text();

            currentCity.contructor(id, name);

            console.log(currentCity);
        };

        obj.cityBtn(pid, area, "#panel-" + pid, callback);

        return;
    },

    /*FORMAT*/
    cityBtn: function (pid, source, target, callback) {

        $(target).html("");
        console.log(target);

        /*LIST CITY*/
        for (i in source) {

            var item = source[i];

            if (pid == item.pid) {

                console.log(pid);

                var id = item.id;
                var name = item.name;

                /*CITY BUTTON*/
                var btn = $("<button/>").attr({
                    id: "btn-" + id,
                    type: "button",
                    rel: id

                }).click(callback).addClass("btn btn-default city").text(name);

                btn.appendTo(target);
            }
        }

        return;
    }

    /*END SOQI*/
};
/**
 * Created by nhatquang on 4/22/2015.
 */
