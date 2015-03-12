<?php

namespace app\modules\dashboard\controllers;

use app\models\ContactMessage;
use app\models\ContactMessageSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;

/**
 * ContactMessagesController implements the CRUD actions for ContactMessage model.
 */
class ContactMessagesController extends Controller
{
	public function actionIndex()
	{
		$searchModel = new ContactMessageSearch;
		$dataProvider = $searchModel->search($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	public function actionOnlyNew()
	{
		$searchModel = new ContactMessageSearch;
		$dataProvider = $searchModel->searchNew($_GET);

        Url::remember();
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single ContactMessage model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);
		$model->markAsRead();

        Url::remember();
        return $this->render('view', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing ContactMessage model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		return $this->redirect(Url::previous());
	}

	/**
	 * Finds the ContactMessage model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return ContactMessage the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = ContactMessage::findOne($id)) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
