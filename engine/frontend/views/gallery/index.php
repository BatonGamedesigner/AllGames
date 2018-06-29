<?php
/* @var $this yii\web\View */
?>
<h1>Галереи</h1>
<p>
    <?= $content ?>
</p>
<ul>
    <?php foreach($models as $cur): ?>
        <li><?= \yii\helpers\Html::a($cur->name,$cur->linkOut) ?></li>
    <?php endforeach; ?>
</ul>
