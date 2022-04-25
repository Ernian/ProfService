<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int $total_count
 * @property int $total_price
 * @property int $status
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'total_count', 'total_price', 'name', 'phone', 'email', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['total_count', 'total_price', 'status'], 'integer'],
            [['name', 'email', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 30],
        ];
    }

    public function getOrderProducts()
    {
        return $this->hasMany(OrderProducts::class, ['order_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Заказа',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'total_count' => 'Количество товаров',
            'total_price' => 'Общая стоимость',
            'status' => 'Статус',
            'name' => 'Покупатель',
            'phone' => 'Телефон',
            'email' => 'Email',
            'address' => 'Адрес',
        ];
    }
}
