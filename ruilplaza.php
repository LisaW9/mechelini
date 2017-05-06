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
    <title>Ruilplaza</title>

    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/kaart.css">
    <link rel="stylesheet" type="text/css" href="css/ruilkaart.css">
    <link rel="stylesheet" type="text/css" href="css/ruilplaza.css">

</head>
<body>
<?php $page = 'Ruilplaza';
include_once('includes/header.inc.php'); ?>
<div id="container">
    <div class="ruilkaarten">
        <?php for($i = 0; $i <= 10; $i++){
            include('includes/ruilkaart.inc.php');
        } ?>
    </div>
</div>
<?php include_once('includes/footer.inc.php'); ?>
</body>
</html>