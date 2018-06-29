<?php

use yii\helpers\Html;
use backend\models\Page;

/* @var $this yii\web\View */
/* @var $order backend\models\Order */


?>
<!-- empty-cart-block start -->
<section class="page__section-main">
    <div class="frame frame_simple">
        <div class="frame__container">
            <div class="help-info">
                <div class="help-info__column help-info__column_left">
                    <h1 class="title title_size_l title-lowcase">Ваша корзина пуста.</h1>
                    <div class="help-info__link">
                        <a href="/" class="link">Вернуться на главную</a>
                    </div>
                </div>
                <div class="help-info__column help-info__column_right">
                    <img src="/img/help-info__image_empty.jpg" alt="Корзина пуста" class="help-info__image">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- empty-cart-block end -->