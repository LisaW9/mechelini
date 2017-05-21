<?php
session_start();
if (!isset($_SESSION['id'])) {
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
    <meta name="mobile-web-app-capable" content="yes">
    <title>Kaarten</title>

    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/kaart.css">
    <link rel="stylesheet" type="text/css" href="css/kaarten.css">
    <link rel="stylesheet" type="text/css" href="css/open.css">

</head>
<body>
<div id="container">
    <div class="close">X</div>
    <div class="kaarten"></div>
</div>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/detail.js"></script>
<script>
    // AJAX functie
    function openCards(type) {
        $.post('ajax/cards.php', {'openCards': type}, function (data) {
            $(".kaarten").append(data);
        });
    }
    openCards('show');
</script>
</body>
</html>