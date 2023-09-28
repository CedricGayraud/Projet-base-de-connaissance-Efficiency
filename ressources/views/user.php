<?php

class User {
    private $id;
    private $lastName;
    private $firstName;
    private $email;
    private $role;
    private $rank;
    private $isBanned;

    public function __construct($id, $lastName, $firstName, $email, $role, $rank, $isBanned) {
        $this->id= $id;
        $this->nom = $lastName;
        $this->prenom = $firstName;
        $this->email = $email;
        $this->role = $role;
        $this->rank = $rank;
        $this->isBanned = $isBanned;
    }
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this ->role;
    }

    public function getRank() {
        return $this ->rank;
    }
    public function getisBanned() {
        return $this ->isBanned;
    }

}

?>