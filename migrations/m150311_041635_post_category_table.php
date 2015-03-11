<?php

use yii\db\Schema;
use yii\db\Migration;

class m150311_041635_post_category_table extends Migration
{
    const TABLE_NAME = 'post_categories';

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable(self::TABLE_NAME, [
            'id'   => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
