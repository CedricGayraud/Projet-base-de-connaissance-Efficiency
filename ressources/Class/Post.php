<?php
require ($_SERVER['DOCUMENT_ROOT'] . 'layout.php');
class Post {
    public int $id;
    public string $title;
    public string  $content;
    public user $author;
    public DateTime $dateLastInteraction;
    public DateTime $createdDate;
    public int $upvotes;


    public function __construct($id, $title, $content, $auteur, $createdDate, $upvotes, $dateLastInteraction) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $auteur;
        $this->dateLastInteraction = $dateLastInteraction;
        $this->createdDate = $createdDate;
        $this->upvotes = $upvotes;
    }

    // GETTERS & SETTERS

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getDateCreation() {
        return $this->date_creation;
    }

    public function getLikes() {
        return $this->likes;
    }

    //SETTERS

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setDateCreation($date_creation) {
        $this->date_creation = $date_creation;
    }

    public function setLikes($likes) {
        $this->likes = $likes;
    }

}

