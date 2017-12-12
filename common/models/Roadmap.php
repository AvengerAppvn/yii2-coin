<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "roadmap".
 *
 * @property integer $id
 * @property integer $level
 * @property double $price
 * @property integer $amount
 * @property string $date_from
 * @property string $date_to
 * @property string $time_from
 * @property string $time_to
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Roadmap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roadmap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'price', 'amount', 'date_from', 'date_to', 'time_from', 'time_to'], 'required'],
            [['level', 'amount', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['date_from', 'date_to', 'time_from', 'time_to'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => 'Level',
            'price' => 'Price',
            'amount' => 'Amount',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
            'time_from' => 'Time From',
            'time_to' => 'Time To',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     * @return \common\models\query\RoadmapQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RoadmapQuery(get_called_class());
    }
}
