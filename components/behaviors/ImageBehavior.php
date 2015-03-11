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

	protected $oldImage = '';

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
		$this->oldImage = $this->owner->getOldAttribute($this->attribute);

		$this->owner->{$this->attribute} = UploadedFile::getInstance($this->owner, $this->attribute);
	}

	public function saveImage()
	{
		if ($this->owner->{$this->attribute} instanceof UploadedFile)
		{
			$file     = $this->owner->{$this->attribute};
			$newName = substr(md5($file->baseName . time()), 10) . '.' . $file->extension;

			$file->saveAs($this->folder . $newName );

			foreach($this->thumbnails as $prefix => $size)
			{
				list($width, $height) = $size;

				Image::thumbnail($this->folder . $newName, $width, $height)
    				->save($this->folder . $prefix . $newName);
			}

			$this->owner->{$this->attribute} = $newName;
		}
	}

	public function updateImage()
	{
		if ($this->owner->{$this->attribute} instanceof UploadedFile)
		{
			$this->deleteImage($this->oldImage);
			$this->saveImage();
		}
	}

	public function deleteImage($fileName = '')
	{
		if (empty($fileName))
		{
			$fileName = $this->owner->{$this->attribute};
		}

		foreach(array_keys($this->thumbnails) as $prefix)
		{
			unlink($this->getPath($prefix, $fileName));
		}

		unlink($this->getPath('', $fileName));
	}

	public function getSrc($prefix = '', $fileName = '')
	{
		if (empty($fileName))
		{
			$fileName = $this->owner->{$this->attribute};
		}

		return $this->url . $prefix . $fileName;
	}

	public function getPath($prefix = '', $fileName = '')
	{
		if (empty($fileName))
		{
			$fileName = $this->owner->{$this->attribute};
		}

		return $this->folder . $prefix . $fileName;
	}
}