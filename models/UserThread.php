<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_thread".
 *
 * @property integer $id
 * @property integer $user1_id
 * @property integer $user2_id
 * @property string $created_time
 * @property string $updated_time
 */
class UserThread extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_thread';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user1_id', 'user2_id'], 'integer'],
            [['created_time', 'updated_time'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user1_id' => 'User1 ID',
            'user2_id' => 'User2 ID',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }

    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['thread_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        $return = parent::beforeSave($insert);
        if ($this->isNewRecord)
            $this->created_time = time();
        $this->updated_time = time();
        return $return;
    }

}
