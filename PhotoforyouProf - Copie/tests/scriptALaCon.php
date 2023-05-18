<?php

class Photo {
    public $id = 8;
    private $nom = 'tata';

    public function getId() {
        return $this->id;
    }
}

$photo = 8;

function modifierId($photo, $newId) {
    $photo->id = $newId;
}

modifierId($photo, 12);

echo $photo->getId();