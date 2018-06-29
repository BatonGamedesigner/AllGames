<?php
/* @var $this yii\web\View */

use backend\models\Base;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Спасибо';
$this->params['breadcrumbs'][] = ['label' => $this->title];


?>

<section class="page__section-main">
    <div class="frame frame_simple">
        <div class="frame__container">
            <div class="help-info">
                <div class="help-info__column help-info__column_left">
                    <h1 class="title title_size_l title-lowcase"><?=$this->title?>!</h1>
                    <div class="help-info__label">Мы свяжемся с вами в ближайшее время.</div>
                    <div class="help-info__link">
                        <a href="/" class="link">Вернуться на главную</a>
                    </div>
                </div>
                <div class="help-info__column help-info__column_right">
                    <img src="/img/help-info__image_success.jpg" alt="Спасибо за покупку" class="help-info__image">
                </div>
            </div>
        </div>
    </div>
</section>