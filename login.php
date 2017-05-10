<?php

spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".class.php");
});

try {
    $error = "";
    if (!empty($_POST)) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = new User();
        $user->setMEmail($email);
        $user->setMPassword($password);

        if ($user->Login()) {
            //Start session with email as sessionvariable
            $user->Login();
        } else {
            $error = "Looks like something went wrong";
        }
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" type="text/css" href="css/formulier.css">
    <title>Mechelini</title>
</head>
<body>

<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>

<div id="container-form">
    <div class="login-form">
        <img class="logo" src="img/icons/logo.svg" alt="logo">
        <p class="error"><?php echo $error ?></p>
        <form action="" method="post" id="login">

            <div class="top-layout">

                <label for="email">E-MAIL</label>
                <input type="text" class="input profile_icon" id="email" name="email">

                <label for="password">WACHTWOORD</label>
                <input type="password" class="input lock_icon" id="password" name="password">

            </div>

            <div class="bottom-layout">

                <button class="button">LOGIN</button>
                <a href="register.php"><p class="link">Register here</p></a>

            </div>
        </form>
    </div>
</div>

</body>
</html>