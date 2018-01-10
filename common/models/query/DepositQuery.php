<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Deposit]].
 *
 * @see \common\models\Deposit
 */
class DepositQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    public function inactive()
    {
        return $this->andWhere('[[status]]=0');
    }
    /**
     * @inheritdoc
     * @return \common\models\Deposit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Deposit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
