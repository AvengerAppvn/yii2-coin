<?php

namespace common\commands;

use Yii;
use yii\base\Object;
use common\models\TimelineEvent;
use trntv\bus\interfaces\SelfHandlingCommand;


class AddToEventCommand extends Object implements SelfHandlingCommand
{
    /**
     * @var string
     */
    public $category;
    /**
     * @var string
     */
    public $event;
    /**
     * @var mixed
     */
    public $data;

    /**
     * @param AddToTimelineCommand $command
     * @return bool
     */
    public function handle($command)
    {
        return 1;
    }
}
