<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ContactForm;

class ContactController extends Controller
{

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) 
        {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } 
        else 
        {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
}