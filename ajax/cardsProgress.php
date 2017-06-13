<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".class.php");
});

if (isset($_POST["filter"])) {

    $query = 'SELECT * FROM themes WHERE theme_ID = 1';


    Cards::getCardCategories($query);
    echo '<script src="js/kaart.js"></script>';

}