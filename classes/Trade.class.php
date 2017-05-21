<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".class.php");
});

class Trade
{
    public static function addTradeCard($p_iCard_id){
        $conn = Db::getInstance();
        $statement = $conn->prepare('INSERT INTO trade_cards (user_id, userCard_id, date) VALUES(:user_id, :card_id, :date)');
        $statement->bindValue(':user_id', $_SESSION['id']);
        $statement->bindValue(':card_id', $p_iCard_id);
        $statement->bindValue(':date', date('Y-m-d'));
        $statement->execute();
    }

    public static function removeTradeCard($p_iCard_id){
        $conn = Db::getInstance();
        $statement = $conn->prepare('DELETE FROM trade_cards WHERE userCard_id = :card_id');
        $statement->bindValue(':card_id', $p_iCard_id);
        $statement->execute();
    }
}