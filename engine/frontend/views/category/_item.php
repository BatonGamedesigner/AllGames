<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 10.05.2016
 * Time: 17:16
 */

use yii\bootstrap\Html;
use yii\helpers\HtmlPurifier;

//print_r($model); die;
$models = (!empty($otherProducts)) ? $otherProducts : $models;


?>
<? if (isset($models)): ?>
    <div class="<?= (!empty($otherProducts)) ? 'items-slider__wrapper swiper-wrapper' : 'grid' ?>">
        <? foreach ($models as $item): ?>
            <? /* @var $item \backend\models\Product */ ?>
            <? $cost = $item->cost; ?>
            <? if (!empty($item->params)): ?>
                <? foreach ($item->params as $param): ?>
                    <? $options = json_decode($param->value) ?>
                    <? $cost += $options[0]->cost; ?>
                <? endforeach; ?>
            <? endif; ?>
            <div class="<?= (!empty($otherProducts)) ? 'items-slider__slide swiper-slide' : 'grid__item' ?>">
                <a href="<?= $item->linkOut ?>" class="card">
                    <? $src = $index !== null ? $item->getSRCPhoto(['suffix' => '_md', 'index' => $index]) : $item->getSRCPhoto(['suffix' => '_md']) ?>
                    <? if ($item->flags > 0): ?>
                        <div class="card__badge">
                            <?= $item->AllFlagsAsArray()[$item->flags] ?>
                        </div>
                    <? endif; ?>
                    <img class="card__image swiper-lazy" src="<?= $src ?>" alt="<?= $item->name ?>">
                    <div class="card__content">
                        <span class="card__title"><?= $item->name ?></span>
                        <div class="card__price"><?= number_format($cost, 0, '', ' ') ?>&nbsp;&#8381;</div>
                    </div>
                </a>
            </div>
        <? endforeach; ?>
    </div>
<? else: ?>
    <p>Продукты данной категории ещё не добавлены</p>
<? endif; ?>