<div class="row">
<div class="col-md-4">
    <h1 style="margin-bottom: 30px;padding-left:10%;">
      <img 
        src="<?= $this->assetManager->getAssetUrl($bundle, 'img/tkc.png') ?>" 
        data-holder-rendered="true" 
        style="width: 48px; height: 48px;">
        <?= $code ?>
    </h1>   
</div>
<div class="col-md-4">
    <h2 style="line-height: 48px;">
    <button class="btn btn-success btn-lg m-b-sm" style="padding-left:20px;padding-right:20px;"
    type="submit"
    data-toggle="modal" 
    data-target="#deposit-coin">Deposit</button>
    </h2>
</div>
<div class="col-md-4">
     <h2 class="text-success" style="line-height: 48px;"><?= number_format($wallet->amount_coin,8) ?></h2>
</div>

</div>
        
