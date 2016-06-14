<?php

use yii\db\Migration;

class m151208_110648_add_event_place_organizer extends Migration
{
    public function up()
    {
        $this->addColumn('event','organizer',Schema::TYPE_STRING);

    }

    public function down()
    {
        $this->dropColumn('event','organizer');
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
