<?php

?>
<!-- Account  -->
<div class="box-padding">
    <div class="row">
      <div class="col-md-4">
          <div class="panel panel-primary">
              <div class="panel-heading"><h2 class="m-b-none"><?php echo $code ?></h2></div>
              <div class="panel-body">
                  
                  <h3>
                      <p class="text-center">
                          <strong class="app-<?= $code ?>"><?= number_format($wallet->amount_coin,2) ?></strong><br>
                          <small>ICO <span class="app-<?= $code ?>-ico"><?= number_format($wallet->amount_ico,2) ?></span>
                          / BONUS <span class="app-<?= $code ?>-bonus"><?= number_format($wallet->amount_bonus,2) ?></span>
                          </small>
                      </p>
                  </h3>
              </div>
          </div>
      </div>
      
      <div class="col-md-4">
        <div class="panel panel-primary">
                <div class="panel-heading"><h2 class="m-b-none">BTC</h2></div>
              <div class="panel-body">
                  <h3><p class="text-center">
                    <strong class="app-btc"><?= number_format($wallet->amount_btc,8) ?></strong><br>
                    <small>DEPOSIT <span class="app-btc-ico"><?= number_format($wallet->amount_ico,2) ?></span>
                          / BONUS <span class="app-btc-bonus"><?= number_format($wallet->amount_bonus,2) ?></span>
                          </small>
                    </p></h3>
              </div>
          </div>
      </div>
      
      <div class="col-md-4">
        <div class="panel panel-primary">
                <div class="panel-heading"><h2 class="m-b-none">ETH</h2></div>
              <div class="panel-body">
                  <h3><p class="text-center"><strong class="app-eth"><?= number_format($wallet->amount_eth,8) ?></strong><br>
                  <small>DEPOSIT <span class="app-eth-ico"><?= number_format($wallet->amount_ico,2) ?></span>
                          / BONUS <span class="app-eth-bonus"><?= number_format($wallet->amount_bonus,2) ?></span>
                          </small>
                  </p></h3>
              </div>
          </div>
      </div>
      

    </div>
</div>
<!-- END Account  -->
