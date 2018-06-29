<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
use backend\models\StaticTextItem;
use backend\models\Base;
use backend\models\Portfolio;

$this->params['breadcrumbs'][] = ['label' => \Yii::t('app',Portfolio::NAME)];

?>

    <section class="portfolio section section_small">
        <h1 class="title title_size_l"><?= \Yii::t('app',Portfolio::NAME) ?></h1>
        <div class="wrapper">
            <div class="portfolio__container portfolio__container_small">
                <div class="portfolio__info portfolio__info_left">
                    <div class="portfolio__paragraph">
                        <p class="portfolio__paragraph_bolded">
                            <?= hp($texts[StaticTextItem::PORTFOLIO_FIO]['text']) ?>
                        </p>
                        <?= hp(strip_tags($texts[StaticTextItem::PORTFOLIO_POST]['text'], '<br>')) ?>
                    </div>
                    <img class="portfolio__image"
                         src="<?= Base::getSrcIMG($texts[StaticTextItem::PORTFOLIO_PHOTO]['text']) ?>"
                         alt="<?= hp($texts[StaticTextItem::PORTFOLIO_FIO]['text']) ?>">
                </div>
                <div class="portfolio__info portfolio__info_right">
                    <?= hp(strip_tags($texts[StaticTextItem::PORTFOLIO_TEXT]['text']), '<br>') ?>
                </div>
            </div>
        </div>
        <div class="portfolio__tabs js-portfolio__tabs_portfolio portfolio__tabs_padded">
            <ul class="portfolio__controls">
                <li>
                    <a class="portfolio__button js-portfolio__button  is-active" data-filter="all"><?= \Yii::t('app','Все') ?></a>
                </li>
                <li>
                    <a class="portfolio__button js-portfolio__button " data-filter=".category-private"><?= \Yii::t('app','Частные интерьеры') ?></a>
                </li>
                <li>
                    <a class="portfolio__button js-portfolio__button " data-filter=".category-public"><?= \Yii::t('app','Общественные  интерьеры') ?></a>
                </li>
            </ul>
            <div class="portfolio__container js-portfolio__container">
                <? foreach ($models as $m): ?>
                    <a href="<?=$m->linkOut?>" class="portfolio__item mix <?=$m->getFilterClass()?>">
                        <div class="portfolio__hover-mask">
                            <div class="portfolio__item-description"><?=hp($m->name)?></div>
                        </div>
                        <img class="portfolio__photo" src="<?=$m->getSRCPhoto(['index'=>0, 'suffix'=>'_sm'])?>"
                             alt="<?=hp($m->name)?>">
                    </a>
                <? endforeach; ?>
            </div>
        </div>
    </section>