<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

class UserSearch extends Model
{
	public $id;
	public $email;
	public $name;

	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['name', 'email'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'    => 'ID',
			'name'  => 'Name',
			'email' => 'Email',
		];
	}

	public function search($params)
	{
		$query = User::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) 
		{
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id' => $this->id
        ]);

		$query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email]);

		return $dataProvider;
	}
}
