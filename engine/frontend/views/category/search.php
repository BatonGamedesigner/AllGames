<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

//use backend\assets\FancyBoxAsset;
//FancyBoxAsset::register($this);

$this->params['breadcrumbs'] = $this->context->getBreadcrumbs($model->id);
$this->params['breadcrumbs'][] = 'Результаты поиска';
$index = 0;


?>

<section class="page__section">
    <h1 class="title title_size_l">Результаты поиска</h1>
    <? if (!empty($models)): ?>
        <div class="page__section-main">
            <?= $this->render('_item', compact('models', 'index')); ?>
        </div>
    <? else: ?>
        <div class="page__section-main">
            <p>Соответствующие товары не найдены.</p>
            <p>Пробуйте поиск ещё раз, либо перейдите в раздел <a href="/category/">Коллекции</a></p>
        </div>
    <? endif;?>
</section>
<div class="page__section">
    <?= $this->render('@frontend/views/layouts/_pagination.php', compact('pages')) ?>
</div>





