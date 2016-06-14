<?php

use yii\db\Schema;
use yii\db\Migration;

class m150723_044826_create_table_news extends Migration
{
    public function up()
    {
        $this->createTable('news', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'thumbnail' => Schema::TYPE_STRING,
            'create_date' => Schema::TYPE_DATETIME,
            'update_date' => Schema::TYPE_DATETIME,
        ]);
    }

    public function down()
    {
        $this->dropTable('news');
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
