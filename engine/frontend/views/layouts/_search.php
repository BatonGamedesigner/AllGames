<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<?php $form = ActiveForm::begin([
    'action' => ['/category/search/'],
    'method' => 'get',
    'options' => ['class' => 'search']
]); ?>

<?= Html::input('search', 'query', $query, ['class' => 'search__input', 'placeholder' => 'Поиск по товарам']) ?>
<?= Html::submitButton('
    <svg class="search__icon">
        <use xlink:href="#icon-search"></use>
    </svg>',
    ['class' => 'search__button', 'title' => 'Искать', 'encode' => true]) ?>

<?php ActiveForm::end(); ?>