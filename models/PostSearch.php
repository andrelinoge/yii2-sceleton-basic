<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form about Post.
 */
class PostSearch extends Model
{
	public $id;
	public $title;
	public $content;
	public $category_id;
	public $created_at;
	public $updated_at;

	public function rules()
	{
		return [
			[['id', 'category_id'], 'integer'],
			[['title', 'content', 'created_at', 'updated_at'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'          => 'ID',
			'title'       => 'Title',
			'content'     => 'Content',
			'category_id' => 'Category',
			'created_at'  => 'Created At',
			'updated_at'  => 'Updated At',
		];
	}

	public function search($params)
	{
		$query = Post::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) 
		{
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id'          => $this->id,
			'category_id' => $this->category_id,
			'created_at'  => $this->created_at,
			'updated_at'  => $this->updated_at,
        ]);

		$query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
		if (trim($value) === '') 
		{
			return;
		}

		if ($partialMatch) 
		{
			$value = '%' . strtr($value, ['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']) . '%';
			$query->andWhere(['like', $attribute, $value]);
		} 
		else 
		{
			$query->andWhere([$attribute => $value]);
		}
	}
}
