<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
use backend\models\Blog;
use backend\models\StaticTextItem;

//use frontend\assets\BlogAsset;

//BlogAsset::register($this);

$this->params['breadcrumbs'][] = ['label' => \Yii::t('app', Blog::NAME)];
$this->params['breadcrumbsOpenContainerTag'] = '<div class="wrapper">';
$this->params['breadcrumbsCloseContainerTag'] = '</div>';
?>

<div class="small-teaser">
    <div class="small-teaser__help-block"></div>
    <div class="small-teaser__container js-small-teaser__parallax" data-parallax-image="/img/small-teaser/small-teaser-bg.jpg">
        <div class="small-teaser__mask"></div>
        <div class="wrapper">
            <h1 class="small-teaser__title">
                <?=Blog::NAME?>
            </h1>
            <div class="small-teaser__text">
                <?=hp($texts[StaticTextItem::BLOG_INTRO]['text'])?>
            </div>
        </div>
    </div>
    <div class="small-teaser__help-block"></div>
</div>
<div class="wrapper">
    <?if($models):?>
    <section class="articles">
        <?foreach($models as $m):?>
            <article class="articles__item">
                <img src="<?= $m->getSrcPhoto(['suffix' => '_sm', 'index' => 0]) ?>" alt="<?= hp($m->name) ?>" class="articles__image">
                <div class="articles__content">
                    <p class="articles__date">
                        <?= \Yii::$app->formatter->asDate($m->date, 'dd MMMM YYYY') ?>
                    </p>
                    <h2 class="articles__title">
                        <?= hp($m->name) ?>
                    </h2>
                    <p class="articles__text">
                        <?= hp(strip_tags($m->anons)) ?>
                    </p>
                    <a href="<?= $m->linkOut ?>" class="button articles__button">Подробнее →</a>
                </div>
            </article>
        <?endforeach;?>
    </section>
    <?endif?>
</div>
<?= $this->render('@frontend/views/layouts/_pagination.php', compact('pages')) ?>

