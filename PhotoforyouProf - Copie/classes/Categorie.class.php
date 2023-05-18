<?php

class Categorie extends Model
{
    private $_id;
    private $_nom;
    private $_description;



public function getId()
{
    return $this->_id;
}

public function getNom()
{
    return $this->_nom;
}


public function getDescription()
{
    return $this->_description;
}


public function setId($id)
{
    $id =(int)$id;
 
    {
        $this->_id=$id;
    }
}
public function SetNom($nom)
{
    $nom=(string)$nom;
    {
    $this->_nom=$nom;
    }
}
public function SetDescription($description)
{
    $description=(string)$description;
    
        {
         $this->_description=$description;
        }
}
}