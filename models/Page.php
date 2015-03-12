<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "pages".
 */
class Page extends \app\models\base\Page
{
	public function search($params)
	{
		$query = Page::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) 
		{
			return $dataProvider;
		}

		$query->andFilterWhere([
			'title' => $this->title,
        ]);

		$query->andFilterWhere(['like', 'title', $this->title]);

		return $dataProvider;
	}

	public static function findBySlug($slug)
	{
		return static::findOne(['slug' => $slug]);
	}
}
