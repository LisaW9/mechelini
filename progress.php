<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: login.php');
}

spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".class.php");
});

try {
    //PROFILE
    $user = User::getProfile();

    //CARDS THEME
    $cardProgress = Cards::getCardsProgress();

} catch (Exception $e) {
    echo $e->getMessage();
}

echo $_SESSION['id'];

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/progress.css">
    <title>progress van <?php echo $user->firstName; ?></title>
</head>
<body>
<?php $page = 'Progress';
include_once('includes/header.inc.php'); ?>
<div id="container">
    <div class="progress">
        <?php foreach ($cardProgress as $c):?>
        <div class="progress_block">
            <h2>naam</h2>
            <h2>percentage</h2>
            <p><?php echo $c["user_id"] ?></p>
        </div>
        <?php endforeach;?>
    </div>
</div>
</body>
</html>