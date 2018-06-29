<?php

/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 17.03.2017
 * Time: 9:59
 */
class SurlRule
{
    public $controller;
    public $action = 'view';

    public function createUrl($manager, $route, $params)
    {
        if($route == $this->controller)
        {
            if(isset($params['id']) && isset($params['surl']))
            {
                return 'product/' . $params['id'] . '-' . $params['surl'] . '/';
            }elseif(isset($params['id']))
            {
                return 'product/' . $params['id'] .'/';
            }
        }
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        if(preg_match('%product/(\d+)[-]?([-a-z0-9_]*)?/%',$pathInfo,$matches))
        {
            $product = Product::find()->where(['=','id' , $matches[1]])->select('id,surl')->asArray()->one();
            if($product == null)
                throw new NotFoundHttpException();
            if(isset($matches[2]))
            {
                if(trim($matches[2]) != trim($product['surl']))
                {
                    \Yii::$app->response->redirect(['product/view','id' => $product['id'],'surl' => $product['surl']],301)->send();
                    exit();
                }
            }
//            print_r($matches);die;
            return [
                'product/view',[
                    'id' => $matches[1]
                ]];
        }
        return false;
    }
}