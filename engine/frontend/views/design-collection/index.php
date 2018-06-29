<?php

use yii\helpers\Html;
use frontend\assets\FancyBoxAsset;
use yii\helpers\Url;
use backend\models\PageItem;
use backend\models\Page;

/* @var $this yii\web\View */
/* @var $model \backend\models\DesignCollection */
//FancyBoxAsset::register($this);

$this->params['breadcrumbs'] = ['label' => \backend\models\DesignCollection::NAME];

?>
<section class="page__section-main">
    <div class="frame frame_simple">
        <div class="frame__container">
            <div class="help-info">
                <div class="help-info__column help-info__column_left">
                    <h1 class="title title_size_l title-lowcase"><?= hp($this->title) ?></h1>
                    <div class="help-info__label">Раздел находится в разработке</div>
                    <div class="help-info__link">
                        <a href="/" class="link">Вернуться на главную</a>
                    </div>
                </div>
                <div class="help-info__column help-info__column_right">
                    <img src="/img/help-info__image_success.jpg" alt="Мебель" class="help-info__image">
                </div>
            </div>
        </div>
    </div>
</section>
<? if (false) :?>
<section class="page__section">
    <h1 class="title title_size_l"><?= hp($this->title) ?></h1>
    <div class="page__section">
        <div class="user-content">
            <?= $texts[\backend\models\StaticTextItem::DESIGNERS_TEXT]['text'] ?>
        </div>
    </div>
    <? foreach ($models as $key => $model): ?>

        <? /* @var $model \backend\models\DesignCollection */ ?>
        <div class="page__section-l">
            <div class="field">
                <div class="field__header">
                    <div class="field__title">
                        <h2 class="title"><?= $model->name ?></h2>
                    </div>
                    <? if (!empty($model->link)) : ?>
                        <a class="field__link link" href="<?= $model->link ?>">Скачать всю
                            коллекцию <?= (!empty($model->volume)) ? '(' . $model->volume . ')' : '' ?></a>
                    <? endif; ?>
                </div>
                <div class="box">
                    <div class="box__item box__item_large">
                        <div class="box__image"
                             style="background-image: url(<?= $model->getSRCPhoto(['suffix' => '_sm']) ?>)"></div>
                    </div>
                    <? foreach ($model->elements as $element): ?>
                        <? /* @var $element \backend\models\DesignElement */ ?>
                        <div class="box__item">
                            <div class="card card_simple">
                                <? if ($element->flags > 0): ?>
                                    <div class="card__badge">
                                        <?= $element->AllFlagsAsArray()[$element->flags] ?>
                                    </div>
                                <? endif; ?>
                                <img class="card__image"
                                     src="<?= $element->getSRCPhoto(['index' => '0', 'suffix' => '_sm']) ?>"
                                     alt="<?= $element->name ?>">
                                <div class="card__content card__content_small">
                                    <div class="card__label"><?= $element->name ?></div>
                                    <a class="card__link link" href="<?= $element->link ?>">Скачать</a>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>

    <? endforeach; ?>
</section>
<div class="page__section">
    <?= $this->render('@frontend/views/layouts/_pagination.php', compact('pages')) ?>
</div>

<? endif; ?>
