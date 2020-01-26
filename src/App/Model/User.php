<?php

namespace App\Model;

use App\DB\Model;
use App\DB\Sequence;

class User extends Model
{

    public $id;
    public $login;
    public $name_last;
    public $name_first;

    public function __get($name)
    {
        return call_user_func_array(array($this, 'get'.$name), []);
    }

    static function modelDescription(){
        return ['table' => 'User',
            'fields'=>[
                'id' => ['column'=>'id', 'type'=>'int'],
                'name_first' => ['column'=>'name_first', 'type' => 'int'],
                'name_last' => ['column'=>'name_last', 'type' => 'int']
            ]
        ];
    }

    public function getId()
    {
        if (is_null($this->id)){

            $shortName = end(explode('\\', get_class($this)));
            $sequence = new Sequence($shortName);
            $this->id = $sequence->generate();
        }
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getNameLast()
    {
        return $this->name_last;
    }

    public function setNameLast($name_last)
    {
        $this->name_last = $name_last;
    }

    public function getNameFirst()
    {
        return $this->name_first;
    }

    public function setNameFirst($name_first)
    {
        $this->name_first = $name_first;
    }

}