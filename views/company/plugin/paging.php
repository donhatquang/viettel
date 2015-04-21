<?php
use yii\helpers\Url;
use yii\helpers\Html;
/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/17/2015
 * Time: 6:34 PM
 * @param from finding.php
 */

?>

<!--PAGING-->

<nav>
    <ul class="pagination">
        <li>
            <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <!--CURRENT-->
        <!--<li class="active">
            <span>1 <span class="sr-only">(current)</span></span>
        </li>-->

        <?php

        for ($i=1;$i<=10;$i++) {

            // creates a URL to a route with parameters: /index.php?r=post/view&id=100
            //$urlParam = array_merge()
//            $url = Url::to('company/finding',$param);

            $param["page"] = $i;
            $url = Url::to($param);

            if ($current == $i) {
                $a = Html::tag("span",$i.'<span class="sr-only">(current)</span>');
                echo Html::tag("li", $a,["class" => "active"] );
            }

            else {
                $a = Html::a($i, $url);
                echo Html::tag("li", $a);
            }
        }
        ?>


        <li>
            <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
