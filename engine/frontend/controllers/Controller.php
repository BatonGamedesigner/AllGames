<?php

namespace frontend\controllers;


use backend\models\Base;
use backend\models\CallbackProject;
use backend\models\PageItem;
use backend\models\StaticTextItem;
use yii\web\NotFoundHttpException;
use backend\models\Page;
use backend\models\Callback;

class Controller extends \yii\web\Controller
{

    public function beforeAction($action)
    {
//        $lang = $_COOKIE['langFrontend'];
//        if ($lang == Base::RU) {
//            \Yii::$app->language = Base::RU;
//        } elseif ($lang == Base::EN) {
//            \Yii::$app->language = Base::EN;
//        }

        $page = Page::findAll(['id' => [Page::ABOUT_COMPANY, Page::DELIVERY, Page::CONTACTS_PAGE, Page::PRIVACY], 'active' => 1]);
        foreach ($page as $model) {
            $this->view->params[Page::PAGE_PREFIX . $model->id]['name'] = $model->name;
            $this->view->params[Page::PAGE_PREFIX . $model->id]['action'] = $model->surl ? ['page/su', 'surl' => $model->surl] : ['page/view', 'id' => $model->id];
            $this->view->params[Page::PAGE_PREFIX . $model->id]['linkOut'] = $model->linkOut;
        }

        $this->view->params['contacts'] = PageItem::find()
            ->where(['id' => [
                PageItem::CONTACTS_VK,
                PageItem::CONTACTS_INSTA,
                PageItem::CONTACTS_ODNOKLASSNIKI,
                PageItem::CONTACTS_FACEBOOK,
                PageItem::CONTACTS_PHONE,
            ]])
            ->indexBy('id')
            ->all();

        $this->view->params['callback'] = new CallbackProject();
        $this->view->params['message'] = null;
        if($this->view->params['callback']->load(\Yii::$app->request->post()) && $this->view->params['callback']->save())
        {
            $this->view->params['message'] = "Мы с вами скоро свяжемся";
        }



        if (!parent::beforeAction($action)) {
            return false;
        }

        $this->view->params['reCapthaKey'] = Base::RE_CAPTHA_PUBLIC;

        //$session = \Yii::$app->session;
        //$session->open();
        //    $this->view->params['cart_cost'] = $_SESSION['total_cost'];
        //$session->close();
        // other custom code here

        return true; // or false to not run the action
    }

    protected function processModel($model)
    {
        if (!$model) {
            throw new NotFoundHttpException();
        }
        $model->fillMetaTags();
    }
}
