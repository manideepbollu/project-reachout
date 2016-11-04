<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_thread`.
 */
class m161102_180554_create_user_thread_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_thread', [
            'id' => $this->primaryKey(),
            'user1_id' => $this->integer(),
            'user2_id' => $this->integer(),
            'created_time' => $this->string(),
            'updated_time' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_thread');
    }
}
