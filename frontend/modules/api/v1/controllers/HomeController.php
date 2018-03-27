<?php

namespace frontend\modules\api\v1\controllers;

use common\models\User;
use frontend\modules\api\v1\resources\User as UserResource;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\Url;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class HomeController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'frontend\modules\api\v1\resources\User';

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function ($username, $password) {
                        $user = User::findByLogin($username);
                        return $user->validatePassword($password)
                            ? $user
                            : null;
                    }
                ],
                HttpBearerAuth::className(),
                QueryParamAuth::className()
            ]
        ];

        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass
            ],
            'view' => [
                'class' => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction'
            ]
        ];
    }

    public function actionCreate()
    {
        $model = new User();
        $model->load(\Yii::$app->getRequest()->getBodyParams(), '');

        if ($model->validate() && $model->save()) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute([$id], true));
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }

        return $model;
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->roles = [
            User::ROLE_USER,
        ];
        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
            $user = $model->getUser();
            $user->generateAccessTokenAfterUpdatingClientInfo(true);

            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            $id = implode(',', array_values($user->getPrimaryKey(true)));

            $responseData = [
                'id' => (int)$id,
                'access_token' => $user->access_token,
            ];

            return $responseData;
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        $model->load(Yii::$app->request->post());

        if ($model->validate() && $model->signup()) {
            // Send confirmation email
            $model->sendConfirmationEmail();

            $response = \Yii::$app->getResponse();
            $response->setStatusCode(201);

            $responseData = "true";

            return $responseData;
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }
    }

    public function actionConfirm()
    {
        $model = new SignupConfirmForm();

        $model->load(Yii::$app->request->post());
        if ($model->validate() && $model->confirm()) {

            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);

            $user = $model->getUser();
            $responseData = [
                'id' => (int)$user->id,
                'access_token' => $user->access_token,
            ];

            return $responseData;

        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }
    }

    public function actionPasswordResetRequest()
    {
        $model = new PasswordResetRequestForm();

        $model->load(Yii::$app->request->post());
        if ($model->validate() && $model->sendPasswordResetEmail()) {

            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);

            $responseData = "true";

            return $responseData;
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }
    }

    public function actionPasswordResetTokenVerification()
    {
        $model = new PasswordResetTokenVerificationForm();

        $model->load(Yii::$app->request->post());
        if ($model->validate() && $model->validate()) {

            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);

            $responseData = "true";

            return $responseData;
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }
    }

    /**
     * Resets password.
     */
    public function actionPasswordReset()
    {
        $model = new PasswordResetForm();
        $model->load(Yii::$app->request->post());

        if ($model->validate() && $model->resetPassword()) {

            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);

            $responseData = "true";

            return $responseData;
        } else {
            // Validation error
            throw new HttpException(422, json_encode($model->errors));
        }
    }
    /**
     * Rest Description: Your endpoint description.
     * Rest Fields: ['field1', 'field2'].
     * Rest Filters: ['filter1', 'filter2'].
     * Rest Expand: ['expandRelation1', 'expandRelation2'].
     */
    public function actionMe()
    {
        $user = User::findIdentity(\Yii::$app->user->getId());

        if ($user) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);

            return [
                'full_name' => $user->getFullName(),
                'address' => $user->getAddress(),
                'username' => $user->username,
                'email' => $user->email,
                'phone' => $user->getPhoneNumber(),
                'avatar_url' => $user->getAvatarUrl(),
                //'last_login_at' =>  $user->last_login_at,
                //'last_login_ip' =>  $user->last_login_ip,
            ];
        } else {
            // Validation error
            throw new NotFoundHttpException("Object not found");
        }
    }

    public function actionMeUpdate()
    {
        $user = User::findIdentity(\Yii::$app->user->getId());

        if ($user) {

            $model = new UserEditForm();
            $model->load(Yii::$app->request->post(),'');
            $model->id = $user->id;

            if ($model->validate() && $model->save()) {
                $response = \Yii::$app->getResponse();
                $response->setStatusCode(200);
                $user = $model->getUserByID();
                return [
                    'full_name' => $user->getFullName(),
                    'address' => $user->getAddress(),
                    'username' => $user->username,
                    'email' => $user->email,
                    'phone' => $user->getPhoneNumber(),
                    'avatar_url' => $user->getAvatarUrl(),
                    //'last_login_at' =>  $user->last_login_at,
                    //'last_login_ip' =>  $user->last_login_ip,
                ];
            } else {
                // Validation error
                throw new HttpException(422, json_encode($model->errors));
            }
        } else {
            // Validation error
            throw new NotFoundHttpException("Object not found");
        }
    }

    public function actionLogout()
    {
        $user = User::findIdentity(\Yii::$app->user->getId());

        if ($user) {
            $user->destroyAccessToken();
        }

        $response = \Yii::$app->getResponse();
        $response->setStatusCode(200);

        $responseData = "true";

        return $responseData;
    }

    public function actionOptions($id = null)
    {
        return "ok";
    }
    /**
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        $model = UserResource::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }
        return $model;
    }
}
