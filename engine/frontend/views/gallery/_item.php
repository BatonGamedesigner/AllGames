<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 10.05.2016
 * Time: 17:16
 */
use yii\bootstrap\Html;
use yii\helpers\HtmlPurifier;

//print_r($model); die;
?>


<div class="_item">
    <?= Html::a($model->name,$model->linkOut,['data-pjax' => 'false']) ?>

    <?php if($model->ext): ?>
        <p>

            <?= Html::a(Html::img($model->uploadPath . $model->id . '_sm.' . $model->ext . '?' . rand() /*,['width' => 300]*/),$model->uploadPath . $model->id . '_big.' . $model->ext,['class'=>'fancybox']) ?>
        </p>
    <?php endif; ?>
</div>