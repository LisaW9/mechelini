<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
    }

    spl_autoload_register(function ($class) {
        include_once("classes/" . $class . ".class.php");
    });

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="format-detection" content="telephone=no" />
        <meta name="msapplication-tap-highlight" content="no" />
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/main_style.css">
        <title>Mechelini</title>
    </head>
    <body>
        <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="js/transition_main.js"></script>
        <div id="container">
        <nav>
                <ul>
                    <li><a href="#" class="menu_button_profile"><img src="img/icons/profile_icon.svg" alt="profile_icon"> <p>Profiel</p> </a></li>
                    <li><a href="#" class="menu_button_cards"><img src="img/icons/cards_icon.svg" alt="cards_icon"> <p>Kaarten</p> </a></li>
                    <li><a href="#" class="menu_button_trade"><img src="img/icons/trade_icon.svg" alt="trade_icon"> <p>Ruilplaza</p> </a></li>
                    <li><a href="#" class="menu_button_progress"><img src="img/icons/progress_icon.svg" alt="progress_icon"> <p>Vooruitgang</p> </a></li>
                    <li><a href="#" class="menu_button_friends"><img src="img/icons/friends_icon.svg" alt="friends_icon"> <p>Vrienden</p> </a></li>
                    <li><a href="logout.php" class="menu_button_logout"><img src="img/icons/logout_icon.svg" alt="logout_icon"> <p>Logout</p> </a></li>
                </ul>
            </nav>
        </div>
    </body>
</html>
