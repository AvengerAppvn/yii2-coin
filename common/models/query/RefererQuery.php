<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Referer]].
 *
 * @see \common\models\Referer
 */
class RefererQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Referer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Referer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
