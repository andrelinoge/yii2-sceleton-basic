<?php

use yii\db\Schema;
use yii\db\Migration;

class m150312_034608_pages_table extends Migration
{
    const TABLE_NAME = 'pages';

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable(self::TABLE_NAME, [
            'id'      => Schema::TYPE_PK,
            'title'   => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT,
            'slug'    => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);
 
        $this->createIndex('ind_slug', self::TABLE_NAME, 'slug');
    }

    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
