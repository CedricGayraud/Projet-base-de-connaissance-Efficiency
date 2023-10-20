<?php
class User
{
    private int $id;
    private string $nickname;
    private string $lastName;
    private string $firstName;
    private string $email;
    private bool $role;
    private string $rank;
    private string $profilPicture;
    private bool $isBanned;
    private string $createdDate;

    public function __construct($id, $nickname, $lastName, $firstName, $email, $role, $rank, $profilPicture, $isBanned, $createdDate)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->role = $role;
        $this->rank = $rank;
        $this->profilPicture = $profilPicture;
        $this->isBanned = $isBanned;
        $this->createdDate = $createdDate;
    }

    // GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getRank()
    {
        return $this->rank;
    }

    public function getProfilPicture()
    {
        return $this->profilPicture;
    }

    public function getIsBanned()
    {
        return $this->isBanned;
    }

    public function getCreateDate()
    {
        return $this->createdDate;
    }


    // SETTERS

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    public function setProfilPicture($profilPicture)
    {
        $this->profilPicture = $profilPicture;
    }

    public function setIsBanned($isBanned)
    {
        $this->isBanned = $isBanned;
    }

    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }
}
