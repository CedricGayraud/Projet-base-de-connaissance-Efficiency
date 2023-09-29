<?php
class User {
    private $id;
    private $nickname;
    private $lastName;
    private $firstName;
    private $email;
    private $role;
    private $rank;
    private $profilPicture;
    private $isBanned;
    private $createdDate;

    public function __construct($id, $nickname, $lastName, $firstName, $email, $role, $rank, $profilPicture, $isBanned, $createdDate) {
        $this -> id = $id;
        $this -> nickname = $nickname;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->role = $role;
        $this->rank = $rank;
        $this->profilPicture = $profilPicture;
        $this->isBanned = $isBanned;
        $this->createDate = $createdDate;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getNickName() {
        return $this->nickname;
    }


    public function getFirstName() {
        return $this->firstName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function getRank() {
        return $this->rank;
    }

    public function getProfilPicture() {
        return $this->profilPicture;
    }


    public function getIsBanned() {
        return $this->isBanned;
    }

    public function getCreateDate() {
        return $this->createDate;
    }

}
?>
