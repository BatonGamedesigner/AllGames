<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\UserRole;
use frontend\models\SignupForm;
use yii\widgets\Pjax;

$this->title = SignupForm::NAME;
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('/js/signup/signup.js', ['position' => \yii\web\View::POS_END, 'depends' => 'yii\web\YiiAsset']);

/*$this->registerJs(<<<EOF

setTimeout(function(){
    document.getElementById("form-signup").reset();
}, 200);
EOF
);*/
?>

<h1><?= SignupForm::NAME ?></h1>
<section>
<!--    --><?php //Pjax::begin()?>
    <?php $form = ActiveForm::begin(['id' => 'form-signup',
        'enableAjaxValidation' => true,
        'enableClientValidation'=>false,
        'validateOnSubmit'=>false,
        'options' => [
        'class' => 'form form-container', 'data-pjax' => true
    ]]); ?>
    <div id="form-section-js" class="form-section" data-entity-status="<?=UserRole::STATUS_ENTITY?>" data-user-status="<?=UserRole::STATUS_USER?>">
        <?= $form->field($model, 'status', [
            'template' => "{label}\n<div class=\"styled-select\">{input}</div>\n{hint}\n{error}"])
            ->dropDownList(UserRole::getRoleUserForSignUp()) ?>
        <div class="form-section__group form-section__group--data">
            <div class="form-section__subtitle">данные регистрации
            </div>
            <div class="row">
                <div class="form-section__column">
                    <?= $form->field($model, 'email', [
                        'labelOptions' => ['class' => 'control-label required']])->textInput(['placeholder' => 'example@email.com']) ?>

                    <?= $form->field($model, 'password', [
                        'labelOptions' => ['class' => 'control-label required']])->passwordInput() ?>

                    <?= $form->field($model, 'confirmPassword', [
                        'labelOptions' => ['class' => 'control-label required']])->passwordInput() ?>
                </div>
            </div>
        </div>
        <div id="user-block-js"  class="form-section__group form-section__group--data">
            <div class="form-section__subtitle">ваши данные
            </div>
            <div class="row">
                <div class="form-section__column">
                    <?= $form->field($model, 'username', [
                        'labelOptions' => ['class' => 'control-label']])->textInput(['placeholder' => 'Имя']) ?>
                    <?= $form->field($model, 'surname', [
                        'labelOptions' => ['class' => 'control-label']])->textInput(['placeholder' => 'Фамилия']) ?>
                    <?= $form->field($model, 'middlename', [
                        'labelOptions' => ['class' => 'control-label']])->textInput(['placeholder' => 'Отчество']) ?>
                </div>
                <div class="form-section__column">

                    <?= $form->field($model, 'userPhone', [
                        'labelOptions' => ['class' => 'control-label']])->textInput(['placeholder' => '+7 (8412) 12-34-56'])
                        ->label('Контактный телефон <span>(пожалуйста, укажите код города)</span>') ?>

                </div>
            </div>
        </div>
        <div id="entity-block-js" style="display: none;" class="form-section__group form-section__group--data">
            <div class="form-section__subtitle">данные об организации
            </div>
            <div class="row">
                <div class="form-section__column">
                    <?= $form->field($model, 'nameCompany', [
                        'labelOptions' => ['class' => 'control-label required']])->textInput(['placeholder' => 'ООО Кооператив Озеро']) ?>
                    <?= $form->field($model, 'inn', [
                        'labelOptions' => ['class' => 'control-label required']])->textInput(['placeholder' => '1234567890']) ?>
                    <?//= $form->field($model, 'fioChief', [
                       // 'labelOptions' => ['class' => 'control-label required']])->textInput(['placeholder' => 'Иванов Иван Иванович']) ?>
                </div>
                <div class="form-section__column">
                    <?= $form->field($model, 'fioContactPerson', [
                        'labelOptions' => ['class' => 'control-label required']])->textInput(['placeholder' => 'Иванов Иван Иванович']) ?>

                    <?= $form->field($model, 'contactPhone', [
                        'labelOptions' => ['class' => 'control-label required']])->textInput(['placeholder' => '+7 (8412) 12-34-56'])
                        ->label('Контактный телефон <span>(пожалуйста, укажите код города)</span>') ?>

                </div>
            </div>
        </div>
        <div class="form-section__group form-section__group--data">
            <div class="row">
                <div class="form-section__column">
                    <?= $form->field($model, 'iAgree', [
                        'labelOptions' => ['class' => 'control-label']])->checkbox(); ?>
                </div>
            </div>
        </div>
        <div class="form-submit">
            <?= $form->field($model, 'reCaptcha', ['enableAjaxValidation'=>false, 'options' => ['class' => '']])->widget(
                \himiklab\yii2\recaptcha\ReCaptcha::className(),
                ['siteKey' => '6LcztB0UAAAAACX06mR8mkrVCWE_GPz2pbncyu0y']
            )->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('отправить и сформировать счет »', ['class' => 'button button--large button--second-color-filled', 'name' => 'signup-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
<!--        --><?php //Pjax::end()?>

</section>
