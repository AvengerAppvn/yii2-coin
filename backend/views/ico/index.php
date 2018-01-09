<?php

use common\grid\EnumColumn;
use common\models\User;
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

$total_user   = Yii::$app->keyStorage->get('web.total_user', count(User::find()->all()));

$code   = Yii::$app->keyStorage->get('coin.code', 'TKC');
$total  = Yii::$app->keyStorage->get('coin.total', '5000000');
$sold   = Yii::$app->keyStorage->get('coin.sold', '0');

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
      <div class="col-md-8">
        <h3><i class="fa fa-database" aria-hidden="true"></i> Initial Coin Offering (ICO)</h3>
        <?php if($ref_url){ ?>
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
            <br/><br/>

        </div>
        <?php } ?>
      </div>
      
      <!-- Count down to  -->
      <!--<div class="col-md-6">-->
            <?php //echo $this->render('_countdown.php'); ?>
            
      <!--</div>-->
    </div>
</div>

<!-- Account  -->
<?php echo $this->render('_account.php',['wallet'=> $wallet, 'code'=>$code ]) ?>
<!-- END Account  -->

<!-- Buy -->
<div class="box-padding">
    <div class="row">
        

      <!-- Total User of system  -->
      <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading"><h2 class="m-b-none"><p class="text-center base-font-color">Total Members</p></h2></div>
            <div class="panel-body">
                
                <h3>
                    <p class="text-center">
                        <strong id="app-total-user">
                            <?= $total_user ?> 
                        </strong> Users<br/><br/>
                    </p>
                </h3>
            </div>
        </div>
      </div>
      
      <!-- Total ICO of system  -->
      <div class="col-md-8">
        <div class="panel panel-success">
            <div class="panel-heading"><h2 class="m-b-none"><p class="text-center base-font-color">Total Available Coin</p></h2></div>
            <div class="panel-body">
                
                <h3>
                    <p class="text-center">
                        <strong id="app-total-available-coin"><?= number_format(($total-$sold),0,",",".") ?></strong> <?php echo $code ?><br>
                        <small>Total Sold <span class="app-total-sold"><?= number_format($sold,0,",",".") ?></span> <?php echo $code ?></small>
                    </p>
                </h3>
            </div>
        </div>
      </div>
      
    </div>
</div>
<!-- end buy-->

<!-- Send -->
<div class="box-padding">
<div class="row m-b-md">
  <div class="col-md-6">
      <?php echo $this->render('_buy.php',['model'=> $model,'wallet'=>$wallet]) ?>
  </div>
</div>
</div>

