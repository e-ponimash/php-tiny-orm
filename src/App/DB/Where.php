<?php
namespace App\DB;


trait Where
{

    public $where;

    public function setWhere(Array $where, $condition = 'AND')
    {
        if ($where) {
            $this->where .= 'WHERE 1=1';
            foreach ($where as $key => $value) {
                $this->where .= "{$condition} {$key} = :{$key} ";
            }
        }
        return $this;
    }

}