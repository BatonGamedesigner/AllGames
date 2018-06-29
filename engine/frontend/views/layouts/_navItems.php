<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 31.03.2017
 * Time: 15:17
 */
use backend\models\Page;
use backend\models\Category;
use backend\models\DesignCollection;
use backend\models\Review;

$category_items = [];
foreach (\backend\models\Category::find()->select(['id', 'name', 'surl'])->where(['category_id' => 0, 'active' => 1])->orderBy(['pos' => SORT_DESC])->all() as $cur) {
    $category_items[] = ['label' => $cur->name, 'url' => $cur->linkOut, 'active' => $cur->isActive];
}

$menuItems = [
    ['label' => 'Главная', 'url' => '/', 'class' => 'header-nav__list-item', 'active' => ($isMain)?'active':''],
    ['label' => \Yii::t('app', Category::NAME), 'url' => '/category/','active' => ($isCategory)?'active':'', 'class' => 'header-nav__list-item header-nav__list-item_has-dropdown js-header-nav__button', 'subItems' => $category_items],
    ['label'=> $this->params[Page::PAGE_PREFIX.Page::ABOUT_COMPANY]['name'], 'url'=> $this->params[Page::PAGE_PREFIX.Page::ABOUT_COMPANY]['linkOut'], 'class' => 'header-nav__list-item', 'active' => ($isAbout)?'active':''],
    ['label'=> \Yii::t('app', DesignCollection::NAME), 'url'=>'/design-collection/','class' => 'header-nav__list-item', 'active' => ($isDesign)?'active':''],
    //['label'=> \Yii::t('app', Review::NAME), 'url' => '/review/', 'class' => 'header-nav__list-item', 'active' => ($isReview)?'active':''],
    ['label'=> $this->params[Page::PAGE_PREFIX.Page::DELIVERY]['name'], 'url'=> $this->params[Page::PAGE_PREFIX.Page::DELIVERY]['linkOut'], 'class' => 'header-nav__list-item', 'active' => ($isDelivery)?'active':''],
    ['label' => $this->params[Page::PAGE_PREFIX . Page::CONTACTS_PAGE]['name'],'class' => 'header-nav__list-item', 'url' => $this->params[Page::PAGE_PREFIX . Page::CONTACTS_PAGE]['linkOut'], 'active' => ($isContacts)?'active':''],

];
//$navItems = [];
//if (Yii::$app->user->isGuest) {
//    $navItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
//    $navItems[] = ['label' => 'Login', 'url' => ['/site/login']];
//} else {
//    $navItems[] = [
//        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
//        'url' => ['site/logout'],
//        'linkOptions' => ['data-method' => 'post']
//    ];
//}
