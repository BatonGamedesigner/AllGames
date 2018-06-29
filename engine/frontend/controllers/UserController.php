<?php
//
//namespace frontend\controllers;
//
//use frontend\models\User;
//use backend\models\StaticText;
//use frontend\controllers\Controller;
//
//class UserController extends Controller
//{
//
//    public function actionView($id)
//    {
//        $model = User::findOne(['id' => $id,'activate' => 1]);
//        $this->processModel($model);
//        return $this->render('view',compact('model'));
//    }
//
//
//    protected function processModel($model)
//    {
//        if(!$model)
//        {
//            throw new NotFoundHttpException();
//        }
//    }
//
//}
