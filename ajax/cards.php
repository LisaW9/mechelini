<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".class.php");
});

if (isset($_POST["filter"])) {
    $query = "";
    switch ($_POST["filter"]) {
        case 'amount':
            $query = 'SELECT c.name, c.image, c.rarity, count(uc.card_id) AS "amount" FROM  cards c INNER JOIN user_cards uc ON c.id = uc.card_id WHERE uc.user_id = :user_id AND uc.opened = 1 GROUP BY uc.id ORDER BY count(uc.card_id) DESC';
            break;
        case 'abc':
            $query = 'SELECT c.name, c.image, c.rarity, count(uc.card_id) AS "amount" FROM user_cards uc INNER JOIN cards c ON uc.card_id = c.id WHERE uc.user_id = :user_id AND uc.opened = 1 GROUP BY uc.id ORDER BY c.name';
            break;
        case 'time':
            $query = 'SELECT c.name, c.image, c.rarity, count(uc.card_id) AS "amount" FROM cards c INNER JOIN user_cards uc ON c.id = uc.card_id WHERE uc.user_id = :user_id AND uc.opened = 1 GROUP BY uc.id ORDER BY uc.id';
            break;
    }
    Cards::getCards($query);
    echo '<script src="js/kaart.js"></script>';
} else if (isset($_POST['openCards'])) {
    if($_POST['openCards'] == 'show'){
        Cards::getClosedCards();
        echo '<script src="js/flipCards.js"></script>';
    } else{
        $_SESSION['cardsReceived'] = false;
        Cards::openUserCards($_POST['openCards']);
    }
}