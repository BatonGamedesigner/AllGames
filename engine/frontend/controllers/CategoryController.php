<?php

namespace frontend\controllers;

use backend\models\CallbackProject;
use backend\models\Category;
use backend\models\Product;
use backend\models\StaticText;
use Yii;

use backend\models\File;


class CategoryController extends Controller
{
    public function actionIndex()
    {
        //$static = StaticText::findOne(4);
        //if($static)
        //{
        //    $static->fillMetaTags();
        //    $texts = $static->getItems()->indexBy('id')->asArray()->all();
        //}

        $models = Category::find()->where(['active' => 1, 'category_id' => 0])->orderBy(['pos' => SORT_DESC])->all();

        //$session = \Yii::$app->session;
        //$session->open();
        //    unset($_SESSION['additional']);
        //$session->close();

        return $this->render('index', compact('models', 'texts'));
    }

    public function actionSu($surl)
    {
        $model = Category::find()->where(['surl' => $surl])->andWhere(['active' => 1])->one();
        $this->processModel($model);

        $find = $model->getProducts()->orderBy(['pos' => SORT_DESC]);

        $countFind = clone $find;
        $pages = new \yii\data\Pagination(['totalCount' => $countFind->count(), 'pageSize' => Product::PER_PAGE]);
        $models = $find->offset($pages->offset)->limit($pages->limit)->orderBy(['pos' => SORT_DESC])->all();
        $banners = $model->getPhotos()->orderBy(['pos' => SORT_DESC])->all();

        return $this->render('view', compact('model', 'models', 'pages', 'banners'));
    }

    public function actionView($id)
    {
        $model = Category::findOne(['id' => $id, 'active' => 1]);

        $find = $model->getProducts()->orderBy(['pos' => SORT_DESC]);

        $countFind = clone $find;
        $pages = new \yii\data\Pagination(['totalCount' => $countFind->count(), 'pageSize' => Product::PER_PAGE]);
        $models = $find->offset($pages->offset)->limit($pages->limit)->orderBy(['pos' => SORT_DESC])->all();
        $banners = $model->getPhotos()->orderBy(['pos' => SORT_DESC])->all();
        $this->processModel($model);
        return $this->render('view', compact('model', 'models', 'pages', 'banners'));

    }

    /**
     * @return string
     */
    public function actionSearch()
    {
        $query = \Yii::$app->request->get('query', null);

        $find = Product::find()->where(['like', 'name', $query])->orderBy(['pos' => SORT_DESC]);

        $countFind = clone $find;
        $pages = new \yii\data\Pagination(['totalCount' => $countFind->count(), 'pageSize' => Product::PER_PAGE]);
        $models = $find->offset($pages->offset)->limit($pages->limit)->orderBy(['pos' => SORT_DESC])->all();

        return $this->render('search', compact('models', 'pages', 'query'));
    }

    public static function getBreadcrumbs($category_id = 0, $hideLastLink = true)
    {
        $breadcrumbs = [];

        while ($m = Category::findOne($category_id)) {
            $breadcrumbs[] = ['label' => $m->name, 'url' => $m->linkOut];

            $category_id = $m->category_id;
        }

        $breadcrumbs = array_reverse($breadcrumbs);

        if ($hideLastLink) {
            unset($breadcrumbs[count($breadcrumbs) - 1]['url']);
        }

        if (count($breadcrumbs) > 0 || !$category_id) {
            array_unshift($breadcrumbs, ['label' => Category::NAME, 'url' => ['category/index']]);
        } else {
            array_unshift($breadcrumbs, ['label' => Category::NAME]);

        }

        return $breadcrumbs;

    }


}
