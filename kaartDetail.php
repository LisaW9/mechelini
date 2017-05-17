<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: login.php');
}

spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".class.php");
});
$card = $_GET['card'];
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
    <div class="kaart" style="background-image: url('img/kaarten/<?php echo str_replace('-', '_', $card) ?>.png');"></div>


</div>
<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/detail.js"></script>
</body>
</html>