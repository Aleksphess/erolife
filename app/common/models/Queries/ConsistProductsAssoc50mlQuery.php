<?php

namespace common\models\Queries;

/**
 * This is the ActiveQuery class for [[\common\models\ConsistProductsAssoc50ml]].
 *
 * @see \common\models\ConsistProductsAssoc50ml
 */
class ConsistProductsAssoc50mlQuery extends \common\components\BaseActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\ConsistProductsAssoc50ml[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\ConsistProductsAssoc50ml|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
