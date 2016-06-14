<?php

use yii\db\Migration;
use yii\db\Schema;

class m151109_055623_create_like_status_table extends Migration
{
    public function up()
    {
        $this->createTable('like_status', [
            'id' => Schema::TYPE_PK,
            'id_aspirasi' => Schema::TYPE_INTEGER. ' NOT NULL',
            'id_gadget' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT. ' NOT NULL',
        ]);
        $this->addForeignKey('fk_gadget','like_status','id_gadget','gadget','id');
        $this->addForeignKey('fk_aspirasi','like_status','id_aspirasi','aspiration','id');

    }

    public function down()
    {
        $this->dropTable('like_status');
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
