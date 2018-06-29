<?php

use backend\models\StaticTextItem;
use yii\helpers\Url;
use backend\models\Page;

/* @var $this yii\web\View */

$this->title = Yii::$app->name;

?>
<? if (!empty($banners)): ?>
    <div class="main-slider swiper-container js-main-slider">
        <div class="main-slider__wrapper swiper-wrapper">
            <? foreach ($banners as $banner): ?>
                <? /* @var $banner \backend\models\Banner */ ?>
                <div class="slide swiper-slide">
                    <img class="slide__image swiper-lazy" alt="<?= $banner->name ?>"
                         data-src="<?= $banner->getSRCPhoto(['suffix' => '_big']) ?>">
                    <div class="slide__content">
                        <div class="slide__cell">
                            <? if (!empty($banner->name)): ?>
                                <div class="slide__title"><?= $banner->name ?></div>
                            <? endif; ?>
                            <? if (!empty($banner->text)): ?>
                                <div class="slide__caption"><?= $banner->text ?></div>
                            <? endif; ?>
                            <? if (!empty($banner->link) || !empty($banner->link_text)): ?>
                                <div class="slide__button">
                                    <a class="button button_color_dark"
                                       href="<?= $banner->link ?>"><?= $banner->link_text ?></a>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <div class="main-slider__pagination js-main-slider__pagination"></div>
        <div class="main-slider__button js-main-slider__prev">
            <svg class="main-slider__icon">
                <use xlink:href="#icon-arrow-down"></use>
            </svg>
        </div>
        <div class="main-slider__button main-slider__button_next js-main-slider__next">
            <svg class="main-slider__icon">
                <use xlink:href="#icon-arrow-down"></use>
            </svg>
        </div>
    </div>
<? endif; ?>
    <div class="wrapper wrapper_nopad">
        <section class="advantages advantages_moved">
            <div class="advantages__container">
                <div class="advantages__item">
                    <div class="advantage-badge">
                        <div class="advantage-badge__text">Гарантия качества</div>
                        <img class="advantage-badge__image" src="/img/like.png"
                             alt="Экологичность">
                    </div>
                    <div class="advantages__description">
                        <?= $staticText[StaticTextItem::ECO]['text'] ?>
                    </div>
                </div>
                <div class="advantages__item">
                    <div class="advantage-badge">
                        <div class="advantage-badge__text">Быстрая сделка</div>
                        <img class="advantage-badge__image" src="/img/time.jpg"
                             alt="Интерьер">
                    </div>
                    <div class="advantages__description">
                        <?= $staticText[StaticTextItem::WITHOUT_DESIGN]['text'] ?>
                    </div>
                </div>
                <div class="advantages__item">
                    <div class="advantage-badge">
                        <div class="advantage-badge__text">Большой ассортимент</div>
                        <img class="advantage-badge__image" src="/img/advantage-badge__image_assortment.svg"
                             alt="Ассортимент">
                    </div>
                    <div class="advantages__description">
                        <?= $staticText[StaticTextItem::RANGE]['text'] ?>
                    </div>
                </div>
                <div class="advantages__item">
                    <div class="advantage-badge">
                        <div class="advantage-badge__text">Мгновенная доставка</div>
                        <img class="advantage-badge__image" src="/img/advantage-badge__image_delivery.svg"
                             alt="Грузовик">
                    </div>
                    <div class="advantages__description">
                        <?= $staticText[StaticTextItem::DELIVERY]['text'] ?>
                    </div>
                </div>
            </div>
        </section>
        <? if (!empty($collections)): ?>
            <section class="page__section">
                <div class="teaser">
                    <? foreach ($collections as $collection): ?>
                        <? /* @var $collection \backend\models\Category */ ?>
                        <? $count = $collection->getProducts()->count() ?>

                        <a href="<?= $collection->linkOut ?>" class="teaser__item">
                            <div class="teaser__image"
                                 style="background-image: url('<?= $collection->getSRCPhoto(['suffix' => '_mid']) ?>')">
                                <div class="teaser__wrapper">
                                    <div class="teaser__title"><?= $collection->name ?></div>
                                    <div class="teaser__info">
                                        <span class="teaser__label"><?= \backend\models\Base::inclination($count) ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <? endforeach; ?>
                </div>
            </section>
        <? endif; ?>
    </div>
    <div class="info">
        <div class="wrapper">
            <div class="info__container">
                <div class="info__column info__column_shrink">
                    <div class="info-title">
                        <svg class="info-title__icon">
                            <use xlink:href="#icon-questions"></use>
                        </svg>
                        <div class="info-title__text">Есть вопросы?</div>
                    </div>
                </div>
                <div class="info__column">
                    <div class="info__text">
                        Вы можете задать вопрос или проконсультироваться с нашим менеджером.
                    </div>
                </div>
                <div class="info__column">
                    <a href="#popup_question" class="button button_size_l button_transparent js-popup__open"
                       data-effect="mfp-zoom-in">Задать вопрос</a>
                </div>
            </div>
        </div>
    </div>
