<?php

namespace common\models\Queries;

/**
 * This is the ActiveQuery class for [[\common\models\VapeSlovarCategoriesInfo]].
 *
 * @see \common\models\VapeSlovarCategoriesInfo
 */
class VapeSlovarCategoriesInfoQuery extends \common\components\BaseActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\VapeSlovarCategoriesInfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\VapeSlovarCategoriesInfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
