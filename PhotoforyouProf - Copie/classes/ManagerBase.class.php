<?php

abstract class ManagerBase {
    protected PDO $_db;
    protected $table;
    protected $class;

    public function __construct(PDO $db)
    {
        $this->setDB($db);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function getDB()
    {
        return $this->_db;
    }

    public function getById($id)
    {
        $afficher = $this->_db->prepare('SELECT * FROM '.$this->table.' WHERE Id=:Id');
        $afficher->execute(['Id' => (int) $id]);
        $result = $afficher->fetch(PDO::FETCH_ASSOC);

        return new $this->class($result);
    }

    public function getAll()
    {
        $afficher = $this->_db->prepare('SELECT * FROM '.$this->table);
        $afficher->execute();
        $results = $afficher->fetchAll(PDO::FETCH_ASSOC);

        return $this->convertArrayToModels($results);
    }

    public function delete($id)
    {
        $delete = $this->_db->prepare('DELETE FROM '.$this->table.' where Id= :Id');
        $delete->execute(['Id'=> $id]);
    }

    protected function convertArrayToModels(array $results)
    {
        $maFonctionCallback = function ($result) {
            return new $this->class($result);
        };
    
        return array_map($maFonctionCallback, $results);
    }
}