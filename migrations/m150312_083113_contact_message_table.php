<?php

use yii\db\Schema;
use yii\db\Migration;

class m150312_083113_contact_message_table extends Migration
{
    const TABLE_NAME = 'contact_messages';

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable(self::TABLE_NAME, [
            'id'      => Schema::TYPE_PK,
            'subject' => Schema::TYPE_STRING,
            'name'    => Schema::TYPE_STRING,
            'email'   => Schema::TYPE_STRING,
            'content' => Schema::TYPE_TEXT,
            'is_new'  => Schema::TYPE_SMALLINT,

            'created_at'  => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'updated_at'  => Schema::TYPE_TIMESTAMP . ' NOT NULL',
        ], $tableOptions);
 
    }

    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
