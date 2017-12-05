<?php

use common\grid\EnumColumn;
use common\models\ArticleCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\BackendAsset;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = Yii::t('backend', 'Tickcoin');
//$this->params['breadcrumbs'][] = $this->title;
$bundle = BackendAsset::register($this);

$code = Yii::$app->keyStorage->get('coin.code', 'TKC');
$this->registerJs("new Clipboard('.btn-copy');");
?>
<div class="base-bg-image p-xl content-title">
    <div class="row">
        <div class="col-md-12">
            <img class="img-circle center-block" src="<?= $this->assetManager->getAssetUrl($bundle, 'img/coin_logo.png') ?>" data-holder-rendered="true" style="width: 140px; height: 140px;">
        </div>
    </div>
</div>

<div class="box-padding">
    <div class="row">
      <!-- Share link refferer -->
      <div class="col-md-6">
        <h3><i class="fa fa-database" aria-hidden="true"></i> Initial Coin Offering (ICO)</h3>
        <div class="reffernal-link">
            <div class="input-group">
                <!-- Target -->
                <input id="ref_url"  type="text" class="form-control" value="<?= $ref_url ?>" readonly>
                
                <!-- Trigger -->
                <span class="input-group-btn">
                    <button class="btn btn-copy btn-success" data-clipboard-target="#ref_url" type="button">
                        <i class="fa fa-clipboard"></i>
                        Copy
                    </button>                
                </span>
            </div>
            

        </div>
      </div>
      
      <!-- Count down to  -->
      <div class="col-md-6">
            <?php echo $this->render('_countdown.php'); ?>
      </div>
    </div>
</div>

<!-- Account  -->
<div class="box-padding">
    <div class="row">
      <div class="col-md-4">
          <div class="panel panel-primary">
              <div class="panel-heading"><h2 class="m-b-none"><?php echo $code ?></h2></div>
              <div class="panel-body">
                  
                  <h3>
                      <p class="text-center">
                          <strong class="app-<?= $code ?>">0.00000000</strong><br>
                          <small>ICO <span class="app-<?= $code ?>-ico">0.00</span> / BONUS <span class="app-<?= $code ?>-bonus">0.00</span></small>
                      </p>
                  </h3>
              </div>
          </div>
      </div>
      
      <div class="col-md-4">
        <div class="panel panel-primary">
                <div class="panel-heading"><h2 class="m-b-none">BTC</h2></div>
              <div class="panel-body">
                  <h3><p class="text-center"><strong class="app-btc">0.00000000</strong><br><small>&nbsp;</small></p></h3>
              </div>
          </div>
      </div>
      
      <!-- Total ICO of system  -->
      <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading"><h2 class="m-b-none"><p class="text-center base-font-color">Total Available Coin</p></h2></div>
            <div class="panel-body">
                
                <h3>
                    <p class="text-center">
                        <strong id="app-total-available-coin">5,000,000</strong> <?php echo $code ?><br>
                        <small>Total Sold <span class="app-total-sold">1,000,000</span> <?php echo $code ?></small>
                    </p>
                </h3>
            </div>
        </div>
      </div>
    </div>
</div>
<!-- END Account  -->

<!-- Buy -->
<div class="box-padding">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-filled panel-info">
                <div id="time-box" class="panel-body" style="height: 122px;">
                    <h4>
                        <i class="pe pe-7s-bell header-icon-30 m-b-xs"></i>
                        <span class="base-font-color">
                            <div id="closing-in-box" class="hidden" style="color: white">
                                Closing in
                                <span id="ico-close-hh">00</span> hrs
                                <span id="ico-close-mm">00</span> mins
                                <span id="ico-close-ss">00</span> sec.
                            </div>
                            <div id="opening-in-box" class="">
                                Opening in
                                                                    <span id="ico-open-hh">08</span> hrs
                                <span id="ico-open-mm">03</span> mins
                                <span id="ico-open-ss">10</span> sec.
                            </div>
                        </span>
                    </h4>
                </div>
            </div>
        </div>
    
        <div id="ico-sold-box" class="col-md-8">
            <div class="panel panel-filled">
                <div class="row">
                    <div class="col-md-4">
    
                        <div id="stats-box" class="panel-body h-200 list">
                            <div class="stats-title">
                                <h4>ICO Today : <span id="app-ico-today">200,000</span> <?php echo $code ?></h4>
                                <h4>Sold : <span id="app-ico-sold">0</span> <?php echo $code ?></h4>
                                <h4>Available : <span id="app-ico-available">200,000</span> <?php echo $code ?></h4>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end buy-->

