<?php

use yii\db\Schema;
use yii\db\Migration;

class m150312_035529_add_is_confirmed_field_for_users_table extends Migration
{
    const TABLE_NAME = 'users';
    const FIELD_NAME = 'is_email_confirmed';

    public function up()
    {
        $this->addColumn(self::TABLE_NAME, self::FIELD_NAME, Schema::TYPE_BOOLEAN);
    }

    public function down()
    {
        $this->dropColumn(self::TABLE_NAME, self::FIELD_NAME);
    }
}
