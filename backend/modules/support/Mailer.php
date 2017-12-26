<?php
namespace app\modules\ticket;

use yii\helpers\Url;

class Mailer extends \yii\swiftmailer\Mailer
{
    public $viewPath = '@ricco/ticket/views/ticket/mail';

    private $nameTicket; 
    private $textTicket; 
    private $status; 
    private $subject;
    private $urlTicket;
    private $setTo;

    /** @var  \yii\swiftmailer\Mailer $mail */
    protected $mail;

    public function init()
    {
        $this->mail = \Yii::$app->mailer;
        $this->mail->viewPath = $this->viewPath;
        $this->mail->getView()->theme = \Yii::$app->view->theme;

        parent::init();
    }

    /**
     * @param $nameTicket
     * @param $textTicket
     * @param $status integer 
     * @param $id int
     * @return $this
     */
    public function sendMailDataTicket($nameTicket, $status, $id, $textTicket = '')
    {
        $this->nameTicket = $nameTicket;
        $this->textTicket = $textTicket;
        $this->status = $status;
        $this->urlTicket = $this->getLinkTicket($id);

        return $this;
    }

    /**
     * @param $userEmail
     * @param $subject
     * @return $this
     */
    public function setDataFrom($userEmail, $subject)
    {
        $this->setTo = $userEmail;
        $this->subject = $subject;

        return $this;
    }

    /**
     * @param $view string 
     */
    public function senda()
    {
        $this->mail->compose('mail', [
            'nameTicket' => $this->nameTicket,
            'textTicket' => $this->textTicket,
            'status' => $this->status,
            'link' => $this->urlTicket,
        ])
            ->setFrom(\Yii::$app->params['adminEmail'])
            ->setTo($this->setTo)
            ->setSubject($this->subject)
            ->send();
    }

    /**
     * @param $id int Id Тикета
     * @return string Возвращает ссылку на тикет
     */
    private function getLinkTicket($id)
    {
        return Url::to(['/ticket/ticket/view'], true) . "?id=" . $id;
    }
}