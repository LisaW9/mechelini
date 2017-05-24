<?php

    spl_autoload_register(function ($class) {
        include_once("classes/" . $class . ".class.php");
    });
    $error = "";
    try {
        if (!empty($_POST)) {

            $email = $_POST["email"];
            $firstname = $_POST["firstName"];
            $lastname = $_POST["lastName"];
            $abbo_ID = $_POST["abbo_ID"];
            $password = $_POST["password"];
            $options = [
                'cost' => 12,
            ];

            $password = password_hash($password, PASSWORD_DEFAULT, $options);

            $user = new User();
            $user->setMFirstname($firstname);
            $user->setMLastname($lastname);
            $user->setMAbbonement("$abbo_ID");
            $user->setMEmail($email);
            $user->setMPassword($password);
            $user->Register();

        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" type="text/css" href="css/formulier.css">
    <title>Mechelini</title>
</head>
<body>

<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

<div id="container-form">
        <div class="login-form">
            <p class="error"><?php echo htmlspecialchars($error) ?></p>
        <form action="" method="post" id="register">
            <label for="firstName">VOORNAAM</label>
            <input type="text" class="input profile_icon" id="firstName" name="firstName">

            <label for="lastName">ACHTERNAAM</label>
            <input type="text" class="input profile_icon" id="lastName" name="lastName">

            <label for="abbo_ID">Abbonement ID</label>
            <input type="text" class="input profile_icon" id="abbo_ID" name="abbo_ID">

            <label for="email">E-MAIL</label>
            <input type="text" class="input profile_icon" id="email" name="email">

            <label for="password">WACHTWOORD</label>
            <input type="password" class="input lock_icon" id="password" name="password">

            <div class="bottom-layout">

                <button class="button">REGISTREREN</button>
                <a href="login.php"><p class="link">Login here</p></a>

            </div>
        </form>
        </div>
</div>

</body>
</html>