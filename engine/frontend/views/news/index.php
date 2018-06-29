<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
$this->params['breadcrumbs'][] = ['label' => 'Новости'];

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
            <?=Html::img($m->getUploadPathImage(['suffix' => '_sm']))?>
        </div>
    </div>
    <br>
<?php endforeach; ?>