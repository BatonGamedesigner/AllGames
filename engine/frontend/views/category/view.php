<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

//use backend\assets\FancyBoxAsset;
//FancyBoxAsset::register($this);

$this->params['breadcrumbs'] = $this->context->getBreadcrumbs($model->id);
$index = 0;
?>

<section class="page__section">
    <h1 class="title title_size_l"><?= $model->name ?></h1>
    <? if (!empty($banners)): ?>
        <div class="main-slider swiper-container js-main-slider">
            <div class="main-slider__wrapper swiper-wrapper">
                <? foreach ($banners as $banner): ?>
                    <? /* @var $banner \backend\models\CategoryPhoto */ ?>
                    <div class="slide swiper-slide">
                        <img class="slide__image swiper-lazy" alt="<?= $banner->name ?>"
                             data-src="<?= $banner->getSRCPhoto(['suffix' => '_sm','parent_id' => $model->id]) ?>">
                    </div>
                <? endforeach; ?>
            </div>
            <div class="main-slider__pagination js-main-slider__pagination"></div>
            <div class="main-slider__button js-main-slider__prev">
                <svg class="main-slider__icon">
                    <use xlink:href="#icon-arrow-down"></use>
                </svg>
            </div>
            <div class="main-slider__button main-slider__button_next js-main-slider__next">
                <svg class="main-slider__icon">
                    <use xlink:href="#icon-arrow-down"></use>
                </svg>
            </div>
        </div>
    <? endif; ?>
    <div class="page__section-main">

        <?= $this->render('_item', compact('models', 'index')); ?>
    </div>
</section>
<div class="page__section">
    <?= $this->render('@frontend/views/layouts/_pagination.php', compact('pages')) ?>
</div>





