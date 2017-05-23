<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".class.php");
});

if (isset($_POST["filter"])) {

    $query = "";
    switch ($_POST["filter"]) {
        case 'trade':
            $query = 'SELECT c.id, c.name, c.image, c.rarity, uc.trade, uc.id AS "ucId" FROM  cards c INNER JOIN user_cards uc ON c.id = uc.card_id WHERE uc.user_id = :user_id AND uc.opened = 1 ORDER BY uc.trade desc, uc.id';
            break;
        case 'abc':
            $query = 'SELECT c.id, c.name, c.image, c.rarity, uc.trade, uc.id AS "ucId" FROM user_cards uc INNER JOIN cards c ON uc.card_id = c.id WHERE uc.user_id = :user_id AND uc.opened = 1 ORDER BY c.name, uc.id';
            break;
        case 'time':
            $query = 'SELECT c.id, c.name, c.image, c.rarity, uc.trade, uc.id AS "ucId" FROM cards c INNER JOIN user_cards uc ON c.id = uc.card_id WHERE uc.user_id = :user_id AND uc.opened = 1 ORDER BY uc.id';
            break;
    }
    Cards::getCards($query);
    echo '<script src="js/kaart.js"></script>';

} else if (isset($_POST['openCards'])) {

    if ($_POST['openCards'] == 'show') {
        Cards::getClosedCards();
        echo '<script src="js/flipCards.js"></script>';
    } else {
        $_SESSION['cardsReceived'] = false;
        Cards::openUserCards($_POST['openCards']);
    }

} else if (isset ($_POST['trade'])) {

    if ($_POST['trade'] == 'true') {
        Cards::tradable($_POST['id'], 1);
        $array = ["tradeFalse", "tradeTrue", "Don't trade"];
        echo json_encode($array);

    } else if ($_POST['trade'] == 'false') {
        Cards::tradable($_POST['id'], 0);
        $array = ["tradeTrue", "tradeFalse", "Trade"];;
        echo json_encode($array);
    }
}