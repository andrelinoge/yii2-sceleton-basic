<?php

use yii\db\Schema;
use yii\db\Migration;

class m150312_035512_add_about_page extends Migration
{
    const TABLE_NAME = 'pages';

    public function up()
    {
        $this->insert(self::TABLE_NAME, [
            'slug' => 'about',
            'title' => 'about',
            'content' => 'Edit content from dashboard'
        ]);
    }

    public function down()
    {
        echo "m150312_035512_add_about_page cannot be reverted.\n";

        return false;
    }
}
