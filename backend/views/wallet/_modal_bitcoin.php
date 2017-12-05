<?php
?>

<div class="modal fade" id="deposit-bitcoin" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title base-font-color">Deposit Bitcoin (BTC)</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    Please note that withdrawing BTC will be available after you have purchased at least 50 <?= $code ?> from ICO. Otherwise, You have to wait for December, 26th 2017
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
