<?php

namespace common\models\Queries;

/**
 * This is the ActiveQuery class for [[\common\models\Lots]].
 *
 * @see \common\models\Lots
 */
class ServicesQuery extends \common\components\BaseActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Lots[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Lots|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active()
    {
        return $this->andWhere(['`services`.`hide`' => 0]);
    }
    public function buy()
    {
        return $this->andWhere(['`services`.type' => 'для продавцов франшизы']);
    }

    public function sell()
    {
        return $this->andWhere(['`services`.type' => 'для покупателей франшизы']);
    }



}
