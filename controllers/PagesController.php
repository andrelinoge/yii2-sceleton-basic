<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class PagesController extends Controller
{
    public function actionAbout()
    {
        return $this->render('about');
    }
}
