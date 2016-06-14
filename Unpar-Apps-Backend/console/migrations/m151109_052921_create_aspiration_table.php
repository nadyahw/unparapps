<?php

use yii\db\Migration;
use yii\db\Schema;

class m151109_052921_create_aspiration_table extends Migration
{
    public function up()
    {
        $this->createTable('aspiration', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'create_date' => Schema::TYPE_DATETIME . ' NOT NULL',
            'img' => Schema::TYPE_STRING ,
            'status'=>Schema::TYPE_SMALLINT . ' NOT NULL',
        ]);

    }

    public function down()
    {
        $this->dropTable('aspiration');
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
