<?php
session_start();
spl_autoload_register(function ($class) {
    include_once($class . ".class.php");
});

class User
{
    private $m_email;
    private $m_password;
    private $m_firstname;
    private $m_lastname;
    private $m_abbonement;

    /**
     * SETTERS
     */
    public function setMEmail($m_email)
    {
        if ($m_email == "") {
            throw new Exception("Email can not be empty");
        }
        if (!filter_var($m_email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email is not a valid one");
        }
        $this->m_email = $m_email;
    }

    public function setMPassword($m_password)
    {
        if ($m_password == "") {
            throw new Exception("Password can not be empty");
        }
        if (strlen($m_password) < 6) {
            throw new Exception("Password is too short");
        }
        if (!preg_match("#[a-zA-Z]+#", $m_password)) {
            throw new Exception("Password is not valid");
        }

        $this->m_password = $m_password;
    }

    public function setMFirstname($m_firstname)
    {
        if ($m_firstname == "") {
            throw new Exception("Name can not be empty");
        }
        $this->m_firstname = $m_firstname;
    }

    public function setMLastname($m_lastname)
    {
        if ($m_lastname == "") {
            throw new Exception("Lastname can not be empty");
        }
        $this->m_lastname = $m_lastname;
    }

    public function setMAbbonement($m_abbonement)
    {
        if ($m_abbonement == "") {
            throw new Exception("Please fill in your abbonement number");
        }
        $this->m_abbonement = $m_abbonement;
    }

    /**
     * GETTERS
     */
    public function getMEmail()
    {
        return $this->m_email;
    }

    public function getMPassword()
    {
        return $this->m_password;
    }

    public function getMFirstname()
    {
        return $this->m_firstname;
    }

    public function getMLastname()
    {
        return $this->m_lastname;
    }

    public function getMAbbonement()
    {
        return $this->m_abbonement;
    }


    public function Register()
    {
        $conn = Db::getInstance();

        $stmnt = $conn->prepare("INSERT INTO users (abbo_ID, firstName, lastName, email, password) VALUES (:abbo_ID, :firstName, :lastName, :email, :password)");
        $stmnt->bindvalue(":abbo_ID", $this->m_abbonement);
        $stmnt->bindvalue(":firstName", $this->m_firstname);
        $stmnt->bindvalue(":lastName", $this->m_lastname);
        $stmnt->bindValue(":email", $this->m_email);
        $stmnt->bindvalue(":password", $this->m_password);
        $stmnt->execute();

        $statement = $conn->prepare("SELECT * FROM users WHERE email = :email ;");
        $statement->bindValue(":email", $this->m_email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $getAmountOfThemes = $conn->prepare("select * from themes");
        $getAmountOfThemes->execute();

        foreach ($getAmountOfThemes as $g):
            $setStateTheme = $conn->prepare("insert into completed (user_id, theme_id, amount) values (:user_id, :theme_id, 0)");
            $setStateTheme->bindValue(':user_id', $_SESSION['id']);
            $setStateTheme->bindValue(':theme_id', $g["id"]);
            $setStateTheme->execute();
        endforeach;

        session_start();
        $_SESSION["id"] = $result["id"];
        $_SESSION['user'] = $this->m_email;
        Cards::getRandomCards(5);
        header("Location: index.php");
    }


    public function Login()
    {
        // conn (PDO)
        $conn = Db::getInstance();

        // statement: SELECT query
        $statement = $conn->prepare("SELECT * FROM users WHERE email = :email ;");
        $statement->bindValue(":email", $this->m_email);

        // execute statement
        $res = $statement->execute();

        // confirmation
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $row) {
            if (password_verify($this->m_password, $row['password'])) {
                session_start();
                $_SESSION["id"] = $row["id"];
                $_SESSION['loggedIn'] = true;
                Cards::checkForUnopenedCards();
                header("Location: ./index.php");
            } else {
                throw new Exception("OOPS looks like you've filled in the wrong username or password");
            }
        }
        return $res;
    }

    public static function getProfile($p_iId)
    {
        $conn = Db::getInstance();
        $stment = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stment->bindValue(':id', $p_iId);
        $stment->execute();
        $user = $stment->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}