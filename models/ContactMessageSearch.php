<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ContactMessage;

/**
 * ContactMessageSearch represents the model behind the search form about ContactMessage.
 */
class ContactMessageSearch extends Model
{
	public $id;
	public $subject;
	public $name;
	public $email;
	public $content;

	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['subject', 'name', 'email', 'content'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'subject' => 'Subject',
			'name' => 'Name',
			'email' => 'Email',
			'content' => 'Content',
		];
	}

	public function search($params)
	{
		$query = ContactMessage::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
        ]);

		$query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email]);

		return $dataProvider;
	}

	public function searchNew($params)
	{
		$query = ContactMessage::find()->where(['is_new' => 1]);
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'id' => $this->id,
        ]);

		$query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email]);

		return $dataProvider;
	}
}
