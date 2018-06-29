<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\models\Page;

/* @var $this yii\web\View */
/* @var $review backend\models\Review */
/* @var $form ActiveForm */

?>

<div class="section section_padded">
    <div class="wrapper wrapper_size_s">
        <?php \yii\widgets\Pjax::begin() ?>
        <?php if (!empty($message)): ?>
            <p style="text-align: center; font-size: 18px"><strong><?= $message ?></strong></p>
        <?php else: ?>

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => "form js-request" . \backend\models\Review::tableName(), 'data-pjax' => true]]); ?>
            <div class="title title_size_s">Оставить отзыв</div>
            <div class="page__section-xs">
                <div class="user-content">
                    Вы можете оставить свои пожелания и отзыв о работе магазина и других служб компании.
                </div>
            </div>
            <div class="form__field">
                <?= $form->field($model, 'name')->textInput(['placeholder' => 'Ваше имя*'])->label(false) ?>
            </div>
            <div class="form__field">
                <?= $form->field($model, 'tel')->textInput(['placeholder' => 'Ваш телефон или email*'])->label(false) ?>
            </div>
            <div class="form__field">
                <?= $form->field($model, 'text')->textarea(['placeholder' => 'Ваш отзыв*'])->label(false) ?>
            </div>
            <div class="form__field">
                <?= $form->field($model, 'reCaptcha')
                    ->widget(\himiklab\yii2\recaptcha\ReCaptcha::className(),
                        [
                            'siteKey' => $this->params['reCapthaKey'],
                        ]
                    )
                    ->label(false)
                ?>
            </div>
            <div class="form__field">
                <?= $form->field($uploadModel, 'f[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label(false) ?>
            </div>
            <div class="form__field">
                <?= $form->field($model, 'agree',
                    [
                        'template' => '<div class="checkbox">{input}{label}</div>{hint}{error}',
                    ])
                    ->checkbox([
                        'class' => 'checkbox__input',
                        'id' => 'agreement',
                    ], false)
                    ->label('Я согласен(а) на обработку <a class="link" href="' . $this->params[Page::PAGE_PREFIX . Page::PRIVACY]['linkOut'] . '">персональных данных.</a>', ['class' => 'checkbox__label', 'for' => 'agreement']); ?>
            </div>
            <div class="form__field">
                <?= Html::submitButton(\Yii::t('app', 'Отправить'), ['class' => 'button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        <? endif ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>


