<?php
//
//namespace frontend\controllers;
//
//use backend\controllers\CommonControllerTrait;
//use backend\models\Review;
//use backend\models\ReviewPhoto;
//use backend\models\StaticText;
//use backend\models\UploadModel;
//use Yii;
//
//use backend\models\File;
//use yii\data\ActiveDataProvider;
//use yii\web\UploadedFile;
//
//
//class ReviewController extends Controller
//{
//
//    public function actionIndex()
//    {
//        //$static = StaticText::findOne(4);
//        //if($static)
//        //{
//        //    $static->fillMetaTags();
//        //    $texts = $static->getItems()->indexBy('id')->asArray()->all();
//        //}
//        $model = new Review();
//        $uploadModel = new UploadModel();
//
//        $message = null;
//
//        $find = Review::find()->where(['active' => 1])->orderBy(['pos' => SORT_DESC]);
//
//        $countFind = clone $find;
//        $pages = new \yii\data\Pagination(['totalCount' => $countFind->count(), 'pageSize' => 1]);
//        $models = $find->offset($pages->offset)->limit($pages->limit)->orderBy(['pos' => SORT_DESC])->all();
//
//        if ($model->load(Yii::$app->request->post())&& $model->save()) {
//            $uploadModel->f = UploadedFile::getInstances($uploadModel, 'f');
//            $this->uploadImageAndSaveMany($model, $uploadModel);
//
//            $message = "Спасибо , Мы с вами скоро свяжемся";
//            return $this->render('index', compact('models', 'texts', 'pages', 'message', 'uploadModel'));
//        }
//
//        return $this->render('index', compact('models', 'texts', 'pages', 'message', 'uploadModel', 'model'));
//    }
//
//    private function uploadImageAndSaveMany($model, $uploadModel)
//    {
//        $find = $this->findPhotos();
//        $paths = [];
//        $resize = [];
//
//        if ($uploadModel->f) {
//
//            foreach ($uploadModel->f as $file){
//
//                $m = new ReviewPhoto();
//                $m->ext = $file->extension;
//                $m->review_id = $model->id;
//                $m->pos = $find->max('pos') + 1;
//                $m->save();
//
//                $paths[] = $m->getUploadPath(['real' => true, 'front'=>true, 'parent_id'=>$model->id]) . $m->review_id. '/'. $m->id;
//
//                $resize[] = $m;
//
//            }
//
//            $uploadModel->uploadMany($paths);
//
//            foreach ($resize as $image) {
//                $image->resizeReviewImages();
//            }
//
//        }
//
//
//        return $model;
//    }
//
//    protected function findPhotos()
//    {
//        return ReviewPhoto::find();
//    }
//
//
//}
