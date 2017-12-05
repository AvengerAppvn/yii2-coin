<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Transaction]].
 *
 * @see \common\models\Transaction
 */
class TransactionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Transaction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Transaction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
