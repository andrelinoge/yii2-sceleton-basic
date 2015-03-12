<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Page;
use yii\web\NotFoundHttpException;

class PagesController extends Controller
{
    public function actionAbout()
    {
        return $this->render('about', ['model' => $this->getModel('about')]);
    }

    protected function getModel($slug)
    {
    	$model = Page::findBySlug($slug);

    	if (!$model)
    	{
    		throw new NotFoundHttpException("Static page not exists", 1);
    	}

    	return $model;
    }
}
