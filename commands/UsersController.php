<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\ControllerController;
use yii\console\Exception;
use app\models\User;

/**
 * This command adds some management of users.
 */
class UsersController extends ConsoleController
{
	public function actionIndex()
	{
		echo 'yii users/create' . PHP_EOL;
		echo 'yii users/create-admin' . PHP_EOL;
		echo 'yii users/remove' . PHP_EOL;
		echo 'yii users/change-password' . PHP_EOL;
	}

	public function actionCreate()
	{
		$model = $this->createUser();

		$model->asUser();

		$this->log($model->save());
	}

	public function actionCreateAdmin()
	{
		$model = $this->createUser();

		$model->asAdmin();

		$this->log($model->save());
	}

	protected function createUser()
	{
		$model = new User();

		$this->readValue($model, 'name');
		$this->readValue($model, 'email');

		$model->setPassword($this->prompt('Password:', [
			'required' => true,
			'pattern'  => '#^.{4,255}$#i',
			'error'    => 'More than 4 symbols',
		]));

		$model->generateAuthKey();

		return $model;
	}

	public function actionRemove()
    {
        $email = $this->prompt('Email:', ['required' => true]);
        $model = $this->findModel($email);
        $this->log($model->delete());
    }
 
    public function actionChangePassword()
    {
        $email = $this->prompt('EMail:', ['required' => true]);
        $model = $this->findModel($email);

        $model->setPassword($this->prompt('New password:', [
            'required' => true,
            'pattern' => '#^.{4,255}$#i',
            'error' => 'More than 4 symbols',
        ]));

        $this->log($model->save());
    }
 
    /**
     * @param string $username
     * @throws \yii\console\Exception
     * @return User the loaded model
     */
    private function findModel($email)
    {
        if (!$model = User::findOne(['email' => $email])) 
        {
            throw new Exception('User not found');
        }
        return $model;
    }
}