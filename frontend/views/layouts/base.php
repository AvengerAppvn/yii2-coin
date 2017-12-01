<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php')
?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]); ?>
    <?php echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

            ['label' => Yii::t('frontend', 'ICO'), 'url' => ['/site/index']],
            ['label' => Yii::t('frontend', 'RoadMap'), 'url' => ['/page/view', 'slug'=>'about']],
            ['label' => Yii::t('frontend', 'White Paper'), 'url' => ['/article/index']],
            [
                'label' => Yii::t('frontend', 'Our program'), 
                'items'=>[
                        [
                            'label' => Yii::t('frontend', 'What is Ucoin cash?'),
                            'url' => ['/site/what-is-ucoincash']
                        ],
                        [
                            'label' => Yii::t('frontend', 'Mine, Trade &amp; Stake'),
                            'url' => ['/site/what-is-ucoincash']
                        ],
                        [
                            'label' => Yii::t('frontend', 'Lending Program'),
                            'url' => ['/site/lending-program']

                        ],
                        [
                            'label' => Yii::t('frontend', 'Affiliate &amp; Network'),
                            'url' => ['/site/affiliate-network']

                        ]
                    ]
            ],
            ['label' => Yii::t('frontend', 'Exchange'), 'url' => ['/site/contact']],
            ['label' => Yii::t('frontend', 'News'), 'url' => ['/article/index']],
            ['label' => Yii::t('frontend', 'FAQ'), 'url' => ['/article/index']],
            
            ['label' => Yii::t('frontend', 'Signup'), 'url' => ['/user/sign-in/signup'], 'visible'=>Yii::$app->user->isGuest],
            [
                'label' => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->getPublicIdentity(),
                'visible'=>!Yii::$app->user->isGuest,
                'items'=>[
                    [
                        'label' => Yii::t('frontend', 'Settings'),
                        'url' => ['/user/default/index']
                    ],
                    [
                        'label' => Yii::t('frontend', 'Backend'),
                        'url' => Yii::getAlias('@backendUrl'),
                        'visible'=>Yii::$app->user->can('manager')
                    ],
                    [
                        'label' => Yii::t('frontend', 'Logout'),
                        'url' => ['/user/sign-in/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ]
                ]
            ],
            ['label' => Yii::t('frontend', 'Signin'), 'url' => ['/user/sign-in/login'], 'visible'=>Yii::$app->user->isGuest]
            
        ]
    ]); ?>
    <?php NavBar::end(); ?>

    <?php echo $content ?>

</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                Logo
            </div>

            <div class="col-md-4">
               <h4>About</h4>
                <ul class="">
                  <li class="">First item</li>
                  <li class="">Second item</li>
                  <li class="">Third item</li>
                </ul>
            </div>
            
            <div class="col-md-4">
                <h4>SUBSCRIBE TO NEWSLETTER</h4>
                <div>
                    <input type="text" />
                </div>
                <ul>
                  <li class="">Facebook</li>
                  <li class="">Youtube</li>
                  <li class="">Twitter</li>
                </ul>
            </div>
        </div>
    </div>    
    <div class="container">
        <p class="pull-left">&copy; <?php echo date('Y') ?> My Coin. All rights reserved. Privacy Policy </p>
        
    </div>
</footer>
<?php $this->endContent() ?>