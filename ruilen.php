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
        Trade::tradeCards($trader->ucId, $receiver->userCard_id, $receiver->user_id);
    } else{
        $error = 'Please select a card to trade!';
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
    <?php if (isset($error)) echo '<p class="error">'.$error.'</p>'; ?>
    <div class="toTrade">
        <div class="trade">
            <img src="img/kaarten/<?php echo isset($_GET['trade']) ? $trader->image : 'closed.svg' ?>" alt="trade">
            <div class="info">
                <div class="user">
                    <?php $user = User::getProfile($_SESSION['id']); ?>
                    <div class="profilePicture"
                         style="background-image:url('img/userImages/<?php echo $user->image ?>');"></div>
                    <p class="profileName"><?php echo htmlspecialchars($user->firstName) . ' ' . htmlspecialchars($user->lastName) ?></p>
                </div>
                <div class="amount">
                    <p>AMOUNT</p>
                    <p><?php
                        Cards::countCards(htmlspecialchars($trader->id));
                        ?></p>
                </div>
                <div class="rarity">
                    <p class="rarityTitle">RARITY</p>
                    <p class="rarityP"><?php switch (htmlspecialchars($trader->rarity)) {
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

        <div class="receive" id="<?php echo htmlspecialchars($receiver->tradeId); ?>">
            <img src="img/kaarten/<?php echo htmlspecialchars($receiver->image) ?>" alt="receive">
            <div class="info">
                <div class="user">
                    <?php $user = User::getProfile(htmlspecialchars($receiver->user_id)); ?>
                    <div class="profilePicture"
                         style="background-image:url('img/userImages/<?php echo $user->image ?>');"></div>
                    <p class="profileName"><?php echo htmlspecialchars($user->firstName) . ' ' . htmlspecialchars($user->lastName) ?></p>
                </div>
                <div class="amount">
                    <p>AMOUNT</p>
                    <p><?php
                        Cards::countCards(htmlspecialchars($receiver->cardId));
                        ?></p>
                </div>
                <div class="rarity">
                    <p class="rarityTitle">RARITY</p>
                    <p class="rarityP"><?php switch (htmlspecialchars($receiver->rarity)) {
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
    <form action="" method="post">
        <button type='submit' class="tradeBtn" name="trade">Trade!</button>
    </form>

    <div class="alert">
        <h1>Je kaart is geruild!</h1>
        <div class="links">
            <a href="#" class="tradeLink">Verder ruilen</a>
            <a href="#" class="cardsLink">Naar kaarten</a>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/detailRuilen.js"></script>
<?php if ($_SESSION['tradeSuccess']) {
echo '<script type="text/javascript" src="js/alert.js"></script>';
$_SESSION['tradeSuccess'] = false;
}
?><script>
    $('.close').on('click', function () {
        window.location.href = '/ruilplaza.php';
    })
</script>
</body>
</html>