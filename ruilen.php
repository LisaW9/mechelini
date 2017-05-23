<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: login.php');
}

spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".class.php");
});
$trader = '';
$receiver = '';

foreach ($_SESSION['tradingCards'] as $tc) {
    if ($_GET['receive'] == $tc->tradeId) {
        $receiver = $tc;
        break;
    }
}

if (isset($_GET['trade'])) {
    foreach ($_SESSION['cards'] as $c) {
        if ($_GET['trade'] == $c->ucId) {
            $trader = $c;
            break;
        }
    }
};

if (isset($_POST['trade'])) {
    if (isset($_GET['trade'])) {
        //trade
    } else{
        echo 'Please select a card to trade!';
    }
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="mobile-web-app-capable" content="yes">
    <title>Ruilen</title>

    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/kaart.css">
    <link rel="stylesheet" type="text/css" href="css/kaartDetail.css">
    <link rel="stylesheet" type="text/css" href="css/ruilkaart.css">
    <link rel="stylesheet" type="text/css" href="css/ruilen.css">

</head>
<body>

<div id="container">
    <div class="close">X</div>
    <div class="toTrade">
        <div class="trade">
            <img src="img/kaarten/<?php echo isset($_GET['trade']) ? $trader->image : 'closed.svg' ?>" alt="trade">
            <div class="info">
                <div class="user">
                    <?php $user = User::getProfile($_SESSION['id']); ?>
                    <div class="profilePicture"
                         style="background-image:url('img/userImages/<?php echo $user->image ?>');"></div>
                    <p class="profileName"><?php echo $user->firstName . ' ' . $user->lastName ?></p>
                </div>
                <div class="amount">
                    <p>AMOUNT</p>
                    <p><?php
                        Cards::countCards($trader->id);
                        ?></p>
                </div>
                <div class="rarity">
                    <p class="rarityTitle">RARITY</p>
                    <p class="rarityP"><?php switch ($trader->rarity) {
                            case 1:
                                echo 'Common';
                                break;
                            case 2:
                                echo 'Rare';
                                break;
                            case 3:
                                echo 'Very rare';
                                break;
                        } ?></p>
                </div>
            </div>
        </div>

        <div class="receive" id="<?php echo $receiver->tradeId; ?>">
            <img src="img/kaarten/<?php echo $receiver->image ?>" alt="receive">
            <div class="info">
                <div class="user">
                    <?php $user = User::getProfile($receiver->user_id); ?>
                    <div class="profilePicture"
                         style="background-image:url('img/userImages/<?php echo $user->image ?>');"></div>
                    <p class="profileName"><?php echo $user->firstName . ' ' . $user->lastName ?></p>
                </div>
                <div class="amount">
                    <p>AMOUNT</p>
                    <p><?php
                        Cards::countCards($receiver->cardId);
                        ?></p>
                </div>
                <div class="rarity">
                    <p class="rarityTitle">RARITY</p>
                    <p class="rarityP"><?php switch ($receiver->rarity) {
                            case 1:
                                echo 'Common';
                                break;
                            case 2:
                                echo 'Rare';
                                break;
                            case 3:
                                echo 'Very rare';
                                break;
                        } ?></p>
                </div>
            </div>
        </div>
    </div>
    <button type='submit' class="tradeBtn" value="trade">Trade!</button>
</div>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/detailRuilen.js"></script>
<script>
    $('.close').on('click', function () {
        window.location.href = '/ruilplaza.php';
    })
</script>
</body>
</html>