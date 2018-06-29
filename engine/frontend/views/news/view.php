<?php
use yii\bootstrap\Html;
use yii\helpers\HtmlPurifier;
/* @var $this yii\web\View */
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title)?></h1>

<p>
    <?= HtmlPurifier::process($model->text) ?>
</p>
