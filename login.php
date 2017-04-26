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
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Mechelini</title>
</head>
<body>

    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="js/login.js"></script>

    <div id="container">
        <img class="logo" src="img/icons/logo.svg" alt="logo">
        <form action="">
            <label for="email">E-MAIL</label>
            <input type="text" class="input" id="email" name="email">

            <label for="password">WACHTWOORD</label>
            <input type="password" class="input" id="password" name="password">

            <input type="submit" value="INLOGGEN" class="submit">
            <button class="register">REGISTREREN</button>
            <p><?php echo  $error?></p>
        </form>
    </div>

</body>
</html>