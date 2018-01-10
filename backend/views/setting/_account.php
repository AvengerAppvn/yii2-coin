<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'username')
                ->textInput([
                    'class' => 'form-control','readonly'=> true,
                    'disabled' => true]) ?>
    <?php echo $form->field($model, 'email')
                ->textInput([
                    'class' => 'form-control',
                    'readonly'=> true,
                    'disabled' => true]) ?>

    <?php echo $form->field($model, 'current')->passwordInput() ?>

    <?php echo $form->field($model, 'password')->passwordInput() ?>

    <?php echo $form->field($model, 'password_confirm')->passwordInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
