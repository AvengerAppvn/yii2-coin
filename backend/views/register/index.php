<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;
use backend\assets\BackendAsset;
use borales\extensions\phoneInput\PhoneInput;
$this->title = Yii::t('backend', 'Register');
$this->params['breadcrumbs'][] = $this->title;
$bundle = BackendAsset::register($this);

?>
<div class="register-box">
    <div class="register-logo">
                <img class="img-circle center-block" src="<?= $this->assetManager->getAssetUrl($bundle, 'img/coin_logo.png') ?>" data-holder-rendered="true" style="width: 140px; height: 140px;">    
    </div><!-- /.register-logo -->

    <div class="register-box-body">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <div class="head">
                    <h1 class="text-center">
                       <i class="fa fa-user-plus" style="color:#dccb8b" aria-hidden="true"></i>
                    <?php echo Html::encode($this->title) ?>
                    </h1>
                    <p class="header text-light">Please enter your data to register.</p>
                </div>

                <div class="body">
                    <?php //echo $form->field($model, 'referrer') ?>
                    <?php echo $form->field($model, 'username') ?>
                    <?php echo $form->field($model, 'email') ?>
                    <?php //echo $form->field($model, 'phone') ?>
                    <?php echo $form->field($model, 'phone')->widget(PhoneInput::className(), [
                            'jsOptions' => [
                                'preferredCountries' => ['us', 'vn', 'jp'],
                            ]
                        ]);
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $form->field($model, 'password')->passwordInput() ?>    
                        </div>
                        <div class="col-md-6">
                            <?php echo $form->field($model, 'password_repeat')->passwordInput(['value'=>'']) ?>    
                        </div>
                    </div>

                    <?php echo $form->field($model, 'reCaptcha')->widget(ReCaptcha::className()) ?>
                </div>
                 
                 <div class="footer">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Register'), 
                        [
                            'class' => 'btn btn-lg btn-primary btn-flat',
                            'name' => 'signup-button',
                            'style' => 'margin-right:15px'
                        ]
                        ) ?>
                    <?php echo Html::a(Yii::t('frontend', 'Login'), ['/login'],[
                        'class' => 'btn btn-lg btn-success btn-flat',
                        'name' => 'register-button'
                    ]) ?>
                </div>
                <div style="padding:10px 0">
                    <?= Html::a('Forget password?',['account/forgot-password']); ?>
                </div>
            <?php ActiveForm::end(); ?>
            
    </div>
    <div class="text-info" style="padding:10px 0">
        <i class="fa fa-angle-double-left" aria-hidden="true"></i>
        <?= Html::a('Back to Information Site',['@frontendUrl']); ?>
    </div>
</div>