<!-- Send -->
<div class="box-padding">
<div class="row m-b-md">
  <div class="col-md-12">
      <div class="p-sm r-3 base-bg-image">
          <div class="panel m-n">
              <div class="panel-body">
                  <h3>Fill Amount</h3>

                  <form id="ico-form" action="/ico">
                      <div id="ico-form-success" class="alert alert-success hidden"></div>
                      <div id="ico-form-error" class="alert alert-danger hidden"></div>
                      <div id="ico-form-loading" class="alert alert-info hidden">Sending data to server...</div>

                      <div class="row m-b-sm">
                          <div class="col-md-4">
                              <h4><?= $code ?></h4>
                              <input id="<?= $code ?>_amount" class="form-control m-b-sm" placeholder="Amount in <?= $code ?>" name="<?= $code ?>_amount" type="text">
                              <span class="text-white">Min = 50, Max = 100 <?= $code ?> (<a href="#" class="base-font-color" data-fill="#<?= $code ?>_amount" tabindex="-1">Buy All: <span class="app-buy-all">0</span> <?= $code ?></a>)</span>
                              <br>
                              <span class="text-white"><?= $code ?> amount must be multiples of 50 (i.e. 50, 100, 150, ...)</span>
                          </div>
                          <div class="col-md-4">
                              <h4>BTC</h4>
                              <input id="btc_amount" class="form-control" readonly="" tabindex="-1" name="btc_amount" type="text">
                          </div>
                          <div class="col-md-4">
                              <h4>USD</h4>
                              <input id="usd_amount" class="form-control" readonly="" tabindex="-1" name="usd_amount" type="text">
                          </div>
                      </div>

                      <br>

                      <div class="row m-b-sm">
                          <div class="col-md-4">
                              <span class="text-white">Please enter the following number below:</span>
                              <img id="captcha-img" src="">
                              <input class="form-control" name="captcha_secret" type="hidden" value="">
                              <input class="form-control" name="captcha_key" type="hidden" value="">
                              <input class="form-control" name="captcha_key2" type="text" value="">
                          </div>
                      </div>

                      <button type="submit" class="btn btn-lg btn-success">Buy <?= $code ?></button>
                      <button type="reset" class="btn btn-lg btn-warning">Clear</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
</div>

<!--MY ORDER      -->
<div class="row">
  <div class="col-md-12">
      <div class="panel panel-filled">
          <div class="panel-body">
              <h3 class="m-t-md">
                  My Orders
              </h3>

              <div class="table-responsive">
                  <table class="table table-bordered">
                      <thead>
                      <tr>
                          <th width="25%">Ordered At</th>
                          <th width="25%">Amount (<?= $code ?>)</th>
                          <th width="25%">Processed At</th>
                          <th width="25%">Status</th>
                      </tr>
                      </thead>

                      <tbody id="ico-orders"></tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- Last 50 match -->
<div class="row">
  <div class="col-md-12">
      <div class="panel panel-filled">
          <div class="panel-body">
              <h3 class="m-t-md">
                  Last 50 matched orders
              </h3>

              <div class="table-responsive">
                  <table class="table table-bordered">
                      <thead>
                      <tr>
                          <th width="33%">Processed At</th>
                          <th width="33%">Address</th>
                          <th width="34%">Amount (<?= $code ?>)</th>
                      </tr>
                      </thead>

                      <tbody id="completed-orders"><tr><td colspan="3"><center>Available after ICO ends</center></td></tr></tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- MAP & BOX PANE -->
<div class="row">
  <div class="col-lg-12">
      <div class="panel">
          <div class="panel-body">
              <h4 class="m-t-n-sm m-b-xs">ICO activity</h4>
              <samll>ICO sales by geography</samll>
              <?php echo $this->render('_map.php'); ?>
            </div>      
      </div>
  </div>
</div>

