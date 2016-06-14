<?php

use yii\db\Migration;

class m151204_044219_update_event_table extends Migration
{
    public function up()
    {
        $this->addColumn('event','tipe',Schema::TYPE_SMALLINT);
        $this->addColumn('event','status',Schema::TYPE_SMALLINT);
    }

    public function down()
    {
        echo "m151204_044219_update_event_table cannot be reverted.\n";

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
