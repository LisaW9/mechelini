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
    <title>Ruilplaza</title>

    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/kaart.css">
    <link rel="stylesheet" type="text/css" href="css/ruilkaart.css">
    <link rel="stylesheet" type="text/css" href="css/ruilplaza.css">
    <link rel="stylesheet" type="text/css" href="css/filters.css">

</head>
<body>
<?php $page = 'Mijn Plaza';
include_once('includes/header.inc.php'); ?>
<div id="container">
    <?php include_once('includes/filters.inc.php'); ?>
    <div class="ruilkaarten"></div>
</div>
<?php include_once('includes/footer.inc.php'); ?>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/transition_back.js"></script>
<script type="text/javascript" src="js/transition_footer.js"></script>
<script type="text/javascript" src="js/filter.js"></script>
<script>
    //Kaarten ophalen
    filter('abc');
    // AJAX functie
    function filter(filter) {
        $.post('ajax/tradingCards.php', {'mijnFilter': filter}, function (data) {
            $(".ruilkaarten").children().remove();
            $(".ruilkaarten").append(data);
        });
    }
</script>
</body>
</html>