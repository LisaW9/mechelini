<?php

class Profile
{

    private $userId;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function Profile(){
        $conn = Db::getInstance();

        $stment = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stment->bindValue(':id', $this->userId);
        $stment->execute();
        $use = $stment->fetchAll(PDO::FETCH_ASSOC);

        return $use;
    }


}