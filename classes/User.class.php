<?php

    class User{
        private $m_email;
        private $m_password;

        /**
         * @return mixed
         */
        public function getMEmail()
        {
            return $this->m_email;
        }

        /**
         * @param mixed $m_email
         */
        public function setMEmail($m_email)
        {
            if ($m_email=="") {
                throw new Exception("Email can not be empty");
            }
            if (!filter_var($m_email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email is not a valid one");
            }
            $this->m_email = $m_email;
        }

        /**
         * @return mixed
         */
        public function getMPassword()
        {
            return $this->m_password;
        }

        /**
         * @param mixed $m_password
         */
        public function setMPassword($m_password)
        {
            if ($m_password=="") {
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
                    header("Location: index.php");
                    session_start();
                    $_SESSION["id"] = $row["id"];
                    $_SESSION['user'] = $this->m_email;
                } else {
                    throw new Exception("OOPS looks like you've filled in the wrong username or password");
                }
            }

            return $res;
        }

    }