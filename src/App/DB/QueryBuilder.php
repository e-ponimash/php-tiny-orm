<?php
namespace App\DB;

abstract class QueryBuilder
{
    protected $query = '';

    /**
     * BuilderQuery constructor.
     * @param $description Description
     */
    function __construct($description)
    {
        $this->table = $description->getTable();
        $this->fields = $description->getFields();
    }


    /**
     * @return string
     */
    abstract function setQuery();

    function getQuery(){
        return $this->query;
    }
}
