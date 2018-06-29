<?php

namespace frontend\controllers;

use backend\models\CallbackProject;
use backend\models\Category;
use backend\models\DesignCollection;
use backend\models\Product;
use backend\models\StaticText;
use Yii;

use backend\models\File;


class DesignCollectionController extends Controller
{
    public function actionIndex()
    {
        $static = StaticText::findOne(4);
        if($static)
        {
            $static->fillMetaTags();
            $texts = $static->getItems()->indexBy('id')->asArray()->all();
        }



        $find = DesignCollection::find()->where(['active'=>1])->orderBy(['pos' => SORT_DESC]);

        $countFind = clone $find;
        $pages = new \yii\data\Pagination(['totalCount' => $countFind->count(), 'pageSize' => 3]);
        $models = $find->offset($pages->offset)->limit($pages->limit)->orderBy(['pos' => SORT_DESC])->all();

        return $this->render('index',compact('models','texts', 'pages'));
    }




}
