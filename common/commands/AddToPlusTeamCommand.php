<?php

namespace common\commands;

use Yii;
use yii\base\Object;
use common\models\Team;
use common\models\User;
use trntv\bus\interfaces\SelfHandlingCommand;

/**
 * @author
 */
class AddToPlusTeamCommand extends Object implements SelfHandlingCommand
{
    /**
     * @var integer
     */
    public $related_id;

    /**
     * @var number
     */
    public $amount;

    /**
     * @var number
     */
    public $type;

    /**
     * @param AddToPlusTeamCommand $command
     * @return bool
     */
    public function handle($command)
    {
        // Find parent
        $teams = Team::find()->where(['related_id' => $command->related_id])->all();

        foreach($teams as $team){

            $bonus = $command->amount * $this->getRate($team->level);

            if($bonus){
                if($command->type == 1) {
                    $team->amount_btc_bonus += $bonus;

                }else{
                    $team->amount_eth_bonus += $bonus;
                }
                if($team->save())
                {
                    Yii::error('Plus bonus to Team');
                    $wallet = $team->wallet;
                    if($command->type == 1) {
                        $wallet->bonus_btc += $bonus;
                    }else{
                        $wallet->bonus_eth += $bonus;
                    }

                    $wallet->save();
                    // TODO save to Event log

                }
            }
        }
        return 1;
    }

    private function getRate($level){
        if(1 == $level){
            return 0.1;//10%
        }

        if(2 == $level){
            return 0.04;//4%
        }

        if(3 <= $level){
            return 0.01;//1%
        }
        return 0;
    }
}
