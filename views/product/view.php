<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <?= Html::img("@web/img/products/{$product['img']}") ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name"><?= $product['name'] ?></h2>
                                <div class="product-inner-price">
                                    <ins><?= $product['price'] ?></ins>
                                </div>
                                <form action="<?= Url::to(['cart/add', 'id' => $product['id']]) ?>" class="cart">
                                    <div class="quantity">
                                        <input id="inputQty" type="number" class="input-text qty text" title="Количество" value="1" name="qty" min="1" step="1">
                                    </div>
                                    <button class="add_to_cart_button add-to-cart" type="submit" data-id="<?= $product['id'] ?>">В корзину</button>
                                </form>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                        <h2>Описание товара</h2>
                                        <p><?= $product['description'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>