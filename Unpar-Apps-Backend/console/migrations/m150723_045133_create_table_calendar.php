<?php

use yii\db\Schema;
use yii\db\Migration;

class m150723_045133_create_table_calendar extends Migration
{
    public function up()
    {
        $this->createTable('calendar', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'start_date' => Schema::TYPE_DATE . ' NOT NULL',
            'end_date' => Schema::TYPE_DATE,
            'notif_date' => Schema::TYPE_DATE,
            'note' => Schema::TYPE_TEXT,
        ]);
    }

    public function down()
    {

        $this->dropTable('calendar');

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
