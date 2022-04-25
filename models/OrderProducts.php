<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $product_name
 * @property string $product_price
 * @property int $product_qty
 */
class OrderProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_products';
    }

    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    static public function saveOrderProducts($cart, $orderId)
    {
        foreach ($cart as $id => $product) {
            $orderItems = new OrderProducts();
            $orderItems->order_id = $orderId;
            $orderItems->product_id = $id;
            $orderItems->product_name = $product['name'];
            $orderItems->product_price = $product['price'];
            $orderItems->product_qty = $product['qty'];
            $orderItems->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'product_name', 'product_price', 'product_qty'], 'required'],
            [['order_id', 'product_id', 'product_qty'], 'integer'],
            [['product_name', 'product_price'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    // public function attributeLabels()
    // {
    //     return [
    //         'id' => 'ID',
    //         'order_id' => 'Order ID',
    //         'product_id' => 'Product ID',
    //         'product_name' => 'Product Name',
    //         'product_price' => 'Product Price',
    //         'product_qty' => 'Product Qty',
    //     ];
    // }
}
