<?php

class PhotoManager extends ManagerBase
{
    protected $table = 'photos';
    protected $class = Photo::class;

    public function add(Photo $photo)
    {
        if ($photo instanceof Photo) {
            $a = $this->_db->prepare('INSERT INTO photos(Nom,IdCategory,IdProprietaire,Chemin,TailleY,TailleX) VALUES (:Nom,:IdCategory,:IdProprietaire,:Chemin,:TailleY,:TailleX)');
          
            list($width, $height) = getimagesize($photo->getChemin());
            $a->execute([
                'Nom' => $photo->getNom(), 
                'IdCategory' => $photo->getIdCategory(), 
                'Chemin' =>$photo->getChemin(),
                'TailleX' => $width,
                'TailleY' => $height,
                'IdProprietaire' => $photo->getIdProprietaire()
            ]);

            $photo->hydrate([
                'Id' => $this->_db->lastInsertId()
            ]);
        }
    }

    public function getFromCategory($id)
    {
        $GetPhoto = $this->_db->prepare('SELECT photos.* FROM `photos`  INNER JOIN users on users.Id=photos.IdProprietaire WHERE Type="Photographe" AND IdCategory=:IdCategory;');
        $GetPhoto->execute(['IdCategory'=> (int) $id]);
        $finals= $GetPhoto->fetchAll(PDO::FETCH_ASSOC);
      
        return $this->convertArrayToModels($finals);
    }

    public function getFromUserCart($userId)
    {
        $showcart=$this->_db->prepare('SELECT photos.* FROM photos
        INNER JOIN panierphoto ON panierphoto.IdPhoto = photos.Id
        INNER JOIN panier ON panierphoto.IdPanier = panier.Id
        INNER JOIN users ON users.id = panier.IdUser
        WHERE users.Id =  :IdUser');
        $showcart->execute([
            'IdUser'=> $userId
        ]);

        $cartPhotos = $showcart->fetchAll(PDO::FETCH_ASSOC);
      
        return $this->convertArrayToModels($cartPhotos);
    }

    public function changeOwner($id, int $IdPhoto)
    {
        $ModifyOwner= $this->_db->prepare('UPDATE photos SET IdProprietaire = :IdProprietaire WHERE Id = :Id');
        $ModifyOwner->execute([
            'IdProprietaire'=>(int) $id,
            'Id'=> $IdPhoto
        ]);
    }
    public function GetByIdPro($id)
    {
        $ShowPhotoById=$this->_db->prepare('SELECT * FROM photos where IdProprietaire = :IdProprietaire');
        $ShowPhotoById->execute([
            'IdProprietaire'=>$id    
      ]);
      $var = $ShowPhotoById->fetchAll(PDO::FETCH_ASSOC);
      
      return $this->convertArrayToModels($var);
    }

}


