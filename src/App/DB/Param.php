<?php
namespace App\DB;


class Param
{
    public $name;
    public $type;
    public $value;

    /**
     * Param constructor.
     * @param $name
     * @param $type
     * @param $value
     */
    public function __construct($name, $type, $value)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

}