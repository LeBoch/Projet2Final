<?php 

class Cart extends Model {
    private $_id;
    private $_IdUser;






    public function GetId()

    {
        return $this->_id;
    }


    public function SetId($id)
    {
        $this->_id = (int) $id;
    }


    public function GetIdUser()

    {
        return $this->_IdUser;
    }

    public function SetIdUser($IdUser)
    {
        $this->_IdUser= (int)$IdUser;
    }

}