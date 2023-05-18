<?php 

class Order extends Model
{
    private $_id;
    private $_IdUser;
    private $_date;

    public function getId()
    {
        return $this->_id;
    }


    public function getIdUser()
    {
        return $this->_IdUser;
    }

    public function getDate()
    {
        return $this->_date;
    }


    public function SetId($id)
    {
        $this->_id = (int) $id;
    }


    public function SetIdUser($IdUser)
    {
        $this->_IdUser= (int)$IdUser;
    }


    public function SetDate($date)

    {
        $this->_date= new DateTime($date);
    }
}
