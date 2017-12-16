<?php

use common\grid\EnumColumn;
use common\models\ArticleCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\BackendAsset;

$this->title = Yii::t('backend', 'Tickcoin');
$this->params['breadcrumbs'][] = $this->title;

$bundle = BackendAsset::register($this);
$code = Yii::$app->keyStorage->get('coin.code', 'TKC');
$this->registerJs("new Clipboard('.btn-copy');");
?>

<div class="base-bg-image p-xl content-title">
    <div class="row">
        <div class="col-md-12">
            <img class="img-circle center-block" 
                src="<?= $this->assetManager->getAssetUrl($bundle, 'img/coin_logo.png') ?>" 
                data-holder-rendered="true" 
                style="width: 140px; height: 140px;margin-top: 25px;">
        </div>
    </div>
</div>
    

<!-- Wallet  -->
<div class="box-padding">
    <div class="panel panel-primary">
        <div class="panel-heading"><h2>Wallet</h2></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $this->render('_deposit_btc_line.php',['wallet'=>$wallet]) ?>
                </div>
                <div class="col-md-12">
                    <?php echo $this->render('_deposit_eth_line.php',['bundle'=>$bundle,'wallet'=>$wallet]) ?>
                </div>
                <div class="col-md-12">
                    <?php echo $this->render('_deposit_coin_line.php',[
                        'bundle'=>$bundle,
                        'code'=>$code,
                        'wallet'=>$wallet
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- END Wallet  -->  

    
<div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <?php echo $this->render('_withdraw_btc.php',['model' =>$modelBtc]) ?>
            </div>

            <div class="col-md-4">
                <?php echo $this->render('_withdraw_eth.php',['model' =>$modelEth]) ?>
            </div>
            
            <div class="col-md-4">
                <?php echo $this->render('_withdraw_coin.php',['model' =>$modelCoin]) ?>
            </div>

        </div>

        <!-- Modal -->
        <?php echo $this->render('_modal_bitcoin.php',['wallet_btc'=> $wallet_btc]) ?>

        <!-- Modal -->
        <?php echo $this->render('_modal_coin.php',['wallet_coin'=> $wallet_coin]) ?>
        
         <!-- Modal -->
        <?php echo $this->render('_modal_eth.php',['wallet_eth'=> $wallet_eth]) ?>
        
</div>

<div class="container-fluid">
        <div class="row m-t-xl">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <h3 class="m-t-md">
                            Deposit Transactions
                        </h3>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Address</th>
                                        <th>Amount</th>
                                        <th>Confirmation</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <h3 class="m-t-md">
                            Withdraw Transactions
                        </h3>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Requested At</th>
                                        <th>Address</th>
                                        <th>BTC</th>
                                        <th>Completed At</th>
                                        <th>TXID</th>
                                    </tr>
                                </thead>

                                <tbody>
                                                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>