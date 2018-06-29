<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Page;

/* @var $this yii\web\View */
/* @var $callback backend\models\CallbackProject */
/* @var $form ActiveForm */


$this->registerJsFile('https://www.google.com/recaptcha/api.js', ['position' => \yii\web\View::POS_END, 'depends' => 'yii\web\YiiAsset']);

?>

<?php if ($this->params['callback']['message']): ?>
    <div class="title title_size_s">Обратная связь</div>
    <div class="page__section-xs">
        <div class="user-content">
            <?= $this->params['callback']['message'] = 'Спасибо! Наши менеджеры свяжутся с Вами в ближайшее время.'; ?>
        </div>
    </div>
<?php else: ?>
    <div class="title title_size_s">Обратная связь</div>
    <div class="page__section-xs">
        <div class="user-content">
            Задайте Ваши вопросы или выскажите пожелания!<br>
            Поля отмеченные звездочкой обязательны к заполнению.
        </div>
    </div>
    <?php $form = ActiveForm::begin(['options' => ['class' => "form", 'data-pjax' => true]]); ?>

    <div class="form__field">
        <?= $form->field($this->params['callback'], 'fio')
            ->textInput(['placeholder' => 'Ваше имя*'])
            ->label(false);
        ?>
    </div>
    <div class="form__field">
        <?= $form->field($this->params['callback'], 'contact')
            ->textInput(['placeholder' => 'Ваш телефон или email*'])
            ->label(false);
        ?>
    </div>
    <div class="form__field">
        <?= $form->field($this->params['callback'], 'message')
            ->textarea(['placeholder' => 'Сообщение*', 'rows' => 6])
            ->label(false);
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
        <?= Html::submitButton('Отправить', ['class' => 'button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php endif; ?>