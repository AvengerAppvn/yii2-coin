<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Wallet]].
 *
 * @see \common\models\Wallet
 */
class WalletQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Wallet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @param $user_id
     * @return $this
     */
    public function byUser($user_id)
    {
        $this->andWhere(['user_id' => $user_id]);
        return $this;
    }
    
    /**
     * @inheritdoc
     * @return \common\models\Wallet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
