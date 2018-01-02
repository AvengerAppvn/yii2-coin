<?php

namespace app\modules\support\models;

use Yii;

/**
 * This is the model class for table "ticket_file".
 *
 * @property integer    $id
 * @property integer    $id_body
 * @property string $base_url
 * @property string $path
 * @property string $url
 * @property string $name
 * @property string $type
 * @property string $size
 * @property integer $order
 *
 * @property TicketBody $idBody
 */
class TicketFile extends \yii\db\ActiveRecord
{
    public $attachments;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ticket_file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_body', 'size', 'order'], 'integer'],
            [['base_url', 'path', 'type', 'name'], 'string', 'max' => 255],
            [
                ['id_body'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => TicketBody::className(),
                'targetAttribute' => ['id_body' => 'id'],
            ],

        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'       => Yii::t('app', 'ID'),
            'id_body'  => Yii::t('app', 'Id Body'),
            'fileName' => Yii::t('app', 'File name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBody()
    {
        return $this->hasOne(TicketBody::className(), ['id' => 'id_body']);
    }

    /**
     * @param $ticket
     * @param $uploadForm
     * @return bool
     */
    public static function saveImage($ticket, $uploadForm)
    {
        if ($uploadForm->getName() == null) {
            return false;
        }
        
        foreach ($uploadForm->getName() as $file) {
            $ticketFile = new TicketFile();
            $ticketFile->id_body = $ticket->primaryKey;
            $ticketFile->fileName = $file;
            $ticketFile->save();
        }
    }

    public function getUrl()
    {
        return $this->base_url . '/' . $this->path;
    }
}
