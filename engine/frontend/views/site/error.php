<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'] = ['label' => $this->title];
?>

<section class="page__section-main">
    <div class="frame frame_simple">
        <div class="frame__container">
            <div class="help-info">
                <div class="help-info__column help-info__column_left">
                    <h1 class="title title_size_l title-lowcase"><?= Html::encode($this->title) ?></h1>
                    <div class="help-info__message"><?= nl2br(Html::encode($message)) ?></div>
                    <div class="help-info__label help-info__label_indent">«Эй, приятель, потерялся?»</div>
                    <div class="user-content">
                        Это не ты нашёл Чака Нориса, а он тебя!<br>
                        Сейчас он тебя вернёт на <a href="/" class="link">главную страницу</a>
                    </div>
                </div>
                <div class="help-info__column help-info__column_right">
                    <img src="/img/help-info__image_chuck.jpg" alt="Чак Норрис" class="help-info__image">
                </div>
            </div>
        </div>
    </div>
</section>