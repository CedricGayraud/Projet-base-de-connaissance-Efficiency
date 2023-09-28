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
        $this -> id = $id;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->role = $role;
        $this->rank = $rank;
        $this->isBanned = $isBanned;
    }

    public function getLastName() {
        return $this->lastName;
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

    public function getIsBanned() {
        return $this->isBanned;
    }
}
?>