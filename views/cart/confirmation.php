<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<?php if (Yii::$app->session->hasFlash('success')) : ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php endif; ?>

<?php if (!empty($cart)) : ?>
    <div class="container table-responsive cart-container" style="padding: 15px;">
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
    </div>
<?php else : ?>
    <div class="container">
        <h4>Корзина пуста</h4>
    </div>
<?php endif; ?>
<div class="container">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($order, 'name') ?>
    <?= $form->field($order, 'phone') ?>
    <?= $form->field($order, 'address') ?>
    <?= $form->field($order, 'email') ?>
    <?= Html::submitButton('Подтвердить заказ', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end() ?>
</div>