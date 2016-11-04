<?php

use yii\db\Migration;

/**
 * Handles adding title_and_last_seen to table `user`.
 */
class m161102_082321_add_title_and_last_seen_columns_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'title', $this->string());
        $this->addColumn('user', 'last_seen', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'title');
        $this->dropColumn('user', 'last_seen');
    }
}
