<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
use yii\helpers\HtmlPurifier;
use backend\assets\FancyBoxAsset;
FancyBoxAsset::register($this);



$find =$model->getChildGalleries()->where(['active' => 1]);

$countFind = clone $find;

$pages = new \yii\data\Pagination(['totalCount' => $countFind->count(), 'pageSize' => 2]);
$models = $find->offset($pages->offset)->limit($pages->limit)->all();

$this->params['breadcrumbs']  = $this->context->getBreadcrumbs($model->id);
?>
<h1><?= Html::encode($model->name) ?></h1>

<p>
    <?= HtmlPurifier::process($model->text) ?>

</p>
<?php if($model->photos): ?>
<p>
    <?php foreach($model->photos as $cur): ?>
        <?= Html::a(Html::img($cur->uploadPath . $model->id . '/' . $cur->id . '_sm.' . $cur->ext . '?' . rand() /*,['width' => 300]*/), $cur->uploadPath .  $model->id . '/'. $cur->id . '_big.' . $cur->ext,['class'=>'fancybox']) ?>
    <?php endforeach; ?>
</p>
<?php endif; ?>

<?php foreach($models as $cur): ?>
    <div class="_item">
        <?= Html::a($cur->name,$cur->linkOut,['data-pjax' => 'false']) ?>

        <?php if($cur->ext): ?>
            <p>

                <?= Html::a(Html::img($cur->uploadPath . $cur->id . '_sm.' . $cur->ext . '?' . rand() /*,['width' => 300]*/),$cur->uploadPath . $cur->id . '_big.' . $cur->ext,['class'=>'fancybox']) ?>
            </p>
        <?php endif; ?>
    </div>

<?php endforeach; ?>

<?= \yii\widgets\LinkPager::widget([
    'pagination' => $pages
]);?>
