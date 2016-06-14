<?php

use yii\db\Schema;
use yii\db\Migration;

class m150723_044150_create_table_category extends Migration
{
    public function up()
    {
        $this->createTable('category', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'icon' => Schema::TYPE_STRING,
        ]);
    }

    public function down()
    {
        $this->dropTable('category');
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
