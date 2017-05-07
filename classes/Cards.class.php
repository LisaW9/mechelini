<?php
spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".class.php");
});
class Cards
{
    private $m_sName;
    private $m_iRarity;
    private $m_sImage;
    private $m_iTheme_ID;

    /**
     * SETTERS
     */
    public function setMSName($m_sName)
    {
        $this->m_sName = $m_sName;
    }

    public function setMIRarity($m_iRarity)
    {
        $this->m_iRarity = $m_iRarity;
    }

    public function setMSImage($m_sImage)
    {
        $this->m_sImage = $m_sImage;
    }

    public function setMIThemeID($m_iTheme_ID)
    {
        $this->m_iTheme_ID = $m_iTheme_ID;
    }

    /*
     * GETTERS
     */
    public function getMSName()
    {
        return $this->m_sName;
    }

    public function getMIRarity()
    {
        return $this->m_iRarity;
    }

    public function getMSImage()
    {
        return $this->m_sImage;
    }

    public function getMIThemeID()
    {
        return $this->m_iTheme_ID;
    }


    public static function getRandomCards($p_iAmount){
        $conn = Db::getInstance();
        $stmnt = $conn->prepare("SELECT * FROM cards ORDER BY rand() LIMIT 5");
        $stmnt->bindValue(':amount', (int)$p_iAmount);
        $stmnt->execute();
        echo "\nSELECTING CARDS:\n";

        while($result = $stmnt->fetch(PDO::FETCH_OBJ)){
            Cards::saveUserCards($result->id);
        };
    }

    public static function SaveUserCards($p_iCardId){
        $conn = Db::getInstance();
        $stmnt = $conn->prepare("INSERT INTO user_cards(user_id, card_id) VALUES (:user_id, :card_id)");
        $stmnt->bindValue(':user_id', $_SESSION['id']);
        $stmnt->bindValue(':card_id', $p_iCardId);
        $stmnt->execute();
    }

}