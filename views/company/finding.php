<?php
//header('Content-Type: application/json');

use yii\helpers\Html;


/* @var $this yii\web\View */
/*$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;*/

/*MAIN DATABASE DATA*/
//$lang = ($data["lang"]);
$data = $data["company"];
//d($lang);

/*PAGING*/
$current = $param["page"];

/*INIT*/
<<<<<<< HEAD

$col = array_keys($data[0]);
=======
$col = 0;
if (count($data) != 0)
    $col = array_keys($data[0]);

>>>>>>> origin/master
$nodisplay = ["url"];

//var_dump($col);

?>
<script language="javascript">

</script>

<style type="text/css">

    .flags img {
        margin: 5px;
    }
</style>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">

                <a class="navbar-brand" href="#">Search</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">

                <!--INPUT-->
                <form class="navbar-form navbar-left" method="get" action="" id="search_form">
                    <div class="form-group">

                        <input type="text" class="form-control" id="keywords" value="<?= $param["keywords"] ?>"
                               placeholder="<?= $param["keywords"] ?>" name="keywords">
                    </div>

                    <?php

                    $param["page"] = 1;

                    foreach ($param as $key => $value) {

                        if (!in_array($key, ["keywords"]))

                            echo Html::tag("input", "", [
                                "name" => $key,
                                "value" => $value,
                                "type" => "hidden",
                                "id" => "input-" . $key,

                            ]);
                    }
                    ?>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-success" data-toggle="collapse" href="#collapseExample" aria-expanded="true"
                       aria-controls="collapseExample">
                        Filter
                    </a>

                    <?php
                 //   require("plugin/translate.php");
                    ?>

                    <div style="margin: 10px;" class="flags">
                        <img src="images/Flag_of_Cambodia.png" height="50" />
                        <img src="images/Flag_of_the_China.png" height="50" />
                    </div>

                </form>




            </div>
        </div>
    </nav>




    <!--FILTER-->
    <div class="row">

        <div class="collapse in" id="collapseExample">

            <?php
            require("plugin/city.php");
            ?>

        </div>

    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>

            <?php
            if ($col != 0) {
            foreach ($col as $item) {
                if (!in_array($item, $nodisplay))
                    echo Html::tag("th", strtoupper($item));
            }}
            ?>

        </thead>
        <tbody>

        <?php

        //var_dump($data);

        /*FETCH DATA*/
        if ($col != 0)
        foreach ($data as $id => $item) {

            /*FIRST COLUMN*/
            $tr = Html::tag("th", $id + 1, ["scope" => "row"]);

            foreach ($item as $key => $value) {
                //  if (!in_array($key, $nodisplay))

                if ($key == "url") {

                    $text = Html::tag("button", '<span class="glyphicon glyphicon-home" aria-hidden="true"></span>', [

                        "type" => "button",
                        "class" => "btn btn-primary company-btn",

                        // "data-toggle" => "modal",
                        // "data-target" => "#myModal",
                        "data-url" => $value,
                        "data-title" => $item["title"]

                    ]);
                    $tr .= Html::tag("td", $text);
                } else

                    $tr .= Html::tag("td", $value);
            }

            echo Html::tag("tr", $tr);
        }

        ?>

        </tbody>
    </table>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <!--<iframe width="100%" height="600" frameborder="0" allowtransparency="false" src="http://www.soqi.cn/detailCont/id_0792MLZY9RIM_3.html"></iframe>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <!--PAGING-->


<?php

// Usage without a model (with search term highlighting)
//echo '<label class="control-label">State</label>';
/*echo TypeaheadBasic::widget([
    'name' => 'state_10',
    'data' => ['']
    //'data' =>  ['do nhat quang','linh mashi'],
    //'options' => ['placeholder' => 'Filter as you type ...'],
    //'pluginOptions' => ['highlight'=>true],
]);*/

require("plugin/paging.php");

