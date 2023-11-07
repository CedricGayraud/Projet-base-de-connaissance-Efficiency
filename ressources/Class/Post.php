<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/user.php');
class Post
{
    public int $id;

    public string $title;

    public User $author;

    public string  $content;

    public string $createdDate;


    public string $dateLastInteraction;

    public string $status;


    public function __construct($id, $title, $content, $auteur, $createdDate, $dateLastInteraction, $status)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $auteur;
        $this->dateLastInteraction = $dateLastInteraction;
        $this->createdDate = $createdDate;
        $this->status = $status;

    }

    // GETTERS & SETTERS


    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    public function getDateLastInteraction(): string
    {
        return $this->dateLastInteraction;
    }

    public function getStatus(): int
    {
        return $this->status;
    }



    //SETTERS

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function setDateCreation($date_creation)
    {
        $this->createdDate = $date_creation;
    }

    public function setDateLastInteraction($dateLastInteraction)
    {
        $this->dateLastInteraction = $dateLastInteraction;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }


    // STATIC METHODS

    public static function createPost($userId, $title, $content)
    {
        global $bdd;
        $query = $bdd->prepare("INSERT INTO posts (title, content, user, createdDate, dateLastInteraction, upVote, status) VALUES (:title, :content, :user, NOW(), NOW(), :status)");
        $query->execute(array(
            'title' => $title,
            'content' => $content,
            'user' => $userId,
            'status' => 0
        ));
    }

    public static function getPosts(): array
    {
        global $bdd;
        $query = $bdd->prepare("SELECT * FROM posts");
        $query->execute();
        $posts = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post(
                $row['id'],
                $row['title'],
                $row['content'],
                User::getUserById($row['user']),
                $row['createdDate'],
                $row['dateLastInteraction'],
                $row['status'],
            );
            $posts[] = $post;
        }

        return $posts;
    }

    public static function getPostById($postId): ?Post
    {
        global $bdd;
        $query = $bdd->prepare("SELECT * FROM posts WHERE id = :postId");
        $query->bindParam(':postId', $postId, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Post(
                $row['id'],
                $row['title'],
                $row['content'],
                User::getUserById($row['user']),
                $row['createdDate'],
                $row['dateLastInteraction'],
                $row['status']

            );
        }

        return null;
    }

}