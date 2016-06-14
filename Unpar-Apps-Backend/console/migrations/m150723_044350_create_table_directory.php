<?php

use yii\db\Schema;
use yii\db\Migration;

class m150723_044350_create_table_directory extends Migration
{
    public function up()
    {
        $this->createTable('directory', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'address' => Schema::TYPE_TEXT . ' NOT NULL',
            'phone' => Schema::TYPE_STRING . ' NOT NULL',
            'office_hour' => Schema::TYPE_STRING . ' NOT NULL',
            'note' => Schema::TYPE_TEXT,
            'photo' => Schema::TYPE_STRING,
            'category_id' => Schema::TYPE_INTEGER,
        ]);

        $this->addForeignKey('FK_Directory_Category', 'directory', 'category_id', 'category', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('FK_Directory_Category', 'directory');
        $this->dropTable('diretory');
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