<? if (false): ?>

    <section class="section section_decorated">
        <div class="section__wrapper">
            <? if (!empty($reviews)): ?>
                <div class="section__column">
                    <div class="rack">
                        <h2 class="title title_top">Отзывы о нас</h2>
                        <div class="rack__header">
                            <div class="shelf">
                                <div class="shelf__item shelf__item_large">
                                    Вы можете оставить свои пожелания и отзыв о работе магазина и других служб
                                    компании.
                                </div>
                                <div class="shelf__item">
                                    <a href="/review/" class="button button_color_dark button_light" rel="nofollow">Оставить
                                        отзыв</a>
                                </div>
                            </div>
                        </div>
                        <div class="rack__content">
                            <div class="review-slider swiper-container js-review-slider">
                                <div class="review-slider__wrapper swiper-wrapper">
                                    <? foreach ($reviews as $review): ?>
                                        <? /* @var $review \backend\models\Review */ ?>
                                        <div class="swiper-slide review-card">
                                            <div class="review-card__wrapper">
                                                <div class="review-card__text">
                                                    <?= $review->text ?>
                                                </div>
                                                <div class="review-card__link">
                                                    <a class="link" href="/review/" rel="nofollow">Подробнее</a>
                                                </div>
                                            </div>
                                            <div class="review-card__caption">
                                                <?= $review->name ?>
                                                , <?= \Yii::$app->formatter->asDate($review->date, 'dd MMMM YYYY') ?>
                                            </div>
                                        </div>
                                    <? endforeach; ?>
                                </div>
                                <div class="review-slider__button js-review-slider__prev">
                                    <svg class="review-slider__icon">
                                        <use xlink:href="#icon-arrow-down"></use>
                                    </svg>
                                </div>
                                <div class="review-slider__button review-slider__button_next js-review-slider__next">
                                    <svg class="review-slider__icon review-slider__icon_next">
                                        <use xlink:href="#icon-arrow-down"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="rack__bottom">
                            <a class="button button_color_dark" href="/review/">Все отзывы</a>
                        </div>
                    </div>
                </div>
            <? endif; ?>

            <? if (!empty($furniture)): ?>
                <div class="section__column section__column_last">
                    <div class="rack">
                        <h2 class="title title_top"><?= $furniture->name ?></h2>
                        <div class="rack__header">
                            <?= $furniture['texts'][StaticTextItem::FURNITURE_TEXT]['text'] ?>
                        </div>
                        <? if (!empty($furniturePhotos)): ?>
                            <div class="rack__content">
                                <!-- data-images - это строка в uriencoded json объекта с данными картинок для галереи
                                https://codepen.io/HummerHead87/pen/oEgZyy?editors=1011
                                ВАЖНО: первые 2 картинки должны быть большими вариантами картинок в элементе img.small-gallery__image -->

                                <div class="small-gallery js-small-gallery"
                                     data-images="<?= urlencode(json_encode($furniturePhotos['data'])) ?>">

                                    <a class="small-gallery__item js-small-gallery__item"
                                       href="<?= $furniturePhotos['data'][0]['src'] ?>">
                                        <img class="small-gallery__image"
                                             src="<?= $furniturePhotos['preview'][0]['src_sm'] ?>"
                                             alt="<?= $furniturePhotos['preview'][0]['title'] ?>">
                                        <div class="small-gallery__mask">
                                            <svg class="small-gallery__icon">
                                                <use xlink:href="#icon-zoom"></use>
                                            </svg>
                                        </div>
                                    </a>

                                    <a class="small-gallery__item js-small-gallery__item"
                                       href="<?= $furniturePhotos['data'][1]['src'] ?>">
                                        <img class="small-gallery__image"
                                             src="<?= $furniturePhotos['preview'][1]['src_sm'] ?>"
                                             alt="<?= $furniturePhotos['preview'][1]['title'] ?>">
                                        <div class="small-gallery__mask">
                                            <svg class="small-gallery__icon">
                                                <use xlink:href="#icon-zoom"></use>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <? endif; ?>
                        <div class="rack__bottom">
                            <a class="button button_color_dark"
                               href="<?= $this->params['contacts'][\backend\models\PageItem::CONTACTS_INSTA]['text'] ?>">
                                <svg class="icon icon_inline">
                                    <use xlink:href="#icon-instagram"></use>
                                </svg>
                                Смотреть
                            </a>
                        </div>
                    </div>
                </div>
            <? endif; ?>
        </div>
    </section>
<? endif; ?>

<? if (!empty($staticText[StaticTextItem::TEXT]['text'])): ?>
    <div class="wrapper">
        <section class="page__section-l">
            <h2 class="title title_centered title_top">Лучший Интернет-магазин игрового контента</h2>
            <div class="user-content user-content_centered">
                <?= $staticText[StaticTextItem::TEXT]['text'] ?>
            </div>
        </section>
    </div>
<? endif; ?>