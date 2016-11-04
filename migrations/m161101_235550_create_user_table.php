<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m161101_235550_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string()->notNull(),
            'lastname' => $this->string(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
