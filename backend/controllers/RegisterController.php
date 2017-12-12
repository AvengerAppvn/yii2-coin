<?php

namespace backend\controllers;

use backend\models\LoginForm;
use backend\models\AccountForm;
use backend\models\SignupForm;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use yii\web\Controller;
use common\models\User;
class RegisterController extends Controller
{

    public $defaultAction = 'index';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

    /**
     * @return string|Response
     */
    public function actionIndex()
    {
        $this->layout = 'base';
        $username = Yii::$app->request->get('referrer');
        $referrer = '';
        if($username){
            // Check referrer
            $user = User::find()->where(['username'=> $username])->limit(1)->one();
            if($user){
                 $referrer = $user->username;    
            }
        }
        
        $model = new SignupForm();
        $model->referrer = $referrer;
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();
            if ($user) {
                if ($model->shouldBeActivated()) {
                    Yii::$app->getSession()->setFlash('alert', [
                        'body' => Yii::t(
                            'frontend',
                            'Your account has been successfully created. Check your email for further instructions.'
                        ),
                        'options' => ['class' => 'alert-success']
                    ]);
                } else {
                    Yii::$app->getUser()->login($user);
                }
                return $this->goHome();
            }
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t('frontend', 'Check your email for further instructions.'),
                    'options' => ['class' => 'alert-success']
                ]);

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t('frontend', 'Sorry, we are unable to reset password for email provided.'),
                    'options' => ['class' => 'alert-danger']
                ]);
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * @param $token
     * @return string|Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t('frontend', 'New password was saved.'),
                'options' => ['class' => 'alert-success']
            ]);
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
