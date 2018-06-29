<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $callback backend\models\Callback */
/* @var $form ActiveForm */
?>

<div class="section section_padded">
    <div class="wrapper wrapper_size_s">
        <?php \yii\widgets\Pjax::begin() ?>
        <?php if ($message): ?>
            <p style="text-align: center; font-size: 18px"><strong><?= $message ?></strong></p>
        <?php else: ?>
            <?php $form = ActiveForm::begin(['options' => ['class' => "request js-request" . \backend\models\Callback::tableName(), 'data-pjax' => true]]); ?>
                <div class="title js-request__title" data-title-submit="Спасибо, мы скоро с Вами свяжемся!">
                    <?=\Yii::t('app', 'Понравились проекты?')?>
                </div>
                <p class="request__text">
                    <?=\Yii::t('app', 'Оставьте свои данные, чтобы договориться о встрече в нашем комфортном офисе')?>
                </p>
                <div class="request__form">
                    <div class="request__input">
                        <?= $form->field($callback, 'fio')->textInput(['placeholder' => \Yii::t('app', 'Введите ваше имя')])->label(false) ?>
                    </div>
                    <div class="request__input">
                        <?= $form->field($callback, 'tel')->textInput(['placeholder' => \Yii::t('app', 'Ваш телефон или e-mail')])->label(false) ?>
                    </div>
                    <div class="request__input request__input_button">
                        <div class="form-group">
                            <?= Html::submitButton(\Yii::t('app', 'Отправить'), ['class' => 'button button_rounded button_dark button_wide']) ?>
                        </div>
                    </div>
                </div>
            </form>
            <?php ActiveForm::end(); ?>
        <? endif ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>


