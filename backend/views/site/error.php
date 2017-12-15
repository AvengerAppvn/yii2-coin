<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="error">
    <div class="row">
        <div class="col-xs-12">
            <div class="error-content text-center">
                <p>
                    <?php echo nl2br(Html::encode($message)) ?>
                </p>
            </div>
        </div>
    </div>
</div><!-- /.error-page -->