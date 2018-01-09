<?php

use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Alert;
/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $categories common\models\ArticleCategory[] */
/* @var $form yii\bootstrap\ActiveForm */

$types = array(
    ['type'=>'1','title'=>'BTC'],
    ['type'=>'2','title'=>'ETH'],
    );
    

$rateCoinBtc = Yii::$app->keyStorage->get('coin.rate-btc');
$rateCoinEth = Yii::$app->keyStorage->get('coin.rate-eth');

if (Yii::$app->session->hasFlash('message')):
    $this->registerJs('$("#get_token").focus();');
endif;

$script = <<< JS
function updateAmount()
    {
        var type = $("#buyform-type").val();
        var rate;
        var balance;
        if(type == 1){
            rate = $("#rate-coin-btc").val();
            balance = $("#amount-btc-coin").val();
        }else{
            rate = $("#rate-coin-eth").val();
            balance = $("#amount-eth-coin").val();
        }
        var amount_coin = parseFloat($("#buyform-amount_coin").val());
        var data = rate * amount_coin;
        //console.log(amount_coin);


        if(data > 0 && balance >= data){
            $( "#buyform-amount" ).val( data.toFixed(8) );
            $( "#get_token" ).prop("disabled",false);
        }else{
            if(data== 0){
                $( "#buyform-amount" ).val( 0 );
            }else if( balance < data) {
                $( "#buyform-amount" ).val('Not enough coin');
            }else {
                $( "#buyform-amount" ).val(0);
            }
            $( "#get_token" ).prop("disabled",true);
        }

        // $.get( "/backend/web/ico/amount", {
        //             amount_coin: $(this).val(),
        //             type: $("#buyform-type").val()
        //         } ).done(function( data ) {
        //         $( "#buyform-amount" ).val( data );
        //     });
    }
    $(document).on("change, keyup", "#buyform-amount_coin", updateAmount);
    $('#input-has2fa input').on('change', function() {
        var value = ($('input[name="SecurityForm[has2fa]"]:checked', '#input-has2fa').val());
        if(value==0){
            $('#extra-2fa').hide();
        }else{
            $('#extra-2fa').show();
        }
    });
JS;
$position = \yii\web\View::POS_READY;
$this->registerJs($script, $position);
?>

<div class="article-form">
    <h3>Buy TickCoin</h3>
    <?php if (Yii::$app->session->hasFlash('message')): ?>
                
                <?php echo Alert::widget([
                    'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('message'), 'body'),
                    'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('message'), 'options'),
                ]) ?>
            <?php endif; ?>
    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'type')->dropDownList(\yii\helpers\ArrayHelper::map(
            $types,
            'type',
            'title'
        ))->label('') ?>

    
    <?php echo Html::hiddenInput('rate-coin-btc', $rateCoinBtc,['id'=>'rate-coin-btc']); ?>
    <?php echo Html::hiddenInput('rate-coin-eth', $rateCoinEth,['id'=>'rate-coin-eth']); ?>
    <?php echo Html::hiddenInput('amount-btc-coin', $wallet->amount_btc + $wallet->bonus_btc,['id'=>'amount-btc-coin']); ?>
    <?php echo Html::hiddenInput('amount-eth-coin', $wallet->amount_eth + $wallet->bonus_eth,['id'=>'amount-eth-coin']); ?>
    <?php echo $form->field($model, 'amount_coin')->textInput(['type' => 'number'])->hint('Minimum is 200 TKC') ?>

    <?php echo $form->field($model, 'amount')->textInput() ?>

    <?php echo $form->field($model, 'token',[
      'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn">'.Html::button('<span>Token</span> <i class="fa fa-envelope-o"></i>',
      [
          'class' => 'btn btn-primary',
          'id' => 'get_token',
          'disabled' => 'disabled',
          'title' => 'Send Token to your email',
          //'data-confirm' => 'Are you sure to send Token to your email?',
          'onclick' => '
                        if(confirm("Are you sure to send Token to your email?")){
                        $.ajax({
                            type: "POST",
                            url: "ico/token",
                            data: {
                                id: 123
                            }, success: function(result) {
                                if(result == 1) {
                                    // Change send again
                                    $("#get_token span").text("Send again");
                                    $("#buyform-token").prop( "placeholder", "Enter token 6 characters which we send it to your email" ).focus();
                                } else {
                                    // Not send
                                    $("#get_token span").text("Error");
                                }
                            }, error: function(result) {
                                console.log("server error");
                            }
                        });
                        }
                    ',
      ]).'</span></div>',
  ])->textInput(['class'=>'form-control'])->hint('Token is using in 10 minutes.') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Buy',['class' => 'btn btn-success btn-lg',
        'style'=>'margin-right:15px;padding-right:30px;padding-left:30px']) ?>
        <?php echo Html::button('Cancel',['class' => 'btn btn-lg btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

