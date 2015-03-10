<?php

use yii\db\Schema;
use yii\db\Migration;

class m150226_012354_table_user extends Migration
{
    const TABLE_NAME = 'users';

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable(self::TABLE_NAME, [
            'id'                   => Schema::TYPE_PK,
            'created_at'           => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'updated_at'           => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'name'                 => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key'             => Schema::TYPE_STRING . '(32) NULL DEFAULT NULL',
            'email_confirm_token'  => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'password_hash'        => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING . ' NULL DEFAULT NULL',
            'email'                => Schema::TYPE_STRING . ' NOT NULL',
            'role'                 => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
        ], $tableOptions);
 
        $this->createIndex('idx_user_name', self::TABLE_NAME, 'name');
        $this->createIndex('idx_user_email', self::TABLE_NAME, 'email');
    }

    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
