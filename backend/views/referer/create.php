<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Referer */

$this->title = 'Create Referer';
$this->params['breadcrumbs'][] = ['label' => 'Referers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referer-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
