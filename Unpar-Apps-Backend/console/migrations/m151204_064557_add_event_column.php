<?php

use yii\db\Migration;
use yii\db\Schema;

class m151204_064557_add_event_column extends Migration
{
    public function up()
    {
        $this->addColumn('event','cp1',Schema::TYPE_STRING. ' NOT NULL');
        $this->addColumn('event','cp2',Schema::TYPE_STRING);

    }

    public function down()
    {
        $this->dropColumn('event','cp1');
        $this->dropColumn('event','cp2');
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
