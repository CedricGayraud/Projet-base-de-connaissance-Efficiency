<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');

class Platform
{
    public int $id;
    public string $name;
    public string $description;
    public string $link;
    public string $img;

    public function __construct($id, $name, $description, $link, $img)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->link = $link;
        $this->img = $img;
    }

    // GETTERS & SETTERS

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }

    public static function getAllPlatforms($bdd)
    {
        $queryPlatforms = $bdd->prepare("SELECT * FROM platforms");
        $queryPlatforms->execute();

        $platforms = [];

        while ($row = $queryPlatforms->fetch(PDO::FETCH_ASSOC)) {
            $platforms[] = new Platform($row['id'], $row['name'], $row['description'], $row['link'], $row['img']);
        }

        return $platforms;
    }
}
