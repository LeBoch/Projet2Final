<?php

class OrderManager extends ManagerBase
{
    protected $table = 'orders';
    protected $class = Order::class;

    public function ValidateUserCart($UserId)
    {
        $cartManager=new CartManager($this->_db);
        $cart=$cartManager->GetCartByUserId($UserId);

        $userManager=new UserManager($this->_db);
        $user=$userManager->getById($UserId);

        $PhotoManager= new Photomanager($this->_db);
        $photos=$PhotoManager->GetFromUserCart($UserId); 

        $this->_db->beginTransaction();
        try {
            // Appeler validateOrder pour lancer la procédure

            foreach ($photos as $photo) {
                $idPhotograph = $photo->getIdProprietaire();
                $photograph = $userManager->getById($idPhotograph);

                $creditDuPhotographe = $photograph->getCredit();
                $prixDeLaPhoto = $photo->getPrix();
                $nouveauCredit = $creditDuPhotographe+$prixDeLaPhoto;
                $userManager->updateCredit($photograph, $nouveauCredit);

                $creditDeLacheteur = $user->getCredit();
                $nouveauCredit = $creditDeLacheteur - $prixDeLaPhoto;
                $userManager->updateCredit($user, $nouveauCredit);

                $PhotoManager->changeOwner($user->getId(), $photo->getId());

                $cartManager->cleancart($cart);
            }

    
            $this->_db->commit();
        } catch (\Exception $e) {
            $this->_db->rollBack();

            throw $e;
        }
    }

    protected function validateOrder($IdUser)
    { ;
        $fonction = $this->_db->prepare(' CALL InsertOrder(?;?)');
        $fonction->execute([
        'IdUser'=>$IdUser]);
    }

    
}



