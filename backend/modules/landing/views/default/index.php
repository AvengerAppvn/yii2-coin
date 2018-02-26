<?php

/* @var $this yii\web\View */

$this->title = Yii::t('frontend', 'Tickcoin | Blockchain | The best ICO 2018')
?>
<div class="wrapper">
    <header class="main-header">
        <a href="<?php echo Yii::$app->urlManagerBackend->createAbsoluteUrl('/') ?>" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            <?php echo Yii::$app->name ?>
        </a>
        <nav class="navbar navbar-static-top" role="navigation" style="background: #367fa9"></nav>
    </header>
    <div class="container text-center" style="color:#ddd;font-size:16px">
        <img class="img-circle center-block" style="width: 140px; height: 140px;" alt="logo" src="/img/coin_logo.png" data-holder-rendered="true">
        <h1 class="text-center"><?php echo Yii::t('frontend', 'Tickcoin') ?></h1>
    </div>
    <br/>
    <section>
        <div class="container text-center" style="color:#ddd;font-size:16px;">
            <div class="featureBanner">
                <h1 class="headline">Trade securely on the world's<br>most active digital asset exchange.</h1><br/>
                <?php if (Yii::$app->user->isGuest) { ?>
                    <p>
                        I plan to get 50% of the package in our plan. Our waiting for the floor started in early March 2018. respectfully
                    </p>
<!--                    <button class="btn btn-lg btn-success" onclick="window.location.href='/register'">Create Your-->
<!--                        Account-->
<!--                    </button>-->
                    <br/><br/>
                    <p>Already a member? <a href="/login" class="standard">Sign in</a>.</p>
                <?php } else { ?>
                    <button class="btn btn-lg btn-primary" onclick="window.location.href='/ico'">Go to Wallet
                    </button>
                <?php } ?>
            </div>
        </div>
    </section>

    <div class="container" style="color:#ddd;font-size:16px">


        <div class="landing-page-content">
            <?php echo $model ? $model->body : 'Update..' ?>
        </div>
    </div>
    <footer class="footer" style="padding-top:20px;background: #24262d;color:#AAFFFB">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?= Yii::$app->keyStorage->get('landing-page.footer.left', 'Left Footer'); ?>
                </div>

                <div class="col-md-6">
                    <?= Yii::$app->keyStorage->get('landing-page.footer.right', 'Right  Footer'); ?>
                </div>
            </div>
        </div>
        <div class="container">
            <p class="pull-left">&copy; <?php echo date('Y') ?> Tickcoin. All rights reserved.</p>

        </div>
    </footer>
</div>
