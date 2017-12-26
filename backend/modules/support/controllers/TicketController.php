<?php

namespace app\modules\ticket\controllers;

use app\modules\ticket\models\TicketBody;
use app\modules\ticket\models\TicketFile;
use app\modules\ticket\models\TicketHead;
use app\modules\ticket\models\UploadForm;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `ticket` module
 */
class TicketController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'open'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = (new TicketHead())->dataProviderUser();
        Url::remember();
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * The body of the ticket is made by id and displays the data
     * If an empty result is shown, we show the list of tickets
     * Create an instance of a new ticket model
     * The post came to us, we load into the model and pass validation if everyone is doing a good selection of caps, changing its status and saving it
     * Write id ticket to a new answer so as not to get lost and synchronize a new answer
     *
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $thisTicket = TicketBody::find()->where(['id_head' => $id])->joinWith('file')->orderBy('date DESC')->all();

        if (!$thisTicket) {
            return $this->actionIndex();
        }

        $newTicket = new TicketBody();
        $ticketFile = new TicketFile();
        
        if (\Yii::$app->request->post() && $newTicket->load(\Yii::$app->request->post()) && $newTicket->validate()) {

            $ticket = TicketHead::findOne($id);
            $ticket->status = 1;

            $uploadForm = new UploadForm();
            $uploadForm->imageFiles = UploadedFile::getInstances($ticketFile, 'fileName');

            if ($ticket->save() && $uploadForm->upload()) {
                $newTicket->id_head = $id;
                $newTicket->save();

                TicketFile::saveImage($newTicket, $uploadForm);
            } else {
                \Yii::$app->session->setFlash('error', $uploadForm->firstErrors['imageFiles']);
                return $this->render('view', [
                    'thisTicket' => $thisTicket,
                    'newTicket' => $newTicket,
                    'fileTicket' => $ticketFile
                ]);
            }

            $this->redirect(Url::to());
        }
        
        return $this->render('view', [
            'thisTicket' => $thisTicket,
            'newTicket' => $newTicket,
            'fileTicket' => $ticketFile
        ]);
    }

    /**
    * Create two instances
    * 1. Ticket cap
    * 2. Ticket Body
    * Make the page rendering
    * If post, we load the data into the model, we do the validation
    * We save the header first, find out its id, this id assigns the body of the message so that it is not lost and we save it
    *
     * @return string|\yii\web\Response
     */
    public function actionOpen()
    {
        $ticketHead = new TicketHead();
        $ticketBody = new TicketBody();
        $ticketFile = new TicketFile();

        if(\Yii::$app->request->post()) {
            $ticketHead->load(\Yii::$app->request->post());
            $ticketBody->load(\Yii::$app->request->post());

            if ($ticketBody->validate() && $ticketHead->validate()) {
                $ticketHead->save();
                $ticketBody->id_head = $ticketHead->getPrimaryKey();
                $ticketBody->save();

                $uploadForm = new UploadForm();
                $uploadForm->imageFiles = UploadedFile::getInstances($ticketFile, 'fileName');
                if ($uploadForm->upload()) {
                    TicketFile::saveImage($ticketBody, $uploadForm);
                }

                return $this->redirect(Url::previous());
            }
        }

        return $this->render('open', [
            'ticketHead' => $ticketHead,
            'ticketBody' => $ticketBody,
            'qq' => $this->module->qq,
            'fileTicket' => $ticketFile,
        ]);
    }
}
