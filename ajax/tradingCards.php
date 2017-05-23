<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".class.php");
});
$query = "";
if (isset($_POST["filter"])) {

    switch ($_POST["filter"]) {
        case 'abc':
            $query = 'SELECT tc.id AS "tradeId", tc.user_id, tc.userCard_id, tc.date, c.id AS "cardId", c.name, c.image, c.rarity FROM trade_cards tc INNER JOIN user_cards uc INNER JOIN cards c ON tc.userCard_id = uc.id AND uc.card_id = c.id WHERE uc.user_ID NOT LIKE :user_id AND uc.trade = 1 ORDER BY c.name, tc.id';
            break;
        case 'time':
            $query = 'SELECT tc.id AS "tradeId", tc.user_id, tc.userCard_id, tc.date, c.id AS "cardId", c.name, c.image, c.rarity FROM trade_cards tc INNER JOIN user_cards uc INNER JOIN cards c ON tc.userCard_id = uc.id AND uc.card_id = c.id WHERE uc.user_ID NOT LIKE :user_id AND uc.trade = 1 ORDER BY tc.id';
            break;
    }
    echo '<script src="js/ruilkaart.js"></script>';

} else if (isset($_POST["mijnFilter"])) {
    switch ($_POST["mijnFilter"]) {
        case 'abc':
            $query = 'SELECT tc.id AS "tradeId", tc.user_id, tc.userCard_id, tc.date, c.id AS "cardId", c.name, c.image, c.rarity FROM trade_cards tc INNER JOIN user_cards uc INNER JOIN cards c ON tc.userCard_id = uc.id AND uc.card_id = c.id WHERE uc.user_ID = :user_id AND uc.trade = 1 ORDER BY c.name, tc.id';
            break;
        case 'time':
            $query = 'SELECT tc.id AS "tradeId", tc.user_id, tc.userCard_id, tc.date, c.id AS "cardId", c.name, c.image, c.rarity FROM trade_cards tc INNER JOIN user_cards uc INNER JOIN cards c ON tc.userCard_id = uc.id AND uc.card_id = c.id WHERE uc.user_ID = :user_id AND uc.trade = 1 ORDER BY tc.id';
            break;
    }
}

Trade::getTradingCards($query);