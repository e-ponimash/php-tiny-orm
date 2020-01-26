<?php
namespace App\DB;

class InsertQueryBuilder extends QueryBuilder
{

    /**
     * @return string
     */
    public function getColumns()
    {
        $str = '';
        foreach ($this->fields as $value){
            $str .= " {$value['column']},";
        }

        return trim($str, ',');
    }

    /**
     * @return string
     */
    private function getValues()
    {
        $str = '';
        foreach ($this->fields as $value){
            $str .= " :{$value['column']},";
        }

        return trim($str, ',');
    }

    /**
     * @return string
     */
    public function setQuery(){
        $this->query = "INSERT INTO public.{$this->table} ({$this->getColumns()}) VALUES ({$this->getValues()})";
        return $this;
    }

}
