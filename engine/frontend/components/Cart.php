<?php

namespace frontend\components;

use backend\models\Order;
use backend\models\OrderItem;
use yii\base\Component;
use Yii;
/**
 * Class Cart
 *
 * @package frontend\components
 *
 * @property Order $order
 * @property string $status
 *
 */
class Cart extends Component
{
    const SESSION_KEY = 'order_id';

    private $_order;

    public function add($productId, $count,$params)
    {
        $link = OrderItem::findOne(['product_id' => $productId, 'order_id' => $this->order->id]);
        if (!$link) {
            $link = new OrderItem();
        }

        $link->product_id = $productId;
        $link->order_id = $this->order->id;
        $link->count += $count;
        $link->params = $params;

        return $link->save();
    }

    public function getOrder()
    {
        if ($this->_order == null) {
            $this->_order = Order::findOne(['id' => $this->getOrderId()]);
        }

        return $this->_order;
    }

    public function createOrder()
    {
        $order = new Order();
        if ($order->save()) {
            $this->_order = $order;
            return true;
        }
        return false;
    }

    private function getOrderId()
    {
        if (!Yii::$app->session->has(self::SESSION_KEY)) {
            if ($this->createOrder()) {
                Yii::$app->session->set(self::SESSION_KEY, $this->_order->id);
            }
        }
        return Yii::$app->session->get(self::SESSION_KEY);
    }

    public function delete($productId)
    {
        $link = OrderItem::findOne(['product_id' => $productId, 'order_id' => $this->getOrderId()]);
        if (!$link) {
            return false;
        }
        return $link->delete();
    }

    public function setCount($productId, $count)
    {
        $link = OrderItem::findOne(['product_id' => $productId, 'order_id' => $this->getOrderId()]);
        if (!$link) {
            return false;
        }
        $link->count = $count;
        return $link->save();
    }

    public function getStatus()
    {
        if ($this->isEmpty()) {
            return Yii::t('app', 'пуста');
        }
        return Yii::t('app', '{productsCount, number} {amount}', [
            'productsCount' => $this->order->productsCount,
            'amount' => $this->order->amount
        ]);
    }

    public function isEmpty()
    {
        if (!Yii::$app->session->has(self::SESSION_KEY)) {
            return true;
        }
        return $this->order->productsCount ? false : true;
    }

}