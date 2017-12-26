<?php
namespace backend\modules\api\v1\controllers;

use Yii;
use backend\modules\api\v1\resources\Article;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;

/**
 * Class NotificationController
 */
class NotificationController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'backend\modules\api\v1\resources\Notification';
    /**
     * @var array
     */
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

    /**
     * @inheritdoc
     */
     
    public function actionAlert()
    {
        $raw_body = file_get_contents('php://input');
        // $signature = $_SERVER['HTTP_CB_SIGNATURE'];
        // $authenticity = $client->verifyCallback($raw_body, $signature); // boolean
       // $this->setHeader(200);
        //echo json_encode(array('status'=>1,'data'=>array_filter($model->attributes)),JSON_PRETTY_PRINT);
        Yii::error('==================================================================================');
        Yii::error(time());
        echo $raw_body;
        //echo json_encode(array($raw_body),JSON_PRETTY_PRINT);
        
    }

}
