<script language="JavaScript" src="assets/soqi/city.js"></script>

<script language="JavaScript">

    var Soqi = {

        city: function() {

            /*
            * City(cid, cpid, cname)
            * */

            for (i in province) {

                var item = province[i];
                var id = item.id;
                var pid = item.pid;
                var name = item.name;

                var li = $("<li/>");
                li.html('<a href="#profile" tabindex="-1" role="tab" id="'+id+'-tab" data-toggle="tab" aria-controls="profile">'+name+'</a>');
                li.click(function() {

                    var name = $(this).text();

                    $("#profile").html("");
                    $("<p/>").html(name).appendTo("#profile");

                }).appendTo("#cityTabDrop");

                //$("<p/>").html(name).appendTo("#profile");

                console.log(item);
            }
         }
    }

   window.onload = (function(){

        Soqi.city();
    });

</script>

<h2 id="tabs-examples">City selection</h2>
<p>Add quick, dynamic tab functionality to transition through panes of local content, even via dropdown menus.</p>
<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs" role="tablist">
        <li role="presentation" class="dropdown">
            <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">全国<span class="caret"></span></a>

            <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="cityTabDrop">
              <!--  <li><a href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">@fat</a></li>
                <li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">@mdo</a></li>-->
            </ul>
        </li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledBy="home-tab">
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledBy="profile-tab">

        </div>

    </div>
</div><!-- /example -->