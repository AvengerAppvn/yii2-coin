<?php

namespace console\controllers;

use common\models\Deposit;
use common\models\Team;
use common\models\Wallet;
use Yii;
use yii\console\Controller;

class TeamController extends Controller
{
    public function actionIndex()
    {
        return 0;
        // Scan Deposit
//        $deposits = Deposit::find()->inactive()->all();
//        foreach ($deposits as $deposit) {
//            if (!$deposit->user_id) {
//                $wallet = null;
//                // BTC
//                if ($deposit->type == 1) {
//                    $wallet = Wallet::find()->where(['wallet_btc' => $deposit->receiver]);
//                }
//
//                // ETH
//                if ($deposit->type == 2) {
//                    $wallet = Wallet::find()->where(['wallet_eth' => $deposit->receiver]);
//                }
//
//                if ($wallet) {
//                    $deposit->user_id = $wallet->user_id;
//                }
//
//            }
//
//            if ($deposit->user_id) {
//                // Find parent
//                $teams = Team::find()->where(['related_id' => $deposit->user_id])->all();
//
//                foreach ($teams as $team) {
//
//                    $bonus = $deposit->amount * $this->getRate($team->level);
//
//                    if ($bonus) {
//                        if ($deposit->type == 1) {
//                            $team->amount_btc_bonus += $bonus;
//
//                        } else {
//                            $team->amount_eth_bonus += $bonus;
//                        }
//                        if ($team->save()) {
//                            Yii::error('Plus bonus to Team');
//                            $wallet = $team->wallet;
//                            if ($deposit->type == 1) {
//                                $wallet->bonus_btc = $bonus;
//                            } else {
//                                $wallet->bonus_eth = $bonus;
//                            }
//
//                            $wallet->save();
//                            // TODO save to Event log
//
//                        }
//                    }
//                }
//                $deposit->status = 1;
//                $deposit->save();
//                echo "Switch status, User ID:".$deposit->user_id."\n";
//            }
//        }
    }

    private function getRate($level)
    {
        if (1 == $level) {
            return 0.1;//10%
        }

        if (2 == $level) {
            return 0.04;//4%
        }

        if (3 <= $level) {
            return 0.01;//1%
        }
        return 0;
    }
}
