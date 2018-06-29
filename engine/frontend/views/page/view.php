<?php

use yii\helpers\Html;
use frontend\assets\FancyBoxAsset;
use yii\helpers\Url;
use backend\models\PageItem;
use backend\models\Page;

/* @var $this yii\web\View */
/* @var $model Page */
//FancyBoxAsset::register($this);

$this->params['breadcrumbs'] = ['label' => $model->name];
?>
<? if ($model->id === Page::CONTACTS_PAGE): ?>
    <? $this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru_RU'); ?>
    <?php foreach ($model->maps as $i => $pageMap): ?>
        <?php
        $map_text = addslashes(str_replace(["\r\n", "\n", "\r"], '', $pageMap->name_on_map));
        // var_dump($map_text);die();
        $latitude = $pageMap->latitude;
        $longitude = $pageMap->longitude;
        ?>
        <?php
        $myPlacemark .= <<< MARK
          myPlacemark_$i = new ymaps.Placemark([$latitude, $longitude], {
                            balloonContentBody:'$map_text',
                            hintContent: 'IronWood',
                            iconContent: 'IronWood',
                            
                        }, {
                            preset: 'islands#blueStretchyIcon',
                        });
                    myMap_1.geoObjects.add(myPlacemark_$i);

MARK;

        ?>
    <? endforeach ?>


    <?php
    $maps = '';
    $latitude = $pageMap->latitude ? $pageMap->latitude : 53.199449;
    $longitude = $pageMap->longitude ? $pageMap->longitude : 45.020121;
    $map_text = trim($pageMap->name_on_map);
    $m = <<< MAP

                var myMap_1 = new ymaps.Map('map_1', {
                    // При инициализации карты, обязательно нужно указать
                    // ее центр и коэффициент масштабирования
                    center: [$latitude, $longitude], // Метка
                    //center: [53.199449, 45.020121], // Пенза
                    zoom: 12
                });
                if (window.innerWidth < 1025) {
                   myMap.behaviors.disable('drag');
                 }

               

MAP;
    $maps = $m . $myPlacemark;

    ?>

    <?php

    $ya_maps_js = <<< JS

        ymaps.ready(init);

        function init () {

            // Создание экземпляра карты и его привязка к контейнеру с заданным id ("map")
            $maps
        }
JS;

    $this->registerJs($ya_maps_js);
    ?>
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

        <section class="page__section">
            <h1 class="title title_size_l"><?= hp($model->name) ?></h1>
        </section>
    </div>
    <section class="section section_decorated section_size_m">
        <div class="wrapper">
            <div class="section__content">
                <div class="panels">
                    <div class="panels__item panels__item_left">
                        <div class="title title_size_s">Нас легко найти</div>
                        <div class="page__section-xs">
                            <ul class="list">
                                <li class="list__item">
                                    <div class="list__cell list__cell_first">
                                        <div class="large-icon">
                                            <svg class="large-icon__svg">
                                                <use xlink:href="#icon-marker"></use>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="list__cell"><?= $text[PageItem::CONTACTS_ADDRESS]['text'] ?></div>
                                </li>
                                <li class="list__item">
                                    <div class="list__cell list__cell_first">
                                        <div class="large-icon">
                                            <svg class="large-icon__svg">
                                                <use xlink:href="#icon-phone"></use>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="list__cell">
                                        <a href="tel:<?= $text[PageItem::CONTACTS_PHONE]['text'] ?>"><?= $text[PageItem::CONTACTS_PHONE]['text'] ?></a>
                                    </div>
                                </li>
                                <li class="list__item">
                                    <div class="list__cell list__cell_first">
                                        <div class="large-icon">
                                            <svg class="large-icon__svg">
                                                <use xlink:href="#icon-email"></use>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="list__cell">
                                        <a href="mailto:<?= $text[PageItem::CONTACTS_MAIL]['text'] ?>"><?= $text[PageItem::CONTACTS_MAIL]['text'] ?></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="page__section-l">
                            <div class="title title_size_s">Часы работы</div>
                            <div class="page__section-xs">
                                <div class="user-content">
                                    <?= $text[PageItem::CONTACTS_WORK_HOURS]['text'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="title title_size_s">Мы в соц. сетях</div>
                        <div class="page__section-xs">
                            <ul class="list">
                                <? if (!empty($text[PageItem::CONTACTS_VK]['text'])): ?>
                                    <li class="list__item">
                                        <div class="list__cell list__cell_first">
                                            <div class="large-icon">
                                                <svg class="large-icon__svg">
                                                    <use xlink:href="#icon-vk"></use>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="list__cell">
                                            <a href="<?= $text[PageItem::CONTACTS_VK]['text'] ?>"><?= $text[PageItem::CONTACTS_VK]['text'] ?></a>
                                        </div>
                                    </li>
                                <? endif; ?>
                                <? if (!empty($text[PageItem::CONTACTS_VK]['text'])): ?>
                                    <li class="list__item">
                                        <div class="list__cell list__cell_first">
                                            <div class="large-icon">
                                                <svg class="large-icon__svg">
                                                    <use xlink:href="#icon-instagram"></use>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="list__cell">
                                            <a href="<?= $text[PageItem::CONTACTS_INSTA]['text'] ?>"><?= $text[PageItem::CONTACTS_INSTA]['text'] ?></a>
                                        </div>
                                    </li>
                                <? endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="panels__item panels__item_right">
                        <?= $this->render('_callback_form.php', compact('message')) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="map" id="map_1"></div>


<? elseif ($model->id == Page::ABOUT_COMPANY): ?>
    <section class="page__section">
        <h1 class="title title_size_l"><?= hp($model->name) ?></h1>
        <div class="page__section-main">
            <div class="user-content">
                <?= hp($text[PageItem::ABOUT_TEXT]['text']) ?>
            </div>
        </div>
    </section>
<? elseif ($model->id == Page::PRIVACY): ?>
    <section class="page__section">
        <h1 class="title title_size_l"><?= hp($model->name) ?></h1>
        <div class="page__section-main">
            <div class="user-content">
                <?= hp($text[PageItem::PRIVACY]['text']) ?>
            </div>
        </div>
    </section>
<? elseif ($model->id == Page::DELIVERY): ?>
    <section class="page__section">
        <h1 class="title title_size_l"><?= hp($model->name) ?></h1>
        <div class="page__section-main">
            <div class="user-content">
                <?= hp($text[PageItem::DELIVERY]['text']) ?>
            </div>
        </div>
    </section>
<? endif; ?>