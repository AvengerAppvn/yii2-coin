<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\PasswordResetRequestForm */

$this->title =  Yii::t('frontend', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="register-box">
    <div class="register-logo">
        <?= Html::img('img/coin_logo.png',['alt'=>'Logo','data-holder-rendered'=>'true','style'=>'width: 140px; height: 140px;']) ?>
    </div><!-- /.register-logo -->

    <div class="register-box-body">
    <h2>Verify Your Email</h2>
    <p>
    We sent a verification email to <strong><?= $model->email ?></strong>.
    <br>
    Click the link in the email to get started!
    </p>
    <hr>
    <p>
        <a href="#email_options" class="slide-toggle">
            Email didn't arrive or want to use a different email?</a>
    </p>
    <ul id="email_options" style="">
        <li>Check your spam folder and mark the message as 'Not Spam'.</li>
        <li><a href="/account/resend_email" data-remote="true" rel="nofollow" data-method="post">Resend email</a> to 
        <strong><?= $model->email ?></strong><span id="email_notice"></span></li>
        <li>
        Try <a href="/signout">signing up</a> using another email address.
        </li> 
    </ul>
    </div>
</div>
