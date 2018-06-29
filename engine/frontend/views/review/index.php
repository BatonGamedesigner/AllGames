<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use backend\models\StaticTextItem;
use backend\models\Base;
use backend\models\Review;

$this->title = Review::NAME;
$this->params['breadcrumbs'][] = ['label' => \Yii::t('app', $this->title)];

?>
<section class="page__section">
    <h1 class="title title_size_l"><?= $this->title ?></h1>
    <div class="page__section-main">
        <div class="pillars">
            <div class="pillars__item">
                <? if (!empty($models)): ?>
                    <? foreach ($models as $review): ?>
                        <? /* @var $review Review */ ?>
                        <div class="page__field">
                            <div class="review-card">
                                <div class="review-card__wrapper review-card__wrapper_simple">
                                    <div class="user-content">
                                        <?= $review->text ?>
                                    </div>
                                    <? if (!empty($review->photos)): ?>
                                        <div class="review-card__field">
                                            <div class="small-gallery js-small-gallery_simple">
                                                <? foreach ($review->photos as $image): ?>
                                                    <? /* @var $image \backend\models\ReviewPhoto */ ?>
                                                    <a class="small-gallery__item js-small-gallery__item"
                                                       href="<?= $image->getSRCPhoto(['suffix' => '_big', 'parent_id' => $review->id]) ?>"
                                                       title="<?= $image->name ?>">
                                                        <img class="small-gallery__image"
                                                             src="<?= $image->getSRCPhoto(['suffix' => '_sm', 'parent_id' => $review->id]) ?>"
                                                             alt="<?= $image->name ?>">

                                                        <div class="small-gallery__mask">
                                                            <svg class="small-gallery__icon">
                                                                <use xlink:href="#icon-zoom"></use>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                <? endforeach; ?>
                                            </div>
                                        </div>
                                    <? endif; ?>
                                </div>
                                <div class="review-card__caption review-card__caption_complex">
                                    <div class="review-card__label">
                                        <?= $review->name ?>
                                    </div>
                                    <? if (!empty($review->date)): ?>
                                        <div class="review-card__label review-card__label_right">
                                            <?= \Yii::$app->formatter->asDate($review->date, 'dd MMMM YYYY') ?>
                                        </div>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                <? endif; ?>
                <div class="page__section">
                    <?= $this->render('@frontend/views/layouts/_pagination.php', compact('pages')) ?>
                </div>
            </div>
            <div class="pillars__item pillars__item_small">
                <div class="frame">
                    <div class="frame__content">
                        <?= $this->render('_form.php', compact('message', 'model', 'uploadModel')) ?>
                    </div>
                </div>
                <div class="page__section">
                    <div class="title title_size_s">Мы в социальных сетях</div>
                    <!-- INSTA Widget
                    <div class="page__section-xs">
                        место для виджета инстаграм
                    </div> -->
                    <div class="page__section-xs">
                        <script type="text/javascript" src="//vk.com/js/api/openapi.js?152"></script>

                        <!-- VK Widget -->
                        <div id="vk_groups"></div>
                        <script type="text/javascript">
                            VK.Widgets.Group("vk_groups", {mode: 3}, 89290433);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>