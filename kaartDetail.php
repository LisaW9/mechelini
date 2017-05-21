<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: login.php');
}

spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".class.php");
});
$card = '';
foreach ($_SESSION['cards'] as $c) {
    if ($_GET['card'] == $c->ucId) {
        $card = $c;
        break;
    }
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaarten</title>

    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/kaart.css">
    <link rel="stylesheet" type="text/css" href="css/kaartDetail.css">

</head>
<body>

<div id="container">
    <div class="close">X</div>
    <div class="fav"></div>
    <div class="kaart"
         style="background-image: url('img/kaarten/<?php echo $card->image ?>');"></div>
    <div class="info">
        <div class="rarity">
            <p>RARITY</p>
            <p><?php switch ($card->rarity) {
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
        <div class="amount">
            <p>AMOUNT</p>
            <p><?php
                Cards::countCards($card->id);
                ?></p>
        </div>
        <div class="trade">
            <button class="tradeBtn <?php echo $card->trade == 1 ? 'tradeTrue':'tradeFalse' ?>" id="<?php echo $card->ucId; ?>"><?php echo $card->trade == 1 ? "Don't trade":"Trade" ?></button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/detail.js"></script>
</body>
</html>