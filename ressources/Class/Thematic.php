<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');

class Thematic
{
    public int $id;
    public string $name;
    public string $description;
    public string $color;

    public function __construct($id, $name, $description, $color)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->color = $color;
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

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public static function getAllThematics($bdd)
    {
        $queryThematics = $bdd->prepare("SELECT * FROM thematics");
        $queryThematics->execute();

        $thematics = [];

        while ($row = $queryThematics->fetch(PDO::FETCH_ASSOC)) {
            $thematics[] = new Thematic($row['id'], $row['name'], $row['description'], $row['color']);
        }

        return $thematics;
    }
}
