<?php

namespace app\models;

use yii\db\Expression;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int $total_count
 * @property int $total_price
 * @property int $status
 * @property string $customer_name
 * @property string $phone
 * @property string $email
 * @property string $address
 */
class Orders extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    public function getProducts()
    {
        return $this->hasMany(OrderProducts::class, ['order_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'email', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['total_count', 'total_price', 'status'], 'integer'],
            [['name', 'email', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'address' => 'Адрес',
        ];
    }
}
