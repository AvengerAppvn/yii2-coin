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
class AddToTreeTeamCommand extends Object implements SelfHandlingCommand
{
    /**
     * @var integer
     */
    public $user_id;
    /**
     * @var integer
     */
    public $related_id;

    /**
     * @param AddToTreeTeamCommand $command
     * @return bool
     */
    public function handle($command)
    {
        //Yii::error("Check");
        if(Team::find()->where(['user_id'=>$command->user_id,'related_id'=>$command->related_id])->exists()){
            return false;
        }
        $level = 1;
        $model = new Team();
        $model->user_id = $command->user_id;
        $model->related_id = $command->related_id;
        $model->level = $level;
        $model->save(false);
        $this->scanRelated($model->user_id,$model->related_id,$level);
        return 1;
    }
    
    private function scanRelated($user_id,$primary,$level){
        //Yii::error("Scan:".$user_id.':'.$primary);
        // Find parent of related_id
        $user = User::findOne($user_id);
        if($user && $user->referrer){
            // Find level
            $team = Team::find()->where(['user_id'=>$user->referrer,'related_id'=>$user->id])->limit(1)->one();
            if($team){
                $level++;
                $model = new Team();
                $model->user_id = $user->referrer;
                $model->related_id = $primary;
                $model->level = $level;
                $model->save(false);
                return $this->scanRelated($user->referrer,$primary,$level);
            }
        }
        return false;
    }
}
