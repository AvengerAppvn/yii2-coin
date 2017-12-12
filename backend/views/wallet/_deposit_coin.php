<div class="panel panel-primary">
    <div class="panel-heading"><h3><?= $code ?></h3></div>
      <div class="panel-body">
          <div class="row">
              <div class="col-md-6">
                  <h1 style="margin-bottom: 30px;padding-left:10%;">
                      <img 
                        src="<?= $this->assetManager->getAssetUrl($bundle, 'img/tkc.png') ?>" 
                        data-holder-rendered="true" 
                        style="width: 64px; height: 64px;">
                    </h1>
              </div>
              <div class="col-md-6">
                <p class="text-left">
                    <h2 class="text-primary" style="line-height: 64px;">0.00000000</h2>
                </p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">
                        <button class="btn btn-primary btn-lg m-l-sm m-b-sm" type="submit" data-toggle="modal" data-target="#deposit-TickCoin">Deposit TickCoin (<?= $code ?>)
                        </button>
                    </p>
                </div>
            </div>
    </div>
</div>