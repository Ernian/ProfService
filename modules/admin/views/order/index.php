<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\modules\admin\models\Orders;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            // 'updated_at',
            // 'total_count',
            'total_price',
            // 'status',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    if ($data->status === 0) return '<span class="text-danger">Не обработан</span>';
                    if ($data->status === 1) return '<span class="text-info">В работе</span>';
                    if ($data->status === 2) return '<span class="text-success">Выполнен</span>';
                },
                'format' => 'html',
            ],
            //'name',
            //'phone',
            //'email:email',
            //'address',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Orders $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>