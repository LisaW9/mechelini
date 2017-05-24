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
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <title>profile van <?php echo htmlspecialchars($user->firstName); ?></title>
</head>
<body>
<?php $page = 'Profile';
include_once('includes/header.inc.php'); ?>
<div id="container">
    <h1>Sorry, this feature is not in the demo</h1>
</div>
</body>
</html>