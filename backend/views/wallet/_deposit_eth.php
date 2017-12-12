<div class="panel panel-primary">
  <div class="panel-heading"><h3>ETH</h3></div>
  <div class="panel-body">
      
      <div class="row">
        <div class="col-md-6">
           <h1 style="margin-bottom: 30px;padding-left:10%;">
               <img 
                        src="<?= $this->assetManager->getAssetUrl($bundle, 'img/eth.png') ?>" 
                        data-holder-rendered="true" 
                        style="width: 64px; height: 64px;">
               </h1>
        </div>
        <div class="col-md-6">
            <h1>
                <p class="text-right">
                    <h2 class="text-success" style="line-height: 64px;">0.00000000</h2>
                </p>
            </h1>
        </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <p class="text-center">
                    <button class="btn btn-success btn-lg m-b-sm" 
                    type="submit"
                    data-toggle="modal" 
                    data-target="#deposit-bitcoin">Deposit Ethereum (ETH)</button>
                </p>
            </div>
        </div>
        
  </div>
</div>