<?php

namespace frontend\controllers;

use backend\models\Order;
use backend\models\OrderItem;
use backend\models\Product;
use backend\models\StaticText;
use common\models\Payer;
use frontend\controllers\Controller;
use backend\models\Base;
use Yii;
use yii\filters\VerbFilter;

/* @var $product Product */
class CartController extends Controller
{
    public $CART_NAME = 'Корзина';

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add-in-cart' => ['post'],
                    'set-count' => ['post'],
                    'delete-from-cart' => ['post'],
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        $order = new Order();
        //unset($_SESSION['cart']);
        $products = $this->getProducts();

        if ($order->load(Yii::$app->request->post()) && $order->save()) {

            foreach ($products as $product) {
                $link = new OrderItem();
                $link->order_id = $order->id;
                $link->product_id = $product->id;
                $link->params = json_encode($product->paramsBuf);
                $link->cost = $product->cost;
                $link->count = $product->count;
                $link->cost_total = $product->amount;

                $link->save();
            }

            unset($_SESSION['cart']);

            return $this->render('result');

        } else {
            $static = StaticText::findOne(StaticText::CART);
            if ($static) {
                $static->fillMetaTags();
                // $texts = $static->getItems()->asArray()->all();
            }
            return $this->render('index', compact('products', 'static', 'order'));
        }
    }

    public function actionAddInCart()
    {
        $postData = Yii::$app->request->post();

        $session = Yii::$app->session;
        $session->open();

        $productBuf = [
            'product_id' => $postData['product_id'],
            'count' => $postData['count'],
            'params' => $postData['params'],
            'paramTotalCost' =>  $postData['paramTotalCost']
        ];
        $event = null;

        if (!empty($_SESSION['cart']['products'])){
            foreach ($_SESSION['cart']['products'] as $id => $product) {
                if ($product['product_id'] == $productBuf['product_id']) {
                    if ($product['params'] == $productBuf['params']) {
                        $_SESSION['cart']['products'][$id]['count'] += $productBuf['count'];
                        $event = 'change';
                        break;
                    }
                }
            }
        }

        if (empty($event)){
            $_SESSION['cart']['products'][] = $productBuf;
        }

        $session->close();

        return json_encode($this->recalculate());
    }

    public function actionSetCount()
    {
        $postData = Yii::$app->request->post();


        $_SESSION['cart']['products'][$postData['cart_id']]['count'] = $postData['count'];
        $product = Product::findOne([['id' => $_SESSION['cart']['products'][$postData['cart_id']]['product_id']]]);

        $product->paramsTotalCost = $_SESSION['cart']['products'][$postData['cart_id']]['paramTotalCost'];
        $amount = number_format((($product->cost + $product->paramsTotalCost) * $postData['count']), 0, '', '&nbsp;') . '&nbsp;р.';

        $result = $this->recalculate();
        $result = array_merge($result, ['amount' => $amount]);

        return json_encode($result);
    }

    public function actionDeleteFromCart()
    {
        $postData = Yii::$app->request->post();

        unset($_SESSION['cart']['products'][$postData['cart_id']]);

        return json_encode($this->recalculate());
    }

    /**
     * @return array
     */
    public function recalculate()
    {
        $session = Yii::$app->session;
        $session->open();

        $_SESSION['cart']['total_count'] = $_SESSION['cart']['total_sum'] = 0;

        $products = $this->getProducts();
        if ($products) {
            foreach ($products as $product) {

                $_SESSION['cart']['total_sum'] += $product->amount;
                $_SESSION['cart']['total_count'] += $product->count;
            }
        }
        $result = [
            'totalSum' => number_format(($_SESSION['cart']['total_sum']), 0, '', '&nbsp;') . '&nbsp;р.',
            'totalCount' => $_SESSION['cart']['total_count'],
            'cart' => $this->renderPartial('@frontend/views/layouts/_cart.php')
        ];

        $session->close();

        return $result;
    }

    /**
     * Получает текущие товары заказа из сессии
     *
     * @return array
     */
    public function getProducts()
    {
        $products = [];

        if (!empty($_SESSION['cart']['products'])) {
            foreach ($_SESSION['cart']['products'] as $prod) {
                $product = Product::findOne(intval($prod['product_id']));
                $product->paramsBuf = json_decode($prod['params']);
                $product->paramsTotalCost = $prod['paramTotalCost'];
                $product->count = ($prod['count'] > 0) ? $prod['count'] : 1;

                $product->amount = ($product->cost + $product->paramsTotalCost) * $product->count;
                $products[] = $product;
            }
        }

        return $products;
    }
}
