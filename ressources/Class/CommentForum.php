<?php
require ($_SERVER['DOCUMENT_ROOT'] . '/ressources/Class/CommentForum.php');

class CommentForum {

    private int $id;
    private string $content;
    private string $createdDate;
    private int $post;

    private int $user;




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
        return $this->post;
    }

    public function getUser(): int {
        return $this->user;
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
        $this->post = $idPost;
    }

    public function setUser(int $user): void {
        $this->user = $user;
    }

    //construct

    public function __construct(int $id, string $content, string $createdDate, int $idPost, int $user) {
        $this->id = $id;
        $this->content = $content;
        $this->createdDate = $createdDate;
        $this->post = $idPost;
        $this->user = $user;
    }

    //static methods

    public static function getCommentsByPostId(int $idPost): array {
        global $bdd;
        $queryComments = $bdd->prepare("SELECT * FROM comments WHERE idPost=:idPost");
        $queryComments->execute(array('idPost' => $idPost));

        $comments = [];

        while ($data = $queryComments->fetch()) {
            $comment = new CommentForum($data['id'], $data['content'], $data['createdDate'], $data['post'], $data['user']);
            array_push($comments, $comment);
        }

        return $comments;
    }



    //addComment and update the post dateLastInteraction

    public static function addComment(string $content, int $idPost, int $idUser): void {
        global $bdd;
        $queryAddComment = $bdd->prepare("INSERT INTO comments (content, createdDate, post, user) VALUES (:content, NOW(), :post, :user)");
        $queryAddComment->execute(array('content' => $content, 'post' => $idPost, 'user' => $idUser));

        $queryUpdatePost = $bdd->prepare("UPDATE posts SET dateLastInteraction=NOW() WHERE id=:idPost");
        $queryUpdatePost->execute(array('idPost' => $idPost));
    }

    public static function deleteComment(int $idComment, int $idPost): void {
        global $bdd;
        $queryDeleteComment = $bdd->prepare("DELETE FROM comments WHERE id=:idComment");
        $queryDeleteComment->execute(array('idComment' => $idComment));
    }



}