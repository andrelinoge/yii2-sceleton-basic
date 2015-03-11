<?php

use yii\db\Schema;
use yii\db\Migration;

class m150311_220716_add_image_field_for_posts_table extends Migration
{
    const TABLE_NAME = 'posts';
    const FIELD_NAME = 'image';

    public function up()
    {
        $this->addColumn(self::TABLE_NAME, self::FIELD_NAME, Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn(self::TABLE_NAME, self::FIELD_NAME);
    }
}
