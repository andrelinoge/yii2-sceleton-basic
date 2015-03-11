<?php

use yii\db\Schema;
use yii\db\Migration;

class m150311_041531_posts_table extends Migration
{
    const TABLE_NAME = 'posts';

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable(self::TABLE_NAME, [
            'id'          => Schema::TYPE_PK,
            'title'       => Schema::TYPE_STRING . ' NOT NULL',
            'content'     => Schema::TYPE_TEXT,
            'category_id' => Schema::TYPE_INTEGER,
            
            'created_at'  => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'updated_at'  => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        ], $tableOptions);
 
        $this->createIndex('ind_category_id', self::TABLE_NAME, 'category_id');
    }

    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
