<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".class.php");
});

echo Location::compareTime();