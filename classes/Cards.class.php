<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".class.php");
});

abstract class Cards
{
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
        $stmnt = $conn->prepare("UPDATE user_cards SET opened = 1 WHERE id = :id");
        $stmnt->bindValue(':id', $p_iCardId);
        $stmnt->execute();
    }

    public static function checkForUnopenedCards()
    {
        $conn = Db::getInstance();
        $stmnt = $conn->prepare("SELECT * FROM user_cards WHERE user_id = :user_ID AND opened = 0");
        $stmnt->bindValue(':user_ID', $_SESSION['id']);
        $stmnt->execute();
        if ($stmnt->rowCount() > 0) {
            $_SESSION['cardsReceived'] = true;
        }
    }

    public static function getCards($query)
    {
        unset($_SESSION['cards']);
        $_SESSION['cards'] = [];
        $conn = Db::getInstance();
        $statement = $conn->prepare($query);
        $statement->bindValue(":user_id", $_SESSION['id']);
        $statement->execute();
        while ($result = $statement->fetch(PDO::FETCH_OBJ)) {
            array_push($_SESSION['cards'], $result);
            echo "<div class='kaartDiv'>";
            include("../includes/kaart.inc.php");
            echo "</div>";
        };
    }

    public static function countCards($p_iCard_id){
        $conn = Db::getInstance();
        $statement = $conn->prepare('SELECT count(*) as "amount" FROM user_cards WHERE card_id = :card_id AND user_id = :user_id');
        $statement->bindValue(":user_id", $_SESSION['id']);
        $statement->bindValue(":card_id", $p_iCard_id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        return $result->amount;
    }

    public static function getClosedCards()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('SELECT uc.id, c.name, c.image FROM cards c INNER JOIN user_cards uc ON c.id = uc.card_id WHERE uc.user_id = :user_id AND uc.opened = 0 ORDER BY uc.id');
        $statement->bindValue(":user_id", $_SESSION['id']);
        $statement->execute();
        while ($result = $statement->fetch(PDO::FETCH_OBJ)) {
            echo "<div class='kaartDiv' id='" . $result->id . "'>";
            echo "<div class='flipper'>";
            include("../includes/kaart.inc.php");
            echo "<div class='closed' style=\"background-image:url('img/kaarten/closed.png')\"></div>";
            echo "</div>";
            echo "</div>";
        };
    }

    public static function getCardsProgress(){
        $conn = Db::getInstance();
        $stmnt = $conn->prepare("SELECT t.*, count(uc.card_id), uc.user_id FROM themes t INNER JOIN user_cards uc WHERE user_id = :user_ID");
        $stmnt->bindValue(':user_ID', $_SESSION['id']);
        $stmnt->execute();
        $cardProgress = $stmnt->fetchAll(PDO::FETCH_ASSOC);
        return $cardProgress;
    }
}