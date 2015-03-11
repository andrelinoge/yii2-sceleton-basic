<?php

namespace app\modules\dashboard;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\dashboard\controllers';
    public $layout = 'main'; // in layouts folder of module

    public function init()
    {
        parent::init();

        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin())
        {
        	return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
        }
    }
}
