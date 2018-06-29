<?php
use yii\bootstrap\Html;
use yii\helpers\HtmlPurifier;
use backend\models\Base;
use backend\models\Portfolio;

/* @var $this yii\web\View */
$this->params['breadcrumbs'][] = ['label' => \Yii::t('app', Portfolio::NAME), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$nearby = $model->getNearbyArticle();
?>

<div class="portfolio-teaser js-portfolio-teaser"
     data-parallax-image="<?= $model->getSRCPhoto(['index' => 5, 'suffix' => '_big']); ?>">
    <canvas class="proportional-block proportional-block_hidden_mobile" width="1920" height="840"></canvas>
    <div class="portfolio-teaser__mask"></div>
    <div class="portfolio-teaser__container">
        <div class="portfolio-teaser__content">
            <div class="portfolio-teaser__text portfolio-teaser__text_date">
                <?= \Yii::$app->formatter->asDate($model->date, 'dd.MM.Y') ?>
            </div>
            <h1 class="portfolio-teaser__title">
                <?= hp($model->name) ?>
            </h1>
            <div class="portfolio-teaser__text">
                <?= hp($model->anons) ?>
            </div>
        </div>
    </div>
    <? if ($model->avtor_nadzor): ?>
        <div class="portfolio-teaser__supervision label-block">
            <!--<svg class="label-block__icon">
                <use xlink:href="#icon-eye"></use>
            </svg>-->
            <svg class="label-block__icon" viewBox="0 0 30 30" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                 xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <path
                        d="M0,15.089434 C0,16.3335929 5.13666091,24.1788679 14.9348958,24.1788679 C24.7325019,24.1788679 29.8697917,16.3335929 29.8697917,15.089434 C29.8697917,13.8456167 24.7325019,6 14.9348958,6 C5.13666091,6 0,13.8456167 0,15.089434 Z"
                        id="eye__outline"></path>
                    <mask id="eye__mask">
                        <rect width="100%" height="100%" fill="white"></rect>
                        <use xlink:href="#eye__outline" id="eye__lid" fill="black"/>
                    </mask>
                </defs>
                <g id="eye__main">
                    <path
                        d="M0,15.089434 C0,16.3335929 5.13666091,24.1788679 14.9348958,24.1788679 C24.7325019,24.1788679 29.8697917,16.3335929 29.8697917,15.089434 C29.8697917,13.8456167 24.7325019,6 14.9348958,6 C5.13666091,6 0,13.8456167 0,15.089434 Z M14.9348958,22.081464 C11.2690863,22.081464 8.29688487,18.9510766 8.29688487,15.089434 C8.29688487,11.2277914 11.2690863,8.09740397 14.9348958,8.09740397 C18.6007053,8.09740397 21.5725924,11.2277914 21.5725924,15.089434 C21.5725924,18.9510766 18.6007053,22.081464 14.9348958,22.081464 L14.9348958,22.081464 Z M18.2535869,15.089434 C18.2535869,17.0200844 16.7673289,18.5857907 14.9348958,18.5857907 C13.1018339,18.5857907 11.6162048,17.0200844 11.6162048,15.089434 C11.6162048,13.1587835 13.1018339,11.593419 14.9348958,11.593419 C15.9253152,11.593419 14.3271242,14.3639878 14.9348958,15.089434 C15.451486,15.7055336 18.2535869,14.2027016 18.2535869,15.089434 L18.2535869,15.089434 Z"
                        fill="black"></path>
                    <use xlink:href="#eye__outline" mask="url(#eye__mask)" fill="black"/>
                </g>
            </svg>
            <?= \Yii::t('app', 'авторский надзор') ?>
        </div>
    <? endif ?>
</div>
<div class="project">
    <div class="wrapper">
        <div class="project__container">
            <div class="project__column">
                <?
                $srcImg1 = $model->getSRCPhoto(['index' => 1, 'suffix' => '_sm']);
                $srcImg1 = $srcImg1 == Base::NO_PHOTO ? false : $srcImg1;

                $srcImg2 = $model->getSRCPhoto(['index' => 2, 'suffix' => '_sm']);
                $srcImg2 = $srcImg2 == Base::NO_PHOTO ? false : $srcImg2;
                ?>
                <? if ($model->post1 && $model->fio1 && $srcImg1) : ?>
                    <div class="project__card">
                        <img src="<?= $srcImg1 ?>" alt="<?= hp($model->fio1) ?>" class="project__photo">
                        <div class="project__content">
                            <div class="project__text"><?= hp($model->post1) ?>:<br>
                                <span style="color: #fff">
                                        <?= hp($model->fio1) ?>
                                    </span>
                            </div>
                        </div>
                    </div>
                <? endif ?>
                <? if ($model->post2 && $model->fio2 && $srcImg2) : ?>
                    <div class="project__card">
                        <img src="<?= $srcImg2 ?>" alt="<?= hp($model->fio2) ?>" class="project__photo">
                        <div class="project__content">
                            <div class="project__text"><?= hp($model->post2) ?>:<br>
                                <span style="color: #fff">
                                        <?= hp($model->fio2) ?>
                                    </span>
                            </div>
                        </div>
                    </div>
                <? endif ?>
            </div>
            <div class="project__column project__column_info">
                <div class="project__text">
                    <? if ($model->area_object): ?><?= \Yii::t('app', 'Площадь проекта') ?>: <span
                        style="color: #fff"><?= hp($model->area_object) ?> м<sup>2</sup></span><br><? endif ?>
                    <? if ($model->budget): ?><?= \Yii::t('app', 'Бюджет') ?>: <span
                        style="color: #fff"><?= $model->budget ?></span> <?= \Yii::t('app', 'рублей') ?>
                        <br><? endif ?>
                    <? if ($model->steel): ?><?= \Yii::t('app', 'Стиль') ?>: <span
                        style="color: #fff"><?= hp($model->steel) ?></span><? endif ?>
                </div>
            </div>
            <?
            $srcSourcePlan = $model->getSRCPhoto(['index' => 3, 'suffix' => '_sm']);
            $srcSourcePlan = $srcSourcePlan == Base::NO_PHOTO ? false : $srcSourcePlan;

            $srcFactPlan = $model->getSRCPhoto(['index' => 4, 'suffix' => '_sm']);
            $srcFactPlan = $srcFactPlan == Base::NO_PHOTO ? false : $srcFactPlan;
            ?>
            <? if ($srcSourcePlan || $srcFactPlan): ?>
                <div class="project__column project__column_info project__column_solution">
                    <div class="project__text project__text_centered">
                        <?= \Yii::t('app', 'Планировочное решение') ?>:
                    </div>
                    <div class="project__gallery js-project__gallery">
                        <? if ($srcSourcePlan): ?>
                            <div class="project__item">
                                <a href="<?= $model->getSRCPhoto(['index' => 3, 'suffix' => '_big']) ?>"
                                   class="project__view">
                                    <div class="project__mask">
                                        <svg class="project__icon" viewBox="0 0 52.966 52.966">
                                            <use xlink:href="#icon-zoom-in"></use>
                                        </svg>
                                    </div>
                                    <img src="<?= $model->getSRCPhoto(['index' => 3, 'suffix' => '_sm']) ?>"
                                         alt="Фактический план"
                                         class="project__image">
                                </a>
                                <p class="project__description">
                                    <?= \Yii::t('app', 'Исходный план') ?>
                                </p>
                            </div>
                        <? endif ?>
                        <? if ($srcFactPlan): ?>
                            <div class="project__item">
                                <a href="<?= $model->getSRCPhoto(['index' => 4, 'suffix' => '_big']) ?>"
                                   class="project__view">
                                    <div class="project__mask">
                                        <svg class="project__icon" viewBox="0 0 52.966 52.966">
                                            <use xlink:href="#icon-zoom-in"></use>
                                        </svg>
                                    </div>
                                    <img src="<?= $model->getSRCPhoto(['index' => 4, 'suffix' => '_sm']) ?>"
                                         alt="Фактический план"
                                         class="project__image">
                                </a>
                                <p class="project__description">
                                    <?= \Yii::t('app', 'Фактический план') ?>
                                </p>
                            </div>
                        <? endif ?>
                    </div>
                </div>
            <? endif ?>
        </div>
    </div>
</div>
<div class="wrapper">
    <section class="portfolio-content">
        <div class="user_content">
            <h2><?= \Yii::t('app', 'О проекте') ?></h2>
            <?= hp(str_replace(['<p><img', '/></p>'], ['<img', '/>'], $model->text)) ?>

        </div>
    </section>
</div>
<?
$photos = $model->photos;
?>
<? if ($photos): ?>
    <div class="photos">
        <div class="wrapper">
            <h2 class="title">
                <?= \Yii::t('app', 'Еще фотографии') ?>:
            </h2>
            <div class="gallery gallery_portfolio js-gallery">
                <? foreach ($photos as $item): ?>
                    <? if ($item->img_pos == Base::HORIZONTAL_PHOTO): ?>
                        <a href="<?= $item->getSrcPhoto(['suffix' => '_big', 'parent_id' => $model->id]) ?>"
                           class="gallery__item"
                           title="<?= hp($item->name) ?>">
                            <div class="gallery__mask">
                                <svg class="gallery__icon" viewBox="0 0 52.966 52.966">
                                    <use xlink:href="#icon-zoom-in"></use>
                                </svg>
                            </div>
                            <img src="<?= $item->getSrcPhoto(['suffix' => '_sm', 'parent_id' => $model->id]) ?>"
                                 alt="<?= hp($item->name) ?>"
                                 class="gallery__image">
                        </a>
                    <? endif ?>
                <? endforeach; ?>
            </div>
            <div class="gallery gallery_portfolio js-gallery">
                <? foreach ($photos as $item): ?>
                    <? if ($item->img_pos == Base::VERTICAL_PHOTO): ?>
                        <a href="<?= $item->getSrcPhoto(['suffix' => '_big', 'parent_id' => $model->id]) ?>"
                           class="gallery__item"
                           title="<?= hp($item->name) ?>">
                            <div class="gallery__mask">
                                <svg class="gallery__icon" viewBox="0 0 52.966 52.966">
                                    <use xlink:href="#icon-zoom-in"></use>
                                </svg>
                            </div>
                            <img src="<?= $item->getSrcPhoto(['suffix' => '_sm', 'parent_id' => $model->id]) ?>"
                                 alt="<?= hp($item->name) ?>"
                                 class="gallery__image">
                        </a>
                    <? endif ?>
                <? endforeach; ?>
            </div>
        </div>
    </div>
<? endif ?>
<?
$srcComment = $model->getSRCPhoto(['index' => 6, 'suffix' => '_sm']);
$srcComment = $srcComment == Base::NO_PHOTO ? false : $srcComment;
?>
<? if ($srcComment && $model->fio_client && $model->comment_client): ?>
    <div class="reviews reviews_portfolio section">
        <div class="wrapper">
            <h2 class="title reviews__title">
                <?= \Yii::t('app', 'Комментарий клиента') ?>
                <svg class="reviews__icon">
                    <use xlink:href="#icon-quotes"></use>
                </svg>
            </h2>
            <div class="reviews__container">
                <div class="reviews__column reviews__column_author">
                    <div class="reviews__content">
                        <span
                            class="reviews__content_large"><?= hp($model->fio_client) ?></span><br> <?= hp($model->post_client) ?>
                    </div>
                    <img src="<?= $srcComment ?>" alt="<?= hp($model->fio_client) ?>" class="reviews__photo">
                </div>
                <div class="reviews__column reviews__column_article">
                    <?= hp($model->comment_client) ?>
                </div>
            </div>
        </div>
    </div>
<? endif ?>

<div class="blog-articles">
    <a href="<?= $nearby['prev']->linkOut ?>" class="blog-articles__item blog-articles__item_large"
       data-background="<?= $nearby['prev']->getUploadPathImage(['index' => 5, 'suffix' => '_big']) ?>">
        <div class="blog-articles__mask"></div>
        <div class="blog-articles__container">
            <p class="blog-articles__description">
                &larr; <?= \Yii::t('app', 'предыдущий проект') ?>
            </p>
            <div class="blog-articles__title">
                <?
                mb_internal_encoding('UTF-8');
                $MAX_WIDTH = 70;
                ?>
                <?= mb_strimwidth(strip_tags($nearby['prev']->name), 0, $MAX_WIDTH, '...') ?>

            </div>
        </div>
    </a>
    <a href="<?= $nearby['next']->linkOut ?>"
       class="blog-articles__item blog-articles__item_large blog-articles__item_right"
       data-background="<?= $nearby['next']->getUploadPathImage(['index' => 5, 'suffix' => '_big']) ?>">
        <div class="blog-articles__mask"></div>
        <div class="blog-articles__container blog-articles__container_right">
            <p class="blog-articles__description">
                <?= \Yii::t('app', 'следующий проект') ?> &rarr;
            </p>
            <div class="blog-articles__title">
                <?= mb_strimwidth(strip_tags($nearby['next']->name), 0, $MAX_WIDTH, '...') ?>
            </div>
        </div>
    </a>
</div>

<?= $this->render('_callback_form.php', compact('model', 'callback', 'message')) ?>

<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <p class="title"></p>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
