<?php

use yii\helpers\Url;

$code = Yii::$app->keyStorage->get('coin.code', 'TKC');
?>

<div class="modal fade" id="deposit-TickCoin" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title base-font-color">Deposit TickCoin (<?= $code ?>)</h4>
            </div>
            <div class="modal-body">
                <img class="bg-white center-block p-xxs"  alt="barcode"
                src="<?= Url::to(['qrcode/index', 'v' => $wallet_coin]) ?>" />
                <h4 class="m-t-xl"><p class="text-center">YOUR TickCoin ADDRESS</p></h4>
                
                <div class="input-group">
                    <!-- Target -->
                    <input id="wallet_coin"  type="text" class="form-control" value="<?= $wallet_coin ?>" readonly>
                    
                    <!-- Trigger -->
                    <span class="input-group-btn">
                        <button class="btn btn-copy btn-success" data-clipboard-target="#wallet_coin" type="button">
                            <i class="fa fa-clipboard"></i>
                            Copy
                        </button>                
                    </span>
                </div>
                
            </div>
        </div>
    </div>
</div>