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
    <title>Admin | <?= Html::encode($this->title) ?></title>
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
                                <li><a href="<?= Url::to(['/conditioners', 'id' => 1]) ?>">Кондиционеры</a></li>
                                <li><a href="<?= Url::to(['/generators', 'id' => 2]) ?>">Генераторы</a></li>
                                <li><a href="<?= Url::to(['/admin/order']) ?>">Заказы</a></li>
                            </ul>
                            <form method="GET" action="<?= Url::to(['/search']) ?>" class="navbar-form navbar-left">
                                <div class="form-group">
                                    <input name="search" type="text" class="form-control" placeholder="Поиск товаров">
                                </div>
                                <button type="submit" class="btn btn-default"><i class="fa fa-search" style="font-size: 20px;"></i></button>
                            </form>
                            <ul class="nav navbar-nav navbar-right">
                                <li data-toggle="modal" data-target="#myModal">
                                    <a href="<?= Url::to(['/site/logout']) ?>" class="cart-link">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
        </div>
    </div> <!-- End mainmenu area -->

    <div class="container">
        <?= $content ?>
    </div>

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