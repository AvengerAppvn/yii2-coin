<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Wallet */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="wallet-form">
    <h3 class="standard">Withdraw ETH</h3>
    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'address')->textInput(['placeholder' => "Address of wallet"])->label('')  ?>
    <?php echo $form->field($model, 'amount')->textInput(['placeholder' => "Amount"])->label('')->hint('You can only withdraw in the bonus of wallet ETH') ?>
    <?php echo $form->field($model, 'password')->passwordInput(['placeholder' => "Password"])->label('') ?>
    <div class="form-group">
        <?php echo Html::submitButton('Withdraw', ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
