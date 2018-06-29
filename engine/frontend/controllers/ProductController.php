<?php

namespace frontend\controllers;

use backend\models\Package;
use backend\models\PackageColor;
use backend\models\Product;
use backend\models\ProductPhoto2;
use kcfinder\dir;
use yii\db\Expression;
use backend\models\Callback;
use Yii;
use backend\models\Category;
use yii\web\Session;

class ProductController extends Controller
{


    public function actionSu($surl)
    {
        $model = Product::findOne(['surl' => $surl]);
        return $this->extractMethod($model);
    }

    public function actionView($id)
    {
        $model = Product::findOne($id);
        return $this->extractMethod($model);
    }

    /**
     * Andrianov A.M.
     * @param $model
     * @return string|\yii\web\Response
     */
    public function extractMethod($model)
    {

        $model->fillMetaTags();

        $gallery = $model->getPhotos()->orderBy(['pos' => SORT_DESC])->all();
        $otherProducts = Product::find()->where(['category_id'=>$model->category_id])->andWhere(['!=','id', $model->id])->orderBy(['pos' => SORT_DESC])->all();
//        $callback = new Callback();
//        $message = '';
//        if($callback->load(Yii::$app->request->post()) && $callback->save())
//        {
//            $message = "Спасибо , Мы с вами скоро свяжемся";
//            //return $this->renderAjax('callback_form',compact('callback','message'));
//        }

        return $this->render('view', compact('model', 'callback', 'message', 'gallery', 'otherProducts'));
    }


    /**
     * @return array
     */
    public function getBreadcrumbs()
    {
        $breadcrumbs = [];
        $category_id = Yii::$app->request->queryParams['ProductSearch']['category_id'];
        $is_index_page = true;

        if(!$category_id && Yii::$app->request->queryParams['category_id'])
        {
            $is_index_page = false;
            $category_id =  Yii::$app->request->queryParams['category_id'];
        }

        while($m = Category::findOne($category_id))
        {
            $link = $is_index_page ? $m->parentLink : $m->childLink;
            $breadcrumbs[] = ['label' => $m->name , 'url' => $m->childLink];

            $category_id = $m->category_id;

        }
        $breadcrumbs = array_reverse($breadcrumbs);

        if($is_index_page)
            unset($breadcrumbs[count($breadcrumbs)-1]['url']);

        if(count($breadcrumbs) > 0 || !$category_id)
        {
            array_unshift($breadcrumbs,['label' =>'Коллекции' , 'url' => ['category/index'] ]);
        }
        else
        {
            array_unshift($breadcrumbs,['label' =>'Коллекции']);
        }

        return $breadcrumbs;

    }
}
