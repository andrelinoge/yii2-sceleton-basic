<?php

namespace app\models\base;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "contact_messages".
 *
 * @property integer $id
 * @property string $subject
 * @property string $name
 * @property string $email
 * @property string $content
 * @property integer $is_new
 */
class ContactMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['subject', 'name', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'subject' => 'Subject',
            'name'    => 'Name',
            'email'   => 'Email',
            'content' => 'Content',
            'is_new'  => 'Is new'
        ];
    }

    public function behaviors()
    {
      return [
          [
              'class' => TimestampBehavior::className(),
              'value' => new Expression('NOW()')
          ]
      ];
    }

    public function beforeSafe()
    {
        if ($this->isNewRecord)
        {
            $this->is_new = true;
        }

        return parent::beforeSafe();
    }
}
