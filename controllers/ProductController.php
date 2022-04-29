<?php

namespace app\controllers;

use app\models\Products;
use yii\data\Pagination;
use yii\web\HttpException;
use Yii;

class ProductController extends AppController
{
    public function actionIndex($id)
    {
        $this->setMetaTags('ProfService | ' . getTitle(Yii::$app->request->url));
        $query = Products::find()->asArray()->where(['category_id' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 9,
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        if (empty($products)) {
            $this->setMetaTags('ProfService');
            throw new HttpException(404, 'Категория товаров не найдена');
        }
        $this->layout = false;
        return json_encode($this->render('products', compact('products', 'pages')));
    }

    public function actionView($id)
    {
        $product = Products::find()->asArray()->where(['id' => $id])->one();
        if (empty($product)) {
            $this->setMetaTags('ProfService');
            throw new HttpException(404, 'Товар не найден');
        }
        $this->setMetaTags(
            'ProfService | ' . $product['name'],
            $product['meta-keywords'],
            $product['meta-description']
        );
        $this->layout = false;
        return json_encode($this->render('view', compact('product')));
    }

    public function actionSearch()
    {
        $search = trim(Yii::$app->request->get('search'));
        if (!$search) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $query = Products::find()
            ->asArray()
            ->where([
                'like',
                'name',
                $search,
            ]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 9,
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products', 'pages', 'search'));
    }
}
