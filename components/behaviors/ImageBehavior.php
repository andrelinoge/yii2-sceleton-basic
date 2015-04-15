<?php

namespace app\components\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\imagine\Image;
use yii\web\UploadedFile;

class ImageBehavior extends Behavior
{
	public $attribute  = 'image';
	public $folder     = '';
	public $url        = '';
	public $thumbnails = [];

	protected $currentImage = '';

	public function init()
	{
		parent::init();

		if (empty($this->folder))
		{
			$this->folder = "@webroot/uploads/" . $this->owner->tableName() . '/';
		}

		if (empty($this->url))
		{
			$this->url = "@webroot/uploads/" . $this->owner->tableName() . '/';
		}

		$this->currentImage = $this->owner->{$this->attribute};
	}

	public function events()
	{
		return [
			ActiveRecord::EVENT_BEFORE_VALIDATE => 'assignImage',
			ActiveRecord::EVENT_BEFORE_INSERT   => 'saveImage',
			ActiveRecord::EVENT_BEFORE_UPDATE   => 'updateImage',
			ActiveRecord::EVENT_AFTER_DELETE    => 'deleteImage'
		];
	}

	public function assignImage()
	{
		$this->owner->{$this->attribute} = UploadedFile::getInstance($this->owner, $this->attribute);
	}

	public function saveImage()
	{
		if ($this->owner->{$this->attribute})
		{

		}
	}

	public function updateImage()
	{
		if ($this->owner->{$this->attribute} instanceof UploadedFile)
		{

		}
	}

	public function deleteImage($filename = '')
	{
		if (empty($filename))
		{
			$filename = $this->owner->{$this->attribute};
		}

		foreach(array_keys($this->thumbnails) as $prefix)
		{

		}
	}

	public function getSrc($prefix = '')
	{

	}

	public function getPath($prefix = '')
	{

	}
}