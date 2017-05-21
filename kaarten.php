<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: login.php');
}

if($_SESSION['cardsReceived']){
    header('location: open.php');
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

<?php $page = 'Kaarten';
include_once('includes/header.inc.php'); ?>
<div id="container">
    <div class="filters">
        <div class="filter amount first">#</div>
        <div class="filter abc second">a-z</div>
        <div class="filter time active">L</div>
    </div>

    <div class="kaarten"></div>

</div>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/transition_back.js"></script>
<script type="text/javascript" src="js/filter.js"></script>
</body>
</html>