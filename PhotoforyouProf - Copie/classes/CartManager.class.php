<?php 

class CartManager extends ManagerBase
{
    protected $table ='panier';
    protected $class = Cart::class;


    public function add(Cart $cart)
    {
        $newcart=$this->_db->prepare('INSERT INTO Panier (IdUser)VALUES(:IdUser)');
        $newcart->execute([
            'IdUser'=>$cart->GetIdUser()
        ]);

        $cart->hydrate([
            'Id' =>$this->_db->lastInsertId()
        ]);
    }

    public function getCartByUserId($UserId)
    {
        $getCart=$this->_db->prepare('SELECT * FROM panier where IdUser=:IdUser');
        $getCart->execute([
            'IdUser'=>$UserId
        ]);

        $cart = $getCart->fetch(PDO::FETCH_ASSOC);
        if ($cart) {
            return new Cart($cart);
        }

        return null;
    }

    public function addProduct(Cart $cart, $idPhoto)
    {
        $insertcart=$this->_db->prepare('INSERT INTO panierphoto(IdPanier,IdPhoto) VALUES (:IdPanier,:IdPhoto)');
        $insertcart->execute([
            'IdPanier'=>$cart->GetId(),
            'IdPhoto'=>$idPhoto
        ]);

        (bool)$insertcart->rowCount();
    }

    public function deleteProduct(Cart $cart, $idPhoto)
    {
        $deleteproduct=$this->_db->prepare('DELETE FROM panierphoto where IdPhoto=:IdPhoto AND IdPanier=:IdPanier');
        $deleteproduct->execute([
            'IdPanier'=>$cart->GetId(),
            'IdPhoto'=>$idPhoto
        ]);

        return (bool)$deleteproduct->rowCount();
    }

    public function cleanUserCart(int $UserId)
    {
        $DeletePhotoCart = $this->_db->prepare('DELETE FROM panierphoto where UserId=:UserId');
        $DeletePhotoCart->execute(['UserId' => (int) $UserId]);

        return (bool)$DeletePhotoCart->rowCount();
    }

    public function cleanCart(Cart $cart)
    {
        // DELETE tous les produits du panier
        $cleancart= $this->_db->prepare('DELETE FROM panierphoto where IdPanier=:CartId');
        $cleancart->execute(['CartId' => $cart ->GetId()]);

        return (bool)$cleancart->rowCount();
    }
}
