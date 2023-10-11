<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');

class Card
{
    public int $id;
    public string $title;
    public string $contentText;
    public string $gitHub;
    public string $status;
    public int $upVote;
    public string $createdDate;
    public string $updatedDate;
    public string $summary;
    public int $user;
    public int $thematic;
    public int $platform;
    public string $img;

    public function __construct(
        int $id,
        string $title,
        string $contentText,
        string $gitHub,
        string $status,
        int $upVote,
        string $createdDate,
        string $updatedDate,
        string $summary,
        int $user,
        int $thematic,
        int $platform,
        string $img
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->contentText = $contentText;
        $this->gitHub = $gitHub;
        $this->status = $status;
        $this->upVote = $upVote;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->summary = $summary;
        $this->user = $user;
        $this->thematic = $thematic;
        $this->platform = $platform;
        $this->img = $img;
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContentText(): string
    {
        return $this->contentText;
    }

    public function setContentText(string $contentText): void
    {
        $this->contentText = $contentText;
    }

    public function getGitHub(): string
    {
        return $this->gitHub;
    }

    public function setGitHub(string $gitHub): void
    {
        $this->gitHub = $gitHub;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getUpVote(): int
    {
        return $this->upVote;
    }

    public function setUpVote(int $upVote): void
    {
        $this->upVote = $upVote;
    }

    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    public function setCreatedDate(string $createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    public function getUpdatedDate(): string
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate(string $updatedDate): void
    {
        $this->updatedDate = $updatedDate;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    public function getUser(): int
    {
        return $this->user;
    }

    public function setUser(int $user): void
    {
        $this->user = $user;
    }

    public function getThematic(): int
    {
        return $this->thematic;
    }

    public function setThematic(int $thematic): void
    {
        $this->thematic = $thematic;
    }

    public function getPlatform(): int
    {
        return $this->platform;
    }

    public function setPlatform(int $platform): void
    {
        $this->platform = $platform;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function setImg(int $img): void
    {
        $this->img = $img;
    }
}
