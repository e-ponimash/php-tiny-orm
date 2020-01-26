<?php
namespace App\DB;


class RepositoryParams
{
    public $fields;
    public $params = array();

    /**
     * Инициализирует параметры которые нам необходимы
     * @param $fields
     */
    function __construct($fields){
        $this->fields = $fields;
        return $this;
    }


    function camelize($input, $separator = '_')
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }

    /**
     * Инициализация по объекту
     * @param $object
     * @return $this
     */
    function initParamsByObject($object){
        foreach ($this->fields as $key => $value){
            $name = $this->fields[$key]['column'];
            $method = 'get'.$this->camelize($name);
            $value = call_user_func([$object, $method]);
            $param = new Param($name, $this->fields[$key]['type'], $value);
            $this->addParam($param);
        }
        return $this;
    }

    /**
     * Инициализация по массиву
     * @param $params array
     * @return RepositoryParams
     */
    function initParamsByArray($params){
        foreach ($params as $key => $value){
            $param = new Param($key, $this->fields[$key]['type'], $value);
            $this->addParam($param);
        }
        return $this;
    }

    /**
     * Добавляет список параметров
     * @param $params
     */
    function addParams($params){
        foreach ($params as $value){
            $this->addParam($value);
        }
    }

    /**
     * Добавляет параметр
     * @param $param
     */
    function addParam($param){
        $this->params[$param->getName()] = $param;
    }

    /**
     * Возращает список параметров
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Удаляет параметр по названию
     * @param $name
     */
    public function removeParam($name){
        $this->params[$name];
    }
}