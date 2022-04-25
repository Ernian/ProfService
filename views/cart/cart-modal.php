<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php if (!empty($cart)) : ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Товар</th>
                <th>Цена</th>
                <th>Количество</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart as $id => $product) : ?>
                <tr>
                    <th>
                        <a href="<?= Url::to(['/product/view', 'id' => $id]) ?>">
                            <?= Html::img("@web/img/products-thumb/{$product['img-sm']}", [
                                'alt' => $product['name'],
                                'height' => 50
                            ]) ?>
                        </a>
                        <p>
                            <a href="<?= Url::to(['/product/view', 'id' => $id]) ?>">
                                <?= $product['name'] ?>
                            </a>
                        </p>
                    </th>
                    <th><?= $product['price'] ?> &#8381;</th>
                    <th>
                        <button class="btn btn-sm btn-product-qty" data-action="-" data-id="<?= $id ?>">-</button>
                        <?= $product['qty'] ?>
                        <button class="btn btn-sm btn-product-qty" data-action="+" data-id="<?= $id ?>">+</button>
                    </th>
                    <th>
                        <button class="btn del-product" data-id="<?= $id ?>">&#128465;</button>
                    </th>
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
<?php endif; ?>