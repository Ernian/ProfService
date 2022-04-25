<?php

namespace app\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function addToCart($id, $qty)
    {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty'] += $qty;
            $_SESSION['totalPrice'] += $qty * $_SESSION['cart'][$id]['price'];
            $_SESSION['totalCount'] += $qty;
            if ($_SESSION['cart'][$id]['qty'] === 0) {
                unset($_SESSION['cart'][$id]);
                if (empty($_SESSION['cart'])) {
                    $_SESSION['totalPrice'] = 0;
                    $_SESSION['totalCount'] = 0;
                    return;
                }
            }
        } else {
            $product = Products::find()->asArray()->where(['id' => $id])->one();
            if (empty($product)) return false;
            $_SESSION['cart'][$product['id']] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'img' => $product['img'],
                'img-sm' => $product['img-sm'],
                'qty' => $qty,
            ];
            $_SESSION['totalPrice'] = isset($_SESSION['totalPrice']) ?
                $_SESSION['totalPrice'] + $qty * $_SESSION['cart'][$id]['price'] :
                $qty * $_SESSION['cart'][$id]['price'];
            $_SESSION['totalCount'] = isset($_SESSION['totalCount']) ?
                $_SESSION['totalCount'] + $qty : $qty;
        }
    }

    public function deleteProduct($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['totalPrice'] -= $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
            $_SESSION['totalCount'] -= $_SESSION['cart'][$id]['qty'];
            unset($_SESSION['cart'][$id]);
        }
    }
}
