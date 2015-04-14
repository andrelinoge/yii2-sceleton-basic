<?php

namespace app\components\behaviors;

use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use dosamigos\transliterator\TransliteratorHelper;

class Slug extends Behavior
{
	public $source      = 'name';
	public $destination = 'slug';
	public $translit    = true;

	public function events()
	{
		return [
			ActiveRecord::EVENT_BEFORE_VALIDATE => 'processSlug'
		];
	}

	public function processSlug($event)
	{
		$attribute = empty( $this->owner->{$this->destination} ) ? $this->source : $this->destination;
        $this->owner->{$this->destination} = $this->generateSlug( $this->owner->{$attribute} );
	}

	protected function generateSlug( $slug )
	{
	    $slug = $this->slugify( $slug );
	    if ( $this->checkUniqueSlug( $slug ) ) 
	    {
	        return $slug;
	    } 
	    else 
	    {
			$suffix   = 2;
			$new_slug = $slug . '-' . $suffix;

	    	while(!$this->checkUniqueSlug($new_slug))
	    	{
	    		$suffix++;
	    		$new_slug = $slug . '-' . $suffix;
	    	}

	        return $new_slug;
	    }
	}

	protected function checkUniqueSlug($string)
	{
	    $pk = $this->owner->primaryKey();
	    $pk = $pk[0];

		$condition = $this->destination . ' = :attribute';
		$params    = [ ':attribute' => $string ];

	    if ( !$this->owner->isNewRecord ) 
	    {
	        $condition .= ' AND ' . $pk . ' != :pk';
	        $params[':pk'] = $this->owner->{$pk};
	    }

	    return !$this->owner->find()
	        ->where( $condition, $params )
	        ->exists();
	}

	protected function slugify( $slug )
	{
	    if ( $this->translit ) 
	    {
	        return Inflector::slug( TransliteratorHelper::process( $slug ), '-', true );
	    } 
	    else 
	    {
	        return $this->slug( $slug, '-', true );
	    }
	}

	protected function slug( $string, $replacement = '-', $lowercase = true )
	{
		$string = preg_replace( '/[^\p{L}\p{Nd}]+/u', $replacement, $string );
		$string = trim( $string, $replacement );

		return $lowercase ? strtolower( $string ) : $string;
	}
}