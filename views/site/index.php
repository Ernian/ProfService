<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
?>


<div class="slider-area">
    <div class="zigzag-bottom"></div>
    <div id="slide-list" class="carousel carousel-fade slide" data-ride="carousel">

        <div class="slide-bulletz">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="carousel-indicators slide-indicators">
                            <li data-target="#slide-list" data-slide-to="0" class="active"></li>
                            <li data-target="#slide-list" data-slide-to="1"></li>
                            <li data-target="#slide-list" data-slide-to="2"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-inner" role="listbox">
            <?php for ($i = 0; $i < count($homePage['slide-header']); $i++) : ?>
                <div class="item <?= $i == 0 ? 'active' : '' ?>">
                    <div class="single-slide">
                        <div class="slide-bg slide-<?= $i ?>"></div>
                        <div class="slide-text-wrapper">
                            <div class="slide-text">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-6">
                                            <div class="slide-content">
                                                <h2><?= $homePage['slide-header'][$i] ?></h2>
                                                <p><?= $homePage['slide-text'][$i] ?></p>
                                                <a href="#form" class="readmore"><?= $homePage['slide-button'][0] ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor ?>
        </div>

    </div>
</div> <!-- End slider area -->

<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <?php for ($i = 0; $i < count($homePage['advantage-title']); $i++) : ?>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <i class="<?= $homePage['advantage-icon'][$i] ?>"></i>
                        <p><?= $homePage['advantage-title'][$i] ?></p>
                    </div>
                </div>
            <?php endfor ?>
        </div>
    </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title"><?= $homePage['hit-product'][0] ?></h2>
                    <div class="product-carousel">
                        <?php if (count($hitProducts)) : ?>
                            <?php foreach ($hitProducts as $product) : ?>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <?= Html::img("@web/img/products/{$product['img']}") ?>
                                        <div class="product-hover">
                                            <a href="#" class="add-to-cart-link add-to-cart" data-id="<?= $product['id'] ?>"><i class="fa fa-shopping-cart"></i> В корзину</a>
                                            <a href="<?= Url::to(['/product/view', 'id' => $product['id']]) ?>" class="view-details-link"><i class="fa fa-link"></i>Подробнее</a>
                                        </div>
                                    </div>

                                    <h2><a href="<?= Url::to(['/product/view', 'id' => $product['id']]) ?>"><?= $product['name'] ?></a></h2>

                                    <div class="product-carousel-price">
                                        <ins><?= $product['price'] ?></a></ins>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->

<div class="brands-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <h2 class="section-title"><?= $homePage['client-header'][0] ?></h2>
                    <div class="brand-list">
                        <?php if (count($clients)) : ?>
                            <?php foreach ($clients as $client) : ?>
                                <a href="<?= Url::to($client['link']) ?>"><?= Html::img("@web/img/clients/{$client['img']}", ['alt' => $client['name']]) ?></a>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End brands area -->

<div class="product-widget-area">
    <!-- <div class="zigzag-bottom"></div> -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title"><?= $homePage['new-product'][0] ?></h2>
                    <?php if (count($newProducts)) : ?>
                        <?php foreach ($newProducts as $product) : ?>
                            <div class="single-wid-product">
                                <a href="<?= Url::to(['product/view', 'id' => $product['id']]) ?>">
                                    <?= Html::img("@web/img/products-thumb/{$product['img-sm']}", ['alt' => $product['name']]) ?>
                                </a>
                                <h2><a href="<?= Url::to(['product/view', 'id' => $product['id']]) ?>"><?= $product['name'] ?></a></h2>
                                <div class="product-wid-price">
                                    <ins><?= $product['price'] ?></ins>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title"><?= $homePage['sale-product'][0] ?></h2>
                    <?php if (count($saleProducts)) : ?>
                        <?php foreach ($saleProducts as $product) : ?>
                            <div class="single-wid-product">
                                <a href="<?= Url::to(['product/view', 'id' => $product['id']]) ?>">
                                    <?= Html::img("@web/img/products-thumb/{$product['img-sm']}", ['alt' => $product['name']]) ?>
                                </a>
                                <h2><a href="<?= Url::to(['product/view', 'id' => $product['id']]) ?>"><?= $product['name'] ?></a></h2>
                                <div class="product-wid-price">
                                    <ins><?= $product['price'] ?></ins>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title"><?= $homePage['viewed-product'][0] ?></h2>
                    <a href="#" class="wid-view-more">View All</a>
                    <div class="single-wid-product">
                        <a href="single-product.html">
                            <?= Html::img("@web/img/products-thumb/product-thumb-4.jpg") ?>
                        </a>
                        <h2><a href="single-product.html">Sony playstation microsoft</a></h2>
                        <div class="product-wid-price">
                            <ins>$400.00</ins>
                        </div>
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><?= Html::img("@web/img/products-thumb/product-thumb-1.jpg") ?></a>
                        <h2><a href="single-product.html">Sony Smart Air Condtion</a></h2>
                        <div class="product-wid-price">
                            <ins>$400.00</ins>
                        </div>
                    </div>
                    <div class="single-wid-product">
                        <a href="single-product.html"><?= Html::img("@web/img/products-thumb/product-thumb-2.jpg") ?></a>
                        <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>
                        <div class="product-wid-price">
                            <ins>$400.00</ins>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End product widget area -->

    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-6">
                </div>
                <div class="col-md-8 col-sm-8" id="form">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title"><?= $homePage['form-header'][0] ?></h2>
                        <p><?= $homePage['form-text'][0] ?></p>
                        <div class="newsletter-form">
                            <form action="#">
                                <input type="email" placeholder="Type your email">
                                <input type="submit" value="Отправить">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer top area -->