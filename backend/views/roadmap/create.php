<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Roadmap */

$this->title = 'Create Roadmap';
$this->params['breadcrumbs'][] = ['label' => 'Roadmaps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roadmap-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
