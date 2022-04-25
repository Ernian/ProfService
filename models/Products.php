<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property string $meta-keywords
 * @property string $meta-description
 * @property string $img
 * @property int $hit
 * @property int $new
 * @property int $sale
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'description', 'price', 'meta-keywords', 'meta-description', 'img', 'hit', 'new', 'sale'], 'required'],
            [['category_id', 'hit', 'new', 'sale'], 'integer'],
            [['description'], 'string'],
            [['name', 'meta-keywords', 'meta-description', 'img'], 'string', 'max' => 255],
            [['price'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'meta-keywords' => 'Meta Keywords',
            'meta-description' => 'Meta Description',
            'img' => 'Img',
            'hit' => 'Hit',
            'new' => 'New',
            'sale' => 'Sale',
        ];
    }
}
