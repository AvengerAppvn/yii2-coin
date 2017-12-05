<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "referer".
 *
 * @property integer $id
 * @property string $username
 * @property integer $user_id
 * @property integer $node
 * @property integer $level
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $logged_at
 */
class Referer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'node', 'level', 'status', 'created_at', 'updated_at', 'logged_at'], 'integer'],
            [['username'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'user_id' => 'User ID',
            'node' => 'Node',
            'level' => 'Level',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'logged_at' => 'Logged At',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefererQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefererQuery(get_called_class());
    }
}
