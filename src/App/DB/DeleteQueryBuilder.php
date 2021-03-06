<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13.11.2019
 * Time: 12:59
 */

namespace App\DB;

use App\DB\QueryBuilder;

class DeleteQueryBuilder extends QueryBuilder
{

    use Where;

    /**
     * @return string
     */
    public function setQuery(){
        $this->query =  "DELETE FROM public.{$this->table} ";
        return $this;
    }

    /*
     * возращает строку запроса
     */
    function getQuery()
    {
        return parent::getQuery().' '.$this->where; // TODO: Change the autogenerated stub
    }


}
