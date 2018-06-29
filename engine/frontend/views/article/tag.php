<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 05.03.2016
 * Time: 12:58
 */

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
?>
<h1>Статьи по тэгу <?= $tag->name ?></h1>

<p>
<ul>
    <?php foreach($tag->articles as $m): ?>

        <?php if ($m->surl): ?>
            <li><?=Html::a($m->name,Url::to(['su','surl' => $m->surl]))?></li>
        <?php else: ?>
            <li><?=Html::a($m->name,Url::to(['view','id' => $m->id]))?></li>
        <?php endif; ?>



    <?php endforeach; ?>
</ul>
</p>
