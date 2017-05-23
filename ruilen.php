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

if (isset($_GET['trade'])) {
    foreach ($_SESSION['cards'] as $c) {
        if ($_GET['trade'] == $c->ucId) {
            $trader = $c;
            break;
        }
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

</head>
<body>

<div id="container">
    <div class="close">X</div>
    <div class="toTrade">
        <div class="kaart give"
             style="background-image: url('img/kaarten/<?php echo isset($_GET['trade']) ? $trader->image : 'closed.svg' ?>');"></div>
        <div class="kaart receive"
             style="background-image: url('img/kaarten/<?php echo $receiver->image ?>');"></div>
    </div>
    <div class="trade">
        <button class="tradeBtn">Trade!</button>
    </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/detailRuilen.js"></script>
</body>
</html>