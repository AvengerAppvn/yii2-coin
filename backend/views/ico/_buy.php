<?php

use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $categories common\models\ArticleCategory[] */
/* @var $form yii\bootstrap\ActiveForm */

$types = array(
    ['type'=>'BTC','title'=>'BTC'],
    ['type'=>'ETH','title'=>'ETH'],
    );
    

?>

<div class="article-form">
    <h3>Buy TickCoin</h3>
    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'type')->dropDownList(\yii\helpers\ArrayHelper::map(
            $types,
            'type',
            'title'
        ))->label('') ?>

    

    <?php echo $form->field($model, 'amount_coin')->textInput(['onkeydown' => '
            $.get( "' . Url::toRoute('amount') . '", {
                    amount_coin: $(this).val(),
                    type: $("#' . Html::getInputId($model, 'type') . '").val()
                } ).done(function( data ) {
                $( "#' . Html::getInputId($model, 'amount') . '" ).val( data );
            });']) ?>
    
    <?php echo $form->field($model, 'amount')->textInput() ?>

    <?php echo $form->field($model, 'token',[
      'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn">'.Html::button('<span>Token</span> <i class="fa fa-envelope-o"></i>',
      [
          'class' => 'btn btn-primary',
          'id' => 'get_token',
          'title' => 'Send token to your email',
          'data-confirm' => 'Send toke to email',
          'onclick' => '
                        $.ajax({
                            type: "POST",
                            url: "ico/token",
                            data: {
                                id: 123
                            }, success: function(result) {
                                if(result == 1) {
                                    // Change send again
                                    $("#get_token span").text("Send again");
                                    $("#buyform-token").prop( "placeholder", "Enter token 6 character which send to email" ).focus();
                                } else {
                                    // Not send
                                    $("#get_token span").text("Error");
                                }
                            }, error: function(result) {
                                console.log("server error");
                            }
                        });
                    ',
      ]).'</span></div>',
  ])->textInput(['class'=>'form-control']) ?>

    <div class="form-group">
        <?php echo Html::submitButton('Buy',['class' => 'btn btn-success']) ?>
        <?php echo Html::button('Cancel',['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

