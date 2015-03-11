<?php

use yii\db\Schema;
use yii\db\Migration;
use yii\helpers\FileHelper;

class m150415_194422_posts_upload_folder extends Migration
{
    public function up()
    {
        FileHelper::createDirectory(\Yii::getAlias("@app/web/uploads/posts"), 755);
    }   

    public function down()
    {
        echo "m150415_194422_posts_upload_folder cannot be reverted.\n";

        return false;
    }
}
