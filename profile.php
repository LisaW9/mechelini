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
    $user = User::getProfile($_SESSION['id']);

} catch (Exception $e) {
    echo $e->getMessage();
}

try {
    //PROFILE
    $unlocks = User::getUnlocks($_SESSION['id']);

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
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <title>profile van <?php echo $user->firstName; ?></title>
</head>
<body>
<?php $page = 'Profile';
include_once('includes/header.inc.php'); ?>
<div id="container">
    <div class="profile">
        <img src="img/userImages/<?php echo $user->image ?>" alt="<?php echo 'profielfoto van ' . $user->firstName . ' ' . $user->lastName . ' is missing'; ?>" class="profile_img">
        <div class="profile_data">
            <h1><?php echo $user->firstName . ' ' . $user->lastName; ?></h1>
            <h2>ID:<?php echo $user->abbo_ID ?></h2>
            <h2>Unlocks:<?php echo $unlocks->unlocks ?></h2>
        </div>
    </div>
</div>
</body>
</html>