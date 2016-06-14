<?php

use yii\db\Migration;
use yii\db\Schema;

class m151109_052352_add_tipe_column extends Migration
{
    public function up()
    {
        $this->addColumn('news','tipe',Schema::TYPE_SMALLINT);
    }

    public function down()
    {
        $this->dropColumn('news','tipe');
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
