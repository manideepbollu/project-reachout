<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m161102_180919_create_message_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey(),
            'content' => $this->text(),
            'content_type' => $this->string(),
            'thread_id' => $this->integer(),
            'author_id' => $this->integer(),
            'created_time' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('message');
    }
}
