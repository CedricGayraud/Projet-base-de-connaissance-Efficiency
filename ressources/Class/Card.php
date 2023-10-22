<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
require('../Class/User.php');
class Card
{
    public int $id;
    public string $title;
    public string $contentText;
    public string $gitHub;
    public string $status;
    public string $createdDate;
    public string $updatedDate;
    public string $summary;
    private User $user;
    public int $thematic;
    public int $platform;
    public string $img;

    public function __construct(
        int $id,
        string $title,
        string $contentText,
        string $gitHub,
        string $status,
        string $createdDate,
        string $updatedDate,
        string $summary,
        User $user,
        int $thematic,
        int $platform,
        string $img
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->contentText = $contentText;
        $this->gitHub = $gitHub;
        $this->status = $status;
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

    public function getUser(): User
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



    public static function getAllCards($bdd)
    {
        $queryCards = $bdd->prepare("SELECT c.*, u.nickname as user_nickname, u.id as user_id, u.lastName as user_lastName, u.firstName as user_firstName, u.email as user_email, u.role as user_role, u.rank as user_rank, u.profilPicture as user_profilPicture, u.isBanned as user_isBanned, u.createdDate as user_createdDate FROM cards c
        JOIN users u ON c.user = u.id");
        $queryCards->execute();

        $cards = [];

        while ($row = $queryCards->fetch(PDO::FETCH_ASSOC)) {
            $user = new User(
                $row['user_id'],
                $row['user_nickname'],
                $row['user_lastName'],
                $row['user_firstName'],
                $row['user_email'],
                $row['user_role'],
                $row['user_rank'],
                $row['user_profilPicture'],
                $row['user_isBanned'],
                $row['user_createdDate']
            );

            $cards[] = new Card(
                $row['id'],
                $row['title'],
                $row['contentText'],
                $row['gitHub'],
                $row['status'],
                $row['createdDate'],
                $row['updatedDate'],
                $row['summary'],
                $user,
                $row['thematic'],
                $row['platform'],
                $row['img']
            );
        }

        function formatDate($date)
        {
            $formattedDate = new DateTime($date);
            return $formattedDate->format('m/Y');
        }

        return $cards;
    }
    public static function getCardById($id_card)
    {
        global $bdd;
        $queryCard = $bdd->prepare("SELECT c.*, u.nickname as user_nickname, u.id as user_id, u.lastName as user_lastName, u.firstName as user_firstName, u.email as user_email, u.role as user_role, u.rank as user_rank, u.profilPicture as user_profilPicture, u.isBanned as user_isBanned, u.createdDate as user_createdDate FROM cards c 
    JOIN users u ON c.user = u.id WHERE c.id=:id");
        $queryCard->execute(array('id' => $id_card));

        $row = $queryCard->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $user = new User(
                $row['user_id'],
                $row['user_nickname'],
                $row['user_lastName'],
                $row['user_firstName'],
                $row['user_email'],
                $row['user_role'],
                $row['user_rank'],
                $row['user_profilPicture'],
                $row['user_isBanned'],
                $row['user_createdDate']
            );

            $card = new Card(
                $row['id'],
                $row['title'],
                $row['contentText'],
                $row['gitHub'],
                $row['status'],
                $row['createdDate'],
                $row['updatedDate'],
                $row['summary'],
                $user,
                $row['thematic'],
                $row['platform'],
                $row['img']
            );
            function formatDate($date)
            {
                $formattedDate = new DateTime($date);
                return $formattedDate->format('m/Y');
            }
            return $card; // Renvoyer l'objet Card
        }

        return null; // Retourner null si aucune valeur n'a été trouvée
    }

    public static function getAllToVerifyCards($bdd)
    {
        $queryCards = $bdd->prepare("SELECT c.*, u.nickname as user_nickname, u.id as user_id, u.lastName as user_lastName, u.firstName as user_firstName, u.email as user_email, u.role as user_role, u.rank as user_rank, u.profilPicture as user_profilPicture, u.isBanned as user_isBanned, u.createdDate as user_createdDate FROM cards c
        JOIN users u ON c.user = u.id WHERE c.status = 'toVerify'");
        $queryCards->execute();

        $cards = [];

        while ($row = $queryCards->fetch(PDO::FETCH_ASSOC)) {
            $user = new User(
                $row['user_id'],
                $row['user_nickname'],
                $row['user_lastName'],
                $row['user_firstName'],
                $row['user_email'],
                $row['user_role'],
                $row['user_rank'],
                $row['user_profilPicture'],
                $row['user_isBanned'],
                $row['user_createdDate']
            );

            $cards[] = new Card(
                $row['id'],
                $row['title'],
                $row['contentText'],
                $row['gitHub'],
                $row['status'],
                $row['createdDate'],
                $row['updatedDate'],
                $row['summary'],
                $user,
                $row['thematic'],
                $row['platform'],
                $row['img']
            );
        }
        return $cards;
    }

    public static function verifyCard($id)
    {
        global $bdd;
        $queryPlatforms = $bdd->prepare("UPDATE cards SET status='verify'WHERE id=:id ");
        $queryPlatforms->execute(array('id' => $id));
    }

    public static function createCard($title, $contentText, $gitHub, $summary, $user, $thematic, $platform, $img)
    {
        global $bdd;
        $insertQuery = $bdd->prepare("INSERT INTO cards (title, summary, user, platform, thematic, contentText, gitHub, img) 
        VALUES (:title, :summary, :user, :platform, :thematic, :contentText, :gitHub, :img)");
        $insertQuery->execute(array(
            'title' => $title,
            'summary' => $summary,
            'user' => $user,
            'platform' => $platform,
            'thematic' => $thematic,
            'contentText' => $contentText,
            'gitHub' => $gitHub,
            'img' => $img,
        ));
    }
}
