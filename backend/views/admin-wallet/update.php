<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Wallet */

$this->title = 'Update Wallet: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wallets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wallet-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
