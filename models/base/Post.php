<?php

namespace app\models\base;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use app\components\behaviors\SlugBehavior;

/**
 * This is the base-model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $category_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PostCategory $category
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['content'], 'string'],
            [['category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255]
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
            'slug'        => 'Slug'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(\app\models\PostCategory::className(), ['id' => 'category_id']);
    }

    public function behaviors()
    {
      return [
          [
              'class' => TimestampBehavior::className(),
              'value' => new Expression('NOW()')
          ],
          [
            'class'  => SlugBehavior::className(),
            'source' => 'title'
          ]
      ];
    }
}
