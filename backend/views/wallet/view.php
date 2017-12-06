<?php

use yii\helpers\Html;
use yii\wuser_idgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Wallet */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Wallets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wallet-view">

    <p>
        <?php echo Html::a('Update', ['update', 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'user_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::wuser_idget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'user_user_id',
            'wallet_btc',
            'wallet_coin',
            'status',
            'created_at',
        ],
    ]) ?>

</div>
