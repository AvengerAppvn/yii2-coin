<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\LoginForm */

$this->title = Yii::t('backend', 'Login');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>
<div class="login-box">
    <div class="login-logo">
        <i class="fa fa-lock text-success" aria-hidden="true"></i>
        <?php echo Html::encode($this->title) ?>
    </div><!-- /.login-logo -->
    <div class="header text-light">Please enter your credentials to login.</div>
    <div class="login-box-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="body">
            <?php echo $form->field($model, 'username') ?>
            <?php echo $form->field($model, 'password')->passwordInput() ?>
            <?php echo $form->field($model, 'authCode') ?>
            <?php echo $form->field($model, 'reCaptcha')->widget(ReCaptcha::className()) ?>
            <?php echo $form->field($model, 'rememberMe')->checkbox(['class'=>'simple']) ?>
        </div>
        <div class="footer">
            <?php echo Html::submitButton(Yii::t('backend', 'Login'), [
                'class' => 'btn btn-primary btn-flat',
                'name' => 'login-button'
            ]) ?>
             <?php echo Html::button(Yii::t('backend', 'Register'), [
                'class' => 'btn btn-success btn-flat',
                'name' => 'register-button'
            ]) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div style="padding:10px 0">
        <i class="fa fa-angle-double-left" aria-hidden="true"></i>
        <?= Html::a('Back to Information Site','http://yii2-coin-avengerappvn.c9users.io/frontend/web/'); ?>
    </div>
</div>