<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Deposit */

$this->title = 'Create Deposit';
$this->params['breadcrumbs'][] = ['label' => 'Deposits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deposit-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
