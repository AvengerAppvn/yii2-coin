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
    <div class="row">
      <div class="col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading"><h3>BTC</h3></div>
              <div class="panel-body">
                  
                  <div class="row">
                    <div class="col-md-6">
                       <h1 style="margin-bottom: 30px;padding-left:10%;"><i class="fa fa-bitcoin" style="font-size: 64px;color: orange;"></i></h1>
                    </div>
                    <div class="col-md-6">
                        <h1>
                            <p class="text-right">
                                <h2 class="text-success" style="line-height: 64px;">0.00000000 BTC</h2>
                            </p>
                        </h1>
                    </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                <button class="btn btn-success btn-lg m-b-sm" 
                                type="submit"
                                data-toggle="modal" 
                                data-target="#deposit-bitcoin">Deposit Bitcoin (BTC)</button>
                            </p>
                        </div>
                    </div>
                    
              </div>
          </div>
      </div>
      
      <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3><?= $code ?></h3></div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-6">
                          <h1 style="margin-bottom: 30px;padding-left:10%;">
                              <img 
                                src="<?= $this->assetManager->getAssetUrl($bundle, 'img/tkc.png') ?>" 
                                data-holder-rendered="true" 
                                style="width: 64px; height: 64px;">
                            </h1>
                      </div>
                      <div class="col-md-6">
                        <p class="text-left">
                            <h2 class="text-primary" style="line-height: 64px;">0.00000000 <?= $code ?></h2>
                        </p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                <button class="btn btn-primary btn-lg m-l-sm m-b-sm" type="submit" data-toggle="modal" data-target="#deposit-TickCoin">Deposit TickCoin (<?= $code ?>)
                                </button>
                            </p>
                        </div>
                    </div>
            </div>
        </div>
      </div>
    </div>
</div>
<!-- END Wallet  -->  
    
    
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
                                    <tr>
        <td class="bg-primary-blue" style="word-break: break-all;">1daAhTwgpe7NzP8aCy6jhDbcYCXWTqhcHSF</td>
        <td class="bg-primary-blue"><i class="fa fa-plus-circle text-success"></i> 0.01162040</td>
        <td class="bg-primary-blue">0/3</td>
    </tr>
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
                            Send Transactions
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

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <h3 class="m-t-md">
                            Send Bitcoin (BTC)
                        </h3>

                            <div class="alert alert-warning">
                                Please note that withdrawing BTC will be available after you have purchased at least 50 <?= $code ?> from ICO. Otherwise, You have to wait for December, 26th 2017
                            </div>

                        
                        <form method="POST" action="/wallets/transfer/2" accept-charset="UTF-8"><input name="_token" type="hidden" value="1HthXY7IjygbAKV4T4b4TWzENSXl6hw4YyMHfir8">
                        <div class="form-group">
                            <label for="address" class="text-white">To Address</label>
                            <input class="form-control" name="address" type="text" id="address">
                        </div>
                        <div class="form-group">
                            <label for="amount" class="text-white">Amount in Bitcoin</label>
                            <input class="form-control" name="amount" type="text" id="amount">
                            <span class="text-white">Fee: 0.0005 BTC</span>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-white">Password</label>
                            <input class="form-control" autocomplete="new-password" name="password" type="password" value="" id="password">
                        </div>
                                                <button type="submit" class="btn btn-warning">Withdraw from BTC wallet</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <h3 class="m-t-md">
                            Send TickCoin (<?= $code ?>)
                        </h3>

                        
                        
                        
                        <form method="POST" action="/wallets/transfer/1" accept-charset="UTF-8"><input name="_token" type="hidden" value="1HthXY7IjygbAKV4T4b4TWzENSXl6hw4YyMHfir8">
                            <div class="form-group">
                                <label for="address" class="text-white">To Address</label>
                                <input class="form-control" name="address" type="text" id="address">
                            </div>
                            <div class="form-group">
                                <label for="amount" class="text-white">Amount in TickCoin</label>
                                <input class="form-control" name="amount" type="text" id="amount">
                                &nbsp;
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-white">Password</label>
                                <input class="form-control" name="password" type="password" value="" id="password">
                            </div>
                                                        <button type="submit" class="btn btn-warning">Withdraw from <?= $code ?> wallet</button>
                        </form>
                    </div>
                  </div>
              </div>
        </div>

        <!-- Modal -->
        <?php echo $this->render('_modal_bitcoin.php') ?>

        <!-- Modal -->
        <?php echo $this->render('_modal_coin.php',['code'=> $code]) ?>
        
    </div>
