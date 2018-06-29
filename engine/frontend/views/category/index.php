<?php
/* @var $this yii\web\View */

use backend\models\Category;


$this->params['breadcrumbs'][] = ['label' => \Yii::t('app', \backend\models\Category::NAME)];
//$this->registerJsFile('/js/price-list/price-list.js',['position'=>\yii\web\View::POS_END, 'depends'=>'yii\web\YiiAsset']);
?>


<section class="page__section">
    <h1 class="title title_size_l"><?= Category::NAME ?></h1>

    <div class="page__section-main">
        <div class="grid-half">
            <? foreach ($models as $item): ?>
                <? /* @var $item Category */ ?>
                <? $src = $index !== null ? $item->getSRCPhoto(['suffix' => '_sm', 'index' => $index]) : $item->getSRCPhoto(['suffix' => '_sm']) ?>
                <? $count = $item->getProducts()->count() ?>
                <div class="grid-half__item">
                    <a class="ticket" href="<?= $item->linkOut ?>">
                        <img class="ticket__image" src="<?= $src ?>" alt="<?= $item->name ?>">
                        <div class="ticket__caption">
                            <div class="ticket__title"><?= $item->name ?></div>
                            <div class="ticket__description"><?= \backend\models\Base::inclination($count)?></div>
                        </div>
                    </a>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>
