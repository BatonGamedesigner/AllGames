<?php

namespace frontend\controllers;

use backend\models\Base;
use backend\models\CallbackProject;
use backend\models\Page;
use backend\models\Callback;
use backend\models\PageItem;
use Yii;

class PageController extends Controller
{
    public function actionSu($surl)
    {
        $model = Page::find()->where(['surl' => $surl])->andWhere(['active' => 1])->one();
        return $this->extractMhetod($model);
    }

    public function actionView($id)
    {
        $model = Page::findOne(['id' => $id,'active' => 1]);
        return $this->extractMhetod($model);
    }

    /**
     * Andrianov A.M.
     * @param $model
     * @return string
     */
    public function extractMhetod($model)
    {
        $this->processModel($model);

        $text = $model->getItems()->indexBy('id')->all();

        $this->view->params['reCapthaKey'] = Base::RE_CAPTHA_PUBLIC;

        $this->view->params['callback'] = new CallbackProject();
        $message = '';

        if($this->view->params['callback']->load(\Yii::$app->request->post()) && $this->view->params['callback']->save())
        {
            $this->view->params['callback']['message'] = 'Спасибо! Наши менеджеры свяжутся с Вами в ближайшее время.';

        }
        return $this->render('view',compact('model','text', 'phones', 'message'));

    }


}
