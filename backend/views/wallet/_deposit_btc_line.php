<div class="row">
<div class="col-md-3">
   <h1 style="margin-bottom: 30px;padding-left:10%;">
       <i class="fa fa-bitcoin" style="width:48px;font-size: 48px;color: orange;text-align:center;"></i>
       BTC
   </h1>
</div>
<div class="col-md-3">
    <h2 style="line-height: 48px;">
    <button class="btn btn-success btn-lg m-b-sm" style="padding-left:20px;padding-right:20px;"
    type="submit"
    data-toggle="modal" 
    data-target="#deposit-bitcoin">Deposit</button>
    </h2>
</div>
<div class="col-md-6">
     <h2 class="text-success" style="line-height: 48px;">
        <?= number_format($wallet->amount_btc,8) ?>
        / BONUS <span class="app-btc-bonus"><?= number_format($wallet->amount_bonus,8) ?></span>
     </h2>
</div>

</div>
        
