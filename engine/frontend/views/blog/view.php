<?php
use yii\bootstrap\Html;
use yii\helpers\HtmlPurifier;
use backend\models\Blog;

/* @var $this yii\web\View */
$this->params['breadcrumbs'][] = ['label' => \Yii::t('app', Blog::NAME), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['breadcrumbsOpenContainerTag'] = '<div class="wrapper">';
$this->params['breadcrumbsCloseContainerTag'] = '</div>';

$nearby = $model->getNearbyArticle();
?>
<?= $this->render('@frontend/views/layouts/_blueimp_gallery.php'); ?>

<div class="small-teaser">
    <div class="small-teaser__help-block"></div>
    <div class="small-teaser__container js-small-teaser__parallax"
         data-parallax-image="/img/small-teaser/small-teaser-bg.jpg">
        <div class="small-teaser__mask"></div>
        <div class="wrapper">
            <p class="small-teaser__date">
                <?= \Yii::$app->formatter->asDate($model->date, 'dd MMMM YYYY') ?>
            </p>
            <h1 class="small-teaser__title">
                <?= hp($model->name) ?>
            </h1>
        </div>
    </div>
    <div class="small-teaser__help-block"></div>
</div>
<div class="wrapper">
    <section class="blog-page">
        <div class="user_content">
            <?= hp($model->text) ?>
        </div>
    </section>
    <?
    $gallery = $model->getPhotos()->orderBy('pos DESC')->all();
    ?>
    <? if ($gallery): ?>
        <h2 class="title title_secondary">
            Фотогалерея
        </h2>
        <div class="gallery gallery_align_left gallery_padded js-gallery">
            <? foreach ($gallery as $item): ?>
                <? if ($item->img_pos == \backend\models\BlogPhoto::IMG_HORIZONTAL || $item->img_pos == \backend\models\BlogPhoto::IMG_QUATRO): ?>
                    <a class="wow fadeIn gallery__item gallery__item_size_s" href="<?= $item->getSrcPhoto(['suffix' => '_big', 'parent_id' => $model->id]) ?>"
                       title="<?= hp($item->name) ?>">
                        <div class="gallery__mask">
                            <svg class="gallery__icon" viewBox="0 0 475.084 475.084">
                                <use xlink:href="#icon-zoom-in"></use>
                            </svg>
                        </div>
                        <img class="gallery__image" src="<?= $item->getSrcPhoto(['suffix' => '_sm', 'parent_id' => $model->id]) ?>" alt="<?= hp($item->name) ?>">
                    </a>
                <? endif ?>
            <? endforeach ?>

            <? foreach ($gallery as $item): ?>
                <? if ($item->img_pos == \backend\models\BlogPhoto::IMG_VERTICAL): ?>
                    <a class="wow fadeIn gallery__item gallery__item_size_s" href="/img/gallery/gallery-img-1.jpg"
                       title="<?= hp($item->name) ?>">
                        <div class="gallery__mask">
                            <svg class="gallery__icon" viewBox="0 0 475.084 475.084">
                                <use xlink:href="#icon-zoom-in"></use>
                            </svg>
                        </div>
                        <img class="gallery__image" src="<?= $item->getSrcPhoto(['suffix' => '_sm', 'parent_id' => $model->id]) ?>" alt="<?= hp($item->name) ?>">
                    </a>
                <? endif ?>
            <? endforeach ?>

        </div>
    <? endif ?>

    <?if(!empty($model->yutubeLink)):?>
        <section class="blog-page">
            <div class="user_content" style="text-align: center;margin-bottom: 30px;">
                <iframe width="570" height="320" src="https://www.youtube.com/embed/<?=\backend\models\Base::getEmbedYoutybe($model->yutubeLink)?>" frameborder="0" allowfullscreen=""></iframe><br>
                <a class="video__caption" href="https://www.youtube.com/watch?v=<?=$model->yutubeLinkComment?>" target="_blank"><?=$model->yutubeLinkComment?></a>
            </div>
        </section>
    <?endif?>

</div>


