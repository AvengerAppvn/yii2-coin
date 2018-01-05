<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Withdraw */

$this->title = 'Update Withdraw: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Withdraws', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="withdraw-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
