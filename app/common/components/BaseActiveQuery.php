<?php

namespace common\components;

use yii\data\Pagination;
/**
 * This is the BaseActiveQuery class for ActiveRecord models.
 *
 */
class BaseActiveQuery extends \yii\db\ActiveQuery
{

    public function active()
    {
        $this->andWhere("[[status]]='1'");
        return $this;
    }

    
    public function byAlias($alias, $table = null)
    {
        $alias  = addslashes($alias);
        if(is_null($table) && !empty($table))
        {
            return $this->andWhere(['alias' => $alias]);
        }
        else
        {
            return $this->andWhere([$table.'.`alias`' => $alias]);
        }
    }

    public function byId($id)
    {
        $id = addslashes($id);
        return $this->andWhere("[[id]]='$id'");
    }

    public function byIds($array,$table = null)
    {
        if($table===null)
        {
            return $this->andWhere(["id"=>$array]);
        }
        else
        {
            return $this->andWhere(["$table.id"=>$array]);
        }
    } 

    public function byParentId($parent_id, $table = null)
    {
        $parent_id=addslashes($parent_id);
        if($table===null)
        {
            $this->andWhere("[[parent_id]]='$parent_id'");
        }
        else 
        {
            $this->andWhere("[[$table.parent_id]]='$parent_id'");
        }
        return $this;
    } 

    public function byRecordId($record_id)
    {
        $record_id=addslashes($record_id);
        $this->andWhere("[[record_id]]='$record_id'");
        return $this;
    }
    
    public function pagination($rows,$count_field = 'id',$per_page = 9)
    {
        $countQuery = clone $rows;
        $totalCount = $countQuery->count($count_field);
        unset($countQuery);
        $pages = new Pagination(['totalCount' => $totalCount]);
        $pages->setPageSize($per_page);
        return $pages;	
    }
}