<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\ResetPasswordForm */

$this->title = Yii::t('frontend', 'Register successful');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            Your account has been successfully created. Check your email for further instructions.
            <?php echo Html::a(Yii::t('frontend', 'Login'), ['/login'],[
                        'class' => 'btn btn-success btn-flat',
                        'name' => 'register-button'
                    ]) ?>
        </div>
    </div>
</div>
