<?php

use yii\db\Schema;
use yii\db\Migration;

class m150414_195921_add_slug_field_for_posts_table extends Migration
{
    const TABLE_NAME = 'posts';
    const FIELD_NAME = 'slug';

    public function up()
    {
        $this->addColumn(self::TABLE_NAME, self::FIELD_NAME, Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn(self::TABLE_NAME, self::FIELD_NAME);
    }
}
