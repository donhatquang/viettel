<?php
//header('Content-Type: application/json');
//exit();
use yii\helpers\Html;

$city = $data["city"];
$data = $data["company"];


//var_dump($data);
//exit();

$col = array_keys($data[0]);
$nodisplay = ["url"];

//var_dump($param);
//exit();

$current = $param["page"];
//var_dump($current);

//json_encode
//d($col);
//d($param);
?>

<?php
require ("plugin/city.php");
?>


<!--INPUT-->
<form class="form-inline" method="get" action="">
    <div class="form-group">
        <label for="keyword">Name</label>
        <input type="text" class="form-control" id="keyword" placeholder="<?=$param["keywords"]?>" name="keyword">
    </div>

    <?php

        $param["page"] = 1;

        foreach ($param as $key=>$value) {

            if (!in_array($key,["keyword"]))
            echo Html::tag("input","", [
                "name" => $key,
                "value" => $value,
                "type" => "hidden"
            ]);
        }
    ?>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>

      <?php
        foreach ($col as $item){
            if (!in_array($item,$nodisplay))
                echo Html::tag("th",$item);
        }
       ?>

    </thead>
    <tbody>

    <?php

    /*FETCH DATA*/
    foreach ($data as $id=>$item) {

        $tr = Html::tag("th",$id+1, ["scope"=> "row"]);

        foreach ($item as $key=>$value) {
            if (!in_array($key,$nodisplay))
                $tr .= Html::tag("td", $value);
        }

        echo  Html::tag("tr",$tr);
    }

    ?>

    </tbody>
</table>

<!--PAGING-->
<?php
require ("plugin/paging.php");

