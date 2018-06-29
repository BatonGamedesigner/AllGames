<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->params['breadcrumbs'][] = ['label' => 'Статьи'];
?>

<p>
    <?= $content ?>
</p>

    <?php foreach($models as $m): ?>
        <div class="row">
            <div class="col-md-6">
                <?=Html::a($m->name,$m->linkOut)?>
                <p>
                    <?=hp($m->anons)?>
                </p>
            </div>
            <div class="col-md-6">
                <?=Html::img($m->getUploadPathImage(['suffix' => '_sm','index' => 0]))?>
            </div>

        </div>
        <br>
    <?php endforeach; ?>


