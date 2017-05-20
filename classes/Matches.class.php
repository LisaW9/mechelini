<?php

session_start();
spl_autoload_register(function ($class) {
    include_once($class . ".class.php");
});

abstract class Matches
{

    public static function checkIfAttended($p_iMatchID)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('SELECT * FROM user_matches WHERE match_id = :match_ID AND user_id = :user_ID');
        $statement->bindValue(':match_ID', $p_iMatchID);
        $statement->bindValue(':user_ID', $_SESSION['id']);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            return 'User has already attended this match';
        } else {
            self::attendMatch($p_iMatchID);
            return 'User is following the match';
        }
    }

    public static function attendMatch($p_iMatchID)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('INSERT INTO user_matches (user_id, match_id) VALUES (:user_ID, :match_ID)');
        $statement->bindValue(':user_ID', $_SESSION['id']);
        $statement->bindValue(':match_ID', $p_iMatchID);
        $statement->execute();
        Cards::getRandomCards(10);
    }
}