<?php
//header('Content-Type: application/json');

use yii\helpers\Html;

$col = array_keys($data[0]);
$nodisplay = ["url"];


$current = $param["page"];


//json_encode
//d($col);
d($param);
?>

<!--INPUT-->
<form class="form-inline" method="get" action="">
    <div class="form-group">
        <label for="keyword">Name</label>
        <input type="text" class="form-control" id="keyword" placeholder="<?=$param["keyword"]?>" name="keyword">
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
