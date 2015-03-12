<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact_messages".
 */
class ContactMessage extends \app\models\base\ContactMessage
{
	public static function countOfNewMessages()
	{
		return static::find()->where(['is_new' => 1])->count();
	}

	public function markAsRead()
	{
		$this->is_new = false;
		$this->save();
	}
}
