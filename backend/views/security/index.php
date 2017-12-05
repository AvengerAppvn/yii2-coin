<?php

use common\grid\EnumColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Security');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-filled">
            <div class="panel-body">
                <h3 class="m-t-md">
                    Account Security
                </h3>
                
                <form method="POST" action="https://wake.unixcoin.com/security" accept-charset="UTF-8" class="form-horizontal"><input name="_method" type="hidden" value="PUT"><input name="_token" type="hidden" value="jmYMHqjvkiNHXcZdl2bFHxjUPHJ1eugzpqZAPiu7">
                    
                    
                    
                    <fieldset>
                        <p>Two Factor Authentication</p>

                        <div class="form-group">
                            <label for="enable2fa" class="control-label col-md-3 text-white">Enable Two-Factor</label>
                            <div class="col-md-9">
                                <label class="radio-inline text-white"><input name="enable2fa" type="radio" value="1" id="enable2fa"> On</label>
                                <label class="radio-inline text-white"><input checked="checked" name="enable2fa" type="radio" value="0" id="enable2fa"> Off</label>
                            </div>
                        </div>
                    </fieldset>

                                                    <fieldset id="2fa-options" class="collapse ">
                                                    <p>Require 2FA code for</p>

                        <div class="form-group">
                            <label for="2fa_create" class="control-label col-md-3 text-white">Exchange: Create Order</label>
                            <div class="col-md-9">
                                <label class="radio-inline text-white"><input name="2fa_create" type="radio" value="1" id="2fa_create"> On</label>
                                <label class="radio-inline text-white"><input checked="checked" name="2fa_create" type="radio" value="0" id="2fa_create"> Off</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="2fa_cancel" class="control-label col-md-3 text-white">Exchange: Cancel Order</label>
                            <div class="col-md-9">
                                <label class="radio-inline text-white"><input name="2fa_cancel" type="radio" value="1" id="2fa_cancel"> On</label>
                                <label class="radio-inline text-white"><input checked="checked" name="2fa_cancel" type="radio" value="0" id="2fa_cancel"> Off</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="2fa_lending" class="control-label col-md-3 text-white">Lending</label>
                            <div class="col-md-9">
                                <label class="radio-inline text-white"><input name="2fa_lending" type="radio" value="1" id="2fa_lending"> On</label>
                                <label class="radio-inline text-white"><input checked="checked" name="2fa_lending" type="radio" value="0" id="2fa_lending"> Off</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="2fa_withdrawal" class="control-label col-md-3 text-white">Withdrawal</label>
                            <div class="col-md-9">
                                <label class="radio-inline text-white"><input name="2fa_withdrawal" type="radio" value="1" id="2fa_withdrawal"> On</label>
                                <label class="radio-inline text-white"><input checked="checked" name="2fa_withdrawal" type="radio" value="0" id="2fa_withdrawal"> Off</label>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group">
                        <label for="2fa" class="control-label col-md-3 text-white">Enter 2FA Code</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-qrcode fa-lg"></i></span>
                                <input class="form-control" name="one_time_password" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-3"></div>
                        <div class="form-actions col-md-9">
                            <button type="submit" class="btn btn-accent">Submit</button>
                            <button type="reset" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-filled">
            <div class="panel-body">
                <h3 class="m-t-md">
                    Google Authenticator Guide
                </h3>
                 
                <ol>
                    <li>Install Google Authenticator for <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank" class="text-black">Android</a> or <a href="https://itunes.apple.com/en/app/google-authenticator/id388497605?mt=8" target="_blank" class="text-black">Apple</a> and open Google Authenticator</li>
                    <li>Go to <code>Menu</code> -&gt; <code>Setup Account</code></li>
                    <li>Choose <code>Scan a barcode</code> option, and scan the barcode shown on this page</li>
                    <li><em><b>If you are unable to scan the barcode</b>: Choose <code>Enter provided key</code> and type in the "Security Key"</em></li>
                    <li>A six digit number will now appear in your Google Authenticator app home screen, enter this code into the 2FA form on this page</li>
                    <li>Every time you login to unixcoin.com you must enter the new 2FA code from your Google Authenticator into the 2FA box on the login form</li>
                </ol>
            </div>
      </div>
  </div>

</div>


<div class="row">
<div class="col-md-6">
    <div class="panel panel-filled">
        <div class="panel-body">
            <h3 class="m-t-md">
                Account Security
            </h3>
            
            <p>To setup two factor authentication you first need to download Google Authenticator:</p>
            <p><i class="fa fa-android"></i>  <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank" class="text-black">Google Authenticator for Android (Play Store)</a></p>
            <p><i class="fa fa-apple"></i>  <a href="https://itunes.apple.com/en/app/google-authenticator/id388497605?mt=8" target="_blank" class="text-black">Google Authenticator for iOS (Apple App Store)</a></p>
            <p>Then scan the the barcode or, if you are not able to scan the barcode, you can enter the "Security Key" manually.</p>
                     
            <p>Enter the 6 digit code generated by Google Authenticator in the 2FA Code box and switch "Enable Two-Factor" to On</p>
            <p><span class="label label-danger">Important</span> Save this secret code for future reference</p>
            <p><em>Note: No Google account is required to use Google Authenticator; skip any Google logins</em></p>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="panel panel-filled">
        <div class="panel-body">
            <h3 class="m-t-md">
            Security Key:</h3> 
            <center>
                <h3><span style="font-family:Courier;color:#FF4508;letter-spacing:2px;font-size:22px;">
                    <?php echo $secret ?>
                    </span></h3>
            </center>
            <center>
                <small class="text-black"><em>(Time Based Code)</em></small>
            </center>
            <br/>
            <center>
                <img src="<?= $code ?>" />
            </center>   
         </div>
    </div>            
</div>
</div>
