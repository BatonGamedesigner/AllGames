<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use backend\widgets\AndNav;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use backend\models\Page;
use backend\models\StaticTextItem;
use backend\models\UserRole;
use backend\models\Base;
use backend\models\PageItem;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <!--<script>//var INLINE_SVG_REVISION = <? //=filemtime(\Yii::getAlias('@frontend/web/svg.html'))?>;</script>-->

        <meta charset="<?= Yii::$app->charset ?>">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?= Html::csrfMetaTags() ?>

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body class="body">
    <?php $this->beginBody() ?>

    <?

    $isAbout = \Yii::$app->request->url == $this->params[Page::PAGE_PREFIX . Page::ABOUT_COMPANY]['linkOut'];
    $isContacts = \Yii::$app->request->url == $this->params[Page::PAGE_PREFIX . Page::CONTACTS_PAGE]['linkOut'];
    $isDelivery = \Yii::$app->request->url == $this->params[Page::PAGE_PREFIX . Page::DELIVERY]['linkOut'];
    $isMain = \Yii::$app->controller->id == 'site';
    $isCategory = \Yii::$app->controller->id == 'category';
    $isDesign = \Yii::$app->controller->id == 'design-collection';
    $isReview = \Yii::$app->controller->id == 'review';
    $isError = \Yii::$app->controller->action->id  == 'error';
    //$isProduct = \Yii::$app->controller->id == 'product';
    //$isView = \Yii::$app->controller->action->id == 'view';
    ?>

    <? require_once('_navItems.php'); ?>

    <div class="page" id="vue-app">
        <header class="header">
            <div class="header__wrapper">
                <div class="header__container">
                    <div class="header__column header__column_logo">
                        <a href="/" class="logo">
                            <h1>ALLGAMES</h1>
                        </a>
                    </div>
                    <div class="header__column header__column_large header__column_clear_right">
                        <div class="socials">

                            <? if (!empty($this->params['contacts'][PageItem::CONTACTS_VK]['text'])): ?>
                                <a class="socials__item"
                                   href="<?= $this->params['contacts'][PageItem::CONTACTS_VK]['text'] ?>">
                                    <svg class="socials__icon">
                                        <use xlink:href="#icon-vk"></use>
                                    </svg>
                                </a>
                            <? endif; ?>
                            <? if (!empty($this->params['contacts'][PageItem::CONTACTS_INSTA]['text'])): ?>
                                <!-- убирает пробелы между инлайн блоками
               --><a class="socials__item" href="<?= $this->params['contacts'][PageItem::CONTACTS_INSTA]['text'] ?>">
                                    <svg class="socials__icon">
                                        <use xlink:href="#icon-instagram"></use>
                                    </svg>
                                </a><!--
           -->              <? endif; ?>
                            <? if (!empty($this->params['contacts'][PageItem::CONTACTS_ODNOKLASSNIKI]['text'])): ?>
                                <a class="socials__item"
                                   href="<?= $this->params['contacts'][PageItem::CONTACTS_ODNOKLASSNIKI]['text'] ?>">
                                    <svg class="socials__icon">
                                        <use xlink:href="#icon-odnoklassniki"></use>
                                    </svg>
                                </a>
                            <? endif; ?>
                            <? if (!empty($this->params['contacts'][PageItem::CONTACTS_FACEBOOK]['text'])): ?>

                                <!--
               --><a class="socials__item" href="<?= $this->params['contacts'][PageItem::CONTACTS_FACEBOOK]['text'] ?>">
                                    <svg class="socials__icon">
                                        <use xlink:href="#icon-facebook"></use>
                                    </svg>
                                </a>
                            <? endif; ?>
                        </div>
                    </div>
                    <div class="header__column header__column_search">
                        <? require_once('_search.php'); ?>
                    </div>
                    <div class="header__column">
                        <a class="badge" href="tel:<?= $this->params['contacts'][PageItem::CONTACTS_PHONE]['text'] ?>">
                            <div class="badge__image">
                                <svg class="badge__icon">
                                    <use xlink:href="#icon-phone"></use>
                                </svg>
                            </div>
                            <div class="badge__label"><?= $this->params['contacts'][PageItem::CONTACTS_PHONE]['text'] ?></div>
                        </a>
                    </div>
                    <div id="cart" class="header__column header__column_clear_right">
                        <? require_once('_cart.php'); ?>
                    </div>
                </div>
            </div>
        </header>
        <? if (!empty($menuItems)): ?>
            <div class="navigation <?= ($isMain && !$isError) ? 'navigation_transparent' : '' ?> js-navigation">
                <div class="navigation__wrapper">
                    <div class="navigation__button js-navigation__button">
                        <span class="navigation__line"></span>
                        <span class="navigation__line"></span>
                        <span class="navigation__line"></span>
                    </div>
                    <nav class="header-nav navigation__content js-navigation__content">
                        <ul class="header-nav__list">

                            <? foreach ($menuItems as $item): ?>
                                <li class="<?= $item['class'] ?> <?= $item['active'] ?>">
                                    <? if (isset($item['subItems']) && !empty($item['subItems'])): ?>
                                        <a class="header-nav__link"
                                           href="<?= $item['url'] ?>">
                                            <?= $item['label'] ?>
                                            <svg class="header-nav__icon">
                                                <use xlink:href="#icon-arrow-down"></use>
                                            </svg>
                                        </a>
                                        <div class="header-nav__dropdown">
                                            <div class="dropdown">
                                                <ul class="dropdown__content">
                                                    <? foreach ($item['subItems'] as $subItem): ?>
                                                        <li class="dropdown__item <?= ($subItem['active']) ? 'active' : '' ?>">
                                                            <a class="dropdown__link"
                                                               href="<?= $subItem['url'] ?>"><?= $subItem['label'] ?></a>
                                                        </li>
                                                    <? endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <? else: ?>
                                        <a href="<?= $item['url'] ?>"
                                           class="header-nav__link"><?= $item['label'] ?></a>
                                    <? endif; ?>
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        <? endif; ?>
        <main class="main">
            <? if ((!$isMain && !$isContacts) || $isError): ?>
                <div class="wrapper">
                    <div class="page__section-xs">
                        <?= \backend\widgets\AndBreadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'tag' => 'ul',
                            'options' => ['itemtype' => "http://schema.org/BreadcrumbList", 'class' => 'breadcrumb'],
                            'itemTemplate' => '<li class="breadcrumb__list" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">{link}</li>',
                            'activeItemTemplate' => '<li class="breadcrumb__list active">{link}</li>',
                            'openContainerTag' => $this->params['breadcrumbsOpenContainerTag'],
                            'closeContainerTag' => $this->params['breadcrumbsCloseContainerTag'],
                        ])
                        ?>
                    </div>

                    <?= $content ?>
                </div>
                <div class="info info_decorated">
                    <div class="wrapper">
                        <div class="info__container">
                            <div class="info__column info__column_shrink">
                                <div class="info-title">
                                    <!-- добавлен модификатор info-title__icon -->
                                    <svg class="info-title__icon info-title__icon_dark">
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
                                <a href="#popup_question"
                                   class="button button_size_l button_color_dark button_transparent js-popup__open" data-effect="mfp-zoom-in">Задать
                                    вопрос</a>
                            </div>
                        </div>
                    </div>
                </div>

            <? else: ?>

                <?= $content ?>

            <? endif; ?>
        </main>

        <footer class="footer">
            <div class="wrapper">
                <div class="footer__container">
                    <? if (!empty($menuItems)): ?>
                        <div class="footer__column footer__column_grow">
                            <ul class="footer-nav">
                                <? foreach ($menuItems as $item): ?>
                                    <li class="footer-nav__item active">
                                        <a class="footer-nav__link"
                                           href="<?= $item['url'] ?>"><?= $item['label'] ?></a>
                                    </li>
                                <? endforeach; ?>
                            </ul>
                        </div>
                    <? endif; ?>
                    <div class="footer__column">
                        &copy; <?= date('Y') ?> Компания IRONWOOD<br>
                        <a href="<?= $this->params[Page::PAGE_PREFIX . Page::PRIVACY]['linkOut'] ?>"
                           class="link link_light">Политика конфиденциальности</a>
                    </div>
                    <div class="footer__column">
                        <a class="bees-logo" href="http://onlinebees.ru/" target="_blank">
                            <svg class="bees-logo__icon">
                                <use xlink:href="#icon-bees-logo"></use>
                            </svg>
                            <div class="bees-logo__text">
                                Разработка сайта<br>
                                onlinebees.ru
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
        <div id="popup_question" class="popup mfp-with-anim mfp-hide">
            <? require_once('_callback_form.php'); ?>
        </div>
        <?php $this->endBody() ?>

        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function () {
                    try {
                        w.yaCounter46898283 = new Ya.Metrika({
                            id: 46898283,
                            clickmap: true,
                            trackLinks: true,
                            accurateTrackBounce: true,
                            webvisor: true
                        });
                    } catch (e) {
                    }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () {
                        n.parentNode.insertBefore(s, n);
                    };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript>
            <div><img src="https://mc.yandex.ru/watch/46898283" style="position:absolute; left:-9999px;" alt=""/></div>
        </noscript>
        <!-- /Yandex.Metrika counter -->

    </body>
    </html>
<?php $this->endPage() ?>