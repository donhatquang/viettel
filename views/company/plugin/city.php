
<style>
    .city {
        margin: 5px;
    }
</style>

<script language="JavaScript">

    var currentCity = {

        id: null,
        name: null,

        contructor: function (id, name) {
            this.id = id;
            this.name = name;
            this.init();
        },

        init: function () {

            /**/$("#city-target span").text(this.name);

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


    window.onload = (function () {

        Soqi.province();

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
        $(".company-btn").click(function() {

            window.location = "?r=company/detail";
        });

        /*SEARCH TYPE*/
        $("input[name=searchtype]").change(function() {

            $("#input-search_type").val($(this).val());

            console.log($(this).val());
        })

    });

</script>


<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                   aria-controls="collapseOne">
                    Location Filter
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">

                <!--CITY TAB-->
                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">

                    <ul id="myTab" class="nav nav-tabs" role="tablist" class="active">
                        <li role="presentation" class="dropdown">
                            <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"
                               aria-controls="myTabDrop1-contents">Province<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="cityTabDrop">

                                <!--PROVINCE LIST HERE-->


                            </ul>
                        </li>

                        <!--LIST-->
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <!--<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledBy="home-tab">
                            Searching city
                        </div>-->
                        <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledBy="profile-tab">

                        </div>

                    </div>
                </div>
                <!-- /example -->


                        <!--LOCATION-->
                        <form class="form-inline" method="get" action="">
                            <div class="form-group">
                                <label for="typeahead-city"> </label>
                                <input type="text" class="form-control" placeholder="City" id="typeahead-city" autocomplete="off">
                            </div>

                            <button type="button" class="btn btn-primary" onclick="currentCity.reset();">Reset</button>
                        </form>
                    </div>

                <!-- <h4 id="city-target" class="inline"><span
                                style="font-weight: bold;"></span></h4>-->

            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Library</a></li>
                <li class="active" id="city-target"><span><?= $param["cityName"] ?></span></li>
            </ol>


        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                   aria-expanded="false" aria-controls="collapseTwo">
                    Search type
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">

                <div class="btn-group btn-group-justified" data-toggle="buttons">

                    <label class="btn btn-primary active btn-lg">
                        <input type="radio" name="searchtype" id="option1" autocomplete="off" checked value="0"> Company
                    </label>
                    <label class="btn btn-primary btn-lg">
                        <input type="radio" name="searchtype" id="option2" autocomplete="off" value="1"> Product
                    </label>
                    <label class="btn btn-primary btn-lg">
                        <input type="radio" name="searchtype" id="option3" autocomplete="off" value="2"> Address
                    </label>
                </div>


            </div>
        </div>
    </div>

</div>




