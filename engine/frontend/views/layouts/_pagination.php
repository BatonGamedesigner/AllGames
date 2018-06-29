<?php

use yii\widgets\LinkPager;
use backend\models\Base;

?>
<?= LinkPager::widget([
    'pagination' => $pages,
    'activePageCssClass' => 'active',
    'prevPageLabel' => '<svg class="pagination__icon"><use xlink:href="#icon-arrow-down"></use></svg>',
    'nextPageLabel' => '<svg class="pagination__icon pagination__icon_next"><use xlink:href="#icon-arrow-down"></use></svg>',
    'options' => ['class' => 'pagination'],

]) ?>
