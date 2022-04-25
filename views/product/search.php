<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'ProfService | Search';
?>
<div class="single-product-area ">
    <div class="zigzag-bottom footer-top-area"></div>
    <div class="container">
        <div class="row">

            <?php if (!empty($products)) : ?>
                <div class="col-md8">
                    <?php foreach ($products as $product) : ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="single-shop-product">
                                <div class="product-upper">
                                    <a href="<?= Url::to(['/product/view', 'id' => $product['id']]) ?>">
                                        <?= Html::img("@web/img/products/{$product['img']}", ['alt' => $product['name']]) ?>
                                    </a>
                                </div>
                                <h2><a href="<?= Url::to(['/product/view', 'id' => $product['id']]) ?>"><?= $product['name'] ?></a></h2>
                                <div class="product-carousel-price">
                                    Цена: <ins><?= $product['price'] ?></ins>
                                </div>
                                <div class="product-option-shop">
                                    <a class="add_to_cart_button add-to-cart" data-id="<?= $product['id'] ?>" href="#">В корзину</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php else : ?>
                <h2>По вашему запросу товаров не найдено</h2>
            <?php endif ?>
        </div>
        <?php if (isset($pages)) : ?>
            <div class=" row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        <?= LinkPager::widget([
                            'pagination' => $pages,
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>