<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Orders */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">

    <h1>Заказ №<?= $model->id ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'total_count',
            'total_price',
            // 'status',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    if ($model->status == '0') return '<span class="text-danger">Не обработан</span>';
                    if ($model->status == '1') return '<span class="text-info">В работе</span>';
                    if ($model->status == '2') return '<span class="text-success">Выполнен</span>';
                },
                'format' => 'html',
            ],
            'name',
            'phone',
            'email:email',
            'address',
        ],
    ]) ?>

    <?php if (!empty($model->orderProducts)) : ?>
        <div class="container table-responsive cart-container" style="padding: 15px;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Цена</th>
                        <th>Количество</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($model->orderProducts as $product) : ?>
                        <tr>
                            <th>
                                <p>
                                    <a href="<?= Url::to(['/product/view', 'id' => $product->id]) ?>">
                                        <?= $product->product_name ?>
                                    </a>
                                </p>
                            </th>
                            <th><?= $product->product_price ?> &#8381;</th>
                            <th> <?= $product->product_qty ?> </th>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="container">
            <h4>Заказ пуст</h4>
        </div>
    <?php endif; ?>

</div>