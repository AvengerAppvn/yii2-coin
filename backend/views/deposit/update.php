<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Deposit */

$this->title = 'Update Deposit: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Deposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="deposit-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
