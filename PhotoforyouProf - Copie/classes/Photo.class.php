<?php

class Photo extends Model
{
    private $_id;
    private $_nom;
    private $_taille_x;
    private $_taille_y;
    private $_poids;
    private $_id_proprietaire;
    private $_id_category;
	private $_chemin;
	private $_prix;

    public function getId()
    {
        return $this->_id;
    }

	public function getPrix()
    {
        return $this->_prix;
    }

	public function getChemin()
    {
        return $this->_chemin;
    }


    public function getNom()
    {
        return $this->_nom;
    }

    public function getTaillex()
    {
        return $this->_taille_x;
    }

    public function getTailleY()
    {
        return $this->_taille_y;
    }
    public function getPoids()
    {
        return $this->_poids;
    }

    public function getIdProprietaire()
    {
        return $this->_id_proprietaire;
    }

    public function getIdCategory()
    {
        return $this->_id_category;
    }


    public function setId($id_photo)
	{
		$id_photo = (int) $id_photo;
		if ($id_photo > 0)
		{
			$this->_id = $id_photo;
		}	
	}


    
    public function setNom($nom_photo)
	{
		$nom_photo = (string) $nom_photo;
	
		{
			$this->_nom = $nom_photo;
		}	
	}


     
    public function setTailleX($taille_x)
	{
		$taille_x = (int) $taille_x;
	
		{
			$this->_taille_x = $taille_x;
		}	
	}


    
    public function setTailleY($taille_y)
	{
		$taille_y = (int) $taille_y;
		
		{
			$this->_taille_y = $taille_y;
		}	
	}


    public function setPoids($_poids)
	{
		$_poids = (int) $_poids;
		
		{
			$this->_poids = $_poids;
		}	
	}

    public function setIdProprietaire($_id_proprietaire)
	{
		$_id_proprietaire = (int) $_id_proprietaire;
		
		{
			$this->_id_proprietaire = $_id_proprietaire;
		}	
	}


    public function setIdCategory($_id_category)
	{
		$_id_category = (int) $_id_category;
		
		{
			$this->_id_category = $_id_category;
		}	
	}

	public function setChemin($_chemin)
	{
		$_chemin = (string) $_chemin;
		
		{
			$this->_chemin = $_chemin;
		}	
	}

	public function setPrix($_prix)
	{
		$_prix = (string) $_prix;
		
		{
			$this->_prix = $_prix;
		}	
	}
}