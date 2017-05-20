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

} catch (Exception $e) {
    echo $e->getMessage();
}

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
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <title><?php echo $user->firstName; ?></title>
</head>
<body>
<?php $page = 'Profile';
include_once('includes/header.inc.php'); ?>
<div id="container">
    <div class="profile">
        <p><?php $userid ?></p>
        <img src="img/face_youtube%20250x250.png" alt="missing_img">
        <h1><?php echo $user->firstName . ' ' . $user->lastName; ?></h1>
    </div>
</div>
</body>
</html>