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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main_style.css">
    <link rel="stylesheet" type="text/css" href="css/formulier.css">
    <title>Mechelini</title>
</head>
<body>

<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>

<div id="container">
        <form action="" method="post" id="register">
            <label for="firstName">VOORNAAM</label>
            <input type="text" class="input" id="firstName" name="firstName">

            <label for="lastName">ACHTERNAAM</label>
            <input type="text" class="input" id="lastName" name="lastName">

            <label for="abbo_ID">Abbonement ID</label>
            <input type="text" class="input" id="abbo_ID" name="abbo_ID">

            <label for="email">E-MAIL</label>
            <input type="text" class="input" id="email" name="email">

            <label for="password">WACHTWOORD</label>
            <input type="password" class="input" id="password" name="password">
            <p class="error"><?php echo $error ?></p>

            <button class="button">REGISTREREN</button>
        </form>
</div>

</body>
</html>