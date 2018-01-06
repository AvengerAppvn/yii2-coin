<div class="row">
<div class="col-md-3">
    <h1 style="margin-bottom: 30px;padding-left:10%;">
      <img 
        src="<?= $this->assetManager->getAssetUrl($bundle, 'img/tkc.png') ?>" 
        data-holder-rendered="true" 
        style="width: 48px; height: 48px;">
        <?= $code ?>
    </h1>   
</div>
<div class="col-md-3">
    <h2 style="line-height: 48px;">
    <button class="btn btn-success btn-lg m-b-sm" style="padding-left:20px;padding-right:20px;"
    type="submit"
    data-toggle="modal" 
    data-target="#deposit-coin">Deposit</button>
    </h2>
</div>
<div class="col-md-6">
     <h2 class="text-success" style="line-height: 48px;">
         <?= number_format($wallet->amount_ico + $wallet->amount_bonus,2) ?>
         / BONUS <span class="app-btc-bonus"><?= number_format($wallet->amount_bonus,2) ?></span>
         </h2>
</div>

</div>
        
