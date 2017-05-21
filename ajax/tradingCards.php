<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".class.php");
});

if (isset($_POST["filter"])) {

    $query = "";
    switch ($_POST["filter"]) {
        case 'amount':
            $query = 'SELECT c.id, c.name, c.image, c.rarity, uc.trade, uc.id AS "ucId" FROM  cards c INNER JOIN user_cards uc ON c.id = uc.card_id WHERE uc.user_id = :user_id AND uc.opened = 1 GROUP BY uc.id ORDER BY count(uc.card_id) DESC';
            break;
        case 'abc':
            $query = 'SELECT tc.id as "tradeId", tc.user_id, tc.userCard_id, tc.date, c.id as "cardId", c.name, c.image, c.rarity FROM trade_cards tc INNER JOIN user_cards uc INNER JOIN cards c ON tc.userCard_id = uc.id AND uc.card_id = c.id WHERE uc.trade = 1 ORDER BY c.name';
            break;
        case 'time':
            $query = 'SELECT c.id, c.name, c.image, c.rarity, uc.trade, uc.id AS "ucId" FROM cards c INNER JOIN user_cards uc ON c.id = uc.card_id WHERE uc.user_id = :user_id AND uc.opened = 1 GROUP BY uc.id ORDER BY uc.id';
            break;
    }
    Trade::getTradingCards($query);
    echo '<script src="js/ruilkaart.js"></script>';
}