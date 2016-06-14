<?php

use yii\db\Migration;
use yii\db\Schema;

class m151109_051635_create_events_table extends Migration
{
    public function up()
    {
        $this->createTable('event', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'start_date' => Schema::TYPE_DATE . ' NOT NULL',
            'end_date' => Schema::TYPE_DATE,
            'notif_date' => Schema::TYPE_DATE,
            'place' => Schema::TYPE_STRING,
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'img' => Schema::TYPE_STRING ,

        ]);
    }

    public function down()
    {
        $this->dropTable('event');
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
