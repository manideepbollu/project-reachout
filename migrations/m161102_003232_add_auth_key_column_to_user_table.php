<?php

use yii\db\Migration;

class m161102_003232_add_auth_key_column_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'auth_key', $this->string()->unique());
    }

    public function down()
    {
        $this->dropColumn('user', 'auth_key');
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
