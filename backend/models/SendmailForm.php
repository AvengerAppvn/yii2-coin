<?php
namespace backend\models;

use common\commands\SendEmailCommand;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\Url;

/**
 * SendmailForm form
 */
class SendmailForm extends Model
{
    /**
     * @var
     */
    public $to;

    /**
     * @var
     */
    public $subject;

    /**
     * @var
     */
    public $body;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'body'], 'required'],
            [['subject', 'body'], 'string'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'to' => Yii::t('backend', 'To'),
            'subject' => Yii::t('backend', 'Subject'),
            'body' => Yii::t('backend', 'Body'),
        ];
    }

    /**
     *
     */
    public function send()
    {
        $users = [];
        if($this->to == ''){
            $users = User::find()->notAdmin()->all();
        }else{
            $users[] = User::findByUsername($this->to)->one();
        }
        foreach ($users as $user) {
            Yii::$app->commandBus->handle(new SendEmailCommand([
                'subject' => $this->subject,
                'view' => 'notification',
                'to' => $user->email,
                'params' => [
                    'name' => $user->username,
                    'logo' => Url::to('@backendUrl/img/coin_logo.png'),
                    'body' => $this->body,
                ]
            ]));
        }
        return true;
    }

}
