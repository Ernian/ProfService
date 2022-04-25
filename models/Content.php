<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "content".
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property int $sort
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'content';
    }

    public static function getContent($name)
    {
        return self::find()->where(['name' => $name])->all();
    }

    public static function getPageContent($page)
    {
        return self::prepareData(self::find()->asArray()->where(['page' => $page])->all());
    }

    public static function prepareData($data)
    {
        $array = [];
        foreach ($data as $item) {
            $array[$item['name']][] = $item['value'];
        }
        return $array;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            [['value'], 'string'],
            [['sort'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page' => 'Страница',
            'name' => 'Название',
            'value' => 'Содержание',
            'sort' => 'Порядок сортировки',
        ];
    }
}
