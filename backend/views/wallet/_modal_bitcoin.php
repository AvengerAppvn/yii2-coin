<?php
use yii\helpers\Url;
?>

<div class="modal fade" id="deposit-bitcoin" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title base-font-color">Deposit Bitcoin (BTC)</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    Please note that withdrawing BTC will be available after you have purchased at least 50 <?= $code ?> from ICO. Otherwise, You have to wait for ...
                </div>

                <img class="bg-white center-block p-xxs"  alt="barcode"
                src="<?= Url::to(['qrcode/index', 'v' => $wallet_btc]) ?>" />

                <h4 class="m-t-xl"><p class="text-center">YOUR BITCOIN ADDRESS</p></h4>
                <div class="input-group">
                    <!-- Target -->
                    <input id="wallet_bitcoin"  type="text" class="form-control" value="<?= $wallet_btc ?>" readonly>
                    
                    <!-- Trigger -->
                    <span class="input-group-btn">
                        <button class="btn btn-copy btn-success" data-clipboard-target="#wallet_bitcoin" type="button">
                            <i class="fa fa-clipboard"></i>
                            Copy
                        </button>                
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>
