<?php

class CategorieManager extends ManagerBase
{
    protected $table = 'categories';
    protected $class = Categorie::class;

    public function add(Categorie $categorie)
    {
        if($categorie instanceof Categorie){
            $AjoutCategorie = $this->_db->prepare('INSERT INTO categories (nom,description) VALUES (:nom,:description)');
            $AjoutCategorie->execute([ 
                'nom'=>$categorie->getNom(),
                'description'=>$categorie->getDescription()
            ]);
            
        }
    }
}