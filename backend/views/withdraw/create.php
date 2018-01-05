<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Withdraw */

$this->title = 'Create Withdraw';
$this->params['breadcrumbs'][] = ['label' => 'Withdraws', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdraw-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
