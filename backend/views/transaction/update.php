<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Transaction */

$this->title = 'Update Transaction: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaction-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
