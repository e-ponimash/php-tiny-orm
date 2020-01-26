<?php
namespace App\DB;

class Sequence
{
    function __construct($name)
    {
        $this->name = $name;
        return $this;
    }

    private function query(){
        return "SELECT nextval('".$this->name."_id_seq')";
    }

    function generate(){
        $db = new DB();
        $db->execute($this->query(),[]);
        return $db->fetchColumn();
    }
}