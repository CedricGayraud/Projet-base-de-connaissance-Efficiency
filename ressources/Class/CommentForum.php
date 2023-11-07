<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/CommentForum.php');

class CommentForum {

    private int $id;
    private string $content;
    private string $createdDate;
    private int $idPost;

    //getters

    public function getId(): int {
        return $this->id;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getCreatedDate(): string {
        return $this->createdDate;
    }

    public function getIdPost(): int {
        return $this->idPost;
    }

    //setters

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function setCreatedDate(string $createdDate): void {
        $this->createdDate = $createdDate;
    }

    public function setIdPost(int $idPost): void {
        $this->idPost = $idPost;
    }

    //construct

    public function __construct(int $id, string $content, string $createdDate, int $idPost) {
        $this->id = $id;
        $this->content = $content;
        $this->createdDate = $createdDate;
        $this->idPost = $idPost;
    }

    //static methods

    public static function getCommentsByPostId(int $idPost): array {
        global $bdd;
        $queryComments = $bdd->prepare("SELECT * FROM comments WHERE idPost=:idPost");
        $queryComments->execute(array('idPost' => $idPost));

        $comments = [];

        while ($data = $queryComments->fetch()) {
            $comment = new CommentForum($data['id'], $data['content'], $data['createdDate'], $data['idPost']);
            array_push($comments, $comment);
        }

        return $comments;
    }
}