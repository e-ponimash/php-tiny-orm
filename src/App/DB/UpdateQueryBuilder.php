<?php
namespace App\DB;

class UpdateQueryBuilder extends QueryBuilder
{
    function setQuery() {
        $this->query = "UPDATE public.{$this->table} SET {$this->getColumns($this->fields)}";
    }

    function getColumns()
    {
        $str = '';
        foreach ($this->field as $value){
            $str .= " {$value['column']} = :{$value['column']},";
        }

        return trim($str, ',');
    }

    public function setWhere(Array $where, $condition = 'AND')
    {
        if ($where) {
            $this->query .= 'WHERE 1=1';
            foreach ($where as $key => $value) {
                $this->query .= "{$condition} {$key} = :{$key} ";
            }
        }
        return $this;
    }
}