<?php
class User extends Model
{
	// Attributs
	private $_id;
	private $_nom;
	private $_prenom;
	private $_type;
	private $_mail;
	private $_mdp;
	private $_credit;

	// Getters

	public function getId()
	{
		return $this->_id;
	}

	public function getNom()
	{
		return $this->_nom;
	}

	public function getPrenom()
	{
		return $this->_prenom;
	}

	public function getMail()
	{
		return $this->_mail;
	}

	public function getType()
	{
		return $this->_type;
	}

	

	public function getMdp()
	{
		return $this->_mdp; 
	}
	// Setters

	public function setId($id)
	{
		$id = (int) $id;
		if ($id > 0)
		{
			$this->_id = $id;
		}	
	}


	public function setNom($nom)
	{
		if (is_string($nom))
		{
			$this->_nom = $nom;
		}	
	}

	public function setPrenom($prenom)
	{
		if (is_string($prenom))
		{
			$this->_prenom = $prenom;
		}	
	}

	public function setType($type)
	{
		if (is_string($type))
		{
			$this->_type = $type;
		}
	}
	
	public function setMail($mail)
	{
		$this->_mail = $mail;
	}

	public function setMdp($mdp)
	{
		$this->_mdp = $mdp;
	}

	
	public function setCredit($credit)
	{
		$this->_credit = (int) $credit;
	}

	public function getCredit()
	{
		return $this->_credit;
	}
}
