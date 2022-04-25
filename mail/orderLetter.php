<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Товар</th>
            <th>Цена</th>
            <th>Количество</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cart as $id => $product) : ?>
            <tr>
                <th>
                    <a href="<?= Url::to(['/product/view', 'id' => $id]) ?>">
                        <?= $product['name'] ?>
                    </a>
                </th>
                <th><?= $product['price'] ?> &#8381;</th>
                <th><?= $product['qty'] ?></th>
            </tr>
        <?php endforeach ?>
        <tr>
            <th colspan="3"></th>
            <th>
                <h5>Общая стоимость:</h5> <?= $totalPrice ?>
            </th>
        </tr>
    </tbody>
</table>