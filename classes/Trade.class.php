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

    public static function getTradingCards($query)
    {
        unset($_SESSION['tradingCards']);
        $_SESSION['tradingCards'] = [];
        $conn = Db::getInstance();
        $statement = $conn->prepare($query);
        $statement->bindValue(':user_id', $_SESSION['id']);
        $statement->execute();
        while ($result = $statement->fetch(PDO::FETCH_OBJ)) {
            array_push($_SESSION['tradingCards'], $result);
            $user = User::getProfile($result->user_id);
            include("../includes/ruilkaart.inc.php");
        };
    }

    public static function tradeCards($traderCard, $receiverCard, $receiverUser){
        $conn = Db::getInstance();

        for($i = 1; $i<=2; $i++){
            $user = "";
            $card = "";
            if($i == 1){
                $user = $_SESSION['id'];
                $card = $receiverCard;
            } else{
                $user = $receiverUser;
                $card = $traderCard;
            }
            var_dump($user);
            var_dump($card);
            $statement = $conn->prepare('UPDATE user_cards SET user_id = :user WHERE id = :card');
            $statement->bindValue(':user', $user);
            $statement->bindValue(':card', $card);
            $statement->execute();

            $statement2 = $conn->prepare('DELETE FROM trade_cards WHERE userCard_id = :card');
            $statement2->bindValue(':card', $card);
            $statement2->execute();
            var_dump($conn->errorInfo());
        }



    }
}