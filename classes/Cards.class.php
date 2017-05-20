<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".class.php");
});

class Cards
{
    private $m_sName;
    private $m_iRarity;
    private $m_sImage;
    private $m_iTheme_ID;

    /**
     * SETTERS
     */
    public function setMSName($m_sName)
    {
        $this->m_sName = $m_sName;
    }

    public function setMIRarity($m_iRarity)
    {
        $this->m_iRarity = $m_iRarity;
    }

    public function setMSImage($m_sImage)
    {
        $this->m_sImage = $m_sImage;
    }

    public function setMIThemeID($m_iTheme_ID)
    {
        $this->m_iTheme_ID = $m_iTheme_ID;
    }

    /*
     * GETTERS
     */
    public function getMSName()
    {
        return $this->m_sName;
    }

    public function getMIRarity()
    {
        return $this->m_iRarity;
    }

    public function getMSImage()
    {
        return $this->m_sImage;
    }

    public function getMIThemeID()
    {
        return $this->m_iTheme_ID;
    }


    public static function getRandomCards($p_iAmount)
    {
        $conn = Db::getInstance();
        $stmnt = $conn->prepare("SELECT * FROM cards ORDER BY (rand() * rarity) LIMIT :amount");
        $stmnt->bindParam(':amount', $p_iAmount, PDO::PARAM_INT);
        $stmnt->execute();
        while ($result = $stmnt->fetch(PDO::FETCH_OBJ)) {
            Cards::saveUserCards($result->id);
        };
    }

    public static function SaveUserCards($p_iCardId)
    {
        $conn = Db::getInstance();
        $stmnt = $conn->prepare("INSERT INTO user_cards(user_id, card_id) VALUES (:user_id, :card_id)");
        $stmnt->bindValue(':user_id', $_SESSION['id']);
        $stmnt->bindValue(':card_id', $p_iCardId);
        $stmnt->execute();
        $_SESSION['cardsReceived'] = true;
    }

    public static function openUserCards($p_iCardId)
    {
        $conn = Db::getInstance();
        $stmnt = $conn->prepare("UPDATE user_cards SET opened = 1 WHERE user_id = :user_ID AND card_id = :card_ID");
        $stmnt->bindValue(':user_id', $_SESSION['id']);
        $stmnt->bindValue(':card_id', $p_iCardId);
        $stmnt->execute();
    }

    public static function checkForUnopenedCards()
    {
        $conn = Db::getInstance();
        $stmnt = $conn->prepare("SELECT * FROM user_cards WHERE user_id = :user_ID AND opened = 0");
        $stmnt->bindValue(':user_ID', $_SESSION['id']);
        $stmnt->execute();
        if ($stmnt->rowCount() > 0) {
            $_SESSION['unopenedCards'] = [];
            $_SESSION['cardsReceived'] = true;
            while ($result = $stmnt->fetch(PDO::FETCH_OBJ)) {
                array_push($_SESSION['unopenedCards'], $result);
            }
        }
    }

    public static function getCards($query)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare($query);
        $statement->bindValue(":user_id", $_SESSION['id']);
        $statement->execute();
        while ($result = $statement->fetch(PDO::FETCH_OBJ)) {
            echo "<div class='kaartDiv'>";
            include("../includes/kaart.inc.php");
            echo "</div>";
        };
    }

    public static function getClosedCards()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('SELECT c.name, c.image FROM cards c INNER JOIN user_cards uc ON c.id = uc.card_id WHERE uc.user_id = :user_id AND uc.opened = 0 ORDER BY uc.id');
        $statement->bindValue(":user_id", $_SESSION['id']);
        $statement->execute();
        while ($result = $statement->fetch(PDO::FETCH_OBJ)) {
            echo "<div class='kaartDiv'>";
            echo "<div class='closed'>";
            include("../includes/kaart.inc.php");
            echo "</div>";
            echo "</div>";
        };
    }
}