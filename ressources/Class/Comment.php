<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
require('../Class/CardLike.php');

class Comment
{
    public int $id;
    public string $content;
    public string $createdDate;

    private User $user;
    private Card $card;

    public function __construct(
        int $id,
        string $content,
        string $createdDate,
        User $user,
        Card $card
    ) {
        $this->id = $id;
        $this->content = $content;
        $this->createdDate = $createdDate;
        $this->user = $user;
        $this->card = $card;
    }
    // Getters & Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    public function setCreatedDate(string $createdDate): void
    {
        $this->createdDate = $createdDate;
    }
    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(int $user): void
    {
        $this->user = $user;
    }
    public function getCard(): Card
    {
        return $this->card;
    }

    public function setCard(int $card): void
    {
        $this->card = $card;
    }

    public static function CommentCreate($content, $sessinUserId, $idCard)
    {
        global $bdd;
        $queryCards = $bdd->prepare("INSERT INTO comments (content, user, card) VALUES(:content, :user, :card)");
        $queryCards->execute(array('content' => $content, 'user' => $sessinUserId, 'card' => $idCard));
    }
}
