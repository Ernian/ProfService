<?php

namespace app\controllers;

use app\models\Cart;
use app\models\OrderProducts;
use app\models\Orders;
use Yii;

class CartController extends AppController
{
    public function actionAdd($id, $qty = 1)
    {
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($id, $qty);
        $this->layout = false;
        if ($session['totalCount'] == 0 || $session['totalPrice'] == 0) {
            Yii::$app->session->remove('cart');
            Yii::$app->session->remove('totalPrice');
            Yii::$app->session->remove('totalCount');
            return 'empty cart';
        }
        $session['cartModal'] = $this->render('cart-modal', [
            'cart' => $session['cart'],
            'totalPrice' => $session['totalPrice']
        ]);
        return json_encode([
            $session['totalCount'],
            $session['totalPrice'],
            $session['cartModal']
        ]);
    }

    public function actionDeleteProduct($id)
    {
        $cart = new Cart();
        $cart->deleteProduct($id);
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        if ($session['totalCount'] == 0 || $session['totalPrice'] == 0) {
            Yii::$app->session->remove('cart');
            Yii::$app->session->remove('totalPrice');
            Yii::$app->session->remove('totalCount');
            return 'empty cart';
        }
        $session['cartModal'] = $this->render('cart-modal', [
            'cart' => $session['cart'],
            'totalPrice' => $session['totalPrice']
        ]);
        return json_encode([
            $session['totalCount'],
            $session['totalPrice'],
            $session['cartModal']
        ]);
    }

    public function actionClearCart()
    {
        Yii::$app->session->remove('cart');
        Yii::$app->session->remove('totalPrice');
        Yii::$app->session->remove('totalCount');
        $this->layout = false;
        return $this->render('cart-modal', [
            'cart' => '',
        ]);
    }

    public function actionConfirmation()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->setMetaTags('Подтверждение заказа');
        $order = new Orders;
        if ($order->load(Yii::$app->request->post())) {
            $order->total_count = $session['totalCount'];
            $order->total_price = $session['totalPrice'];
            if ($order->save()) {
                Yii::$app->session->setFlash('success', 'Заказ подтвержден');
                OrderProducts::saveOrderProducts($session['cart'], $order->id);
                Yii::$app->mailer->compose('orderLetter', [
                    'cart' => $session['cart'],
                    'totalPrice' => $session['totalPrice']
                ])->setFrom(['test@mail.ru' => 'allias'])
                    ->setTo($order->email)
                    ->setSubject('Ваш заказ')
                    ->send();
                $session->remove('cart');
                $session->remove('totalPrice');
                $session->remove('totalCount');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
            }
        }
        return $this->render('confirmation', [
            'cart' => $session['cart'],
            'totalPrice' => $session['totalPrice'],
            'order' => $order,
        ]);
    }
}
