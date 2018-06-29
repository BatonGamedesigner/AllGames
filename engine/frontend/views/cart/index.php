<?php
/* @var $this yii\web\View */

/* @var $product  \backend\models\Product */


use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\models\Base;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = ['label' => $this->title];


$this->registerJsFile('/js/cart/cart.js', ['position' => \yii\web\View::POS_END, 'depends' => 'yii\web\YiiAsset']);
?>
<? if (!empty($products)): ?>
<section class="page__section">
    <h1 class="title title_size_l"><?= $this->title ?></h1>

    <div class="page__section-main">
        <div class="row row_headers">
            <div class="row__item row__item_photo">Фото</div>
            <div class="row__item row__item_large">Наименование товара и описание</div>
            <div class="row__item row__item_fix">Цена</div>
            <div class="row__item row__item_fix">Количество</div>
            <div class="row__item row__item_fix">Стоимость</div>
            <div class="row__item row__item_small"></div>
        </div>
        <? foreach ($products as $cart_id => $product): ?>
            <div id="product_<?= $cart_id ?>" class="row">
                <div class="row__wrapper">
                    <div class="row__item row__item_photo">
                        <div class="adjuster adjuster_bordered">
                            <canvas class="adjuster__canvas" width="1" height="1"></canvas>
                            <img class="adjuster__image"
                                 src="<?= $product->getSRCPhoto(['index' => 0, 'suffix' => '_cart']) ?>"
                                 alt="<?= $product->name ?>">
                        </div>
                    </div>
                    <div class="row__item row__item_large">
                        <div class="information">
                            <div class="title title_size_s title_low">
                                <?= $product->name ?>
                            </div>
                            <? if (!empty($product->paramsBuf)): ?>
                                <? array_pop($product->paramsBuf)?>
                                <ul class="information__list">
                                    <? foreach ($product->paramsBuf as $param): ?>
                                        <li class="information__item"><?= $param->name . ': ' . $param->value ?></li>
                                    <? endforeach; ?>
                                </ul>
                            <? endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row__item row__item_fix">
                    <div class="price"><?= number_format($product->cost+$product->paramsTotalCost, 0, '', '&nbsp;') ?>&nbsp;р.</div>
                </div>
                <div class="row__item row__item_fix">
                    <div class="count-select">
                        <div id="<?= $cart_id ?>_minus" class="count-select__item count-select__item_button"></div>
                        <div class="count-select__item">
                            <input id="count_field__<?= $cart_id ?>" class="count-select__input"
                                   prodID="<?= $cart_id ?>" type="number" value="<?= $product->count ?>">
                        </div>
                        <div id="<?= $cart_id ?>_plus"
                             class="count-select__item count-select__item_button count-select__item_button_minus"></div>
                    </div>
                </div>
                <div class="row__item row__item_fix">
                    <div id="total_<?= $cart_id ?>"
                         class="price"><?= number_format($product->amount, 0, '', '&nbsp;') ?>&nbsp;р.
                    </div>
                </div>
                <div class="row__item row__item_small row__item_full">
                    <a href="javascript:;" class="button-large" prodID="<?= $cart_id ?>">
                        <svg class="button-large__icon">
                            <use xlink:href="#icon-bin"></use>
                        </svg>
                    </a>
                </div>
            </div>
        <? endforeach; ?>
        <div class="result result_indent">
            <div class="result__item">Итого:</div>
            <div class="result__item">
                <div id="prod-price" class="price"><?= number_format($_SESSION['cart']['total_sum'], 0, '', '&nbsp;') ?>&nbsp;р.
                </div>
            </div>
        </div>
    </div>
</section>
<? require_once('_order_form.php'); ?>

<? else: ?>
    <? require_once('_empty_cart.php'); ?>
<? endif ?>

