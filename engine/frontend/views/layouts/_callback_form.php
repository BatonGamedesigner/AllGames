<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use backend\models\Page;

/* @var $this yii\web\View */
/* @var $form ActiveForm */
?>
<!-- callback_form start-->
<?php \yii\widgets\Pjax::begin() ?>
<?php if ($this->params['message']): ?>
    <div class="title title_size_s title_centered">Спасибо!</div>
    <div class="page__section-xs" style="text-align: center;">
        <?= $this->params['message'] ?>
    </div>
<?php else: ?>
    <div class="title title_size_s title_centered">Что вы хотите спросить?</div>
    <div class="page__section-xs">
        <?php $form = ActiveForm::begin(['options' => ['class' => "form", 'data-pjax' => true]]); ?>
        <div class="form__field">
            <?= $form->field($this->params['callback'], 'fio')->textInput(['placeholder' => 'Ваше имя*'])->label(false) ?>
        </div>
        <div class="form__field">
            <?= $form->field($this->params['callback'], 'contact')->textInput(['placeholder' => 'Ваш телефон или email*'])->label(false) ?>
        </div>
        <div class="form__field">
            <?= $form->field($this->params['callback'], 'message')->textarea(['placeholder' => 'Ваш вопрос*'])->label(false) ?>
        </div>
        <div class="form__field">
            <?= $form->field($this->params['callback'], 'reCaptcha')
                ->widget(\himiklab\yii2\recaptcha\ReCaptcha::className(),
                    [
                        'siteKey' => $this->params['reCapthaKey'],
                    ]
                )
                ->label(false)
            ?>
        </div>

        <div class="form__field">
            <?= $form->field($this->params['callback'], 'agree',
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
    </div>
<?php endif; ?>
<?php \yii\widgets\Pjax::end(); ?>
<!-- callback_form -->
