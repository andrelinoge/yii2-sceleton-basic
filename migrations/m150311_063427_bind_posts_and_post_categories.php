<?php

use yii\db\Schema;
use yii\db\Migration;

class m150311_063427_bind_posts_and_post_categories extends Migration
{
    const TABLE1_NAME = 'posts';
    const TABLE2_NAME = 'post_categories';
    const FK          = 'fk1';

    public function up()
    {
        $this->addForeignKey(self::FK, self::TABLE1_NAME, 'category_id', self::TABLE2_NAME, 'id','CASCADE','NO ACTION');
    }

    public function down()
    {
        $this->dropForeignKey(self::FK, self::TABLE1_NAME);
    }
}
