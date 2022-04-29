<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\assets\FontAwesomeAsset;
use yii\bootstrap4\Html;
use yii\helpers\Url;

AppAsset::register($this);
FontAwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <nav class="">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <!-- <a class="navbar-brand" href="#">Brand</a> -->
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="<?= Url::home() ?>">ProfService</a></li>
                                <li><a href="#" class="route-link" data-controller="product" data-id="1">Кондиционеры</a></li>
                                <li><a href="#" class="route-link" data-controller="product" data-id="2">Генераторы</a></li>
                                <?php if (!Yii::$app->user->isGuest) : ?>
                                    <li><a href="<?= Url::to(['/admin']) ?>">Заказы</a></li>
                                <?php endif ?>
                                <li><a href="#" class="route-link" data-controller="site/contacts">Контакты</a></li>
                            </ul>
                            <form method="GET" action="<?= Url::to(['/search']) ?>" class="navbar-form navbar-left">
                                <div class="form-group">
                                    <input name="search" type="text" class="form-control" placeholder="Поиск товаров">
                                </div>
                                <button type="submit" class="btn btn-default"><i class="fa fa-search" style="font-size: 20px;"></i></button>
                            </form>
                            <ul class="nav navbar-nav navbar-right">
                                <li data-toggle="modal" data-target="#myModal">
                                    <a href="#" class="cart-link">
                                        <i class="fa fa-shopping-cart" style="font-size: 20px;"></i>
                                        <?php if (isset($_SESSION['totalPrice']) && $_SESSION['totalPrice'] !== 0) : ?>
                                            <span id="total-price" class="cart-amount"><?= $_SESSION['totalPrice'] ?></span>
                                        <?php endif ?>
                                        <?php if (isset($_SESSION['totalCount']) && $_SESSION['totalPrice'] !== 0) : ?>
                                            <span id="total-count" class="product-count"><?= $_SESSION['totalCount'] ?></span>
                                        <?php endif ?>
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ваши покупки</h4>
                </div>
                <div class="modal-body cart-container">
                    <?php if (isset($_SESSION['cartModal'])) : ?>
                        <div class="table-responsive" style="padding: 15px;">
                            <?= $_SESSION['cartModal'] ?>
                        </div>
                    <?php else : ?>
                        <h5>Корзина пуста</h5>
                    <?php endif ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-warning clear-cart">Очистить корзину</button>
                    <a href="<?= Url::to(['/cart/confirmation']) ?>" class="btn btn-primary">Оформить заказ</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Вход в админку</h4>
                </div>
                <div class="modal-body admin-form">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Войти</button>
                </div>
            </div>
        </div>
    </div>

    <main id="main-content">
        <?= $content ?>
    </main>


    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <div class="footer-about-us">
                        <h2>Prof<span>Service</span></h2>
                        <p>Описание описание описание описание описание описание описание описание описание описание</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="copyright">
                        <p>ProfService <?= date('Y') ?> &copy;</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End footer bottom area -->

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>