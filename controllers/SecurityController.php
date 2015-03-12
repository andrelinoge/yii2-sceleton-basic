<?php

namespace app\controllers;

use Yii;
use app\models\User;

class SecurityController extends Controller
{
    public function actionConfirmEmail($token)
    {
        $user = User::findByEmailConfirmToken($token);

        if ($user)
        {
            $user->confirmEmail();

            if (Yii::$app->user->isGuest)
            {
                Yii::$app->user->login($user, 0);
            }

            Yii::$app->session->setFlash('notify', 'Email confirmed!')
        }

        return $this->render('confirmation');
    }
}