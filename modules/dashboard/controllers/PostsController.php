<?php

namespace app\modules\dashboard\controllers;

use yii;
use yii\web\Controller;

class PostsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionNew()
    {
        return $this->render('index');
    }

    public function actionEdit()
    {
        return $this->render('index');
    }
}
