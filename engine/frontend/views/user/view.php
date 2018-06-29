<?php
use yii\bootstrap\Html;
use yii\helpers\HtmlPurifier;
use frontend\models\User;
/* @var $this yii\web\View */
$this->title = User::ONE_NAME;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title)?></h1>


