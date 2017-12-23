<?php
use yii\helpers\Html;
use backend\assets\BackendAsset;
$bundle = BackendAsset::register($this);
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message bing composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::$app->charset ?>" />
    <title><?php echo Html::encode($this->title) ?></title>
    <style type="text/css">
        .heading {}
        .list {}
        .footer {}
        .box{
            border: 20px solid #f2f2f2;
            width: 600px;
            margin: 20px auto;
            border-radius: 0px;
            padding: 30px;
            font-family: Arial,Helvetica,sans-serif;
            font-size: 15px;
        }
        .box-head {
            border-bottom:1px solid #ccc;
            padding-bottom:20px;
        }
    </style>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
     <?php echo $content ?>    

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
