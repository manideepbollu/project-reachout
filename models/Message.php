<?php

namespace app\models;

use app\models\user\User;
use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property string $content
 * @property string $content_type
 * @property integer $thread_id
 * @property integer $author_id
 * @property string $created_time
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['thread_id', 'author_id'], 'integer'],
            [['content_type', 'created_time'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'content_type' => 'Content Type',
            'thread_id' => 'Thread ID',
            'author_id' => 'Author ID',
            'created_time' => 'Created Time',
        ];
    }

    public function getThread()
    {
        return $this->hasOne(UserThread::className(), ['id' => 'thread_id']);
    }

    public function beforeSave($insert)
    {
        $return = parent::beforeSave($insert);
        if ($this->isNewRecord)
            $this->created_time = time();
        return $return;
    }
}
