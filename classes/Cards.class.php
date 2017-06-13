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

    public static function getCardCategories($query)
    {
        unset($_SESSION['cards']);
        $_SESSION['cards'] = [];
        $conn = Db::getInstance();
        $statement = $conn->prepare($query);
        $statement->execute();
        while ($result = $statement->fetch(PDO::FETCH_OBJ)) {
            array_push($_SESSION['cards'], $result);
            echo "<div class='kaartDiv'>";
            include("../includes/kaartProgress.inc.php");
            echo "</div>";
        };
    }

    public static function countCards($p_iCard_id)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('SELECT count(*) AS "amount" FROM user_cards WHERE card_id = :card_id AND user_id = :user_id');
        $statement->bindValue(":user_id", $_SESSION['id']);
        $statement->bindValue(":card_id", $p_iCard_id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        echo($result->amount);
    }

    public static function tradable($p_iId, $p_iTrade){
        $conn = Db::getInstance();
        $statement = $conn->prepare('UPDATE user_cards SET trade = :trade WHERE id = :id');
        $statement->bindValue(":id", $p_iId);
        $statement->bindValue(":trade", $p_iTrade);
        $statement->execute();
        if($p_iTrade == 1){
            Trade::addTradeCard($p_iId);
        } else {
            Trade::removeTradeCard($p_iId);
        }

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

    public static function getCardsProgress()
    {
        $conn = Db::getInstance();
        $stmnt = $conn->prepare("SELECT t.name as themeName, c.theme_ID as themeID, count(DISTINCT uc.card_id) as amountOfCollectedCards, uc.user_id as userCardID, com.amount as completedAmount
                                FROM themes t 
                                left JOIN cards c on t.id = c.theme_ID
                                left join user_cards uc on c.id = uc.card_id
                                left join completed com on uc.user_id = com.user_id and c.theme_ID = com.theme_id
                                WHERE uc.user_id = :user_ID
                                GROUP BY com.id");
        $stmnt->bindValue(':user_ID', $_SESSION['id']);
        $stmnt->execute();
        $cardProgress = $stmnt->fetchAll(PDO::FETCH_ASSOC);
        return $cardProgress;
    }

    public static function resetCards($themeField){
        $conn = Db::getInstance();
        $stmntCheck = $conn->prepare("select count(*) from completed where user_id = :user_id and theme_id = $themeField LIMIT 1");
        $stmntCheck->bindValue(':user_id', $_SESSION['id']);
        $stmntCheck->execute();

        if ($stmntCheck->fetchColumn()) {
            $stmnt = $conn->prepare("UPDATE completed SET amount = (amount + 1) WHERE user_id = :user_id and theme_id = $themeField");
            $stmnt->bindValue(':user_id', $_SESSION['id']);
            $stmnt->execute();

            $stmntDeleteCards = $conn->prepare("DELETE uc.*
                                                FROM user_cards uc
                                                left join cards c on c.id = uc.card_id
                                                left join themes t on t.id = c.theme_ID
                                                where user_id = :user_id and t.id = $themeField");
            $stmntDeleteCards->bindValue(':user_id', $_SESSION['id']);
            $stmntDeleteCards->execute();
        } else {
            $stmnt = $conn->prepare("insert into completed (user_id, theme_id, amount) values (:user_id, $themeField, 1)");
            $stmnt->bindValue(':user_id', $_SESSION['id']);
            $stmnt->execute();

            $stmntDeleteCards = $conn->prepare("DELETE uc.*
                                                FROM user_cards uc
                                                left join cards c on c.id = uc.card_id
                                                left join themes t on t.id = c.theme_ID
                                                where user_id = :user_id and t.id = $themeField");
            $stmntDeleteCards->bindValue(':user_id', $_SESSION['id']);
            $stmntDeleteCards->execute();
        }

        Cards::getRandomCards(2);

    }
}