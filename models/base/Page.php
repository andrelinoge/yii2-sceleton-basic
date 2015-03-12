<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $slug
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['content'], 'string'],
            [['title', 'slug'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'title'   => 'Title',
            'content' => 'Content',
            'slug'    => 'Slug',
        ];
    }
}
