<?php

namespace common\models\Queries;

/**
 * This is the ActiveQuery class for [[\common\models\CatalogProducts]].
 *
 * @see \common\models\CatalogProducts
 */
class CatalogProductsQuery extends \common\components\BaseActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\CatalogProducts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\CatalogProducts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function active()
    {
        return $this->andWhere(['hide'=>0]);
    }
    public function byCategoryIds($ids)
    {
        if (!is_array($ids) && $ids > 0)
        {
            $ids = [(int)$ids];
        }
        if (is_array($ids) && count($ids))
        {
            return $this->andWhere('catalog_products.id IN (SELECT `product_id` FROM `catalog_products_categories_assoc` WHERE `cat_id` IN('.implode(', ', $ids).'))');
        }
        return $this;
    }
    public function byFilter($selected)
    {
        $params = [];
        if (is_array($selected) && count($selected))
        {
            foreach ($selected as $value)
            {
                $params[$value['param_id']][$value['value_id']] = $value['value_id'];
            }
        }
        ksort($params);

        $regexp = [];
        foreach ($params as $param)
        {
            ksort($param);
            $regexp[] = ':[^:]*-('.implode('|', $param).')-[^:]*:';
        }
        $regexp = implode('.*', $regexp);

        return $this->andWhere(['REGEXP', 'params', $regexp]);
    }
}
