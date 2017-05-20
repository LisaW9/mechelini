<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: login.php');
}

spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".class.php");
});
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
    <link rel="stylesheet" type="text/css" href="css/kaarten.css">

</head>
<body>
<div id="container">
    <div class="kaarten"><?php
        $query = 'SELECT c.name, c.image, count(uc.card_id) as "amount" FROM cards c INNER JOIN user_cards uc ON c.id = uc.card_id WHERE uc.user_id = :user_id and uc.open = 0 GROUP BY uc.card_id ORDER BY uc.id';
        Cards::getClosedCards($query);
        ?></div>
</div>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/transition_back.js"></script>
</body>
</html>