<?php

?>
    <div class="panel panel-filled">
        <div class="panel-body">
            <h2 class="m-b-none">
                <p class="text-center base-font-color">DAY : HR : MIN : SEC</p>
            </h2>
            <?php
                $remain = time() + 360000;
                echo \russ666\widgets\Countdown::widget([
                    'tagName' => 'span',
                    'datetime' => date('Y-m-d H:i:s O', $remain), // TODO fix time
                    'format' => '<span>%D</span> : <span>%H</span> : <span>%M</span> : <span>%S</span>',
                    'events' => [
                        'finish' => 'function(){}',
                    ],
                ])
            ?>
        </div>
    </div>