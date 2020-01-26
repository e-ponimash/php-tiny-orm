<?php
namespace App\DB;

class Repository
{

    private $repositoryParams;
    private $description;

    public function __construct($model){
        $this->description = new Description($model);

        $this->repositoryParams = new RepositoryParams($this->description->getFields());
        $this->select_stm = new SelectQueryBuilder($this->description);
        $this->update_stm = new UpdateQueryBuilder($this->description);
        $this->insert_stm = new InsertQueryBuilder($this->description);
        $this->delete_stm = new DeleteQueryBuilder($this->description);

        $this->db = new DB();
        return $this;
    }

    /**
     * Возвращает из хранилища массив объектов, удовлетворяющих условиям поиска
     * @param $params array Услови поиска в виде ассоцированного массива
     * @return array
     */
    public function find($params){
        $query = $this->select_stm->setQuery()->setWhere($params)->getQuery();
        $params = $this->repositoryParams->initParamsByArray($params)->getParams();
        return $this->db->execute($query, $params)->fetchObject($this->description->getModel());
    }

    /**
     * Сохраняет объект в хранилищн
     * @param $object Model
     * @return array
     */
    public function store($object){
        if ($object->id){
            $model = $this->update($object);
        } else {
            $model = $this->insert($object);
        }
        return $model;
    }

    /**
     * удаляет модель из хранилища
     * @param $object
     * @return string
     */
    public function remove($object){
        if ($object){
            $data = $this->delete_stm->setQuery()->setWhere(['id' => $object->id])->getQuery();
            $params = $this->repositoryParams->initParamsByArray(['id' => $object->id])->getParams();
            $this->db->execute($data, $params);
            return $data;
        } else {
            throw new Exception('Модель не определенна');
        }
    }

    /**
     * Возвращает по Id модель
     * @param $params array Услови поиска в виде ассоцированного массива
     * @return array
     */
    public function findByID($id){
        return $this->find(['id' => $id])[0];
    }

    /**
     * Сохраняет объект в хранилище
     * @param $object
     * @return array
     */

    private function insert($object){
        $data = $this->insert_stm->setQuery()->getQuery();
        $params = $this->repositoryParams->initParamsByObject($object)->getParams();
        $this->db->execute($data, $params);
        return $object->id;
    }

    /*
     * Изменяет объект в хранилище
     */
    private function update($object){
        $data = $this->update_stm->setParams($object)->execute();
        $params = $this->repositoryParams->initParamsByObject($object)->getParams();
        $this->db->execute($data, $params);
        return $this->findByID($object->id);
    }
}