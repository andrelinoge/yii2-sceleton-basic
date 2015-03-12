<?php

namespace app\modules\dashboard\controllers;

use app\modules\dashboard\models\UserForm;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;


class UsersController extends Controller
{
	public function actionIndex()
	{
        $searchModel  = new UserSearch;
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        Url::remember();

		return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
		]);
	}

	public function actionView($id)
	{
        Url::remember();
        
        return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	public function actionCreate()
	{
		$model = new UserForm;

		try 
        {
            if ($model->load($_POST) && $model->create()) 
            {
                return $this->redirect(Url::previous());
            } 
            elseif (!\Yii::$app->request->isPost) 
            {
                $model->load($_GET);
            }
        } 
        catch (\Exception $e) 
        {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            $model->addError('_exception', $msg);
		}

        return $this->render('create', ['model' => $model,]);
	}

	public function actionUpdate($id)
	{
		$model = new UserForm;
		$model->fetchUser($id);

		if ($model->load($_POST) && $model->update()) 
        {
            return $this->redirect(Url::previous());
		} 
        else 
        {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(Url::previous());
	}


	protected function findModel($id)
	{
		if (($model = User::findOne($id)) !== null) 
        {
			return $model;
		} 
        else 
        {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
