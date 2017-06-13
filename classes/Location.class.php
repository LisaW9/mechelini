<?php

session_start();
spl_autoload_register(function ($class) {
    include_once($class . ".class.php");
});
abstract class Location{
    private static $time;
    private static $date;


    public static function compareTime(){

        date_default_timezone_set('Europe/Brussels');
        $conn = Db::getInstance();
        $statement = $conn->prepare('SELECT * FROM matches');
        $statement->execute();
        while($res = $statement->fetch(PDO::FETCH_OBJ)){
            if(($res->time <= date('H:i') || date('H:i') <= date('H:i', strtotime($res->time)+1800)) && date('Y-m-d') == $res->date){
                Matches::checkIfAttended($res->id);
                return 'Er is een match bezig!';
            }
        }
        return 'Er is nog geen match bezig. Kom later nog eens terug!';
    }

}