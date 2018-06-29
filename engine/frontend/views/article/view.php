<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */



$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <h2>
        <?php foreach($model->tags as $tag): ?>
            <?=Html::a('#'.$tag->name,Url::to(['tag' , 'id' => $tag->id]))?>
        <?php endforeach; ?>
    </h2>
    <div class="content">
        <?= $model->text; ?>
    </div>
    <?/*= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'anons:ntext',
            'text:ntext',
            'date',
            'title',
            'keywords',
            'desc',


        ],
    ]) */?>

</div>
