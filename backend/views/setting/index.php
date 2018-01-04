<?php

use common\grid\EnumColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Setting');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">My referrer</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
          <div class="form-group">
            <label for="username" class="text-white">Username</label>
            <input class="form-control" readonly="" disabled="" name="username" type="text" value="<?= $referrer ?>" id="username">
        </div>
        
        <div class="form-group">
            <label for="country" class="text-white">Country</label>
            <input class="form-control" readonly="" disabled="" name="country" type="text" value="Vietnam" id="country">
        </div>
        
    </div>
    <!-- /.box-body -->
</div>
    
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">My Profile</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?php echo $this->render('_profile.php',['model'=>$profile]) ?>
    </div>
    <!-- /.box-body -->
</div>


<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">My Password</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
          <?php echo $this->render('_account.php',['model'=>$model]) ?>
        
    </div>
    <!-- /.box-body -->
</div>