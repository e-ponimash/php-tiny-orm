<?php
namespace App\DB;


class Description
{

    private $table;
    private $fields;
    private $params;
    private $model;

    /**
     * Description constructor.
     * @param $model Model
     */
    function __construct($model)
    {
        $description = $model::modelDescription();
        $this->table = $description['table'];
        $this->fields = $description['fields'];
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }


    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }


    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }
}