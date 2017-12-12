<?php
use yii\helpers\Url;
?>

<div class="modal fade" id="deposit-eth" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title base-font-color">Deposit Etherium (ETH)</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    Please note that withdrawing BTC will be available after you have purchased at least 50 <?= $code ?> from ICO. Otherwise, You have to wait for December, 26th 2017
                </div>

                <img class="bg-white center-block p-xxs"  alt="barcode"
                src="<?= Url::to(['qrcode/index', 'v' => $wallet_eth]) ?>" />

                <h4 class="m-t-xl"><p class="text-center">YOUR ETH ADDRESS</p></h4>
                <div class="input-group">
                    <!-- Target -->
                    <input id="wallet_eth"  type="text" class="form-control" value="<?= $wallet_eth ?>" readonly>
                    
                    <!-- Trigger -->
                    <span class="input-group-btn">
                        <button class="btn btn-copy btn-success" data-clipboard-target="#wallet_eth" type="button">
                            <i class="fa fa-clipboard"></i>
                            Copy
                        </button>                
                    </span>
                </div>

            </div>
        </div>
    </div>
</div>
