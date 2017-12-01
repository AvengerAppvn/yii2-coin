<?php

use common\grid\EnumColumn;
use common\models\ArticleCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Tikcoin');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="base-bg-image p-xl content-title">
        <div class="row">
            <div class="col-md-12">
                <img class="img-circle center-block" src="/img/unix-icon.png" data-holder-rendered="true" style="width: 140px; height: 140px;">
            </div>
        </div>

        <div class="row m-t-md">
            <div class="col-md-12">
                <h1><p class="text-center base-font-color">0.00000000 <small class="base-font-color">UNX</small></p></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3><p class="text-center">0.00000000 <small>BTC</small></p></h3>
            </div>
        </div>

        <div class="row m-t-xl">
            <div class="col-md-12">
                <p class="text-center">
                    <button class="btn btn-accent-black btn-lg m-b-sm" type="submit" data-toggle="modal" data-target="#deposit-bitcoin">Deposit Bitcoin (BTC)</button>
                    <button class="btn btn-accent-black btn-lg m-l-sm m-b-sm" type="submit" data-toggle="modal" data-target="#deposit-unixcoin">Deposit UnixCoin (UNX)</button>
                </p>
            </div>
        </div>
    </div>
    
<div class="container-fluid">


        <div class="row m-t-xl">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <h3 class="m-t-md">
                            Deposit Transactions
                        </h3>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Address</th>
                                        <th>Amount</th>
                                        <th>Confirmation</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
        <td class="bg-primary-blue" style="word-break: break-all;">14AhTwgpe7NzP8aCy6jhDbcYCXWTqhcTJQ</td>
        <td class="bg-primary-blue"><i class="fa fa-plus-circle text-success"></i> 0.01162040</td>
        <td class="bg-primary-blue">0/3</td>
    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <h3 class="m-t-md">
                            Send Transactions
                        </h3>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Requested At</th>
                                        <th>Address</th>
                                        <th>BTC</th>
                                        <th>Completed At</th>
                                        <th>TXID</th>
                                    </tr>
                                </thead>

                                <tbody>
                                                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <h3 class="m-t-md">
                            Send Bitcoin (BTC)
                        </h3>

                                                    <div class="alert alert-warning">
                                Please note that withdrawing BTC will be available after you have purchased at least 50 UNX from ICO. Otherwise, You have to wait for December, 26th 2017
                            </div>
                        
                        
                        
                        
                        <form method="POST" action="https://wake.unixcoin.com/wallets/transfer/2" accept-charset="UTF-8"><input name="_token" type="hidden" value="1HthXY7IjygbAKV4T4b4TWzENSXl6hw4YyMHfir8">
                        <div class="form-group">
                            <label for="address" class="text-white">To Address</label>
                            <input class="form-control" name="address" type="text" id="address">
                        </div>
                        <div class="form-group">
                            <label for="amount" class="text-white">Amount in Bitcoin</label>
                            <input class="form-control" name="amount" type="text" id="amount">
                            <span class="text-white">Fee: 0.0005 BTC</span>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-white">Password</label>
                            <input class="form-control" autocomplete="new-password" name="password" type="password" value="" id="password">
                        </div>
                                                <button type="submit" class="btn btn-accent">Withdraw from BTC wallet</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-filled">
                    <div class="panel-body">
                        <h3 class="m-t-md">
                            Send UnixCoin (UNX)
                        </h3>

                        
                        
                        
                        <form method="POST" action="https://wake.unixcoin.com/wallets/transfer/1" accept-charset="UTF-8"><input name="_token" type="hidden" value="1HthXY7IjygbAKV4T4b4TWzENSXl6hw4YyMHfir8">
                            <div class="form-group">
                                <label for="address" class="text-white">To Address</label>
                                <input class="form-control" name="address" type="text" id="address">
                            </div>
                            <div class="form-group">
                                <label for="amount" class="text-white">Amount in UnixCoin</label>
                                <input class="form-control" name="amount" type="text" id="amount">
                                &nbsp;
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-white">Password</label>
                                <input class="form-control" name="password" type="password" value="" id="password">
                            </div>
                                                        <button type="submit" class="btn btn-accent">Withdraw from UNX wallet</button>
                        </form>
                    </div>
                  </div>
              </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deposit-bitcoin" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title base-font-color">Deposit Bitcoin (BTC)</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            Please note that withdrawing BTC will be available after you have purchased at least 50 UNX from ICO. Otherwise, You have to wait for December, 26th 2017
                        </div>

                        <img class="bg-white center-block p-xxs" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFcAAABXAQMAAABLBksvAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAX1JREFUOI2F0zGOgzAQBdCJKNyFG8BFLHEt0qz3JOEqcIH4CnRpkdyAZPnvH8NGgaBdqlc445k/jgCxKscwN0jyh2tg9SS2QDO1Vq47B1gAk7N4ZPt4bv021wu6+R8Xva3aE9dDXM0eqstY/fbzMnvmvcDWf/A2+BO/zvDLlvV7GT63jFj0aoYwlR/O4SQXa9ZppZibu5OD0y2Cc7Hz7HQZa2+Lgx3S7dmxGnMuzXdruuU5yc6pbL6d4RnOXomVUsQ13d5gOO4Z0HSccRjV3rKZnQFeF/K9XGJyzEQOZoUc0Zj7kcJHxju1O4MVtFRMX6JTMJMTN5i1FF14o/aRO3p3YM4LmOqde7yAmXDSgzFoPvDqehhTa+B1R+/GwsXRmFhz1kGkPDHwXM/oT9RysA6e32rabMWdmlFbzsW3x0EqJ9Pe+c1H3Ww2r04l0vVosCW/ndGH3cundbTeIuXfDmPobXh8eGH/MeT/aZhN50fu+t25Z8Mx2Vterknu4B8HLmNQ3NVzbAAAAABJRU5ErkJggg==" alt="barcode">

                        <h4 class="m-t-xl"><p class="text-center">YOUR BITCOIN ADDRESS</p></h4>

                        <div class="input-group p-b-10">
                            <input id="btc_address" class="form-control" name="btc_address" type="text" value="14AhTwgpe7NzP8aCy6jhDbcYCXWTqhcTJQ">
                            <span class="input-group-btn">
                                <button data-copy-text="btc_address" class="btn btn-primary" type="button">Copy</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deposit-unixcoin" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title base-font-color">Deposit UnixCoin (UNX)</h4>
                    </div>
                    <div class="modal-body">
                        <img class="bg-white center-block p-xxs" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFcAAABXAQMAAABLBksvAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAYNJREFUOI1900GuwiAUBdBnHDCzO2g3QtJt1YmYdB+6lXYDsgVmTEmYaELe+/fVfiPa/zs6aShcboFESnKGm16Y/rHg8epEVnyRydKhcharYyYrN/VeeqZty/3Xk+22LA+5vvky/GGnRoY0mEuz5nkZmTPW8mv+7G3etPQ6jAmP+k7P52WZde9ZJJ0Wz2XDfnVGPw11c9l7M94qs7PdA/MYZG4HS4NBVD5UxgA+xjT0iyPvQhrsp0XYxeQsn4hcaV08Y7+1W1eWMTIy5kcMo55quyJe94U81KhH9FA7Nbr31YSl+/NAqKpyYxEp43+hLqy+K3myuXaHwmdB5+in87TYjLX1jGk/cl3c3c3ZyeXw5UccRS6637Cf4+gLNvVudpgk6lFkxOuTC/rm9mmRCD//u3jDjniorHk8qtaeYWr0vPHh07qQqPUuiM1CH17vBZY6qdsdvt02vzkdw/Pbdy/9BGSG892MPuQvyyNmH9Z7Ooe0Cy1VXjKH1IRnfnSCU5oq/wDxKWybMBYGkwAAAABJRU5ErkJggg==" alt="barcode">

                        <h4 class="m-t-xl"><p class="text-center">YOUR UNIXCOIN ADDRESS</p></h4>

                        <div class="input-group p-b-10">
                            <input id="unx_address" class="form-control" name="unx_address" type="text" value="UxBjxZVetbXxNtCgETZkCN7s6b7MBmukkt">
                            <span class="input-group-btn">
                                <button data-copy-text="unx_address" class="btn btn-primary" type="button">Copy</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
