<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".class.php");
});

switch ($_POST["filter"]) {
    case 'amount':
        $query = 'SELECT c.name, c.image, count(uc.card_id) AS "amount" FROM  cards c INNER JOIN user_cards uc ON c.id = uc.card_id WHERE uc.user_id = :user_id AND uc.open = 1 GROUP BY uc.card_id ORDER BY count(uc.card_id) DESC';
        break;
    case 'abc':
        $query = 'SELECT c.name, c.image, count(uc.card_id) AS "amount" FROM user_cards uc INNER JOIN cards c ON uc.card_id = c.id WHERE uc.user_id = :user_id AND uc.open = 1 GROUP BY uc.card_id ORDER BY c.name';
        break;
    case 'time':
        $query = 'SELECT c.name, c.image, count(uc.card_id) as "amount" FROM cards c INNER JOIN user_cards uc ON c.id = uc.card_id WHERE uc.user_id = :user_id AND uc.open = 1 GROUP BY uc.card_id ORDER BY uc.id';
        break;
}

Cards::getCards($query);
echo '<script src="js/kaart.js"></script>';