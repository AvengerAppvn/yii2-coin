<?php
?>

<div class="modal fade" id="deposit-TickCoin" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title base-font-color">Deposit TickCoin (<?= $code ?>)</h4>
            </div>
            <div class="modal-body">
                <img class="bg-white center-block p-xxs" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFcAAABXAQMAAABLBksvAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAYNJREFUOI1900GuwiAUBdBnHDCzO2g3QtJt1YmYdB+6lXYDsgVmTEmYaELe+/fVfiPa/zs6aShcboFESnKGm16Y/rHg8epEVnyRydKhcharYyYrN/VeeqZty/3Xk+22LA+5vvky/GGnRoY0mEuz5nkZmTPW8mv+7G3etPQ6jAmP+k7P52WZde9ZJJ0Wz2XDfnVGPw11c9l7M94qs7PdA/MYZG4HS4NBVD5UxgA+xjT0iyPvQhrsp0XYxeQsn4hcaV08Y7+1W1eWMTIy5kcMo55quyJe94U81KhH9FA7Nbr31YSl+/NAqKpyYxEp43+hLqy+K3myuXaHwmdB5+in87TYjLX1jGk/cl3c3c3ZyeXw5UccRS6637Cf4+gLNvVudpgk6lFkxOuTC/rm9mmRCD//u3jDjniorHk8qtaeYWr0vPHh07qQqPUuiM1CH17vBZY6qdsdvt02vzkdw/Pbdy/9BGSG892MPuQvyyNmH9Z7Ooe0Cy1VXjKH1IRnfnSCU5oq/wDxKWybMBYGkwAAAABJRU5ErkJggg==" alt="barcode">

                <h4 class="m-t-xl"><p class="text-center">YOUR TickCoin ADDRESS</p></h4>

                <div class="input-group p-b-10">
                    <input id="<?= $code ?>_address" class="form-control" name="<?= $code ?>_address" type="text" value="TUxBjxZVetbXxNtCgETZkCN7s6b7MBmukkt">
                    <span class="input-group-btn">
                        <button data-copy-text="<?= $code ?>_address" class="btn btn-primary" type="button">Copy</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>