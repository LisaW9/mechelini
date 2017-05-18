<?php

session_start();
spl_autoload_register(function ($class) {
    include_once($class . ".class.php");
});
abstract class Location{
    private static $time;
    private static $date;

    /**
     * Location constructor.
     */
    public function __construct()
    {
        $this->time = date("h:i:sa");
        $this->date = date("Y-m-d");
    }

    public static function compareTime(){
        $conn = Db::getInstance();
        $statement = $conn->prepare('SELECT * FROM matches');
        $statement->execute();
        while($res = $statement->fetch(PDO::FETCH_OBJ)){
            if(self::$time >= $res->time && self::$date == $res->date){
                return 'Er is een match bezig!';
                break;
            }
        }
        return 'Er is nog geen match bezig. Kom later nog eens terug!';
    }

}