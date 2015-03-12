<?php

namespace app\modules\dashboard\controllers;

use app\models\Page;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;

/**
 * PagesController implements the CRUD actions for Page model.
 */
class PagesController extends Controller
{
	/**
	 * Lists all Page models.
	 * @return mixed
	 */
	public function actionIndex()
	{
        $searchModel  = new Page;
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        Url::remember();

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel'  => $searchModel,
		]);
	}

	/**
	 * Displays a single Page model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
        Url::remember();
        
        return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Updates an existing Page model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load($_POST) && $model->save()) 
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

	/**
	 * Finds the Page model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Page the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Page::findOne($id)) !== null) 
        {
			return $model;
		} 
        else 
        {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
